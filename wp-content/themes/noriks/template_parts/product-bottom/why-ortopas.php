<?php
/**
 * product-bottom: FASCIA ORTOPEDICA PER LA SCHIENA (ortopas)
 *
 * Dedicated bottom-nicer for the NORIKS orthopedic back belt.
 * Shown via single-product-bottom-nicer.php when noriks_is_type('ortopas').
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * MEDIA per sezione.
 * Video 2, 3, 4, 6 sono nel tema (git) — /img/ortopas-videos/.
 * TODO: immagini 1 (collage) e 5 (indicazioni) sono ancora versioni HR —
 *       servono le immagini IT (italiane).
 * ------------------------------------------------------------------ */
$opz_vid_dir      = get_template_directory_uri() . '/img/ortopas-videos/';
$opz_img_collage  = 'https://noriks.com/hr/wp-content/uploads/2026/07/ortopas-hr-9.png'; // 1) clienti soddisfatti (immagine) — TODO IT image
$opz_video_relief = $opz_vid_dir . 'relief.mp4';                                          // 2) sollievo naturale (video)
$opz_video_cause  = $opz_vid_dir . 'cause.mp4';                                           // 3) la vera causa (video)
$opz_img_indik    = 'https://noriks.com/hr/wp-content/uploads/2026/07/noriks_static_indikacije_HR_1x1.png'; // 5) come funziona (immagine) — TODO IT image
$opz_video_feat   = $opz_vid_dir . 'features.mp4';                                        // 6) caratteristiche innovative (video)

/* Schede (video circolari) — 4) sezione con 3 schede */
$opz_cards = array(
    array(
        'video' => $opz_vid_dir . 'card-1.mp4',
        'title' => 'Allevia i disturbi',
        'text'  => 'Può offrire un rapido sollievo dalla sciatica e dai dolori alla schiena',
    ),
    array(
        'video' => $opz_vid_dir . 'card-2.mp4',
        'title' => 'Scarico della colonna lombare',
        'text'  => 'Stabilizza e allinea la parte bassa della schiena',
    ),
    array(
        'video' => $opz_vid_dir . 'card-3.mp4',
        'title' => 'Metodo comprovato',
        'text'  => 'Basato sulla tecnologia di compressione mirata',
    ),
);

/* Tabella comparativa — 7) sezione. array( nome, NORIKS(bool), Fisio(bool) ) */
$opz_cmp_rows = array(
    array( 'Sollievo dal dolore',                 true,  true  ),
    array( 'Effetto duraturo',                    true,  false ),
    array( 'Prezzo conveniente',                  true,  false ),
    array( 'Rilassamento immediato',              true,  false ),
    array( 'Senza attese',                        true,  false ),
    array( 'Garanzia di rimborso di 60 giorni',   true,  false ),
    array( 'Costi a lungo termine',               false, true  ),
);
/* Recensioni con immagine — 8) sezione */
$opz_reviews = array(
    array(
        'img'   => get_template_directory_uri() . '/img/ortopas-reviews/review-1.webp',
        'title' => 'Grande aiuto contro i dolori nella parte bassa della schiena',
        'text'  => 'La fascia NORIKS mi ha davvero semplificato la vita. Funziona esattamente come promette. Riesco di nuovo a chinarmi senza dolore.',
        'name'  => 'Elisabetta M.',
    ),
    array(
        'img'   => get_template_directory_uri() . '/img/ortopas-reviews/review-2.jpg',
        'title' => 'Morbida e comoda',
        'text'  => 'Il mio fisioterapista mi ha consigliato una fascia contro i dolori alla schiena. Prima avevo provato anche altre fasce, ma questa è molto più comoda per stare seduti e chinarsi. Eppure offre un sostegno eccellente!',
        'name'  => 'Giulia U.',
    ),
    array(
        'img'   => get_template_directory_uri() . '/img/ortopas-reviews/review-3.webp',
        'title' => 'Fantastica!',
        'text'  => 'Mi aiuta a stare seduto dritto e ho la sensazione di camminare più eretto. I dolori si sono ridotti notevolmente e finalmente riesco ad alzarmi senza dolore anche dopo essere stato seduto a lungo. Indosso la fascia circa 2-3 ore al giorno – soprattutto al lavoro.',
        'name'  => 'Ivan D.',
    ),
);

