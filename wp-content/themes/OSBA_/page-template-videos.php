<?php
/*
Template Name: VIDEOS
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
						'post_type' => 'video',
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
							$video = get_field('video');
							?>
							<div class="col-md-4 col-lg-6 col-sm-12">
								

								<div class="embed-container">
									<?php echo $video; ?>
								</div>
								<div class="card-header">
									<h3 class="card-title"><?php the_title(); ?></h3>
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