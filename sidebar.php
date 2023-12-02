<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MultimedijalniSistemi
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	
	<?php  
		//FIXME
		// Modify the recent posts widget query to include custom post types
		add_filter('widget_posts_args', 'custom_modify_recent_posts_query');

		the_widget('WP_Widget_Recent_Posts');

		// Remove the filter to avoid affecting other queries
		remove_filter('widget_posts_args', 'custom_modify_recent_posts_query');
		
	dynamic_sidebar( 'sidebar-1' ); ?>
	
</aside><!-- #secondary -->
