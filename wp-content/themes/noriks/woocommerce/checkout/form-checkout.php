<?php
/**
 * Checkout Form — Vigoshop 1:1 replica within WooCommerce
 * HTML structure matches /test-checkout/ standalone template exactly
 */
if ( ! defined( 'ABSPATH' ) ) exit;

do_action( 'woocommerce_before_checkout_form', $checkout );

// Don't show checkout if cart is empty
if ( WC()->cart->is_empty() ) return;
?>

<div class="container container--xs bg--white wc-checkout-wrap">
<div class="before_form container container--xs">

<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="Pagamento">

  <div class="col2-set" id="customer_details">
    <div class="col-1 clearfix">
      <div class="woocommerce-billing-fields">
        <div class="woocommerce-billing-fields__field-wrapper">
          <?php do_action( 'woocommerce_checkout_billing' ); ?>
        </div>
      </div>
    </div>

    <div class="col-2">
      <div class="woocommerce-shipping-fields"></div>
      <div class="woocommerce-additional-fields">

        <!-- SHIPPING -->
        <div id="custom_shipping">
          <h3>Spedizione</h3>
          <ul class="shipping_method_custom">
            <li class="standard-shipping shipping-tab">
              <input name="shipping_method[0]" data-index="0" id="shipping_method_0_standard_custom"
                     value="standard" class="shipping_method shipping_method_field" type="radio" checked>
              <label for="shipping_method_0_standard_custom" class="checkedlabel">
                <svg viewBox="0 0 19 14" fill="#3DBD00"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.5725 3.40179L8.14482 13.5874C7.5815 14.1375 6.66839 14.1375 6.1056 13.5874L0.422493 8.03956C-0.140831 7.48994-0.140831 6.59748 0.422493 6.04707L1.44121 5.05126C2.00471 4.50094 2.91854 4.50094 3.48132 5.05126L7.12254 8.60835L15.5145 0.412609C16.078-0.137536 16.9909-0.137536 17.5537 0.412609L18.5733 1.40842C19.1424 1.95795 19.1424 2.8505 18.5725 3.40179Z"/></svg>
                <div class="outer-wrapper">
                  <div class="inner-wrapper-dates">
                    <strong class="hs-custom-date" id="js-delivery-dates"></strong>
                  </div>
                  <div class="inner-wrapper-img">
                    <span class="shipping_method_delivery_price tag tag--red">
                      <span class="woocommerce-Price-amount amount"><bdi>2,99<span class="woocommerce-Price-currencySymbol">&euro;</span></bdi></span>
                    </span>
                    <span class="delivery_img"><img decoding="async" class="corriere standard" src="https://images.vigo-shop.com/general/curriers/home_small_paket24@2x.png"/></span>
                  </div>
                </div>
              </label>
            </li>
          </ul>
          <div class="delivery-from-eu-warehouse">
            <img decoding="async" class="delivery-from-eu-warehouse__icon" src="https://images.vigo-shop.com/general/flags/eu-warehouse.svg">
            <span class="delivery-from-eu-warehouse__text">Magazzino nell'UE</span>
          </div>
        </div>

        <!-- PAYMENT METHODS (visible) -->
        <h3 class="payment-title">Metodo di pagamento</h3>
        <div id="noriks-payment" class="woocommerce-checkout-payment">
          <ul class="wc_payment_methods payment_methods methods">
            <li class="wc_payment_method payment_method_cod">
              <input id="noriks_pm_cod" type="radio" class="input-radio" name="noriks_payment" value="cod" checked='checked' data-order_button_text="">
              <label for="noriks_pm_cod">
                Pagamento alla consegna <span class="payment-fee-not-free"><span class="woocommerce-Price-amount amount">1,99<span class="woocommerce-Price-currencySymbol">&euro;</span></span></span>
                <div class="hs-checkout__payment-method-cod-icon-container">
                  <img decoding="async" class="hs-checkout__payment-method-cod-icon" src="https://images.vigo-shop.com/general/checkout/cod/uni_cash_on_delivery.svg" />
                </div>
              </label>
            </li>
            <li class="wc_payment_method payment_method_braintree_credit_card">
              <input id="noriks_pm_card" type="radio" class="input-radio" name="noriks_payment" value="stripe_cc" data-order_button_text="Ordina">
              <label for="noriks_pm_card">
                Carta di credito <span class="payment-fee-free">Gratuito</span>
                <div class="sv-wc-payment-gateway-card-icons">
                  <img decoding="async" src="https://vigoshop.hr/app/plugins/woocommerce-gateway-paypal-powered-by-braintree/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-visa.svg" alt="visa" class="sv-wc-payment-gateway-icon" width="40" height="25" style="width:40px;height:25px;" />
                  <img decoding="async" src="https://vigoshop.hr/app/plugins/woocommerce-gateway-paypal-powered-by-braintree/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-mastercard.svg" alt="mastercard" class="sv-wc-payment-gateway-icon" width="40" height="25" style="width:40px;height:25px;" />
                  <img decoding="async" src="https://vigoshop.hr/app/plugins/woocommerce-gateway-paypal-powered-by-braintree/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-maestro.svg" alt="maestro" class="sv-wc-payment-gateway-icon" width="40" height="25" style="width:40px;height:25px;" />
                </div>
              </label>
            </li>
            <li class="wc_payment_method payment_method_braintree_paypal">
              <input id="noriks_pm_paypal" type="radio" class="input-radio" name="noriks_payment" value="ppcp-gateway" data-order_button_text="Ordina">
              <label for="noriks_pm_paypal">
                PayPal <span class="payment-fee-free">Gratuito</span>
                <img decoding="async" src="https://images.vigo-shop.com/general/checkout/paypal/PayPal.svg" alt="PayPal">
              </label>
            </li>
          </ul>
        </div>

        <!-- Hidden WC #payment for AJAX + form processing -->
        <div id="payment" class="woocommerce-checkout-payment" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden;pointer-events:none;">
          <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>

        <div class="form-row place-order">
          <div class="woocommerce-terms-and-conditions-wrapper"></div>

          <!-- COD prompt -->
          <div id="hs-cod-checkout-prompt" style="display:none;">
            <div class="cod-prompt-text">Completa il tuo ordine ora, <strong>pagamento alla consegna 🙂</strong></div>
            <img decoding="async" class="cod-prompt-image" src="https://images.vigo-shop.com/general/checkout/cod/uni_cash_on_delivery.svg">
          </div>

          <!-- VAT -->
          <div id="hs-vat-tax-checkout-prompt">
            <span class="tax-and-vat-checkout-claims">Nessun costo doganale aggiuntivo</span>
            <span class="tax-and-vat-checkout-claims">IVA inclusa nel prezzo</span>
          </div>

          <!-- ORDER SUMMARY -->
          <h3 class="place-order-title" style="display:block;">Riepilogo ordine</h3>
          <div class="vigo-checkout-total order-total shop_table woocommerce-checkout-review-order-table">
            <div class="grid m-top--s review-all-products-container">
              <div class="col-xs-12 f--m flex flex--vertical vigo-checkout-total__content">
                <?php foreach ( WC()->cart->get_cart() as $item ) :
                  $p = $item['data']; $q = $item['quantity'];
                  $attrs = '';
                  if ( !empty($item['variation']) ) {
                    $parts = array();
                    foreach ($item['variation'] as $k=>$v) $parts[] = wc_attribute_label(str_replace('attribute_','',$k)).': '.$v;
                    $attrs = implode(', ',$parts);
                  }
                ?>
                <div class="c--darkgray review-section-container">
                  <div class="review-product-info">
                    <div><?php echo esc_html($q.'x '.$p->get_name()); ?></div>
                    <?php if ($attrs): ?><div class="review-product-info__attributes"><?php echo esc_html($attrs); ?></div><?php endif; ?>
                  </div>
                  <div class="info-price">
                    <span class="review-sale-price"><?php echo WC()->cart->get_product_subtotal($p,$q); ?></span>
                  </div>
                  <div class="review-product-remove"></div>
                </div>
                <?php endforeach; ?>

                <!-- Shipping -->
                <div class="c--darkgray review-section-container review-addons shipping_order_review">
                  <div class="review-addons-title"><div>Paket24 Hrvatske pošte</div></div>
                  <div class="review-addons-price review-sale-price">
                    <span class="woocommerce-Price-amount amount"><bdi>2,99<span class="woocommerce-Price-currencySymbol">&euro;</span></bdi></span>
                  </div>
                  <div class="review-product-remove"></div>
                </div>
              </div>
            </div>
            <div class="vigo-checkout-total__sum flex flex--middle border_price">
              <div class="flex__item f--l">
                Ukupni iznos: <span class="f--bold price_total_wrapper"><?php echo WC()->cart->get_total(); ?></span>
              </div>
            </div>
          </div>

          <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div><!-- .place-order -->

      </div><!-- .woocommerce-additional-fields -->
    </div><!-- .col-2 -->
  </div><!-- #customer_details -->

