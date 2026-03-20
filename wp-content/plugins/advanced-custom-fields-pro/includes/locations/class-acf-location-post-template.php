<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_post_template') ) :

class acf_location_post_template extends acf_location {
	
	
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
		$this->name = 'post_template';
		$this->label = __("Post Template",'acf');
		$this->category = 'post';
		$this->public = acf_version_compare('wp', '>=', '4.7');
    	
	}
	
	
	/*
	*  get_post_type
	*
	*  This function will return the current post_type
	*
	*  @type	function
	*  @date	25/11/16
	*  @since	5.5.0
	*
	*  @param	$options (int)
	*  @return	(mixed)
	*/
	
	function get_post_type( $screen ) {
		
		// vars
		$post_id = acf_maybe_get( $screen, 'post_id' );
		$post_type = acf_maybe_get( $screen, 'post_type' );
		
		
		// post_type
		if( $post_type ) return $post_type;
		
		
		// $post_id
		if( $post_id ) return get_post_type( $post_id );
		
		
		// return
		return false;
		
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
		
		// Check if this rule is relevant to the current screen.
		// Find $post_id in the process.
		if( isset($screen['post_type']) ) {
			$post_type = $screen['post_type'];
		} elseif( isset($screen['post_id']) ) {
			$post_type = get_post_type( $screen['post_id'] );
		} else {
			return false;
		}
		
		// Check if this post type has templates.
		$post_templates = acf_get_post_templates();
		if( !isset($post_templates[ $post_type ]) ) {
			return false;
		}
		
		// get page template allowing for screen or database value.
		$page_template = acf_maybe_get( $screen, 'page_template' );
		$post_id = acf_maybe_get( $screen, 'post_id' );
		if( $page_template === null ) {
			$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		}
		
		// Treat empty value as default template.
		if( $page_template === '' ) {
			$page_template = 'default';
		}
		
		// Compare.
		return $this->compare( $page_template, $rule );
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
		
		// Default choices.
		$choices = array(
			'default' => apply_filters( 'default_page_template_title',  __('Default Template', 'acf') )
		);
		
		// Merge in all post templates.
		$post_templates = acf_get_post_templates();
		$choices = array_merge($choices, $post_templates);
				
		// Return choices.
		return $choices;
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_post_template' );

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

if ( ! class_exists( 'ACF_Location_Post_Template' ) ) :

	class ACF_Location_Post_Template extends ACF_Location {

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
			$this->name        = 'post_template';
			$this->label       = __( 'Post Template', 'acf' );
			$this->category    = 'post';
			$this->object_type = 'post';
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
			if ( isset( $screen['post_type'] ) ) {
				$post_type = $screen['post_type'];
			} elseif ( isset( $screen['post_id'] ) ) {
				$post_type = get_post_type( $screen['post_id'] );
			} else {
				return false;
			}

			// Check if this post type has templates.
			$post_templates = acf_get_post_templates();
			if ( ! isset( $post_templates[ $post_type ] ) ) {
				return false;
			}

			// Get page template allowing for screen or database value.
			if ( isset( $screen['page_template'] ) ) {
				$page_template = $screen['page_template'];
			} elseif ( isset( $screen['post_id'] ) ) {
				$page_template = get_post_meta( $screen['post_id'], '_wp_page_template', true );
			} else {
				$page_template = '';
			}

			// Treat empty value as default template.
			if ( $page_template === '' ) {
				$page_template = 'default';
			}

			// Compare rule against $page_template.
			return $this->compare_to_rule( $page_template, $rule );
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
					'default' => apply_filters( 'default_page_template_title', __( 'Default Template', 'acf' ), 'meta-box' ),
				),
				acf_get_post_templates()
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
		public function get_object_subtype( $rule ) {
			if ( $rule['operator'] === '==' ) {
				$post_templates = acf_get_post_templates();

				// If "default", return array of all post types which have templates.
				if ( $rule['value'] === 'default' ) {
					return array_keys( $post_templates );

					// Otherwise, generate list of post types that have the selected template.
				} else {
					$post_types = array();
					foreach ( $post_templates as $post_type => $templates ) {
						if ( isset( $templates[ $rule['value'] ] ) ) {
							$post_types[] = $post_type;
						}
					}
					return $post_types;
				}
			}
			return '';
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Post_Template' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
