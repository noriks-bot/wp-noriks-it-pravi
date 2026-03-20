<?php
/**
 * Greek (GR) Language Configuration
 * Noriks Greece Store
 */

// Translate WooCommerce attribute labels
add_filter( 'gettext', 'translate_attribute_labels_gr', 20, 3 );
function translate_attribute_labels_gr( $translated_text, $text, $domain ) {
    $translations = array(
        'Choose your size' => 'Επιλέξτε μέγεθος',
        'Choose an option' => 'Επιλέξτε μια επιλογή',
        'Add to cart' => 'Προσθήκη στο καλάθι',
        'Select options' => 'Επιλογή',
        'View cart' => 'Προβολή καλαθιού',
        'Checkout' => 'Ολοκλήρωση παραγγελίας',
        'Proceed to checkout' => 'Προχωρήστε στην ολοκλήρωση',
        'Update cart' => 'Ενημέρωση καλαθιού',
        'Apply coupon' => 'Εφαρμογή κουπονιού',
        'Coupon code' => 'Κωδικός κουπονιού',
        'Cart totals' => 'Σύνολα καλαθιού',
        'Subtotal' => 'Υποσύνολο',
        'Total' => 'Σύνολο',
        'Shipping' => 'Αποστολή',
        'Free shipping' => 'Δωρεάν αποστολή',
    );
    
    if ( isset( $translations[$text] ) ) {
        return $translations[$text];
    }
    return $translated_text;
}

// Checkout phone placeholder
add_filter( 'woocommerce_checkout_fields', 'custom_billing_phone_placeholder_gr' );
function custom_billing_phone_placeholder_gr( $fields ) {
    $fields['billing']['billing_phone']['placeholder'] = 'Κινητό (παράδειγμα: 6912345678)';
    return $fields;
}

// Order number prefix
add_filter( 'woocommerce_order_number', 'change_woocommerce_order_number_gr' );
function change_woocommerce_order_number_gr( $order_id ) {
    $prefix = 'NORIKS-GR-';
    return $prefix . $order_id;
}

// Force country to Greece
add_filter( 'default_checkout_billing_country', '__return_gr' );
add_filter( 'default_checkout_shipping_country', '__return_gr' );
function __return_gr() {
    return 'GR';
}

// Force country to Greece and hide country fields
add_filter( 'woocommerce_checkout_fields', 'fix_country_to_greece_and_hide' );
function fix_country_to_greece_and_hide( $fields ) {
    WC()->customer->set_billing_country( 'GR' );
    WC()->customer->set_shipping_country( 'GR' );
    
    unset( $fields['billing']['billing_country'] );
    unset( $fields['shipping']['shipping_country'] );
    
    return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'hide_checkout_fields_gr' );
function hide_checkout_fields_gr( $fields ) {
    unset( $fields['billing']['billing_state'] );
    unset( $fields['shipping']['shipping_state'] );
    unset( $fields['shipping']['shipping_address_2'] );
    return $fields;
}

/**
 * Greek translations for hardcoded strings
 */
function noriks_gr_translations() {
    return array(
        // Hero section
        'Tričko, které řeší všechny problémy.' => 'Το μπλουζάκι που λύνει όλα τα προβλήματα.',
        'KOUPIT TEĎ' => 'ΑΓΟΡΑΣΤΕ ΤΩΡΑ',
        
        // Collections
        'Nakupujte podle kolekce' => 'Αγοράστε ανά συλλογή',
        'Všechny produkty' => 'Όλα τα προϊόντα',
        
        // Category names
        'Trička' => 'Μπλουζάκια',
        'Boxerky' => 'Μποξεράκια',
        'Sady' => 'Σετ',
        'Startovací balíček' => 'Πακέτο εκκίνησης',
        
        // Category descriptions
        'Pohodlí po celý den. Bez vytahování.' => 'Άνεση όλη μέρα. Χωρίς τράβηγμα.',
        'Měkké. Prodyšné. Spolehlivé.' => 'Απαλά. Αναπνεύσιμα. Αξιόπιστα.',
        'Nejlepší poměr ceny a kvality v setu.' => 'Η καλύτερη σχέση ποιότητας-τιμής σε σετ.',
        'Vyzkoušej NORIKS výhodněji.' => 'Δοκιμάστε NORIKS πιο οικονομικά.',
        
        // Header marquee
        'Doprava zdarma pro objednávky nad 1700 Kč' => 'Δωρεάν αποστολή για παραγγελίες άνω των 70 €',
        'Doprava zdarma při objednávkách nad 1700 Kč' => 'Δωρεάν αποστολή για παραγγελίες άνω των 70 €',
        '30 dní bez rizika – vyzkoušej bez obav' => '30 ημέρες χωρίς ρίσκο – δοκιμάστε χωρίς ανησυχία',
        
        // Product page features
        'Platba na dobírku' => 'Αντικαταβολή',
        'Vyzkoušejte 30 dní, bez rizika' => 'Δοκιμάστε 30 ημέρες, χωρίς ρίσκο',
        
        // Shipping/delivery
        'Objednejte během následujících' => 'Παραγγείλτε εντός',
        'Doručení od' => 'Παράδοση από',
        'do' => 'έως',
        
        // Cart
        'Prosím, pospěš si! Někdo si právě objednal jeden z produktů ve tvém košíku. Rezervace platí už jen' => 'Παρακαλώ βιαστείτε! Κάποιος μόλις παρήγγειλε ένα από τα προϊόντα στο καλάθι σας. Η κράτηση ισχύει για',
        'minut' => 'λεπτά',
    );
}

/**
 * Greek weekday names
 */
function noriks_gr_weekdays() {
    return array(
        'Κυριακή',    // Sunday
        'Δευτέρα',    // Monday
        'Τρίτη',      // Tuesday
        'Τετάρτη',    // Wednesday
        'Πέμπτη',     // Thursday
        'Παρασκευή',  // Friday
        'Σάββατο'     // Saturday
    );
}
