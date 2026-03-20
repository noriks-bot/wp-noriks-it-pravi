jQuery(function($){

<<<<<<< HEAD
  /* ---------- disable ATC on page load (as requested) ---------- */
=======
  /* ---------- disable ATC on page load (only once) ---------- */
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
  (function(){
    var $btn = $('.single_add_to_cart_button');
    if ($btn.length) {
      $btn.prop('disabled', true).addClass('ibb-disabled');
    }
  })();

  /* ---------- state & utils ---------- */
  function emptySlot(){ return {product_id:0,variation_id:0,attr:{},title:'',price_html:'',img:''}; }
  var carts = {}; // wrapper-id -> array of slots

  // EXPOSE carts so we can log slot/cart content from global listeners
  window.IBB = window.IBB || {};
  window.IBB.carts = carts;

  function uid(){ return 'ibb-' + Math.random().toString(36).slice(2,8); }

<<<<<<< HEAD
=======
  // Normalizers to make attribute key checks robust (diacritics, case, prefixes)
  function norm(s){
    return String(s || '')
      .toLowerCase()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g,''); // strip diacritics (works for Greek tonos too)
  }
  function canonicalKey(key){
    // remove WC prefixes and diacritics
    // e.g. "attribute_Μέγεθος" -> "μεγεθος"
    var k = norm(key).replace(/^pa_/, '').replace(/^attribute_/, '');
    return k;
  }

>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
  function $btn($wrap){
    return $wrap.closest('form.cart').find('.single_add_to_cart_button, [name="add-to-cart"], [type="submit"][name="add-to-cart"]');
  }
  function disableBtn($wrap){
    $btn($wrap)
      .attr('disabled','disabled')
      .prop('disabled',true)
      .addClass('cqbf-disabled ibb-disabled');
  }
  function enableBtn($wrap){
    $btn($wrap)
      .prop('disabled',false)
      .removeClass('cqbf-disabled ibb-disabled')
      .removeAttr('disabled');
  }

<<<<<<< HEAD
  function allFilled($wrap){
    var wid = $wrap.attr('data-ibb-id');
    var cart = carts[wid] || [];
    return cart.length && cart.every(function(s){ return !!s.product_id; });
  }

=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
  function pushHidden($wrap){
    var wid  = $wrap.attr('data-ibb-id');
    var cart = carts[wid] || [];
    var $field = $wrap.closest('form.cart').find('input[name="ibb_cart_data"]');
    if ($field.length) $field.val(JSON.stringify(cart));
  }

  /* ---------- modal open/close (two-phase) ---------- */
  function openModal($modal){
    if($modal.hasClass('open')) return; // already open
    $modal.removeClass('closing').addClass('show').attr('aria-hidden','false');
    $('body').addClass('ibb-lock');
<<<<<<< HEAD
    // force reflow to apply starting transform
=======
    // force reflow
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    // eslint-disable-next-line no-unused-expressions
    $modal[0].offsetHeight;
    $modal.addClass('open');
  }

  function closeModal($modal){
    if(!$modal.hasClass('show')) return;
    $modal.removeClass('open').addClass('closing').attr('aria-hidden','true');

    var box = $modal.find('.ibb-modal__box')[0];
    var finished = false;
    function finish(){
      if(finished) return;
      finished = true;
      $modal.removeClass('show closing');
      $('body').removeClass('ibb-lock');
    }
    if(box){
      var onEnd = function(e){
        if(e.propertyName === 'transform'){ box.removeEventListener('transitionend', onEnd); finish(); }
      };
      box.addEventListener('transitionend', onEnd);
<<<<<<< HEAD
      // Fallback
      setTimeout(finish, 550);
=======
      setTimeout(finish, 550); // fallback
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    } else {
      finish();
    }
  }

  /* ---------- messages: compute per product -> slots list ---------- */
  function updateCardMessages($wrap, $modal){
    var wid = $wrap.attr('data-ibb-id');
    var cart = carts[wid] || [];

    var byPid = {};
    for(var i=0;i<cart.length;i++){
      var s = cart[i];
      if(!s || !s.product_id) continue;
      var pid = s.product_id;
      (byPid[pid] = byPid[pid] || []).push(i+1);
    }

    var $cards = $modal.find('.ibb-card');
    $cards.each(function(){
      var $card = $(this);
      var pid = Number($card.data('id')) || 0;
      var slots = byPid[pid] || [];
      var $msg = $card.find('.ibb-msg');

      if(slots.length){
<<<<<<< HEAD
        var label = (slots.length === 1) ? 'Dodano u slot: ' : 'Dodano u slotove: ';
        $msg.text(label + slots.join(', '));
=======
        $msg.text('Προστέθηκε στη θέση: ' + slots.join(', '));
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      } else {
        $msg.empty();
      }
    });
  }

<<<<<<< HEAD
  /* ---------- GRATIS slots parsing (1-based) ---------- */
  function parseGratisSet($wrap, totalSlots){
    var attr = String($wrap.attr('data-ibb-gratis-slots') || '').trim().toLowerCase();
    var set = {};
    if (!attr) return set;

    if (attr === 'all'){
      for (var i=1; i<=totalSlots; i++) set[i] = true;
      return set;
    }

    attr.split(',').forEach(function(tok){
      tok = tok.trim();
      if(!tok) return;
      if(tok.indexOf('-') > -1){
        var parts = tok.split('-');
        var a = parseInt(parts[0], 10);
        var b = parseInt(parts[1], 10);
        if(!isNaN(a) && !isNaN(b)){
          var start = Math.min(a,b), end = Math.max(a,b);
          for (var j = start; j <= end; j++) set[j] = true;
        }
      } else {
        var n = parseInt(tok, 10);
        if(!isNaN(n)) set[n] = true;
      }
    });
    return set;
  }

  /* ---------- render slots (now renders GRATIS when applicable) ---------- */
  function refreshSlots($wrap){
    var wid   = $wrap.attr('data-ibb-id');
    var cart  = carts[wid] || [];
    var total = $wrap.find('.ibb-slot').length;

    // Cache parsed gratis set per wrapper
    var gratisSet = $wrap.data('ibbGratisSet');
    if (!gratisSet) {
      gratisSet = parseGratisSet($wrap, total);
      $wrap.data('ibbGratisSet', gratisSet);
    }
=======
  /* ---------- render slots ---------- */
  function refreshSlots($wrap){
    var wid = $wrap.attr('data-ibb-id');
    var cart = carts[wid] || [];
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f

    $wrap.find('.ibb-slot').each(function(i){
      var s = cart[i] || emptySlot();
      var $slot = $(this);
      var filled = !!s.product_id;

      $slot.toggleClass('is-filled', filled).toggleClass('is-empty', !filled);

      var $thumb = $slot.find('.ibb-slot-thumb');
      $thumb.empty();
      if(filled && s.img){
        $('<img>', { src: s.img, alt: '' }).appendTo($thumb);
      } else {
        $('<span>', { class: 'ibb-slot-plus', text: '+', 'aria-hidden': 'true' }).appendTo($thumb);
      }

<<<<<<< HEAD
      // Build slot attr content with optional GRATIS prefix
      var $attr = $slot.find('.ibb-slot-attr');
      $attr.empty();

      var idx1 = i + 1; // 1-based
      if (gratisSet[idx1]) {
        $('<span>', { class: 'ibb-slot-attr-gratis', text: 'GRATIS' }).appendTo($attr);
      }

=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      if(filled){
        var size = '';
        var attr = s.attr || {};
        for(var k in attr){
<<<<<<< HEAD
          if(!Object.prototype.hasOwnProperty.call(attr, k)) continue;
          var key = (k+'').toLowerCase();
          if(key.indexOf('size')!==-1 || key.indexOf('velicina')!==-1 || key.indexOf('veličina')!==-1){
            size = (attr[k]+'').toUpperCase();
          }
        }
        // append size (or fallback label) as plain text
        $attr.append(document.createTextNode(size || ''));
        if (!size) {
          // if no size available (filled but no size attribute), show title as fallback
          var title = s.title || '';
          if (title) $attr.append(document.createTextNode(title));
        }
      } else {
          
         //
       // Try to find the closest product container that has data-is-boxers
        var productEl =
          $wrap.closest('[id^="product-"][data-is-boxers]').get(0) ||
          document.querySelector('[id^="product-"][data-is-boxers]');

        // Default fallback (in case element not found or attribute missing)
        var isBoxers = false;

        if (productEl && typeof productEl.dataset.isBoxers !== 'undefined') {
          var flag = productEl.dataset.isBoxers;
          // Accept "1" or "true" as truthy
          isBoxers = (flag === '1' || flag === 'true');
        }

        console.log('isBoxers:', isBoxers);

        // Write correct text based on value
        $attr.append(
          document.createTextNode(isBoxers ? 'Dodaj proizvod' : 'Dodaj majicu')
        );
        //

        
=======
          if(!attr.hasOwnProperty(k)) continue;
          var ck = canonicalKey(k); // e.g. "attribute_Μέγεθος" -> "μεγεθος"
          if (ck === 'μεγεθος' || ck === 'size') {
            size = String(attr[k]).toUpperCase();
            break;
          }
        }
        $slot.find('.ibb-slot-attr').text(size || 'Επιλέξτε μπλουζάκι');
      } else {
        $slot.find('.ibb-slot-attr').text('Επιλέξτε μπλουζάκι');
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      }

      $slot.find('.ibb-slot-price').html(filled ? (s.price_html || '') : '');

      var $remove = $slot.find('.ibb-slot-remove');
      if(filled){
        if(!$remove.length){
          $('<button>', {
            type: 'button',
            class: 'ibb-slot-remove',
<<<<<<< HEAD
            'aria-label': 'Remove',
=======
            'aria-label': 'Αφαίρεση',
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
            text: '×'
          }).appendTo($slot);
        }
      } else {
        $remove.remove();
      }
    });

    pushHidden($wrap);
    updateCardMessages($wrap, $('.ibb-modal').first());
  }

  /* ---------- authoritative ATC toggle (+ events) ---------- */
  function enforceATC($wrap){
    var wid = $wrap.attr('data-ibb-id');
    var slots = carts[wid] || [];
    var filled = slots.length && slots.every(function(s){ return !!s.product_id; });

    if(filled){
      enableBtn($wrap);
<<<<<<< HEAD
      // include slot data in event payload
=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      $wrap.trigger('ibb:slotsFilled', [{ filledCount: slots.length, slots: slots }]);
    } else {
      disableBtn($wrap);
      $wrap.trigger('ibb:slotsNotFilled', [{
        filledCount: slots.filter(function(s){ return !!s.product_id; }).length,
        slots: slots
      }]);
    }
  }

<<<<<<< HEAD


function renderSteps($wrap, $modal, total, active) {

    // Detect isBoxers EXACTLY the same way as in refreshSlots()
    var productEl =
        $wrap.closest('[id^="product-"][data-is-boxers]').get(0) ||
        document.querySelector('[id^="product-"][data-is-boxers]');

    var isBoxers = false;
    if (productEl && typeof productEl.dataset.isBoxers !== 'undefined') {
        var flag = productEl.dataset.isBoxers;
        isBoxers = (flag === '1' || flag === 'true');
    }

    // Choose label
    var labelBase = isBoxers ? 'Proizvod ' : 'Majica ';

    // Render steps
    var $steps = $modal.find('.ibb-steps').empty();
    for (var i = 0; i < total; i++) {
        var $p = $('<button type="button" class="ibb-step" role="tab"></button>')
            .text(labelBase + (i + 1) + ' od ' + total)
            .attr('data-index', i);

        if (i === active) {
            $p.addClass('is-active').attr('aria-selected', 'true');
        }

        $steps.append($p);
    }

    $modal.find('.ibb-step-num').text(active + 1);
}

  
  

  function preselectDefaultSizeS($scope){
    var sizeKeys={'size':1,'velicina':1,'veličina':1,'pa_size':1,'pa_velicina':1};
    $scope.find('.ibb-attr').each(function(){
      var $sel=$(this);
      var key=String($sel.data('taxonomy')||'').toLowerCase();
      if(!sizeKeys[key]) return;
      $sel.find('option').each(function(){
        var txt=($(this).text()||'').trim().toLowerCase();
        var val=($(this).val()||'').trim().toLowerCase();
        if(txt==='s'||val==='s'){ $sel.val($(this).val()); return false; }
      });
    });
=======
  function renderSteps($wrap,$modal,total,active){
    var $steps = $modal.find('.ibb-steps').empty();
    for(var i=0;i<total;i++){
      var $p = $('<button type="button" class="ibb-step" role="tab"></button>')
        .text('Μπλουζάκι ' + (i+1) + ' από ' + total)
        .attr('data-index', i);
      if(i===active) $p.addClass('is-active').attr('aria-selected','true');
      $steps.append($p);
    }
    $modal.find('.ibb-step-num').text(active+1);
  }

  function preselectDefaultSizeS($scope){
    // Look for both custom .ibb-attr controls and Woo's selects (attribute_*)
    $scope
      .find('.ibb-attr, select[name^="attribute_"], [data-attribute_name]')
      .each(function(){
        var $el = $(this);
        var key =
          $el.data('taxonomy') ||
          $el.data('attribute_name') ||
          $el.attr('name') || '';
        var ck = canonicalKey(key); // "μεγεθος", "size", ...

        if (ck !== 'μεγεθος' && ck !== 'size') return;

        if ($el.is('select')) {
          $el.find('option').each(function(){
            var t = norm($(this).text()).trim();
            var v = norm($(this).val()).trim();
            if (t === 's' || v === 's') { $el.val($(this).val()).trigger('change'); return false; }
          });
        }
      });
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
  }

  /* ---------- nav button disable ---------- */
  function updateNavButtons($modal, activeIndex){
    var $steps = $modal.find('.ibb-step');
    var total = $steps.length;
    var $prev = $modal.find('.ibb-prev');
    var $next = $modal.find('.ibb-next');

    $prev.prop('disabled', activeIndex <= 0).attr('aria-disabled', activeIndex <= 0 ? 'true' : null);
    $next.prop('disabled', activeIndex >= total-1).attr('aria-disabled', activeIndex >= total-1 ? 'true' : null);
  }

  /* ---------- helper: center active step in horizontal scroller (mobile) ---------- */
  function scrollActiveStepIntoView($modal){
    var $active = $modal.find('.ibb-step.is-active');
    var $scroller = $modal.find('.ibb-steps-nav');
    if($active.length && $scroller.length){
      $active[0].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }
  }

  /* ---------- mobile close chevron injector ---------- */
  function ensureMobileClose($modal){
    if($modal.find('.ibb-modal__close-mobile').length) return;
    var $head = $modal.find('.ibb-modal__head');
    if(!$head.length) return;

    var $btn = $('<button>', {
      type: 'button',
      class: 'ibb-modal__close-mobile',
<<<<<<< HEAD
      'aria-label': 'Zatvori'
=======
      'aria-label': 'Κλείσιμο'
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    }).html(`
      <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0188 29.6438C21.044 28.6187 22.706 28.6187 23.7312 29.6438L35.875 41.7877L48.0188 29.6438C49.044 28.6187 50.706 28.6187 51.7312 29.6438C52.7563 30.669 52.7563 32.331 51.7312 33.3562L37.7312 47.3562C36.706 48.3813 35.044 48.3813 34.0188 47.3562L20.0188 33.3562C18.9937 32.331 18.9937 30.669 20.0188 29.6438Z" fill="#4A4A4A"></path>
      </svg>
    `);

<<<<<<< HEAD
    // insert at the very top of header
    $head.prepend($btn);

    // hook click -> close
=======
    $head.prepend($btn);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    $modal.on('click', '.ibb-modal__close-mobile', function(){
      closeModal($modal);
    });
  }

  /* ---------- hydrate JS state from server-rendered DOM ---------- */
  function hydrateFromDOM($wrap){
    var wid = $wrap.attr('data-ibb-id');
    var slots = [];
    $wrap.find('.ibb-slot').each(function(){
      var $slot = $(this);
      var pid = Number($slot.data('product-id')) || 0;
      if(pid){
        var img = $slot.find('img').attr('src') || '';
        slots.push({ product_id: pid, variation_id: 0, attr: {}, title: '', price_html: '', img: img });
      } else {
        slots.push(emptySlot());
      }
    });
    carts[wid] = slots;
  }

  /* ---------- init per builder ---------- */
  $('.ibb-wrapper').each(function(){
    var $wrap=$(this);
    if($wrap.data('ibbInit')) return;
    $wrap.data('ibbInit',true);

    var wid=uid();
    $wrap.attr('data-ibb-id',wid);

    var slots=parseInt($wrap.attr('data-slots'),10)||1;

    // Attach modal to body once
    var $modal=$('.ibb-modal').first();
    if(!$modal.data('ibbAttached')){ $modal.appendTo('body').data('ibbAttached',true); }

<<<<<<< HEAD
    // Inject mobile-only chevron close once
    ensureMobileClose($modal);

    // One-time: normalize titles (remove "Jedna " prefix)
=======
    ensureMobileClose($modal);

    // One-time: normalize titles (remove any "Jedna " prefix in imported content)
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    $modal.find('.ibb-card-title').each(function(){
      var $t = $(this);
      var txt = $t.text().trim();
      $t.text(txt.replace(/^Jedna\s+/i, ''));
    });

<<<<<<< HEAD
    // hydrate cart state from DOM (prefilled slots supported)
    hydrateFromDOM($wrap);

    // Initial render & ATC gate
    refreshSlots($wrap);
    enforceATC($wrap);

    // Keep ATC synced with Woo events
=======
    hydrateFromDOM($wrap);

    refreshSlots($wrap);
    enforceATC($wrap);

>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    $(document.body).on('found_variation reset_data show_variation wc_fragment_refresh wc_fragments_refreshed', function(){
      enforceATC($wrap);
    });

    // Guard against Woo toggling native button states
    var $native = $btn($wrap);
    if($native.length){
      var mo=new MutationObserver(function(){ enforceATC($wrap); });
      mo.observe($native[0], { attributes:true, attributeFilter:['disabled','class'] });
    }

    var activeIndex=null;

<<<<<<< HEAD
    // Combined renderer to minimize reflows
=======
    // Sync custom .variation-buttons (if present) with Woo select fields
    $modal.on('click', '.variation-buttons [data-value]', function(){
      var $b = $(this);
      var group = $b.closest('.variation-buttons');
      var attrName = group.data('attribute-name'); // e.g. "Μέγεθος" or a slug
      var nameNorm = canonicalKey('attribute_' + attrName); // normalize to compare
      // Try direct match first; else try normalized slug
      var $select = $modal.find('select[name="attribute_' + attrName + '"]');
      if (!$select.length) {
        // fallback to normalized slug (e.g., transliterated "megethos")
        $select = $modal.find('select').filter(function(){
          return canonicalKey(this.name) === nameNorm;
        }).first();
      }
      if ($select.length) {
        $select.val($b.data('value')).trigger('change');
        group.find('.variation-button').removeClass('active');
        $b.addClass('active');
      }
    });

>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    function renderStepUI(){
      renderSteps($wrap,$modal,slots,activeIndex);
      preselectDefaultSizeS($modal);
      updateNavButtons($modal, activeIndex);
      scrollActiveStepIntoView($modal);
    }

    function gotoStep(idx){
      var $grid = $modal.find('.ibb-grid');
      var nextIndex = Math.max(0,Math.min(slots-1,Number(idx)||0));

<<<<<<< HEAD
      // If modal is not open yet, just render and open
=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      if(!$modal.hasClass('open')){
        activeIndex = nextIndex;
        renderStepUI();
        openModal($modal);
        return;
      }

<<<<<<< HEAD
      // If already open, animate content only (no re-open)
      var duration = 200; // matches your CSS fade
=======
      var duration = 200;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
      activeIndex = nextIndex;

      $grid.addClass('is-fading');
      setTimeout(function(){
        window.requestAnimationFrame(function(){
          renderStepUI();
          requestAnimationFrame(function(){
            $grid.removeClass('is-fading');
          });
        });
      }, duration);
    }

    // open modal on slot click
    $wrap.on('click','.ibb-slot',function(){ gotoStep($(this).data('index')); });
    $modal.on('click','.ibb-step',function(){ gotoStep($(this).data('index')); });
    $modal.on('click','.ibb-prev',function(){ if(activeIndex===null)return; gotoStep(activeIndex-1); });
    $modal.on('click','.ibb-next',function(){ if(activeIndex===null)return; gotoStep(activeIndex+1); });
    $modal.on('click','.ibb-modal__close',function(){ closeModal($modal); });

    // remove from slot
    $wrap.on('click','.ibb-slot-remove',function(e){
      e.stopPropagation();
      var idx=Number($(this).closest('.ibb-slot').data('index'))||0;
      carts[wid][idx]=emptySlot();
      refreshSlots($wrap);
      enforceATC($wrap);
      if(activeIndex !== null){
        updateNavButtons($modal, activeIndex);
        scrollActiveStepIntoView($modal);
      }
    });

    // add to slot
    $modal.on('click','.ibb-add',function(){
      if(activeIndex===null)return;
      var $card=$(this).closest('.ibb-card');
      var pid=Number($card.data('id'));
      var type=String($card.data('type')||'');
      var title=$card.find('.ibb-card-title').text().trim();
      var img=$card.find('img').attr('src')||'';
      var price=$card.find('.ibb-card-price').html()||'';

      function finishSave(obj){
        carts[wid][activeIndex]=obj;
        refreshSlots($wrap);
        enforceATC($wrap);

        var next=-1;
        for(var i=activeIndex+1;i<carts[wid].length;i++){
          if(!carts[wid][i].product_id){ next=i; break; }
        }
        if(next>-1){
          gotoStep(next);
        } else {
          closeModal($modal);
        }
      }

      if(type==='variable'){
        var attrs={}; var ok=true;
<<<<<<< HEAD
        $card.find('.ibb-attr').each(function(){
          var val=$(this).val(); var key=$(this).data('taxonomy');
          if(!val) ok=false; attrs[key]=val;
        });
        if(!ok){ $card.find('.ibb-msg').text('Vyberte variantu.'); return; }

        $.post(IBB.ajax,{action:'ibb_find_variation',nonce:IBB.nonce,product_id:pid,attributes:attrs},function(r){
          if(!r||!r.success||!r.data||!r.data.variation_id){
            $card.find('.ibb-msg').text(r&&r.data&&r.data.message?r.data.message:'Tata varijanta nije dostupna.');
            return;
          }
          finishSave({product_id:pid,variation_id:r.data.variation_id,attr:attrs,title:title,price_html:r.data.price||price,img:img});
        },'json').fail(function(){ $card.find('.ibb-msg').text('Server error.'); });
=======
        // Collect both custom .ibb-attr and Woo's attribute_* selects
        $card.find('.ibb-attr, select[name^="attribute_"], [data-attribute_name]').each(function(){
          var $f = $(this);
          var val = $f.val();
          var key = $f.data('taxonomy') || $f.data('attribute_name') || $f.attr('name');
          if(!val) ok=false;
          if(key) attrs[key] = val; // keep original key so WC AJAX resolves the variation
        });
        if(!ok){ $card.find('.ibb-msg').text('Επιλέξτε παραλλαγή.'); return; }

        $.post(IBB.ajax,{action:'ibb_find_variation',nonce:IBB.nonce,product_id:pid,attributes:attrs},function(r){
          if(!r||!r.success||!r.data||!r.data.variation_id){
            $card.find('.ibb-msg').text(r&&r.data&&r.data.message?r.data.message:'Αυτή η παραλλαγή δεν είναι διαθέσιμη.');
            return;
          }
          finishSave({product_id:pid,variation_id:r.data.variation_id,attr:attrs,title:title,price_html:r.data.price||price,img:img});
        },'json').fail(function(){ $card.find('.ibb-msg').text('Σφάλμα διακομιστή.'); });
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f

      } else {
        finishSave({product_id:pid,variation_id:0,attr:{},title:title,price_html:price,img:img});
      }
    });

  });

  /* ---------- SLOT/CART CONTENT LOGGING + ATC mirror toggle ---------- */
  $(document).on('ibb:slotsFilled ibb:slotsNotFilled', '.ibb-wrapper', function(e, data){
    var wid   = $(this).attr('data-ibb-id');
    var slots = (window.IBB && window.IBB.carts && window.IBB.carts[wid]) || [];

<<<<<<< HEAD
    // Console logging of slot/cart content
=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    console.log('Event:', e.type);
    console.log('Wrapper ID:', wid);
    console.log('Slots:', slots);
    if (data) console.log('Extra data:', data);

<<<<<<< HEAD
    // Also mirror the ATC state change using your exact snippet style
=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    var $btn = $('.single_add_to_cart_button');
    if ($btn.length) {
      if (e.type === 'ibb:slotsFilled') {
        $btn.prop('disabled', false).removeClass('ibb-disabled');
      } else {
        $btn.prop('disabled', true).addClass('ibb-disabled');
      }
    }
  });

});