$opz_yes = '<svg class="opz-yes" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M5 12.5l4 4 10-10" fill="none" stroke="#22a45d" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$opz_no  = '<svg class="opz-no" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M7 7l10 10M17 7L7 17" fill="none" stroke="#dc3545" stroke-width="2.4" stroke-linecap="round"/></svg>';
?>

<!-- ============ 1) Oltre 14.000 clienti soddisfatti ============ -->
<section class="opz-why opz-customers">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <img loading="lazy" decoding="async" src="<?php echo esc_url( $opz_img_collage ); ?>" alt="Clienti soddisfatti della fascia ortopedica NORIKS" />
    </div>
    <div class="opz-col opz-copy">
      <div class="opz-stars" aria-hidden="true">★★★★★</div>
      <h2 class="opz-title">Oltre 14.000 clienti soddisfatti</h2>
      <p class="opz-sub">Migliaia di persone hanno già sostituito il dolore quotidiano alla schiena con stabilità e sollievo — al lavoro, alla guida e a casa.</p>
    </div>
  </div>
</section>

<!-- ============ 2) Sollievo naturale dal dolore ============ -->
<section class="opz-why">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <video src="<?php echo esc_url( $opz_video_relief ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Sollievo naturale dal dolore</h2>
      <p>Quando indossi la fascia NORIKS, la tecnologia avanzata con <strong>due zone di compressione</strong> assicura il corretto allineamento di anche e parte bassa della schiena. Questo può stabilizzare la colonna vertebrale e scaricare il nervo sciatico.</p>
      <p>Di solito dovresti sottoporti a una fisioterapia intensa per ottenere questo sollievo. La fascia NORIKS ti permette di <strong>percepire il sollievo in tempo reale</strong> — mentre lavori o sei in movimento con i tuoi cari.</p>
      <p>Non appena la parte bassa della schiena e le anche sono correttamente sostenute, la pressione sul nervo sciatico può diminuire. Questo può tradursi in <strong>meno dolore e maggiore mobilità</strong>.</p>
    </div>
  </div>
</section>

<!-- ============ 3) La vera causa dei dolori alla schiena e della sciatica ============ -->
<section class="opz-why opz-cause">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <video src="<?php echo esc_url( $opz_video_cause ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">La vera causa dei dolori alla schiena e della sciatica</h2>
      <p>Le ore trascorse alla scrivania, i movimenti ripetitivi o il lavoro fisico pesante possono creare una <strong>pressione irregolare sui dischi intervertebrali</strong>. In combinazione con una postura scorretta, ciò può causare negli anni danni significativi alla colonna vertebrale.</p>
      <p>Di conseguenza i dischi possono scivolare dalla loro posizione e premere sul nervo sciatico, provocando <strong>dolore bruciante, formicolii e persino debolezza</strong> che si irradiano dalla parte bassa della schiena lungo le gambe.</p>
    </div>
  </div>
</section>

