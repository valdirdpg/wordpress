<?php get_header(); ?>

<heade>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</heade>

<div class="single-post">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <h1><?php the_title(); ?></h1>
        <div class="post-meta">
            <span class="category"><?php the_category(', '); ?></span>
            <span class="author">Por <?php the_author(); ?></span>
            <span class="date"><?php echo get_the_date(); ?></span>
            <span class="reading-time"><?php echo do_shortcode('[tempo_de_leitura]'); ?></span>
        </div>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
