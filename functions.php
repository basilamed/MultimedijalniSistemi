<?php
/**
 * MultimedijalniSistemi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MultimedijalniSistemi
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.7.0' );
}
function theme_custom_styles() {
    $menu_bg_color = get_theme_mod('menu_bg_color', '#ef4229');
    ?>
    <style>
        .your-menu-class {
            background-color: <?php echo esc_attr($menu_bg_color); ?>;
        }
    </style>
    <?php
}
function include_custom_post_types_in_category_archive($query) {
    if ($query->is_category && !is_admin()) {
        $query->set('post_type', array('post', 'wpll_recipe'));
    }
}
add_action('pre_get_posts', 'include_custom_post_types_in_category_archive');

function enqueue_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function multimedijalnisistemi_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on MultimedijalniSistemi, use a find and replace
		* to change 'multimedijalnisistemi' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'multimedijalnisistemi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'multimedijalnisistemi' ),
			'footer_menu' => esc_html__( 'Footer', 'multimedijalnisistemi' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'multimedijalnisistemi_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	add_image_size('custom-size', 450, 300, false);
	//add_image_size('custom', 650, 400, true);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'multimedijalnisistemi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function multimedijalnisistemi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'multimedijalnisistemi_content_width', 640 );
}
add_action( 'after_setup_theme', 'multimedijalnisistemi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_modify_recent_posts_query($args) {
    $args['post_type'] = array('post', 'wpll_recipe');
    return $args;
}
function multimedijalnisistemi_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'weCook Sidebar', 'multimedijalnisistemi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'multimedijalnisistemi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'weCook Sidebar 2', 'multimedijalnisistemi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'multimedijalnisistemi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'weCook Sidebar 3', 'multimedijalnisistemi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'multimedijalnisistemi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( 
		array(
			'name'			=> 'Footer Sidebar 1',
			'id'			=> 'we-cook-sidebar-footer1',
			'description'	=> 'Drag and drop your widgets here',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) 
	);
	register_sidebar( 
		array(
		'name'			=> 'Footer Sidebar 2',
		'id'			=> 'we-cook-sidebar-footer2',
		'description'	=> 'Drag and drop your widgets here',
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
		) 
	);
	register_sidebar( 
		array(
		'name'			=> 'Footer Sidebar 3',
		'id'			=> 'we-cook-sidebar-footer3',
		'description'	=> 'Drag and drop your widgets here',
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
		)
	);	
}
add_action( 'widgets_init', 'multimedijalnisistemi_widgets_init' );

function create_posttype() {
	register_post_type( 'wpll_recipe',
	  array(
		'labels' => array(
		  'name' => __( 'Recipes' ),
		  'singular_name' => __( 'Recipe' )
		),
		'public' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'recipes'),
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
	  )
	);
  }
  add_action( 'init', 'create_posttype' );
  
/**
 * Enqueue scripts and styles.
 */
function multimedijalnisistemi_scripts() {
	wp_enqueue_style( 'multimedijalnisistemi-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'multimedijalnisistemi-style', 'rtl', 'replace' );

	wp_enqueue_script( 'multimedijalnisistemi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'multimedijalnisistemi_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
//newsletter form 
function custom_newsletter_form() {
    ob_start(); ?>
    <div class="custom-newsletter-form">
        <h2>Subscribe to Our Newsletter</h2>
        <form id="custom-newsletter-form" method="post">
            <input type="email" name="email" placeholder="Your Email" required>
            <button type="submit">Subscribe</button>
        </form>
        <div class="custom-newsletter-message"></div>
    </div>
    <style>
        .custom-newsletter-form {
            margin: 0 auto;
        }
        .custom-newsletter-form h2 {
            margin-bottom: 20px;
        }
        .custom-newsletter-form input {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .custom-newsletter-form button {
            padding: 10px;
            background-color: #ef4229;
            color: #fff;
            border: none;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }
        .custom-newsletter-message {
            margin-top: 20px;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_newsletter_form', 'custom_newsletter_form');

// Handle form submission
function custom_newsletter_form_handler() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
        $email = sanitize_email($_POST["email"]);
        if (is_email($email)) {
            // Send welcome email
            $subject = 'Welcome to Our Newsletter!';
            $message = 'Thank you for subscribing to our newsletter!';
            $headers = 'From: Halida i Basila <cistije.sutra@gmail.com>';

            wp_mail($email, $subject, $message, $headers);
            // For demonstration purposes, we'll just return a success message
            echo json_encode(array('success' => true, 'message' => 'Thank you for subscribing!'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid email address!'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid request!'));
    }
    exit();
}

add_action('wp_ajax_custom_newsletter_form_submit', 'custom_newsletter_form_handler');
