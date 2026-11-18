<?php
/**
 * Stranska kosarica: ob "2x Mystery majica" ponudimo se "1x Mystery majica" (18. 11. 2026).
 *
 * Enkratna dopolnitev nastavitve vticnika Side Cart (Custom Product IDS): 1x se vstavi tik pred 2x.
 * Izvede se samo enkrat in samo, ce je 2x ze na seznamu — potem se seznam ureja v adminu kot doslej
 * (Side Cart > Suggested Products), ta koda ga ne spreminja vec.
 */
add_action( 'init', function () {
    if ( get_option( 'noriks_sc_mystery_1x' ) || ! function_exists( 'wc_get_product_id_by_sku' ) ) { return; }
    $id1 = (int) wc_get_product_id_by_sku( 'NORIKS-MYSTERY-SHIRT-1X' );
    $id2 = (int) wc_get_product_id_by_sku( 'NORIKS-MYSTERY-SHIRT-2X' );
    if ( ! $id1 || ! $id2 ) { return; }                      // izdelka (se) ni: poskusi ob naslednjem obisku
    $o = get_option( 'xoo-wsc-gl-options' );
    if ( ! is_array( $o ) ) { return; }
    $ids = array_values( array_filter( array_map( 'absint', explode( ',', (string) ( isset( $o['scsp-ids'] ) ? $o['scsp-ids'] : '' ) ) ) ) );
    $pos = array_search( $id2, $ids, true );
    if ( $pos !== false && ! in_array( $id1, $ids, true ) ) {
        array_splice( $ids, $pos, 0, array( $id1 ) );
        $o['scsp-ids'] = implode( ',', $ids );
        if ( (int) ( isset( $o['scsp-count'] ) ? $o['scsp-count'] : 0 ) < count( $ids ) ) { $o['scsp-count'] = count( $ids ); }
        update_option( 'xoo-wsc-gl-options', $o );
    }
    update_option( 'noriks_sc_mystery_1x', 1 );
}, 30 );
