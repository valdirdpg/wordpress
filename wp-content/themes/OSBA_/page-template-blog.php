<?php
/*
Template Name: APOIE
*/
get_header();

?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="page  page-support page-single-post">
		<div class="page-content">
			<!-- MAESTRO -->
			<article class="article post-single-article">
				<!-- ARTICLE CONTENT -->
				<div   class="article-content">
					<section class="section-support">
						<!-- SECTION HEADER -->
						<div class="section-header ">
							<h2 class="title section-title"><?php the_title(); ?></h2>
						</div>
						<!-- /SECTION HEADER -->
						<div class="section-content">
							<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
							<?php the_content(); ?>
						</div>
					</section>			
					<?php  if( have_rows('section-support') ): while( have_rows('section-support') ) : the_row();
						$section_title = get_sub_field('section-title');
						$section_content = get_sub_field('section-content'); ?>
						<section class="section-support">
							<!-- SECTION HEADER -->
							<div class="section-header ">
								<h2 class="title section-title"><?php echo $section_title; ?></h2>
							</div>
							<!-- /SECTION HEADER -->
							<div class="section-content">
								<?php echo $section_content; ?>
							</div>
						</section>
					<?php endwhile; endif; ?>
				</div>
				<!-- /ARTICLE CONTENT -->
			</article>
			<!-- /MAESTRO -->
		</div>
		<!-- PAGE CONTENT -->
	</div>
	<!-- PAGE -->
<?php endwhile; ?>
<?php get_footer(); ?>