<!-- ============ 4) Sollievo naturale (3 schede) ============ -->
<section class="opz-why opz-cards">
  <div class="opz-wrap">
    <h2 class="opz-cards-title">Sollievo naturale dalla sciatica e dai dolori alla schiena</h2>
    <div class="opz-cards-grid">
      <?php foreach ( $opz_cards as $opz_card ) : ?>
        <div class="opz-card">
          <div class="opz-card-media">
            <video src="<?php echo esc_url( $opz_card['video'] ); ?>" muted autoplay loop playsinline preload="metadata"></video>
          </div>
          <div class="opz-card-head">
            <span class="opz-check" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="22" height="22"><circle cx="12" cy="12" r="12" fill="#28a745"/><path d="M7 12.5l3 3 7-7" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <h3 class="opz-card-title"><?php echo esc_html( $opz_card['title'] ); ?></h3>
          </div>
          <p class="opz-card-text"><?php echo esc_html( $opz_card['text'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 5) Come funziona la fascia NORIKS? ============ -->
<section class="opz-why">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <img loading="lazy" decoding="async" src="<?php echo esc_url( $opz_img_indik ); ?>" alt="Indicazioni — in cosa aiuta la fascia ortopedica NORIKS" />
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Come funziona la fascia NORIKS?</h2>
      <p>La fascia NORIKS <strong>stabilizza in modo mirato</strong> la zona L5 della colonna vertebrale con una <strong>compressione mirata</strong>, allinea correttamente il bacino e riporta l'articolazione sacroiliaca al suo naturale raggio di movimento.</p>
      <p><strong>Sostiene la zona problematica</strong>, può scaricare i dischi intervertebrali e ridurre così la pressione sul nervo sciatico.</p>
      <p>La compressione mirata stimola la circolazione sanguigna, sostenendo così il processo di autoguarigione.</p>
      <p>Questa combinazione può offrire un rapido sollievo dalla sciatica, dai dolori alla schiena e dai disturbi sacroiliaci, oltre a un <strong>sollievo duraturo dal dolore</strong> con l'uso regolare.</p>
    </div>
  </div>
</section>

<!-- ============ 6) Caratteristiche innovative ============ -->
<section class="opz-why">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <video src="<?php echo esc_url( $opz_video_feat ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Caratteristiche innovative</h2>
      <p><strong>Sottile e pratica:</strong> Sviluppata per l'uso quotidiano, si adatta comodamente sotto la maggior parte dei capi, così nessuno si accorge che la stai indossando!</p>
      <p><strong>Compressione regolabile:</strong> Ti permette di adattare il livello di sostegno alle tue esigenze e offre il massimo comfort.</p>
      <p>L'accesso a fisioterapisti e specialisti del dolore è spesso limitato e comporta costi elevati e tempo. <strong>La fascia NORIKS offre una soluzione professionale di altissimo livello</strong> e rappresenta un'alternativa efficace e accessibile.</p>
    </div>
  </div>
</section>

<!-- ============ 7) La fascia NORIKS a confronto (tabella) ============ -->
<section class="opz-why opz-compare">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-copy">
      <h2 class="opz-title">La fascia NORIKS a confronto</h2>
      <p class="opz-sub">Agisce in modo mirato sulla parte bassa della schiena per ridurre i carichi.</p>
    </div>
    <div class="opz-col">
      <table class="opz-table">
        <thead>
          <tr>
            <th class="opz-th-feat"></th>
            <th class="opz-th-brand">NORIKS</th>
            <th class="opz-th-alt">Fisio</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $opz_cmp_rows as $opz_r ) : ?>
            <tr>
              <th class="opz-feat"><?php echo esc_html( $opz_r[0] ); ?></th>
              <td class="opz-brand"><?php echo $opz_r[1] ? $opz_yes : $opz_no; ?></td>
              <td class="opz-alt"><?php echo $opz_r[2] ? $opz_yes : $opz_no; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ 8) Recensioni dei clienti (con immagine) ============ -->
