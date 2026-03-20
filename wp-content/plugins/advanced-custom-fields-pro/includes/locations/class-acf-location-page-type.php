<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_location_page_type') ) :

class acf_location_page_type extends acf_location {
	
	
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
		$this->name = 'page_type';
		$this->label = __("Page Type",'acf');
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
		
		// bail early if no post id
		if( !$post_id ) return false;
		
		// get post
		$post = get_post( $post_id );
		
		// bail early if no post
		if( !$post ) return false;
		
		
		// compare   
        if( $rule['value'] == 'front_page') {
        	
        	// vars
	        $front_page = (int) get_option('page_on_front');
	        
	        
	        // compare
	        $result = ( $front_page === $post->ID );
	        
        } elseif( $rule['value'] == 'posts_page') {
        	
        	// vars
	        $posts_page = (int) get_option('page_for_posts');
	        
	        
	        // compare
	        $result = ( $posts_page === $post->ID );
	        
        } elseif( $rule['value'] == 'top_level') {
        	
        	// vars
        	$page_parent = acf_maybe_get( $screen, 'page_parent', $post->post_parent );
        	
        	
        	// compare
			$result = ( $page_parent == 0 );
	            
        } elseif( $rule['value'] == 'parent' ) {
        	
        	// get children
        	$children = get_posts(array(
        		'post_type' 		=> $post->post_type,
        		'post_parent' 		=> $post->ID,
        		'posts_per_page'	=> 1,
				'fields'			=> 'ids',
        	));
        	
	        
	        // compare
	        $result = !empty( $children );
	        
        } elseif( $rule['value'] == 'child') {
        	
        	// vars
        	$page_parent = acf_maybe_get( $screen, 'page_parent', $post->post_parent );
        	
	        
	        // compare
			$result = ( $page_parent > 0 );
	        
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
			'front_page'	=> __("Front Page",'acf'),
			'posts_page'	=> __("Posts Page",'acf'),
			'top_level'		=> __("Top Level Page (no parent)",'acf'),
			'parent'		=> __("Parent Page (has children)",'acf'),
			'child'			=> __("Child Page (has parent)",'acf'),
		);
		
	}
	
}

// initialize
acf_register_location_rule( 'acf_location_page_type' );

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

if ( ! class_exists( 'ACF_Location_Page_Type' ) ) :

	class ACF_Location_Page_Type extends ACF_Location {

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
			$this->name           = 'page_type';
			$this->label          = __( 'Page Type', 'acf' );
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
			if ( isset( $screen['post_id'] ) ) {
				$post_id = $screen['post_id'];
			} else {
				return false;
			}

			// Get post.
			$post = get_post( $post_id );
			if ( ! $post ) {
				return false;
			}

			// Compare.
			switch ( $rule['value'] ) {
				case 'front_page':
					$front_page = (int) get_option( 'page_on_front' );
					$result     = ( $front_page === $post->ID );
					break;

				case 'posts_page':
					$posts_page = (int) get_option( 'page_for_posts' );
					$result     = ( $posts_page === $post->ID );
					break;

				case 'top_level':
					$page_parent = (int) ( isset( $screen['page_parent'] ) ? $screen['page_parent'] : $post->post_parent );
					$result      = ( $page_parent === 0 );
					break;

				case 'parent':
					$children = get_posts(
						array(
							'post_type'      => $post->post_type,
							'post_parent'    => $post->ID,
							'posts_per_page' => 1,
							'fields'         => 'ids',
						)
					);
					$result   = ! empty( $children );
					break;

				case 'child':
					$page_parent = (int) ( isset( $screen['page_parent'] ) ? $screen['page_parent'] : $post->post_parent );
					$result      = ( $page_parent !== 0 );
					break;

				default:
					return false;
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
				'front_page' => __( 'Front Page', 'acf' ),
				'posts_page' => __( 'Posts Page', 'acf' ),
				'top_level'  => __( 'Top Level Page (no parent)', 'acf' ),
				'parent'     => __( 'Parent Page (has children)', 'acf' ),
				'child'      => __( 'Child Page (has parent)', 'acf' ),
			);
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Page_Type' );
endif; // class_exists check
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
