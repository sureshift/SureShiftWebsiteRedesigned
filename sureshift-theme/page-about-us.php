<?php
/**
 * Template Name: About Us
 * Sure Shift Relocation Services — About Page
 * SEO + AEO + GEO optimized per project brief
 */
?>
<?php get_header(); ?>

<?php
// Page-specific SEO meta — injected via wp_head
add_action('wp_head', function() {
?>
<title>About Sure Shift Relocation Services | India's Fastest-Growing Packers &amp; Movers Since 2023</title>
<meta name="description" content="Sure Shift Relocation Services was founded in 2023 by Vikas Kumar in Najafgarh, Delhi. Today we operate 300+ GPS trucks, 120+ branches, and 1,000+ employees serving 1,700+ locations across India. ISO 9001:2015 &amp; ISO 39001:2012 certified.">
<meta name="keywords" content="about sure shift relocation, packers movers company India, trusted moving company Delhi, ISO certified movers India, Vikas Kumar Sure Shift founder">
<meta property="og:title" content="About Sure Shift — India's Fastest-Growing Relocation Company Since 2023">
<meta property="og:description" content="Founded in 2023, Sure Shift has grown from a 4-person team to 1,000+ employees, 300+ trucks and 120+ branches across India. Discover our story.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url(home_url('/about-us/')); ?>">
<meta name="twitter:card" content="summary_large_image">
<link rel="canonical" href="<?php echo esc_url(home_url('/about-us/')); ?>">

<!-- About Page Schema — Organization + Person (Founder) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "AboutPage",
      "@id": "<?php echo esc_url(home_url('/about-us/')); ?>",
      "url": "<?php echo esc_url(home_url('/about-us/')); ?>",
      "name": "About Sure Shift Relocation Services",
      "description": "Sure Shift Relocation Services was founded in 2023 by Vikas Kumar in Najafgarh, New Delhi. The company has grown to 300+ GPS-enabled trucks, 1,000+ employees, 120+ branches, completing 65,000+ moves annually across 1,700+ locations in India.",
      "inLanguage": "en-IN",
      "isPartOf": {"@id": "https://www.sureshift.in/"},
      "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
          {"@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo esc_url(home_url('/')); ?>"},
          {"@type": "ListItem", "position": 2, "name": "About Us", "item": "<?php echo esc_url(home_url('/about-us/')); ?>"}
        ]
      }
    },
    {
      "@type": "MovingCompany",
      "@id": "https://www.sureshift.in/#organization",
      "name": "Sure Shift Relocation Services",
      "alternateName": "Sure Shift",
      "url": "https://www.sureshift.in",
      "logo": "https://sureshift.in/wp-content/uploads/2025/02/logo.a27ef0b398a2f4fa34b8.png",
      "foundingDate": "2023",
      "foundingLocation": {
        "@type": "Place",
        "name": "Najafgarh, New Delhi, India"
      },
      "description": "India's fastest-growing relocation network since 2023. Sure Shift operates 300+ GPS-enabled trucks, 120+ owned branches, and 1,000+ trained employees serving 1,700+ locations across India and coordinating international moves to 88+ countries.",
      "numberOfEmployees": {"@type": "QuantitativeValue", "value": "1000+"},
      "areaServed": ["India", "International"],
      "telephone": "+919073291732",
      "email": "info@sureshift.in",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "P Block, Plot No. 131, Gopal Nagar Extension, Najafgarh",
        "addressLocality": "New Delhi",
        "addressRegion": "Delhi",
        "postalCode": "110043",
        "addressCountry": "IN"
      },
      "hasCredential": [
        {"@type": "EducationalOccupationalCredential", "credentialCategory": "ISO 9001:2015"},
        {"@type": "EducationalOccupationalCredential", "credentialCategory": "ISO 39001:2012"}
      ],
      "sameAs": [
        "https://www.facebook.com/profile.php?id=61559606034810",
        "https://www.instagram.com/sure.shift",
        "https://www.linkedin.com/company/sureshift"
      ],
      "founder": {
        "@type": "Person",
        "name": "Vikas Kumar",
        "jobTitle": "Founder & Director",
        "description": "MBA in Logistics & Supply Chain Management. Military family background. Prior industry experience at a leading relocation company before founding Sure Shift in 2023.",
        "worksFor": {"@id": "https://www.sureshift.in/#organization"},
        "alumniOf": {"@type": "EducationalOrganization", "name": "MBA — Logistics & Supply Chain Management"}
      }
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "When was Sure Shift Relocation Services founded?",
          "acceptedAnswer": {"@type": "Answer", "text": "Sure Shift Relocation Services was founded in 2023 by Vikas Kumar in Najafgarh, New Delhi. Starting with a 4-person team and market-hired trucks, the company has grown into one of India's fastest-growing relocation networks."}
        },
        {
          "@type": "Question",
          "name": "How many branches does Sure Shift have across India?",
          "acceptedAnswer": {"@type": "Answer", "text": "Sure Shift operates 120+ owned branches across India, serving 1,700+ locations. The company is actively expanding its branch network."}
        },
        {
          "@type": "Question",
          "name": "Is Sure Shift ISO certified?",
          "acceptedAnswer": {"@type": "Answer", "text": "Yes. Sure Shift Relocation Services holds active ISO 9001:2015 (Quality Management) and ISO 39001:2012 (Road Traffic Safety) certifications. These are real, verified certifications."}
        },
        {
          "@type": "Question",
          "name": "How many moves does Sure Shift complete each year?",
          "acceptedAnswer": {"@type": "Answer", "text": "Sure Shift completes 65,000+ moves every year across India, making it one of the highest-volume owned-fleet moving companies in the country."}
        },
        {
          "@type": "Question",
          "name": "Who founded Sure Shift and what is his background?",
          "acceptedAnswer": {"@type": "Answer", "text": "Sure Shift was founded by Vikas Kumar, who holds an MBA in Logistics & Supply Chain Management and grew up in a military family that relocated frequently across India. He previously worked inside the relocation industry before starting Sure Shift to solve the problems he saw firsthand — late deliveries, damage, no tracking, and paper-based errors."}
        },
        {
          "@type": "Question",
          "name": "Does Sure Shift use its own trucks or outsource to contractors?",
          "acceptedAnswer": {"@type": "Answer", "text": "Sure Shift operates its own fleet of 300+ GPS-enabled trucks — not a broker or aggregator model. Every truck is owned and operated by Sure Shift, ensuring full accountability and quality control from pickup to delivery."}
        }
      ]
    }
  ]
}
</script>
<?php
}, 5);
?>

