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
	define( '_S_VERSION', '1.5.0' );
}
function include_custom_post_types_in_category_archive($query) {
    if ($query->is_category && !is_admin()) {
        $query->set('post_type', array('post', 'wpll_recipe'));
    }
}
add_action('pre_get_posts', 'include_custom_post_types_in_category_archive');
function theme_customize_register($wp_customize) {
    $wp_customize->add_section('slider_section', array(
        'title' => 'Slider',
        'priority' => 30,
    ));

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('slider_image_'.$i, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'slider_image_'.$i, array(
            'label' => 'Image '.$i,
            'section' => 'slider_section',
            'settings' => 'slider_image_'.$i,
        )));

        $wp_customize->add_setting('slider_text_'.$i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('slider_text_'.$i, array(
            'label' => 'Text '.$i,
            'section' => 'slider_section',
            'type' => 'text',
        ));
    }
}
add_action('customize_register', 'theme_customize_register');

function enqueue_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');


add_filter( 'wp_footer', function ( ) {  ?>
	<script>
	document.querySelectorAll(".wp-slider")?.forEach( slider => {
		var src = [];
		var alt = [];
		var img = slider.querySelectorAll("img");
		img.forEach( e => { src.push(e.src);   if (e.alt) { alt.push(e.alt); } else { alt.push("image"); } })
		let i = 0;
		let image = "";
		let myDot = "";
		src.forEach ( e => { image = image + `<div class="wpcookie-slide" > <img decoding="async" loading="lazy" src="${src[i]}" alt="${alt[i]}" > </div>`; i++ })
		i = 0;
		src.forEach ( e => { myDot = myDot + `<span class="wp-dot"></span>`; i++ })
		let dotDisply = "none";
		if (slider.classList.contains("dot")) dotDisply = "block";    
		const main = `<div class="wp-slider">${image}<span class="wpcookie-controls wpcookie-left-arrow"  > <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35" height="35" color="#fff" style="enable-background:new 0 0 50 50" viewBox="0 0 512 512"><path d="M352 115.4 331.3 96 160 256l171.3 160 20.7-19.3L201.5 256z"/></svg> </span> <span class="wpcookie-controls wpcookie-right-arrow" > <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35" height="35" color="#fff" style="enable-background:new 0 0 50 50" viewBox="0 0 512 512"><path d="M180.7 96 352 256 180.7 416 160 396.7 310.5 256 160 115.4z"/></svg> </span> <div class="dots-con" style="display: ${dotDisply}"> ${myDot}</div></div> `       
		slider.insertAdjacentHTML("afterend",main  );
		slider.remove();
	})

	document.querySelectorAll(".wp-slider")?.forEach( slider => { 
	var slides = slider.querySelectorAll(".wpcookie-slide");
	var dots = slider.querySelectorAll(".wp-dot");
	var index = 0;
	slider.addEventListener("click", e => {if(e.target.classList.contains("wpcookie-left-arrow")) { prevSlide(-1)} } )
	slider.addEventListener("click", e => {if(e.target.classList.contains("wpcookie-right-arrow")) { nextSlide(1)} } )
	function prevSlide(n){
	  index+=n;
	  console.log("prevSlide is called");
	  changeSlide();
	}
	function nextSlide(n){
	  index+=n;
	  changeSlide();
	}
	changeSlide();
	function changeSlide(){   
	  if(index>slides.length-1)
		index=0;  
	  if(index<0)
		index=slides.length-1;  
		for(let i=0;i<slides.length;i++){
		  slides[i].style.display = "none";
		  dots[i].classList.remove("wpcookie-slider-active");      
		}
		slides[index].style.display = "block";
		dots[index].classList.add("wpcookie-slider-active");
	}
	 } )

	</script>

	<style>
	wp-slider * {
	padding = 0;
	margin = 0;
	}
	.wp-slider{
	  margin:0 auto;
	  position:relative;
	  overflow:hidden;
	}
	.wpcookie-slide{
	  max-height: 100%;
	  width:100%;
	  display:none;
	  animation-name:fade;
	  animation-duration:1s;
	}
	.wpcookie-slide img{
	 width:100%; 
	}
	@keyframes fade{
	  from{opacity:0.5;}
	  to{opacity:1;}
	}
	.wpcookie-controls{
	  position:absolute;
	  top:50%;
	  font-size:1.5em;
	  padding:15px 10px;
	  border-radius:5px;
	  background:white;
	  cursor: pointer;
	  transition: 0.3s all ease;
	  opacity: 15%;
	  transform: translateY(-50%);
	}
	.wpcookie-controls:hover{
	  opacity: 60%;
	}
	.wpcookie-left-arrow{
	  left:0px;
	   border-radius: 0px 5px 5px 0px;   
	}
	.wpcookie-right-arrow{
	  right:0px;
	 border-radius: 5px 0px 0px 5px;

	}
	.wp-slider svg {
		pointer-events: none;
	}
	.dots-con{
	  text-align:center;
	}
	.wp-dot{
	  display:inline-block;
	  background:#c4c4c4;
	  padding:8px;
	  border-radius:50%;
	  margin:10px 5px;
	}
	.wpcookie-slider-active{
	  background:#818181;
	}
	@media (max-width:576px){
	  .wp-slider{width:100%;
	  }  
	  .wpcookie-controls{
		font-size:1em;
		position: absolute;
		display: flex;
		align-items: center;
	  }  
	  .dots-con{
		display:none;
	  }
	}
	</style>
	<?php });
