<?php
/*
Template Name: QUEM SOMOS
*/
$template_directory_uri = get_template_directory_uri();
get_header();?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="page  page-history">
		<div class="page-header">
			<h2 class="title page-title text-center">Quem Somos</h2>
		</div>
		<div id="maestro" class="parallax-window  parallax-middle" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>" data-speed="0.5" data-position-y="top" data-position-x="right" ></div>
		<div class="page-content">
			<!-- MAESTRO -->
			<article class="article">
				<!-- ARTICLE HEADER -->
				<div class="article-header ">
					<h3 class="title article-title">O Maestro</h3>
				</div>
				<!-- /ARTICLE HEADER -->

				<!-- ARTICLE CONTENT -->
				<div   class="article-content">
					<?php the_content(); ?>
				</div>
				<!-- /ARTICLE CONTENT -->

			</article>
			<!-- /MAESTRO -->
			<div id="corpo-musicos">
				<?php 
				$categories = get_terms('categoria_instrumento');
				foreach ($categories as $category): ?>
					<div class="section-musicians <?php echo $category->slug; ?>">
						<div class="section-header">
							<h3 class='title musicians-title'><?php echo $category->name; ?></h3> 
						</div>
						<div class="musicians-wrapper">
							<div class="container-fluid">
								<div class="row justify-content-center flex-wraper">
									<?php $index = 0; ?>
									<?php 
									$posts = get_posts(array(
										'post_type' => 'musico',
										'orderby' => 'menu_order',
										'order' =>  'DESC',
										'taxonomy' => $category->taxonomy,
										'term'  => $category->slug,
										'nopaging' => true,
									));
									foreach ($posts as $post):
										setup_postdata($post); 
										?>
										<div class="col-lg-4 col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="0.<?=2 * $index?>s">
											<div class="musician musician-item ">
												<h4 class='title musician-instument-title'><?php the_field('instrumento'); ?></h4>
												<div class="image-holder musician-picture">					
													<?php
													if ( has_post_thumbnail() ) {
														the_post_thumbnail('quadrado', array('class' => 'img-fluid'));
													}
													else {
														echo '<img class="img-fluid" src="' . get_bloginfo( 'stylesheet_directory' ) 
														. '/imgs/noimage/600x600.jpg" />';
													}
													?>
												</div>
												<div class="musician-body">
													<h4 class='title musician-name-title'><?php the_title(); ?></h4> 
													<?php the_field('resumo'); ?>
												</div>
												<div class="action-area text-center mt-4">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $post->ID; ?>">
														Bio Completa
													</button>
												</div>
											</div>
										</div>
										<!-- The Modal -->
										<div class="modal fade modal-musician" id="myModal<?php echo $post->ID; ?>"  tabindex="-1" role="dialog" aria-labelledby="musicianModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-xl" role="document">
												<div class="modal-content">
													<div class="modal-header border-0">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="image-holder musician-picture">
															<?php
															if ( has_post_thumbnail() ) {
																the_post_thumbnail('quadrado', array('class' => 'img-fluid'));
															}
															else {
																echo '<img class="img-fluid" src="' . get_bloginfo( 'stylesheet_directory' ) 
																. '/imgs/noimage/600x600.jpg" />';
															}
															?>
														</div>
														<h5 class="modal-title" id="musicianModalLabel" style="text-transform: uppercase; margin: 2rem 0; text-align: center;">
															<?php the_title(); ?>
														</h5>
														<?php the_content(); ?>
													</div>
												</div>
											</div>
										</div>
										<?php $index++; ?>
									<?php endforeach; ?>						
								</div>
								<!-- /row-->
							</div>
							<!-- /container-fluid-->
						</div>
					</div>
				<?php endforeach; ?>
			</div>		
			<!-- FICHA TÉCNICA -->
			<div id="equipe" class="section-musicians datasheet">
				<div class="section-header">
					<h3 class='title musicians-title'>Ficha Técnica <br> Equipe</h3> 
				</div>
				<div class="datasheet-content">
					<?php
					$args = array(
						'post_type' => 'ficha',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'menu_order', 
						'order' => 'ASC'
					);
					$ficha = new WP_Query( $args );
					if($ficha->have_posts()){ 
						?>
						<?php while ( $ficha->have_posts() ) : $ficha->the_post();
							$subtitulo = get_field('subtitulo');
							$nomes = get_field('nomes');
							?>
							<div class="datasheet-item">
								
								<h4 class="title datasheet-title"><?php the_title(); ?></h4>								

								<?php if ($subtitulo): ?>
									<h5 class="title title-cargo-name"><?php echo $subtitulo; ?></h5>
								<?php endif ?>							
								
								<div class="datasheet-name"><?php echo $nomes; ?></div>
							</div>
						<?php endwhile; ?>
					<?php } ?>
				</div>
			</div>
			<!-- /FICHA TÉCNICA -->
		</div>
		<!-- PAGE CONTENT -->
	</div>
	<!-- PAGE --> 
<?php endwhile; ?>
<?php get_footer(); ?>