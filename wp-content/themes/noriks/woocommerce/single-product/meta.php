<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

<style>

      .features2 {
    margin-top: 12px;
    margin-bottom: 12px;
      }

      .features__row {
        display: flex;
        justify-content: space-between;
        gap: 28px;
      }

      .feature {
        flex: 1 1 0;
        text-align: center;
      }

      .feature__icon {
 
        margin: 0 auto 0px;
        display: block;
        margin-bottom: 0 !important;
      }

      .feature__text {
        margin: 0;
        line-height: 1.1;
    font-size: 14px;
    margin: 0;
        font-family: 'Barlow', sans-serif;
      }

      /* Responsive: stack nicely on small screens */
      @media (max-width: 640px) {
        .features__row {
     
        }
      }
    </style>


 <section class=" features2" aria-label="Prednosti">
      <div class="features__row">
        <!-- 1) Truck -->
        
        
          <div class="feature">
          
  <img src="<?php echo get_template_directory_uri(); ?>/img/cod_icon_.png" alt="Customer Support Icon" class="feature__icon info-icon">
          <p class="feature__text">Pagamento alla consegna</p>
        </div>
        
        
        <div class="feature">
      <img src="https://noriks.com/hr/wp-content/uploads/2025/07/footer_icon1-1.png" alt="Shirt Icon" class="feature__icon info-icon">
          <p class="feature__text">Prova 30 giorni, senza rischio</p>
        </div>
        
        

        <!-- 2) Smiley -->
        <div class="feature">
     
       
        <img src="https://noriks.com/hr/wp-content/uploads/2025/07/footer_icon3-1.png" alt="Shipping Icon" class="feature__icon info-icon">
          <p class="feature__text">Spedizione gratuita per ordini superiori a 70 €</p>
        </div>

    
    
      </div>
    </section>




<!-- date and countdown section -->

<div class="shipping-box">
  <h2 id="shipping-window" class="shipping-title"></h2>
  <p class="shipping-sub">
    Ordina entro <span id="midnight-countdown" class="countdown"></span>
  </p>
</div>

