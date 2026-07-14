<?php
/**
 * Virtual template — renders /sitemap/. A human-readable HTML sitemap
 * (not the XML sitemap used by search engines). Pulls city data from
 * ss_get_all_cities() so it never goes stale as locations are added.
 */

$ss_sitemap_url = home_url('/sitemap/');

add_action('wp_head', function () use ($ss_sitemap_url) {
    ?>
<meta name="description" content="Browse every page on the Sure Shift website — services, locations, company information, and policies — in one place.">
<link rel="canonical" href="<?php echo esc_url($ss_sitemap_url); ?>">
<meta name="robots" content="noindex,follow">
    <?php
}, 5);

get_header();

$ss_services = array(
    array('Household Moving', 'household-moving'),
    array('Office Shifting', 'office-moving'),
    array('International Moving', 'international-moving'),
    array('Car Transport', 'car-transport'),
    array('Bike Transport', 'bike-transport'),
    array('Secure Storage', 'secure-storage'),
    array('Fine Arts Moving', 'fine-arts'),
    array('Commercial Moving', 'commercial-moving'),
    array('Courier Services', 'courier'),
    array('Truck Rental', 'truck-rental'),
    array('Last Mile Delivery', 'last-mile'),
    array('ODC Consignment', 'odc'),
);

$ss_company = array(
    array('About Us', 'about-us'),
    array('Blog & News', 'blog'),
    array('Careers', 'careers'),
    array('Contact Us', 'contact-us'),
    array('Pay Online', 'pay-online'),
    array('Become Our Partner', 'become-our-partner'),
);

$ss_legal_links = array(
    array('Privacy Policy', 'privacy-policy'),
    array('Terms & Conditions', 'terms-and-conditions'),
    array('Refund Policy', 'refund-policy'),
    array('Payment Policy', 'payment-policy'),
    array('Cancellation Policy', 'cancellation-policy'),
    array('Disclaimer', 'disclaimer'),
    array('Damage Claim Policy', 'damage-claim-policy'),
);

$ss_cities = ss_get_all_cities();
?>

<main id="main">

<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60)">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">Sitemap</span>
    </nav>
  </div>
</div>

<section style="background:var(--ink);padding:56px 0 44px">
  <div class="wrap">
    <div class="eyebrow" style="color:rgba(219,38,72,.9)">Sitemap</div>
    <h1 style="font-family:var(--fh);font-size:clamp(1.8rem,3.6vw,2.6rem);font-weight:800;color:#fff;letter-spacing:-.03em">Every Page, In One Place</h1>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:40px">

      <div>
        <h2 style="font-family:var(--fh);font-size:.95rem;font-weight:700;color:var(--ink);text-transform:uppercase;letter-spacing:.06em;margin-bottom:16px">Services</h2>
        <ul style="list-style:none;padding:0;margin:0">
          <li style="margin-bottom:10px"><a href="<?php echo esc_url(home_url('/')); ?>" style="font-size:.9rem;color:var(--ink-60)">Home</a></li>
          <?php foreach ($ss_services as $s): ?>
          <li style="margin-bottom:10px"><a href="<?php echo esc_url(home_url('/services/' . $s[1] . '/')); ?>" style="font-size:.9rem;color:var(--ink-60)"><?php echo esc_html($s[0]); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <h2 style="font-family:var(--fh);font-size:.95rem;font-weight:700;color:var(--ink);text-transform:uppercase;letter-spacing:.06em;margin-bottom:16px">Company</h2>
        <ul style="list-style:none;padding:0;margin:0">
          <?php foreach ($ss_company as $c): ?>
          <li style="margin-bottom:10px"><a href="<?php echo esc_url(home_url('/' . $c[1] . '/')); ?>" style="font-size:.9rem;color:var(--ink-60)"><?php echo esc_html($c[0]); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <h2 style="font-family:var(--fh);font-size:.95rem;font-weight:700;color:var(--ink);text-transform:uppercase;letter-spacing:.06em;margin-bottom:16px">Policies &amp; Legal</h2>
        <ul style="list-style:none;padding:0;margin:0">
          <?php foreach ($ss_legal_links as $l): ?>
          <li style="margin-bottom:10px"><a href="<?php echo esc_url(home_url('/' . $l[1] . '/')); ?>" style="font-size:.9rem;color:var(--ink-60)"><?php echo esc_html($l[0]); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <h2 style="font-family:var(--fh);font-size:.95rem;font-weight:700;color:var(--ink);text-transform:uppercase;letter-spacing:.06em;margin-bottom:16px">Locations</h2>
        <ul style="list-style:none;padding:0;margin:0;columns:2;column-gap:20px">
          <?php foreach ($ss_cities as $slug => $city): ?>
          <li style="margin-bottom:10px;break-inside:avoid"><a href="<?php echo esc_url(home_url('/packers-and-movers-in-' . $slug . '/')); ?>" style="font-size:.9rem;color:var(--ink-60)"><?php echo esc_html($city['name']); ?></a></li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo esc_url(home_url('/locations/')); ?>" style="display:inline-block;margin-top:8px;font-size:.85rem;font-weight:600;color:var(--red)">View All 664+ Locations &rarr;</a>
      </div>

    </div>
  </div>
</section>

</main>

<style>
@media(max-width:480px){
  #main ul[style*="columns:2"]{columns:1!important}
}
</style>

<?php get_footer(); ?>
