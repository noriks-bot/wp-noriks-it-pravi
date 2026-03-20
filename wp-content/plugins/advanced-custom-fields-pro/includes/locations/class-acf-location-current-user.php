<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_current_user') ) :

class acf_location_current_user extends acf_location {
	
	
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
		$this->name = 'current_user';
		$this->label = __("Current User",'acf');
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
		
		// logged in
		if( $rule['value'] == 'logged_in' ) {
			
			$result = is_user_logged_in();
			
		// viewing_front
		} elseif( $rule['value'] == 'viewing_front' ) {
			
			$result = !is_admin();
			
		// viewing_back
		} elseif( $rule['value'] == 'viewing_back' ) {
			
			$result = is_admin();
			
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
		
		return array(
			'logged_in'		=> __('Logged in', 'acf'),
			'viewing_front'	=> __('Viewing front end', 'acf'),
			'viewing_back'	=> __('Viewing back end', 'acf')
		);
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_current_user' );

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

if ( ! class_exists( 'ACF_Location_Current_User' ) ) :

	class ACF_Location_Current_User extends ACF_Location {

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
			$this->name     = 'current_user';
			$this->label    = __( 'Current User', 'acf' );
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
			switch ( $rule['value'] ) {
				case 'logged_in':
					$result = is_user_logged_in();
					break;
				case 'viewing_front':
					$result = ! is_admin();
					break;
				case 'viewing_back':
					$result = is_admin();
					break;
				default:
					$result = false;
					break;
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
			return array(
				'logged_in'     => __( 'Logged in', 'acf' ),
				'viewing_front' => __( 'Viewing front end', 'acf' ),
				'viewing_back'  => __( 'Viewing back end', 'acf' ),
			);
		}
	}

	// Register.
	acf_register_location_type( 'ACF_Location_Current_User' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
