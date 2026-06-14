<?php get_header(); ?>
<main id="main">

<!-- HERO -->
<section class="hero" id="home">
  <div class="ske" style="position:absolute;inset:0;border-radius:0;z-index:1"></div>
  <img class="hero-bg-img lazy" src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1400&q=80&auto=format" alt="" fetchpriority="high" aria-hidden="true" onload="this.classList.add('vis');this.previousElementSibling.style.display='none'">
  <div class="hero-overlay"></div>

  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-badge">
        <span class="hero-badge-dot"></span>
        Trusted Since 1987 &middot; ISO 9001:2015 Certified
      </div>
      <h1 class="hero-h1">Move Anywhere.<br><span>Worry-Free.</span></h1>
      <p class="hero-sub">India's most awarded packers &amp; movers. 664+ locations, 75+ branches PAN India, zero damage guarantee.</p>
      <div class="hero-btns">
        <a href="#quote" class="btn-primary">Get Free Quote</a>
        <a href="tel:9073291732" class="btn-ghost">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          Call Now
        </a>
      </div>
    </div>

    <!-- SMART ENQUIRY FORM -->
    <div class="eq" id="quote" role="region" aria-label="Get a free moving quote">
      <div class="eq-prog" aria-hidden="true"><div class="eq-fill"></div></div>
      <div class="eq-top">
        <div>
          <div class="eq-top-title">Get Free Quote</div>
          <div class="eq-top-sub">Response in 30 mins &middot; No hidden charges</div>
        </div>
        <div class="eq-step-tag" aria-live="polite">Select a service</div>
      </div>
      <!-- Service selector — built by JS -->
      <div class="eq-svcs" role="tablist" aria-label="Select moving service"></div>
      <!-- Fields — built by JS -->
      <div class="eq-fields" aria-live="polite">
        <p style="padding:20px 0 14px;text-align:center;font-size:.8rem;color:var(--ink-30);">Choose a service above to see the form.</p>
      </div>
      <!-- Message -->
      <div class="eq-msg" role="alert" aria-live="polite" style="display:none"></div>
      <!-- Submit -->
      <div class="eq-foot">
        <button type="button" class="eq-submit" disabled>
          <span class="eq-btn-txt">Select a Service</span>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
        <p class="eq-note">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
          100% private &middot; No spam &middot; No obligation
        </p>
      </div>
    </div>
  </div>

  <div class="hero-cue" aria-hidden="true">
    <span>Scroll</span>
    <svg width="16" height="24" viewBox="0 0 16 24"><rect x="1" y="1" width="14" height="22" rx="7" stroke="rgba(255,255,255,.3)" stroke-width="1.5" fill="none"/><circle cx="8" cy="7" r="2" fill="rgba(255,255,255,.45)" class="sc"/></svg>
  </div>
</section>

<!-- TICKER -->
<div class="ticker" aria-hidden="true">
  <div class="ticker-t">
    <?php
    $items = array('38+ Years of Trust','664+ Service Locations','75+ Branches PAN India','65,000+ Annual Moves','88 Countries Served','1,500+ GPS Trucks','ISO 9001:2015 Certified','IBA Approved Bilty','Zero Damage Guarantee','Free Pre-Move Survey');
    $all = array_merge($items, $items, $items);
    foreach ($all as $item) {
      echo '<div class="ticker-i"><svg width="5" height="5" viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" fill="#DB2648"/></svg>' . esc_html($item) . '</div>';
    }
    ?>
  </div>
</div>

<!-- SERVICES -->
<section class="sec" id="services">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Our Services</div>
      <h2 class="h2">Everything Your Move Needs</h2>
      <p class="lead">From a single room to a full corporate fleet — handled with precision and care.</p>
    </div>
    <div class="svc-grid">
      <?php
      $svcs = array(
        array('Household Moving',    'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10', 'household-moving',   'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=480&q=75&auto=format'),
        array('Office Shifting',     'M2 20h20M6 20V4h12v16M10 9h4M10 13h4',                        'office-moving',      'https://images.unsplash.com/photo-1497366216548-37526070297c?w=480&q=75&auto=format'),
        array('International Moving','M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20',               'international-moving','https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=480&q=75&auto=format'),
        array('Car Transport',       'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z','car-transport','https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=480&q=75&auto=format'),
        array('Bike Transport',      'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11 M12 17h9',             'bike-transport',     'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=480&q=75&auto=format'),
        array('Secure Storage',      'M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 01-.68 0C7.5 20.5 4 18 4 13V6l8-3 8 3v7z','secure-storage','https://images.unsplash.com/photo-1553413077-190dd305871c?w=480&q=75&auto=format'),
        array('Fine Arts Moving',    'M2 20h20M4 20V8l8-6 8 6v12',                                  'fine-arts',          'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?w=480&q=75&auto=format'),
        array('Commercial Moving',   'M3 9l9-7 9 7v11H3V9z',                                        'commercial-moving',  'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=480&q=75&auto=format'),
        array('Courier Services',    'M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z','courier','https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=480&q=75&auto=format'),
        array('Truck Rental',        'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z',                          'truck-rental',       'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=480&q=75&auto=format'),
        array('Last Mile Delivery',  'M5 12h14M12 5l7 7-7 7',                                       'last-mile',          'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?w=480&q=75&auto=format'),
        array('ODC Consignment',     'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4','odc',          'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=480&q=75&auto=format'),
      );
      foreach ($svcs as $svc) {
        $name = $svc[0]; $path = $svc[1]; $slug = $svc[2]; $img = $svc[3];
      ?>
      <a href="<?php echo esc_url(home_url('/services/' . $slug . '/')); ?>" class="svc-card reveal">
        <div class="svc-img-wrap">
          <div class="ske"></div>
          <img class="svc-img lazy" src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?> in India" loading="lazy" onload="this.classList.add('vis');this.previousElementSibling.style.display='none'">
          <div class="svc-shine"></div>
        </div>
        <div class="svc-body">
          <div class="svc-ico">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($path); ?>"/></svg>
          </div>
          <div class="svc-info">
            <span class="svc-name"><?php echo esc_html($name); ?></span>
            <span class="svc-arr" aria-hidden="true">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </span>
          </div>
        </div>
      </a>
      <?php } ?>
    </div>
  </div>
