<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
	<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
		<html <?php language_attributes(); ?>>
		<!--<![endif]-->
			<head>
				<meta charset="<?php bloginfo( 'charset' ); ?>" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

				<?php do_action( 'et_head_meta' ); ?>

				<meta name="author" content="Diego Fox">
				<meta name="developer" content="Diego Fox">
				<meta name="email" content="diego.fox001@gmail.com">

				<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

				<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( $template_directory_uri . '/js/html5.js"' ); ?>" type="text/javascript"></script>
<![endif]-->

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $template_directory_uri ); ?>/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( $template_directory_uri ); ?>/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( $template_directory_uri ); ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url( $template_directory_uri ); ?>/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( $template_directory_uri ); ?>/favicon-16x16.png">

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/bootstrap/css/bootstrap.css"' ); ?>">
	<script src="<?php echo get_bloginfo('template_directory');?>/bootstrap/js/bootstrap.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


	<!-- OSBA  -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/nocture.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/fontello.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/theme.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/style.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/animate.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/owl.theme.default.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/datepicker.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/css/menu/style1.css" rel="stylesheet">
	<link href="<?php echo esc_url( $template_directory_uri ); ?>/assets/bce7927/css/activeform.min.css" rel="stylesheet">

	<style> 
		@-webkit-keyframes loadingoverlay_animation__rotate_right { to { -webkit-transform : rotate(360deg); transform : rotate(360deg); } } @keyframes loadingoverlay_animation__rotate_right { to { -webkit-transform : rotate(360deg); transform : rotate(360deg); } } @-webkit-keyframes loadingoverlay_animation__rotate_left { to { -webkit-transform : rotate(-360deg); transform : rotate(-360deg); } } @keyframes loadingoverlay_animation__rotate_left { to { -webkit-transform : rotate(-360deg); transform : rotate(-360deg); } } @-webkit-keyframes loadingoverlay_animation__fadein { 0% { opacity   : 0; -webkit-transform : scale(0.1, 0.1); transform : scale(0.1, 0.1); } 50% { opacity   : 1; } 100% { opacity   : 0; -webkit-transform : scale(1, 1); transform : scale(1, 1); } } @keyframes loadingoverlay_animation__fadein { 0% { opacity   : 0; -webkit-transform : scale(0.1, 0.1); transform : scale(0.1, 0.1); } 50% { opacity   : 1; } 100% { opacity   : 0; -webkit-transform : scale(1, 1); transform : scale(1, 1); } } @-webkit-keyframes loadingoverlay_animation__pulse { 0% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } 50% { -webkit-transform : scale(1, 1); transform : scale(1, 1); } 100% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } } @keyframes loadingoverlay_animation__pulse { 0% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } 50% { -webkit-transform : scale(1, 1); transform : scale(1, 1); } 100% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } } 
	</style>

	
	<?php 
	global $post;
	$post_slug = $post->post_name;
	?>
	

</head>

