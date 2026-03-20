<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_widget') ) :

class acf_location_widget extends acf_location {
	
	
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
		$this->name = 'widget';
		$this->label = __("Widget",'acf');
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
		$widget = acf_maybe_get( $screen, 'widget' );
		
		
		// bail early if not widget
		if( !$widget ) return false;
				
		
        // return
        return $this->compare( $widget, $rule );
		
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
		global $wp_widget_factory;
		
		
		// vars
		$choices = array( 'all' => __('All', 'acf') );
		
		
		// loop
		if( !empty( $wp_widget_factory->widgets ) ) {
					
			foreach( $wp_widget_factory->widgets as $widget ) {
			
				$choices[ $widget->id_base ] = $widget->name;
				
			}
			
		}
				
		
		// return
		return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_widget' );

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

if ( ! class_exists( 'ACF_Location_Widget' ) ) :

	class ACF_Location_Widget extends ACF_Location {

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
			$this->name        = 'widget';
			$this->label       = __( 'Widget', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'widget';
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
			if ( isset( $screen['widget'] ) ) {
				$widget = $screen['widget'];
			} else {
				return false;
			}

			// Compare rule against $widget.
			return $this->compare_to_rule( $widget, $rule );
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
			global $wp_widget_factory;

			// Populate choices.
			$choices = array(
				'all' => __( 'All', 'acf' ),
			);
			if ( $wp_widget_factory->widgets ) {
				foreach ( $wp_widget_factory->widgets as $widget ) {
					$choices[ $widget->id_base ] = $widget->name;
				}
			}
			return $choices;
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Widget' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