<main id="main">

<!-- ── BREADCRUMB ── -->
<div style="background:var(--surf);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:10px;padding-bottom:10px">
    <nav aria-label="Breadcrumb" style="font-size:.76rem;color:var(--ink-60);display:flex;align-items:center;gap:6px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--ink-60);transition:color .2s ease" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--ink-60)'">Home</a>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      <span style="color:var(--ink-30)" aria-current="page">About Us</span>
    </nav>
  </div>
</div>

<!-- ── HERO ── -->
<section style="position:relative;background:var(--ink);overflow:hidden;padding:80px 0 72px">
  <div style="position:absolute;inset:0;background:url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1400&q=75&auto=format') center/cover no-repeat;opacity:.18;z-index:0"></div>
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(219,38,72,.15) 0%,transparent 60%);z-index:1"></div>
  <div class="wrap" style="position:relative;z-index:2">
    <div style="max-width:720px">
      <div class="eyebrow" style="color:rgba(219,38,72,.9)">Our Story</div>
      <h1 style="font-family:var(--fh);font-size:clamp(2rem,5vw,3.4rem);font-weight:800;color:#fff;line-height:1.1;letter-spacing:-.03em;margin-bottom:20px">
        Built on Every Move<br><span style="color:var(--red)">Done Right.</span>
      </h1>
      <p style="font-size:1.05rem;color:rgba(255,255,255,.62);line-height:1.8;max-width:580px;margin-bottom:32px">
        Sure Shift started in 2023 with four packers and a hired truck in Najafgarh, Delhi. Today we're India's fastest-growing relocation network — 300+ GPS trucks, 120+ branches, 1,000+ people, 65,000+ moves a year. Every one earned move by move.
      </p>
      <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="#founder-story" class="btn-primary">Read Our Story</a>
        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="btn-ghost">Get in Touch</a>
      </div>
    </div>
  </div>
</section>

