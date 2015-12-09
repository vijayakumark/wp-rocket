<?php 
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/**
 * Don't generate WP Rocket caching files depending to the option
 *
 * @since 2.7
*/
add_filter( 'do_rocket_generate_caching_files', '__rocket_generate_caching_files', 0 );
function __rocket_generate_caching_files() {
	return ! get_rocket_option( 'do_caching_files', 0 );
}