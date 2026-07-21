<?php
/**
 * product-bottom: CORRETTORE ALLUCE VALGO (bunion / halux valgus)
 *
 * Dedicated bottom-nicer for the NORIKS bunion corrector.
 * Shown via single-product-bottom-nicer.php when noriks_is_type('bunion').
 *
 * Media nel tema (git), relativo via get_template_directory_uri():
 *   img/bunion-videos/section-1.mp4, funkcionira.mp4, step-1..3.mp4
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$bun_vid_dir = get_template_directory_uri() . '/img/bunion-videos/';
$bun_video_1 = $bun_vid_dir . 'section-1.mp4'; // 1) One foot away
$bun_video_2 = $bun_vid_dir . 'funkcionira.mp4'; // 2) Come funziona

$bun_img_features = get_template_directory_uri() . '/img/bunion/why.png';

// Risultati reali — percentuali
$bun_results = array(
    array( 'pct' => 91, 'text' => 'degli utenti ha riferito una riduzione del dolore da alluce valgo già dalla 2ª sessione' ),
    array( 'pct' => 90, 'text' => 'degli utenti ha eliminato completamente il dolore da alluce valgo dopo appena 14 giorni di uso costante (30 min/giorno)' ),
    array( 'pct' => 88, 'text' => 'degli utenti ha notato miglioramenti visibili nell\'allineamento delle dita dopo appena 30 giorni di uso costante (30 min/giorno)' ),
);

// Perché scegliere noi — confronto (stesso stile della tabella knc sulle calze con zip)
$bun_cmp = array(
    'Garanzia di rimborso di 90 giorni',
    'Allevia il disagio',
    'Previene la crescita dell\'alluce valgo',
    'Migliora nel tempo la condizione dell\'alluce valgo',
    'Design flessibile — puoi camminarci',
    'Resistente e duraturo',
);

// Come si usa — 3 passaggi (video + descrizione)
$bun_steps = array(
    array( 'video' => $bun_vid_dir . 'step-1.mp4', 'caption' => 'Fissa il correttore NORIKS all\'alluce e al piede' ),
    array( 'video' => $bun_vid_dir . 'step-2.mp4', 'caption' => 'Regola l\'intensità dello stretching a piacere' ),
    array( 'video' => $bun_vid_dir . 'step-3.mp4', 'caption' => 'Rilassati e lascia che il correttore NORIKS faccia il suo lavoro' ),
);
?>

<!-- ============ 1) Sei a un passo… ============ -->
<section class="bun-why bun-intro">
  <div class="bun-wrap bun-row">
    <div class="bun-col bun-media">
      <video src="<?php echo esc_url( $bun_video_1 ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="bun-col bun-copy">
      <h2 class="bun-title">Sei a un passo dal liberarti del <span class="bun-hl">disagio da alluce valgo</span>, delle dita gonfie e dei dolori ai piedi…</h2>
      <p>Se stai leggendo questo, è molto probabile che tu soffra di un persistente <strong class="bun-red">disagio da alluce valgo</strong>.</p>
      <p>Il risultato? Dolore e disagio che influenzano le tue attività quotidiane.</p>
      <p>Se non trattati, possono peggiorare. Le dita si accavallano, possono svilupparsi dita a martello ed escrescenze ossee.</p>
      <p>L'alluce valgo è un <strong class="bun-red">problema progressivo</strong> e non scomparirà da solo.</p>
      <p>Col tempo può portare a problemi più gravi, come <u>chirurgia invasiva, disturbi ad anche, ginocchia e parte bassa della schiena e persino immobilità</u>.</p>
      <p>Grazie alla terapia di allineamento avanzata clinicamente provata e al meccanismo a snodo brevettato, il <strong>correttore per alluce valgo NORIKS</strong> allevia efficacemente il disagio nella zona interessata del piede e ripristina la salute del tuo piede con soli 30 minuti di uso quotidiano.</p>
      <p class="bun-stat"><span class="bun-check" aria-hidden="true">✔</span> <em>Il 91 % degli utenti ha riferito una <strong>riduzione del dolore ai piedi</strong> già nella prima settimana</em></p>
    </div>
  </div>
</section>

<!-- ============ 2) Come funziona? ============ -->
<section class="bun-why">
  <div class="bun-wrap bun-row bun-reverse">
    <div class="bun-col bun-media">
      <video src="<?php echo esc_url( $bun_video_2 ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="bun-col bun-copy">
      <h2 class="bun-title">Come funziona?</h2>
      <p>Il <strong>correttore per alluce valgo NORIKS</strong> utilizza una terapia di allineamento avanzata. È progettato per <strong class="bun-red">sostenere il riallineamento</strong> dell'alluce e ridurre gradualmente l'infiammazione grazie a un potente meccanismo a snodo brevettato.</p>
      <p>Aiuta a rilasciare la tensione muscolare riportando delicatamente l'alluce nella sua posizione naturale, portando col tempo a un allineamento naturale e indolore dell'articolazione del dito.</p>
      <p>Così si allenta la tensione accumulata negli anni, la sporgenza si corregge e si riduce, il dolore si allevia e si previene un'ulteriore crescita — per rimetterti in piedi, dritto e sicuro.</p>
      <p>Alcuni utenti potrebbero aver bisogno di una o due sessioni per abituarsi, poiché la <strong class="bun-red">sensazione può essere più marcata</strong> rispetto ad altri metodi.</p>
      <p>È un modo naturale e non invasivo per ripristinare la posizione naturale del dito e del piede e per riparare i danni causati da calzature inadeguate o dalla genetica.</p>
      <p>Che si tratti di un piccolo piede di bambino o di un grande piede da adulto, <u>il correttore è realizzato per adattarsi comodamente a tutte le taglie di piede</u>.</p>
      <p class="bun-stat"><span class="bun-check" aria-hidden="true">✔</span> <em>L'87 % degli utenti ha riferito <strong>miglioramenti visibili</strong> già nel primo mese</em></p>
    </div>
  </div>
</section>

<!-- ============ 3) Come si usa (grigio, 3 passaggi) ============ -->
<section class="bun-why bun-howto">
  <div class="bun-wrap">
    <h2 class="bun-howto-title">Come si usa</h2>
    <div class="bun-howto-intro">
      <p>Consigliamo di iniziare con 30 minuti al giorno e aumentare gradualmente fino a una sessione di 1-3 ore.</p>
      <p>Quando ti senti a tuo agio, puoi iniziare a indossarlo anche durante il sonno, ogni notte.</p>
      <p>È ideale per il riposo — quando sei sdraiato sul divano, guardi la TV, leggi o dormi.</p>
      <p>Ma a differenza di altri prodotti sul mercato, puoi anche muoverti senza che il correttore NORIKS ti limiti nei movimenti, grazie al suo design flessibile.</p>
    </div>
    <div class="bun-steps-grid">
      <?php $bun_n = 0; foreach ( $bun_steps as $bun_step ) : $bun_n++; ?>
        <div class="bun-step">
          <div class="bun-step-media">
            <video src="<?php echo esc_url( $bun_step['video'] ); ?>" muted autoplay loop playsinline preload="metadata"></video>
          </div>
          <div class="bun-step-num"><?php echo (int) $bun_n; ?></div>
          <p class="bun-step-caption"><?php echo esc_html( $bun_step['caption'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 4) 8 motivi per cui lo amerai ============ -->
<section class="bun-why">
  <div class="bun-wrap bun-row">
    <div class="bun-col bun-copy">
      <h2 class="bun-title">8 motivi per cui lo amerai</h2>
      <ul class="bun-reasons">
        <li><strong>Sollievo dal disagio</strong> camminando, allenandoti, in piedi e dormendo</li>
        <li><strong>Previene</strong> l'ulteriore crescita dell'alluce valgo</li>
        <li><strong>Opzione non chirurgica</strong> per il sollievo</li>
        <li>Solido allineamento dell'articolazione che <strong>migliora davvero la tua condizione</strong></li>
        <li>Intensità dello stretching <strong>regolabile</strong></li>
        <li>Progettato e raccomandato da <strong>professionisti medici</strong></li>
        <li><strong>Facile da usare</strong> e trasportabile</li>
        <li><strong>Garanzia di rimborso di 90 giorni</strong> („risultati o rimborso completo"), perché siamo così sicuri del nostro prodotto e sappiamo che ti aiuterà</li>
      </ul>
    </div>
    <div class="bun-col bun-media">
      <img loading="lazy" decoding="async" src="<?php echo esc_url( $bun_img_features ); ?>" alt="Perché il correttore per alluce valgo NORIKS è diverso" />
    </div>
  </div>
</section>

<!-- ============ 5) Risultati reali, persone reali ============ -->
<section class="bun-why bun-results-sec">
  <div class="bun-wrap bun-row">
    <div class="bun-col bun-copy">
      <h2 class="bun-title">Risultati <span class="bun-hl">reali</span>, persone reali</h2>
      <p>Abbiamo condotto un test sui consumatori inviando il correttore per alluce valgo NORIKS a oltre <strong>37 studi podiatrici</strong>. In totale lo hanno provato <strong>432 pazienti</strong> con alluce valgo. Ecco i risultati.</p>
    </div>
    <div class="bun-col">
      <div class="bun-results">
        <?php foreach ( $bun_results as $bun_r ) : $bun_dash = round( $bun_r['pct'] * 1.6336, 1 ); ?>
          <div class="bun-result">
            <svg class="bun-ring" viewBox="0 0 60 60" aria-hidden="true">
              <circle cx="30" cy="30" r="26" fill="none" stroke="#dfe6ee" stroke-width="5"/>
              <circle cx="30" cy="30" r="26" fill="none" stroke="#1a86d0" stroke-width="5" stroke-linecap="round"
                      stroke-dasharray="<?php echo esc_attr( $bun_dash ); ?> 163.4" transform="rotate(-90 30 30)"/>
              <text x="30" y="34" text-anchor="middle" class="bun-ring-txt"><?php echo (int) $bun_r['pct']; ?>%</text>
            </svg>
            <p class="bun-result-text"><?php echo esc_html( $bun_r['text'] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ 6) Perché scegliere noi? (tabella comparativa, stile knc) ============ -->
<section class="bun-cmp-section">
  <div class="bun-cmp-wrap">
    <h2 class="bun-cmp-title">Perché scegliere noi?</h2>
    <p class="bun-cmp-lead">Non farti ingannare dalle <span class="bun-hl">imitazioni ECONOMICHE</span></p>
    <p class="bun-cmp-sub">Come si confronta il <strong>correttore per alluce valgo NORIKS</strong> con gli altri:</p>
    <div class="bun-cmp-scroll">
      <table class="bun-cmp-table">
        <thead>
          <tr>
            <th></th>
            <th class="bun-us">NORIKS</th>
            <th class="bun-comp">Altri correttori</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $bun_cmp as $bun_row ) : ?>
            <tr>
              <td><?php echo esc_html( $bun_row ); ?></td>
              <td class="us ok">✓</td>
              <td class="no">✕</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<style>
  /* Nessun link "Tabella delle taglie" sul correttore per alluce valgo (né plugin né globale). */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  /* Descrizione breve (short description): nascondi i punti standard (•), resta solo ✅;
     spazio sopra "Vantaggi:" e più spazio sotto la lista.
     (Questo template viene caricato solo sulle pagine orto-bunion.) */
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

  .bun-why { padding: 44px 0; }
  .bun-why.bun-intro { background: #fbf9f4; }
  .bun-wrap { max-width: 1180px; margin: 0 auto; padding: 0 16px; }
  .bun-row { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
  .bun-media video { width: 100%; height: auto; border-radius: 12px; display: block; }
  .bun-title { font-size: clamp(24px,2.9vw,34px); font-weight: 800; color: #1c1c1c; line-height: 1.2; margin: 0 0 18px; }
  .bun-hl { color: #1a86d0; }
  .bun-red { color: #e0563f; }
  .bun-copy p { font-size: 16px; line-height: 1.7; color: #333; margin: 0 0 12px; }
  .bun-stat { display: flex; align-items: flex-start; gap: 8px; margin-top: 6px !important; }
  .bun-check { color: #1a86d0; font-weight: 800; }
  .bun-stat em { font-style: italic; color: #333; }

  /* section 2: media on the right */
  .bun-reverse .bun-media { order: 2; }
  .bun-reverse .bun-copy { order: 1; }

  /* 3) Come si usa (sfondo grigio) */
  .bun-why.bun-howto { background: #f0f2f5; }
  .bun-howto-title { text-align: center; font-size: clamp(24px,2.9vw,34px); font-weight: 800; color: #1c1c1c; margin: 0 0 18px; }
  .bun-howto-intro { max-width: 820px; margin: 0 auto 34px; text-align: center; }
  .bun-howto-intro p { font-size: 16px; line-height: 1.6; color: #333; margin: 0 0 12px; }
  .bun-steps-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
  .bun-step { text-align: center; }
  .bun-step-media { width: 100%; aspect-ratio: 1 / 1; border-radius: 14px; overflow: hidden; background: #e6e9ee; }
  .bun-step-media video { width: 100%; height: 100%; object-fit: cover; display: block; }
  .bun-step-num { font-size: 22px; font-weight: 800; color: #1c1c1c; margin: 14px 0 6px; }
  .bun-step-caption { font-size: 15px; line-height: 1.5; color: #333; margin: 0 8px; }

  /* 4) 8 motivi */
  .bun-media img { width: 100%; height: auto; border-radius: 12px; display: block; }
  .bun-reasons { list-style: none; margin: 0; padding: 0; }
  .bun-reasons li { position: relative; padding: 0 0 16px 34px; font-size: 15.5px; line-height: 1.5; color: #333; }
  .bun-reasons li:before {
      content: ""; position: absolute; left: 0; top: 1px; width: 22px; height: 22px; border-radius: 50%;
      background: #1a86d0 url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M6 12.5l4 4 8-8' fill='none' stroke='white' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'/></svg>") center/15px no-repeat;
  }

  /* 5) Risultati reali */
  .bun-results { display: flex; flex-direction: column; gap: 18px; }
  .bun-result { display: flex; align-items: center; gap: 16px; border-bottom: 1px solid #e6e6e6; padding-bottom: 16px; }
  .bun-result:last-child { border-bottom: 0; padding-bottom: 0; }
  .bun-ring { width: 70px; height: 70px; flex: 0 0 70px; }
  .bun-ring-txt { font-size: 16px; font-weight: 800; fill: #1a86d0; }
  .bun-result-text { font-size: 14.5px; line-height: 1.5; color: #333; margin: 0; }

  /* 6) Perché scegliere noi — tabella comparativa (stesso stile knc-table) */
  .bun-cmp-section { background:#fff; padding:44px 0; }
  .bun-cmp-wrap { max-width:940px; margin:0 auto; padding:0 16px; }
  .bun-cmp-title { text-align:center; font-size:clamp(24px,3vw,34px); font-weight:800; color:#111; margin:0 0 8px; }
  .bun-cmp-lead { text-align:center; font-size:18px; font-weight:800; color:#111; margin:0 0 6px; }
  .bun-cmp-sub { text-align:center; font-size:14px; color:#444; margin:0 0 24px; }
  .bun-cmp-scroll { border-radius:16px; overflow:hidden; box-shadow:0 12px 34px rgba(18,48,90,.12); border:1px solid #edf0f4; }
  .bun-cmp-table { width:100%; border-collapse:collapse; table-layout:fixed; margin:0 !important; }
  .bun-cmp-table th, .bun-cmp-table td { padding:15px 12px; text-align:center; font-size:15px; }
  .bun-cmp-table thead th { color:#fff; font-weight:700; vertical-align:middle; font-size:14px; }
  .bun-cmp-table thead th:first-child { width:52%; background:#fff; }
  .bun-cmp-table .bun-comp { background:#767676; }
  .bun-cmp-table .bun-us { background:#111; }
  .bun-cmp-table tbody td:first-child { text-align:left; font-weight:600; color:#111; font-size:14px; line-height:1.3; padding-left:18px; }
  .bun-cmp-table tbody tr { border-bottom:1px solid #eef0f4; }
  .bun-cmp-table tbody tr:nth-child(even) { background:#fafbfc; }
  .bun-cmp-table td.ok { color:#1a9e5f; font-size:19px; font-weight:700; }
  .bun-cmp-table td.no { color:#d64545; font-size:18px; font-weight:700; }
  .bun-cmp-table td.us { background:#f3f3f3 !important; }
  .bun-cmp-table td.us.ok { color:#1a9e5f; }
  @media (max-width:600px) {
    .bun-cmp-table th, .bun-cmp-table td { padding:12px 6px; font-size:13px; }
    .bun-cmp-table thead th { font-size:12px; }
    .bun-cmp-table tbody td:first-child { font-size:12px; padding-left:10px; }
  }

  @media (max-width: 820px) {
    .bun-row { grid-template-columns: 1fr; gap: 22px; }
    .bun-reverse .bun-media { order: 0; }
    .bun-reverse .bun-copy { order: 0; }
    .bun-steps-grid { grid-template-columns: 1fr; gap: 18px; }
  }
</style>
