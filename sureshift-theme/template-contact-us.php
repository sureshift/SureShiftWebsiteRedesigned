<?php
/**
 * Virtual template — renders /contact-us/.
 * Do NOT rename; functions.php loads this file directly via
 * locate_template('template-' . $page . '.php').
 */

$ss_page_url = home_url('/contact-us/');

add_action('wp_head', function () use ($ss_page_url) {
    ?>
<meta name="description" content="Get in touch with Sure Shift Relocation Services. Call, email, or send us a message for a free quote or support with your move.">
<link rel="canonical" href="<?php echo esc_url($ss_page_url); ?>">
<meta property="og:title" content="Contact Us | Sure Shift">
<meta property="og:description" content="Call, email, or message Sure Shift Relocation Services for a free quote or support with your move.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_page_url); ?>">
    <?php
}, 5);

get_header();
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Contact Us</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Get In Touch</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:10px">Contact Sure Shift</h1>
    <p style="font-size:.95rem;color:rgba(255,255,255,.55);max-width:520px">Have a question, need a custom quote, or want support with an existing move? Reach us any way that&rsquo;s convenient.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="cu-grid">

      <div>
        <div style="display:flex;flex-direction:column;gap:20px;margin-bottom:28px">
          <div style="display:flex;gap:14px;align-items:flex-start">
            <div class="why-feat-ico" style="flex-shrink:0"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div>
            <div>
              <strong style="display:block;font-family:var(--fh);font-size:.9rem;color:var(--ink);margin-bottom:2px">Call Us</strong>
              <a href="tel:+919073291732" style="font-size:.9rem;color:var(--ink-60)">09073291732</a><br>
              <span style="font-size:.78rem;color:var(--ink-30)">Mon &ndash; Sun, Open 24 Hours</span>
            </div>
          </div>
          <div style="display:flex;gap:14px;align-items:flex-start">
            <div class="why-feat-ico" style="flex-shrink:0"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div>
              <strong style="display:block;font-family:var(--fh);font-size:.9rem;color:var(--ink);margin-bottom:2px">Email Us</strong>
              <a href="mailto:info@sureshift.in" style="font-size:.9rem;color:var(--ink-60)">info@sureshift.in</a>
            </div>
          </div>
          <div style="display:flex;gap:14px;align-items:flex-start">
            <div class="why-feat-ico" style="flex-shrink:0"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div>
              <strong style="display:block;font-family:var(--fh);font-size:.9rem;color:var(--ink);margin-bottom:2px">Head Office</strong>
              <span style="font-size:.9rem;color:var(--ink-60);line-height:1.6">P Block, Plot No. 131, Gopal Nagar Extension, Najafgarh, New Delhi, Delhi 110043</span>
            </div>
          </div>
        </div>

        <div style="border-radius:var(--r14);overflow:hidden;border:1px solid var(--line)">
          <iframe title="Sure Shift office location map" src="https://maps.google.com/maps?q=P%20Block%2C%20Plot%20No.%20131%2C%20Gopal%20Nagar%20Extension%2C%20Najafgarh%2C%20New%20Delhi%2C%20Delhi%20110043&t=&z=14&ie=UTF8&iwloc=&output=embed" width="100%" height="240" style="border:0;display:block" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>

      <div class="eq" id="contact-form" role="region" aria-label="Send us a message">
        <div class="eq-top">
          <div>
            <div class="eq-top-title">Send Us a Message</div>
            <div class="eq-top-sub">We typically reply within a few hours</div>
          </div>
        </div>
        <form id="contactForm" novalidate>
          <div class="eq-fields" style="display:block;padding:20px 0 0">
            <div class="fld"><label for="cf-name">Full Name*</label><input id="cf-name" name="name" type="text" required></div>
            <div class="fld"><label for="cf-phone">Phone Number*</label><input id="cf-phone" name="phone" type="tel" inputmode="numeric" maxlength="10" required></div>
            <div class="fld"><label for="cf-email">Email</label><input id="cf-email" name="email" type="email"></div>
            <div class="fld"><label for="cf-subject">Subject</label><input id="cf-subject" name="subject" type="text" placeholder="e.g. Quote follow-up, complaint, feedback"></div>
            <div class="fld"><label for="cf-message">Message*</label><textarea id="cf-message" name="message" rows="4" required></textarea></div>
          </div>
          <div class="eq-msg" id="cfMsg" role="alert" aria-live="polite" style="display:none"></div>
          <div class="eq-foot">
            <button type="submit" class="eq-submit" id="cfSubmit">
              <span class="eq-btn-txt">Send Message</span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
            <p class="eq-note">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
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
.cu-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:start}
.cu-grid .fld{margin-bottom:14px}
.cu-grid .fld label{display:block;font-size:.78rem;font-weight:600;color:var(--ink-60);margin-bottom:5px}
.cu-grid .fld input,.cu-grid .fld textarea{width:100%;padding:11px 13px;border:1px solid var(--line);border-radius:var(--r10);font-family:inherit;font-size:.88rem;color:var(--ink);background:#fff}
.cu-grid .fld textarea{resize:vertical}
@media(max-width:900px){
  .cu-grid{grid-template-columns:1fr;gap:32px}
}
</style>

<?php get_footer(); ?>
