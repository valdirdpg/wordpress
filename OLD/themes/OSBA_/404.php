<?php
get_header();
?>
<div class="site-error pb-5">
	<div class="container pb-5">
		<h1><?php esc_html_e( 'Not Found (#404)', 'twentytwentyone' ); ?></h1>

		<div class="alert pb-5">
			<?php esc_html_e( 'Página não encontrada. ' ); ?>
		</div>

		<p>
			Esse erro pode ter ocorrido devido a um problema de processamento na requisição do servidor.
		</p>
		<p>
			Por favor, aguarde um momento e tente novamente. Obrigado.
		</p>
	</div>
</div>
<?php get_footer(); ?>
