<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if (is_front_page()): ?>
<meta name="description" content="Sure Shift — India's most trusted packers &amp; movers since 1987. Household, office, international &amp; vehicle relocations across 664+ locations.">
<link rel="canonical" href="<?php echo esc_url(home_url('/')); ?>">
<?php else: ?>
<link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>">
<?php endif; ?>
<link rel="icon" href="https://sureshift.in/wp-content/uploads/2025/02/logo.a27ef0b398a2f4fa34b8.png" type="image/png">
<link rel="apple-touch-icon" href="https://sureshift.in/wp-content/uploads/2025/02/logo.a27ef0b398a2f4fa34b8.png">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-nav" href="#main">Skip to content</a>

<header class="site-header" id="siteHeader">
  <div class="nav-wrap">

    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo" aria-label="Sure Shift — Home">
      <img src="https://sureshift.in/wp-content/uploads/2025/02/logo.a27ef0b398a2f4fa34b8.png"
           alt="Sure Shift" height="36"
           onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
      <span class="logo-text-fallback">Sure<em>Shift</em></span>
    </a>

    <nav class="nav-menu" aria-label="Primary navigation">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <a href="<?php echo esc_url(home_url('/about-us/')); ?>">About</a>
      <a href="#services">Services</a>
      <a href="#tracking">Tracking</a>
      <a href="<?php echo esc_url(home_url('/pay-online/')); ?>" class="nav-pay">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        Pay Online
      </a>
      <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact</a>
    </nav>

    <div class="nav-actions">
      <a href="tel:+919073291732" class="nav-phone">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        <span>09073291732</span>
      </a>
      <a href="#quote" class="btn-primary">Free Quote</a>
      <button class="nav-burger" id="navBurger" aria-label="Open menu" aria-expanded="false" aria-controls="navPanel">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div>
</header>

<div class="nav-backdrop" id="navBackdrop" aria-hidden="true"></div>
<nav class="nav-panel" id="navPanel" aria-hidden="true" aria-label="Mobile navigation">
  <div class="nav-panel-head">
    <img src="https://sureshift.in/wp-content/uploads/2025/02/logo.a27ef0b398a2f4fa34b8.png" alt="Sure Shift" height="28">
    <button class="nav-panel-close" id="navPanelClose" aria-label="Close menu">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <div class="nav-panel-links">
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
    <a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a>
    <a href="#services">Services</a>
    <a href="#tracking">Track Shipment</a>
    <a href="<?php echo esc_url(home_url('/pay-online/')); ?>" class="nav-panel-pay">Pay Online</a>
    <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact</a>
  </div>
  <div class="nav-panel-foot">
    <a href="#quote" class="btn-primary" style="width:100%;justify-content:center;border-radius:10px;">Get Free Quote</a>
    <a href="tel:+919073291732" class="nav-panel-call">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
      09073291732
    </a>
  </div>
</nav>
