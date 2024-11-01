<?php

class SSWooMapMD_Settings_Section{

    public $section_id = 'ssmapmd';

    /**
     * SSWooMapMD_Settings_Section constructor.
     */
    function __construct(){
        add_filter( 'woocommerce_get_sections_advanced', array($this, 'new_section'));
        add_filter( 'woocommerce_get_settings_advanced', array($this, 'new_field'), 10, 2 );
    }

    /**
     * @param $sections
     * @return mixed
     */
    function new_section($sections){
        $sections[$this->section_id] = __( 'Map.md', 'ss-woo-map-md' );
	    return $sections;
    }

    /**
     * @param $settings
     * @param $current_section
     * @return array
     */
    function new_field($settings, $current_section){
        /**
        * Check if the current section is what we want
        **/
        if ( $current_section == $this->section_id ) {
            $settings = array();

            // Add Title to the Settings
            $settings[] = array( 
                'name' => __('Woocommerce - map.md Streets Suggestions', 'ss-woo-map-md'),
                'type' => 'title', 
                'desc' => __( 'The following options are required for the plugin to function well', 'ss-woo-map-md' ),
                'id' => $this->section_id
            );

            // Add second text field option
            $settings[] = array(
                'name'     => sprintf(__( 'map.md API key', 'ss-woo-map-md' )),
                'desc_tip' => __( 'This key will be used to retrieve data from map.md', 'ss-woo-map-md' ),
                'id'       => 'ss_mapmd_api',
                'type'     => 'text',
                'desc'     => sprintf(
                    __( 'Click %shere%s to generate the API key.', 'ss-woo-map-md' ),
                    '<a href="https://map.md/ro/api/" target="_blank">',
                    '</a>'
                    )
            );
            
            $settings[] = array( 'type' => 'sectionend', 'id' => $this->section_id );
            return $settings;
        
        /**
         * If not, return the standard settings
         **/
        } else {
            return $settings;
        }
    }

}