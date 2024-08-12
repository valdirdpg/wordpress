<?php
get_header();?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="page page-history">
		<div class="page-header">
			<h2 class="title page-title text-center"><?php the_title(); ?></h2>
		</div>
		<div class="page-content"> 
			<div class="row justify-content-center">
				<div class="col-sm-8">
					<?php
					if ( has_post_thumbnail() ) { ?>
						<img class="img-fluid pb-5 rounded mx-auto d-block" src="<?php the_post_thumbnail_url(); ?>">
					<?php } ?>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>