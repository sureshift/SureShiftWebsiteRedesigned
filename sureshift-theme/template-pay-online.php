<?php
/**
 * Virtual template — renders /pay-online/.
 * Do NOT rename; functions.php loads this file directly via
 * locate_template('template-' . $page . '.php').
 */

$ss_page_url = home_url('/pay-online/');

add_action('wp_head', function () use ($ss_page_url) {
    ?>
<meta name="description" content="Pay your Sure Shift Relocation Services invoice securely online via UPI, cards, net banking, or bank transfer.">
<link rel="canonical" href="<?php echo esc_url($ss_page_url); ?>">
<meta property="og:title" content="Pay Online | Sure Shift">
<meta property="og:description" content="Securely pay your Sure Shift invoice online via UPI, cards, net banking, or bank transfer.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_page_url); ?>">
    <?php
}, 5);

get_header();

$ss_methods = array(
    array('UPI', 'Google Pay, PhonePe, Paytm, and other UPI apps', 'M9 12l2 2 4-4m-6.364 1.364A9 9 0 1121 12a9 9 0 01-12.728 5.364z'),
    array('Cards', 'Credit and debit cards, Visa/Mastercard/RuPay', 'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2 M9 21a2 2 0 100-4 2 2 0 000 4z M15 21a2 2 0 100-4 2 2 0 000 4z'),
    array('Net Banking', 'All major Indian banks supported', 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'),
    array('Bank Transfer', 'NEFT / RTGS / IMPS to our company account', 'M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z M14 2v6h6 M9 13h6 M9 17h6'),
);
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Pay Online</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Secure Payments</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:10px">Pay Online</h1>
    <p style="font-size:.95rem;color:rgba(255,255,255,.55);max-width:560px">Settle your booking advance or final invoice securely, from anywhere.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="pay-grid">

      <div style="background:#fff;border:1px solid var(--line);border-radius:var(--r14);padding:32px;text-align:center">
        <div style="width:56px;height:56px;border-radius:50%;background:var(--red-06);display:flex;align-items:center;justify-content:center;margin:0 auto 18px">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#DB2648" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2 M9 21a2 2 0 100-4 2 2 0 000 4z M15 21a2 2 0 100-4 2 2 0 000 4z"/></svg>
        </div>
        <h2 style="font-family:var(--fh);font-size:1.15rem;font-weight:700;color:var(--ink);margin-bottom:10px">Have a Booking Reference?</h2>
        <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8;margin-bottom:20px">Call or WhatsApp our billing team with your consignment/booking number and we'll send you a secure payment link instantly via SMS or email.</p>
        <a href="tel:+919073291732" class="btn-primary" style="display:inline-flex;margin-bottom:10px">Call 09073291732</a>
        <p style="font-size:.8rem;color:var(--ink-30)">or email <a href="mailto:info@sureshift.in" style="color:var(--red)">info@sureshift.in</a></p>
      </div>

      <div>
        <div class="sec-head" style="margin-bottom:20px">
          <div class="eyebrow">Accepted Methods</div>
          <h2 class="h2" style="font-size:clamp(1.4rem,2.6vw,1.9rem)">Multiple Ways to Pay</h2>
        </div>
        <div class="pay-methods">
          <?php foreach ($ss_methods as $m): ?>
          <div class="why-feat">
            <div class="why-feat-ico"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($m[2]); ?>"/></svg></div>
            <div>
              <strong><?php echo esc_html($m[0]); ?></strong>
              <p><?php echo esc_html($m[1]); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <p style="font-size:.82rem;color:var(--ink-30);margin-top:16px">All online payments are processed through secure, PCI-DSS compliant gateways. See our <a href="<?php echo esc_url(home_url('/payment-policy/')); ?>" style="color:var(--red)">Payment Policy</a> for details.</p>
      </div>

    </div>
  </div>
</section>

</main>

<style>
.pay-grid{display:grid;grid-template-columns:1fr 1.1fr;gap:40px;align-items:start}
.pay-methods{display:grid;grid-template-columns:1fr 1fr;gap:18px}
@media(max-width:900px){
  .pay-grid{grid-template-columns:1fr;gap:32px}
}
@media(max-width:560px){
  .pay-methods{grid-template-columns:1fr}
}
</style>

<?php get_footer(); ?>
