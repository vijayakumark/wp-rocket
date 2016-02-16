<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );


/**
 * Remove Minification, DNS Prefetch, LazyLoad, Defer JS when on an AMP version of a post
 *
 * @since 2.7
 *
 */
if ( defined( 'AMP_QUERY_VAR' ) && function_exists( 'is_amp_endpoint' ) ) {
    add_action( 'wp', '_rocket_amp' );
}

function _rocket_amp() {
    if ( is_amp_endpoint() ) {
        remove_filter( 'rocket_buffer', 'rocket_exclude_deferred_js', 11 );
        remove_filter( 'rocket_buffer', 'rocket_dns_prefetch', 12 );
        remove_filter( 'rocket_buffer', 'rocket_minify_process', 13 );
        remove_filter( 'rocket_buffer', 'rocket_lazyload_iframes', PHP_INT_MAX );
        remove_filter( 'get_avatar',    'rocket_lazyload_images', PHP_INT_MAX );
        remove_filter( 'the_content',   'rocket_lazyload_images', PHP_INT_MAX );
    }
}