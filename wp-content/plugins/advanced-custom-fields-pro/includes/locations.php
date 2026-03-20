<<<<<<< HEAD
<?php 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('acf_locations') ) :

class acf_locations {
	
	
	/** @var array Contains an array of location rule instances */
	var $locations = array();
	
	
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
	
	function __construct() {
		
		/* do nothing */
		
	}
	
	
	/*
	*  register_location
	*
	*  This function will store a location rule class
	*
	*  @type	function
	*  @date	6/07/2016
	*  @since	5.4.0
	*
	*  @param	$instance (object)
	*  @return	n/a
	*/
	
	function register_location( $class ) {
		
		$instance = new $class();
		$this->locations[ $instance->name ] = $instance;
		
	}
	
	
	/*
	*  get_rule
	*
	*  This function will return a location rule class
	*
	*  @type	function
	*  @date	6/07/2016
	*  @since	5.4.0
	*
	*  @param	$name (string)
	*  @return	(mixed)
	*/
	
	function get_location( $name ) {
		
		return isset( $this->locations[$name] ) ? $this->locations[$name] : null;
		
	}
	
		
	/*
	*  get_rules
	*
	*  This function will return a grouped array of location rules (category => name => label)
	*
	*  @type	function
	*  @date	6/07/2016
	*  @since	5.4.0
	*
	*  @param	n/a
	*  @return	(array)
	*/
	
	function get_locations() {
		
		// vars
		$groups = array();
		$l10n = array(
			'post'		=> __('Post', 'acf'),
			'page'		=> __('Page', 'acf'),
			'user'		=> __('User', 'acf'),
			'forms'		=> __('Forms', 'acf'),
		);
		
			
		// loop
		foreach( $this->locations as $location ) {
			
			// bail ealry if not public
			if( !$location->public ) continue;
			
			
			// translate
			$cat = $location->category;
			$cat = isset( $l10n[$cat] ) ? $l10n[$cat] : $cat;
			
			
			// append
			$groups[ $cat ][ $location->name ] = $location->label;
			
		}
		
		
		// filter
		$groups = apply_filters('acf/location/rule_types', $groups);
		
		
		// return
		return $groups;
		
	}
	
}

// initialize
acf()->locations = new acf_locations();

endif; // class_exists check


/*
*  acf_register_location_rule
*
*  alias of acf()->locations->register_location()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	n/a
*  @return	n/a
*/

function acf_register_location_rule( $class ) {
	
	return acf()->locations->register_location( $class );
	
}


/*
*  acf_get_location_rule
*
*  alias of acf()->locations->get_location()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	n/a
*  @return	n/a
*/

function acf_get_location_rule( $name ) {
	
	return acf()->locations->get_location( $name );
	
}


/*
*  acf_get_location_rule_types
*
*  alias of acf()->locations->get_locations()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	n/a
*  @return	n/a
*/

function acf_get_location_rule_types() {
	
	return acf()->locations->get_locations();
	
}


/**
*  acf_validate_location_rule
*
*  Returns a valid location rule array.
*
*  @date	28/8/18
*  @since	5.7.4
*
*  @param	$rule array The rule array.
*  @return	array
*/

function acf_validate_location_rule( $rule = false ) {
	
	// defaults
	$rule = wp_parse_args( $rule, array(
		'id'		=> '',
		'group'		=> '',
		'param'		=> '',
		'operator'	=> '==',
		'value'		=> '',
	));
	
	// filter
	$rule = apply_filters( "acf/location/validate_rule/type={$rule['param']}", $rule );
	$rule = apply_filters( "acf/location/validate_rule", $rule);
	
	// return
	return $rule;
}

/*
*  acf_get_location_rule_operators
*
*  This function will return the operators for a given rule
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	$rule (array)
*  @return	(array)
*/

function acf_get_location_rule_operators( $rule ) {
	
	// vars
	$operators = array(
		'=='	=> __("is equal to",'acf'),
		'!='	=> __("is not equal to",'acf'),
	);
	
	
	// filter
	$operators = apply_filters( "acf/location/rule_operators/type={$rule['param']}", $operators, $rule );
	$operators = apply_filters( "acf/location/rule_operators/{$rule['param']}", $operators, $rule );
	$operators = apply_filters( "acf/location/rule_operators", $operators, $rule );
	
	
	// return
	return $operators;
	
}


/*
*  acf_get_location_rule_values
*
*  This function will return the values for a given rule 
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	$rule (array)
*  @return	(array)
*/

function acf_get_location_rule_values( $rule ) {
	
	// vars
	$values = array();
	
	
	// filter
	$values = apply_filters( "acf/location/rule_values/type={$rule['param']}", $values, $rule );
	$values = apply_filters( "acf/location/rule_values/{$rule['param']}", $values, $rule );
	$values = apply_filters( "acf/location/rule_values", $values, $rule );
	
	
	// return
	return $values;
	
}


/*
*  acf_match_location_rule
*
*  This function will match a given rule to the $screen
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	$rule (array)
*  @param	$screen (array)
*  @return	(boolean)
*/