<section class="opz-why opz-reviews">
  <div class="opz-wrap">
    <div class="opz-reviews-grid">
      <?php foreach ( $opz_reviews as $opz_rev ) : ?>
        <div class="opz-review">
          <div class="opz-review-media">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( $opz_rev['img'] ); ?>" alt="Fascia NORIKS — recensione del cliente <?php echo esc_attr( $opz_rev['name'] ); ?>" />
          </div>
          <div class="opz-review-stars" aria-hidden="true">★★★★★</div>
          <h3 class="opz-review-title"><?php echo esc_html( $opz_rev['title'] ); ?></h3>
          <p class="opz-review-text"><?php echo esc_html( $opz_rev['text'] ); ?></p>
          <div class="opz-review-name"><?php echo esc_html( $opz_rev['name'] ); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  /* Nessun link "Tabella delle taglie" sulla fascia (né plugin né globale). */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  /* Descrizione breve (short description) della fascia: nascondi i punti standard (•),
     resta solo ✅ dal testo; un po' di spazio tra "Vantaggi:" e la lista.
     (Questo template viene caricato solo sulle pagine orto-ortopas.) */
  .woocommerce-product-details__short-description ul {
      list-style: none;
      margin: 8px 0 26px;
      padding-left: 0;
  }
  .woocommerce-product-details__short-description ul li {
      list-style: none;
      padding-left: 0;
      margin-left: 0;
  }
  .woocommerce-product-details__short-description p:has(+ ul) {
      margin-top: 20px;
      margin-bottom: 4px;
  }

  .opz-why { padding: 44px 0; }
  .opz-why.opz-customers { background: #f7f7f7; }
  .opz-wrap { max-width: 1180px; margin: 0 auto; padding: 0 16px; }
  .opz-row { display: grid; grid-template-columns: 1fr 1fr; gap: 44px; align-items: center; }
  .opz-media img,
  .opz-media video { width: 100%; height: auto; border-radius: 12px; display: block; }
  .opz-stars { color: #f5a623; font-size: 24px; letter-spacing: 2px; margin-bottom: 10px; }
  .opz-title { font-size: clamp(26px,3.2vw,40px); font-weight: 800; color: #1c1c1c; line-height: 1.15; margin: 0 0 16px; }
  .opz-copy p { font-size: 16px; line-height: 1.7; color: #333; margin: 0 0 14px; }
  .opz-sub { font-size: 17px; line-height: 1.6; color: #333; margin: 0; }

  /* --- 4) sezione con schede (sfondo grigio / stile noriks) --- */
  .opz-why.opz-cards { background: #f7f7f7; }
  .opz-cards-title { text-align: center; font-size: clamp(22px,2.6vw,30px); font-weight: 800; color: #1c1c1c; margin: 0 0 32px; line-height: 1.2; }
  .opz-cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
  .opz-card { background: #fff; border-radius: 14px; padding: 26px 22px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
  .opz-card-media { width: 108px; height: 108px; margin: 0 auto 18px; border-radius: 50%; overflow: hidden; }
  .opz-card-media video { width: 100%; height: 100%; object-fit: cover; display: block; }
  .opz-card-head { display: flex; align-items: center; justify-content: center; gap: 8px; margin: 0 0 10px; }
  .opz-check { flex: 0 0 auto; line-height: 0; }
  .opz-card-title { font-size: 18px; font-weight: 800; color: #1c1c1c; margin: 0; line-height: 1.2; }
  .opz-card-text { font-size: 14px; line-height: 1.55; color: #555; margin: 0; }

  /* --- tabella comparativa (stile verde noriks) --- */
  .opz-why.opz-compare { background: #f7f7f7; }
  .opz-table { width: 100%; border-collapse: separate; border-spacing: 0; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,0.07); }
  .opz-table th, .opz-table td { padding: 13px 14px; text-align: center; vertical-align: middle; }
  .opz-table thead th { background: #22a45d; color: #fff; font-size: 15px; font-weight: 800; }
  .opz-table thead .opz-th-feat { background: #22a45d; }
  .opz-table .opz-feat { background: #22a45d; color: #fff; font-weight: 700; text-align: left; font-size: 14px; line-height: 1.25; width: 55%; }
  .opz-table tbody tr td { border-bottom: 1px solid #eee; background: #fff; }
  .opz-table tbody tr:last-child td,
  .opz-table tbody tr:last-child .opz-feat { border-bottom: 0; }
  .opz-table .opz-brand { background: #f2fbf6; }
  .opz-yes, .opz-no { display: inline-block; vertical-align: middle; }

  /* --- 8) recensioni dei clienti (con immagine) --- */
  .opz-reviews-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
  .opz-review { background: #fafafa; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; }
  .opz-review-media { width: 100%; aspect-ratio: 1 / 1; background: #eee; }
  .opz-review-media img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .opz-review-stars { color: #f5b301; font-size: 20px; letter-spacing: 2px; margin: 16px 0 8px; }
  .opz-review-title { font-size: 17px; font-weight: 800; color: #1c1c1c; margin: 0 14px 10px; line-height: 1.25; }
  .opz-review-text { font-size: 14px; line-height: 1.6; color: #444; margin: 0 16px 14px; }
  .opz-review-name { font-size: 13px; font-style: italic; font-weight: 700; color: #333; border-top: 1px solid #e6e6e6; margin: 0 16px; padding: 12px 0 18px; }

  @media (max-width: 820px) {
    .opz-row { grid-template-columns: 1fr; gap: 22px; }
    .opz-title { text-align: left; }
    .opz-cards-grid { grid-template-columns: 1fr; gap: 16px; }
    .opz-reviews-grid { grid-template-columns: 1fr; gap: 18px; }
    .opz-table th, .opz-table td { padding: 11px 10px; }
    .opz-table .opz-feat { font-size: 13px; }
    .opz-table thead th { font-size: 14px; }
  }
</style>
