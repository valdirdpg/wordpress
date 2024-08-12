<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );



		global $et_theme_image_sizes;

		$et_theme_image_sizes = array(
			'400x250'  => 'et-pb-post-main-image',
			'1080x675' => 'et-pb-post-main-image-fullwidth',
			'400x284'   => 'et-pb-portfolio-image',
			'510x382'   => 'et-pb-portfolio-module-image',
			'1080x9999' => 'et-pb-portfolio-image-single',
			'1800x1200' => 'slide',
			'720x720' => 'quadrado',
		);

		$et_theme_image_sizes = apply_filters( 'et_theme_image_sizes', $et_theme_image_sizes );
		$crop = apply_filters( 'et_post_thumbnails_crop', true );

		if ( is_array( $et_theme_image_sizes ) ){
			foreach ( $et_theme_image_sizes as $image_size_dimensions => $image_size_name ){
				$dimensions = explode( 'x', $image_size_dimensions );

				if ( in_array( $image_size_name, array( 'et-pb-portfolio-image-single' ) ) )
					$crop = false;

				add_image_size( $image_size_name, $dimensions[0], $dimensions[1], $crop );

				$crop = apply_filters( 'et_post_thumbnails_crop', true );
			}
		}

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_false' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
			/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
//Funções personalçizadas

function load_events() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 4;
    $args = array(
        'post_type' => 'evento',
        'posts_per_page' => $per_page,
        'paged' => $paged,

    );

    $eventos_query = new WP_Query($args);

    if ($eventos_query->have_posts()) {
        while ($eventos_query->have_posts()) : $eventos_query->the_post();
            $tipo_evento = get_field('tipo');
            $banner_class = $tipo_evento == 'Gratuito' ? 'banner-gratuito' : 'banner-pago';
            $banner_color = $tipo_evento == 'Gratuito' ? '#44996c' : '#0A246A';
            ?>
            <div class="ev-grid-item">
                <div class="ev-item">
                    <div class="ev-img-wrapper ev-events-img">
                        <picture>
                            <?php the_post_thumbnail('full', array('class' => 'ev-custom-img')); ?>
                        </picture>
                        <div class="ev-banner <?php echo $banner_class; ?>">
                            <span class="ev-banner-date"><?php echo date('d/m', strtotime(get_field('data'))); ?></span>
                            <span class="ev-banner-time"><?php echo date('H', strtotime(get_field('inicio'))); ?>h</span>
                        </div>
                        <div class="ev-horizontal-line" style="background-color: <?php echo $banner_color; ?>"></div>
                    </div>
                    <div class="ev-events-body ev-item-body">
                        <h2 class="ev-title ev-banner-title"><?php the_title(); ?></h2>
                        <div class="ev-content"><?php echo get_field('resumo'); ?></div>
                        <a href="<?php the_permalink(); ?>" class="ev-btn ev-btn-outline-secondary">saiba mais</a>
                        <?php if ($tipo_evento == 'Gratuito'){ ?>
                             <a href="<?php the_permalink(); ?>" class="ev-btn ev-btn-primary-grt">GRATUITO</a>
                        <?php } else{ ?>
                            <a href="<?php the_permalink(); ?>" class="ev-btn ev-btn-primary">COMPRAR INGRESSO</a>
                        <?php } ?>
                        <?php echo get_field('grupo_de_eventos'); ?>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    } else {
        echo '<p>Nenhum evento encontrado.</p>';
    }

    wp_reset_postdata();
    die();
}

