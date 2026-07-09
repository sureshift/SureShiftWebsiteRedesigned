<?php
/**
 * Virtual template — renders for every /packers-and-movers-in-{city}/ URL.
 * Do NOT rename to page-*.php or template-parts; functions.php loads this
 * file directly via locate_template('template-location.php') for any
 * request matching the ss_city query var.
 *
 * One file → unlimited city pages. Add new cities in functions.php
 * (ss_get_all_cities); unlisted slugs still render via the fallback there.
 */

$ss_city_slug     = get_query_var('ss_city');
$ss_locality_slug = get_query_var('ss_locality');
$city             = ss_get_city_data($ss_city_slug);
$city_name        = $city['name'];
$city_url         = home_url('/packers-and-movers-in-' . $city['slug'] . '/');

/* Locality (area) context — set only on /packers-and-movers-in-{city}/{locality}/ */
$is_locality  = !empty($ss_locality_slug);
$locality_slug = $is_locality ? sanitize_title($ss_locality_slug) : '';
$locality_name = $is_locality ? ss_get_locality_name($city, $locality_slug) : '';

// The name/URL actually shown to the user & search engines for this exact page.
$place_name = $is_locality ? ($locality_name . ', ' . $city_name) : $city_name;
$page_url   = $is_locality ? ($city_url . $locality_slug . '/') : $city_url;

// Other localities of the same city, for cross-linking (excludes the current one on a locality page).
$sibling_localities = array();
if (!empty($city['localities'])) {
    foreach ($city['localities'] as $loc) {
        if (!$is_locality || sanitize_title($loc) !== $locality_slug) {
            $sibling_localities[] = $loc;
        }
    }
}

