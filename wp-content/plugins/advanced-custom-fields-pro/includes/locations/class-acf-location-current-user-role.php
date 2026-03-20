<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_current_user_role') ) :

class acf_location_current_user_role extends acf_location {
	
	
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
		$this->name = 'current_user_role';
		$this->label = __("Current User Role",'acf');
		$this->category = 'user';
    	
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
		
		// bail early if not logged in
		if( !is_user_logged_in() ) return false;
		
		
		// vars
		$user = wp_get_current_user();
		
		
		// super_admin
		if( $rule['value'] == 'super_admin' ) {
			
			$result = is_super_admin( $user->ID );
			
		// role
		} else {
			
			$result = in_array( $rule['value'], $user->roles );
			
		}
		
		
		// reverse if 'not equal to'
        if( $rule['operator'] == '!=' ) {
	        	
        	$result = !$result;
        
        }
		
		
        // return
        return $result;
        
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
		
		// global
		global $wp_roles;
		
		
		// specific roles
		$choices = $wp_roles->get_names();
		
		
		// multi-site
		if( is_multisite() ) {
			
			$prepend = array( 'super_admin' => __('Super Admin', 'acf') );
			$choices = array_merge( $prepend, $choices );
			
		}
		
		
		// return
		return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_current_user_role' );

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

if ( ! class_exists( 'ACF_Location_Current_User_Role' ) ) :

	class ACF_Location_Current_User_Role extends ACF_Location {

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
			$this->name     = 'current_user_role';
			$this->label    = __( 'Current User Role', 'acf' );
			$this->category = 'user';
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

			// Get current user.
			$user = wp_get_current_user();
			if ( ! $user ) {
				return false;
			}

			// Check super_admin value.
			if ( $rule['value'] == 'super_admin' ) {
				$result = is_super_admin( $user->ID );

				// Check role.
			} else {
				$result = in_array( $rule['value'], $user->roles );
			}

			// Reverse result for "!=" operator.
			if ( $rule['operator'] === '!=' ) {
				return ! $result;
			}
			return $result;
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
			$choices = wp_roles()->get_names();

			// Prepend Super Admin choice.
			if ( is_multisite() ) {
				return array_merge(
					array(
						'super_admin' => __( 'Super Admin', 'acf' ),
					),
					$choices
				);
			}
			return $choices;
		}
	}

	// Register.
	acf_register_location_type( 'ACF_Location_Current_User_Role' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