</section>

<!-- WHY US -->
<section class="sec sec-alt" id="why">
  <div class="wrap">
    <div class="why-grid">
      <div class="why-imgs">
        <div class="why-main-img reveal">
          <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=640&q=80&auto=format" alt="Sure Shift packers carefully wrapping household items" loading="lazy" class="lazy" onload="this.classList.add('vis')">
          <div class="why-badge"><strong>38+</strong><span>Years of<br>Excellence</span></div>
        </div>
        <div class="why-sm-img reveal" style="transition-delay:.12s">
          <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=360&q=75&auto=format" alt="Sure Shift GPS tracked moving truck on Indian highway" loading="lazy" class="lazy" onload="this.classList.add('vis')">
        </div>
      </div>
      <div class="why-content reveal" style="transition-delay:.1s">
        <div class="eyebrow">Why Sure Shift</div>
        <h2 class="h2">India's Most Trusted<br>Moving Partner</h2>
        <p class="lead">Moving families and businesses since 1987. ISO certified, IBA approved, with a dedicated move manager for every client.</p>
        <div class="why-feats">
          <?php
          $feats = array(
            array('Zero Damage Guarantee',   'We pack, protect and deliver with a zero-damage guarantee.', 'M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 01-.68 0C7.5 20.5 4 18 4 13V6l8-3 8 3v7z M9 12l2 2 4-4'),
            array('Dedicated Move Manager',  'One point of contact from booking to final delivery.',       'M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2 M12 11a4 4 0 100-8 4 4 0 000 8z'),
            array('GPS Live Tracking',       'Track your belongings on a live map 24x7.',                  'M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z M12 10a1 1 0 11-2 0 1 1 0 012 0z'),
            array('Free Pre-Move Survey',    'Expert home assessment at zero cost before your move.',      'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2 M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'),
            array('IBA Approved Bilty',      'Legally certified bilty for all interstate consignments.',   'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'),
            array('1,500+ GPS Fleet',        'Containerised trucks with real-time location tracking.',     'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 M18.5 21a2.5 2.5 0 100-5'),
          );
          foreach ($feats as $f) {
          ?>
          <div class="why-feat">
            <div class="why-feat-ico">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($f[2]); ?>"/></svg>
            </div>
            <div>
              <strong><?php echo esc_html($f[0]); ?></strong>
              <p><?php echo esc_html($f[1]); ?></p>
            </div>
          </div>
          <?php } ?>
        </div>
        <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="btn-soft" style="margin-top:24px;display:inline-flex;align-items:center;gap:7px;">
          Learn More About Us
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats-band" aria-label="Key statistics">
  <div class="wrap">
    <div class="stats-grid">
      <?php
      $stats = array(
        array('38+',   'Years of Experience',   'M12 2a10 10 0 100 20A10 10 0 0012 2z M12 6v6l4 2'),
        array('664+',  'Service Locations',     'M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z M12 10a1 1 0 11-2 0 1 1 0 012 0z'),
        array('88',    'Countries Covered',     'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20'),
        array('65K+',  'Moves Every Year',      'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'),
        array('75+',   'Branches PAN India',    'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'),
        array('1500+', 'Containerised Trucks',  'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z'),
      );
      foreach ($stats as $s) {
      ?>
      <div class="stat-cell reveal">
        <div class="stat-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($s[2]); ?>"/></svg>
        </div>
        <div class="stat-n"><?php echo esc_html($s[0]); ?></div>
        <div class="stat-l"><?php echo esc_html($s[1]); ?></div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>

<!-- TRACKING -->
<section class="sec" id="tracking">
  <div class="wrap">
    <div class="track-grid">
      <div class="reveal">
        <div class="eyebrow">Live Tracking</div>
        <h2 class="h2">Know Where Your<br>Belongings Are</h2>
        <p class="lead">Enter your consignment number for instant live status updates — available 24x7.</p>
        <div class="track-steps">
          <?php
          $steps = array('Enter your consignment number','View live location &amp; status','Receive delivery confirmation');
          foreach ($steps as $i => $step) {
          ?>
          <div class="track-step">
            <div class="track-num" aria-hidden="true"><?php echo $i + 1; ?></div>
            <span><?php echo $step; ?></span>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="reveal" style="transition-delay:.1s">
        <div class="track-card">
          <div class="track-ico-wrap">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#DB2648" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          </div>
          <h3>Track Your Consignment</h3>
          <p>Real-time shipment status</p>
          <div class="track-row">
            <input type="text" id="trackInput" placeholder="Enter consignment no. e.g. SS2024XXXXX" aria-label="Consignment number">
            <button id="trackBtn" class="btn-primary">Track</button>
          </div>
          <div id="trackResult" style="display:none;" role="status" aria-live="polite"></div>
          <p class="track-note">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
            Your consignment number is in your booking SMS / email
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- REVIEWS -->
<section class="sec sec-alt" id="reviews">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Customer Reviews</div>
      <h2 class="h2">Trusted by Thousands</h2>
    </div>
    <div class="rev-grid">
      <?php
      $reviews = array(
        array('Abhishek Gupta', 'IT Company, Bengaluru',     'AG', 'The team exceeded all expectations. Professional, punctual, and zero damage to our office furniture. Highly recommend Sure Shift!'),
        array('Priya Sharma',   'Homemaker, Delhi to Mumbai', 'PS', 'Shifted our entire 3 BHK seamlessly. The move manager was reachable 24/7. Made a stressful process completely smooth.'),
        array('Amit Kumar',     'Restaurant Owner, Pune',     'AK', 'Handled our restaurant equipment with exceptional care. On-time, transparent pricing — exactly what a business needs.'),
        array('Kapil Kumar',    'Manufacturing Director',     'KK', 'International move from Delhi to Dubai handled perfectly. Every item arrived in pristine condition. World-class service.'),
        array('Neha Agarwal',   'Home Relocation, Gurgaon',   'NA', 'The free pre-move survey saved us time and money. GPS tracking gave us complete peace of mind throughout the move.'),
        array('Rohit Mehta',    'Corporate Client, Chennai',  'RM', 'Sure Shift moved our 150-person office in a single weekend with zero downtime. Absolutely remarkable execution.'),
      );
      foreach ($reviews as $rev) {
      ?>
      <div class="rev-card reveal">
        <div class="rev-top">
          <div class="rev-stars" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <svg class="rev-quote-ico" width="24" height="18" viewBox="0 0 32 24" fill="none" aria-hidden="true"><path d="M0 24V14.4C0 6.4 4.8 1.6 14.4 0l1.6 2.4C10.4 3.6 7.6 6.4 7.2 10.4H13.6V24H0zm18.4 0V14.4C18.4 6.4 23.2 1.6 32.8 0l1.6 2.4c-5.6 1.2-8.4 4-8.8 8H32V24H18.4z" fill="#DB2648"/></svg>
        </div>
        <p class="rev-text"><?php echo esc_html($rev[3]); ?></p>
        <div class="rev-author">
          <div class="rev-av" aria-hidden="true"><?php echo esc_html($rev[2]); ?></div>
          <div>
            <strong><?php echo esc_html($rev[0]); ?></strong>
            <span><?php echo esc_html($rev[1]); ?></span>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-sec">
  <div class="wrap">
    <div class="cta-card">
      <div class="cta-img-col">
        <div class="ske" style="position:absolute;inset:0;border-radius:0;z-index:1"></div>
        <img src="https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?w=700&q=75&auto=format" alt="Sure Shift professional moving team at work" loading="lazy" class="lazy" onload="this.classList.add('vis');this.previousElementSibling.style.display='none'" style="width:100%;height:100%;object-fit:cover;display:block;position:relative;z-index:2;opacity:0;transition:opacity .5s ease">
      </div>
      <div class="cta-txt-col">
        <h2>Ready to Move?<br>Let's Make It Easy.</h2>
        <p>Get a no-obligation quote in under 30 minutes. Available 24x7, 365 days a year.</p>
        <div class="cta-btns">
          <a href="#quote" class="btn-primary">Get Free Quote</a>
          <a href="tel:9073291732" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            90 732 91 732
          </a>
        </div>
        <div class="cta-certs">
          <div class="cta-cert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DB2648" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
            <span>ISO 9001:2015</span>
          </div>
          <div class="cta-cert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DB2648" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
            <span>ISO 39001:2012</span>
          </div>
          <div class="cta-cert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DB2648" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            <span>IBA Approved</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main>
<?php get_footer(); ?>
