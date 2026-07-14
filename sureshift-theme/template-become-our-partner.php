<?php
/**
 * Virtual template — renders /become-our-partner/.
 * Do NOT rename; functions.php loads this file directly via
 * locate_template('template-' . $page . '.php').
 */

$ss_page_url = home_url('/become-our-partner/');

add_action('wp_head', function () use ($ss_page_url) {
    ?>
<meta name="description" content="Partner with Sure Shift Relocation Services. Join India's growing franchise and agent network for packers and movers, with training, leads, and brand support.">
<link rel="canonical" href="<?php echo esc_url($ss_page_url); ?>">
<meta property="og:title" content="Become Our Partner | Sure Shift">
<meta property="og:description" content="Join the Sure Shift franchise and agent network — training, leads, and brand support included.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_page_url); ?>">
    <?php
}, 5);

get_header();

$ss_benefits = array(
    array('Established Brand', 'Operate under a recognised, ISO-certified name customers already trust.', 'M9 12l2 2 4-4m-6.364 1.364A9 9 0 1121 12a9 9 0 01-12.728 5.364z'),
    array('Lead Support', 'Get enquiries routed to you from our website, call centre, and marketing campaigns.', 'M16 11c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4z M3 20c0-3.314 4.03-6 9-6s9 2.686 9 6'),
    array('Training &amp; Systems', 'Onboarding covers packing standards, GPS fleet tools, and customer service protocols.', 'M12 20h9 M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z'),
    array('Low Overheads', 'Start with a lean setup — office space, a small crew, and access to shared fleet capacity.', 'M12 2v20M2 12h20'),
);
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Become Our Partner</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Franchise &amp; Agent Network</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:10px">Become a Sure Shift Partner</h1>
    <p style="font-size:.95rem;color:rgba(255,255,255,.55);max-width:560px">Join a growing network of packers and movers partners across India, backed by the Sure Shift brand, systems, and lead pipeline.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="bp-grid">

      <div>
        <div class="sec-head">
          <div class="eyebrow">Why Partner With Us</div>
          <h2 class="h2">Grow Your Moving Business With Sure Shift</h2>
        </div>
        <div class="why-feats">
          <?php foreach ($ss_benefits as $b): ?>
          <div class="why-feat">
            <div class="why-feat-ico"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($b[2]); ?>"/></svg></div>
            <div>
              <strong><?php echo wp_kses_post($b[0]); ?></strong>
              <p><?php echo wp_kses_post($b[1]); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div style="margin-top:28px;padding:20px 24px;background:var(--surf);border-radius:var(--r14)">
          <h3 style="font-family:var(--fh);font-size:.9rem;font-weight:700;color:var(--ink);margin-bottom:8px">Who We're Looking For</h3>
          <p style="font-size:.87rem;color:var(--ink-60);line-height:1.8">Existing transport or packers &amp; movers operators, entrepreneurs with warehouse/vehicle access, and franchise investors looking to enter the logistics sector in their city.</p>
        </div>
      </div>

      <div class="eq" id="partner-form" role="region" aria-label="Partner application form">
        <div class="eq-top">
          <div>
            <div class="eq-top-title">Apply to Partner</div>
            <div class="eq-top-sub">Our partnerships team replies within 2 business days</div>
          </div>
        </div>
        <form id="partnerForm" novalidate>
          <div class="eq-fields" style="display:block;padding:20px 0 0">
            <div class="fld"><label for="pf-name">Full Name*</label><input id="pf-name" name="name" type="text" required></div>
            <div class="fld"><label for="pf-phone">Phone Number*</label><input id="pf-phone" name="phone" type="tel" inputmode="numeric" maxlength="10" required></div>
            <div class="fld"><label for="pf-email">Email</label><input id="pf-email" name="email" type="email"></div>
            <div class="fld"><label for="pf-city">City You Want to Operate In*</label><input id="pf-city" name="city" type="text" required></div>
            <div class="fld"><label for="pf-message">Tell Us About Your Business</label><textarea id="pf-message" name="message" rows="4" placeholder="Existing fleet, warehouse, years in logistics, investment budget, etc."></textarea></div>
          </div>
          <div class="eq-msg" id="pfMsg" role="alert" aria-live="polite" style="display:none"></div>
          <div class="eq-foot">
            <button type="submit" class="eq-submit" id="pfSubmit">
              <span class="eq-btn-txt">Submit Application</span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
            <p class="eq-note">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              100% private &middot; No spam
            </p>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

</main>

<style>
.bp-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:40px;align-items:start}
.bp-grid .fld{margin-bottom:14px}
.bp-grid .fld label{display:block;font-size:.78rem;font-weight:600;color:var(--ink-60);margin-bottom:5px}
.bp-grid .fld input,.bp-grid .fld textarea{width:100%;padding:11px 13px;border:1px solid var(--line);border-radius:var(--r10);font-family:inherit;font-size:.88rem;color:var(--ink);background:#fff}
.bp-grid .fld textarea{resize:vertical}
@media(max-width:900px){
  .bp-grid{grid-template-columns:1fr;gap:32px}
}
</style>

<?php get_footer(); ?>
