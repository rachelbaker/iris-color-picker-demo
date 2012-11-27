<?php
/*
Plugin Name: Iris Color Picker Demo
Plugin URI: http://www.rachelbaker.me
Description: Demonstrating how to use the new Iris color picker
Version: 1.0
Author: Rachel Baker
Author URI: http://www.rachelbaker.me
Author Email: rachel@rachelbaker.me

License:
    Color Picker Demo
    Copyright (C) 2012  Rachel Baker, Plugged In Consulting, Inc.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

add_action('admin_init', 'iris_cpdemo_init' );
add_action('admin_menu', 'iris_cpdemo_add_options_page');
add_action( 'admin_enqueue_scripts', 'iris_cpdemo_admin_enqueue_scripts' );

    /**
     * Uses the Settings_API to register the plugin options.
     * Options are saved in the wp_options table under the Option Name.
     *
     * Option group is iris_cpdemo_plugin_options
     * Option name is iris_cpdemo_options
     *
     * Initialized with admin_init hook
     */
    function iris_cpdemo_init(){
        register_setting( 'iris_cpdemo_plugin_options', 'iris_cpdemo_options', 'iris_cpdemo_validate_options' );
    }

    /**
     * Adds the plugin's option page to the Settings menu section.
     * Defines plugin options page parameters.
     *
     * Initialized with admin_menu hook
     */
    function iris_cpdemo_add_options_page() {
        add_options_page('Iris Color Picker Demo', 'Iris Demo', 'manage_options', __FILE__, 'iris_cpdemo_display_options');
    }

    /**
     * Displays plugin options page view
     *
     * Initialized in iris_cpdemo_add_options_page()
     */
    function iris_cpdemo_display_options() {
        include "admin-option-view.php";
    }

    /**
     * Santizes input from plugin options page.
     * Uses sanitize_text_field to strip html from input text.
     * @param  array    $input
     * @return array    $input
     */
    function iris_cpdemo_validate_options($input) {
        // strip html from textboxes
        sanitize_text_field($input);
        return $input;
    }

    /**
     * Load the built-in 'wp-color-picker' script and style.
     * Load the plugin specific 'cp-demo-custom' script that handles
     * the use of the wp-color-picker script on our plugin options page.
     *
     * @param  string   $hook   current admin screen suffix
     *
     * Initialized with admin_enqueue_scripts hook
     */
    function iris_cpdemo_admin_enqueue_scripts($hook) {
        // bail early if this is not the plugin option screen
        if( 'settings_page_color-picker-demo/cp-demo' !== $hook ) {
            return;
        }
        // load the wp-color-picker script and style
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'cp_demo-custom', plugins_url( 'cp-demo-script.min.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '1.0', true );
        wp_enqueue_style( 'wp-color-picker' );
    }
