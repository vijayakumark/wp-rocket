<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/*
 * Remove HTTP protocol on script, link, img and form tags.
 *
 * @since 2.7
 */
add_filter( 'rocket_buffer', '__rocket_protocol_rewrite', PHP_INT_MAX );
function __rocket_protocol_rewrite( $buffer ) {
	/**
	  * Allow to force the protocol rewrite on script, link, img and form tags. 
	  *
	  * @since 2.7
	  *
	  * @param bool true will force the protocol rewrite
	 */
	$do_rocket_protocol_rewrite = apply_filters( 'do_rocket_protocol_rewrite', false );
	
	if ( ( get_rocket_option( 'do_cloudflare', 0 ) && get_rocket_option( 'cloudflare_protocol_rewrite', 0 ) || $do_rocket_protocol_rewrite ) && class_exists( 'DOMDocument' ) ) {
		$dom = new DOMDocument;
		@$dom->loadHTML( $buffer );

		// Replace script tags
		$scripts = $dom->getElementsByTagName( 'script' );
		foreach ( $scripts as $script ) {
		    $script->setAttribute( 'src', preg_replace( '/^https?:/', '', $script->getAttribute( 'src' ) ) );
		}

		// Replace link tags
		$links = $dom->getElementsByTagName( 'link' );
		foreach ( $links as $link ) {
		    $link->setAttribute( 'href', preg_replace( '/^https?:/', '', $link->getAttribute( 'href' ) ) );
		}

		// Replace img tags
		$images = $dom->getElementsByTagName( 'img' );
		foreach ( $images as $image ) {
		    $image->setAttribute( 'src', preg_replace( '/^https?:/', '', $image->getAttribute( 'src' ) ) );
		    
		    if ( $image->hasAttribute( 'srcset' ) ) {
				$image->setAttribute( 'srcset', preg_replace( '/https?:/','', $image->getAttribute('srcset') ) );    
		    }
		    
		    if ( get_rocket_option( 'lazyload' ) && $image->hasAttribute( 'data-lazy-src' ) ) {
			    $image->setAttribute('data-lazy-src', preg_replace( '/^https?:/', '', $image->getAttribute( 'data-lazy-src' ) ) );
		    }
		}

		// Replace form tags
		$forms = $dom->getElementsByTagName( 'form' );
		foreach ( $forms as $form ) {
		    $form->setAttribute( 'action', preg_replace( '/^https?:/', '', $form->getAttribute( 'action' ) ) );
		}

		$buffer = $dom->saveHTML();
	}

	return $buffer;
}