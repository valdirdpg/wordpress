
</main> <!-- #mainContent -->

<?php $template_directory_uri = get_template_directory_uri(); ?>


<!-- Footer OSBA -->
<footer id="mainFooter" class="main-footer">
	<div class="text-right container-fluid">
		<a href="#mainHeader" id="backToTop" class="back-to-top ">Voltar ao Topo <span class="circle-outline">
			<i class="icon-up-open">

			</i>
		</span>
	</a>
</div>
<div class="container-fluid d-md-flex mt-5">
	<div class="logo-footer">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( $template_directory_uri ); ?>/imgs/logo-white.svg" alt="OSBA - Orquestra SInfônica da Bahia" width="180">
		</a>
	</div>
	<div class="footer-btns">
		<a href="https://www.amigostca.org.br/" target="_blank" class="btn btn-outline-light">ATCA</a>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>apoie-a-osba" class="btn btn-outline-light">Apoie</a>
	</div>
	<div class="ml-auto footer-social"> Siga a OSBA nas Redes Sociais 
		<div class="social-links-footer d-lg-inline-block">
			<a class="" href="https://www.facebook.com/OSBA.TCA/" target="_blank">
				<i class="icon-facebook">

				</i>
			</a>
			<a class="" href="https://twitter.com/OSBA_TCA" target="_blank">
				<i class="icon-twitter"></i>
			</a>
			<a class="" href="https://www.youtube.com/channel/UCVdO0C1V84b4Ei4m36qmUtw" target="_blank">
				<i class="icon-youtube-play"></i>
			</a>
			<a class="" href="https://www.instagram.com/orquestrasinfonicadabahia/ " target="_blank">
				<i class="icon-instagram"></i>
			</a>
		</div>
	</div>
</div>
<div class="container-fluid">
  <div class="d-flex brands-ruler" style="display: flex; justify-content: <?php echo wp_is_mobile() ? 'center' : 'flex-end'; ?>;">
    <?php
    // Obtém o ID da Página Home
    $home_page_id = get_option('page_on_front');

    // Obtém o valor do campo ACF "marcas" da Página Home
    $marcas_img_url = get_field('marcas', $home_page_id);

    // Verifica se o campo ACF tem valor antes de exibir a imagem
    if ($marcas_img_url) {
      echo '<img src="' . esc_url($marcas_img_url) . '" alt="Marcas" class="img-fluid" style="max-width: 527px; width: 100%;">';
    }
    ?>
  </div>
</div>


</footer>




</div> <!-- #mainWrapper -->
<?php wp_footer(); ?>

<!-- OSBA -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/datepicker.min.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/i18n/datepicker.pt-BR.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/parallax.min.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/wow.min.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/menu/classie.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/menu/demo1.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/main.js"></script>

<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/site/index.js"></script>

<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/site/projetos.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/site/series.js"></script>

<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/parallax.min.js"></script>
<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/site/quem-somos.js"></script>

<script src="<?php echo esc_url( $template_directory_uri ); ?>/js/site/galerias-de-imagens.js"></script>

</body>
</html>
