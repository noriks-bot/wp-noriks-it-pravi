<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_page_parent') ) :

class acf_location_page_parent extends acf_location {
	
	
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
		$this->name = 'page_parent';
		$this->label = __("Page Parent",'acf');
		$this->category = 'page';
    	
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
		$post_id = acf_maybe_get( $screen, 'post_id' );
		$page_parent = acf_maybe_get( $screen, 'page_parent' );
		
		
		// no page parent
		if( $page_parent === null ) {
			
			// bail early if no post id
			if( !$post_id ) return false;
			
			
			// get post parent
			$post = get_post( $post_id );
			$page_parent = $post->post_parent;
			
		}
		
		
		// compare
		return $this->compare( $page_parent, $rule );
        
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
		
		return acf_get_location_rule('page')->rule_values( $choices, $rule );
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_page_parent' );

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

if ( ! class_exists( 'ACF_Location_Page_Parent' ) ) :

	class ACF_Location_Page_Parent extends ACF_Location {

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
			$this->name           = 'page_parent';
			$this->label          = __( 'Page Parent', 'acf' );
			$this->category       = 'page';
			$this->object_type    = 'post';
			$this->object_subtype = 'page';
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
			if ( isset( $screen['page_parent'] ) ) {
				$page_parent = $screen['page_parent'];
			} elseif ( isset( $screen['post_id'] ) ) {
				$post        = get_post( $screen['post_id'] );
				$page_parent = $post ? $post->post_parent : false;
			} else {
				return false;
			}

			// Compare rule against $page_parent.
			return $this->compare_to_rule( $page_parent, $rule );
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
			return acf_get_location_type( 'page' )->get_values( $rule );
		}
	}

	// Register.
	acf_register_location_type( 'ACF_Location_Page_Parent' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
