
<article id="post-<?php the_ID(); ?>" class="col-sm-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.<?=2 * $index?>s">
	<div class="card-link card card-serie">
		<a href="<?php the_permalink(); ?>" class='card-link link-img-fx'>
			<div class="img-wrapper serie-img card-img">
				<picture>
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('quadrado', array('class' => 'img-fluid'));
					}
					else {
						echo '<img class="img-fluid" src="' . get_bloginfo( 'stylesheet_directory' ) 
						. '/imgs/noimage/600x600.jpg" />';
					}
					?>
				</picture>
			</div>
			<div class="card-body item-body">
				<h2 class='title card-title'><?php the_title(); ?> - <?php echo $cont; ?></h2>
				<p class='card-discription'><?php the_excerpt(); ?></p>
			</div>
		</a>
	</div>
</article>

