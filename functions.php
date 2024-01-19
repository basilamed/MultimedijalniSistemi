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
function red_registration_form($atts) {
	$atts = shortcode_atts( array(
	   'role' => 'subscriber', 		
   ), $atts, 'register' );
   
$role_number = $atts["role"];
if ($role_number == "shop_manager" ) { $reg_form_role = (int) filter_var(AUTH_KEY, FILTER_SANITIZE_NUMBER_INT); }  elseif ($role_number == "customer" ) { $reg_form_role = (int) filter_var(SECURE_AUTH_KEY, FILTER_SANITIZE_NUMBER_INT); } elseif ($role_number == "contributor" ) { $reg_form_role = (int) filter_var(NONCE_KEY, FILTER_SANITIZE_NUMBER_INT); } elseif ($role_number == "author" ) { $reg_form_role = (int) filter_var(AUTH_SALT, FILTER_SANITIZE_NUMBER_INT); } elseif ($role_number == "editor" ) { $reg_form_role = (int) filter_var(SECURE_AUTH_SALT, FILTER_SANITIZE_NUMBER_INT); }   elseif ($role_number == "administrator" ) { $reg_form_role = (int) filter_var(LOGGED_IN_SALT, FILTER_SANITIZE_NUMBER_INT); } else { $reg_form_role = 1001; } 
   
   if(!is_user_logged_in()) { 
	   $registration_enabled = get_option('users_can_register');
	   if($registration_enabled) {
		   $output = red_registration_fields($reg_form_role);
	   } else {
		   $output = __('<p>User registration is not enabled</p>');
	   }
	   return $output;
   }  $output = __('<p>You already have an account on this site, so there is no need to register again.</p>');
   return $output;
}
add_shortcode('register', 'red_registration_form');

function red_registration_fields($reg_form_role) {	?> 
<?php
   ob_start();
   ?>	
	   <form id="red_registration_form" class="red_form" action="" method="POST">
			   <?php red_register_messages();	 ?>
			   <p>
				   <label for="red_user_login"><?php _e('Username'); ?></label>
				   <input name="red_user_login" id="red_user_login" class="red_input" placeholder="Username" type="text"/>
			   </p>
			   <p>
				   <label for="red_user_email"><?php _e('Email'); ?></label>
				   <input name="red_user_email" id="red_user_email" class="red_input" placeholder="Email" type="email"/>
			   </p>
			   <p>
				   <label for="red_user_first"><?php _e('First Name'); ?></label>
				   <input name="red_user_first" id="red_user_first" type="text" placeholder="First Name" class="red_input" />
			   </p>
			   <p>
				   <label for="red_user_last"><?php _e('Last Name'); ?></label>
				   <input name="red_user_last" id="red_user_last" type="text" placeholder="Last Name" class="red_input"/>
			   </p>
			   <p>
				   <label for="password"><?php _e('Password'); ?></label>
				   <input name="red_user_pass" id="password" class="red_input" placeholder="Password" type="password"/>
			   </p>
			   <p>
				   <label for="password_again"><?php _e('Confirm Password'); ?></label>
				   <input name="red_user_pass_confirm" id="password_again" placeholder="Password Again" class="red_input" type="password"/>
			   </p>
			   <p>
	   <input type="hidden" name="red_csrf" value="<?php echo wp_create_nonce('red-csrf'); ?>"/>
	   <input type="hidden" name="red_role" value="<?php echo $reg_form_role; ?>"/>
	   <input type="submit" value="<?php _e('Register Now'); ?>"/>
			   </p>
		   
	   </form>
	   <style>
			.red_form {
			width: 450px !important;
			max-width: 95% !important;
			padding: 30px 20px;
			box-shadow: 0px 0px 20px 0px #00000012, 0px 50px 40px -50px #00000038;
			background-color: #f9f9f9;
			border-radius: 8px;
			margin: 20px auto;
			}

			.red_form p {
			margin-bottom: 15px;
			}

			.red_form label {
			display: block;
			font-size: 16px;
			margin-bottom: 5px;
			color: #333;
			}

			.red_input {
			width: 100%;
			padding: 10px;
			font-size: 14px;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-sizing: border-box;
			}

			.red_input:focus {
			outline: none;
			border-color: #6dabe4;
			box-shadow: 0 0 5px rgba(109, 171, 228, 0.5);
			}

			.red_errors {
			color: #ee0000;
			margin-bottom: 12px;
			width: 450px !important;
			max-width: 95% !important;
			}

			.red_form label::after {
			content: " *";
			color: red;
			font-weight: bold;
			}

			.red_form input[type="submit"] {
			background-color: #ef4229;
			color: white;
			padding: 12px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			}

			.red_form input[type="submit"]:hover {
			background-color: #45a049;
			}

			@media (max-width: 600px) {
			.red_form {
				width: 100% !important;
			}
			}
		</style>

   <?php
   return ob_get_clean();
}

