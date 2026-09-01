<?php
/**
 * Popravki besedil, ki so shranjena v ACF nastavitvah.
 *
 * Do ACF moznosti prek REST API-ja ni dostopa, zato besedilo popravimo ob izpisu.
 * Deluje samo, dokler je v bazi staro besedilo — ko ga Dejan popravi v wp-adminu,
 * funkcija nima vec kaj zamenjati.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'noriks_strip_free' ) ) {
    /** Odstrani besedo "brezplacno" iz napisa o zamenjavah (Dejan, 25. 8. 2026). */
    function noriks_strip_free( $txt ) {
        if ( ! is_string( $txt ) || $txt === '' ) { return $txt; }
        $words = array(
            'besplatne','besplatna','besplatan','besplatnu',
            'brezplačne','brezplačna','brezplačno',
            'bezplatné','bezplatná','bezplatne',
            'bezpłatne','bezpłatna','darmowe','darmowa',
            'gratuite','gratuiti','gratuita','gratuit',
            'δωρεάν','kostenloser','kostenlose','kostenlos',
            'ingyenes','ingyen','free',
        );
        foreach ( $words as $w ) {
            $txt = str_ireplace( array( ' ' . $w . ' ', ' ' . $w, $w . ' ' ), ' ', $txt );
        }
        $txt = preg_replace( '/\s{2,}/u', ' ', $txt );
        return trim( $txt );
    }
}

if ( ! function_exists( 'noriks_fix_days' ) ) {
    /** Popravi zastarel rok dostave v ACF besedilu. */
    function noriks_fix_days( $txt ) {
        if ( ! is_string( $txt ) || $txt === '' ) { return $txt; }
        return $txt;
    }
}
