<?php
/*
Template Name: ARTES
*/
get_header();
$template_directory_uri = get_template_directory_uri();
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="page page-gallaery">
		<div class="page-header">
			<h2 class="title page-title text-center"><?php the_title(); ?></h2>
		</div>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">	
					<?php
					$args = array(
						'post_type' => 'arte',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'menu_order', 
						'order' => 'ASC',
						'post__not_in' => array( $post->ID )
					);
					$lastProjects = new WP_Query( $args );
					if($lastProjects->have_posts()){ 
						?>
						<?php while ( $lastProjects->have_posts() ) : $lastProjects->the_post();
							$images = get_field('galeria');
							?>
							<div class="col-md-4 col-lg-3 col-sm-6">
								<div class="card-link card card-gallery">
									<a class="cursor-pointer" data-toggle="modal" data-target="#myModal-<?php echo $post->ID; ?>">	
										<div class="img-wrapper serie-img card-img">
											<?php the_post_thumbnail('quadrado'); ?>
										</div>
										<div class="card-header">
											<h3 class="card-title"><?php the_title(); ?></h3>
										</div>
									</a>
								</div>
							</div>
							<!-- Modal -->
							<div id="myModal-<?php echo $post->ID; ?>" class="modal fade" role="dialog" aria-labelledby="galleyModalAlbum" aria-hidden="true">
								<div class="modal-dialog modal-full-screen modal-gallery" role="document">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header text-center">
											<h5 class="modal-title" id="galleyModalAlbum"><?php the_title(); ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="owl-carousel owl-theme owl-single-imgs olw-project-imgs owl-projects owl-loaded owl-drag">
												<div class="owl-stage-outer">
													<div class="owl-stage">					
														<?php 
														$images = get_field('galeria');
														foreach( $images as $image_id ): ?>
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
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- PAGE CONTENT -->    
	</div>
	<!-- PAGE -->
<?php endwhile; ?>
<?php get_footer(); ?>