<?php
/**
 * ============================================================
 * NORIKS — Central product-type resolver (IT)
 * ------------------------------------------------------------
 * ONE place that decides which product categories map to which
 * "type". Everywhere in the theme use:
 *     noriks_is_type( 'bunion', $id )   // -> bool
 *     noriks_product_type( $id )        // -> string
 *
 * TYPE KEYS are identical across markets so shared templates work
 * unchanged; only the SLUG VALUES are Italian (+ universal orto-*).
 * ============================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'noriks_product_type_map' ) ) :

function noriks_product_type_map() : array {
    return array(
        // --- primary product types (order = resolution priority) ---
        'starter'   => array( 'pacchetto-starter', 'starter-paketi', 'orto-starter', 'orto-majica-bokserica', 'orto-maglietta-boxer', 'set' ),
        'majice'    => array( 'magliette', 'orto-magliette', 'set' ),
        'bokserice' => array( 'boxer', '1-pezzo-boxer', 'orto-boxer', 'confezione-3-boxer', 'confezione-5-boxer', 'confezione-7-boxer', 'confezione-10-boxer', 'confezione-15-boxer', 'orto-bokserice', 'bokserice-sastavi-paket', 'bokserice' ),
        'carape'    => array( 'calzini', 'calzini-bianchi', 'calzini-neri', 'orto-kompresijske-carape' ),

        // --- sub-variants / special buckets ---
        // Compression socks: universal orto category slug (identical across markets).
        'kompresijske-nogavice'   => array( 'orto-kompresijske-carape' ),
        'ortopas'                 => array( 'orto-ortopas', 'ortopas' ),
        'bunion'                  => array( 'orto-bunion', 'bunion' ),
        'fisiorest'               => array( 'orto-fisiorest', 'fisiorest' ),
        'norikshers'              => array( 'orto-norikshers', 'orto-noriks-hers', 'norikshers' ),
        'singles-boxers'          => array( 'singles-boxers', '1-pezzo-boxer' ),
        'majice-bokserice-paketi' => array( 'set', 'orto-maglietta-boxer', 'majice-i-bokserice-paketi', 'kompleti' ),
        'black-friday'            => array( 'black-friday' ),
        'orto'                    => array( 'orto' ),
    );
}

endif;

if ( ! function_exists( 'noriks_primary_types' ) ) :

function noriks_primary_types() : array {
    return array( 'starter', 'majice', 'bokserice', 'carape' );
}

endif;

if ( ! function_exists( 'noriks_resolve_product_id' ) ) :

function noriks_resolve_product_id( $product_id = null ) : int {
    if ( $product_id ) {
        return (int) $product_id;
    }
    if ( function_exists( 'is_product' ) && is_product() ) {
        return (int) get_queried_object_id();
    }
    return (int) get_the_ID();
}

endif;

if ( ! function_exists( 'noriks_is_type' ) ) :

function noriks_is_type( string $type, $product_id = null ) : bool {
    $map = noriks_product_type_map();
    if ( empty( $map[ $type ] ) ) {
        return false;
    }
    $product_id = noriks_resolve_product_id( $product_id );
    if ( ! $product_id ) {
        return false;
    }
    return has_term( $map[ $type ], 'product_cat', $product_id );
}

endif;

if ( ! function_exists( 'noriks_product_type' ) ) :

function noriks_product_type( $product_id = null ) : string {
    $product_id = noriks_resolve_product_id( $product_id );
    foreach ( noriks_primary_types() as $type ) {
        if ( noriks_is_type( $type, $product_id ) ) {
            return $type;
        }
    }
    return '';
}

endif;

if ( ! function_exists( 'noriks_is_black_friday' ) ) :

function noriks_is_black_friday( $product_id = null ) : bool {
    return noriks_is_type( 'black-friday', $product_id );
}

endif;

if ( ! function_exists( 'noriks_is_mixed_bundle' ) ) :

function noriks_is_mixed_bundle( $product_id = null ) : bool {
    return noriks_is_type( 'black-friday', $product_id )
        || noriks_is_type( 'majice-bokserice-paketi', $product_id )
        || noriks_is_type( 'starter', $product_id );
}

endif;
