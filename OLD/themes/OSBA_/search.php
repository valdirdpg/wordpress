<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

if ( have_posts() ) {
	?>
	<header class="page-header alignwide">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: Search term. */
				esc_html__( 'Results for "%s"', 'twentytwentyone' ),
				'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</header><!-- .page-header -->

	<div class="other-posts other-projects mb-5">
		<h4 class="title other-post-title mb-4">
			<?php
			printf(
				esc_html(
					/* translators: %d: The number of search results. */
					_n(
						'Foi encontrado %d resultado para a sua pesquisa.',
						'Foram encontrados %d resultados para a sua pesquisa.',
						(int) $wp_query->found_posts,
						'twentytwentyone'
					)
				),
				(int) $wp_query->found_posts
			);
			?>
		</h4>
		<div class="container-fluid">
			<div class="row">
				<?php $counter = -1;
				while (have_posts()) : the_post(); $counter++ ?>
					<article id="post-<?php the_ID(); ?>" class="col-sm-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.<?=2 * $counter?>s">
						<div class="card-link card card-serie">
							<a href="<?php the_permalink(); ?>" class='card-link link-img-fx'>
								<div class="img-wrapper serie-img card-img">
									<picture>
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('quadrado', array('class' => 'img-fluid'));
										}
										else {
											echo '<img class="img-fluid" src="' . get_bloginfo( 'stylesheet_directory' ) 
											. '/imgs/noimage/600x600.jpg" />';
										}
										?>
									</picture>
								</div>
								<div class="card-body item-body">
									<h2 class='title card-title'><?php the_title(); ?></h2>
									<p class='card-discription'><?php the_excerpt(); ?></p>
								</div>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php twenty_twenty_one_the_posts_navigation(); ?>
		</div>
	</div>
<?php } else { ?>
	<?php get_template_part('404'); ?>
<?php } ?>
<?php get_footer(); ?>
