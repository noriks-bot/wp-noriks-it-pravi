<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_post_taxonomy') ) :

class acf_location_post_taxonomy extends acf_location {
	
	
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
		$this->name = 'post_taxonomy';
		$this->label = __("Post Taxonomy",'acf');
		$this->category = 'post';
    	
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
		$post_terms = acf_maybe_get( $screen, 'post_terms' );
		
		// Allow compatibility for attachments.
		if( !$post_id ) {
			$post_id = acf_maybe_get( $screen, 'attachment_id' );
		}
		
		// bail early if not a post
		if( !$post_id ) return false;
		
		// get selected term from rule
		$term = acf_get_term( $rule['value'] );
		
		// bail early if no term
		if( !$term || is_wp_error($term) ) return false;
		
		// if ajax, find the terms for the correct category
		if( $post_terms !== null ) {
			$post_terms = acf_maybe_get( $post_terms, $term->taxonomy, array() );
		
		// if not ajax, load post's terms
		} else {
			$post_terms = wp_get_post_terms( $post_id, $term->taxonomy, array('fields' => 'ids') );
		}
		
		// If no terms, this is a new post and should be treated as if it has the "Uncategorized" (1) category ticked
		if( !$post_terms && $term->taxonomy == 'category' ) {
			$post_terms = array( 1 );
		}
		
		// compare term IDs and slugs
		if( in_array($term->term_id, $post_terms) || in_array($term->slug, $post_terms) ) {
			$result = true;
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
		
		// get
		$choices = acf_get_taxonomy_terms();
		
			
		// unset post_format
		if( isset($choices['post_format']) ) {
		
			unset( $choices['post_format']) ;
			
		}
		
		
		// return
		return $choices;
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_post_taxonomy' );

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

if ( ! class_exists( 'ACF_Location_Post_Taxonomy' ) ) :

	class ACF_Location_Post_Taxonomy extends ACF_Location {

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
			$this->name        = 'post_taxonomy';
			$this->label       = __( 'Post Taxonomy', 'acf' );
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
			if ( isset( $screen['post_id'] ) ) {
				$post_id = $screen['post_id'];
			} elseif ( isset( $screen['attachment_id'] ) ) {
				$post_id = $screen['attachment_id'];
			} else {
				return false;
			}

			// Get WP_Term from rule value.
			$term = acf_get_term( $rule['value'] );
			if ( ! $term || is_wp_error( $term ) ) {
				return false;
			}

			// Get terms connected to post.
			if ( isset( $screen['post_terms'] ) ) {
				$post_terms = acf_maybe_get( $screen['post_terms'], $term->taxonomy, array() );
			} else {
				$post_terms = wp_get_post_terms( $post_id, $term->taxonomy, array( 'fields' => 'ids' ) );
			}

			// If no post terms are found, and we are dealing with the "category" taxonomy, treat as default "Uncategorized" category.
			if ( ! $post_terms && $term->taxonomy == 'category' ) {
				$post_terms = array( 1 );
			}

			// Search $post_terms for a match.
			$result = ( in_array( $term->term_id, $post_terms ) || in_array( $term->slug, $post_terms ) );

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
			return acf_get_taxonomy_terms();
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
				$term = acf_decode_term( $rule['value'] );
				if ( $term ) {
					$taxonomy = get_taxonomy( $term['taxonomy'] );
					if ( $taxonomy ) {
						return $taxonomy->object_type;
					}
				}
			}
			return '';
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Post_Taxonomy' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
