<?php
/**
 * NORIKS — upsell na stranici proizvoda ("Kupi zajedno i uštedi").
 *
 * Okvir se prikazuje ODMAH ISPOD gumba "Dodaj u košaricu" i nudi 3x Plave Bokserice
 * po istoj cijeni kao post-purchase upsell na thank you stranici (14,97 € za 3 kom).
 *
 * - Uključuje se ACF prekidačem `noriks_pp_upsell` (polje registrirano u KODU, dolje).
 *   Prekidač je per-proizvod, pa se upsell može uključiti samo tamo gdje ga želimo.
 * - Kupac bira SAMO veličinu (jedan izbornik, sva 3 komada iste veličine).
 * - Kad je kvačica označena, uz glavni proizvod se u košaricu dodaje zasebna stavka
 *   (varijacija plavih bokserica) s upsell cijenom.
 * - Stavka se u narudžbi označava meta poljem `_noriks_upsell` = 'product_page_upsell'
 *   (isti mehanizam kao sidecart i thank you upsell).
 *
 * Dizajn preslikan s referentne stranice (narančasta shema #ff5b01) + izbornik veličine
 * u stilu postojećih izbornika u bundle selectoru (#ff6d2e).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================
 * 1) ACF prekidač — registriran u kodu (kao orto countdown polja)
 * ============================================================ */
add_action( 'acf/init', 'noriks_pp_upsell_register_fields' );
function noriks_pp_upsell_register_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( array(
		'key'    => 'group_noriks_pp_upsell',
		'title'  => 'Upsell na stranici proizvoda',
		'fields' => array(
			array(
				'key'          => 'field_noriks_pp_upsell',
				'label'        => 'Mostra upsell sotto il pulsante (3x Boxer blu)',
				'name'         => 'noriks_pp_upsell',
				'type'         => 'true_false',
				'instructions' => 'Aggiunge il riquadro "Acquista insieme e risparmia" subito sotto il pulsante Aggiungi al carrello. Il cliente sceglie la taglia e 3 pezzi vengono aggiunti al prezzo upsell. Vale solo per questo prodotto.',
				'ui'           => 1,
			),
		),
		'location'   => array(
			array(
				array( 'param' => 'post_type', 'operator' => '==', 'value' => 'product' ),
			),
		),
		'menu_order' => 5,
	) );
}

/* ============================================================
 * 2) Konfiguracija upsell ponude
 * ============================================================ */
function noriks_pp_upsell_config() {
	return apply_filters( 'noriks_pp_upsell_config', array(
		'product_id' => 2793,                    // Plave Bokserice (varijabilni proizvod)
		'qty'        => 3,                       // uvijek 3 komada, iste veličine
		'total'      => 14.97,                   // ista cijena kao thank you upsell (3 x 4,99)
		'title'      => '3x Boxer blu',
		'desc'       => 'Traspiranti e morbidi — aggiungili all\'ordine con il %s%% di sconto.', // %s = izracunati popust
		'size_attr'  => 'Taglia',
		// Kompozitna slika 3 komada na svijetlo sivoj podlozi (kvadratna).
		'image'      => get_template_directory_uri() . '/img/upsell/upsell-3x-modre.png',
	) );
}

/** Je li upsell uključen za dani proizvod (ACF prekidač). */
function noriks_pp_upsell_enabled( $product_id = 0 ) {
	$product_id = $product_id ? (int) $product_id : (int) get_the_ID();
	if ( ! $product_id || ! function_exists( 'get_field' ) ) {
		return false;
	}
	$cfg = noriks_pp_upsell_config();
	if ( $product_id === (int) $cfg['product_id'] ) {
		return false; // nikad na samom upsell proizvodu
	}
	return (bool) get_field( 'noriks_pp_upsell', $product_id );
}

/** Dostupne veličine upsell proizvoda -> array( velicina => variation_id ). */
function noriks_pp_upsell_sizes() {
	$cfg     = noriks_pp_upsell_config();
	$product = wc_get_product( $cfg['product_id'] );
	$out     = array();

	if ( ! $product || ! $product->is_type( 'variable' ) ) {
		return $out;
	}
	foreach ( $product->get_children() as $vid ) {
		$var = wc_get_product( $vid );
		if ( ! $var || ! $var->is_in_stock() || ! $var->is_purchasable() ) {
			continue;
		}
		$size = $var->get_attribute( $cfg['size_attr'] );
		if ( $size === '' ) {
			$attrs = $var->get_variation_attributes();
			$size  = $attrs ? (string) reset( $attrs ) : '';
		}
		if ( $size !== '' && ! isset( $out[ $size ] ) ) {
			$out[ $size ] = (int) $vid;
		}
	}
	return $out;
}

