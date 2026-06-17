<?php get_header();?>
<main id="main">
<div class="wrap" style="text-align:center;padding:120px 24px;max-width:500px;margin:0 auto">
<div style="font-family:var(--fh);font-size:5.5rem;font-weight:800;color:var(--line);line-height:1;margin-bottom:8px">404</div>
<div class="eyebrow" style="justify-content:center">Page Not Found</div>
<h1 class="h2" style="margin-bottom:12px">Oops! Wrong Turn.</h1>
<p style="color:var(--ink-60);font-size:.97rem;line-height:1.7;margin-bottom:32px">The page you are looking for has moved or does not exist. Let us help you get back on track.</p>
<div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
<a href="<?php echo esc_url(home_url('/'));?>" class="btn-primary"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Back to Home</a>
<a href="<?php echo esc_url(home_url('/contact-us/'));?>" class="btn-soft">Contact Us</a>
</div>
<div style="margin-top:48px;padding:22px;background:var(--surf);border-radius:var(--r14);border:1px solid var(--line)">
<p style="font-size:.82rem;color:var(--ink-60);margin-bottom:10px">Need help right now?</p>
<a href="tel:+919073291732" style="font-family:var(--fh);font-size:1.2rem;font-weight:700;color:var(--red);display:flex;align-items:center;justify-content:center;gap:8px">
<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
09073291732
</a>
</div>
</div>
</main>
<?php get_footer();?>