</form>
</div><!-- .before_form -->

<!-- Submit button — outside form, triggers hidden WC button -->
<div id="order_review" class="woocommerce-checkout-review-order container container--xs bg--white">
  <button type="button" class="button alt button--l button--block button--green button--rounded button--green-gradient"
          id="noriks_place_order" data-value="Ordina">Ordina</button>
</div>

<!-- Warranty -->
<div class="checkout-warranty flex flex--center flex--middle">
  <div class="flex__item--autosize checkout-warranty__icon">
    <img decoding="async" src="https://images.vigo-shop.com/general/guarantee_money_back/satisfaction_icon_it.png">
  </div>
  <div class="flex__item--autosize f--m checkout-warranty__text">
    <strong>Acquista senza preoccupazioni </strong><br>Rimborso possibile entro 90 giorni
  </div>
</div>

<!-- Terms -->
<div class="agreed_terms_txt">
  <span class="policy-agreement-obligation">Cliccando il pulsante <strong>Ordina</strong> accetto l'ordine con obbligo di pagamento.</span><br>
  <div class="terms-checkbox-and-links">
    <label class="checkbox">
      <input type="checkbox" class="input-checkbox" name="agree_to_checkout_terms" id="agree_to_terms_checkbox" value="1">
    </label>
    Pročitao sam i prihvaćam <a href="#" id="terms_conditions_link">Opće uvjete prodaje</a> i <a href="#" id="withdrawal_policy_link">pravo na odustajanje</a>.
  </div>