<body <?php body_class(); ?>>
	<div id="mainWrapper" class="overflow-hidden">
		
		<?php //get_template_part( 'template-parts/header/site-header' ); ?>


		<!-- #mainHeader OSBA MENU -->
		<header id="mainHeader">
			<nav class="navbar navbar-expand navbar-light">
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $template_directory_uri ); ?>/imgs/logo-dark.svg" alt="Osba - Orquestra Sinfônica da Bahia">
				</a>
				<button id="trigger-overlay" type="button" class="btn btn-link ">
					<span class="navbar-toggler-icon"></span>
				</button>
				<ul class="navbar-nav navbar-nav-main">
					<li class="nav-item <?php if ( is_page('eventos') ) echo "active"; ?>">
						<a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>eventos">
							Programação 
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.amigostca.org.br/" target="_blank">
							ATCA
						</a>
					</li>
					<li class="nav-item nav-item-apoio <?php if ( is_page('apoie-a-osba') ) echo "active"; ?>">
						<a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>apoie-a-osba">Apoie</a>
					</li>
                    <li class="nav-item nav-item-blog <?php if ( is_page('blog') ) echo "active"; ?>">
                        <a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>blog">Blog</a>
                    </li>
				</ul>
				<ul class="navbar-nav navbar-nav-social d-none d-md-flex">
					<li class="nav-item">
						<a class="nav-link" href="https://www.facebook.com/OSBA.TCA/" target="_blank">
							<i class="icon-facebook"></i>
							</a
							>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://twitter.com/OSBA_TCA" target="_blank">
								<i class="icon-twitter">
								</i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://www.youtube.com/channel/UCVdO0C1V84b4Ei4m36qmUtw" target="_blank"><i class="icon-youtube-play">

							</i>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.instagram.com/orquestrasinfonicadabahia/" target="_blank">
							<i class="icon-instagram"></i>
						</a>
					</li>
				</ul>
				<div class="search-box">
					<a href="" class="btn btn-dark-color rounded-circle btn-search-toggle">
						<i class="icon-cancel-1"></i> 
						<i class="icon-search"></i>
					</a>
					<div class="form-search-box">						
						<form class="form-inline form-search" role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="input-group mb-3">							
							<input type="search" class="form-control" placeholder="Procurar por..." aria-label="search nico" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>">
							<button class="btn btn-outline-primary rounded-circle btn-search ml-auto" type="submit">OK</button>	
						</form>
					</div>
				</div>
			</nav>
		</header>
		<div class="menu-overlay overlay-hugeinc">
			<button type="button" class="overlay-close close">
				<i class="icon-cancel-1"></i>
			</button>
			<div class="menu-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<h3 class="title menu-title"> A orquestra </h3>
							<ul class="nav flex-column">
								<li class="nav-item <?php if ( is_page('historia') ) echo "active"; ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>historia" class="nav-link">História</a>
								</li>
								<li class="nav-header <?php if ( is_page('series') ) echo "active"; ?>">
									<h4 class="nav-title title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>series" class="nav-link">Séries</a>
									</h4>
								</li>

								<?php
								$args = array(
									'post_type' => 'serie',
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'orderby' => 'menu_order', 
									'order' => 'ASC'
								);
								$lastSeries = new WP_Query( $args );
								if($lastSeries->have_posts()){ 
									?>
									<?php while ( $lastSeries->have_posts() ) : $lastSeries->the_post(); ?>
										<?php 
										global $post;
										$post_slug = $post->post_name;
										?>
										<li class="nav-item <?php if ( is_single($post_slug) ) echo "active"; ?>">
											<a href="<?php the_permalink(); ?>" class="nav-link">
												<?php the_title(); ?> 
											</a>
										</li>
									<?php endwhile; ?>
								<?php } ?>

								<li class="nav-header <?php if ( is_page('projetos') ) echo "active"; ?>">
									<h4 class="nav-title title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>projetos" class="nav-link">Projetos</a>
									</h4>
								</li>

								<?php
								$args = array(
									'post_type' => 'projeto',
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'orderby' => 'menu_order', 
									'order' => 'ASC'
								);
								$lastProjetos = new WP_Query( $args );
								if($lastProjetos->have_posts()){ 
									?>
									<?php while ( $lastProjetos->have_posts() ) : $lastProjetos->the_post(); ?>
										<?php 
										global $post;
										$post_slug = $post->post_name;
										?>
										<li class="nav-item <?php if ( is_single($post_slug) ) echo "active"; ?>">
											<a href="<?php the_permalink(); ?>" class="nav-link"><?php the_title(); ?></a>
										</li>
									<?php endwhile; ?>
								<?php } ?>

							</ul>
						</div>
						<div class="col-md-4 col-sm-6">
							<h3 class="title menu-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>extensoes" class=""> Extensão.OSBA </a>
							</h3>
							<ul class="nav flex-column">
								<?php
								$args = array(
									'post_type' => 'extensao',
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'orderby' => 'menu_order', 
									'order' => 'ASC'
								);
								$lastExtensoes = new WP_Query( $args );
								if($lastExtensoes->have_posts()){ 
									?>
									<?php while ( $lastExtensoes->have_posts() ) : $lastExtensoes->the_post(); ?>
										<?php 
										global $post;
										$post_slug = $post->post_name;
										?>
										<li class="nav-item <?php if ( is_single($post_slug) ) echo "active"; ?>">
											<a href="<?php the_permalink(); ?>" class="nav-link"><?php the_title(); ?></a>
										</li>
									<?php endwhile; ?>
								<?php } ?>
							</ul>
							<h3 class="title menu-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>quem-somos" class=""> QUEM SOMOS </a>
							</h3>
							<ul class="nav flex-column">
								<li class="nav-item">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>quem-somos#maestro" class="nav-link">Regente titular</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>quem-somos#corpo-musicos" class="nav-link">Corpo de Músicos</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>quem-somos#equipe" class="nav-link">Equipe</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4 col-sm-6">
							<h3 class="title menu-title"> GALERIA </h3>
							<ul class="nav flex-column">
								<li class="nav-item <?php if ( is_page('galerias-de-imagens') ) echo "active"; ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>galerias-de-imagens" class="nav-link">Fotos</a>
								</li>
								<li class="nav-item <?php if ( is_page('galerias-de-videos') ) echo "active"; ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>galerias-de-videos" class="nav-link">Videos</a>
								</li>
								<li class="nav-item <?php if ( is_page('galerias-de-artes-graficas') ) echo "active"; ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>galerias-de-artes-graficas" class="nav-link">Arte Gráficas</a>
								</li>
							</ul>
							<h3 class="title menu-title mb-5">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>loja">Loja</a>
							</h3>
							<h3 class="title menu-title"> Contato </h3>
							<ul class="nav flex-column">
								<li class="nav-item">
									<a href="tel:+557131174834" class="nav-link">71 3117 4834</a>
								</li>
								<li class="nav-item">
									<a href="tel:+557131174842" class="nav-link">71 3117 4842</a>
								</li>
								<li class="nav-item">
									<a href="mailto:contato@osba.art.br" class="nav-link"> contato@osba.art.br</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<main id="mainContent">
