<?php
/*
Template Name: EVENTOS
*/
get_header();
?>
<div id="main-content">
	<div class="page page-events">
		<div class="page-header">
			<h2 class="title page-title text-center">Eventos</h2>
		</div>
		<!-- PAGE CONTENT -->
		<div class="entry-content">		
			<div class="row">
				<div class="col-sm-8 mx-auto pb-5">
					<?php echo do_shortcode('[fullcalendar type="evento"]'); ?>
				</div>
			</div>
		</div>
		<!-- / PAGE CONTENT -->
	</div> 
</div> <!-- #main-content -->
<?php get_footer(); ?>