function acf_match_location_rule( $rule, $screen, $field_group ) {
	
	// vars
	$result = false;
	
	
	// filter
	$result = apply_filters( "acf/location/match_rule/type={$rule['param']}", $result, $rule, $screen, $field_group );
	$result = apply_filters( "acf/location/match_rule", $result, $rule, $screen, $field_group );
	$result = apply_filters( "acf/location/rule_match/{$rule['param']}", $result, $rule, $screen, $field_group );
	$result = apply_filters( "acf/location/rule_match", $result, $rule, $screen, $field_group );
	
	
	// return
	return $result;
	
}


/*
*  acf_get_location_screen
*
*  This function will return a valid location screen array
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	$screen (array)
*  @param	$field_group (array)
*  @return	(array)
*/

function acf_get_location_screen( $screen = array(), $field_group = false ) {
	
	// vars
	$screen = wp_parse_args($screen, array(
		'lang'	=> acf_get_setting('current_language'),
		'ajax'	=> false
	));
	
	
	// filter for 3rd party customization
	$screen = apply_filters('acf/location/screen', $screen, $field_group);
	
	
	// return
	return $screen;
	
}

/**
*  acf_get_valid_location_rule
*
*  Deprecated in 5.7.4. Use acf_validate_location_rule() instead.
*
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	$rule array The rule array.
*  @return	array
*/

function acf_get_valid_location_rule( $rule ) {
	return acf_validate_location_rule( $rule );
}

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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register store.
acf_register_store( 'location-types' );

/**
 * Registers a location type.
 *
 * @date    8/4/20
 * @since   5.9.0
 *
 * @param   string $class_name The location class name.
 * @return  (ACF_Location|false)
 */
function acf_register_location_type( $class_name ) {
	$store = acf_get_store( 'location-types' );

	// Check class exists.
	if ( ! class_exists( $class_name ) ) {
		/* translators: %s class name for a location that could not be found */
		$message = sprintf( __( 'Class "%s" does not exist.', 'acf' ), $class_name );
		_doing_it_wrong( __FUNCTION__, esc_html( $message ), '5.9.0' );
		return false;
	}

	// Create instance.
	$location_type = new $class_name();
	$name          = $location_type->name;

	// Check location type is unique.
	if ( $store->has( $name ) ) {
		/* translators: %s the name of the location type */
		$message = sprintf( __( 'Location type "%s" is already registered.', 'acf' ), $name );
		_doing_it_wrong( __FUNCTION__, esc_html( $message ), '5.9.0' );
		return false;
	}

	// Add to store.
	$store->set( $name, $location_type );

	/**
	 * Fires after a location type is registered.
	 *
	 * @date    8/4/20
	 * @since   5.9.0
	 *
	 * @param   string $name The location type name.
	 * @param   ACF_Location $location_type The location type instance.
	 */
	do_action( 'acf/registered_location_type', $name, $location_type );

	// Return location type instance.
	return $location_type;
}

/**
 * Returns an array of all registered location types.
 *
 * @date    8/4/20
 * @since   5.9.0
 *
 * @param   void
 * @return  array
 */
function acf_get_location_types() {
	return acf_get_store( 'location-types' )->get();
}

/**
 * Returns a location type for the given name.
 *
 * @date    18/2/19
 * @since   5.7.12
 *
 * @param   string $name The location type name.
 * @return  (ACF_Location|null)
 */
function acf_get_location_type( $name ) {
	return acf_get_store( 'location-types' )->get( $name );
}

/**
 * Returns a grouped array of all location rule types.
 *
 * @date    8/4/20
 * @since   5.9.0
 *
 * @param   void
 * @return  array
 */
function acf_get_location_rule_types() {
	$types = array();

	// Default categories.
	$categories = array(
		'post'  => __( 'Post', 'acf' ),
		'page'  => __( 'Page', 'acf' ),
		'user'  => __( 'User', 'acf' ),
		'forms' => __( 'Forms', 'acf' ),
	);

	// Loop over all location types and append to $type.
	$location_types = acf_get_location_types();
	foreach ( $location_types as $location_type ) {

		// Ignore if not public.
		if ( ! $location_type->public ) {
			continue;
		}

		// Find category label from category name.
		$category = $location_type->category;
		if ( isset( $categories[ $category ] ) ) {
			$category = $categories[ $category ];
		}

		// Append
		$types[ $category ][ $location_type->name ] = esc_html( $location_type->label );
	}

	/**
	 * Filters the location rule types.
	 *
	 * @date    8/4/20
	 * @since   5.9.0
	 *
	 * @param   array $types The location rule types.
	 */
	return apply_filters( 'acf/location/rule_types', $types );
}

/**
 * Returns a validated location rule with all props.
 *
 * @date    8/4/20
 * @since   5.9.0
 *
 * @param   array $rule The location rule.
 * @return  array
 */
function acf_validate_location_rule( $rule = array() ) {

	// Apply defaults.
	$rule = wp_parse_args(
		$rule,
		array(
			'id'       => '',
			'group'    => '',
			'param'    => '',
			'operator' => '==',
			'value'    => '',
		)
	);

	/**
	 * Filters the location rule to ensure is valid.
	 *
	 * @date    8/4/20
	 * @since   5.9.0
	 *
	 * @param   array $rule The location rule.
	 */
	$rule = apply_filters( "acf/location/validate_rule/type={$rule['param']}", $rule );
	$rule = apply_filters( 'acf/location/validate_rule', $rule );
	return $rule;
}

