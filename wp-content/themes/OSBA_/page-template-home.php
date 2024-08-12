<?php
/*
Template Name: HOME
*/

get_header();
$template_directory_uri = get_template_directory_uri();
?>



<div id="main-content">
	
	<div class="container-fluid p-0">

		<?php get_template_part('slideosba'); ?>

		<?php get_template_part('last-events'); ?>

		<?php get_template_part('last-projects'); ?>

		<?php get_template_part('last-series'); ?>

		<?php get_template_part('newsletter'); ?>

	</div> <!-- .container -->

</div> <!-- #main-content -->



<?php get_footer(); ?>