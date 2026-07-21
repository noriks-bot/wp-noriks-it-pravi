<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>

<!--
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
-->


<!-- my thre icons content -->

<!--
<div class="features">
    <div class="feature-card">
      <img src="<?php echo get_field("singlepp_icon_img1","option"); ?>" alt="Perfect Fit">
      <p><?php echo get_field("singlepp_icon_t1","option"); ?></p>
    </div>
    <div class="feature-card">
      <img src="<?php echo get_field("singlepp_icon_img2","option"); ?>" alt="Hides Dad Bod">
      <p><?php echo get_field("singlepp_icon_t2","option"); ?></p>
    </div>
    <div class="feature-card">
      <img src="<?php echo get_field("singlepp_icon_img3","option"); ?>" alt="Breathes">
       <p><?php echo get_field("singlepp_icon_t3","option"); ?></p>
    </div>
  </div>
-->

<style>


    .features {
      display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-top: 20px;
    }

    .feature-card {
    display: flex
;
    flex-direction: column;
    align-items: center;
    flex: 1;
    gap: 8px;
    border-radius: 5px;
    background: #F4F4F4;
    padding: 16px;
    font-size: 14px;
    font-weight: 400;
    color: #111213;
    line-height: 1.2;
    text-align: center;
    }

    .feature-card img {
      width: 32px;
      height: 32px;
      margin-bottom: 0px;
    }

    .feature-card p {
      margin: 0;
      font-weight: 500;
      font-size: 14px;
      color: #222;
       letter-spacing: -0.5px !important;
    }
  </style>

<?php if ( function_exists('noriks_is_type') && noriks_is_type('norikshers') ) : ?>
<div class="nhs-usp">
  <div class="nhs-usp-guarantee"><svg width="15" height="15" viewBox="0 0 24 24" style="flex:0 0 auto;"><circle cx="12" cy="12" r="12" fill="#7c3aed"/><path d="M7 12.5l3 3 7-7" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg> Garanzia soddisfatti o rimborsati 30 giorni</div>
  <div class="nhs-usp-grid">
    <div><span class="nhs-usp-ic">≈</span> Riduce le rughe</div>
    <div><span class="nhs-usp-ic">↓</span> Riduce le linee sottili</div>
    <div><span class="nhs-usp-ic">♡</span> Attenua le cicatrici durante la notte</div>
    <div><span class="nhs-usp-ic">✚</span> Extra adesivo</div>
    <div><span class="nhs-usp-ic">✓</span> Riutilizzabile e resistente</div>
    <div><span class="nhs-usp-ic">↗</span> Stimola la produzione di collagene</div>
  </div>
</div>
<style>
  .nhs-usp { margin: 6px 0 2px; }
  .nhs-usp-guarantee { display: inline-flex; align-items: center; gap: 9px; background: #f6f2ff; border: 1px dashed #c3aef0; border-radius: 999px; padding: 8px 18px; font-size: 13.5px; font-weight: 600; color: #180D33; margin-bottom: 18px; }
  .nhs-usp-guarantee span { color: #7c3aed; }
  .nhs-usp-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5px 7px; }
  .nhs-usp-grid > div { display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #2a2340; }
  .nhs-usp-ic { flex: 0 0 auto; width: 20px; text-align: center; color: #180D33; font-size: 15px; }
  @media (max-width: 560px) { .nhs-usp-grid { gap: 5px 8px; } .nhs-usp-grid > div { font-size: 13px; } .nhs-usp-ic { width: 18px; font-size: 14px; } }
  /* Countdown su questo prodotto: grigio neutro (senza rosso). */
  .gck-countdown { background: #ededed !important; border: 1px solid #f7f7f7 !important; border-radius: 0 !important; color: #333 !important; text-align: left !important; }
  .gck-countdown * { color: #333 !important; }
  /* Discount badge (−33% …): viola su questo prodotto. */
  .gck-discount-badge { background: #7c3aed !important; color: #fff !important; }
  /* Pulsanti radio bundle: viola su questo prodotto. */
  .bundle-option input[type="radio"] { border-color: #7c3aed !important; }
  .bundle-option input[type="radio"]::before { background: #7c3aed !important; }
  .bundle-option input[type="radio"]:checked::before { background: #7c3aed !important; }
</style>
<?php endif; ?>
