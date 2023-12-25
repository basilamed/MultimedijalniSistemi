<?php
/**
 * Plugin Name:       Theme Colors
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Basila
 * description:       This is a custom plugin that adds a color picker for the theme colors to the customizer
 */
//remove the admin bar
function theme_customize($wp_customize) {
    // Add a section for colors
    $wp_customize->add_section('theme_colors', array(
        'title' => __('Theme Colors', 'your-theme-slug'),
        'priority' => 30,
    ));

    // Add a setting for background color
    $wp_customize->add_setting('background_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add a control for background color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
        'label' => __('Background Color', 'your-theme-slug'),
        'section' => 'theme_colors',
    )));

    // Add a setting for text color
    $wp_customize->add_setting('text_color', array(
        'default' => '#ef4229',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add a control for text color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
        'label' => __('Main Theme Color', 'your-theme-slug'),
        'section' => 'theme_colors',
    )));

	// Add a setting for text color
    $wp_customize->add_setting('gradient_color_first', array(
        'default' => '#990000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add a control for text color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gradient_color_first', array(
        'label' => __('First Gradient Color', 'your-theme-slug'),
        'section' => 'theme_colors',
    )));

	// Add a setting for text color
    $wp_customize->add_setting('gradient_color_second', array(
        'default' => '#ff6600',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add a control for text color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gradient_color_second', array(
        'label' => __('Second Gradient Color', 'your-theme-slug'),
        'section' => 'theme_colors',
    )));
}
add_action('customize_register', 'theme_customize');
function theme_custom() {
    $background_color = get_theme_mod('background_color', '#ffffff');
	$color = get_theme_mod('text_color', '#ef4229');
	$gradient_color_first = get_theme_mod('gradient_color_first', '#990000');
	$gradient_color_second = get_theme_mod('gradient_color_second', '#ff6600');
    ?>
    <style>
        body {
            background-color: <?php echo esc_attr($background_color); ?>;
        }
		.nav-title{
        	color: <?php echo esc_attr($color); ?>;
		}
		.comments{
			border: 1px solid <?php echo esc_attr($color); ?>;
		}
		a {
			color: <?php echo esc_attr($color); ?>;
		}
		.your-menu-class {
			background-color: <?php echo esc_attr($color); ?>;
		}
		.mobile-menu {
			background-color: <?php echo esc_attr($color); ?>;
		}
		.menu-toggle {
			background-color: <?php echo esc_attr($color); ?>;
		}
		.your-menu-class ul {
			background-color: <?php echo esc_attr($color); ?>;
		}
		.entry-title{
			color: <?php echo esc_attr($color); ?>;
		}
		.site-footer{
			background-color: <?php echo esc_attr($color); ?>;
		}
		.priprema{
			background: linear-gradient(to right, <?php echo esc_attr($gradient_color_first); ?> , <?php echo esc_attr($gradient_color_second); ?>);
		}

		.baking-time, .baking-temperature{
			color: <?php echo esc_attr($color); ?>;
		}
    </style>
    <?php
}

add_action('wp_head', 'theme_custom');
?>