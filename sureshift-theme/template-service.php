<?php
/**
 * Virtual template — renders /services/{slug}/ for all 12 services.
 * Do NOT rename; functions.php loads this file directly via
 * locate_template('template-service.php').
 */

$ss_svc_slug = get_query_var('ss_service');
$ss_services = ss_get_all_services();
$ss_svc      = isset($ss_services[$ss_svc_slug]) ? $ss_services[$ss_svc_slug] : null;

if (!$ss_svc) {
    status_header(404);
    get_header();
    echo '<main class="sec"><div class="wrap"><p>Service not found.</p></div></main>';
    get_footer();
    exit;
}

$ss_svc_url = home_url('/services/' . $ss_svc_slug . '/');

add_action('wp_head', function () use ($ss_svc, $ss_svc_url, $ss_svc_slug) {
    $desc = wp_strip_all_tags($ss_svc['intro']);
    ?>
<meta name="description" content="<?php echo esc_attr(wp_trim_words($desc, 30)); ?>">
<link rel="canonical" href="<?php echo esc_url($ss_svc_url); ?>">
<meta property="og:title" content="<?php echo esc_attr($ss_svc['name']); ?> | Sure Shift">
<meta property="og:description" content="<?php echo esc_attr(wp_trim_words($desc, 30)); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_svc_url); ?>">
<script type="application/ld+json">
<?php
$faq_items = array();
foreach ($ss_svc['faqs'] as $f) {
    $faq_items[] = array('@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array('@type' => 'Answer', 'text' => $f['a']));
}
$schema = array(
    '@context' => 'https://schema.org',
    '@graph' => array(
        array(
            '@type' => 'Service',
            '@id' => $ss_svc_url . '#service',
            'name' => $ss_svc['name'] . ' — Sure Shift Relocation Services',
            'serviceType' => $ss_svc['name'],
            'provider' => array('@id' => 'https://www.sureshift.in/#organization'),
            'areaServed' => 'India',
            'url' => $ss_svc_url,
            'description' => wp_trim_words($desc, 30),
        ),
        array(
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
                array('@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url('/sitemap/')),
                array('@type' => 'ListItem', 'position' => 3, 'name' => $ss_svc['name'], 'item' => $ss_svc_url),
            ),
        ),
        array('@type' => 'FAQPage', 'mainEntity' => $faq_items),
    ),
);
echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>
    <?php
}, 5);

get_header();

$ss_other_services = array();
foreach ($ss_services as $slug => $svc) {
    if ($slug !== $ss_svc_slug) { $ss_other_services[$slug] = $svc; }
}
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page"><?php echo esc_html($ss_svc['name']); ?></span>
    </nav>
  </div>
</div>

<!-- ── HERO ── -->
<section style="position:relative;background:var(--ink);overflow:hidden;padding:72px 0 64px">
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(219,38,72,.16) 0%,transparent 60%);z-index:1"></div>
  <div class="wrap svc-hero-grid" style="position:relative;z-index:2;align-items:start">
    <div>
      <div class="eyebrow" style="color:rgba(219,38,72,.9)"><?php echo wp_kses_post($ss_svc['tag']); ?></div>
      <h1 style="font-family:var(--fh);font-size:clamp(1.9rem,4.4vw,3rem);font-weight:800;color:#fff;line-height:1.15;letter-spacing:-.03em;margin-bottom:18px"><?php echo esc_html($ss_svc['name']); ?></h1>
      <p style="font-size:1rem;color:rgba(255,255,255,.62);line-height:1.8;max-width:520px;margin-bottom:28px"><?php echo wp_kses_post($ss_svc['intro']); ?></p>
      <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="#quote" class="btn-primary">Get Free Quote</a>
        <a href="tel:+919073291732" class="btn-ghost">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          Call Now
        </a>
      </div>
    </div>

    <div class="eq" id="quote" role="region" aria-label="Get a free moving quote">
      <div class="eq-prog" aria-hidden="true"><div class="eq-fill"></div></div>
      <div class="eq-top">
        <div>
          <div class="eq-top-title">Get Free Quote — <?php echo esc_html($ss_svc['name']); ?></div>
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
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
        <p class="eq-note">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
          100% private &middot; No spam &middot; No obligation
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ── FEATURES ── -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">What's Included</div>
      <h2 class="h2">Every <?php echo esc_html($ss_svc['name']); ?> Booking Includes</h2>
    </div>
    <div class="why-feats svc-feat-grid">
      <?php foreach ($ss_svc['features'] as $f): ?>
      <div class="why-feat">
        <div class="why-feat-ico"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($ss_svc['icon']); ?>"/></svg></div>
        <div><p style="margin:0"><?php echo wp_kses_post($f); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="sec sec-alt">
  <div class="wrap">
    <div style="max-width:780px;margin:0 auto">
      <div class="sec-head" style="text-align:center">
        <div class="eyebrow" style="justify-content:center">FAQ</div>
        <h2 class="h2"><?php echo esc_html($ss_svc['name']); ?> — Frequently Asked</h2>
      </div>
      <?php foreach ($ss_svc['faqs'] as $faq): ?>
      <details style="border:1px solid var(--line);border-radius:var(--r10);overflow:hidden;margin-bottom:10px" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary itemprop="name" style="font-family:var(--fh);font-size:.9rem;font-weight:600;color:var(--ink);padding:16px 18px;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:12px;background:#fff;user-select:none">
          <?php echo esc_html($faq['q']); ?>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true" style="flex-shrink:0"><path d="M6 9l6 6 6-6"/></svg>
        </summary>
        <div itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
          <p itemprop="text" style="padding:0 18px 16px;font-size:.87rem;color:var(--ink-60);line-height:1.8;background:#fff;border-top:1px solid var(--line);margin:0"><?php echo esc_html($faq['a']); ?></p>
        </div>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── OTHER SERVICES ── -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Explore More</div>
      <h2 class="h2">Other Services</h2>
    </div>
    <div class="svc-grid">
      <?php foreach (array_slice($ss_other_services, 0, 8, true) as $slug => $svc): ?>
      <a href="<?php echo esc_url(home_url('/services/' . $slug . '/')); ?>" class="svc-card">
        <div class="svc-body" style="padding:20px">
          <div class="svc-ico"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($svc['icon']); ?>"/></svg></div>
          <div class="svc-info">
            <span class="svc-name"><?php echo esc_html($svc['name']); ?></span>
            <span class="svc-arr" aria-hidden="true"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section style="background:var(--ink);padding:64px 0">
  <div class="wrap" style="text-align:center;max-width:600px;margin:0 auto">
    <div class="eyebrow" style="justify-content:center;color:rgba(219,38,72,.9)">Ready to Book?</div>
    <h2 style="font-family:var(--fh);font-size:clamp(1.6rem,3.2vw,2.4rem);font-weight:700;color:#fff;line-height:1.2;letter-spacing:-.02em;margin-bottom:14px">Get Your <?php echo esc_html($ss_svc['name']); ?> Quote Today</h2>
    <p style="font-size:.95rem;color:rgba(255,255,255,.5);line-height:1.75;margin-bottom:28px">Free, no-obligation quote in under 30 minutes. Available 24x7, 365 days a year.</p>
    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
      <a href="#quote" class="btn-primary">Get Free Quote</a>
      <a href="tel:+919073291732" class="btn-ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        09073291732
      </a>
    </div>
  </div>
</section>

</main>

<style>
details[open] summary svg{transform:rotate(180deg)}
details summary::-webkit-details-marker{display:none}
.svc-hero-grid{display:grid;grid-template-columns:1.15fr 1fr;gap:40px}
.svc-feat-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px 32px}
@media(max-width:900px){
  .svc-hero-grid{grid-template-columns:1fr!important;gap:32px!important}
  .svc-feat-grid{grid-template-columns:1fr!important}
}
</style>

<?php get_footer(); ?>
