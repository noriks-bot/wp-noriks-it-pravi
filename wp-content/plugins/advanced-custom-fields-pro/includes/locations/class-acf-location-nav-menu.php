<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_nav_menu') ) :

class acf_location_nav_menu extends acf_location {
	
	
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
		$this->name = 'nav_menu';
		$this->label = __("Menu",'acf');
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
		$nav_menu = acf_maybe_get( $screen, 'nav_menu' );
		
		
		// bail early if not nav_menu
		if( !$nav_menu ) return false;
		
		
		// location
		if( substr($rule['value'], 0, 9) === 'location/' ) {
			
			// vars
			$location = substr($rule['value'], 9);
			$menu_locations = get_nav_menu_locations();
			
			
			// bail ealry if no location
			if( !isset($menu_locations[$location]) ) return false;
			
			
			// if location matches, update value
			if( $menu_locations[$location] == $nav_menu ) {
				
				$nav_menu = $rule['value'];
				
			}
			
		}
		
		
        // return
        return $this->compare( $nav_menu, $rule );
		
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
		
		// all
		$choices = array(
			'all' => __('All', 'acf'),
		);
		
		
		// locations
		$nav_locations = get_registered_nav_menus();
		if( !empty($nav_locations) ) {
			$cat = __('Menu Locations', 'acf');
			foreach( $nav_locations as $slug => $title ) {
				$choices[ $cat ][ 'location/'.$slug ] = $title;
			}
		}
		
		
		// specific menus
		$nav_menus = wp_get_nav_menus();
		if( !empty($nav_menus) ) {
			$cat = __('Menus', 'acf');
			foreach( $nav_menus as $nav_menu ) {
				$choices[ $cat ][ $nav_menu->term_id ] = $nav_menu->name;
			}
		}
				
		
		// return
		return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_nav_menu' );

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

if ( ! class_exists( 'ACF_Location_Nav_Menu' ) ) :

	class ACF_Location_Nav_Menu extends ACF_Location {

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
			$this->name        = 'nav_menu';
			$this->label       = __( 'Menu', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'menu';
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
			if ( isset( $screen['nav_menu'] ) ) {
				$nav_menu = $screen['nav_menu'];
			} else {
				return false;
			}

			// Allow for "location/xxx" rule value.
			$bits = explode( '/', $rule['value'] );
			if ( $bits[0] === 'location' ) {
				$location = $bits[1];

				// Get the map of menu locations [location => menu_id] and update $nav_menu to a location value.
				$menu_locations = get_nav_menu_locations();
				if ( isset( $menu_locations[ $location ] ) ) {
					$rule['value'] = $menu_locations[ $location ];
				}
			}

			// Compare rule against $nav_menu.
			return $this->compare_to_rule( $nav_menu, $rule );
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
			$choices = array(
				'all' => __( 'All', 'acf' ),
			);

			// Append locations.
			$nav_locations = get_registered_nav_menus();
			if ( $nav_locations ) {
				$cat = __( 'Menu Locations', 'acf' );
				foreach ( $nav_locations as $slug => $title ) {
					$choices[ $cat ][ "location/$slug" ] = $title;
				}
			}

			// Append menu IDs.
			$nav_menus = wp_get_nav_menus();
			if ( $nav_menus ) {
				$cat = __( 'Menus', 'acf' );
				foreach ( $nav_menus as $nav_menu ) {
					$choices[ $cat ][ $nav_menu->term_id ] = $nav_menu->name;
				}
			}

			// Return choices.
			return $choices;
		}
	}

	// Register.
	acf_register_location_type( 'ACF_Location_Nav_Menu' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
