<?php 
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

if( defined( 'POLYLANG_VERSION' ) && POLYLANG_VERSION ) :

/**
 * Conflict with Polylang: Clear the whole cache when the "The language is set from content " option is activated.
 *
 * @since 2.6.8
 */
add_action( 'after_rocket_clean_domain', '_rocket_force_clean_domain_on_polylang' );
function _rocket_force_clean_domain_on_polylang() {
    if ( POLYLANG_VERSION < '1.8' ) {
        if ( isset( $GLOBALS['polylang'] ) && 0 === $GLOBALS['polylang']->options['force_lang'] ) {
            rocket_clean_cache_dir();
        }
    } else {
        if ( function_exists( 'PLL' ) && 0 === PLL()->options['force_lang'] ) {
            rocket_clean_cache_dir();
        }
    }
}

endif;