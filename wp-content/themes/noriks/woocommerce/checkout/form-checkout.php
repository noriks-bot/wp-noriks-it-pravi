<?php
/**
<<<<<<< HEAD
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


?>







<style>

.kl_newsletter_checkbox_field  {
    
  display: none !important;
}

@media (min-width: 768px) {
    
    #order_review  #place_order {
             display: none !important;
 
    }
}


@media (max-width: 767px) {
    #customer_details #place_order {
        display: none !important;
 
    }
    
    #payment .place-order {
            margin-top: 0 !important;
 
    }
    
    #order_review  #place_order {
            margin-top: 0px !important;
 
    }
}




#order_review .woocommerce-shipping-methods .amount {
   
}

#order_review .woocommerce-shipping-methods  {
    font-size: 12px !important;
}

#order_review .shipping_method li {
    font-size: 12px !important;
}

#order_review .shipping_method label {
    font-size: 12px !important;
}


.checkout-inline-error-message  {
    color: #a91b0c;
    margin-top: 4px;
    font-size: 13px;
    margin-bottom: 0px;
}

.entry-header   {
     display: none;
}

.xoo-wsc-markup {
     display: none !important;
}

.hentry {
    margin: 0 0 0 0 !important;
}

.site-main {
    margin-bottom: 0;
}

.woocommerce-form-coupon-toggle  {
    
}

.checkout--my-header {
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
 height: auto;
    padding-top: 10px;
    padding-bottom: 15px;
    border: 1px solid #dedede;

}

.checkout--my-header a {
    display: inline-block;
}

.checkout--my-header img {
    max-width: 200px;
    height: auto !important;
}


.my-checkout-container {
    max-width: 1100px;
    display: block;
    margin: 0 auto;
}


#payment .place-order {
    padding: 0 !important;
    }

.checkout-col-right  {
    background: #fbfbfb;
    }
#order_review {
     background: #fbfbfb;
}
    
    
table:not( .has-background ) tbody td, td, th, tr, table {
   
}


table:not( .has-background ) th {
     
}


.has-background  th {
    
}


table:not( .has-background ) th {
    background-color: #fbfbfb;
}

.woocommerce-privacy-policy-text {
     display: none !important;
}
    




@media (min-width: 768px) {
    #order_review_heading, #order_review {
        width: 45%
 
    }
}


</style>

<div class="checkout--my-header">
    <a style="color:black; text-decoration: none;" href="<?php echo get_home_url(); ?>">
 <span style="color: black;
    font-family: 'Roboto', sans-serif;
    font-size: 33px;
    font-weight: bold;
    letter-spacing: 1.75px;">NORIKS</span>
    
  
  
    </a>
</div>


<?php 

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>


<style>
 .my-checkout-section {
  width: 100%;
  box-sizing: border-box;
  padding: 0; /* remove padding so background touches edge */
}

.my-checkout-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0px 20px 20px 20px;
  box-sizing: border-box;
}

.checkout-row {
  display: flex;
  flex-direction: column;
}

.checkout-column {
  padding: 15px;
  box-sizing: border-box;
}

.left-column {
  background-color: #fff;
}

.right-column {
  background-color: transparent;
}

/* Desktop: two columns with full-height right background */
@media (min-width: 768px) {
  .checkout-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    position: relative;
  }

  .my-checkout-section {
    background: linear-gradient(to right, white 50%, #fbfbfb 50%);
  }
  
  .col2-set {
      width: 45%;
  }
}





</style>


<section class="my-checkout-section"; >


    
    
<div class="my-checkout-container">

 <div class="checkout-row">
      <div class="checkout-column left-column">
   
      </div>
      <div style="" class="checkout-column right-column">
       
      </div>
    </div>





