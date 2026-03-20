<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_options_page') ) :

class acf_location_options_page extends acf_location {
	
	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function initialize() {
		
		// vars
		$this->name = 'options_page';
		$this->label = __("Options Page",'acf');
		$this->category = 'forms';
    	
	}
	
	
	/*
	*  rule_match
	*
	*  This function is used to match this location $rule to the current $screen
	*
	*  @type	function
	*  @date	3/01/13
	*  @since	3.5.7
	*
	*  @param	$match (boolean) 
	*  @param	$rule (array)
	*  @return	$options (array)
	*/
	
	function rule_match( $result, $rule, $screen ) {
		
		$options_page = acf_maybe_get( $screen, 'options_page' );
		return $this->compare( $options_page, $rule );
		
	}
	
	
	/*
	*  rule_operators
	*
	*  This function returns the available values for this rule type
	*
	*  @type	function
	*  @date	30/5/17
	*  @since	5.6.0
	*
	*  @param	n/a
	*  @return	(array)
	*/
	
	function rule_values( $choices, $rule ) {
		
		// vars
		$pages = acf_get_options_pages();
		
		
		// populate
		if( !empty($pages) ) {
			foreach( $pages as $page ) {
				$choices[ $page['menu_slug'] ] = $page['page_title'];
			}
		} else {
			$choices[''] = __('No options pages exist', 'acf');
		}
		
		
		// return
	    return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_options_page' );

endif; // class_exists check

?>
=======
<?php
/**
 * @package ACF
 * @author  WP Engine
 *
 * © 2025 Advanced Custom Fields (ACF®). All rights reserved.
 * "ACF" is a trademark of WP Engine.
 * Licensed under the GNU General Public License v2 or later.
 * https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ACF_Location_Options_Page' ) ) :

	class ACF_Location_Options_Page extends ACF_Location {

		/**
		 * Initializes props.
		 *
		 * @date    5/03/2014
		 * @since   5.0.0
		 *
		 * @param   void
		 * @return  void
		 */
		public function initialize() {
			$this->name        = 'options_page';
			$this->label       = __( 'Options Page', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'option';
		}

		/**
		 * Matches the provided rule against the screen args returning a bool result.
		 *
		 * @date    9/4/20
		 * @since   5.9.0
		 *
		 * @param   array $rule        The location rule.
		 * @param   array $screen      The screen args.
		 * @param   array $field_group The field group settings.
		 * @return  boolean
		 */
		public function match( $rule, $screen, $field_group ) {

			// Check screen args.
			if ( isset( $screen['options_page'] ) ) {
				$options_page = $screen['options_page'];
			} else {
				return false;
			}

			// Compare rule against $nav_menu.
			return $this->compare_to_rule( $options_page, $rule );
		}

		/**
		 * Returns an array of possible values for this rule type.
		 *
		 * @date    9/4/20
		 * @since   5.9.0
		 *
		 * @param   array $rule A location rule.
		 * @return  array
		 */
		public function get_values( $rule ) {
			$choices = array();

			// Append pages.
			$pages = acf_get_options_pages();
			if ( $pages ) {
				foreach ( $pages as $page ) {
					$choices[ $page['menu_slug'] ] = $page['page_title'];
				}
			} else {
				$choices[''] = __( 'Select options page...', 'acf' );
			}

			if ( acf_get_setting( 'enable_options_pages_ui' ) ) {
				$choices['add_new_options_page'] = __( 'Add New Options Page', 'acf' );
			}

			// Return choices.
			return $choices;
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Options_Page' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
