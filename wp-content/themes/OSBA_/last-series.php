<?php
$args = array(
	'post_type' => 'serie',
	'post_status' => 'publish',
	'posts_per_page' => 3,
	'orderby' => 'menu_order', 
	'order' => 'ASC',
);
$lastSeries = new WP_Query( $args );
if($lastSeries->have_posts()){ 
	?>
	<div class="last-series">
		<div class="last-series-wrapper">
			<div class="owl-carousel owl-theme owl-series owl-loaded owl-drag">
				<div class="owl-stage-outer">
					<div class="owl-stage">
						<?php while ( $lastSeries->have_posts() ) : $lastSeries->the_post();
							$descricao = get_field('descricao');
							$ativo = get_field('ativo');
							$galeria = get_field('galeria');
							?>
							<div class="owl-item">
								<div class="item">
									<div class="img-wrapper serie-img">
										<picture>
											<?php the_post_thumbnail( 'slide' ); ?>
										</picture>
									</div>
									<div class="serie-body item-body">
										<h3 class="title category-title">Séries</h3>
										<h2 class="title banner-title"><?php the_title(); ?></h2>
										<a href="<?php the_permalink(); ?>" class="btn btn-outline-secondary">Saiba mais sobre</a>
									</div>
								</div>
							</div>	
						<?php endwhile; ?>		
					</div>
				</div>
				<div class="owl-dots disabled"></div>
			</div>
		</div>
	</div>
	<?php } ?>
	