function load_initial_data() {
    $args = array(
        'post_type' => 'evento',
        'posts_per_page' => -1, // Load all events for calendar
    );

    $eventos_query = new WP_Query($args);
    $eventos = array();

    if ($eventos_query->have_posts()) {
        while ($eventos_query->have_posts()) : $eventos_query->the_post();
            $eventos[] = array(
                'title' => get_the_title(),
                'date' => get_field('data'),
                'tipo' => get_field('tipo'),
                'grupo' => get_field('grupo_de_eventos')
            );
        endwhile;
    }

    echo json_encode(array('events' => $eventos));
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_load_events', 'load_events');
add_action('wp_ajax_nopriv_load_events', 'load_events');

add_action('wp_ajax_load_initial_data', 'load_initial_data');
add_action('wp_ajax_nopriv_load_initial_data', 'load_initial_data');

// Lista todos os eventos por ano e Mês a Mês

function load_events_for_month() {
    $month = intval($_POST['month']);
    $year = intval($_POST['year']);

    $events = []; // Array para armazenar eventos

    // Query para obter os eventos do mês e ano específicos
    $args = array(
        'post_type' => 'evento',
        'meta_query' => array(
            array(
                'key' => 'data',
                'value' => array($year . '-' . $month . '-01', $year . '-' . $month . '-31'),
                'compare' => 'BETWEEN',
                'type' => 'DATE'
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $events[] = array(
                'date' => get_field('data'),
                'title' => get_the_title(),
                'tipo' => get_field('tipo'),
                'grupo' => get_field('grupo'),
            );
        }
        wp_reset_postdata();
    }

    echo json_encode(['events' => $events]);
    wp_die();
}
add_action('wp_ajax_load_events_for_month', 'load_events_for_month');
add_action('wp_ajax_nopriv_load_events_for_month', 'load_events_for_month');


function load_events_year($year = null) {
    if (!$year) {
        $year = isset($_POST['year']) ? intval($_POST['year']) : date('Y');
    }

    // Array com os nomes dos meses em português
    $meses_portugues = array(
        'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
        'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'
    );

    $args = array(
        'post_type' => 'evento',
        'posts_per_page' => -1, // Carrega todos os eventos do ano
        'meta_key' => 'data', // Campo personalizado que contém a data
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_type' => 'DATE',
        'date_query' => array(
            array(
                'year' => $year,
            ),
        ),
    );

    $eventos_query = new WP_Query($args);

    ob_start(); // Inicia o buffer de saída

    if ($eventos_query->have_posts()) {
        $current_month = '';

        while ($eventos_query->have_posts()) : $eventos_query->the_post();
            $event_month_num = date('n', strtotime(get_field('data'))) - 1;
            $event_month_name = $meses_portugues[$event_month_num];

            if ($event_month_name != $current_month) {
                if ($current_month != '') {
                    echo '</div>'; // Fecha a div do mês anterior
                }
                echo '<h2 class="ev-month-title">' . ucfirst($event_month_name) . '</h2>';
                echo '<div id="ev-grid-' . $event_month_name . '" class="ev-custom-grid">';
                $current_month = $event_month_name;
            }
            ?>

            <div class="ev-grid-item">
                <div class="ev-item">
                    <div class="ev-img-wrapper ev-events-img">
                        <picture>
                            <?php the_post_thumbnail('full', array('class' => 'ev-custom-img')); ?>
                        </picture>
                    </div>
                    <div class="ev-events-body ev-item-body">
                        <h2 class="ev-title ev-banner-title"><?php the_title(); ?></h2>
                        <div class="ev-content"><?php echo get_field('resumo'); ?></div>
                        <a href="<?php the_permalink(); ?>" class="ev-btn ev-btn-outline-secondary">saiba mais</a>
                        <?php
                        $tipo_evento = get_field('tipo');
                        if ($tipo_evento == 'Gratuito') {
                            echo '<a href="' . get_permalink() . '" class="ev-btn ev-btn-primary-grt">GRATUITO</a>';
                        } else {
                            echo '<a href="' . get_permalink() . '" class="ev-btn ev-btn-primary">COMPRAR INGRESSO</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php
        endwhile;
        echo '</div>'; // Fecha a última div de eventos
    } else {
        echo '<div class="no-events-message"><p>Nenhum evento encontrado para o ano de ' . esc_html($year) . '.</p></div>';
    }

    wp_reset_postdata();

    $response = ob_get_clean(); // Captura o conteúdo gerado

    // Use die() se estiver respondendo a um pedido AJAX
    if (defined('DOING_AJAX') && DOING_AJAX) {
        echo $response;
        die();
    }

    return $response; // Retorna o conteúdo se não for AJAX
}


// Conecta a função ao AJAX
add_action('wp_ajax_load_events_year', 'load_events_year');
add_action('wp_ajax_nopriv_load_events_year', 'load_events_year');

//============FIM============//
function load_all_events() {
    $events = []; // Array para armazenar eventos

    // Consulta para obter todos os eventos
    $query = new WP_Query([
        'post_type' => 'evento',
        'posts_per_page' => -1, // Obtém todos os eventos
        'orderby' => 'date',
        'order' => 'ASC'
    ]);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $event = [
                'title' => get_the_title(),
                'description' => get_the_excerpt(),
                'date' => get_post_meta(get_the_ID(), 'event_date', true), // Ajuste conforme necessário
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                'tipo' => get_post_meta(get_the_ID(), 'event_tipo', true), // Ajuste conforme necessário
                'grupo' => get_post_meta(get_the_ID(), 'event_grupo', true) // Ajuste conforme necessário
            ];
            $events[] = $event;
        }
        wp_reset_postdata();
    }

    echo json_encode($events);
    wp_die();
}
add_action('wp_ajax_load_all_events', 'load_all_events');
add_action('wp_ajax_nopriv_load_all_events', 'load_all_events');


function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

// Adicionar a folha de estilos personalizada
if (!function_exists('osba_eventos_styles')) {
    function osba_eventos_styles() {
        wp_enqueue_style('osba-eventos', get_template_directory_uri() . '/css/osba-eventos.css', array(), '1.0', 'all');
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'osba_eventos_styles');
}

if (!function_exists('limit_words')) {
    function limit_words($text, $limit) {
        $text = wp_strip_all_tags($text);
        $words = explode(' ', $text);
        if (count($words) > $limit) {
            $text = implode(' ', array_slice($words, 0, $limit)) . '...';
        }
        return $text;
    }
}

function get_events_for_calendar() {
    $args = array(
        'post_type' => 'evento',
        'posts_per_page' => -1,
    );

    $eventos_query = new WP_Query($args);
    $eventos = array();

    if ($eventos_query->have_posts()) {
        while ($eventos_query->have_posts()) : $eventos_query->the_post();
            $eventos[] = array(
                'title' => get_the_title(),
                'date' => get_field('data'),
                'color' => get_field('color') // Supondo que você tenha um campo ACF chamado 'color'
            );
        endwhile;
    }

    wp_reset_postdata();

    return $eventos;
}

function add_events_to_calendar_script() {
    $eventos = get_events_for_calendar();
    wp_enqueue_script('calendar-script', get_template_directory_uri() . '/js/calendar.js', array('jquery'), '1.0', true);
    wp_localize_script('calendar-script', 'calendar_events', $eventos);
}

add_action('wp_enqueue_scripts', 'add_events_to_calendar_script');

//Fim 25/0//2024
/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
		if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
			document.body.classList.add( 'is-IE' );
		}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentytwentyone' );
	}
endif;


/* FOX */

/* Remove <br> do Contact Form 7 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/* Remove <span> do Contact Form 7 */
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});