/* ============================================================
 * 3) Prikaz okvira ispod gumba "Dodaj u košaricu"
 * ============================================================ */
add_action( 'woocommerce_after_add_to_cart_button', 'noriks_pp_upsell_render', 15 );
function noriks_pp_upsell_render() {
	if ( ! noriks_pp_upsell_enabled() ) {
		return;
	}

	$cfg     = noriks_pp_upsell_config();
	$product = wc_get_product( $cfg['product_id'] );
	if ( ! $product ) {
		return;
	}

	$sizes = noriks_pp_upsell_sizes();
	if ( empty( $sizes ) ) {
		return; // nema dostupnih veličina -> ne prikazuj ništa
	}

	// Redovna cijena = zbroj redovnih cijena pojedinačnih komada.
	$unit_regular = 0.0;
	foreach ( $sizes as $vid ) {
		$var = wc_get_product( $vid );
		if ( $var ) {
			$unit_regular = (float) $var->get_regular_price();
			break;
		}
	}
	$regular_total = $unit_regular * (int) $cfg['qty'];
	// Popust se racuna iz stvarnih cijena (postotak se razlikuje po trzistu).
	$discount = ( $regular_total > 0 ) ? (int) round( ( 1 - ( (float) $cfg['total'] / $regular_total ) ) * 100 ) : 0;
	$desc     = ( strpos( $cfg['desc'], '%s' ) !== false ) ? sprintf( $cfg['desc'], $discount ) : $cfg['desc'];

	$image = ! empty( $cfg['image'] ) ? $cfg['image'] : wp_get_attachment_image_url( $product->get_image_id(), 'medium' );
	if ( ! $image ) {
		$image = wc_placeholder_img_src( 'medium' );
	}
	?>
	<div class="npu-wrap">
		<span class="npu-label">Acquista insieme e risparmia:</span>

		<div class="npu-box" id="npu-box">
			<div class="npu-grid">
				<span class="npu-img-wrap">
					<img class="npu-img" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $cfg['title'] ); ?>" loading="lazy">
				</span>

				<div class="npu-info">
					<p class="npu-title"><?php echo esc_html( $cfg['title'] ); ?></p>
					<div class="npu-desc"><?php echo esc_html( $desc ); ?></div>
					<div class="npu-prices">
						<span class="npu-price"><?php echo wc_price( (float) $cfg['total'] ); ?></span>
						<?php if ( $regular_total > 0 ) : ?>
							<span class="npu-price-old"><?php echo wc_price( $regular_total ); ?></span>
						<?php endif; ?>
					</div>
				</div>

				<div class="npu-actions">
					<label class="npu-check">
						<input type="checkbox" id="npu-toggle" name="noriks_pp_upsell" value="1">
						<span class="npu-box-mark" aria-hidden="true"></span>
						<span class="npu-check-text">Aggiungi all'acquisto</span>
					</label>

					<select class="npu-size" name="noriks_pp_upsell_size" aria-label="Taglia dei boxer">
						<?php foreach ( array_keys( $sizes ) as $size ) : ?>
							<option value="<?php echo esc_attr( $size ); ?>"><?php echo esc_html( $size ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
	</div>

	<style>
	/* Sve vrijednosti eksplicitne — tema inače nameće svoju boju (#6d6d6d),
	   liniju (1.618) i težinu (400) pa je izgled odstupao od reference. */
	.npu-wrap {
		--npu-accent: #ff5b01;
		--npu-accent-light: #ffeee8;
		--npu-ink: #1a1a1a;
		margin: 18px 0 6px;
	}
	.npu-wrap .npu-label {
		display: block; font-size: 16px !important; font-weight: 400 !important;
		line-height: 1.4 !important; color: var(--npu-ink) !important; margin: 0 0 8px;
	}
	.npu-wrap .npu-box {
		border: 2px solid var(--npu-accent);
		border-radius: 8px;
		box-shadow: 0 2px 3px 0 #00000029;
		padding: 10px;
		background-color: #fafafb;   /* svjetlije od podloge slike (#f2f2f4) */
		color: var(--npu-ink);
		font-size: 16px;
		line-height: 1.4;
		transition: background-color .15s ease;
	}
	.npu-wrap .npu-box.npu-checked { background-color: var(--npu-accent-light); }
	.npu-wrap .npu-grid { display: grid; grid-template-columns: auto minmax(0,1fr); column-gap: 14px; row-gap: 12px; }
	/* slika ide do samog ruba okvira: negativne margine ponistavaju padding kutije,
	   a lijevi kutovi prate unutarnji radijus (8px - 2px obrub = 6px) */
	.npu-wrap .npu-img-wrap {
		grid-column: 1 / 2; grid-row: 1 / 3; align-self: stretch;
		margin: -10px 0 -10px -10px;
		width: clamp(104px, 30vw, 160px);
		background-color: #f2f2f4;
		border-radius: 6px 0 0 6px;
		overflow: hidden;
		display: block;
	}
	.npu-wrap .npu-img {
		display: block; width: 100%; height: 100%; min-height: 100%;
		object-fit: cover; border-radius: 0;
	}
	.npu-wrap .npu-info { grid-column: 2 / -1; }   /* auto-placement -> 1. red */
	.npu-wrap .npu-title {
		font-size: 17px !important; font-weight: 700 !important; line-height: 1.3 !important;
		color: var(--npu-ink) !important; margin: 0 0 6px !important; padding: 0;
	}
	.npu-wrap .npu-desc {
		font-size: 15px !important; line-height: 1.45 !important; color: #3d3d3d !important; margin: 0;
	}
	.npu-wrap .npu-prices { margin-top: 10px; line-height: 1; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
	.npu-wrap .npu-price {
		display: inline-block; font-size: 17px !important; font-weight: 700 !important; line-height: 1.15 !important;
		color: #fff !important; background-color: var(--npu-accent);
		border-radius: 6px; padding: 6px 11px 5px; white-space: nowrap;
	}
	.npu-wrap .npu-price .woocommerce-Price-amount,
	.npu-wrap .npu-price bdi { color: #fff !important; font-weight: 700 !important; }
	.npu-wrap .npu-price-old {
		font-size: 16px !important; font-weight: 600 !important; line-height: 1.15 !important;
		color: var(--npu-ink) !important; text-decoration: line-through;
	}
	.npu-wrap .npu-price-old .woocommerce-Price-amount,
	.npu-wrap .npu-price-old bdi { color: var(--npu-ink) !important; text-decoration: line-through; }
	.npu-wrap .npu-box p:last-child { margin: 0; }

	.npu-wrap .npu-actions {
		grid-column: 2 / -1;                    /* bez grid-row: auto-placement -> 2. red */
		display: flex; align-items: center; justify-content: flex-start;
		gap: 14px; flex-wrap: wrap;
	}
	.npu-wrap .npu-check { display: inline-flex; align-items: center; gap: 10px; cursor: pointer; margin: 0; padding: 0; }
	.npu-wrap .npu-check input[type="checkbox"] { position: absolute; opacity: 0; width: 0; height: 0; }
	.npu-wrap .npu-box-mark {
		width: 30px; height: 30px; flex: 0 0 30px; display: inline-block; position: relative;
		background-color: #fff; border: 2px solid #d9d9d9; border-radius: 7px; box-sizing: border-box;
	}
	.npu-wrap .npu-check input[type="checkbox"]:checked + .npu-box-mark { border-color: var(--npu-accent); }
	.npu-wrap .npu-check input[type="checkbox"]:checked + .npu-box-mark::before {
		content: ""; position: absolute; left: 9px; top: 3px; width: 9px; height: 16px;
		border-right: 4px solid var(--npu-accent); border-bottom: 4px solid var(--npu-accent);
		transform: rotate(40deg); -webkit-backface-visibility: hidden;
	}
	.npu-wrap .npu-check input[type="checkbox"]:focus-visible + .npu-box-mark { outline: 2px solid var(--npu-accent); outline-offset: 2px; }
	.npu-wrap .npu-check-text {
		font-size: 16px !important; font-weight: 700 !important; line-height: 1.2 !important;
		color: var(--npu-ink) !important;
	}

	/* izbornik veličine — stil postojećih izbornika u bundle selectoru,
	   visina usklađena s kvačicom (30px) da red bude poravnat */
	.npu-wrap .npu-size {
		flex: 0 0 auto; max-width: 150px; min-width: 84px;
		height: 30px; line-height: 1; box-sizing: border-box;
		margin: 0; padding: 0 28px 0 11px; border-radius: 6px; border: 2px solid #ff6d2e;
		background-color: #ffffff; font-size: 16px !important; font-weight: 700 !important; color: #333 !important;
		appearance: none; -webkit-appearance: none; -moz-appearance: none;
		background-image: linear-gradient(45deg, transparent 50%, #444 50%),
		                  linear-gradient(135deg, #444 50%, transparent 50%);
		background-position: calc(100% - 15px) 50%, calc(100% - 10px) 50%;
		background-size: 6px 6px, 6px 6px; background-repeat: no-repeat;
	}
	.npu-wrap .npu-size:focus { outline: 2px solid var(--npu-accent); outline-offset: 1px; }

	@media (max-width: 560px) {
		.npu-wrap .npu-grid { column-gap: 10px; row-gap: 10px; }
		.npu-wrap .npu-img-wrap { width: clamp(96px, 28vw, 130px); }
		.npu-wrap .npu-title { font-size: 16px !important; }
		.npu-wrap .npu-desc { font-size: 14px !important; }
		.npu-wrap .npu-price { font-size: 16px !important; }
		.npu-wrap .npu-actions { gap: 10px; }
	}
	</style>

	<script>
	(function () {
		var box = document.getElementById('npu-box');
		var cb  = document.getElementById('npu-toggle');
		if (!box || !cb) { return; }
		function paint() { box.classList.toggle('npu-checked', cb.checked); }
		cb.addEventListener('change', paint);
		paint();
		/* klik bilo gdje po okviru (osim po izborniku veličine) prebacuje kvačicu */
		box.addEventListener('click', function (e) {
			if (e.target.closest('.npu-size') || e.target.closest('.npu-check')) { return; }
			cb.checked = !cb.checked;
			cb.dispatchEvent(new Event('change', { bubbles: true }));
		});
	})();
	</script>
	<?php
}

/* ============================================================
 * 4) Dodavanje u košaricu uz glavni proizvod
 * ============================================================ */
add_action( 'woocommerce_add_to_cart', 'noriks_pp_upsell_maybe_add', 20, 6 );
function noriks_pp_upsell_maybe_add( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
	static $busy = false;

	if ( $busy || ! empty( $cart_item_data['_noriks_pp_upsell'] ) ) {
		return; // sprječava rekurziju kod dodavanja same upsell stavke
	}
	if ( empty( $_POST['noriks_pp_upsell'] ) ) {
		return;
	}
	if ( ! noriks_pp_upsell_enabled( $product_id ) ) {
		return;
	}

	$cfg   = noriks_pp_upsell_config();
	$sizes = noriks_pp_upsell_sizes();
	if ( empty( $sizes ) ) {
		return;
	}

	$size = isset( $_POST['noriks_pp_upsell_size'] )
		? sanitize_text_field( wp_unslash( $_POST['noriks_pp_upsell_size'] ) )
		: '';
	if ( $size === '' || ! isset( $sizes[ $size ] ) ) {
		$size = (string) key( $sizes ); // sigurnosna mreža: prva dostupna veličina
	}

	$variation_id_upsell = (int) $sizes[ $size ];
	$var                 = wc_get_product( $variation_id_upsell );
	if ( ! $var ) {
		return;
	}

	$qty  = max( 1, (int) $cfg['qty'] );
	$unit = round( (float) $cfg['total'] / $qty, 2 );

	$busy = true;
	WC()->cart->add_to_cart(
		(int) $cfg['product_id'],
		$qty,
		$variation_id_upsell,
		$var->get_variation_attributes(),
		array(
			'_noriks_pp_upsell'      => 1,
			'_noriks_pp_upsell_unit' => $unit,
			'_noriks_pp_upsell_key'  => md5( 'npu' . $variation_id_upsell . microtime( true ) ),
		)
	);
	$busy = false;
}

/* Vrati custom podatke stavke iz sesije. */
add_filter( 'woocommerce_get_cart_item_from_session', 'noriks_pp_upsell_from_session', 20, 2 );
function noriks_pp_upsell_from_session( $cart_item, $values ) {
	if ( ! empty( $values['_noriks_pp_upsell'] ) ) {
		$cart_item['_noriks_pp_upsell']      = $values['_noriks_pp_upsell'];
		$cart_item['_noriks_pp_upsell_unit'] = $values['_noriks_pp_upsell_unit'] ?? null;
	}
	return $cart_item;
}

/* Upsell cijena u košarici. */
add_action( 'woocommerce_before_calculate_totals', 'noriks_pp_upsell_apply_price', 25 );
function noriks_pp_upsell_apply_price( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}
	if ( ! $cart instanceof WC_Cart ) {
		return;
	}
	foreach ( $cart->get_cart() as $item ) {
		if ( ! empty( $item['_noriks_pp_upsell'] ) && isset( $item['_noriks_pp_upsell_unit'] ) && $item['data'] instanceof WC_Product ) {
			$item['data']->set_price( (float) $item['_noriks_pp_upsell_unit'] );
		}
	}
}

/* ============================================================
 * 5) Oznaka u narudžbi (isto kao sidecart / thank you upsell)
 * ============================================================ */
add_action( 'woocommerce_checkout_create_order_line_item', 'noriks_pp_upsell_order_item_meta', 20, 4 );
function noriks_pp_upsell_order_item_meta( $item, $cart_item_key, $values, $order ) {
	if ( ! empty( $values['_noriks_pp_upsell'] ) ) {
		$item->add_meta_data( '_noriks_upsell', 'product_page_upsell', true );
	}
}
