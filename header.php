<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MultimedijalniSistemi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'multimedijalnisistemi' ); ?></a>

	<header class="site-header">
	<div class="site-header-logo">
	<?php
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
			<img src="<?php echo $image[0]; ?>" alt="Logo" class="logo">
		</a>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
		<?php
			wp_nav_menu(array(
				'theme_location' => 'menu-1',
				'menu_class'     => 'your-menu-class', // Add a custom class to style the menu
			));
		?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
  </header><!-- .site-header -->
 