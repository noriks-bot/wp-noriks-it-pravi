<?php
/**
 * product-bottom: NORIKS KidsNest — cuscino per bambini per una respirazione corretta (orto-kidsnest).
 * Kopija tryneedo.com/products/kids-pillow sekcija, traduzione IT (affermazioni mediche attenuate).
 * Redoslijed:
 *   1. Trust marquee (plava)  2. "Pocnite veceras..." (slika L / tekst D, plavi naslov)
 *   3. "Pravilna potpora..." (tekst L / slika D)  4. Statistika 94/60/98 (svijetlo-plava, 3 kartice s krugovima)
 *   5. "#1 djecji jastuk 2026" + zvjezdice + drseca foto traka
 * Plava: #2b3fb0, svijetla: #eef1fb, navy: #1b2450. Slike: img/kidsnest/
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$kn = get_template_directory_uri() . '/img/kidsnest/';
?>

<!-- ============ 1) Trust marquee (plava traka, vrti se) ============ -->
<div class="kn-marquee" aria-hidden="true">
  <div class="kn-marquee-track">
    <?php $kn_ticker = array('CONSIGLIATO DAI PEDIATRI','MEMORY FOAM OEKO-TEX®','STRUTTURA A 3 ZONE','90 NOTTI DI PROVA','IPOALLERGENICO','FODERA LAVABILE');
    for ( $r = 0; $r < 2; $r++ ) { foreach ( $kn_ticker as $t ) { echo '<span class="kn-tick">'.esc_html($t).'</span><span class="kn-dot">•</span>'; } } ?>
  </div>
</div>

<!-- ============ 2) Pocnite veceras — slika LIJEVO, tekst DESNO ============ -->
<section class="kn-sec">
  <div class="kn-wrap kn-row2">
    <div class="kn-media"><img src="<?php echo esc_url( $kn.'01-poravnan.webp' ); ?>" alt="Perfettamente allineato — testa, collo e colonna vertebrale durante il sonno" loading="lazy" onerror="this.style.display='none'"></div>
    <div class="kn-copy">
      <p class="kn-eyebrow">Sviluppato con dentisti specializzati nelle vie respiratorie dei bambini</p>
      <h2 class="kn-h2 kn-h2-blue">Inizia già stasera a correggere il danno nascosto.</h2>
      <p>I dentisti pediatrici specializzati nelle vie respiratorie mettono in guardia i genitori sullo stesso problema silenzioso: i bambini che russano e respirano con la bocca non "dormono solo peggio". La loro mascella, il palato e la struttura del viso possono svilupparsi lentamente nella direzione sbagliata.</p>
      <p><strong>E la finestra per correggerlo non resta aperta per sempre.</strong></p>
      <p>Il <strong>cuscino KidsNest</strong> di NORIKS è progettato per <strong>sostenere testa, mascella e vie respiratorie nella posizione corretta durante il sonno</strong> — favorendo la respirazione nasale e uno sviluppo più sano del viso finché conta davvero.</p>
      <p><strong>Questo non è solo un cuscino.<br>È un supporto notturno per le vie respiratorie negli anni che modellano il viso del tuo bambino.</strong></p>
    </div>
  </div>
</section>

<!-- ============ 3) Pravilna potpora — tekst LIJEVO, slika DESNO ============ -->
<section class="kn-sec">
  <div class="kn-wrap kn-row2">
    <div class="kn-copy">
      <h2 class="kn-h2 kn-h2-blue">Il corretto sostegno di testa e collo è fondamentale per un sonno sano.</h2>
      <p>Il cuscino ergonomico per bambini mantiene <strong>testa e collo in allineamento naturale e aiuta a prevenire l'inclinazione della testa</strong> durante la notte. Così la colonna vertebrale resta correttamente allineata — anche se il bambino si gira molto nel sonno.</p>
      <p><strong>Il risultato: un sonno più tranquillo e un recupero migliore.</strong></p>
    </div>
    <div class="kn-media"><img src="<?php echo esc_url( $kn.'02-san.jpg' ); ?>" alt="Bambino che dorme sereno sul cuscino KidsNest" loading="lazy" onerror="this.style.display='none'"></div>
  </div>
</section>

<!-- ============ 4) Statistika — svijetlo-plava, 3 kartice s krugovima ============ -->
<section class="kn-sec kn-stats-sec">
  <div class="kn-wrap">
    <h2 class="kn-h2 kn-h2-blue kn-center">Creato per proteggere il viso in crescita del tuo bambino</h2>
    <p class="kn-sub kn-center"><strong>Dormire con la bocca aperta nell'infanzia può rimodellare un viso in crescita. KidsNest mantiene la testa del tuo bambino allineata perché respiri con il naso.</strong></p>
    <div class="kn-stats">
      <?php
      $kn_stats = array(
        array('94','165.3','dei genitori nota che il bambino dorme <strong>con la bocca chiusa</strong> entro 2 settimane'),
        array('60','105.5','dello sviluppo del viso del tuo <strong>bambino</strong> si forma entro i 6 anni — quella finestra non si riapre'),
        array('98','172.3','dei genitori consiglierebbe <strong>KidsNest</strong> per proteggere il sorriso di un altro bambino'),
      );
      foreach ( $kn_stats as $st ) : ?>
      <div class="kn-stat-card">
        <svg class="kn-ring" viewBox="0 0 64 64" aria-hidden="true">
          <circle cx="32" cy="32" r="28" fill="none" stroke="#dfe5f5" stroke-width="5"/>
          <circle cx="32" cy="32" r="28" fill="none" stroke="#2b3fb0" stroke-width="5" stroke-linecap="round" stroke-dasharray="<?php echo esc_attr($st[1]); ?> 175.9" transform="rotate(-90 32 32)"/>
          <text x="32" y="38" text-anchor="middle" class="kn-ring-t"><?php echo esc_html($st[0]); ?>%</text>
        </svg>
        <p><?php echo wp_kses_post($st[2]); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 5) #1 djecji jastuk + zvjezdice + drseca foto traka ============ -->
<section class="kn-sec kn-rated-sec">
  <div class="kn-wrap">
    <h2 class="kn-h2 kn-h2-blue kn-center">Votato cuscino per bambini #1 del 2026.</h2>
    <p class="kn-sub kn-center">Sostieni il loro sonno — sostieni gli anni della crescita.</p>
    <p class="kn-stars kn-center"><span aria-hidden="true">★★★★★</span> Valutazione 4,8/5 basata su oltre 140 recensioni</p>
  </div>
  <div class="kn-strip">
    <div class="kn-strip-track">
      <?php for ( $r = 0; $r < 2; $r++ ) : for ( $i = 1; $i <= 5; $i++ ) : ?>
        <img src="<?php echo esc_url( $kn.'traka/t'.$i.'.webp' ); ?>" alt="NORIKS KidsNest — bambini e genitori" loading="lazy" onerror="this.style.display='none'">
      <?php endfor; endfor; ?>
    </div>
  </div>
</section>

<!-- ============ 6) Kvaliteta materijala — slika LIJEVO, tekst DESNO ============ -->
<section class="kn-sec">
  <div class="kn-wrap kn-row2">
    <div class="kn-media"><img src="<?php echo esc_url( $kn.'03-detalj.webp' ); ?>" alt="KidsNest — struttura a 3 zone e tessuto traspirante da vicino" loading="lazy" onerror="this.style.display='none'"></div>
    <div class="kn-copy">
      <h2 class="kn-h2 kn-h2-blue">Una qualità che si sente — notte dopo notte.</h2>
      <p>La maglia fitta e traspirante e la superficie sagomata con cura non sono lì per l'estetica — <strong>ogni zona ha il suo ruolo</strong>. Il centro accoglie delicatamente la testa, i bordi sostengono il collo e la struttura mantiene la forma anche dopo mesi di uso quotidiano.</p>
      <p>La fodera si toglie e si lava in lavatrice, la schiuma è <strong>ipoallergenica e resistente agli acari</strong> — così il cuscino resta fresco, pulito e pronto per ogni notte. Senza avvallamenti, senza appiattirsi, senza compromessi.</p>
      <p><strong>Un cuscino che anche dopo un anno appare — e sostiene — come il primo giorno.</strong></p>
    </div>
  </div>
</section>

<style>
  .kn-wrap { max-width: 1440px; margin: 0 auto; padding: 0 22px; } /* isti container kao gornji .product */
  .kn-sec { padding: 60px 0; }
  .kn-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
  .kn-h2 { font-size: clamp(26px,3.2vw,40px); font-weight: 800; color: #1b2450; line-height: 1.14; margin: 0 0 16px; }
  .kn-h2-blue { color: #2b3fb0; }
  .kn-center { text-align: center; }
  .kn-eyebrow { font-size: 13px; font-weight: 800; letter-spacing: .02em; color: #1b2450; margin: 0 0 6px; }
  .kn-copy p { font-size: 15.5px; line-height: 1.65; color: #33394f; margin: 0 0 14px; }
  .kn-sub { font-size: 16px; line-height: 1.55; color: #33394f; max-width: 680px; margin: 0 auto 10px; }
  .kn-media img { width: 100%; height: auto; display: block; border-radius: 18px; box-shadow: 0 14px 40px rgba(27,36,80,.10); }

  /* 1) marquee */
  .kn-marquee { background: #2b3fb0; overflow: hidden; white-space: nowrap; margin-top: 26px; }
  @media (min-width: 861px) { .kn-marquee { margin-top: -20px; } } /* desktop: prepolovljen razmik do vsebine zgoraj */
  .kn-marquee + .kn-sec { padding-top: 26px; }
  .kn-marquee-track { display: inline-block; padding: 13px 0; animation: knScroll 28s linear infinite; }
  .kn-tick { color: #fff; font-weight: 800; font-style: italic; font-size: 15px; letter-spacing: .06em; text-transform: uppercase; }
  .kn-dot { color: #aebafe; margin: 0 22px; font-weight: 800; }
  @keyframes knScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

  /* 4) statistika */
  .kn-stats-sec { background: #eef1fb; }
  .kn-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; max-width: 1180px; margin: 30px auto 0; }
  .kn-stat-card { background: #fff; border-radius: 16px; padding: 34px 26px; text-align: center; box-shadow: 0 10px 28px rgba(27,36,80,.07); }
  .kn-ring { width: 150px; height: 150px; margin: 0 auto 18px; display: block; }
  .kn-ring-t { font-size: 15px; font-weight: 800; fill: #2b3fb0; }
  .kn-stat-card p { font-size: 15px; line-height: 1.5; color: #33394f; margin: 0; }
  .kn-stat-card p strong { color: #2b3fb0; }

  /* 5) rated + strip */
  .kn-rated-sec { background: #eef1fb; padding-bottom: 0; }
  .kn-stars { font-size: 16px; color: #1b2450; font-weight: 600; margin: 6px 0 26px; }
  .kn-stars span { color: #f5a623; letter-spacing: 2px; margin-right: 8px; }
  .kn-strip { overflow: hidden; width: 100vw; margin-left: calc(50% - 50vw); padding-bottom: 34px; }
  .kn-strip-track { display: flex; gap: 8px; width: max-content; animation: knScroll 60s linear infinite; }
  .kn-strip:hover .kn-strip-track { animation-play-state: paused; }
  .kn-strip-track img { width: 350px; aspect-ratio: 1/1; object-fit: cover; border-radius: 10px; display: block; flex: 0 0 auto; }

  @media (max-width: 860px) {
    .kn-sec { padding: 30px 0; }
    .kn-row2 { grid-template-columns: 1fr; gap: 18px; }
    .kn-row2 .kn-media { order: -1; }
    .kn-h2 { font-size: 2rem; }
    .kn-stats { grid-template-columns: 1fr; gap: 14px; margin-top: 18px; }
    .kn-ring { width: 120px; height: 120px; }
    .kn-strip-track img { width: 240px; }
  }
</style>
