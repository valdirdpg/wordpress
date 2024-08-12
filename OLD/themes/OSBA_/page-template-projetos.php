<?php
/*
Template Name: PROJETOS
*/
get_header();?>
<div class="page page-posts page-projects">
	<div class="page-header">
		<h2 class="title page-title">Projetos</h2>
	</div>
	<div class="page-content">
		<?php
		$args = array(
			'post_type' => 'projeto',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'menu_order', 
			'order' => 'ASC',
		);
		$lastProjects = new WP_Query( $args );
		if($lastProjects->have_posts()){ 
			?>
			<?php while ( $lastProjects->have_posts() ) : $lastProjects->the_post();
				$descricao = get_field('descricao');
				$ativo = get_field('ativo');
				$galeria = get_field('galeria');
				?>

				<div class="project-post project-post-abstract post-abstract post">
					<div class="project-post-wrapper">
						<!-- Caroussel de  post -->
						<div class="owl-carousel owl-theme owl-project-imgs olw-carousel-imgs owl-loaded owl-drag">
							<div class="owl-stage-outer">
								<div class="owl-stage">
									<?php 
									$images = get_field('galeria');
									$size = 'slide'; 
									if( $images ){ ?>

										<?php foreach( $images as $image_id ): ?>
											<div class="owl-item">
												<div class="item">
													<div class="img-wrapper project-img">
														<picture>
															<?php echo wp_get_attachment_image( $image_id, $size ); ?>
														</picture>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									<?php } else { ?>
										
										<div class="owl-item">
											<div class="item">
												<div class="img-wrapper project-img">
													<picture>
														<?php the_post_thumbnail( 'slide' ); ?>
													</picture>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>								
							</div>
						</div>
						<!-- /Caroussel de  PROJETOS -->
						<div class="project-content post-content post-abstract-content">
							<div class="project-header post-header post-abstract-header">
								<h2 class='title post-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<div class="project-body post-body post-abstract-body">
								<p><?php the_field('descricao'); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn btn-outline-secondary">Saiba mais sobre</a>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php } ?>
	</div> 
</div>
<?php get_footer(); ?>