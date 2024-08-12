<?php 
get_header(); 
$template_directory_uri = get_template_directory_uri();
?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php 

	$descricao = get_field('descricao');
	$local = get_field('local');
	$tipo = get_field('tipo');
	$inicio = get_field('inicio');
	$final = get_field('final');
	$ingresso_inteira = get_field('ingresso_inteira');
	$ingresso_meia = get_field('ingresso_meia');
	$link = get_field('link');
	$unixtimestamp = strtotime( get_field('data') );

	?>
	<main id='mainContent'>
		<div class="page page-single page-event">
			<div class="page-header">
				<div class="page-header-content">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>eventos" class="back-button">
						<i class='icon-angle-left'></i> Voltar para Eventos</a>
						<h2 class="title page-title"><?php the_title(); ?></h2>
						<div class="description event-description">
							<?php echo $descricao; ?>
						</div>
					</div>
					<div class="featured-img">
						<div class="owl-carousel owl-theme owl-single-imgs olw-project-imgs owl-projects owl-loaded owl-drag">
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
					</div>
				</div>
				<div class="page-content">

					<article id="post-<?php the_ID(); ?>" class="article article-aside">
						<div class="article-header article-header-aside">
							<div class="event-age"> Classificação: Livre </div>
							<div class="event-infos">
								<h3 class="title title-where"><?php echo $local; ?></h3>
								<div class="event-date"> <?php echo date_i18n( "d/m/Y", $unixtimestamp ); ?> </div>
								<div class="event-time"> 
									<?php echo $inicio; ?> 
									<?php if($final) { echo "às"; } ?> 
									<?php echo $final; ?> 
								</div>
								<div class="event-type"> <?php echo $tipo; ?> </div>
								<div class="event-ticket">
									<h4>Ingressos</h4>
									<?php echo $ingresso_inteira; ?>
									<?php if($ingresso_meia) { echo "/"; } ?>
									<?php echo $ingresso_meia; ?> 
								</div>
								<a href="<?php echo $link; ?>" class="btn btn-primary btn-event" target="_blank">COMPRAR INGRESSO
								</a>
							</div>
						</div>
						<div class="article-content post-single-article-content">
							<div class="event-article-infos share d-flex">
								<div id="fb-root" class=" fb_reset">
									<div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
										<div></div>
									</div>
								</div>
								<div class="social-share ml-4">
									<a class="social-link" title="Facebbok" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>", target="_blank">
										<i class="icon-facebook"></i>
									</a>
									<a href="http://twitter.com/share" target="_blank" class="social-link" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="horizontal">
										<i class="icon-twitter"></i>
									</a>
								</div>
							</div>
							<p><?php the_content(); ?></p>
						</div>
					</article>



					<div class="other-posts other-projects py-5 mb-5">
						<h2 class="title other-post-title mb-4"> Veja também outros eventos</h2>
						<div class="container-fluid">
							<div class="row">

								<?php
								$args = array(
									'post_type' => 'evento',
									'post_status' => 'publish',
									'posts_per_page' => 4,
									'orderby' => 'menu_order', 
									'order' => 'ASC',
									'post__not_in' => array( $post->ID )
								);
								$lastProjects = new WP_Query( $args );
								if($lastProjects->have_posts()){ 
									?>
									<?php while ( $lastProjects->have_posts() ) : $lastProjects->the_post();
										$descricao = get_field('descricao');
										$ativo = get_field('ativo');
										$galeria = get_field('galeria');
										?>
										<div class="col-sm-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.0s">
											<div class="card-link card card-event">
												<a href="<?php the_permalink(); ?>" class='card-link link-img-fx'>
													<div class="img-wrapper serie-img card-img">
														<picture>
															<?php the_post_thumbnail( 'quadrado' ); ?>
														</picture>
													</div>
													<div class="card-body item-body">
														<h2 class='title card-title'><?php the_title(); ?></h2>
														<p class='card-discription'><?php echo $descricao; ?></p>
													</div>
												</a>
											</div>
										</div>
									<?php endwhile; ?>
								<?php } ?>			
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	<?php endwhile; ?>
	<?php get_footer(); ?>
