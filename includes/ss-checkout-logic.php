<?php

class SSWooMapMD_Checkout_Logic{

    /**
     * SSWooMapMD_Checkout_Logic constructor.
     */
    function __construct(){
        add_action( 'template_redirect', array($this, 'action_enqueue_scripts') );
    }

    function action_enqueue_scripts(){
        if(is_checkout()):
            add_action("wp_enqueue_scripts", array($this, 'resources') );
        endif;
    }

    function resources(){
        wp_enqueue_script('ss-mapmd-auto-complete', SSWOOMAPMD_URL . 'resources/jquery.autocomplete.js', array('jquery'), '1.0.7', true);
        wp_enqueue_script('ss-mapmd', SSWOOMAPMD_URL . 'resources/maps-md-autocomplete.js', array('jquery', 'ss-mapmd-auto-complete'), SSWOOMAPMD_VERSION, true);
        wp_enqueue_style('ss-mapmd-auto-complete',  SSWOOMAPMD_URL . 'resources/jquery.auto-complete.css');

        $mapmd = array(
            'api' => get_option('ss_mapmd_api'),
            'apiEndpoint' => 'https://map.md/api/companies/webmap/group/search?'
        );
        wp_localize_script( 'ss-mapmd', 'mapmd', $mapmd );
    }
}