<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">



	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
			    
			    
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				
				
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>



	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	
	

	
    <div class="checkout-col-right">
        
        
        <style>
  /* ===== Coupon Inline (namespaced) ===== */
  /* Unique root to avoid clashes */
  #cci-inline-coupon-1 { /* container hook, no visual styles by default */ }

  /* Keep your original global tweak (left unchanged) */
  @media (min-width: 768px) {
    #order_review .shop_table {
      margin-bottom: 25px !important;
    }
  }

  /* Notices (scoped) */
  #cci-inline-coupon-1 .cci-notices .woocommerce-error {
    font-size: 12px !important;
    padding: 8px 10px 6px 10px !important;
    border: none !important;
    border-radius: 3px !important;
  }
  #cci-inline-coupon-1 .cci-notices .woocommerce-error:before { display: none; }

  #cci-inline-coupon-1 .cci-notices .woocommerce-message {
    font-size: 12px !important;
    padding: 8px 10px 6px 10px !important;
    border: none !important;
    border-radius: 3px !important;
  }
  #cci-inline-coupon-1 .cci-notices .woocommerce-message:before { display: none; }

  /* Layout (scoped) */
  #cci-inline-coupon-1 .cci-form-row-first {
    width: 77% !important;
    float: left;
    margin-right: 10px !important;
    clear: none !important;
    margin-bottom: 5px !important;
  }
  #cci-inline-coupon-1 .cci-form-row-last {
    width: 20% !important;
    float: right;
    margin-right: 0 !important;
    clear: none !important;
    margin-bottom: 5px !important;
  }

  @media (max-width: 767px) {
    #cci-inline-coupon-1 .form-row input {
      font-size: 13px;
      height: 40px;
    }
    #cci-inline-coupon-1 .form-row button {
      font-size: 14px !important;
      height: 40px !important;
      width: 100%;
    }
    #cci-inline-coupon-1 .cci-form-row-first {
      width: 68% !important;
      margin-right: 5px !important;
    }
    #cci-inline-coupon-1 .cci-form-row-last {
      width: 30% !important;
      float: right !important;
      text-align: right !important;
      margin-left: 0 !important;
    }
  }

  /* Button (scoped) */
  #cci-inline-coupon-1 .cci-apply-btn {
    border-radius: 4px;
    letter-spacing: -0.1px;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.318 !important;
    border: 1px solid #dedede !important;
  }

  /* Cart discount row (these target Woo output; safe to keep global, but
     we’ll scope where possible to our widget’s vicinity) */
  #cci-inline-coupon-1 ~ .cart-discount .woocommerce-remove-coupon {
    display: none;
    color: black;
  }
  #cci-inline-coupon-1 ~ .cart-discount td {
    text-align: right !important;
    font-weight: 400 !important;
    font-size: 12px !important;
    color: #11a664 !important;
  }
</style>

<!-- Coupon: namespaced -->
<section id="cci-inline-coupon-1" class="coupon-code-section coupon-code-section-mobile">
  <div class="checkout-coupon-inline">
    <p class="form-row cci-form-row-first">
      <label for="cci-coupon-input" class="screen-reader-text">
        <?php esc_html_e( 'Coupon:', 'woocommerce' ); ?>
      </label>
      <input
        type="text"
        id="cci-coupon-input"
        class="input-text"
        placeholder="<?php esc_attr_e( 'Codice sconto', 'woocommerce' ); ?>"
      />
    </p>

    <p class="form-row cci-form-row-last">
      <button
        type="button"
        id="cci-apply-btn"
        class="cci-apply-btn button"
      >
        <?php esc_html_e( 'Apply', 'woocommerce' ); ?>
      </button>
    </p>

    <div class="clear"></div>

    <!-- Notification area -->
    <div class="cci-notices inline-coupon-notices" aria-live="polite"></div>
  </div>
</section>

