<?php

/**
 * @param $links
 * @return mixed
 */
function SSWooMapMDSettingsLink($links ) {
    $settings_link = sprintf(
        '<a href="%s">%s</a>',
        admin_url('admin.php?page=wc-settings&tab=advanced&section=ssmapmd'),
        __( 'Settings', 'ss-woo-map-md')
    );
    array_push( $links, $settings_link );
    return $links;
}

function SSWooMapMDNoWooFoundNotice(){
    global $pagenow;
    if ( $pagenow == 'plugins.php') {
        echo sprintf(
            '<div class="notice notice-warning is-dismissible"><p>%s%s.</p></div>',
            __('Woocommerce not found. Please install Woocommerce to take advantages of ', 'ss-woo-map-md'),
            SSWOOMAPMD_NAME
        );
    }
}

function SSWooMapMDTextDomain(){
    load_plugin_textdomain( 'ss-woo-map-md', false, 'ss-woo-map-md-suggestions/languages' );
}