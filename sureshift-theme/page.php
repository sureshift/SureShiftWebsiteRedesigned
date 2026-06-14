<?php get_header();?>
<main id="main"><div class="wrap" style="padding:80px 0 96px;max-width:860px">
<?php if(have_posts()):while(have_posts()):the_post();?>
<article id="post-<?php the_ID();?>" <?php post_class();?>>
<header style="margin-bottom:36px;padding-bottom:28px;border-bottom:1px solid var(--line)">
<div class="eyebrow">Page</div>
<h1 class="h2"><?php the_title();?></h1>
</header>
<div style="color:var(--ink-60);line-height:1.85;font-size:.97rem"><?php the_content();?></div>
</article>
<?php endwhile;endif;?>
</div></main>
<?php get_footer();?>