<script>
(function($){
  var $root = $('#cci-inline-coupon-1');
  var pendingNoticeHtml = '';
  var lastTriedCode = '';

  function ensureNoticeTarget(){
    var $t = $root.find('.cci-notices.inline-coupon-notices');
    if (!$t.length) {
      var $anchor = $root.find('.clear').last();
      $t = $('<div class="cci-notices inline-coupon-notices" aria-live="polite"></div>');
      if ($anchor.length) { $t.insertAfter($anchor); }
      else { $root.append($t); }
    }
    return $t;
  }

  function setNotice(html){
    pendingNoticeHtml = html || '';
    ensureNoticeTarget().html(pendingNoticeHtml);
  }

  function successHtml(){
    return '<div class="woocommerce-message" role="alert">Žádost o kupón.</div>';
  }
  function errorHtml(){
    return '<ul class="woocommerce-error" role="alert"><li>Unesite važeći kod za popust ili poklon karticu.</li></ul>';
  }

  // Mimic Woo's coupon class slug: lowercase, non a-z0-9 -> '-'
  function couponClassFromCode(code){
    return String(code || '')
      .toLowerCase()
      .replace(/[^a-z0-9]/g, '-')
      .replace(/-+/g, '-')
      .replace(/^-|-$/g, '');
  }

  // After fragments refresh, verify if coupon is present in totals
  $(document.body).on('updated_checkout', function(){
    if (!lastTriedCode) return;

    var slug = couponClassFromCode(lastTriedCode);
    var applied =
      $('.cart-discount.coupon-' + slug).length > 0 ||
      $('.cart-discount').filter(function(){
        return $(this).text().toLowerCase().indexOf(lastTriedCode.toLowerCase()) !== -1;
      }).length > 0;

    setNotice(applied ? successHtml() : errorHtml());
  });

  $root.on('click', '#cci-apply-btn', function(e){
    e.preventDefault();

    var code = $.trim($root.find('#cci-coupon-input').val());
    if (!code) return;

    lastTriedCode = code;   // remember which code we’re verifying
    setNotice('');          // clear old notice

    var $btn = $(this).prop('disabled', true);

    // Build Woo AJAX URL + nonce
    var ajaxUrl = (typeof wc_checkout_params !== 'undefined' && wc_checkout_params.wc_ajax_url)
      ? wc_checkout_params.wc_ajax_url
      : (typeof wc_cart_params !== 'undefined' && wc_cart_params.wc_ajax_url ? wc_cart_params.wc_ajax_url : window.location.href);
    ajaxUrl = ajaxUrl.replace('%%endpoint%%', 'apply_coupon');

    var nonce =
      (typeof wc_checkout_params !== 'undefined' && wc_checkout_params.apply_coupon_nonce) ?
        wc_checkout_params.apply_coupon_nonce :
      (typeof wc_cart_params !== 'undefined' && wc_cart_params.apply_coupon_nonce) ?
        wc_cart_params.apply_coupon_nonce :
        '';

    $.post(ajaxUrl, { coupon_code: code, security: nonce })
      .always(function(){
        // Whether success or error, let Woo refresh totals,
        // then our updated_checkout handler will show the correct notice.
        $(document.body).trigger('applied_coupon', [code]);
        $(document.body).trigger('update_checkout');
        $btn.prop('disabled', false);
      });
  });

  // Ensure notice container exists initially
  $(ensureNoticeTarget);
})(jQuery);
</script>

                              

        	<div id="order_review" class="woocommerce-checkout-review-order">
        	    
        	    <h3 class="checkout-section-title">Riepilogo ordine</h3>
        	    
        	    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
        	    
        	    
        		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
        		
        		


        		
        		
        		<!-- just some content -->
        		<div class="reviews-wrapper-my" style="background: #fbfbfb;">
        		    
        		 
        		<style>
        		
        		       @media (min-width: 768px) {
        		            #order_review .shop_table {
                                margin-bottom: 25px  !important;
                            }
        		        }
        		
        		.dekstopni .woocommerce-error {
                        font-size: 12px !important;
                        padding: 8px 10px 6px 10px !important;
                        border: none !important;
                        border-radius: 3px  !important;
                        
                }
                .dekstopni .woocommerce-error:before {
                      display:none;
                }
                .dekstopni .woocommerce-message {
                        font-size: 12px !important;
                        padding: 8px 10px 6px 10px !important;
                        border: none !important;
                         border-radius: 3px  !important;
                        
                }
                .dekstopni .woocommerce-message:before {
                      display:none;
                }
                
                
                
                
        		
        		.coupon-code-section .form-row-first {
                        width: 77% !important;
                        float: left;
                        margin-right: 10px !important;
                        clear: none !important;
                        margin-bottom: 5px !important;
                        
                }
                
                .coupon-code-section .form-row-last {
                        width: 20% !important;
                        float: right;
                        margin-right: 0px !important;
                        clear: none !important;
                        margin-bottom: 5px !important;
                }
                
                
                 @media (max-width: 767px) {
                     
                        .coupon-code-section  .form-row input  {
                            font-size: 13px;
                             height: 40px;
                        }
                        
                        .coupon-code-section   .form-row button  {
                            font-size: 14px !important;
                             height: 40px !important;
                             width: 100%;
                        }
                     
                    	.coupon-code-section .form-row-first {
                                width: 68% !important;
                                 margin-right: 5px !important;
                        }
                     
                     
        		            .coupon-code-section .form-row-last {
        		                 width: 30% !important;
                                float: right !important;
                                  text-align: right !important;
                                  margin-left: 0px !important;
                            }
        		        }
                
                
                .coupon-code-section .apply-discount-button {
                        
                        border-radius: 4px;
                        letter-spacing: -0.1px;
                        /* font-family: 'Barlow', sans-serif; */
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 1.318 !important;
                           border: 1px solid #dedede !important;
                }
                
                .cart-discount .woocommerce-remove-coupon {
                         display:none; 
                        color:black;
                }
                
                 .cart-discount td {
                        text-align: right !important;
                        font-weight: 400 !important;
                        font-size: 12px !important;
                        color: #11a664 !important;
                }
        		    
        		    
        		</style>
        		
        		<!--  
        		Kod za popust ili poklon kartica
        		-->
        		    
        		    
                    <section class="coupon-code-section">
                  <div class="checkout-coupon-inline">
                    <p class="form-row form-row-first">
                      <label for="coupon_code_inline" class="screen-reader-text">
                        <?php esc_html_e( 'Coupon:', 'woocommerce' ); ?>
                      </label>
                      <input type="text" id="coupon_code_inline" class="input-text"
                             placeholder="<?php esc_attr_e( 'Codice sconto', 'woocommerce' ); ?>" />
                    </p>
                
                    <p class="form-row form-row-last">
                      <button type="button" id="apply_coupon_inline" class="apply-discount-button button">
                        <?php esc_html_e( 'Apply', 'woocommerce' ); ?>
                      </button>
                    </p>
                
                    <div class="clear"></div>
                
                    <!-- Notification area -->
                  
                  </div>
                </section>
                
                 <div class="inline-coupon-notices dekstopni"></div>
                              
              
                   <script>
                    (function($){
                      var pendingNoticeHtml = '';
                      var lastTriedCode = '';
                    
                      function ensureNoticeTarget(){
                        var $t = $('.dekstopni');
                        if (!$t.length) {
                          var $anchor = $('.coupon-code-section .clear').last();
                          $t = $('<div class="inline-coupon-notices" aria-live="polite"></div>');
                          if ($anchor.length) { $t.insertAfter($anchor); }
                          else { $('.coupon-code-section').append($t); }
                        }
                        return $t;
                      }
                    
                      function setNotice(html){
                        pendingNoticeHtml = html || '';
                        ensureNoticeTarget().html(pendingNoticeHtml);
                      }
                    
                      function successHtml(){ return '<div class="woocommerce-message" role="alert">Kupon primijenjen.</div>'; }
                      function errorHtml(){   return '<ul class="woocommerce-error" role="alert"><li>Unesite važeći kod za popust ili poklon karticu.</li></ul>'; }
                    
                      // Mimic Woo's coupon class slug: lowercase, non a-z0-9 -> '-'
                      function couponClassFromCode(code){
                        return String(code || '')
                          .toLowerCase()
                          .replace(/[^a-z0-9]/g, '-')
                          .replace(/-+/g, '-')
                          .replace(/^-|-$/g, '');
                      }
                    
                      // After fragments refresh, verify if coupon is present in totals
                      $(document.body).on('updated_checkout', function(){
                        if (!lastTriedCode) return;
                    
                        var slug = couponClassFromCode(lastTriedCode);
                        var applied =
                          $('.cart-discount.coupon-' + slug).length > 0 ||
                          $('.cart-discount').filter(function(){
                            return $(this).text().toLowerCase().indexOf(lastTriedCode.toLowerCase()) !== -1;
                          }).length > 0;
                    
                        setNotice(applied ? successHtml() : errorHtml());
                      });
                    
                      $(document).on('click', '#apply_coupon_inline', function(e){
                        e.preventDefault();
                    
                        var code = $.trim($('#coupon_code_inline').val());
                        if (!code) return;
                    
                        lastTriedCode = code;       // remember which code we’re verifying
                        setNotice('');              // clear old notice
                    
                        var $btn = $(this).prop('disabled', true);
                    
                        // Build Woo AJAX URL + nonce
                        var ajaxUrl = (typeof wc_checkout_params !== 'undefined' && wc_checkout_params.wc_ajax_url)
                          ? wc_checkout_params.wc_ajax_url
                          : (typeof wc_cart_params !== 'undefined' && wc_cart_params.wc_ajax_url ? wc_cart_params.wc_ajax_url : window.location.href);
                        ajaxUrl = ajaxUrl.replace('%%endpoint%%', 'apply_coupon');
                    
                        var nonce =
                          (typeof wc_checkout_params !== 'undefined' && wc_checkout_params.apply_coupon_nonce) ?
                            wc_checkout_params.apply_coupon_nonce :
                          (typeof wc_cart_params !== 'undefined' && wc_cart_params.apply_coupon_nonce) ?
                            wc_cart_params.apply_coupon_nonce :
                            '';
                    
                        $.post(ajaxUrl, { coupon_code: code, security: nonce })
                          .always(function(){
                            // Whether success or error, let Woo refresh totals,
                            // then our updated_checkout handler will show the correct notice.
                            $(document.body).trigger('applied_coupon', [code]);
                            $(document.body).trigger('update_checkout');
                            $btn.prop('disabled', false);
                          });
                      });
                    
                      // Ensure notice container exists initially
                      $(ensureNoticeTarget);
                    })(jQuery);
                    </script>
                                                    		    
        		    
        		    
                	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	
	
                
                  <style>

                
                    .trust-section {
                      max-width: 100%;
                      margin: 0 auto;
                      margin-top: 30px;
                    }
                
                    .trust-header {
                      display: flex;
                      align-items: center;
                      gap: 8px;
                      font-weight: bold;
                      font-size: 16px;
                        margin-top: 25px;
                      margin-bottom: 20px;
                    }
                
                    .trust-header img {
                      height: 20px;
                    }
                
                    .reviews {
                      display: flex;
                      gap: 16px;
                     
                      margin-bottom: 20px;
                    }
                
                    .review-card {
                      flex: 1;
                      background: #fff;
                      border: 1px solid #ddd;
                      border-radius: 8px;
                      padding: 16px;
                      box-shadow: 0 2px 4px rgba(0,0,0,0.04);
                    }
                
                    .review-stars {
                      margin-bottom: 12px;
                    }
                
                    .review-title {
                      font-weight: bold;
                      margin-bottom: 8px;
                    }
                
                    .review-text {
                      font-size: 14px;
                      line-height: 1.5;
                      margin-bottom: 12px;
                    }
                
                    .review-author {
                      font-weight: bold;
                      font-size: 13px;
                    }
                
                    .features {
                      display: flex;
                      flex-direction: column;
                      gap: 20px;
                    }
                
                    .feature {
                      display: flex;
                      align-items: flex-start;
                      gap: 16px;
                    }
                
                    .feature-icon {
                      flex-shrink: 0;
                      width: 28px;
                      height: 28px;
                    }
                
                    .feature-content {
                      max-width: 540px;
                    }
                
                    .feature-title {
                      font-weight: bold;
                      margin-bottom: 4px;
                      text-transform: uppercase;
                      font-size: 13px;
                    }
                
                    .feature-text {
                      font-size: 14px;
                      line-height: 1.4;
                      color: #333;
                    }
                  </style>
                
                
                
                  <section class="trust-section">
                  
                  
                    <!-- Feature List -->
                    <div class="features">
                      <div class="feature">
                        <img src="<?php echo get_field("footer_top_icon_1","options"); ?>" alt="shirt icon" class="feature-icon">
                        <div class="feature-content">
                          <div class="feature-title"><?php echo get_field("footer_top_heading_1","options"); ?></div>
                          <div class="feature-text"><?php echo get_field("footer_top_text_1","options"); ?></div>
                        </div>
                      </div>
                
                      <div class="feature">
                        <img src="<?php echo get_field("footer_top_icon_2","options"); ?>" alt="support icon" class="feature-icon">
                        <div class="feature-content">
                          <div class="feature-title"><?php echo get_field("footer_top_heading_2","options"); ?></div>
                          <div class="feature-text"><?php echo get_field("footer_top_text_2","options"); ?></div>
                        </div>
                      </div>
                
                      <div class="feature">
                        <img src="<?php echo get_field("footer_top_icon_3","options"); ?>" alt="shipping icon" class="feature-icon">
                        <div class="feature-content">
                          <div class="feature-title"><?php echo get_field("footer_top_heading_3","options"); ?></div>
                          <div class="feature-text"><?php echo get_field("footer_top_text_3","options"); ?></div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Trustpilot Badge -->
                    <div class="trust-header">
                      <span><?php echo get_field("checkout_option_review_t1","options"); ?></span>
                      <img src="<?php echo get_field("checkout_option_review_img1","options"); ?>" alt="Trustpilot" style="height: 18px;">
                    </div>
                
                    <!-- Reviews -->
                    <div class="reviews">
                      <div class="review-card">
                        <div class="review-stars">
                          <img  src="<?php echo get_field("checkout_option_review_img1","options"); ?>"  alt="5 stars" height="14">
                        </div>
                        <div class="review-title"><?php echo get_field("checkout_option_review_r1_1","options"); ?></div>
                        <div class="review-text">
                        <?php echo get_field("checkout_option_review_r1_2","options"); ?>
                        </div>
                        <div class="review-author"><?php echo get_field("checkout_option_review_r1_3","options"); ?></div>
                      </div>
                
                      <div class="review-card">
                        <div class="review-stars">
                          <img  src="<?php echo get_field("checkout_option_review_img1","options"); ?>"  alt="5 stars" height="14">
                        </div>
                        <div class="review-title"><?php echo get_field("checkout_option_review_r2_1","options"); ?></div>
                        <div class="review-text">
                         <?php echo get_field("checkout_option_review_r2_2","options"); ?>
                        </div>
                        <div class="review-author"><?php echo get_field("checkout_option_review_r3_2","options"); ?></div>
                      </div>
                    </div>
                
                  
                  </section>
                

        		        
        		        
        		    
        		</div>
        		<!-- just some content -->
        		
        		
        	</div>

    </div>




