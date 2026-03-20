<?php
/**
<<<<<<< HEAD
 * Plugin Name: Inline Bundle Builder
 * Description: Build a bundle in a responsive modal. Saves each slot as numbered meta (e.g., "1: Crna Majica - S") in orders. Cart/checkout shows the same lines without a label.
 * Version:     3.2.0
=======
 * Plugin Name: Inline Bundle Builder (GR)
 * Description: Δημιούργησε πακέτο σε responsive modal. Αποθηκεύει κάθε θέση ως αριθμημένο meta (π.χ. "1: Μαύρο μπλουζάκι - L") στην παραγγελία. Στον κάδο/ταμείο εμφανίζονται οι ίδιες γραμμές χωρίς ετικέτα.
 * Version:     3.1.2-gr
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
 * Author:      You
 */

if (!defined('ABSPATH')) exit;

<<<<<<< HEAD
class IBB_Plugin_SimpleMeta {
=======
class IBB_Plugin_SimpleMeta_GR {
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f

    public function __construct() {
        add_shortcode('inline_bundle_builder', [$this, 'shortcode']);

        // AJAX: resolve variation from attributes
        add_action('wp_ajax_ibb_find_variation',        [$this, 'ajax_find_variation']);
        add_action('wp_ajax_nopriv_ibb_find_variation', [$this, 'ajax_find_variation']);

        // Save/display meta
        add_filter('woocommerce_add_cart_item_data',              [$this, 'hook_add_cart_item_data'], 10, 3);
        add_filter('woocommerce_get_item_data',                   [$this, 'hook_display_item_data'],  10, 2);
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'hook_order_item_meta'],    10, 4);
    }

    /* -------------------------------------------------
     * Shortcode (enqueues assets ONLY when rendered)
     * ------------------------------------------------*/
    /**
<<<<<<< HEAD
     * Usage: echo do_shortcode('[inline_bundle_builder products="504,505,506" slots="3" gratis_slots="1,3,5"]');
     * - `gratis_slots` is optional. If provided, the specified 1-based slot numbers will render the GRATIS badge.
=======
     * Usage: echo do_shortcode('[inline_bundle_builder products="504,505,506" slots="3"]');
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
     */
    public function shortcode($atts) {
        if (!class_exists('WooCommerce')) return '';

        $a = shortcode_atts([
<<<<<<< HEAD
            'products'     => '',
            'slots'        => 3,
            'gratis_slots' => '', // NEW: control GRATIS badge purely via data attribute (e.g., "3" or "1,3,5" or "1-3" or "all")
        ], $atts);

        $ids         = array_filter(array_map('absint', explode(',', $a['products'])));
        $slots       = max(1, absint($a['slots']));
        $gratis_attr = trim((string) $a['gratis_slots']);

        if (!$ids) return '<em>No products configured.</em>';

        // Enqueue assets *only* when shortcode renders
        wp_enqueue_style ('ibb-style', plugins_url('ibb.css?dd', __FILE__), [], '3.2.0');
        wp_enqueue_script('ibb-script', plugins_url('ibb.js?ds34343ddsds',  __FILE__), ['jquery'], '3.2.0', true);

        // Hide the stray ":" dt in variation blocks (mini cart / cart / checkout / XOO side cart)
=======
            'products' => '',
            'slots'    => 3,
        ], $atts);

        $ids   = array_filter(array_map('absint', explode(',', $a['products'])));
        $slots = max(1, absint($a['slots']));
        if (!$ids) return '<em>Δεν έχουν οριστεί προϊόντα.</em>';

        // Enqueue assets only when shortcode renders
        wp_enqueue_style ('ibb-style', plugins_url('ibb.css', __FILE__), [], '3.1.2-gr');
        wp_enqueue_script('ibb-script', plugins_url('ibb.js',  __FILE__), ['jquery'], '3.1.2-gr', true);

        // Hide the stray ":" dt in variation blocks
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        $ibb_inline_css = '
          .widget_shopping_cart .variation dt.variation-,
          .woocommerce-mini-cart .variation dt.variation-,
          .woocommerce-cart .variation dt.variation-,
          .woocommerce-checkout .variation dt.variation-,
          .xoo-wsc-container .variation dt.variation- { display:none!important; }
          .widget_shopping_cart .variation dd.variation-,
          .woocommerce-mini-cart .variation dd.variation-,
          .woocommerce-cart .variation dd.variation-,
          .woocommerce-checkout .variation dd.variation-,
          .xoo-wsc-container .variation dd.variation- { margin:0; padding:0; }
        ';
        wp_add_inline_style('ibb-style', $ibb_inline_css);

        wp_localize_script('ibb-script', 'IBB', [
            'ajax'  => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ibb'),
        ]);

