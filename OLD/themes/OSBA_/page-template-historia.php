<?php
/*
Template Name: HISTÓRIA
*/
get_header();?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="page page-history">
		<div class="page-header">
			<h2 class="title page-title text-center">A orquestra</h2>
		</div>
		<div class="parallax-window parallax-header" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>" data-speed="0.8" data-position-y="top" data-position-x="center" ></div>
		<div class="page-content">
			<article class="article article-aside">
				<div class="article-header article-header-aside">
					<h3 class="title article-title">História</h3>
					<ul class="nav nav-page-historia flex-column d-none d-md-flex">
						<li class="nav-item"><a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>projetos">Projetos</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>series">Séries</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>extensoes">Extensão</a></li>
					</ul>
				</div>
				<div class="article-content">
					<?php the_content(); ?>
				</div>
			</article>
		</div>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>