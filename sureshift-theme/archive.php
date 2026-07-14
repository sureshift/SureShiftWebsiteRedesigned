<?php get_header();?>
<main id="main"><div class="wrap" style="padding:80px 0 96px">
<header style="margin-bottom:48px">
<div class="eyebrow"><?php echo is_category()?'Category':(is_tag()?'Tag':'Archive');?></div>
<h1 class="h2"><?php the_archive_title();?></h1>
<?php the_archive_description('<p class="lead">','</p>');?>
</header>
<div class="svc-grid">
<?php if(have_posts()):while(have_posts()):the_post();?>
<article <?php post_class('svc-card');?> style="padding:0">
<?php if(has_post_thumbnail()):?>
<div class="svc-img-wrap" style="aspect-ratio:16/9">
<div class="ske"></div>
<?php the_post_thumbnail('ss-card',array('class'=>'svc-img lazy','loading'=>'lazy','onload'=>"this.classList.add('vis');this.previousElementSibling.style.display='none'"));?>
</div>
<?php endif;?>
<div style="padding:16px 18px 20px">
<span style="font-size:.7rem;color:var(--ink-30)"><?php echo get_the_date();?></span>
<h2 style="font-family:var(--fh);font-size:.96rem;font-weight:700;color:var(--ink);margin:6px 0 9px;line-height:1.4"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
<p style="font-size:.82rem;color:var(--ink-60);line-height:1.65"><?php the_excerpt();?></p>
<a href="<?php the_permalink();?>" style="font-size:.79rem;font-weight:600;color:var(--red);display:inline-flex;align-items:center;gap:5px;margin-top:11px">Read More <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
</div>
</article>
<?php endwhile;else:?><p style="color:var(--ink-30)">No posts found.</p><?php endif;?>
</div>
<div style="margin-top:48px;text-align:center"><?php the_posts_pagination(array('mid_size'=>2));?></div>
</div></main>
<?php get_footer();?>