<<<<<<< HEAD
        // Add an inline script that:
        // - Disables ATC only when a .ibb-wrapper exists
        // - Ensures the hidden ibb_cart_data field exists in the Woo form
        // - Keeps it synced with window.IBB.carts
        $inline_js = <<<JS
jQuery(function($){
  var \$wrap = $('.ibb-wrapper').first();
  if (!\$wrap.length) return; // only act on pages where shortcode rendered

  // Prefer the form wrapping the shortcode; fallback to first product form
  var \$form = \$wrap.closest('form.cart');
  if (!\$form.length) \$form = $('form.cart').first();

  // Disable ATC on load (only here) — NEVER touch buttons inside the YITH Quick View container
=======
        // Minimal inline helper that ensures hidden ibb_cart_data exists & stays synced
        $inline_js = <<<JS
jQuery(function(\$){
  var \$wrap = \$('.ibb-wrapper').first();
  if (!\$wrap.length) return;

  var \$form = \$wrap.closest('form.cart');
  if (!\$form.length) \$form = \$('form.cart').first();

>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
  var \$btn = \$form.find('.single_add_to_cart_button');
  if (\$btn.length && !\$form.closest('#yith-quick-view-content').length) {
    \$btn.prop('disabled', true).addClass('ibb-disabled');
  }

  function ensureHidden(){
    var \$field = \$form.find('input.ibb-cart-data[name="ibb_cart_data"]');
    if(!\$field.length){
<<<<<<< HEAD
      \$field = $('<input type="hidden" name="ibb_cart_data" class="ibb-cart-data" value="[]">');
=======
      \$field = \$('<input type="hidden" name="ibb_cart_data" class="ibb-cart-data" value="[]">');
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      \$form.append(\$field);
    }
    return \$field;
  }

<<<<<<< HEAD
  function getSlotsJSON(){
    try{
      if (window.IBB && window.IBB.carts){
        var wid = \$wrap.attr('data-ibb-id');
        if (wid && window.IBB.carts[wid]) return JSON.stringify(window.IBB.carts[wid]);
      }
    }catch(e){}
    return '[]';
  }

  function syncHidden(){
    var \$field = ensureHidden();
    \$field.val(getSlotsJSON());
  }

  // initial + on events
  syncHidden();

  $(document).on('ibb:slotsFilled ibb:slotsNotFilled', '.ibb-wrapper', function(e){
    // keep field synced
    syncHidden();

    // toggle ATC based on fill-state
    if (!\$btn.length) return;
    if (e.type === 'ibb:slotsFilled'){
      \$btn.prop('disabled', false).removeClass('ibb-disabled');
    } else {
      // again, don't touch modal buttons
      if (!\$form.closest('#yith-quick-view-content').length) {
        \$btn.prop('disabled', true).addClass('ibb-disabled');
      }
    }
  });

  // resync after add/remove clicks
  $(document).on('click', '.ibb-add, .ibb-slot-remove', function(){ setTimeout(syncHidden, 0); });

  // resync just before submit
=======
  function syncHidden(){
    var data='[]';
    try{
      if (window.IBB && window.IBB.carts){
        var wid = \$wrap.attr('data-ibb-id');
        if (wid && window.IBB.carts[wid]) data = JSON.stringify(window.IBB.carts[wid]);
      }
    }catch(e){}
    ensureHidden().val(data);
  }

  syncHidden();
  \$(document).on('ibb:slotsFilled ibb:slotsNotFilled', '.ibb-wrapper', function(e){
    syncHidden();
    if (!\$btn.length) return;
    if (e.type === 'ibb:slotsFilled'){
      \$btn.prop('disabled', false).removeClass('ibb-disabled');
    } else if (!\$form.closest('#yith-quick-view-content').length) {
      \$btn.prop('disabled', true).addClass('ibb-disabled');
    }
  });

  \$(document).on('click', '.ibb-add, .ibb-slot-remove', function(){ setTimeout(syncHidden, 0); });
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
  \$form.on('submit', syncHidden);
});
JS;
        wp_add_inline_script('ibb-script', $inline_js, 'after');

<<<<<<< HEAD
        /* === ADDED: block CSS/JS inside YITH Quick View modal (no button changes) === */
        $qv_block_js = <<<JS
jQuery(function($){
  function cleanQuickView(){
    var c = document.getElementById('yith-quick-view-content');
    if(!c) return;

    // Remove style/script/link rel=stylesheet/noscript inside modal
    c.querySelectorAll('style, script, link[rel="stylesheet"], noscript').forEach(function(n){ n.remove(); });

    // Remove inline event handlers like onclick/onload to prevent JS execution
    c.querySelectorAll('*').forEach(function(el){
      if(!el.attributes) return;
      for (var i = el.attributes.length - 1; i >= 0; i--) {
        var a = el.attributes[i];
        if (/^on/i.test(a.name)) el.removeAttribute(a.name);
      }
    });

    // IMPORTANT: do not modify any buttons inside the modal.
  }

  // Run once (in case content is already present)
  cleanQuickView();

  // YITH commonly triggers this when content has loaded into the modal
  $(document).on('qv_loader_stop', function(){ 
    setTimeout(cleanQuickView, 0);
    setTimeout(cleanQuickView, 50);
    setTimeout(cleanQuickView, 300);
  });

  // Fallback: watch DOM for injected content
  var obs = new MutationObserver(function(muts){
    for (var m of muts){
      for (var node of m.addedNodes){
        if (!(node instanceof HTMLElement)) continue;
        if (node.id === 'yith-quick-view-content' || (node.querySelector && node.querySelector('#yith-quick-view-content'))){
          setTimeout(cleanQuickView, 0);
          setTimeout(cleanQuickView, 50);
          setTimeout(cleanQuickView, 300);
        }
      }
    }
  });
  obs.observe(document.documentElement, { childList:true, subtree:true });

  // Also re-clean around open/close interactions (still no button changes)
  $(document).on('click', '.yith-wcqv-button, .yith-quick-view, .yith-quick-view-close', function(){
    setTimeout(cleanQuickView, 150);
  });
});
JS;
        wp_add_inline_script('ibb-script', $qv_block_js, 'after');
        /* === /ADDED ============================================================ */

=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        // Build product cards for modal
        $cards = [];
        foreach ($ids as $pid) {
            $p = wc_get_product($pid);
            if (!$p || !$p->is_purchasable()) continue;

            $c = [
                'id'    => $pid,
                'type'  => $p->get_type(),
                'title' => $p->get_name(),
                'price' => $p->get_price_html(),
                'img'   => wp_get_attachment_image_url($p->get_image_id() ?: get_post_thumbnail_id($pid), 'woocommerce_single'),
                'attrs' => [],
            ];

            if ($p->is_type('variable')) {
                $vattrs = $p->get_variation_attributes();
                foreach ($vattrs as $tax_raw => $options) {
<<<<<<< HEAD
                    $tax_norm = str_replace('attribute_', '', $tax_raw);
                    if (strpos($tax_norm, 'pa_') === 0) $tax_norm = substr($tax_norm, 3);

                    $label = wc_attribute_label($tax_norm) ?: wc_attribute_label($tax_raw) ?: 'Option';
                    $opts  = [];
                    foreach ((array)$options as $opt) {
                        $term = taxonomy_exists($tax_norm) ? get_term_by('slug', $opt, $tax_norm) : null;
=======
                    $tax_norm = str_replace('attribute_', '', $tax_raw); // may still include pa_
                    $label = wc_attribute_label($tax_norm) ?: wc_attribute_label($tax_raw) ?: 'Επιλογή';
                    $opts  = [];
                    foreach ((array)$options as $opt) {
                        $tax_for_terms = taxonomy_exists($tax_norm) ? $tax_norm : (taxonomy_exists('pa_' . $tax_norm) ? 'pa_' . $tax_norm : $tax_norm);
                        $term = taxonomy_exists($tax_for_terms) ? get_term_by('slug', $opt, $tax_for_terms) : null;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                        $opts[] = [
                            'value' => $term ? $term->slug : (string)$opt,
                            'label' => $term ? $term->name : (string)$opt,
                        ];
                    }
                    $c['attrs'][] = [
                        'raw'   => $tax_raw,
<<<<<<< HEAD
                        'norm'  => $tax_norm,
=======
                        'norm'  => ltrim($tax_norm, '_'),
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                        'label' => $label,
                        'opts'  => $opts,
                    ];
                }
            }

            $cards[] = $c;
        }

        // subtitle text: slots + current product price
        global $product;
        $bundle_price = '';
        if ($product instanceof WC_Product) {
            $price = $product->get_sale_price() ?: $product->get_regular_price();
            if ($price) $bundle_price = wc_price($price);
        }

        ob_start(); ?>
<<<<<<< HEAD
        <div class="ibb-wrapper"
             data-slots="<?php echo esc_attr($slots); ?>"
             <?php if ($gratis_attr !== ''): ?>
             data-ibb-gratis-slots="<?php echo esc_attr($gratis_attr); ?>"
             <?php endif; ?>>
          <div class="ibb-slots">
            <?php for ($i=0; $i<$slots; $i++): ?>
              <div class="ibb-slot-wrap">
                  
                  
                  <?php
                  
                  // make here boxerice if else
                  $is_boxers = has_term( array( 'bokserice', 'bokserice-sastavi-paket' ), 'product_cat', $current_product_id );

                  
                  ?>
                  
                  
                <div class="ibb-slot-header">
                    
                    <?php if( $is_boxers ): ?>
                    Odaberite proizvod
                    <?php else: ?>
                     Odaberite majicu
                    <?php endif; ?>
                
                
                
                <?php echo esc_html($i+1); ?> od <?php echo esc_html($slots); ?></div>
                <div class="ibb-slot is-empty" data-index="<?php echo (int) $i; ?>" tabindex="0">
                  <div class="ibb-slot-thumb"><span class="ibb-slot-plus" aria-hidden="true">+</span></div>
                  <div class="ibb-slot-info">
                    <span class="ibb-slot-attr">
                        
                          <?php if( $is_boxers ): ?>
                           <?php esc_html_e('Dodaj proizvod','ibb'); ?>
                          <?php else: ?>
                          
                           <?php esc_html_e('Dodaj majicu','ibb'); ?>
                          <?php endif; ?>
                     
                    </span>
=======
        <div class="ibb-wrapper" data-slots="<?php echo esc_attr($slots); ?>">
          <div class="ibb-slots">
            <?php for ($i=0; $i<$slots; $i++): ?>
              <div class="ibb-slot-wrap">
                <div class="ibb-slot-header"><?php echo sprintf(esc_html__('Επιλέξτε μπλουζάκι %1$d από %2$d', 'ibb'), $i+1, $slots); ?></div>
                <div class="ibb-slot is-empty" data-index="<?php echo $i; ?>" tabindex="0">
                  <div class="ibb-slot-thumb"><span class="ibb-slot-plus" aria-hidden="true">+</span></div>
                  <div class="ibb-slot-info">
                    <span class="ibb-slot-attr"><?php esc_html_e('Επιλέξτε μπλουζάκι','ibb'); ?></span>
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                    <span class="ibb-slot-price" hidden></span>
                  </div>
                </div>
              </div>
            <?php endfor; ?>
          </div>

<<<<<<< HEAD
          <!-- Modal scaffold (your ibb.js handles its behavior) -->
          <div class="ibb-modal" aria-hidden="true">
            <div class="ibb-modal__box" role="dialog" aria-modal="true" aria-label="Bundle builder">
=======
          <!-- Modal scaffold (handled by ibb.js) -->
          <div class="ibb-modal" aria-hidden="true">
            <div class="ibb-modal__box" role="dialog" aria-modal="true" aria-label="Δημιουργία πακέτου">
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
              <div class="ibb-modal__head">
                <div class="ibb-steps-nav">
                  <button type="button" class="ibb-nav ibb-prev">‹</button>
                  <div class="ibb-steps"></div>
                  <button type="button" class="ibb-nav ibb-next">›</button>
                </div>
                <button type="button" class="ibb-modal__close">×</button>
                <div class="ibb-titlebar">
<<<<<<< HEAD
                  <h2 class="ibb-heading">Odaberi <span class="ibb-step-num">1</span> 
                  
                   <?php if( $is_boxers ): ?>
                  proizvod
                  <?php else: ?>
                  majicu
                  <?php endif; ?>          
                  
                  </h2>
                  <p class="ibb-sub">
                      
                       <?php if( $is_boxers ): ?>
                    <?php printf(__('Dodajte %1$d proizvod i dobit ćete paket za %2$s', 'ibb'), $slots, $bundle_price); ?>
                     <?php else: ?>
                      <?php printf(__('Dodajte %1$d majice i dobit ćete paket za %2$s', 'ibb'), $slots, $bundle_price); ?>
                     <?php endif; ?>     
                    
                  </p>
=======
                  <h2 class="ibb-heading"><?php esc_html_e('Επιλέξτε', 'ibb'); ?> <span class="ibb-step-num">1</span> <?php esc_html_e('μπλουζάκι', 'ibb'); ?></h2>
                  <?php if ($bundle_price): ?>
                    <p class="ibb-sub">
                      <?php printf(esc_html__('Προσθέστε %1$d μπλουζάκια και πάρτε το πακέτο με %2$s', 'ibb'), $slots, $bundle_price); ?>
                    </p>
                  <?php endif; ?>
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                </div>
              </div>
              <div class="ibb-modal__body">
                <div class="ibb-grid">
                  <?php foreach ($cards as $c): ?>
                    <div class="ibb-card" data-id="<?php echo esc_attr($c['id']); ?>" data-type="<?php echo esc_attr($c['type']); ?>">
                      <img src="<?php echo esc_url($c['img']); ?>" alt="<?php echo esc_attr($c['title']); ?>">
                      <div class="ibb-card-body">
                        <div class="ibb-card-title"><?php echo esc_html($c['title']); ?></div>
                        <?php if ($c['type'] === 'variable' && !empty($c['attrs'])): ?>
                          <?php foreach ($c['attrs'] as $a): ?>
                            <label class="ibb-label"><?php echo esc_html($a['label']); ?></label>
                            <select class="ibb-attr"
                              data-taxonomy="<?php echo esc_attr($a['norm']); ?>"
                              data-taxonomy-raw="<?php echo esc_attr('attribute_' . $a['norm']); ?>">
<<<<<<< HEAD
                              <option value=""><?php echo esc_html__('Vyberte variantu', 'ibb'); ?></option>
=======
                              <option value=""><?php echo esc_html__('Επιλέξτε παραλλαγή', 'ibb'); ?></option>
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                              <?php foreach ($a['opts'] as $o): ?>
                                <option value="<?php echo esc_attr($o['value']); ?>"><?php echo esc_html($o['label']); ?></option>
                              <?php endforeach; ?>
                            </select>
                          <?php endforeach; ?>
                        <?php endif; ?>
<<<<<<< HEAD
                        <button type="button" class="ibb-add"><?php esc_html_e('Dodaj u paket','ibb'); ?></button>
=======
                        <button type="button" class="ibb-add"><?php esc_html_e('Προσθήκη στο πακέτο','ibb'); ?></button>
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                        <div class="ibb-msg" aria-live="polite"></div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- /modal -->
        </div>
        <?php
        return ob_get_clean();
    }

    /* -------------------------------------------------
     * Variation AJAX
     * ------------------------------------------------*/
    public function ajax_find_variation() {
        check_ajax_referer('ibb', 'nonce');

        $product_id = absint($_POST['product_id'] ?? 0);
        $attrs_in   = isset($_POST['attributes']) ? (array) $_POST['attributes'] : [];

        $product = wc_get_product($product_id);
        if (!$product || !$product->is_type('variable')) {
            wp_send_json_error(['message' => 'Invalid product']);
        }

<<<<<<< HEAD
        $attrs = [];
        foreach ($attrs_in as $k => $v) {
            $k = sanitize_title($k);
            $attrs['attribute_' . $k] = wc_clean($v);
=======
        // Map incoming keys to Woo's expected "attribute_{taxonomy}" keys,
        // fixing cases where the client already sent "attribute_*".
        $attrs = [];
        foreach ($attrs_in as $k => $v) {
            $k = sanitize_title($k); // e.g. "attribute_Μέγεθος" -> "attribute_megethos"
            if (strpos($k, 'attribute_') === 0) {
                $k = substr($k, 10);
            }
            if (strpos($k, 'pa_') === 0) {
                $k = substr($k, 3);
            }

            // Registered taxonomies are usually transliterated, e.g. pa_megethos
            $tax = taxonomy_exists('pa_' . $k) ? 'pa_' . $k : $k;
            $v_clean = taxonomy_exists($tax) ? sanitize_title($v) : wc_clean($v);

            $attrs['attribute_' . $tax] = $v_clean;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        }

        $ds = new WC_Product_Data_Store_CPT();
        $variation_id = $ds->find_matching_product_variation($product, $attrs);

        if (!$variation_id) {
<<<<<<< HEAD
            wp_send_json_error(['message' => 'This option is unavailable.']);
=======
            wp_send_json_error(['message' => 'Η παραλλαγή δεν είναι διαθέσιμη.']);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        }

        $vp = wc_get_product($variation_id);
        wp_send_json_success([
            'variation_id' => $variation_id,
            'price'        => $vp ? $vp->get_price_html() : '',
        ]);
    }

    /* -------------------------------------------------
     * Helpers
     * ------------------------------------------------*/
<<<<<<< HEAD
=======

    // Normalize keys: trim, remove diacritics, lowercase, strip Woo prefixes.
    private function canon_key($k) : string {
        $k = is_string($k) ? trim($k) : '';
        if (function_exists('remove_accents')) {
            $k = remove_accents($k); // removes tonos; keeps Greek letters unaccented
        }
        $k = strtolower($k);
        $k = preg_replace('~^(attribute_|pa_)~', '', $k);
        return $k; // e.g. "μεγεθος", "megethos", "size"
    }

    // Detect keys that mean "size" in Greek/English/transliterated.
    private function is_size_key($k) : bool {
        $ck = $this->canon_key($k);         // "μεγεθος" | "megethos" | "size"
        $ck_slug = sanitize_title($ck);     // "megethos" | "size"
        if (preg_match('~(μεγεθ|size)~u', $ck)) return true;         // Greek label or "size"
        if (preg_match('~(megeth|size)~', $ck_slug)) return true;    // transliterated slug
        return false;
    }

    // Get size value from the slot; if missing, read from the WC variation attributes.
    private function get_size_from_slot(array $slot) : string {
        // 1) Try the provided attrs (human labels like "Μέγεθος")
        if (!empty($slot['attr']) && is_array($slot['attr'])) {
            foreach ($slot['attr'] as $k => $v) {
                $val = is_scalar($v) ? (string)$v : '';
                if ($val !== '' && $this->is_size_key($k)) {
                    return $val;
                }
            }
        }

        // 2) Fallback: read from the actual WC variation attributes
        $vid = isset($slot['variation_id']) ? absint($slot['variation_id']) : 0;
        if ($vid) {
            $vp = wc_get_product($vid);
            if ($vp instanceof WC_Product_Variation) {
                $vattrs = $vp->get_attributes(); // e.g. ['attribute_pa_megethos' => 's']
                foreach ($vattrs as $vk => $vslug) {
                    if ($this->is_size_key($vk)) {
                        // If taxonomy, convert slug to human term name
                        $tax = str_replace('attribute_', '', (string)$vk); // 'pa_megethos'
                        if (taxonomy_exists($tax)) {
                            $term = get_term_by('slug', (string)$vslug, $tax);
                            if ($term && !is_wp_error($term)) {
                                return (string)$term->name;
                            }
                        }
                        // Custom attribute – return raw
                        return is_scalar($vslug) ? (string)$vslug : '';
                    }
                }
            }
        }
        return '';
    }

>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    private function parse_slots_from_post() : array {
        if (empty($_POST['ibb_cart_data'])) return [];
        $raw   = wp_unslash($_POST['ibb_cart_data']);
        $slots = json_decode($raw, true);
        return is_array($slots) ? $slots : [];
    }

<<<<<<< HEAD
    private function slot_line(array $slot) : string {
        $title = !empty($slot['title']) ? trim((string)$slot['title']) : '';
        $size  = '';
        if (!empty($slot['attr']) && is_array($slot['attr'])) {
            foreach ($slot['attr'] as $k => $v) {
                $val = is_scalar($v) ? (string)$v : '';
                if ($val !== '' && preg_match('~size|veli[čc]ina~iu', $k)) {
                    $size = function_exists('mb_strtoupper') ? mb_strtoupper($val, 'UTF-8') : strtoupper($val);
                }
            }
        }
=======
    // Build the visible line for each slot (title + size if found).
    private function slot_line(array $slot) : string {
        $title = !empty($slot['title']) ? trim((string)$slot['title']) : '';
        $size  = $this->get_size_from_slot($slot);

        // FINAL fallback: if size still empty, use the first attribute value we see
        if ($size === '' && !empty($slot['attr']) && is_array($slot['attr'])) {
            foreach ($slot['attr'] as $k => $v) {
                if ($v !== '' && is_scalar($v)) {
                    $size = (string)$v;
                    break;
                }
            }
        }

        if ($size !== '') {
            $size = function_exists('mb_strtoupper') ? mb_strtoupper($size, 'UTF-8') : strtoupper($size);
        }

>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        return trim($title . ($size ? " - $size" : ''));
    }

    private function build_slot_lines(array $slots) : array {
        $filled = array_values(array_filter($slots, function($s){ return !empty($s['product_id']); }));
        $lines = [];
        foreach ($filled as $slot) {
            $lines[] = $this->slot_line($slot);
        }
        return $lines;
    }

    /* -------------------------------------------------
     * Cart & Order Meta
     * ------------------------------------------------*/
    public function hook_add_cart_item_data($cart_item_data, $product_id, $variation_id) {
        $slots = $this->parse_slots_from_post();
        if (!$slots) return $cart_item_data;

        // Keep raw slots JSON for later display/order meta
        $cart_item_data['_ibb_slots_json'] = wp_json_encode($slots);

        // Ensure uniqueness so cart items don't merge
        $lines = $this->build_slot_lines($slots);
        $cart_item_data['ibb_unique_key'] = md5(wp_json_encode([$lines]) . '|' . microtime(true) . '|' . wp_rand());

        return $cart_item_data;
    }

    public function hook_display_item_data($item_data, $cart_item) {
        $slots_json = !empty($cart_item['_ibb_slots_json']) ? $cart_item['_ibb_slots_json'] : '';
        $slots = $slots_json ? json_decode($slots_json, true) : [];
        if (!is_array($slots)) $slots = [];

        $lines = $this->build_slot_lines($slots);
        if ($lines) {
            $numbered = [];
            foreach ($lines as $i => $line) {
                $numbered[] = ($i+1) . ': ' . $line;
            }
<<<<<<< HEAD
            $value = implode('<br>', array_map('esc_html', $numbered));

            // name=false -> Woo prints only the value (no dt) — CSS above also hides stray labels
=======
            $escaped = array_map('esc_html', $numbered);
            $value = implode('<br>', $escaped);

            // name=false -> Woo prints only the value (no dt)
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
            $item_data[] = ['name' => false, 'display' => $value];
        }
        return $item_data;
    }

    public function hook_order_item_meta($item, $cart_item_key, $values, $order) {
        $slots_json = !empty($values['_ibb_slots_json']) ? $values['_ibb_slots_json'] : '';
        $slots = $slots_json ? json_decode($slots_json, true) : [];
        if (!is_array($slots)) $slots = [];

        $lines = $this->build_slot_lines($slots);
        if ($lines) {
            foreach ($lines as $i => $line) {
                $item->add_meta_data((string)($i+1), sanitize_text_field($line), true);
            }
        }
    }
}

<<<<<<< HEAD
new IBB_Plugin_SimpleMeta();
=======
new IBB_Plugin_SimpleMeta_GR();
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