</div>

</div><!-- .wc-checkout-wrap -->

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
jQuery(function($){
  /* Delivery dates */
  var days=['domenica','lunedì','martedì','mercoledì','giovedì','venerdì','sabato'];
  function addBiz(d,n){var r=new Date(d);while(n>0){r.setDate(r.getDate()+1);if(r.getDay()!==0&&r.getDay()!==6)n--;}return r;}
  var now=new Date(),from=addBiz(now,2),to=addBiz(now,5);
  $('#js-delivery-dates').text(days[from.getDay()]+', '+from.getDate()+'.'+(from.getMonth()+1)+'. - '+days[to.getDay()]+', '+to.getDate()+'.'+(to.getMonth()+1)+'.');

  /* Payment sync: visible radios → hidden WC radios */
  $('input[name="noriks_payment"]').on('change',function(){
    var val=$(this).val();
    $('#payment input[name="payment_method"]').each(function(){
      if($(this).val()===val){$(this).prop('checked',true).trigger('change');}
    });
    $('#hs-cod-checkout-prompt').toggle(val==='cod');
  }).filter(':checked').trigger('change');

  /* Submit handled by validation in checkout_mods.php — triggers #place_order only if valid */

  /* Trigger WC checkout update */
  $(document.body).trigger('update_checkout');
});
</script>
