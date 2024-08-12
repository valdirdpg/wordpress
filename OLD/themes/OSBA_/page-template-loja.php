<?php
/*
Template Name: LOJA
*/
get_header();

$template_directory_uri = get_template_directory_uri();
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="page page-gallaery">
		<div class="page-header">
			<h2 class="title page-title text-center">Lojinha da Osba</h2>
			<p><?php the_content(); ?></p> 
		</div>

		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<?php $index = 0; ?>
					<?php  if( have_rows('loja') ): while( have_rows('loja') ) : the_row();
						$imagem = get_sub_field('imagem');
						$titulo = get_sub_field('titulo');
						$tamanho = get_sub_field('tamanho'); 
						$valor = get_sub_field('valor'); 
						?>


						<div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.<?=2 * $index?>s">
							<div class="card-link card card-loja">						
								<div class="img-wrapper card-img">
									<picture>
										<img src="<?php echo $imagem; ?>" alt="<?php echo $titulo; ?>" class='img-fluid'>
									</picture>
								</div>

								<div class="card-body">
									<h3 class="card-title"><?php echo $titulo; ?></h3>
									<dl>
										<?php if ($tamanho): ?>
											<dt>Tamanhos:</dt>
											<dd><?php echo $tamanho; ?></dd>											
										<?php endif ?>

										<?php if ($valor): ?>
											<dt>Valor:</dt>
											<dd><?php echo $valor; ?></dd>
										<?php endif ?>
										
									</dl>
								</div>						
							</div>
						</div>
						<?php $index++; ?>
					<?php endwhile; endif; ?>




				</div><!-- /ROW -->
			</div>		

		</div>
		<!-- PAGE CONTENT -->    
	</div>
	<!-- PAGE -->
<?php endwhile; ?>
<?php get_footer(); ?>