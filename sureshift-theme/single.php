<?php get_header();?>
<main id="main"><div class="wrap" style="padding:80px 0 96px;max-width:780px">
<?php if(have_posts()):while(have_posts()):the_post();?>
<article id="post-<?php the_ID();?>" <?php post_class();?> itemscope itemtype="https://schema.org/BlogPosting">
<?php if(has_post_thumbnail()):?>
<div style="border-radius:var(--r20);overflow:hidden;margin-bottom:36px;position:relative">
<div class="ske" style="position:absolute;inset:0;border-radius:0"></div>
<?php the_post_thumbnail('ss-hero',array('style'=>'width:100%;height:auto;display:block;position:relative;z-index:1','loading'=>'eager','itemprop'=>'image'));?>
</div><?php endif;?>
<header style="margin-bottom:32px">
<div style="display:flex;align-items:center;gap:14px;margin-bottom:10px;flex-wrap:wrap">
<span class="eyebrow" style="margin-bottom:0"><?php the_category(', ');?></span>
<span style="font-size:.75rem;color:var(--ink-30)"><time datetime="<?php echo get_the_date('c');?>" itemprop="datePublished"><?php echo get_the_date();?></time> &middot; <?php echo ceil(str_word_count(get_the_content())/200);?> min read</span>
</div>
<h1 class="h2" itemprop="headline"><?php the_title();?></h1>
</header>
<div style="color:var(--ink-60);line-height:1.9;font-size:.97rem" itemprop="articleBody"><?php the_content();?></div>
<footer style="margin-top:48px;padding-top:24px;border-top:1px solid var(--line)">
<?php the_tags('<p style="font-size:.78rem;color:var(--ink-30);margin-bottom:18px">Tags: ','  ','</p>');?>
<div style="display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap">
<?php
$prev=get_previous_post();$next=get_next_post();
if($prev) echo '<a href="'.get_permalink($prev).'" style="font-size:.83rem;font-weight:600;color:var(--ink);display:flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>'.get_the_title($prev).'</a>';
if($next) echo '<a href="'.get_permalink($next).'" style="font-size:.83rem;font-weight:600;color:var(--ink);display:flex;align-items:center;gap:6px;margin-left:auto">'.get_the_title($next).'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>';
?>
</div>
</footer>
</article>
<?php endwhile;endif;?>
</div></main>
<?php get_footer();?>
