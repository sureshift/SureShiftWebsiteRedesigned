<?php
/**
 * Virtual template — renders /careers/.
 * Do NOT rename; functions.php loads this file directly via
 * locate_template('template-' . $page . '.php').
 */

$ss_page_url = home_url('/careers/');

add_action('wp_head', function () use ($ss_page_url) {
    ?>
<meta name="description" content="Build your career with Sure Shift Relocation Services. Explore roles across operations, driving, packing, and customer support in India's growing relocation network.">
<link rel="canonical" href="<?php echo esc_url($ss_page_url); ?>">
<meta property="og:title" content="Careers at Sure Shift">
<meta property="og:description" content="Explore career opportunities with Sure Shift Relocation Services across India.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_page_url); ?>">
    <?php
}, 5);

get_header();

$ss_perks = array(
    array('Nationwide Growth', 'Branches opening across 120+ cities — real advancement opportunities as we scale.', 'M22 12h-4l-3 9L9 3l-3 9H2'),
    array('Training Provided', 'Structured onboarding for packing standards, safe handling, and customer service.', 'M12 20h9 M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z'),
    array('Team-First Culture', 'A supportive crew culture built on respect, safety, and taking pride in every move.', 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2 M9 11a4 4 0 100-8 4 4 0 000 8z M23 21v-2a4 4 0 00-3-3.87 M16 3.13a4 4 0 010 7.75'),
);

$ss_roles = array(
    'Move Managers / Coordinators',
    'Packing &amp; Loading Crew',
    'Truck Drivers (LMV/HMV)',
    'Customer Support Executives',
    'Branch / Operations Managers',
    'Sales &amp; Business Development',
);
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Careers</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Join Our Team</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:10px">Careers at Sure Shift</h1>
    <p style="font-size:.95rem;color:rgba(255,255,255,.55);max-width:560px">We're building India's most trusted relocation network — and we're always looking for people who care about doing the job right.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Why Sure Shift</div>
      <h2 class="h2">A Place to Build a Career, Not Just a Job</h2>
    </div>
    <div class="why-feats careers-perks" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px">
      <?php foreach ($ss_perks as $p): ?>
      <div class="why-feat" style="flex-direction:column;align-items:flex-start">
        <div class="why-feat-ico"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($p[2]); ?>"/></svg></div>
        <div>
          <strong><?php echo wp_kses_post($p[0]); ?></strong>
          <p><?php echo wp_kses_post($p[1]); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec sec-alt">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Open Positions</div>
      <h2 class="h2">Roles We Regularly Hire For</h2>
      <p class="lead">Specific openings vary by city and season. Reach out even if you don't see an exact match — we keep resumes on file for upcoming branches.</p>
    </div>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:32px">
      <?php foreach ($ss_roles as $r): ?>
      <span style="background:#fff;border:1px solid var(--line);border-radius:var(--r99);padding:9px 18px;font-size:.85rem;color:var(--ink-60);font-family:var(--fh);font-weight:500"><?php echo wp_kses_post($r); ?></span>
      <?php endforeach; ?>
    </div>

    <div style="background:#fff;border-radius:var(--r14);padding:28px 30px;border:1px solid var(--line);max-width:600px">
      <h3 style="font-family:var(--fh);font-size:1rem;font-weight:700;color:var(--ink);margin-bottom:8px">How to Apply</h3>
      <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8;margin-bottom:16px">Email your resume along with the role and city you're interested in — our HR team reviews applications on a rolling basis.</p>
      <a href="mailto:careers@sureshift.in?subject=Job%20Application" class="btn-primary" style="display:inline-flex">Email Your Resume</a>
      <p style="font-size:.8rem;color:var(--ink-30);margin-top:14px">careers@sureshift.in &middot; or call 09073291732</p>
    </div>
  </div>
</section>

</main>

<style>
@media(max-width:900px){
  .careers-perks{grid-template-columns:1fr!important}
}
</style>

<?php get_footer(); ?>