add_filter( 'wp_footer', function ( ) {  ?>
	<script>
	document.querySelectorAll(".wp-slider")?.forEach( slider => {
		var src = [];
		var alt = [];
		var img = slider.querySelectorAll("img");
		img.forEach( e => { src.push(e.src);   if (e.alt) { alt.push(e.alt); } else { alt.push("image"); } })
		let i = 0;
		let image = "";
		let myDot = "";
		src.forEach ( e => { image = image + `<div class="wpcookie-slide" > <img decoding="async" loading="lazy" src="${src[i]}" alt="${alt[i]}" > </div>`; i++ })
		i = 0;
		src.forEach ( e => { myDot = myDot + `<span class="wp-dot"></span>`; i++ })
		let dotDisply = "none";
		if (slider.classList.contains("dot")) dotDisply = "block";    
		const main = `<div class="wp-slider">${image}<span class="wpcookie-controls wpcookie-left-arrow"  > <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35" height="35" color="#fff" style="enable-background:new 0 0 50 50" viewBox="0 0 512 512"><path d="M352 115.4 331.3 96 160 256l171.3 160 20.7-19.3L201.5 256z"/></svg> </span> <span class="wpcookie-controls wpcookie-right-arrow" > <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35" height="35" color="#fff" style="enable-background:new 0 0 50 50" viewBox="0 0 512 512"><path d="M180.7 96 352 256 180.7 416 160 396.7 310.5 256 160 115.4z"/></svg> </span> <div class="dots-con" style="display: ${dotDisply}"> ${myDot}</div></div> `       
		slider.insertAdjacentHTML("afterend",main  );
		slider.remove();
	})
	
	document.querySelectorAll(".wp-slider")?.forEach( slider => { 
	var slides = slider.querySelectorAll(".wpcookie-slide");
	var dots = slider.querySelectorAll(".wp-dot");
	var index = 0;
	slider.addEventListener("click", e => {if(e.target.classList.contains("wpcookie-left-arrow")) { prevSlide(-1)} } )
	slider.addEventListener("click", e => {if(e.target.classList.contains("wpcookie-right-arrow")) { nextSlide(1)} } )
	function prevSlide(n){
	  index+=n;
	  console.log("prevSlide is called");
	  changeSlide();
	}
	function nextSlide(n){
	  index+=n;
	  changeSlide();
	}
	changeSlide();
	function changeSlide(){   
	  if(index>slides.length-1)
		index=0;  
	  if(index<0)
		index=slides.length-1;  
		for(let i=0;i<slides.length;i++){
		  slides[i].style.display = "none";
		  dots[i].classList.remove("wpcookie-slider-active");      
		}
		slides[index].style.display = "block";
		dots[index].classList.add("wpcookie-slider-active");
	}
	 } )
	
	</script>
	
	<style>
	wp-slider * {
	padding = 0;
	margin = 0;
	}
	.wp-slider{
	  margin:0 auto;
	  position:relative;
	  overflow:hidden;
	}
	.wpcookie-slide{
	  max-height: 100%;
	  width:100%;
	  display:none;
	  animation-name:fade;
	  animation-duration:1s;
	}
	.wpcookie-slide img{
	 width:100%; 
	}
	@keyframes fade{
	  from{opacity:0.5;}
	  to{opacity:1;}
	}
	.wpcookie-controls{
	  position:absolute;
	  top:50%;
	  font-size:1.5em;
	  padding:15px 10px;
	  border-radius:5px;
	  background:white;
	  cursor: pointer;
	  transition: 0.3s all ease;
	  opacity: 15%;
	  transform: translateY(-50%);
	}
	.wpcookie-controls:hover{
	  opacity: 60%;
	}
	.wpcookie-left-arrow{
	  left:0px;
	   border-radius: 0px 5px 5px 0px;   
	}
	.wpcookie-right-arrow{
	  right:0px;
	 border-radius: 5px 0px 0px 5px;
	 
	}
	.wp-slider svg {
		pointer-events: none;
	}
	.dots-con{
	  text-align:center;
	}
	.wp-dot{
	  display:inline-block;
	  background:#c4c4c4;
	  padding:8px;
	  border-radius:50%;
	  margin:10px 5px;
	}
	.wpcookie-slider-active{
	  background:#818181;
	}
	@media (max-width:576px){
	  .wp-slider{width:100%;
	  }  
	  .wpcookie-controls{
		font-size:1em;
		position: absolute;
		display: flex;
		align-items: center;
	  }  
	  .dots-con{
		display:none;
	  }
	}
	</style>
	<?php });
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