/**
 * Returns an array of operators for a given rule.
 *
 * @date    30/5/17
 * @since   5.6.0
 *
 * @param   array $rule The location rule.
 * @return  array
 */
function acf_get_location_rule_operators( $rule ) {
	$operators = ACF_Location::get_operators( $rule );

	// Get operators from location type since 5.9.
	$location_type = acf_get_location_type( $rule['param'] );
	if ( $location_type ) {
		$operators = $location_type->get_operators( $rule );
	}

	/**
	 * Filters the location rule operators.
	 *
	 * @date    30/5/17
	 * @since   5.6.0
	 *
	 * @param   array $types The location rule operators.
	 */
	$operators = apply_filters( "acf/location/rule_operators/type={$rule['param']}", $operators, $rule );
	$operators = apply_filters( "acf/location/rule_operators/{$rule['param']}", $operators, $rule );
	$operators = apply_filters( 'acf/location/rule_operators', $operators, $rule );
	return $operators;
}

/**
 * Returns an array of values for a given rule.
 *
 * @date    30/5/17
 * @since   5.6.0
 *
 * @param   array $rule The location rule.
 * @return  array
 */
function acf_get_location_rule_values( $rule ) {
	$values = array();

	// Get values from location type since 5.9.
	$location_type = acf_get_location_type( $rule['param'] );
	if ( $location_type ) {
		$values = $location_type->get_values( $rule );
	}

	/**
	 * Filters the location rule values.
	 *
	 * @date    30/5/17
	 * @since   5.6.0
	 *
	 * @param   array $types The location rule values.
	 */
	$values = apply_filters( "acf/location/rule_values/type={$rule['param']}", $values, $rule );
	$values = apply_filters( "acf/location/rule_values/{$rule['param']}", $values, $rule );
	$values = apply_filters( 'acf/location/rule_values', $values, $rule );
	return $values;
}

/**
 * Returns true if the provided rule matches the screen args.
 *
 * @date    30/5/17
 * @since   5.6.0
 *
 * @param   array $rule   The location rule.
 * @param   array $screen The screen args.
 * @param   array $field  The field group array.
 * @return  boolean
 */
function acf_match_location_rule( $rule, $screen, $field_group ) {
	$result = false;

	// Get result from location type since 5.9.
	$location_type = acf_get_location_type( $rule['param'] );
	if ( $location_type ) {
		$result = $location_type->match( $rule, $screen, $field_group );
	}

	/**
	 * Filters the result.
	 *
	 * @date    30/5/17
	 * @since   5.6.0
	 *
	 * @param   bool $result The match result.
	 * @param   array $rule The location rule.
	 * @param   array $screen The screen args.
	 * @param   array $field_group The field group array.
	 */
	$result = apply_filters( "acf/location/match_rule/type={$rule['param']}", $result, $rule, $screen, $field_group );
	$result = apply_filters( 'acf/location/match_rule', $result, $rule, $screen, $field_group );
	$result = apply_filters( "acf/location/rule_match/{$rule['param']}", $result, $rule, $screen, $field_group );
	$result = apply_filters( 'acf/location/rule_match', $result, $rule, $screen, $field_group );
	return $result;
}

/**
 * Returns ann array of screen args to be used against matching rules.
 *
 * @date    8/4/20
 * @since   5.9.0
 *
 * @param   array $screen     The screen args.
 * @param   array $deprecated The field group array.
 * @return  array
 */
function acf_get_location_screen( $screen = array(), $deprecated = false ) {

	// Apply defaults.
	$screen = wp_parse_args(
		$screen,
		array(
			'lang' => acf_get_setting( 'current_language' ),
			'ajax' => false,
		)
	);

	/**
	 * Filters the result.
	 *
	 * @date    30/5/17
	 * @since   5.6.0
	 *
	 * @param   array $screen The screen args.
	 * @param   array $deprecated The field group array.
	 */
	return apply_filters( 'acf/location/screen', $screen, $deprecated );
}

/**
 * Alias of acf_register_location_type().
 *
 * @date    31/5/17
 * @since   5.6.0
 *
 * @param   string $class_name The location class name.
 * @return  (ACF_Location|false)
 */
function acf_register_location_rule( $class_name ) {
	return acf_register_location_type( $class_name );
}

/**
 * Alias of acf_get_location_type().
 *
 * @date    31/5/17
 * @since   5.6.0
 *
 * @param   string $class_name The location class name.
 * @return  (ACF_Location|false)
 */
function acf_get_location_rule( $name ) {
	return acf_get_location_type( $name );
}

/**
 * Alias of acf_validate_location_rule().
 *
 * @date    30/5/17
 * @since   5.6.0
 *
 * @param   array $rule The location rule.
 * @return  array
 */
function acf_get_valid_location_rule( $rule ) {
	return acf_validate_location_rule( $rule );
}
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
