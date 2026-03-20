<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_taxonomy') ) :

class acf_location_taxonomy extends acf_location {
	
	
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
		$this->name = 'taxonomy';
		$this->label = __("Taxonomy",'acf');
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
		$taxonomy = acf_maybe_get( $screen, 'taxonomy' );
		
		
		// bail early if not taxonomy
		if( !$taxonomy ) return false;
				
		
        // return
        return $this->compare( $taxonomy, $rule );
		
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
		$choices = array( 'all' => __('All', 'acf') );
		$choices = array_merge( $choices, acf_get_taxonomy_labels() );
		
		
		// return
		return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_taxonomy' );

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

if ( ! class_exists( 'ACF_Location_Taxonomy' ) ) :

	class ACF_Location_Taxonomy extends ACF_Location {

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
			$this->name        = 'taxonomy';
			$this->label       = __( 'Taxonomy', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'term';
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
			if ( isset( $screen['taxonomy'] ) ) {
				$taxonomy = $screen['taxonomy'];
			} else {
				return false;
			}

			// Compare rule against $taxonomy.
			return $this->compare_to_rule( $taxonomy, $rule );
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
			return array_merge(
				array(
					'all' => __( 'All', 'acf' ),
				),
				acf_get_taxonomy_labels()
			);
		}

		/**
		 * Returns the object_subtype connected to this location.
		 *
		 * @date    1/4/20
		 * @since   5.9.0
		 *
		 * @param   array $rule A location rule.
		 * @return  string|array
		 */
		function get_object_subtype( $rule ) {
			if ( $rule['operator'] === '==' ) {
				return $rule['value'];
			}
			return '';
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Taxonomy' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
