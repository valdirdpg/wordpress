<?php
get_header();?>
<?php while ( have_posts() ) : the_post(); ?>
    <div class="page page-history">
        <div class="page-header">
            <h2 class="title page-title text-center"><?php the_title(); ?></h2>
        </div>
        <?php if (the_post_thumbnail()): ?>
            <div class="parallax-window parallax-header" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>" data-speed="0.8" data-position-y="top" data-position-x="center" ></div>
        <?php endif ?>       

        <div class="page-content">
            <article class="article article-aside">
                <div class="article-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>