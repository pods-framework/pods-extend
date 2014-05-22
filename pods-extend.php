<?php
/*
Plugin Name: Pods Starter Plugin
Plugin URI: http://example.com/
Description: Description
Version: 0.0.1
Author: Your Name
Author URI: http://example.com/
Text Domain: pods-extend
License: GPL v2 or later
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
 * Define constants
 *
 * @since 0.0.2
 */
define( 'PODS_EXTEND_SLUG', plugin_basename( __FILE__ ) );
define( 'PODS_EXTEND_URL', plugin_dir_url( __FILE__ ) );
define( 'PODS_EXTEND_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Pods_Extend class
 *
 * @class Pods_Extend The class that holds the entire Pods_Extend plugin
 *
 * @since 0.0.1
 */
class Pods_Extend {

	/**
	 * Constructor for the Pods_Extend class
	 *
	 * Sets up all the appropriate hooks and actions
	 * within the plugin.
	 *
	 * @since 0.0.1
	 */
	public function __construct() {

		/**
		 * Plugin Setup
		 */
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// Localize our plugin
		add_action( 'init', array( $this, 'localization_setup' ) );

		/**
		 * Scripts/ Styles
		 */
		// Loads frontend scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Loads admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		/**
		 * Hooks that extend Pods
		 *
		 * NOTE: These are some example hooks that are useful for extending Pods, uncomment as needed.
		 */

		//Example: Add a tab to the pods editor for a CPT Pod called 'jedi
		//add_filter( 'pods_admin_setup_edit_tabs_post_type_jedi', array( $this, 'jedi_tabs' ), 11, 3 );

		//Example: Add fields to the Pods editor for all Advanced Content Types
		//add_filter( 'pods_admin_setup_edit_options_advanced', array( $this, 'act_options' ), 11, 2 );

		//Example: Add a submenu item to Pods Admin Menu
		//add_filter( 'pods_admin_menu', array( $this, 'add_menu' ) );

		/**
		//Complete Example: Add a tab for all post types and some options inside of it.
		//See example callbacks below
		add_filter( 'pods_admin_setup_edit_tabs_post_type', array( $this, 'pt_tab' ), 11, 3 );
		add_filter( 'pods_admin_setup_edit_options_post_type', array( $this, 'pt_options' ), 12, 2 );
		*/
		
	}

	/**
	 * Initializes the Pods_Extend() class
	 *
	 * Checks for an existing Pods_Extend() instance
	 * and if it doesn't find one, creates it.
	 *
	 * @since 0.0.1
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
	 * @since 0.0.1
	 */
	public function activate() {

	}

	/**
	 * Placeholder for deactivation function
	 *
	 * @since 0.0.1
	 */
	public function deactivate() {

	}

	/**
	 * Initialize plugin for localization
	 *
	 * @since 0.0.1
	 */
	public function localization_setup() {
		load_plugin_textdomain( 'pods-extend', false, trailingslashit( PODS_EXTEND_URL ) . '/languages/' );
		
	}

	/**
	 * Enqueue front-end scripts
	 *
	 * Allows plugin assets to be loaded.
	 *
	 * @since 0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * All styles goes here
		 */
		wp_enqueue_style( 'pods-extend-styles', trailingslashit( PODS_EXTEND_URL ) . 'css/front-end.css' );

		/**
		 * All scripts goes here
		 */
		wp_enqueue_script( 'pods-extend-scripts', trailingslashit( PODS_EXTEND_URL ) . 'js/front-end.js', array( ), false, true );


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
	 * @since 0.0.1
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

	/**
	 * Adds an admin tab to Pods editor for all post types
	 *
	 * @param array $tabs The admin tabs
	 * @param object $pod Current Pods Object
	 * @param $addtl_args
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	function pt_tab( $tabs, $pod, $addtl_args ) {
		$tabs[ 'pods-extend' ] = __( 'Pods Extend Options', 'pods-extend' );
		
		return $tabs;
		
	}

	/**
	 * Adds options to Pods editor for post types
	 *
	 * @param array $options All the options
	 * @param object $pod Current Pods object.
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	function pt_options( $options, $pod  ) {

		$options[ 'pods-extend' ] = array(
			'example_boolean' => array(
				'label' => __( 'Enable something?', 'pods-extend' ),
				'help' => __( 'Helpful info about this option that will appear in its help bubble', 'pods-extend' ),
				'type' => 'boolean',
				'default' => true,
				'boolean_yes_label' => 'Yes'
			),
			'example_text' => array(
				'label' => __( 'Enter some text', 'pods-extend' ),
				'help' => __( 'Helpful info about this option that will appear in its help bubble', 'pods-extend' ),
				'type' => 'text',
				'default' => 'Default text',
			),
			'dependency_example' => array(
				'label' => __( 'Dependency Example', 'pods-extend' ),
				'help' => __( 'When set to true, this field reveals the field "dependent_example".', 'pods' ),
				'type' => 'boolean',
				'default' => false,
				'dependency' => true,
				'boolean_yes_label' => ''
			),
				'dependent_example' => array(
				'label' => __( 'Dependent Option', 'pods-extend' ),
				'help' => __( 'This field is hidden unless the field "dependency_example" is set to true.', 'pods' ),
				'type' => 'text',
				'depends-on' => array( 'dependency_example' => true )
			)

		);
		
		return $options;
		
	}

	/**
	 * Adds a sub menu page to the Pods admin
	 *
	 * @param array $admin_menus The submenu items in Pods Admin menu.
	 *
	 * @return mixed
	 *
	 * @since 0.0.1
	 */
	function add_menu( $admin_menus ) {
		$admin_menus[ 'pods_extend'] = array(
			'label' => __( 'Pods Extend', 'pods-extend' ),
			'function' => array( $this, 'menu_page' ),
			'access' => 'manage_options'

		);
		
		return $admin_menus;
		
	}

	/**
	 * This is the callback for the menu page. Be sure to create some actual functionality!
	 *
	 * @since 0.0.1
	 */
	function menu_page() {
		echo '<h3>Pods Extend</h3>';

	}


} // Pods_Extend

/**
 * Initialize class, if Pods is active.
 *
 * @since 0.0.1
 */
add_action( 'plugins_loaded', 'pods_extend_safe_activate');
function pods_extend_safe_activate() {
	if ( defined( 'PODS_VERSION' ) ) {
		$GLOBALS[ 'Pods_Extend' ] = Pods_Extend::init();
	}

}


/**
 * Throw admin nag if Pods isn't activated.
 *
 * Will only show on the plugins page.
 *
 * @since 0.0.1
 */
add_action( 'admin_notices', 'pods_extend_admin_notice_pods_not_active' );
function pods_extend_admin_notice_pods_not_active() {

	if ( ! defined( 'PODS_VERSION' ) ) {

		//use the global pagenow so we can tell if we are on plugins admin page
		global $pagenow;
		if ( $pagenow == 'plugins.php' ) {
			?>
			<div class="updated">
				<p><?php _e( 'You have activated Pods Extend, but not the core Pods plugin.', 'pods_extend' ); ?></p>
			</div>
		<?php

		} //endif on the right page
	} //endif Pods is not active

}

/**
 * Throw admin nag if Pods minimum version is not met
 *
 * Will only show on the Pods admin page
 *
 * @since 0.0.1
 */
add_action( 'admin_notices', 'pods_extend_admin_notice_pods_min_version_fail' );
function pods_extend_admin_notice_pods_min_version_fail() {

	if ( defined( 'PODS_VERSION' ) ) {

		//set minimum supported version of Pods.
		$minimum_version = '2.3.18';

		//check if Pods version is greater than or equal to minimum supported version for this plugin
		if ( version_compare(  $minimum_version, PODS_VERSION ) >= 0) {

			//create $page variable to check if we are on pods admin page
			$page = pods_v('page','get', false, true );

			//check if we are on Pods Admin page
			if ( $page === 'pods' ) {
				?>
				<div class="updated">
					<p><?php _e( 'Pods Extend, requires Pods version '.$minimum_version.' or later. Current version of Pods is '.PODS_VERSION, 'pods_extend' ); ?></p>
				</div>
			<?php

			} //endif on the right page
		} //endif version compare
	} //endif Pods is not active

}
