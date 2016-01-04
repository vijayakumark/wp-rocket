<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/**
 * Load translation from the languages directory 
 *
 * @since 2.7
 *
 * @return bool true when textdomain is successfuly loaded, false otherwise
 */
function rocket_load_alternative_textdomain() {
    $locale = get_locale();
    // This filter is documented in /wp-includes/l10n.php.
    $locale = apply_filters( 'plugin_locale', $locale, 'rocket' );
    $mofile = WP_LANG_DIR . '/plugins/wp-rocket-' . $locale . '.mo';
    return load_textdomain( 'rocket', $mofile );
}