/* ── SEO meta + schema — registered BEFORE get_header() so it fires with wp_head() ── */
add_action('wp_head', function () use ($city, $city_name, $place_name, $page_url, $is_locality, $city_url) {
    $desc = 'Professional packers and movers in ' . $place_name . '. ISO 9001:2015 certified, GPS-tracked fleet, free pre-move survey, zero-damage guarantee. Get a free quote in 30 minutes.';
    $city_url_var = $city_url; // kept for BreadcrumbList below
    ?>
<meta name="description" content="<?php echo esc_attr($desc); ?>">
<meta name="keywords" content="packers and movers in <?php echo esc_attr($place_name); ?>, movers and packers <?php echo esc_attr($place_name); ?>, house shifting <?php echo esc_attr($place_name); ?>, relocation services <?php echo esc_attr($place_name); ?>">
<link rel="canonical" href="<?php echo esc_url($page_url); ?>">
<meta property="og:title" content="Packers &amp; Movers in <?php echo esc_attr($place_name); ?> | Sure Shift">
<meta property="og:description" content="<?php echo esc_attr($desc); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($page_url); ?>">
<meta name="twitter:card" content="summary_large_image">
<script type="application/ld+json">
<?php
$breadcrumb_items = array(
    array('@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>home_url('/')),
    array('@type'=>'ListItem','position'=>2,'name'=>'Our Locations','item'=>home_url('/locations/')),
    array('@type'=>'ListItem','position'=>3,'name'=>'Packers & Movers in ' . $city_name,'item'=>$city_url_var),
);
if ($is_locality) {
    $breadcrumb_items[] = array('@type'=>'ListItem','position'=>4,'name'=>$place_name,'item'=>$page_url);
}
$schema = array(
    '@context' => 'https://schema.org',
    '@graph'   => array(
        array(
            '@type'       => 'MovingCompany',
            '@id'         => $page_url . '#business',
            'name'        => 'Sure Shift Relocation Services — ' . $place_name,
            'image'       => 'https://sureshift.in/wp-content/uploads/2025/02/logo.a27ef0b398a2f4fa34b8.png',
            'url'         => $page_url,
            'telephone'   => '+919073291732',
            'email'       => 'info@sureshift.in',
            'priceRange'  => '₹₹',
            'areaServed'  => array('@type' => 'Place', 'name' => $place_name),
            'address'     => array(
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'P Block, Plot No. 131, Gopal Nagar Extension, Najafgarh',
                'addressLocality' => 'New Delhi',
                'addressRegion'   => 'Delhi',
                'postalCode'      => '110043',
                'addressCountry'  => 'IN',
            ),
            'openingHours' => 'Mo-Su 00:00-23:59',
            'parentOrganization' => array('@id' => 'https://www.sureshift.in/#organization'),
        ),
        array(
            '@type'         => 'BreadcrumbList',
            'itemListElement' => $breadcrumb_items,
        ),
        array(
            '@type' => 'FAQPage',
            'mainEntity' => array(
                array('@type'=>'Question','name'=>'Do you provide packers and movers services in ' . $place_name . '?',
                    'acceptedAnswer'=>array('@type'=>'Answer','text'=>'Yes. Sure Shift provides household, office, and vehicle relocation services in ' . $place_name . ', with a dedicated move manager, GPS-tracked fleet, and free pre-move survey.')),
                array('@type'=>'Question','name'=>'What is the cost of packers and movers in ' . $place_name . '?',
                    'acceptedAnswer'=>array('@type'=>'Answer','text'=>'Cost depends on the distance, volume of goods, and packing requirements. Share your details via the free quote form or call us for an exact, no-obligation estimate.')),
                array('@type'=>'Question','name'=>'Is a free survey available before the move in ' . $place_name . '?',
                    'acceptedAnswer'=>array('@type'=>'Answer','text'=>'Yes. Sure Shift offers a free, no-obligation pre-move survey in ' . $place_name . ' to give you an accurate quote before booking.')),
                array('@type'=>'Question','name'=>'Can I track my shipment from ' . $place_name . '?',
                    'acceptedAnswer'=>array('@type'=>'Answer','text'=>'Yes. Every consignment from ' . $place_name . ' is moved in GPS-enabled trucks with live tracking available 24x7.')),
            ),
        ),
    ),
);
echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>
    <?php
}, 5);

get_header();
?>

<main id="main">

<!-- ── BREADCRUMB ── -->
<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <a href="<?php echo esc_url(home_url('/locations/')); ?>" style="color:var(--ink-60)">Our Locations</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <?php if ($is_locality): ?>
      <a href="<?php echo esc_url($city_url); ?>" style="color:var(--ink-60)">Packers &amp; Movers in <?php echo esc_html($city_name); ?></a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page"><?php echo esc_html($locality_name); ?></span>
      <?php else: ?>
      <span style="color:var(--ink-30)" aria-current="page">Packers &amp; Movers in <?php echo esc_html($city_name); ?></span>
      <?php endif; ?>
    </nav>
  </div>
</div>

<!-- ── HERO ── -->
<section style="position:relative;background:var(--ink);overflow:hidden;padding:72px 0 64px">
  <div style="position:absolute;inset:0;background:url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=75&auto=format') center/cover no-repeat;opacity:.16;z-index:0"></div>
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(219,38,72,.16) 0%,transparent 60%);z-index:1"></div>
  <div class="wrap" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 1fr;gap:40px;align-items:start">
    <div>
      <div class="eyebrow" style="color:rgba(219,38,72,.9)">
        <?php if ($is_locality): ?>
          Area in <?php echo esc_html($city_name); ?>
        <?php else: ?>
          <?php echo esc_html($city['tag']); ?><?php echo $city['state'] ? ', ' . esc_html($city['state']) : ''; ?>
        <?php endif; ?>
      </div>
      <h1 style="font-family:var(--fh);font-size:clamp(1.9rem,4.4vw,3rem);font-weight:800;color:#fff;line-height:1.15;letter-spacing:-.03em;margin-bottom:18px">
        Packers &amp; Movers in<br><span style="color:var(--red)"><?php echo esc_html($place_name); ?></span>
      </h1>
      <p style="font-size:1rem;color:rgba(255,255,255,.62);line-height:1.8;max-width:520px;margin-bottom:28px">
        ISO 9001:2015 certified household, office, and vehicle relocation in <?php echo esc_html($place_name); ?> — GPS-tracked trucks, a dedicated move manager, and a zero-damage guarantee on every move.
      </p>
      <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:28px">
        <a href="#quote" class="btn-primary">Get Free Quote</a>
        <a href="tel:+919073291732" class="btn-ghost">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          Call Now
        </a>
      </div>
      <div style="display:flex;gap:18px;flex-wrap:wrap">
        <?php foreach (array('ISO 9001:2015','IBA Approved Bilty','Zero Damage Guarantee') as $badge): ?>
        <div style="display:flex;align-items:center;gap:6px;font-size:.78rem;color:rgba(255,255,255,.55)">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DB2648" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo esc_html($badge); ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Reuses the site-wide smart enquiry widget — same JS/AJAX as homepage -->
    <div class="eq" id="quote" role="region" aria-label="Get a free moving quote">
      <div class="eq-prog" aria-hidden="true"><div class="eq-fill"></div></div>
      <div class="eq-top">
        <div>
          <div class="eq-top-title">Get Free Quote — <?php echo esc_html($place_name); ?></div>
          <div class="eq-top-sub">Response in 30 mins &middot; No hidden charges</div>
        </div>
        <div class="eq-step-tag" aria-live="polite">Select a service</div>
      </div>
      <div class="eq-svcs" role="tablist" aria-label="Select moving service"></div>
      <div class="eq-fields" aria-live="polite">
        <p style="padding:20px 0 14px;text-align:center;font-size:.8rem;color:var(--ink-30);">Choose a service above to see the form.</p>
      </div>
      <div class="eq-msg" role="alert" aria-live="polite" style="display:none"></div>
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
</section>

