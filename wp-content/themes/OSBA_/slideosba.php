<?php
$args = array(
	'post_type' => 'slide_home',
	'post_status' => 'publish',
	'posts_per_page' => 5,
	'orderby' => 'menu_order', 
	'order' => 'ASC',
);
$slideHome = new WP_Query( $args );
if($slideHome->have_posts()){ 
	?>
	<div class="banner-highlights">
		<div class="owl-carousel owl-theme owl-banner-highlights owl-loaded owl-drag">
			<div class="owl-stage-outer">
				<div class="owl-stage">			
					<?php while ( $slideHome->have_posts() ) : $slideHome->the_post();
						$link = get_field('link');
						$texto = get_field('texto');
						?>
						<div class="owl-item">
							<div class="item">
								<div class="img-wrapper banner-img">
									<?php if ($link) { ?>
										<a href="<?php echo $link; ?>">
										<?php } ?>
										<?php the_post_thumbnail( 'slide' ); ?>
										<?php if ($link) { ?>
										</a>
									<?php } ?>
								</div>
								<div class="banner-body item-body">
									<h2 class="title banner-title">
										<?php if ($link) { ?>
											<a href="<?php echo $link; ?>">
											<?php } ?>
											<?php the_title(); ?>
											<?php if ($link) { ?>
											</a>
										<?php } ?>
									</h2>
									<p class="banner-discription">										
										<?php if ($link) { ?>
											<a href="<?php echo $link; ?>">
											<?php } ?>
											<?php echo $texto; ?>
											<?php if ($link) { ?>
											</a>
										<?php } ?>
									</p>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	