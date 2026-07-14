<?php
/**
 * Virtual template — renders /privacy-policy/, /terms-and-conditions/,
 * /refund-policy/, /payment-policy/, /cancellation-policy/, /disclaimer/
 * and /damage-claim-policy/. Do NOT rename; functions.php loads this
 * file directly via locate_template('template-legal.php').
 */

$ss_legal_slug = get_query_var('ss_legal');
$ss_legal_data = ss_get_legal_pages();
$ss_page       = isset($ss_legal_data[$ss_legal_slug]) ? $ss_legal_data[$ss_legal_slug] : null;

if (!$ss_page) {
    status_header(404);
    get_header();
    echo '<main class="sec"><div class="wrap"><p>Page not found.</p></div></main>';
    get_footer();
    exit;
}

$ss_page_url = home_url('/' . $ss_legal_slug . '/');

add_action('wp_head', function () use ($ss_page, $ss_page_url, $ss_legal_slug) {
    $desc = wp_strip_all_tags($ss_page['intro']);
    ?>
<meta name="description" content="<?php echo esc_attr(wp_trim_words($desc, 30)); ?>">
<link rel="canonical" href="<?php echo esc_url($ss_page_url); ?>">
<meta property="og:title" content="<?php echo esc_attr(wp_strip_all_tags($ss_page['title'])); ?> | Sure Shift">
<meta property="og:description" content="<?php echo esc_attr(wp_trim_words($desc, 30)); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_page_url); ?>">
<script type="application/ld+json">
<?php
$schema = array(
    '@context' => 'https://schema.org',
    '@type'    => 'WebPage',
    '@id'      => $ss_page_url . '#webpage',
    'url'      => $ss_page_url,
    'name'     => wp_strip_all_tags($ss_page['title']) . ' | Sure Shift Relocation Services',
    'description' => wp_trim_words($desc, 30),
    'inLanguage' => 'en-IN',
    'isPartOf' => array('@id' => home_url('/') . '#website'),
    'breadcrumb' => array(
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(
            array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
            array('@type' => 'ListItem', 'position' => 2, 'name' => wp_strip_all_tags($ss_page['title']), 'item' => $ss_page_url),
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
      <span style="color:var(--ink-30)" aria-current="page"><?php echo esc_html($ss_page['title']); ?></span>
    </nav>
  </div>
</div>

<!-- ── HEADER ── -->
<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Legal</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:10px"><?php echo esc_html($ss_page['title']); ?></h1>
    <p style="font-size:.85rem;color:rgba(255,255,255,.5)">Last updated: <?php echo esc_html($ss_page['updated']); ?></p>
  </div>
</section>

<!-- ── CONTENT ── -->
<section class="sec">
  <div class="wrap">
    <div style="max-width:760px">
      <p style="font-size:1rem;color:var(--ink-60);line-height:1.85;margin-bottom:36px"><?php echo wp_kses_post($ss_page['intro']); ?></p>

      <?php foreach ($ss_page['sections'] as $i => $sec): ?>
      <div style="margin-bottom:32px">
        <h2 style="font-family:var(--fh);font-size:1.2rem;font-weight:700;color:var(--ink);letter-spacing:-.01em;margin-bottom:12px"><?php echo ($i + 1) . '. ' . wp_kses_post($sec['h']); ?></h2>

        <?php if (!empty($sec['p'])): foreach ($sec['p'] as $para): ?>
        <p style="font-size:.92rem;color:var(--ink-60);line-height:1.85;margin-bottom:12px"><?php echo wp_kses_post($para); ?></p>
        <?php endforeach; endif; ?>

        <?php if (!empty($sec['list'])): ?>
        <ul style="margin:0 0 8px;padding-left:20px">
          <?php foreach ($sec['list'] as $item): ?>
          <li style="font-size:.92rem;color:var(--ink-60);line-height:1.85;margin-bottom:6px"><?php echo wp_kses_post($item); ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>

      <div style="background:var(--surf);border-radius:var(--r14);padding:24px 28px;margin-top:8px">
        <h2 style="font-family:var(--fh);font-size:1rem;font-weight:700;color:var(--ink);margin-bottom:10px">Questions About This Policy?</h2>
        <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8;margin-bottom:4px">Sure Shift Relocation Services</p>
        <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8;margin-bottom:4px">P Block, Plot No. 131, Gopal Nagar Extension, Najafgarh, New Delhi, Delhi 110043</p>
        <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8;margin-bottom:4px">Phone: <a href="tel:+919073291732" style="color:var(--red)">09073291732</a></p>
        <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8">Email: <a href="mailto:info@sureshift.in" style="color:var(--red)">info@sureshift.in</a></p>
      </div>
    </div>
  </div>
</section>

</main>

<?php get_footer(); ?>