<!-- ── DIRECT ANSWER (AEO) ── -->
<section style="background:var(--white);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:40px;padding-bottom:40px">
    <div style="background:var(--surf);border-radius:var(--r14);padding:28px 32px;border-left:4px solid var(--red);max-width:860px">
      <p style="font-family:var(--fh);font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--red);margin-bottom:8px">Quick Answer</p>
      <p style="font-size:.97rem;color:var(--ink);line-height:1.8">
        <strong>Sure Shift Relocation Services</strong> is an ISO 9001:2015 and ISO 39001:2012 certified Indian packers and movers company founded in <strong>2023</strong> by Vikas Kumar, headquartered at P Block, Plot No. 131, Gopal Nagar Extension, Najafgarh, New Delhi. The company operates <strong>300+ GPS-enabled trucks</strong>, <strong>120+ owned branches</strong>, and <strong>1,000+ employees</strong>, completing <strong>65,000+ moves annually</strong> across <strong>1,700+ locations</strong> in India and coordinating international moves to <strong>88+ countries</strong>.
      </p>
    </div>
  </div>
</section>

<!-- ── STATS ── -->
<section style="background:var(--ink);padding:52px 0">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:repeat(6,1fr);gap:1px;background:rgba(255,255,255,.07);border-radius:var(--r16);overflow:hidden">
      <?php
      $stats = array(
        array('2023',   'Founded',             'M8 2v4 M16 2v4 M3 10h18 M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z'),
        array('300+',   'GPS-Enabled Trucks',  'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'),
        array('1,000+', 'Team Members',        'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2 M23 21v-2a4 4 0 00-3-3.87 M16 3.13a4 4 0 010 7.75'),
        array('120+',   'Owned Branches',      'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'),
        array('65K+',   'Annual Moves',        'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'),
        array('1,700+', 'Locations Served',    'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'),
      );
      foreach ($stats as $s): ?>
      <div class="stat-cell" style="padding:28px 14px;text-align:center;background:var(--ink)">
        <div class="stat-ico" style="margin:0 auto 10px">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($s[2]); ?>"/></svg>
        </div>
        <div class="stat-n"><?php echo esc_html($s[0]); ?></div>
        <div class="stat-l"><?php echo esc_html($s[1]); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FOUNDER STORY ── -->