<!-- ── QUICK ANSWER (AEO) ── -->
<section style="background:var(--white);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:36px;padding-bottom:36px">
    <div style="background:var(--surf);border-radius:var(--r14);padding:26px 30px;border-left:4px solid var(--red);max-width:900px">
      <p style="font-family:var(--fh);font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--red);margin-bottom:8px">Quick Answer</p>
      <p style="font-size:.95rem;color:var(--ink);line-height:1.8">
        <strong>Sure Shift</strong> is an ISO 9001:2015 &amp; ISO 39001:2012 certified packers and movers company serving <strong><?php echo esc_html($place_name); ?></strong> with household, office, international, and vehicle relocation. Every move includes a <strong>free pre-move survey</strong>, <strong>GPS-tracked transport</strong>, and a <strong>zero-damage guarantee</strong>, backed by a dedicated move manager from booking to final delivery.
      </p>
    </div>
  </div>
</section>

<!-- ── SERVICES IN CITY ── -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Our Services</div>
      <h2 class="h2">Relocation Services in <?php echo esc_html($city_name); ?></h2>
      <p class="lead">Every service below is available with the same GPS tracking, insurance, and zero-damage guarantee across <?php echo esc_html($city_name); ?>.</p>
    </div>
    <div class="svc-grid">
      <?php
      $svcs = array(
        array('Household Moving', 'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10 M12 7v.01', 'household-moving'),
        array('Office Shifting',  'M2 20h20M6 20V4h12v16M10 9h4M10 13h4M10 17h4', 'office-moving'),
        array('International Moving', 'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20 M12 2a15.3 15.3 0 000 20M12 2a15.3 15.3 0 010 20', 'international-moving'),
        array('Car Transport', 'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2 M9 21a2 2 0 100-4 2 2 0 000 4z M15 21a2 2 0 100-4 2 2 0 000 4z', 'car-transport'),
        array('Bike Transport', 'M12 12m-3 0a3 3 0 106 0 3 3 0 10-6 0 M6 12m-3 0a3 3 0 106 0 3 3 0 10-6 0 M6 12h-2 M9 9.5L12 3l1.5 3h3l-1.5 2.5 M15 9l3 3', 'bike-transport'),
        array('Secure Storage', 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4 M12 12v4', 'secure-storage'),
        array('Commercial Moving', 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z', 'commercial-moving'),
        array('Truck Rental', 'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z', 'truck-rental'),
      );
      foreach ($svcs as $svc):
        list($name, $path, $slug) = $svc;
      ?>
      <a href="<?php echo esc_url(home_url('/services/' . $slug . '/')); ?>" class="svc-card">
        <div class="svc-body" style="padding:20px">
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
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── AREAS COVERED ── -->
<section class="sec sec-alt">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Coverage Area</div>
      <h2 class="h2"><?php echo $is_locality ? 'Other Areas We Cover Near ' . esc_html($locality_name) : 'Areas We Cover in ' . esc_html($city_name); ?></h2>
      <?php if ($is_locality): ?>
      <p class="lead">All within <?php echo esc_html($city_name); ?> — same GPS-tracked fleet, same zero-damage guarantee.</p>
      <?php endif; ?>
    </div>
    <?php if (!empty($sibling_localities)): ?>
    <div style="display:flex;flex-wrap:wrap;gap:10px">
      <?php foreach ($sibling_localities as $loc):
        $loc_slug = sanitize_title($loc);
        $loc_url  = $city_url . $loc_slug . '/';
      ?>
      <a href="<?php echo esc_url($loc_url); ?>" style="background:#fff;border:1px solid var(--line);border-radius:var(--r99);padding:9px 18px;font-size:.82rem;color:var(--ink-60);font-family:var(--fh);font-weight:500;transition:all var(--t) var(--ease)" onmouseover="this.style.borderColor='var(--red)';this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--line)';this.style.color='var(--ink-60)'"><?php echo esc_html($loc); ?></a>
      <?php endforeach; ?>
      <a href="<?php echo esc_url(home_url('/locations/')); ?>" style="background:var(--red-06);border:1px solid rgba(219,38,72,.2);border-radius:var(--r99);padding:9px 18px;font-size:.82rem;color:var(--red);font-family:var(--fh);font-weight:600">+ all surrounding areas</a>
    </div>
    <?php else: ?>
    <p style="color:var(--ink-60);font-size:.95rem;line-height:1.8;max-width:640px">We cover all localities and surrounding areas of <?php echo esc_html($city_name); ?>. Not sure if we serve your exact address? Call us or request a free quote and we'll confirm right away.</p>
    <?php endif; ?>
  </div>
</section>

<!-- ── WHY US / PROCESS ── -->
<section class="sec">
  <div class="wrap">
    <div class="why-grid">
      <div>
        <div class="eyebrow">How It Works</div>
        <h2 class="h2">Moving in <?php echo esc_html($city_name); ?>,<br>Simplified</h2>
        <div class="track-steps">
          <?php
          $steps = array(
            'Free pre-move survey & instant quote',
            'Professional packing with quality materials',
            'GPS-tracked, containerised transport',
            'Safe delivery & unpacking at destination',
          );
          foreach ($steps as $i => $step): ?>
          <div class="track-step">
            <div class="track-num" aria-hidden="true"><?php echo $i + 1; ?></div>
            <span><?php echo esc_html($step); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <div class="eyebrow">Why Sure Shift</div>
        <h2 class="h2">Built for a<br>Worry-Free Move</h2>
        <div class="why-feats">
          <?php
          $feats = array(
            array('Zero Damage Guarantee', 'We pack, protect and deliver with a zero-damage guarantee.', 'M9 12l2 2 4-4m-6.364 1.364A9 9 0 1121 12a9 9 0 01-12.728 5.364z'),
            array('Dedicated Move Manager', 'One point of contact from booking to final delivery.', 'M16 11c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4z M3 20c0-3.314 4.03-6 9-6s9 2.686 9 6'),
            array('GPS Live Tracking', 'Track your belongings on a live map 24x7.', 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'),
            array('IBA Approved Bilty', 'Legally certified bilty for all interstate consignments.', 'M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z M14 2v6h6 M9 13h6 M9 17h6'),
          );
          foreach ($feats as $f): ?>
          <div class="why-feat">
            <div class="why-feat-ico">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($f[2]); ?>"/></svg>
            </div>
            <div>
              <strong><?php echo esc_html($f[0]); ?></strong>
              <p><?php echo esc_html($f[1]); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── TRUST STATS ── -->
<section class="stats-band" aria-label="Key statistics">
  <div class="wrap">
    <div class="stats-grid">
      <?php
      $stats = array(
        array('38+',  'Years of Experience', 'M12 2a10 10 0 100 20A10 10 0 0012 2z M12 6v6l4 2'),
        array('664+', 'Service Locations', 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'),
        array('65K+', 'Moves Every Year', 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'),
        array('1500+', 'Containerised Trucks', 'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'),
      );
      foreach ($stats as $s): ?>
      <div class="stat-cell">
        <div class="stat-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($s[2]); ?>"/></svg>
        </div>
        <div class="stat-n"><?php echo esc_html($s[0]); ?></div>
        <div class="stat-l"><?php echo esc_html($s[1]); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── REVIEWS ── -->
<section class="sec sec-alt">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Customer Reviews</div>
      <h2 class="h2">Trusted in <?php echo esc_html($city_name); ?> &amp; Beyond</h2>
    </div>
    <div class="rev-grid">
      <?php
      $reviews = array(
        array('Abhishek Gupta', 'IT Company, Bengaluru', 'AG', 'The team exceeded all expectations. Professional, punctual, and zero damage to our office furniture. Highly recommend Sure Shift!'),
        array('Priya Sharma', 'Homemaker, Delhi to Mumbai', 'PS', 'Shifted our entire 3 BHK seamlessly. The move manager was reachable 24/7. Made a stressful process completely smooth.'),
        array('Amit Kumar', 'Restaurant Owner, Pune', 'AK', 'Handled our restaurant equipment with exceptional care. On-time, transparent pricing — exactly what a business needs.'),
      );
      // Prefer a review that mentions this city, otherwise show the defaults above.
      $matched = array();
      foreach ($reviews as $rev) {
          if (stripos($rev[1], $city_name) !== false) { array_unshift($matched, $rev); } else { $matched[] = $rev; }
      }
      foreach ($matched as $rev): ?>
      <div class="rev-card">
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
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="sec">
  <div class="wrap">
    <div style="max-width:780px;margin:0 auto">
      <div class="sec-head" style="text-align:center">
        <div class="eyebrow" style="justify-content:center">FAQ</div>
        <h2 class="h2">Packers &amp; Movers in <?php echo esc_html($place_name); ?><br>— Frequently Asked</h2>
      </div>
      <?php
      $faqs = array(
        array('Do you provide packers and movers services in ' . $place_name . '?',
          'Yes. Sure Shift provides household, office, and vehicle relocation services in ' . $place_name . ', with a dedicated move manager, GPS-tracked fleet, and free pre-move survey.'),
        array('What is the cost of packers and movers in ' . $place_name . '?',
          'Cost depends on the distance, volume of goods, and packing requirements. Share your details via the free quote form above or call us for an exact, no-obligation estimate.'),
        array('Is a free survey available before the move in ' . $place_name . '?',
          'Yes. Sure Shift offers a free, no-obligation pre-move survey in ' . $place_name . ' to give you an accurate quote before booking.'),
        array('Can I track my shipment from ' . $place_name . '?',
          'Yes. Every consignment from ' . $place_name . ' moves in a GPS-enabled truck with live tracking available 24x7.'),
        array('Do you offer international relocation from ' . $place_name . '?',
          'Yes. Sure Shift coordinates international moves from ' . $place_name . ' to 88+ countries via destination-agent partnerships.'),
      );
      foreach ($faqs as $i => $faq): ?>
      <details style="border:1px solid var(--line);border-radius:var(--r10);overflow:hidden;margin-bottom:10px" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary itemprop="name" style="font-family:var(--fh);font-size:.9rem;font-weight:600;color:var(--ink);padding:16px 18px;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:12px;background:#fff;user-select:none">
          <?php echo esc_html($faq[0]); ?>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true" style="flex-shrink:0"><path d="M6 9l6 6 6-6"/></svg>
        </summary>
        <div itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
          <p itemprop="text" style="padding:0 18px 16px;font-size:.87rem;color:var(--ink-60);line-height:1.8;background:#fff;border-top:1px solid var(--line);margin:0"><?php echo esc_html($faq[1]); ?></p>
        </div>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section style="background:var(--ink);padding:64px 0">
  <div class="wrap" style="text-align:center;max-width:600px;margin:0 auto">
    <div class="eyebrow" style="justify-content:center;color:rgba(219,38,72,.9)">Ready to Move?</div>
    <h2 style="font-family:var(--fh);font-size:clamp(1.6rem,3.2vw,2.4rem);font-weight:700;color:#fff;line-height:1.2;letter-spacing:-.02em;margin-bottom:14px">
      Book Your Move in <?php echo esc_html($place_name); ?> Today
    </h2>
    <p style="font-size:.95rem;color:rgba(255,255,255,.5);line-height:1.75;margin-bottom:28px">
      Free, no-obligation quote in under 30 minutes. Available 24x7, 365 days a year.
    </p>
    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
      <a href="#quote" class="btn-primary">Get Free Quote</a>
      <a href="tel:+919073291732" class="btn-ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        09073291732
      </a>
    </div>
  </div>
</section>

</main>

<style>
details[open] summary svg{transform:rotate(180deg)}
details summary::-webkit-details-marker{display:none}
@media(max-width:900px){
  section .wrap > div[style*="grid-template-columns:1.15fr 1fr"]{grid-template-columns:1fr!important;gap:32px!important}
  .why-grid{grid-template-columns:1fr!important;gap:36px!important}
}
</style>

<?php get_footer(); ?>
