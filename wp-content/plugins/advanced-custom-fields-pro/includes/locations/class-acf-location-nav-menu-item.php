<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_nav_menu_item') ) :

class acf_location_nav_menu_item extends acf_location {
	
	
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
		$this->name = 'nav_menu_item';
		$this->label = __("Menu Item",'acf');
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
		
		// vars
		$nav_menu_item = acf_maybe_get( $screen, 'nav_menu_item' );
		
		
		// bail early if not nav_menu_item
		if( !$nav_menu_item ) return false;
		
		
		// append nav_menu data
		if( !isset($screen['nav_menu']) ) {
			$screen['nav_menu'] = acf_get_data('nav_menu_id');
		}
		
		
        // return
        return acf_get_location_rule('nav_menu')->rule_match( $result, $rule, $screen );
		
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
		
		// get menu choices
		$choices = acf_get_location_rule('nav_menu')->rule_values( $choices, $rule );
		
		
		// append item types?
		// dificult to get these details
			
		
		// return
		return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_nav_menu_item' );

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

if ( ! class_exists( 'ACF_Location_Nav_Menu_Item' ) ) :

	class ACF_Location_Nav_Menu_Item extends ACF_Location {

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
			$this->name        = 'nav_menu_item';
			$this->label       = __( 'Menu Item', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'menu_item';
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
			if ( isset( $screen['nav_menu_item'] ) ) {
				$nav_menu_item = $screen['nav_menu_item'];
			} else {
				return false;
			}

			// Append "nav_menu" global data to $screen and call 'nav_menu' logic.
			if ( ! isset( $screen['nav_menu'] ) ) {
				$screen['nav_menu'] = acf_get_data( 'nav_menu_id' );
			}
			return acf_get_location_type( 'nav_menu' )->match( $rule, $screen, $field_group );
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
			return acf_get_location_type( 'nav_menu' )->get_values( $rule );
		}
	}

	// Register.
	acf_register_location_type( 'ACF_Location_Nav_Menu_Item' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
