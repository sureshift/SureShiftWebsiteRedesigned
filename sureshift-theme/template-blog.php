<?php
/**
 * Virtual template — renders /blog/.
 * Lists published posts via WP_Query; shows a graceful empty state
 * until the first post is published. Do NOT rename; functions.php
 * loads this file directly via locate_template('template-' . $page . '.php').
 */

$ss_page_url = home_url('/blog/');

add_action('wp_head', function () use ($ss_page_url) {
    ?>
<meta name="description" content="Moving tips, company updates, and news from Sure Shift Relocation Services.">
<link rel="canonical" href="<?php echo esc_url($ss_page_url); ?>">
<meta property="og:title" content="Blog &amp; News | Sure Shift">
<meta property="og:description" content="Moving tips, company updates, and news from Sure Shift Relocation Services.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url($ss_page_url); ?>">
    <?php
}, 5);

get_header();

$ss_paged = max(1, get_query_var('paged'), get_query_var('page'));
$ss_blog_query = new WP_Query(array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $ss_paged,
));
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Blog &amp; News</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Resources</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em;margin-bottom:10px">Blog &amp; News</h1>
    <p style="font-size:.95rem;color:rgba(255,255,255,.55);max-width:560px">Moving guides, packing tips, and updates from the Sure Shift team.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <?php if ($ss_blog_query->have_posts()): ?>
    <div class="blog-grid">
      <?php while ($ss_blog_query->have_posts()): $ss_blog_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="svc-card" style="display:block">
        <?php if (has_post_thumbnail()): ?>
        <div style="aspect-ratio:16/10;overflow:hidden;border-radius:var(--r14) var(--r14) 0 0"><?php the_post_thumbnail('ss-card', array('style' => 'width:100%;height:100%;object-fit:cover')); ?></div>
        <?php endif; ?>
        <div class="svc-body" style="padding:20px">
          <span style="font-size:.75rem;color:var(--ink-30);display:block;margin-bottom:8px"><?php echo esc_html(get_the_date()); ?></span>
          <span class="svc-name" style="display:block;font-size:1rem;margin-bottom:8px"><?php the_title(); ?></span>
          <p style="font-size:.85rem;color:var(--ink-60);line-height:1.7;margin:0"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
        </div>
      </a>
      <?php endwhile; ?>
    </div>

    <?php if ($ss_blog_query->max_num_pages > 1): ?>
    <div style="display:flex;justify-content:center;gap:10px;margin-top:40px">
      <?php
      echo paginate_links(array(
          'base'      => home_url('/blog/') . '%_%',
          'format'    => '?page=%#%',
          'current'   => $ss_paged,
          'total'     => $ss_blog_query->max_num_pages,
          'prev_text' => '&larr; Newer',
          'next_text' => 'Older &rarr;',
      ));
      ?>
    </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

    <?php else: ?>
    <div style="text-align:center;max-width:480px;margin:0 auto;padding:40px 0">
      <div class="why-feat-ico" style="margin:0 auto 20px"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 016.5 17H20 M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></div>
      <h2 style="font-family:var(--fh);font-size:1.2rem;font-weight:700;color:var(--ink);margin-bottom:10px">New Posts Coming Soon</h2>
      <p style="font-size:.9rem;color:var(--ink-60);line-height:1.8;margin-bottom:20px">We're preparing moving guides, packing checklists, and company updates. Check back soon, or follow us on social media for the latest.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary" style="display:inline-flex">Back to Home</a>
    </div>
    <?php endif; ?>
  </div>
</section>

</main>

<style>
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
@media(max-width:900px){.blog-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.blog-grid{grid-template-columns:1fr}}
</style>

<?php get_footer(); ?>
