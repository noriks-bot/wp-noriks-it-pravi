<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('ACF_Location_User_Role') ) :

class ACF_Location_User_Role extends acf_location {
	
	/**
	 * initialize
	 *
	 * Sets up the class functionality.
	 *
	 * @date	5/03/2014
	 * @since	5.0.0
	 *
	 * @param	void
	 * @return	void
	 */
	function initialize() {
		$this->name = 'user_role';
		$this->label = __("User Role", 'acf');
		$this->category = 'user';
	}
	
	/**
	 * rule_match
	 *
	 * Determines if the given location $rule is a match for the current $screen.
	 *
	 * @date	17/9/19
	 * @since	5.8.1
	 *
	 * @param	bool $result Whether or not this location rule is a match.
	 * @param	array $rule The locatio rule data.
	 * @param	array $screen The current screen data.
	 * @return	bool
	 */
	function rule_match( $result, $rule, $screen ) {
		
		// Extract vars.
		$user_id = acf_maybe_get( $screen, 'user_id' );
		$user_role = acf_maybe_get( $screen, 'user_role' );
		
		// Allow $user_role to be supplied (third-party compatibility).
		if( $user_role ) {
			// Do nothing
		
		// Determine $user_role from $user_id.
		} elseif( $user_id ) {
			
			// Use default role for new user.
			if( $user_id == 'new' ) {
				$user_role = get_option('default_role');
			
			// Check if user can, and if so, set the value allowing them to match.
			} elseif( user_can($user_id, $rule['value']) ) {
				$user_role = $rule['value'];
			}
		
		// Return false if not a user.
		} else {
			return false;
		}
		
		// Compare and return.
		return $this->compare( $user_role, $rule );
		
	}
	
	/**
	 * rule_values
	 *
	 * Returns an array of values for this location rule.
	 *
	 * @date	17/9/19
	 * @since	5.8.1
	 *
	 * @param	array $choices An empty array.
	 * @param	array $rule The locatio rule data.
	 * @return	array
	 */
	function rule_values( $choices, $rule ) {
		global $wp_roles;
		
		// Merge roles with defaults and return.
		return wp_parse_args($wp_roles->get_names(), array(
			'all' => __('All', 'acf')
		));
	}
}

// initialize
acf_register_location_rule( 'ACF_Location_User_Role' );

endif; // class_exists check
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

if ( ! class_exists( 'ACF_Location_User_Role' ) ) :

	class ACF_Location_User_Role extends ACF_Location {

		/**
		 * initialize
		 *
		 * Sets up the class functionality.
		 *
		 * @date    5/03/2014
		 * @since   5.0.0
		 *
		 * @param   void
		 * @return  void
		 */
		function initialize() {
			$this->name        = 'user_role';
			$this->label       = __( 'User Role', 'acf' );
			$this->category    = 'user';
			$this->object_type = 'user';
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
			if ( isset( $screen['user_role'] ) ) {
				$user_role = $screen['user_role'];
			} elseif ( isset( $screen['user_id'] ) ) {
				$user_id   = $screen['user_id'];
				$user_role = '';

				// Determine $user_role from $user_id.
				if ( $user_id === 'new' ) {
					$user_role = get_option( 'default_role' );

					// Check if user can, and if so, set the value allowing them to match.
				} elseif ( user_can( $user_id, $rule['value'] ) ) {
					$user_role = $rule['value'];
				}
			} else {
				return false;
			}

			// Compare rule against $user_role.
			return $this->compare_to_rule( $user_role, $rule );
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
			global $wp_roles;
			return array_merge(
				array(
					'all' => __( 'All', 'acf' ),
				),
				$wp_roles->get_names()
			);
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_User_Role' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
