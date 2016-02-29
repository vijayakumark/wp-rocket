<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

if ( function_exists( 'autoptimize_do_cachepurged_action' ) ) :

/**
 * Improvement with Autoptimize: clear the cache when Autoptimize's cache is cleared
 *
 * @since 2.7
 */
add_action( 'autoptimize_action_cachepurged', '__rocket_clear_cache_after_autoptimize' );
function __rocket_clear_cache_after_autoptimize() {
	rocket_clean_domain();
}

endif;