<section class="sec" id="founder-story">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:72px;align-items:start">

      <!-- Left: images -->
      <div class="reveal">
        <div style="display:grid;grid-template-columns:3fr 2fr;gap:12px;align-items:end;line-height:0">
          <div style="position:relative;line-height:0">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=640&q=80&auto=format"
                 alt="Vikas Kumar, Founder of Sure Shift Relocation Services, Najafgarh Delhi"
                 loading="lazy"
                 class="lazy"
                 onload="this.classList.add('vis')"
                 style="width:100%;aspect-ratio:4/5;object-fit:cover;border-radius:var(--r20);display:block;opacity:0;transition:opacity .5s ease">
            <div style="position:absolute;bottom:-14px;left:-14px;background:var(--red);color:#fff;border-radius:var(--r14);padding:14px 18px;text-align:center;z-index:2">
              <strong style="display:block;font-family:var(--fh);font-size:1.6rem;font-weight:800;line-height:1">2023</strong>
              <span style="font-size:.65rem;opacity:.85;display:block;margin-top:2px">Year Founded</span>
            </div>
          </div>
          <div style="line-height:0">
            <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?w=360&q=75&auto=format"
                 alt="Sure Shift warehouse and storage facility"
                 loading="lazy"
                 class="lazy"
                 onload="this.classList.add('vis')"
                 style="width:100%;aspect-ratio:1;object-fit:cover;border-radius:var(--r14);display:block;opacity:0;transition:opacity .5s ease">
          </div>
        </div>
      </div>

      <!-- Right: story -->
      <div class="reveal" style="transition-delay:.1s">
        <div class="eyebrow">The Founder</div>
        <h2 class="h2" style="margin-bottom:18px">Why Vikas Kumar<br>Started Sure Shift</h2>

        <div style="display:flex;flex-direction:column;gap:16px;font-size:.92rem;color:var(--ink-60);line-height:1.85">
          <p>
            Vikas Kumar grew up in a military family — a childhood defined by frequent transfers, and with it, the particular exhaustion of packing up a life and rebuilding it somewhere new, again and again. That experience stayed with him.
          </p>
          <p>
            After completing his <strong style="color:var(--ink)">MBA in Logistics &amp; Supply Chain Management</strong>, Vikas built his career within the relocation industry itself, working with one of India's leading moving companies. From the inside, he saw the gap between what customers were promised and what they actually received: deliveries that arrived late, consignments that showed up damaged, no real way to track a shipment, and an industry still running on paper — handwritten inventories, manual bilty, error-prone paperwork.
          </p>
          <p>
            He didn't think the problem was the industry's difficulty. He thought it was the industry's indifference to fixing solvable problems.
          </p>
          <blockquote style="border-left:3px solid var(--red);padding-left:16px;margin:4px 0;font-family:var(--fh);font-size:.95rem;font-weight:600;color:var(--ink);line-height:1.5;font-style:italic">
            "Nobody should have to feel anxious about where their belongings are, or whether they'll arrive the way they left."
          </blockquote>
          <p>
            In <strong style="color:var(--ink)">2023</strong>, Vikas started Sure Shift — not with a fleet, but with market-hired trucks and a <strong style="color:var(--ink)">four-person team</strong> of packers and supervisors, operating out of Najafgarh, Delhi.
          </p>
        </div>

        <a href="#growth-story" style="display:inline-flex;align-items:center;gap:7px;margin-top:24px;font-family:var(--fh);font-size:.82rem;font-weight:600;color:var(--red)">
          Read how we grew
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- ── GROWTH STORY ── -->
<section class="sec sec-alt" id="growth-story">
  <div class="wrap">
    <div style="max-width:800px;margin:0 auto;text-align:center" class="reveal">
      <div class="eyebrow">How We Grew</div>
      <h2 class="h2" style="margin-bottom:14px">From 4 Packers to<br>India's Fastest-Growing Network</h2>
      <p class="lead" style="margin:0 auto 52px">Growth earned one well-executed move at a time — not bought through advertising.</p>
    </div>

    <!-- Timeline -->
    <div style="position:relative;max-width:700px;margin:0 auto">
      <div style="position:absolute;left:50%;top:0;bottom:0;width:2px;background:var(--line);transform:translateX(-50%)" aria-hidden="true"></div>
      <?php
      $timeline = array(
        array('2023 — Day One', 'Started with a 4-person team of packers and supervisors operating out of Najafgarh, Delhi — market-hired trucks, hands-on every single move.', 'left'),
        array('The First Principle', 'Every job done right became the reason for the next one. A satisfied customer referring a neighbor. A smooth corporate relocation leading to a second contract. A damage-free delivery turning a one-time client into a repeat one.', 'right'),
        array('Reinvestment Over Advertising', 'Instead of spending on advertising to chase growth, Sure Shift reinvested what it earned — into more trucks, more trained packers, more branches — only as fast as real, referral-driven demand justified it.', 'left'),
        array('Building Technology', 'Built an in-house ERP system with AI integration — the kind of real-time tracking and paperless accuracy that Vikas wished existed when he worked inside the industry.', 'right'),
        array('Today', '300+ GPS-enabled trucks. 1,000+ team members. 120+ owned branches. 65,000+ moves per year. 1,700+ locations served. Trusted by Flipkart, Pidge, Shadowfax, Freight IT, Ather Energy and Punjab &amp; Sind Bank.', 'left'),
      );
      foreach ($timeline as $i => $t):
        $is_left = $t[2] === 'left';
      ?>
      <div class="reveal" style="display:grid;grid-template-columns:1fr 40px 1fr;gap:0;margin-bottom:32px;align-items:start;transition-delay:<?php echo $i * .08; ?>s">
        <div style="<?php echo $is_left ? 'text-align:right;padding-right:24px' : 'grid-column:3;padding-left:24px'; ?>">
          <div style="background:#fff;border:1px solid var(--line);border-radius:var(--r12);padding:18px 20px;display:inline-block;text-align:left;max-width:280px;box-shadow:var(--shadow-card)">
            <div style="font-family:var(--fh);font-size:.76rem;font-weight:700;color:var(--red);margin-bottom:6px"><?php echo esc_html($t[0]); ?></div>
            <p style="font-size:.82rem;color:var(--ink-60);line-height:1.65"><?php echo esc_html($t[1]); ?></p>
          </div>
        </div>
        <div style="display:flex;justify-content:center;padding-top:18px;<?php echo !$is_left ? 'grid-column:2;grid-row:1' : ''; ?>">
          <div style="width:14px;height:14px;background:var(--red);border-radius:50%;border:3px solid #fff;box-shadow:0 0 0 2px var(--red);flex-shrink:0"></div>
        </div>
        <?php if ($is_left): ?><div></div><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── WHAT MAKES US DIFFERENT ── -->