<style>
  .shipping-box { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; color:#222; margin-top: 13px;
    margin-bottom: 13px; 
      
    background: #f4f4f4;
    padding: 8px 6px 8px 12px;
    border-radius: 5px;
          text-align: center;
      
      
      
  }
  .shipping-title { font-family: 'Roboto', sans-serif;
    font-size: 14px !important;
    font-weight: 700 !important;
    line-height: 1.4 !important; margin-bottom: 0px;
    color: #222 !important; }
  .shipping-sub { font-size: 14px; margin: 0; }
  .countdown { color: #22a155; font-weight: 700; }
</style>

<script>
  (function () {
    const weekdays = ['Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'];

    // Helper to add business days (skip Saturday/Sunday)
    function addBusinessDays(date, days) {
      let result = new Date(date);
      let added = 0;
      while (added < days) {
        result.setDate(result.getDate() + 1);
        const day = result.getDay();
        if (day !== 0 && day !== 6) { // skip Sunday(0) + Saturday(6)
          added++;
        }
      }
      return result;
    }

    // Get shipping days: today +2 business days, today +3 business days
    const today = new Date();
    const first  = addBusinessDays(today, 2);
    const second = addBusinessDays(today, 5);

    function formatDayMonth(d) {
      return `${d.getDate()}.${d.getMonth()+1}.`; // e.g. 21.8.
    }

    const windowEl = document.getElementById('shipping-window');
    windowEl.textContent = `Consegna da ${weekdays[first.getDay()]}  ${formatDayMonth(first)} a ${weekdays[second.getDay()]}, ${formatDayMonth(second)}`;

    // Countdown to midnight
    const cdEl = document.getElementById('midnight-countdown');

    function nextMidnight(now) {
      const n = new Date(now);
      n.setHours(24, 0, 0, 0);
      return n;
    }

    function updateCountdown() {
      const now = new Date();
      const end = nextMidnight(now);
      let diff = Math.max(0, end - now);

      const h = Math.floor(diff / 3_600_000); diff -= h * 3_600_000;
      const m = Math.floor(diff / 60_000);    diff -= m * 60_000;
      const s = Math.floor(diff / 1000);

      cdEl.textContent = `${h}h ${m}min ${s}s`;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
  })();
</script>


<!-- date and countdown section -->





<?php 

$is_singles_boxers = has_term( 'singles-boxers', 'product_cat', $current_product_id );

$is_boxers = has_term( array( 'boxer','1-pezzo-boxer','orto-boxer','confezione-3-boxer','confezione-5-boxer','confezione-7-boxer','confezione-10-boxer','confezione-15-boxer' ), 'product_cat', $current_product_id ) && ! has_term( array( 'black-friday' ), 'product_cat', $current_product_id );

$is_carape = has_term( array( 'calzini','calzini-bianchi','calzini-neri' ), 'product_cat', $current_product_id );

$is_mixed_bundle = has_term( array( 'set','orto-starter','orto-maglietta-boxer','pacchetto-starter' ), 'product_cat', $current_product_id );

?>



<?php if( !$is_boxers && !$is_carape ): ?>


<!-- my thre icons content -->


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


<style>


    .features {
      display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-top: 15px;
    margin-bottom: 15px;
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
  
 <?php endif; ?>


<!--
<div style="margin-bottom: 15px;" class="woocommerce-product-details__short-description">
    
    
	<?php echo apply_filters( 'the_content', $product->get_description() );  ?>
	
	
</div>
-->



 <!-- icons -->
 
 <!--
 <div class="info-section">

    <div class="info-box">
     
     
     
      

     <img src="<?php echo get_field("singlepp_bottomicons_img1","options"); ?>" alt="" width="25" height="25">
     <?php echo get_field("singlepp_bottomicons_t1","options"); ?>

    
     
     
    </div>
    
    
    
     <div class="info-box">
    
         <a href="tel:+38517776471" style="
    color: #7b8a9b;
    font-weight: 500;
    font-size: 14px;
    font-family: 'Roboto', sans-serif; display: flex; align-items: center; text-decoration: none; ">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right: 6px;    width: 17px;
    height: 17px;" viewBox="0 0 16 16">
    <path d="M3.654 1.328a.678.678 0 0 1 .737-.07l2.547 1.272a.678.678 0 0 1 .291.901L6.29 5.72a.678.678 0 0 0 .145.776l2.457 2.457a.678.678 0 0 0 .776.145l2.29-1.24a.678.678 0 0 1 .901.291l1.272 2.547a.678.678 0 0 1-.07.737l-1.175 1.769c-.46.692-1.232 1.043-2.036.964-2.322-.238-4.96-2.223-6.856-4.12C1.77 7.667-.214 5.03.024 2.707c.079-.804.272-1.577.964-2.036L3.654 1.33z"/>
  </svg>
  01 777 64 71
</a>

<a href="mailto:info@noriks.com" style="
    color: #7b8a9b;
    font-weight: 500;
    font-size: 14px;
    font-family: 'Roboto', sans-serif; display: flex; align-items: center; text-decoration: none;">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right: 6px;    width: 17px;
    height: 17px;" viewBox="0 0 16 16">
    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.083 0 4.217V4zm0 1.383v6.234l5.803-3.122L0 5.383zM6.761 8.83 0 12.383V12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.383l-6.761-3.553L8 9.917l-1.239-.653zM16 5.383l-5.803 3.112L16 11.617V5.383z"/>
  </svg>
  info@noriks.com
</a>
         
   
     </div>
     

    <div class="info-grid">
      
      
      
      
      <div class="info-box">
       <img src="<?php echo get_field("singlepp_bottomicons_img2","options"); ?>" alt=""  width="25" height="25">
        <?php echo get_field("singlepp_bottomicons_t2","options"); ?>
      </div>
      <div class="info-box">
  
<img src="<?php echo get_field("singlepp_bottomicons_img3","options"); ?>" alt=""  width="25" height="25">
<?php echo get_field("singlepp_bottomicons_t3","options"); ?>
      </div>
    </div>

  </div>
  -->
  
  <style>


    .info-section {
      display: flex;
      flex-direction: column;
      gap: 7px;
      max-width: 800px;
      margin: auto;
      margin-bottom: 25px;
    }
    
    .info-section img {
      width: 25px;
    }


    .info-box {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background-color: #f5f6f8;
      border-radius: 3px;
      padding: 16px;
      color: #7b8a9b;
      font-weight: 500;
      font-size: 14px;
          font-family: 'Roboto', sans-serif; 
      text-align: center;
    }

    .info-grid {
      display: flex;
      gap: 7px;
    }

    .info-grid .info-box {
      flex: 1;
    }

    .info-box svg {
      width: 24px;
      height: 24px;
      fill: #7b8a9b;
    }
  </style>









 <!-- icons -->


 <div class="accordion">


    <!-- KidsNest: primi due elementi accordion (contenuto lungo dal summary) -->
    <?php if ( function_exists('noriks_is_type') && noriks_is_type( 'kidsnest', $current_product_id ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Il viso del tuo bambino si sta formando proprio ora — e hai tempo fino ai 9 anni</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <p>I ricercatori delle vie respiratorie e i dentisti pediatrici avvertono da anni dello stesso schema — di cui la maggior parte dei genitori non ha mai sentito parlare. Si chiama <strong>sindrome del viso lungo</strong> (facies adenoidea).</p>
        <p>Ogni notte in cui un bambino dorme con la bocca aperta sul cuscino sbagliato, accadono quattro cose contemporaneamente: la lingua cade all'indietro, la mascella arretra, il palato si restringe in un arco alto e il viso inizia a crescere in verticale invece che in orizzontale. Dopo migliaia di notti così tra i 3 e i 9 anni, i cambiamenti si consolidano.</p>
        <p>Ecco perché oggi i bambini di 9 anni si presentano dall'ortodontista con il mento arretrato, le occhiaie, i denti affollati — e un conto salato per l'apparecchio. Il modo in cui un bambino respira tra i 3 e i 9 anni influenza fortemente il viso che porterà per tutta la vita.</p>
        <p>NORIKS <strong>KidsNest</strong> è progettato per agire sulla causa di fondo — la posizione scorretta di testa e mascella durante le 9 ore di sonno — con una <strong>struttura ergonomica a 3 zone</strong> che mantiene testa, collo e mascella nel corretto allineamento fin dalla prima notte.</p>
        <p><strong>Cosa vedrai nel tuo bambino:</strong></p>
        <ul style="margin:6px 0 12px;padding-left:18px;">
          <li style="margin:0 0 7px;"><strong>Meno respirazione con la bocca:</strong> labbra chiuse durante la notte, ritorno della respirazione nasale, fine della bocca secca al mattino.</li>
          <li style="margin:0 0 7px;"><strong>Notti più silenziose:</strong> nella maggior parte dei bambini il russare si calma entro 1–2 settimane.</li>
          <li style="margin:0 0 7px;"><strong>Sostegno alla mascella in sviluppo:</strong> posizione corretta notte dopo notte, negli anni in cui conta di più.</li>
          <li style="margin:0 0 7px;"><strong>Prevenzione intelligente:</strong> un cuscino oggi — invece di costose correzioni domani.</li>
        </ul>
        <p><strong>Un cuscino stasera. O migliaia di euro dopo.</strong></p>
      </div>
    </div>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Più di 9 anni? La finestra si restringe. Il danno non si ferma.</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <p>Il consiglio che hai sentito è vero solo a metà. Sì, il palato superiore si consolida intorno ai 9 anni. Ma il viso si sviluppa fino ai 20, la mascella inferiore cresce fino ai 17 e le vie respiratorie si adattano continuamente.</p>
        <p>Per questo ogni notte di respirazione con la bocca dopo i 9 anni aggiunge nuovo danno al vecchio: digrignamento dei denti, mal di testa, un sonno che non riposa, calo di concentrazione — e una stanchezza che tutti scambiano per pigrizia. Il tuo adolescente non è pigro. Respira a fatica per sei ore ogni notte.</p>
        <p>KidsNest nella taglia <strong>9–14 anni</strong> è realizzato per una testa, un collo e delle spalle più grandi. Un profilo diverso, un'altezza diversa, un sostegno diverso. Lo stesso meccanismo di fondo: il corretto allineamento di testa, collo e mascella, per tutta la notte, su un corpo che sta ancora crescendo.</p>
        <p>Cosa notano i genitori: il russare si calma in 7–14 notti, torna la vera energia mattutina, i mal di testa svaniscono, la concentrazione ritorna.</p>
        <p>La finestra migliore resta dai 3 ai 9 anni. Una finestra forte è dagli 8 ai 18. Nessuna è del tutto chiusa — ma ogni notte di attesa aggiunge pressione a un corpo che cerca di recuperare.</p>
        <p><strong>Ieri è passato. Stasera è ancora tuo.</strong></p>
      </div>
    </div>
    <?php endif; ?>


    <!-- ErgoSit cuscino ortopedico: primi due elementi accordion (copia dell'originale, IT) -->
    <?php if ( function_exists('noriks_is_type') && noriks_is_type( 'ortopedski-jastuk', $current_product_id ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Specifiche del prodotto</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <ul style="margin:8px 0 12px; padding-left:18px;">
          <li style="margin:0 0 8px;"><strong>Fodera esterna:</strong> Tessuto a maglia traspirante, sfoderabile e lavabile in lavatrice, ipoallergenico</li>
          <li style="margin:0 0 8px;"><strong>Nucleo:</strong> Schiuma adattiva OrthoFlex™ | Atossica, certificata OEKO-TEX® | Progettata per scaricare la pressione + allineare la postura</li>
        </ul>
      </div>
    </div>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Cosa lo rende così speciale?</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <ul style="margin:8px 0 12px; padding-left:18px;">
          <li style="margin:0 0 10px;"><strong>Memory foam OrthoFlex™:</strong> Schiuma ad alta densità che scarica la pressione e si adatta senza appiattirsi — sostiene coccige, anche e colonna per un comfort che dura tutto il giorno.</li>
          <li style="margin:0 0 10px;"><strong>Fodera BreatheEase™:</strong> Morbida, traspirante e delicata sulla pelle. Si toglie e si lava in lavatrice, così il cuscino resta sempre fresco.</li>
          <li style="margin:0 0 10px;"><strong>Sostegno equilibrato:</strong> Né troppo morbido, né troppo rigido. Progettato per allineare la postura e alleviare i punti dolenti dopo lunghe ore da seduti.</li>
        </ul>
      </div>
    </div>
    <?php endif; ?>


    <!-- 1 - detajli --> <!-- nascosto su norikshers + cuscino ortopedico -->
    <?php if ( ! ( function_exists('noriks_is_type') && ( noriks_is_type('norikshers', $current_product_id) || noriks_is_type('ortopedski-jastuk', $current_product_id) ) ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo get_field("singlepp_acc_h_1","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">

         <?php if( function_exists('noriks_is_type') && noriks_is_type( 'kidsnest', $current_product_id ) ): ?>

                NORIKS KidsNest è realizzato in memory foam ipoallergenico certificato OEKO-TEX® — senza formaldeide, metalli pesanti e BPA — con una fodera traspirante e lavabile che si toglie con facilità.<br><br>La sua struttura ergonomica a 3 zone accoglie delicatamente la testa, sostiene il collo e aiuta a mantenere la colonna vertebrale in allineamento naturale — anche quando il bambino si gira molto durante la notte. Favorisce così la respirazione nasale e un sonno più tranquillo e profondo.<br><br>Disponibile in tre taglie (1–3, 3–9 e 9–14 anni), cresce con il tuo bambino e offre la giusta altezza di sostegno in ogni fase dello sviluppo.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

                I boxer per l'incontinenza NORIKS sono realizzati in morbida fibra di bambù antibatterica con uno strato esterno idrorepellente. Al centro c'è il nucleo PureDry™ a 7 strati che assorbe all'istante e blocca fino a 300 ml di liquido, così la pelle resta asciutta e le perdite restano all'interno.<br><br>Il taglio è sottile e discreto — appare e si sente come normale biancheria intima, senza ingombro e senza effetto "pannolone". La protezione lungo le gambe previene le perdite laterali, mentre il controllo degli odori mantiene la freschezza per tutta la giornata.<br><br>Sono lavabili e riutilizzabili — mantengono il potere assorbente per centinaia di lavaggi, come alternativa ecologica e conveniente agli assorbenti e ai pannoloni usa e getta.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

                NORIKS FIT è realizzato in un avanzato tessuto compressivo ionico che offre una vestibilità aderente e di supporto. La compressione mirata comprime in modo uniforme pancia e fianchi, leviga la silhouette e sostiene una postura eretta — senza costrizioni che limitano il respiro o i movimenti.<br><br>Le fibre micro-tessute stimolano la circolazione e ti aiutano a stare più dritto e a sentirti più sicuro durante la giornata. Il tessuto è leggero, traspirante e traspira l'umidità, così resti asciutto e a tuo agio.<br><br>Il taglio sottile e discreto lo rende invisibile sotto qualsiasi camicia, e può servire anche come maglia sportiva. Il risultato: un look più definito, una postura migliore e più sicurezza — appena lo indossi.

         <?php elseif( !$is_boxers &&  !$is_carape &&   !$is_mixed_bundle && ! ( function_exists('noriks_is_type') && ( noriks_is_type('ortopas', $current_product_id) || noriks_is_type('bunion', $current_product_id) || noriks_is_type('fisiorest', $current_product_id) ) ) ): ?>



        <?php echo get_field("singlepp_acc_t_1","options"); ?>


        <?php elseif(  has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', $current_product_id )  ): ?>



                Le nostre magliette premium sono realizzate con un misto di alta qualità di 60% cotone ring-spun e 40% poliestere, garantendo un tessuto estremamente morbido e resistente alle pieghe. <br><br>I boxer NORIKS sono realizzati con un misto premium di 95% modal e 5% elastan, garantendo un tessuto estremamente morbido ed elastico che si adatta perfettamente al corpo. La fascia elastica è progettata per una vestibilità ottimale, offrendo comfort senza costrizioni. <br>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('fisiorest', $current_product_id) ): ?>

                NORIKS FisioRest è un cuscino terapeutico per il collo che combina trazione, calore e massaggio vibrante in un design ergonomico in memory foam. Distende delicatamente il collo con l'angolazione corretta, scarica la colonna cervicale e, con calore e massaggio, scioglie la tensione muscolare. Senza fili, ricaricabile e avvolto in morbida seta rinfrescante – sicuro anche per il sonno.

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('bunion', $current_product_id) ): ?>

                Il correttore per alluce valgo NORIKS, con la sua terapia di allineamento avanzata e il meccanismo a snodo brevettato, riporta delicatamente l'alluce nella posizione naturale, allevia il fastidio e previene l'ulteriore crescita della sporgenza. Il design flessibile ti permette anche di camminarci. Si adatta a tutte le taglie di piede, senza lato destro o sinistro. Da usare a riposo – mentre ti rilassi, guardi la TV, leggi o dormi.

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) ): ?>

                La fascia ortopedica NORIKS stabilizza in modo mirato la parte bassa della schiena grazie a una compressione mirata, allinea correttamente il bacino e scarica il nervo sciatico. Sottile e invisibile sotto i vestiti, con livello di sostegno regolabile. Adatta in caso di dolori lombari, sciatica, tensione muscolare e problemi all'articolazione sacroiliaca.

        <?php else: ?>
        
        
        
            <?php echo get_field("__overwrite_sekcije_bellow_1"); ?>
            
            
        <?php endif; ?>
        
        
        
      </div>
    </div>
    
    
    
     
     <?php endif; /* /nascosto dettagli su norikshers */ ?>

     <!-- 2 - slika tablica velicina -->
     <?php if ( ! ( function_exists('noriks_is_type') && ( noriks_is_type('bunion', $current_product_id) || noriks_is_type('fisiorest', $current_product_id) || noriks_is_type('norikshers', $current_product_id) || noriks_is_type('ortopedski-jastuk', $current_product_id) ) ) ) : // nessuna tabella taglie per bunion + fisiorest + norikshers + cuscino ortopedico ?>
     <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Tabella delle taglie</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">

           <?php if( function_exists('noriks_is_type') && noriks_is_type( 'kidsnest', $current_product_id ) ): ?>

          <div class="kn-size">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kidsnest/tablica-velicine.webp" alt="Taglie KidsNest per età" style="width:100%;height:auto;border-radius:10px;display:block;margin:0 0 12px;" loading="lazy">
            <p style="margin:0;line-height:1.6;"><strong>Il bambino è tra due taglie?</strong> Scegli sempre la più grande. Il cuscino è progettato per sostenere un sano allineamento mentre il bambino cresce — la taglia più grande offre più spazio e un periodo di utilizzo più lungo.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

          <div class="lbx-size">
            <p style="margin:0 0 6px;font-weight:700;">Come misurare i fianchi</p>
            <p style="margin:0 0 14px;line-height:1.6;">Avvolgi il metro intorno alla parte più larga dei fianchi (sopra i glutei), senza stringere. Stai in piedi rilassato ed eretto e annota la misura in centimetri.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#12233b;color:#fff;">
                  <th style="padding:8px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Taglia</th>
                  <th style="padding:8px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Fianchi (cm)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $lbx_sizes = array(
                  array('S','fino a 76 cm','fino a 30"'),
                  array('M','77 – 85 cm','30 – 33"'),
                  array('L','86 – 94 cm','34 – 37"'),
                  array('XL','95 – 102 cm','37 – 40"'),
                  array('2XL','103 – 114 cm','41 – 45"'),
                  array('3XL','115 – 121 cm','45 – 48"'),
                  array('4XL','122 – 129 cm','48 – 51"'),
                  array('5XL','130 – 137 cm','51 – 54"'),
                  array('6XL','138 – 145 cm','54 – 57"'),
                  array('7XL','146 – 153 cm','57 – 60"'),
                  array('8XL','154 cm e oltre','61" e oltre'),
                );
                foreach ( $lbx_sizes as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#f7fafb' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #eee;">
                    <td style="padding:8px 10px;font-weight:700;"><?php echo esc_html($r[0]); ?></td>
                    <td style="padding:8px 10px;"><?php echo esc_html($r[1]); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Tra due taglie?</strong> Consigliamo sempre la taglia più grande per un comfort ottimale e il massimo assorbimento.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

          <div class="kmf-size">
            <table style="width:100%;border-collapse:collapse;font-size:15px;">
              <thead>
                <tr style="background:#111;color:#fff;">
                  <th style="padding:9px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Taglia</th>
                  <th style="padding:9px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Peso corrispondente</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kmf_sizes = array(
                  array('S','50 – 70 kg'), array('M','70 – 90 kg'), array('L','90 – 110 kg'), array('XL','110 – 130 kg'),
                  array('2XL','130 – 150 kg'), array('3XL','150 – 170 kg'), array('4XL','170 – 190 kg'), array('5XL','190 – 210 kg'),
                );
                foreach ( $kmf_sizes as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#f4f4f4' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #eaeaea;">
                    <td style="padding:9px 12px;font-weight:800;"><?php echo esc_html($r[0]); ?></td>
                    <td style="padding:9px 12px;font-weight:700;"><?php echo esc_html($r[1]); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <p style="margin:12px 0 0;line-height:1.6;">Scegli la taglia in base al tuo peso. Tra due taglie? Per una compressione più forte scegli la taglia più piccola.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) ): ?>

          <div style="line-height:1.9;">
            <strong>S/M</strong> : circonferenza fianchi 75–110 cm<br>
            <strong>L/XL</strong> : circonferenza fianchi 110–140 cm<br><br>
            Misura la circonferenza dei fianchi per trovare la tua taglia.
          </div>

        <?php elseif( $is_boxers ): ?>


          <img class="js-open-size-chart" style="cursor:pointer;" src="https://noriks.com/it/wp-content/uploads/2026/02/boxers_size_it.png">



        <?php elseif(  $is_carape ): ?>


                  <img class="js-open-size-chart" style="cursor:pointer;" src="https://noriks.com/it/wp-content/uploads/2026/02/Nogavice_tabela_velikosti_it.png">

    <?php elseif(  $is_mixed_bundle ): ?>

     <img class="js-open-size-chart" style="cursor:pointer;" src="<?php echo get_template_directory_uri(); ?>/img/tabela-velikosti-majice.jpg">
<img class="js-open-size-chart" style="cursor:pointer;" src="https://noriks.com/it/wp-content/uploads/2026/02/boxers_size_it.png">

          <?php else: ?>


       <img class="js-open-size-chart" style="cursor:pointer;" src="<?php echo get_template_directory_uri(); ?>/img/tabela-velikosti-majice.jpg">


        <?php endif; ?>
      </div>
    </div>
    <?php endif; // /nessuna tabella taglie per bunion + fisiorest ?>


    <!-- 3 - savjeti za pranje-->
    <?php if ( ! ( function_exists('noriks_is_type') && ( noriks_is_type('ortopas', $current_product_id) || noriks_is_type('bunion', $current_product_id) || noriks_is_type('fisiorest', $current_product_id) || noriks_is_type('norikshers', $current_product_id) || noriks_is_type('ortopedski-jastuk', $current_product_id) || noriks_is_type('kidsnest', $current_product_id) ) ) ) : // nessun consiglio di lavaggio per fascia/bunion/fisiorest/norikshers/cuscino ortopedico/kidsnest ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo get_field("singlepp_acc_h_2","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
             <?php if( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

                Lavare a 30–40 °C, con un programma per capi delicati. Senza ammorbidente né candeggina. Asciugare all'aria. Mantengono il potere assorbente per centinaia di lavaggi.

             <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

                Lavaggio in lavatrice a freddo, con programma delicato. Senza candeggina né ammorbidente. Non asciugare in asciugatrice — asciugare all'aria per preservare la compressione e la forma.

             <?php elseif( !$is_boxers &&  !$is_carape &&   !$is_mixed_bundle ): ?>
        <?php echo get_field("singlepp_acc_t_2","options"); ?>


        <?php elseif(  has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', $current_product_id )  ): ?>



                         Lavare i colori con i colori. Programma delicato a bassa temperatura. Asciugare steso o in asciugatrice a bassa temperatura. Non candeggiare.


          <?php else: ?>
            <?php echo get_field("__overwrite_sekcije_bellow_3"); ?>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; // /nessun consiglio di lavaggio per fascia/bunion/fisiorest ?>



    <!-- 4 povrati in menjave -->
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo function_exists('noriks_strip_free') ? noriks_strip_free( get_field("singlepp_acc_h_3","options") ) : get_field("singlepp_acc_h_3","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
       <p></p>
       Crediamo così tanto che ti piacerà NORIKS che hai <b data-stringify-type="bold">30 giorni</b> per il reso o il cambio.
Senza burocrazia, senza stress – risolviamo in pochi clic. </p>

<p>
    



  <a href="mailto:info@noriks.com" style="display: flex; align-items: center; text-decoration: none; color: #333;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#333" style="margin-right: 6px;" viewBox="0 0 16 16">
      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.083 0 4.217V4zm0 1.383v6.234l5.803-3.122L0 5.383zM6.761 8.83 0 12.383V12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.383l-6.761-3.553L8 9.917l-1.239-.653zM16 5.383l-5.803 3.112L16 11.617V5.383z"/>
    </svg>
    info@noriks.com
  </a>
</p>
<p>Samo nam napiši mail da želiš zamjenu i <b data-stringify-type="bold">odmah ćemo sve srediti.</b></p>
       
       
      </div>
    </div>



    <!-- 5 - infomraicje o dostavi -->
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo get_field("singlepp_acc_h_4","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <?php echo get_field("singlepp_acc_t_4","options"); ?>
      </div>
    </div>
    
    
    <!-- konec 5 acrodinov -->

  </div>

  <script>
    function toggleAccordion(header) {
      const item = header.parentElement;
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.accordion-item').forEach(el => el.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    }
  </script>
  
  
  <style>
      
       .accordion {
      border-top: 1px solid #ddd;
    }

    .accordion-item {
      border-bottom: 1px solid #ddd;
    }

    .accordion-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 5px 5px 0px;
      cursor: pointer;
    }

    .accordion-header h3 {
      display: flex;
      align-items: center;
      font-weight: 500;
      font-size: 16px;
      margin: 0;
      gap: 2px;
      font-family: 'Roboto', sans-serif;  
    }

    .accordion-content {
      padding: 0 0 0 0;
      display: none;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;  
      line-height: 1.6;
      color: black;
    }

    .accordion-item.open .accordion-content {
      display: block;
    }

    .icon {
      width: 24px;
      height: 24px;
      display: inline-block;
      background-size: contain;
      background-repeat: no-repeat;

    }
    
    .icon-details {
   
      margin: 0 0px 0 10px !important;
    }
    
    .icon-size {
   
      margin: 0 0px 0 10px !important;
    }

    /* Placeholder icons using emojis 
    
    .icon.details::before { content: "📝"; }
     .icon.size::before { content: "👕"; }
    .icon.laundry::before { content: "🧺"; }
    .icon.returns::before { content: "↩️"; }
    .icon.shipping::before { content: "📦"; }
*/
    .toggle {
      font-size: 24px;
      transition: transform 0.3s ease;
    }

    .accordion-item.open .toggle {
      transform: rotate(45deg);
    }
  </style>








<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
