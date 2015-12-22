<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

add_action( 'update_option_give_settings', '__rocket_after_update_single_options', 10, 2 );

add_action( 'activate_give/give.php', 'rocket_generate_config_file', 11 );
add_action( 'deactivate_give/give.php', 'rocket_generate_config_file', 11 );

add_action( 'activate_give/give.php', 'flush_rocket_htaccess', 11 );
add_action( 'deactivate_give/give.php', 'flush_rocket_htaccess', 11 );

/**
 * Get Give pages to automatically exclude them from the cache.
 *
 * @since 2.7
 *
 * @param array $urls
 *
 * @return array $urls
 */
function get_rocket_give_exclude_pages() {

    $urls = array();

    if ( defined( 'GIVE_VERSION' ) && function_exists( 'give_get_settings' ) && 'deactivate_give/give.php' != current_filter() ) {
        $give_options = give_get_settings();
        $urls = array_merge( $urls, get_rocket_i18n_translated_post_urls( $give_options['success_page'], 'page' ) );
        $urls = array_merge( $urls, get_rocket_i18n_translated_post_urls( $give_options['history_page'], 'page' ) );
    }

	return $urls;
}