<section class="sec">
  <div class="wrap">
    <div style="text-align:center;max-width:600px;margin:0 auto" class="sec-head reveal">
      <div class="eyebrow">Our Difference</div>
      <h2 class="h2">Why Businesses &amp; Families<br>Choose Sure Shift</h2>
      <p class="lead" style="margin:0 auto">We own our fleet, build our technology, and train every team member ourselves. No brokers. No middlemen. Full accountability.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">
      <?php
      $diffs = array(
        array(
          'Owned Fleet — Not a Broker',
          'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z',
          'We operate 300+ GPS-enabled trucks directly. Many "PAN India movers" are actually lead-aggregators who hand off to unknown local operators. Every Sure Shift truck is owned, tracked, and operated by our team — giving you full accountability from pickup to delivery.',
          'How does Sure Shift ensure delivery quality?'
        ),
        array(
          'Proprietary AI-Integrated ERP',
          'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
          'Our in-house ERP with AI integration handles every aspect of business operations — real-time GPS tracking, digital/paperless documentation, and AI-optimized dispatch. This means fewer errors, faster resolution, and complete transparency for every customer.',
          'How does Sure Shift track my shipment?'
        ),
        array(
          'Transparent Digital Documentation',
          'M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z M14 2v6h6 M9 13h6 M9 17h6',
          'We eliminated paper-based bilty, handwritten inventories, and manual paperwork that cause errors across the industry. Every move is documented digitally — accessible, verifiable, and error-free. We issue IBA Approved Partnered Bilty on every interstate consignment.',
          'What documentation does Sure Shift provide?'
        ),
        array(
          'Referral-Driven Growth',
          'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2 M23 21v-2a4 4 0 00-3-3.87 M16 3.13a4 4 0 010 7.75',
          'Our growth is built entirely on satisfied customers referring others — not advertising spend. That discipline earned the trust of major business partners including Flipkart, Pidge, Shadowfax, Freight IT, Ather Energy and Punjab &amp; Sind Bank.',
          'Who are Sure Shift\'s major clients?'
        ),
        array(
          'Dedicated Move Manager',
          'M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2 M12 11a4 4 0 100-8 4 4 0 000 8z',
          'Every client — household or corporate — gets one dedicated Move Manager assigned from booking through delivery. One person to call, one person accountable, zero confusion about who is responsible for your move.',
          'Who manages my move at Sure Shift?'
        ),
        array(
          'ISO 9001:2015 &amp; ISO 39001:2012 Certified',
          'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4',
          'Sure Shift holds active ISO 9001:2015 (Quality Management Systems) and ISO 39001:2012 (Road Traffic Safety Management) certifications — independently verified standards that confirm our processes, safety protocols, and service quality meet international benchmarks.',
          'Is Sure Shift ISO certified?'
        ),
      );
      foreach ($diffs as $d): ?>
      <div class="why-feat reveal" style="flex-direction:column;align-items:flex-start;gap:14px">
        <div class="why-feat-ico">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($d[1]); ?>"/></svg>
        </div>
        <div>
          <h3 style="font-family:var(--fh);font-size:.9rem;font-weight:700;color:var(--ink);margin-bottom:8px;line-height:1.3"><?php echo $d[0]; ?></h3>
          <p style="font-size:.82rem;color:var(--ink-60);line-height:1.7"><?php echo $d[2]; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CERTIFICATIONS & TRUST ── -->
