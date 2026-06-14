<?php get_header(); ?>
<main id="main"><div class="wrap" style="padding:80px 0 96px">
<?php if(have_posts()):while(have_posts()):the_post();?>
<article id="post-<?php the_ID();?>" <?php post_class();?>>
<h1 class="h2" style="margin-bottom:24px"><?php the_title();?></h1>
<div style="color:var(--ink-60);line-height:1.85;max-width:780px"><?php the_content();?></div>
</article>
<?php endwhile;else:?><p style="color:var(--ink-30)">Nothing found.</p><?php endif;?>
</div></main>
<?php get_footer();?>
