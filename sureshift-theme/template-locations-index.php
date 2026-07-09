<?php
/**
 * Virtual template — renders for /locations/ (the "View All 664+ Locations"
 * footer link). Lists every curated city from functions.php and links each
 * one to its /packers-and-movers-in-{city}/ page.
 */

add_action('wp_head', function () {
    $desc = "Sure Shift Relocation Services — packers and movers coverage across 664+ locations in India. Find your city and get a free moving quote.";
    ?>
<meta name="description" content="<?php echo esc_attr($desc); ?>">
<link rel="canonical" href="<?php echo esc_url(home_url('/locations/')); ?>">
<meta property="og:title" content="Our Locations — Packers &amp; Movers Across India | Sure Shift">
<meta property="og:description" content="<?php echo esc_attr($desc); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url(home_url('/locations/')); ?>">
    <?php
}, 5);

get_header();
$cities = ss_get_all_cities();
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Our Locations</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:64px 0 48px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Our Presence</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.9rem,4.4vw,3rem);font-weight:800;color:#fff;line-height:1.15;letter-spacing:-.03em;margin-bottom:14px">
      Packers &amp; Movers,<br><span style="color:var(--red)">Wherever You Are.</span>
    </h1>
    <p style="font-size:1rem;color:rgba(255,255,255,.55);line-height:1.8;max-width:560px">
      Sure Shift is serviceable across 664+ locations in India. Pick your city below, or get a free quote and we'll confirm coverage instantly.
    </p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px">
      <?php foreach ($cities as $slug => $c): ?>
      <a href="<?php echo esc_url(home_url('/packers-and-movers-in-' . $slug . '/')); ?>" class="svc-card" style="padding:18px">
        <strong style="font-family:var(--fh);font-size:.92rem;color:var(--ink);display:block;margin-bottom:4px"><?php echo esc_html($c['name']); ?></strong>
        <span style="font-size:.76rem;color:var(--ink-60)"><?php echo esc_html($c['state']); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
    <div style="margin-top:28px;padding:22px;background:var(--surf);border-radius:var(--r14);border:1px solid var(--line);text-align:center">
      <p style="font-size:.9rem;color:var(--ink-60);margin-bottom:12px">Don't see your city listed? We're likely serviceable there too — Sure Shift covers 664+ locations across India.</p>
      <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
        <a href="<?php echo esc_url(home_url('/#quote')); ?>" class="btn-primary">Get Free Quote</a>
        <a href="tel:+919073291732" class="btn-soft">Call 09073291732</a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
@media(max-width:900px){ .sec .wrap > div[style*="grid-template-columns:repeat(4,1fr)"]{grid-template-columns:repeat(2,1fr)!important} }
</style>

<?php get_footer(); ?>