<section class="sec sec-alt">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center">
      <div class="reveal">
        <div class="eyebrow">Certifications &amp; Trust</div>
        <h2 class="h2" style="margin-bottom:16px">Verified. Certified.<br>Accountable.</h2>
        <p style="font-size:.92rem;color:var(--ink-60);line-height:1.8;margin-bottom:28px">
          Every claim on this page is verifiable. We don't pad our credentials. Our certifications are real, our client partnerships are active, and our statistics are conservative — we'd rather under-promise and over-deliver.
        </p>
        <div style="display:flex;flex-direction:column;gap:14px">
          <?php
          $certs = array(
            array('ISO 9001:2015', 'Quality Management Systems — active certification confirming our processes meet international quality standards.','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4'),
            array('ISO 39001:2012', 'Road Traffic Safety Management — active certification covering our fleet operations and road safety protocols.','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4'),
            array('IBA Approved Partnered Bilty', 'We issue IBA Approved Partnered Bilty on interstate moves — legally certified documentation arranged via our certified partner network.','M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z M14 2v6h6 M9 13h6'),
            array('Sure Shift™ Trademark', 'Our brand name is a filed trademark — a confirmation of our identity and commitment to maintaining the Sure Shift standard.','M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5'),
          );
          foreach ($certs as $c): ?>
          <div style="display:flex;align-items:flex-start;gap:12px;padding:14px;background:#fff;border-radius:var(--r10);border:1px solid var(--line)">
            <div style="width:32px;height:32px;border-radius:var(--r6);background:var(--red-06);display:flex;align-items:center;justify-content:center;color:var(--red);flex-shrink:0">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo esc_attr($c[2]); ?>"/></svg>
            </div>
            <div>
              <strong style="font-size:.84rem;font-weight:600;color:var(--ink);display:block;margin-bottom:3px"><?php echo $c[0]; ?></strong>
              <p style="font-size:.76rem;color:var(--ink-60);line-height:1.55"><?php echo $c[1]; ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Trusted clients -->
      <div class="reveal" style="transition-delay:.1s">
        <div style="background:var(--white);border-radius:var(--r20);padding:36px;border:1px solid var(--line);box-shadow:var(--shadow-card)">
          <p style="font-family:var(--fh);font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-30);text-align:center;margin-bottom:24px">Trusted by Leading Businesses</p>
          <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px">
            <?php
            $clients = array('Flipkart','Pidge','Shadowfax','Freight IT','Ather Energy','Punjab & Sind Bank');
            foreach ($clients as $client): ?>
            <div style="background:var(--surf);border-radius:var(--r10);padding:14px 10px;text-align:center;border:1px solid var(--line)">
              <span style="font-family:var(--fh);font-size:.74rem;font-weight:700;color:var(--ink-60)"><?php echo esc_html($client); ?></span>
            </div>
            <?php endforeach; ?>
          </div>
          <p style="font-size:.76rem;color:var(--ink-30);text-align:center;line-height:1.6">
            Active partnerships confirmed across e-commerce, logistics, mobility, and banking. Trusted for large-scale relocation and fulfillment.
          </p>
          <div style="margin-top:22px;padding-top:20px;border-top:1px solid var(--line);text-align:center">
            <a href="<?php echo esc_url(home_url('/services/commercial-moving/')); ?>" style="font-family:var(--fh);font-size:.8rem;font-weight:600;color:var(--red);display:inline-flex;align-items:center;gap:5px">
              Corporate &amp; B2B Solutions
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── FAQ (AEO schema already in head) ── -->
<section class="sec">
  <div class="wrap">
    <div style="max-width:780px;margin:0 auto">
      <div class="sec-head reveal" style="text-align:center">
        <div class="eyebrow">FAQ</div>
        <h2 class="h2">Frequently Asked Questions<br>About Sure Shift</h2>
      </div>

      <?php
      $faqs = array(
        array(
          'When was Sure Shift founded?',
          'Sure Shift Relocation Services was founded in 2023 by Vikas Kumar in Najafgarh, New Delhi. The company started with a 4-person team and market-hired trucks, and has grown entirely through referral-driven demand into one of India\'s fastest-growing relocation networks.'
        ),
        array(
          'How many branches does Sure Shift have across India?',
          'Sure Shift operates 120+ owned branches across India, with offices serviceable across 1,700+ locations. These are owned branches — not franchise or partner locations — ensuring consistent quality and direct accountability across every city.'
        ),
        array(
          'Is Sure Shift ISO certified?',
          'Yes. Sure Shift holds active ISO 9001:2015 (Quality Management Systems) and ISO 39001:2012 (Road Traffic Safety Management) certifications. Both are real, verified certifications — not marketing claims.'
        ),
        array(
          'How many moves does Sure Shift complete per year?',
          'Sure Shift completes 65,000+ moves annually across India — a figure that reflects consistent, referral-driven volume rather than purchased growth.'
        ),
        array(
          'Does Sure Shift own its trucks or outsource?',
          'Sure Shift operates its own fleet of 300+ GPS-enabled containerised trucks. This is an owned-fleet model — not a broker or aggregator. Every truck is tracked, maintained, and operated directly by Sure Shift, which means full accountability from pickup to delivery.'
        ),
        array(
          'What is IBA Approved Partnered Bilty?',
          'An IBA (Indian Banks\' Association) Approved Bilty is a legally certified consignment document accepted by banks for insurance and transit claims. Sure Shift issues IBA Approved Partnered Bilty — arranged through our certified partner network — on all interstate consignments.'
        ),
        array(
          'Does Sure Shift do international moves?',
          'Yes. Sure Shift coordinates international relocations to 88+ countries via destination-agent partnerships. This means we handle the India end directly (packing, documentation, customs coordination) and work with verified partners at the destination country.'
        ),
        array(
          'Who is the founder of Sure Shift?',
          'Sure Shift was founded by Vikas Kumar, who holds an MBA in Logistics & Supply Chain Management and grew up in a military family that relocated frequently. He previously worked inside the relocation industry before starting Sure Shift in 2023 to fix the problems he saw firsthand — late deliveries, damage, no tracking, and paper-based errors.'
        ),
      );
      foreach ($faqs as $i => $faq): ?>
      <details class="reveal" style="border:1px solid var(--line);border-radius:var(--r10);overflow:hidden;margin-bottom:10px;transition-delay:<?php echo $i * .04; ?>s" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary itemprop="name" style="font-family:var(--fh);font-size:.9rem;font-weight:600;color:var(--ink);padding:16px 18px;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:12px;background:#fff;user-select:none">
          <?php echo esc_html($faq[0]); ?>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true" style="flex-shrink:0;transition:transform .2s ease"><path d="M6 9l6 6 6-6"/></svg>
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
<section style="background:var(--ink);padding:72px 0">
  <div class="wrap" style="text-align:center;max-width:600px;margin:0 auto">
    <div class="reveal">
      <div style="font-family:var(--fh);font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(219,38,72,.85);margin-bottom:12px;display:flex;align-items:center;justify-content:center;gap:8px">
        <span style="width:16px;height:2px;background:var(--red);border-radius:2px;display:inline-block"></span>
        Ready to Move?
      </div>
      <h2 style="font-family:var(--fh);font-size:clamp(1.7rem,3.5vw,2.6rem);font-weight:700;color:#fff;line-height:1.15;letter-spacing:-.025em;margin-bottom:14px">
        Experience the Sure Shift Difference
      </h2>
      <p style="font-size:.95rem;color:rgba(255,255,255,.48);line-height:1.75;margin-bottom:30px">
        Get a free, no-obligation quote in under 30 minutes. Available 24x7, 365 days a year.<br>One call. One dedicated move manager. Zero headaches.
      </p>
      <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
        <a href="<?php echo esc_url(home_url('/#quote')); ?>" class="btn-primary">Get Free Quote</a>
        <a href="tel:+919073291732" class="btn-ghost">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          09073291732
        </a>
      </div>
      <p style="font-size:.74rem;color:rgba(255,255,255,.28);margin-top:18px">
        ISO 9001:2015 &bull; ISO 39001:2012 &bull; IBA Approved Partnered Bilty &bull; 300+ GPS Trucks
      </p>
    </div>
  </div>
</section>

</main>

<style>
details[open] summary svg{transform:rotate(180deg)}
details summary::-webkit-details-marker{display:none}
@media(max-width:900px){
  #founder-story .wrap > div,
  .sec .wrap > div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;gap:40px!important}
  .sec .wrap > div[style*="grid-template-columns:repeat(3,1fr)"]{grid-template-columns:1fr 1fr!important}
}
@media(max-width:600px){
  .sec .wrap > div[style*="grid-template-columns:repeat(3,1fr)"]{grid-template-columns:1fr!important}
  .sec .wrap > div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important}
  #growth-story .wrap > div[style*="max-width:700px"] > div[style*="grid-template-columns:1fr 40px 1fr"]{grid-template-columns:28px 1fr!important}
  #growth-story .wrap > div[style*="max-width:700px"] > div > div:first-child{display:none}
}
</style>

<?php get_footer(); ?>
