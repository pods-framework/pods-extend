<?php
/*
Plugin Name: Pods Starter Plugin
Plugin URI: http://example.com/
Description: Description
Version: 0.0.1
Author: Your Name
Author URI: http://example.com/
License: GPL2
*/

/**
 * Copyright (c) YEAR Your Name (email: Email). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Pods_Extend class
 *
 * @class Pods_Extend The class that holds the entire Pods_Extend plugin
 */
class Pods_Extend {

	/**
	 * Constructor for the Pods_Extend class
	 *
	 * Sets up all the appropriate hooks and actions
	 * within our plugin.
	 *
	 * @uses register_activation_hook()
	 * @uses register_deactivation_hook()
	 * @uses is_admin()
	 * @uses add_action()
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// Localize our plugin
		add_action( 'init', array( $this, 'localization_setup' ) );

		// Loads frontend scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

	}

	/**
	 * Initializes the Pods_Extend() class
	 *
	 * Checks for an existing Pods_Extend() instance
	 * and if it doesn't find one, creates it.
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new Pods_Extend();
		}

		return $instance;
	}

	/**
	 * Placeholder for activation function
	 *
	 * Nothing being called here yet.
	 */
	public function activate() {

	}

	/**
	 * Placeholder for deactivation function
	 *
	 * Nothing being called here yet.
	 */
	public function deactivate() {

	}

	/**
	 * Initialize plugin for localization
	 *
	 * @uses load_plugin_textdomain()
	 */
	public function localization_setup() {
		load_plugin_textdomain( 'pods-extend', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Enqueue front-end scripts
	 *
	 * Allows plugin assets to be loaded.
	 *
	 * @uses wp_enqueue_script()
	 * @uses wp_localize_script()
	 * @uses wp_enqueue_style
	 */
	public function enqueue_scripts() {

		/**
		 * All styles goes here
		 */
		wp_enqueue_style( 'pods-extend-styles', plugins_url( 'css/front-end.css', __FILE__ ) );

		/**
		 * All scripts goes here
		 */
		wp_enqueue_script( 'pods-extend-scripts', plugins_url( 'js/front-end.js', __FILE__ ), array( ), false, true );


		/**
		 * Example for setting up text strings from Javascript files for localization
		 *
		 * Uncomment line below and replace with proper localization variables.
		 */
		// $translation_array = array( 'some_string' => __( 'Some string to translate', 'pods-extend' ), 'a_value' => '10' );
		// wp_localize_script( 'pods-extend-scripts', 'podsExtend', $translation_array ) );

	}

	/**
	 * Enqueue admin scripts
	 *
	 * Allows plugin assets to be loaded.
	 *
	 * @uses wp_enqueue_script()
	 * @uses wp_enqueue_style
	 */
	public function admin_enqueue_scripts() {

		/**
		 * All admin styles goes here
		 */
		wp_enqueue_style( 'pods-extend-admin-styles', plugins_url( 'css/admin.css', __FILE__ ) );

		/**
		 * All admin scripts goes here
		 */
		wp_enqueue_script( 'pods-extend-admin-scripts', plugins_url( 'js/admin.js', __FILE__ ), array( ), false, true );


	}

} // Pods_Extend

$pods_extend = Pods_Extend::init();