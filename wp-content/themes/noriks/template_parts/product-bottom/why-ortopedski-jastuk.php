<?php
/**
 * product-bottom: NORIKS ErgoSit — CUSCINO ORTOPEDICO DA SEDUTA (orto-ortopedski-jastuk)
 * 1:1 kopija originalne stranice (celinva.com/products/orthopedic-cushion):
 * iste sekcije, isti redoslijed, iste postavitve (lijevo-desno), sadržaj preveden IT,
 * rebrand NORIKS ErgoSit, lokalizirane HR grafike. Pink akcent #e5157e, navy #121030.
 * Redoslijed (original):
 *   1. marquee  2. "#1 Orthopedic Seat Cushion" + UGC  3. End Tailbone (img L / txt R)
 *   4. Improve Posture (txt L / img R)  5. Relief That Adapts (grid L / txt R)
 *   6. UGC reviews traka  7. Engineered (img L / txt R + CTA)
 *   8. Effective Against (akordeon, puna širina)  9. 20x Cheaper (img L / txt R + CTA)
 *   10. Won't Quit (txt L / tablica R)  11. 60 Days (tamna, značka L / txt R)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$oj  = get_template_directory_uri() . '/img/ortopedski-jastuk/';
$ojv = get_template_directory_uri() . '/img/ortopedski-jastuk/videos/';
$oj_img = function( $file, $alt ) use ( $oj ) {
  return '<img src="'.esc_url($oj.$file).'" alt="'.esc_attr($alt).'" loading="lazy" onerror="this.style.display=\'none\'">';
};
?>

<!-- ============ 1) Marquee (tamna traka, vrti se) ============ -->
<div class="oj-marquee" aria-hidden="true">
  <div class="oj-marquee-track">
    <?php $oj_ticker = array('TRASPIRANTE E LAVABILE','ALLINEAMENTO PERFETTO','SCHIUMA STABILITYCORE™','CERTIFICATO OEKO-TEX®','IPOALLERGENICO','FODERA SILKFLEX™');
    for ( $r = 0; $r < 2; $r++ ) { foreach ( $oj_ticker as $t ) { echo '<span class="oj-tick">'.esc_html($t).'</span><span class="oj-dot">•</span>'; } } ?>
  </div>
</div>

<!-- ============ 2) "Svjetski #1" + UGC karusel ============ -->
<section class="oj-sec">
  <div class="oj-wrap">
    <h2 class="oj-hero-h">Il <em>cuscino ortopedico da seduta #1 al mondo</em> per il comfort di ogni giorno</h2>
    <p class="oj-hero-sub">Scelto da migliaia di clienti soddisfatti — <strong>dagli autisti sulla strada agli impiegati in ufficio, fino alle famiglie a casa.</strong></p>
    <div class="oj-ugc-grid oj-ugc-5">
      <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
        <div class="oj-ugc-item" data-src="<?php echo esc_url( $ojv.'nasi-'.$i.'.mp4' ); ?>">
          <video class="oj-ugc-video" preload="metadata" playsinline muted></video>
          <span class="oj-ugc-play" aria-label="Riproduci"></span>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- ============ 3) Kraj boli u trtici — slika LIJEVO, tekst DESNO ============ -->
<section class="oj-sec oj-alt">
  <div class="oj-wrap oj-row2">
    <div class="oj-media"><?php echo $oj_img('07_lifestyle_HR.png','Prima e dopo — dolore al coccige alla guida'); ?></div>
    <div class="oj-copy">
      <h2 class="oj-h2"><em class="oj-pink-i">Basta dolore al coccige, sciatica e mal di schiena</em> da troppe ore seduti</h2>
      <p>La maggior parte delle sedie distrugge il tuo corpo in 30 minuti. <strong>Le anche si inclinano, la colonna si incurva e la pressione aumenta sul coccige e sul nervo sciatico.</strong> Ecco perché i lunghi viaggi, il lavoro in ufficio o la cena a tavola ti lasciano la schiena dolorante, rigida o intorpidita.</p>
      <p>Il <strong>cuscino ortopedico ErgoSit</strong> di NORIKS è costruito in modo diverso. L'incavo per il coccige elimina la pressione diretta sull'osso sacro-coccigeo, mentre il design sagomato sostiene la colonna e ripristina una postura sana. La memory foam ad alta densità distribuisce il peso in modo uniforme su anche e cosce e mantiene la circolazione, così le gambe non si intorpidiscono.</p>
    </div>
  </div>
</section>

<!-- ============ 4) Poboljšajte držanje — tekst LIJEVO, slika DESNO ============ -->
<section class="oj-sec">
  <div class="oj-wrap oj-row2">
    <div class="oj-copy">
      <h2 class="oj-h2">Migliora la postura e stimola la circolazione</h2>
      <p>I sedili delle auto e le sedie da ufficio sono fatti per durare, non per il tuo corpo. La loro forma fa affondare le anche, schiaccia le cosce nel sedile e rallenta la circolazione — le gambe diventano irrequiete e la schiena resta dolorante anche molto dopo che ti sei alzato.</p>
      <p>NORIKS <strong>ErgoSit</strong> è progettato per le lunghe ore. La base sagomata mantiene le anche in linea, i bordi profilati riducono la pressione sulle cosce e il rialzo sostiene la colonna chilometro dopo chilometro. Il risultato? Postura eretta, circolazione sana e ore di seduta senza dolore né rigidità.</p>
    </div>
    <div class="oj-media"><video class="oj-secvid" src="<?php echo esc_url( $ojv.'drzanje.mp4' ); ?>" autoplay muted loop playsinline preload="metadata"></video></div>
  </div>
</section>

<!-- ============ 5) Prilagođava se gdje god sjedite — grid 4 LIJEVO, tekst DESNO ============ -->
<section class="oj-sec oj-alt">
  <div class="oj-wrap oj-row2">
    <div class="oj-media"><?php echo $oj_img('prilagodba.webp','NORIKS ErgoSit — si adatta ovunque ti sieda'); ?></div>
    <div class="oj-copy">
      <h2 class="oj-h2">Un sollievo che si adatta ovunque ti sieda.</h2>
      <p>NORIKS <strong>ErgoSit</strong> si adatta a ogni posto in cui ti siedi. La base stabile antiscivolo lo tiene fermo su <strong>sedili dell'auto, sedie da ufficio, sedie da pranzo e carrozzine</strong> — così il comfort ti accompagna per tutta la giornata.</p>
      <p>La memory foam ad alta densità sostiene il corpo senza appiattirsi, mentre la fodera sfoderabile e lavabile resta fresca, pulita e pronta per l'uso quotidiano.</p>
    </div>
  </div>
</section>

<!-- ============ 6) Trust traka (kao original press-bar, ali s pravim NORIKS oznakama) + SLIKE kupaca ============ -->
<section class="oj-sec oj-stills-sec">
  <div class="oj-trustbar" aria-hidden="true">
    <div class="oj-trustbar-track">
      <?php $oj_trust = array('120.000+ CLIENTI','VALUTAZIONE 4,8/5','OEKO-TEX®','CONSIGLIATO DAI MEDICI','GARANZIA 60 GIORNI','DESIGN ORTOPEDICO');
      for ( $r = 0; $r < 2; $r++ ) { foreach ( $oj_trust as $t ) { echo '<span class="oj-trust-item">'.esc_html($t).'</span><span class="oj-trust-dot">•</span>'; } } ?>
    </div>
  </div>
  <div class="oj-wrap">
    <div class="oj-stills">
      <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
        <img src="<?php echo esc_url( $oj.'galerija/li'.$i.'.webp' ); ?>" alt="NORIKS ErgoSit — clienti soddisfatti" loading="lazy" onerror="this.style.display='none'">
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- ============ 7) Osmišljen s ortopedskim znanjem — slika LIJEVO, tekst DESNO + CTA ============ -->
<section class="oj-sec oj-alt">
  <div class="oj-wrap oj-row2">
    <div class="oj-media"><?php echo $oj_img('04_lijecnik_HR.png','Consigliato dai medici — NORIKS ErgoSit'); ?></div>
    <div class="oj-copy">
      <h2 class="oj-h2">Progettato con competenza ortopedica, creato per la seduta di ogni giorno.</h2>
      <p>Con il contributo di specialisti ortopedici e mesi di test ergonomici, NORIKS <strong>ErgoSit</strong> è stato progettato per alleviare i dolori più comuni causati dalle lunghe ore da seduti — dalla pressione sul coccige al fastidio nella parte bassa della schiena e alle anche.</p>
      <a class="oj-cta" href="#bundle-selector">👉 ORDINA ORA</a>
    </div>
  </div>
</section>

<!-- ============ 8) Učinkovito protiv čestih problema — akordeon, PUNA ŠIRINA ============ -->
<section class="oj-sec">
  <div class="oj-wrap">
    <h2 class="oj-h2 oj-center"><em class="oj-pink-i">Efficace contro</em> i problemi più comuni della seduta</h2>
    <div class="oj-acc">
      <?php
      $oj_probs = array(
        array('Dolore al coccige','L\'incavo per il coccige elimina la pressione dall\'osso coccigeo e distribuisce il peso su tutto il cuscino, così non senti quel dolore acuto e bruciante già dopo pochi minuti da seduto.'),
        array('Sciatica e fitte lungo la gamba','Mantenendo le anche in linea e la colonna eretta, il cuscino scarica il nervo sciatico — così puoi stare seduto, guidare o lavorare senza quelle fitte che si irradiano lungo le gambe.'),
        array('Dolore lombare','La maggior parte delle sedie lascia un vuoto dietro la zona lombare. NORIKS lo riempie, ripristina la curva naturale della colonna e riduce la tensione muscolare durante le lunghe ore da seduti.'),
        array('Gambe intorpidite e gonfie','Le superfici piatte bloccano la circolazione. I bordi sagomati del cuscino scaricano le cosce e mantengono il flusso sanguigno, così le gambe restano leggere e piene di energia, non pesanti o intorpidite.'),
        array('Dolore all\'articolazione sacroiliaca e alle anche','Un peso distribuito male sovraccarica anche e articolazioni. NORIKS distribuisce la pressione in modo uniforme, aiuta a mantenere una postura equilibrata e riduce la tensione nelle anche.'),
        array('Sollievo per le sedute sensibili','Per le zone sensibili il cuscino unisce un sostegno solido a un profilo delicato — scarica la pressione, così puoi sederti comodamente anche quando il corpo è dolorante.'),
      );
      foreach ( $oj_probs as $p ) : ?>
        <div class="oj-acc-item">
          <button class="oj-acc-head" type="button" aria-expanded="false">
            <span class="oj-acc-tick">✔</span><span class="oj-acc-title"><?php echo esc_html($p[0]); ?></span><span class="oj-acc-chev">⌄</span>
          </button>
          <div class="oj-acc-body"><p><?php echo esc_html($p[1]); ?></p></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 9) 20x jeftinije — slika LIJEVO, tekst DESNO + CTA ============ -->
<section class="oj-sec">
  <div class="oj-wrap oj-row2">
    <div class="oj-media"><?php echo $oj_img('14_vsebina_HR.png','NORIKS ErgoSit — siediti meglio, vivi meglio'); ?></div>
    <div class="oj-copy">
      <h2 class="oj-h2"><em class="oj-pink-i">20 volte più economico</em> delle soluzioni costose</h2>
      <p>La maggior parte delle persone <strong>spende migliaia di euro</strong> cercando di risolvere il dolore da seduta:</p>
      <ul class="oj-x">
        <li><span>✕</span> Sedia ergonomica: <strong>750–1.100 €</strong></li>
        <li><span>✕</span> Sedute settimanali dal chiropratico: <strong>70–140 € a visita</strong> (oltre 3.000 € l'anno)</li>
        <li><span>✕</span> Fisioterapia: <strong>190 €+ a seduta</strong>, spesso con settimane di attesa</li>
      </ul>
      <p><strong>Cuscino ortopedico NORIKS ErgoSit</strong></p>
      <p>Un unico acquisto che allevia il dolore al coccige, alla schiena e alle anche, senza svuotare il portafoglio.</p>
      <a class="oj-cta" href="#bundle-selector">Ordina ora</a>
    </div>
  </div>
</section>

<!-- ============ 10) Jastuk koji ne odustaje — tekst LIJEVO, tablica DESNO ============ -->
<section class="oj-sec">
  <div class="oj-wrap oj-row2">
    <div class="oj-copy">
      <h2 class="oj-h2">Il cuscino che non molla</h2>
      <p class="oj-lead">Resta compatto, allevia il dolore e sostiene dove gli altri cedono.</p>
    </div>
    <div class="oj-cmp-wrap">
      <span class="oj-cmp-others">Altri</span>
      <div class="oj-cmp-pill"><span>NORIKS</span></div>
      <div class="oj-cmp-card">
        <div class="oj-cmp-row"><div class="f">Scarica coccige e schiena</div><div class="us">✓</div><div class="no">✕</div></div>
        <div class="oj-cmp-row"><div class="f">Sostiene una postura eretta e sana</div><div class="us">✓</div><div class="no">✕</div></div>
        <div class="oj-cmp-row"><div class="f">Mantiene la forma nel tempo</div><div class="us">✓</div><div class="no">✕</div></div>
        <div class="oj-cmp-row"><div class="f">Base antiscivolo</div><div class="us">✓</div><div class="no">✕</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 11) Isprobajte 60 dana — TAMNA, značka LIJEVO, tekst DESNO ============ -->
<section class="oj-sec oj-guar-sec">
  <div class="oj-wrap">
  <div class="oj-guarantee oj-row2">
    <div class="oj-guar-badge"><?php echo $oj_img('15_znacka_60_dana_HR.png','Garanzia di rimborso di 60 giorni'); ?></div>
    <div class="oj-guar-copy">
      <h2 class="oj-h2 oj-h2-light">Provalo per <em class="oj-pink-i">60 giorni</em>, senza pensieri</h2>
      <p>Trovare il cuscino giusto non è facile — molti si appiattiscono o semplicemente non danno un vero sollievo. Per questo ogni NORIKS <strong>ErgoSit</strong> è coperto dalla nostra <strong>garanzia di comfort di 60 giorni</strong>.</p>
      <p>Portalo in ufficio, in auto o per le lunghe ore a casa. Se non senti meno dolore e più comfort nella tua seduta quotidiana, il nostro team farà in modo di sistemare le cose.</p>
      <p>Perché quando si tratta della tua salute e del tuo comfort, crediamo che la differenza tu la debba <strong>sentire</strong>, non solo sperare.</p>
    </div>
  </div>
  </div>
</section>

<style>
  .oj-wrap { max-width: 1440px; margin: 0 auto; padding: 0 22px; } /* ista širina kao gornji .product container */
  .oj-wrap-narrow { max-width: 820px; margin: 0 auto; padding: 0 18px; }
  .oj-sec { padding: 60px 0; }
  .oj-alt { background: #faf6f9; }
  .oj-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
  .oj-h2 { font-size: clamp(24px,3vw,36px); font-weight: 800; color: #121030; line-height: 1.15; margin: 0 0 16px; }
  .oj-h2-light { color: #fff; }
  .oj-pink-i { color: #e5157e; font-style: italic; }
  .oj-center { text-align: center; }
  .oj-copy p, .oj-lead { font-size: 15.5px; line-height: 1.6; color: #3a3450; margin: 0 0 14px; }
  .oj-lead { font-size: 16px; color: #55506b; }
  .oj-media img, .oj-grid2 img, .oj-media video.oj-secvid { width: 100%; height: auto; display: block; border-radius: 18px; box-shadow: 0 14px 40px rgba(27,21,51,.10); }

  /* 1) Marquee */
  .oj-marquee { background: #121030; overflow: hidden; white-space: nowrap; }
  .oj-marquee-track { display: inline-block; padding: 13px 0; animation: ojScroll 26s linear infinite; }
  .oj-tick { color: #fff; font-weight: 800; font-style: italic; font-size: 15px; letter-spacing: .06em; text-transform: uppercase; }
  .oj-dot { color: #e5157e; margin: 0 22px; font-weight: 800; }
  @keyframes ojScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

  /* 2) hero */
  .oj-hero-h { text-align: center; font-size: clamp(26px,3.4vw,42px); font-weight: 800; color: #121030; line-height: 1.12; margin: 0 auto 12px; max-width: 900px; }
  .oj-hero-h em { color: #e5157e; font-style: italic; }
  .oj-hero-sub { text-align: center; font-size: 16px; color: #55506b; max-width: 660px; margin: 0 auto 28px; line-height: 1.55; }

  /* UGC */
  .oj-ugc-grid { display: grid; gap: 12px; }
  .oj-ugc-3 { grid-template-columns: repeat(3,1fr); max-width: 760px; margin: 0 auto; }
  .oj-ugc-5 { grid-template-columns: repeat(4,1fr); max-width: 1000px; margin: 0 auto; }
  .oj-ugc-item { position: relative; aspect-ratio: 9/16; border-radius: 12px; overflow: hidden; background: #121030; cursor: pointer; }
  .oj-ugc-item video { width: 100%; height: 100%; object-fit: cover; display: block; }
  .oj-ugc-play { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 50px; height: 50px; border-radius: 50%; background: rgba(255,255,255,.92); }
  .oj-ugc-play::after { content: ""; position: absolute; top: 50%; left: 54%; transform: translate(-50%,-50%); border-style: solid; border-width: 10px 0 10px 16px; border-color: transparent transparent transparent #121030; }

  .oj-grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

  /* CTA — tamni navy gumb kao original */
  .oj-cta { display: inline-block; background: #121030; color: #fff; font-weight: 800; font-size: 15px; letter-spacing: .04em; padding: 15px 34px; border-radius: 8px; text-decoration: none; margin-top: 8px; }
  .oj-cta:hover { background: #e5157e; color: #fff; }

  /* 8) akordeon */
  .oj-acc { max-width: 880px; margin: 18px auto 0; border-top: 1px solid #ecdfe8; }
  .oj-acc-item { border-bottom: 1px solid #ecdfe8; }
  .oj-acc-head { width: 100%; background: none; border: 0; display: flex; align-items: center; gap: 12px; padding: 16px 4px; cursor: pointer; font-size: 15.5px; font-weight: 700; color: #121030; text-align: left; }
  .oj-acc-tick { color: #22b573; font-weight: 800; }
  .oj-acc-title { flex: 1; }
  .oj-acc-chev { transition: transform .2s; color: #b39aab; }
  .oj-acc-item.open .oj-acc-chev { transform: rotate(180deg); }
  .oj-acc-body { max-height: 0; overflow: hidden; transition: max-height .25s ease; }
  .oj-acc-item.open .oj-acc-body { max-height: 260px; }
  .oj-acc-body p { font-size: 14.5px; line-height: 1.6; color: #4a4560; margin: 0 0 16px; padding-left: 28px; }

  /* 9) X lista */
  .oj-x { list-style: none; margin: 0 0 14px; padding: 0; }
  .oj-x li { font-size: 15px; color: #3a3450; margin: 0 0 10px; }
  .oj-x li span { color: #d64545; font-weight: 800; margin-right: 8px; }

  /* 6) Trust traka — svijetla, "logotip" stil kao original press-bar (mijesana tipografija) */
  .oj-trustbar { background: #f7f0f2; overflow: hidden; white-space: nowrap; width: 100vw; margin-left: calc(50% - 50vw); }
  .oj-trustbar-track { display: inline-block; padding: 14px 0; animation: ojScroll 34s linear infinite; }
  .oj-trust-item { color: #9b96a6; font-weight: 800; font-style: italic; font-size: 15px; letter-spacing: .06em; text-transform: uppercase; }
  .oj-trust-dot { color: #e5157e; margin: 0 22px; font-weight: 800; }

  /* 6) UGC stillovi (slike kupaca) — full-bleed kao original */
  .oj-stills-sec { padding: 20px 0 40px; }
  .oj-stills-sec .oj-wrap { margin-top: 0; }
  .oj-stills-sec .oj-wrap { max-width: none; padding: 0; }
  .oj-stills { display: grid; grid-template-columns: repeat(6,1fr); gap: 6px; width: 100vw; margin-left: calc(50% - 50vw); }
  .oj-stills img { width: 100%; aspect-ratio: 9/16; object-fit: cover; display: block; border-radius: 0; }

  /* 10) usporedba — bijela kartica + plavajuća pink pilula (kao original) */
  .oj-cmp-wrap { position: relative; padding: 40px 0 30px; }
  .oj-cmp-others { position: absolute; top: 8px; right: 0; width: 88px; text-align: center; font-weight: 800; color: #121030; font-size: 14px; }
  .oj-cmp-pill { position: absolute; top: 0; bottom: 0; right: 96px; width: 100px; background: #e5157e; border-radius: 28px; box-shadow: 0 16px 36px rgba(229,21,126,.35); z-index: 1; display: flex; justify-content: center; align-items: flex-start; padding-top: 14px; }
  .oj-cmp-pill span { color: #fff; font-weight: 800; font-size: 10.5px; letter-spacing: .14em; }
  .oj-cmp-card { position: relative; background: #fff; border-radius: 16px; box-shadow: 0 12px 34px rgba(27,21,51,.10); border: 1px solid #f1edf3; }
  .oj-cmp-row { display: grid; grid-template-columns: 1fr 100px 88px; align-items: center; border-bottom: 1px solid #f2eff4; min-height: 62px; }
  .oj-cmp-row:last-child { border-bottom: 0; }
  .oj-cmp-row .f { padding: 14px 16px; text-align: center; font-weight: 800; color: #121030; font-size: 15px; line-height: 1.3; }
  .oj-cmp-row .us { position: relative; z-index: 2; text-align: center; color: #fff; font-weight: 800; font-size: 18px; }
  .oj-cmp-row .no { text-align: center; color: #e23a3a; font-weight: 800; font-size: 16px; }

  /* 11) jamstvo — zaobljena tamna kartica (kao original) */
  .oj-guar-sec { padding-top: 20px; }
  .oj-guarantee { background: #121030; border-radius: 18px; padding: 52px 48px; }
  .oj-guar-copy p { color: #cfc9e0; font-size: 15px; line-height: 1.6; margin: 0 0 12px; }
  .oj-guar-badge img { width: 280px; max-width: 100%; height: auto; margin: 0 auto; display: block; border-radius: 50%; }

  @media (max-width: 860px) {
    /* mobilni: prepolovljeni razmaci medju sekcijama */
    .oj-sec { padding: 30px 0; }
    .oj-marquee + section.oj-sec { padding-top: 20px; }
    .oj-hero-h { font-size: 2rem !important; }
    .oj-stills-sec { padding: 10px 0 20px; }
    .oj-guar-sec { padding-top: 10px; }
    .oj-row2 { grid-template-columns: 1fr; gap: 18px; }
    .oj-ugc-3 { grid-template-columns: repeat(3,1fr); }
    /* hero videi: horizontalni slider u jednom redu (kao original) */
    .oj-ugc-5 { display: flex; overflow-x: auto; gap: 10px; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; padding: 0 4px 6px; }
    .oj-ugc-5 .oj-ugc-item { flex: 0 0 46%; scroll-snap-align: center; }
    .oj-stills { grid-template-columns: repeat(3,1fr); }
    .oj-row2 .oj-media, .oj-row2 .oj-grid2 { order: -1; }
    .oj-guarantee { padding: 34px 22px; }
    .oj-guarantee .oj-guar-badge { order: -1; }
    .oj-cmp-others { width: 72px; }
    .oj-cmp-pill { right: 78px; width: 84px; }
    .oj-cmp-row { grid-template-columns: 1fr 84px 72px; }
  }

  /* No-attrs: sakrij "Tablica veličina" ako se negdje pojavi */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap, #open-size-chart, #open-size-chartCustom { display: none !important; }
</style>

<script>
(function(){
  /* Pink active bundle-option (preživljava LiteSpeed UCSS). */
  function paintOj(){
    var sel = document.getElementById('bundle-selector'); if(!sel) return;
    sel.querySelectorAll('.bundle-option').forEach(function(c){ c.style.removeProperty('border-color'); c.style.removeProperty('background'); c.style.removeProperty('border-width'); });
    var checked = sel.querySelector('input[name="bundle_option"]:checked');
    var card = checked ? checked.closest('.bundle-option') : (sel.querySelector('.bundle-option.active') || sel.querySelector('.bundle-option'));
    if(card){ card.style.setProperty('border-color','#ED5E95','important'); card.style.setProperty('background','rgba(237,94,149,0.1)','important'); card.style.setProperty('border-width','2px','important'); }
  }
  function bindOj(){ var sel=document.getElementById('bundle-selector'); if(!sel) return; paintOj(); sel.querySelectorAll('input[name="bundle_option"]').forEach(function(r){ r.addEventListener('change', paintOj); }); }
  if(document.readyState==='loading'){ document.addEventListener('DOMContentLoaded', bindOj); } else { bindOj(); }

  /* Akordeon */
  document.querySelectorAll('.oj-acc-head').forEach(function(btn){
    btn.addEventListener('click', function(){ var it=btn.closest('.oj-acc-item'); var open=it.classList.toggle('open'); btn.setAttribute('aria-expanded', open?'true':'false'); });
  });

  /* UGC video: prikaži prvi kadar, klik = pusti sa zvukom */
  document.querySelectorAll('.oj-ugc-item').forEach(function(item){
    var v = item.querySelector('.oj-ugc-video'); if(!v) return; v.src = item.dataset.src;
    item.addEventListener('click', function(){
      if (item.dataset.loaded) return; item.dataset.loaded='1';
      var play=item.querySelector('.oj-ugc-play'); if(play) play.remove();
      v.muted=false; v.controls=true; v.playsInline=true; var p=v.play(); if(p&&p.catch) p.catch(function(){});
    });
  });

  /* Glatki scroll za CTA */
  document.querySelectorAll('a.oj-cta[href="#bundle-selector"]').forEach(function(a){
    a.addEventListener('click', function(e){ e.preventDefault(); var t=document.getElementById('bundle-selector')||document.querySelector('.single_add_to_cart_button'); if(t) t.scrollIntoView({behavior:'smooth',block:'center'}); });
  });
})();
</script>