</form>

</div>

</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
=======
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
      action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="Πληρωμή">

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
          <h3>Αποστολή</h3>
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
                    <span class="delivery_img"><img decoding="async" class="elta_courier standard" src="https://images.vigo-shop.com/general/curriers/home_small_paket24@2x.png"/></span>
                  </div>
                </div>
              </label>
            </li>
          </ul>
          <div class="delivery-from-eu-warehouse">
            <img decoding="async" class="delivery-from-eu-warehouse__icon" src="https://images.vigo-shop.com/general/flags/eu-warehouse.svg">
            <span class="delivery-from-eu-warehouse__text">Αποθήκη στην ΕΕ</span>
          </div>
        </div>

        <!-- PAYMENT METHODS (visible) -->
        <h3 class="payment-title">Τρόπος πληρωμής</h3>
        <div id="noriks-payment" class="woocommerce-checkout-payment">
          <ul class="wc_payment_methods payment_methods methods">
            <li class="wc_payment_method payment_method_cod">
              <input id="noriks_pm_cod" type="radio" class="input-radio" name="noriks_payment" value="cod" checked='checked' data-order_button_text="">
              <label for="noriks_pm_cod">
                Αντικαταβολή κατά την παραλαβή <span class="payment-fee-not-free"><span class="woocommerce-Price-amount amount">1,99<span class="woocommerce-Price-currencySymbol">&euro;</span></span></span>
                <div class="hs-checkout__payment-method-cod-icon-container">
                  <img decoding="async" class="hs-checkout__payment-method-cod-icon" src="https://images.vigo-shop.com/general/checkout/cod/uni_cash_on_delivery.svg" />
                </div>
              </label>
            </li>
            <li class="wc_payment_method payment_method_braintree_credit_card">
              <input id="noriks_pm_card" type="radio" class="input-radio" name="noriks_payment" value="stripe_cc" data-order_button_text="Παραγγελία">
              <label for="noriks_pm_card">
                Πιστωτική κάρτα <span class="payment-fee-free">Δωρεάν</span>
                <div class="sv-wc-payment-gateway-card-icons">
                  <img decoding="async" src="https://vigoshop.hr/app/plugins/woocommerce-gateway-paypal-powered-by-braintree/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-visa.svg" alt="visa" class="sv-wc-payment-gateway-icon" width="40" height="25" style="width:40px;height:25px;" />
                  <img decoding="async" src="https://vigoshop.hr/app/plugins/woocommerce-gateway-paypal-powered-by-braintree/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-mastercard.svg" alt="mastercard" class="sv-wc-payment-gateway-icon" width="40" height="25" style="width:40px;height:25px;" />
                  <img decoding="async" src="https://vigoshop.hr/app/plugins/woocommerce-gateway-paypal-powered-by-braintree/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-maestro.svg" alt="maestro" class="sv-wc-payment-gateway-icon" width="40" height="25" style="width:40px;height:25px;" />
                </div>
              </label>
            </li>
            <li class="wc_payment_method payment_method_braintree_paypal">
              <input id="noriks_pm_paypal" type="radio" class="input-radio" name="noriks_payment" value="ppcp-gateway" data-order_button_text="Παραγγελία">
              <label for="noriks_pm_paypal">
                PayPal <span class="payment-fee-free">Δωρεάν</span>
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
            <div class="cod-prompt-text">Ολοκληρώστε την παραγγελία σας τώρα, <strong>πληρωμή με αντικαταβολή 🙂</strong></div>
            <img decoding="async" class="cod-prompt-image" src="https://images.vigo-shop.com/general/checkout/cod/uni_cash_on_delivery.svg">
          </div>

          <!-- VAT -->
          <div id="hs-vat-tax-checkout-prompt">
            <span class="tax-and-vat-checkout-claims">Χωρίς επιπλέον τελωνειακά έξοδα</span>
            <span class="tax-and-vat-checkout-claims">Ο ΦΠΑ περιλαμβάνεται στην τιμή</span>
          </div>

          <!-- ORDER SUMMARY -->
          <h3 class="place-order-title" style="display:block;">Σύνοψη παραγγελίας</h3>
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
          id="noriks_place_order" data-value="Παραγγελία">Παραγγελία</button>
</div>

<!-- Warranty -->
<div class="checkout-warranty flex flex--center flex--middle">
  <div class="flex__item--autosize checkout-warranty__icon">
    <img decoding="async" src="https://images.vigo-shop.com/general/guarantee_money_back/satisfaction_icon_gr.png">
  </div>
  <div class="flex__item--autosize f--m checkout-warranty__text">
    <strong>Αγοράστε χωρίς ανησυχία </strong><br>Επιστροφή χρημάτων εντός 90 ημερών
  </div>
</div>

<!-- Terms -->
<div class="agreed_terms_txt">
  <span class="policy-agreement-obligation">Κάνοντας κλικ στο κουμπί <strong>Παραγγελία</strong> αποδέχομαι την παραγγελία με υποχρέωση πληρωμής.</span><br>
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
  var days=['Κυριακή','Δευτέρα','Τρίτη','Τετάρτη','Πέμπτη','Παρασκευή','Σάββατο'];
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
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
