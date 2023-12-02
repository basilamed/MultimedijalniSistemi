<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MultimedijalniSistemi
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php 
		//we get the special post type
		$query_args_1 = array(
			'post_type' => 'wpll_recipe'
		);
		$query_1 = new WP_Query($query_args_1);
		$merged_query = new WP_Query();
		$merged_query->posts = array_merge($query_1->posts);
		if ($query_1->have_posts()) :
			while ($query_1->have_posts()) : $query_1->the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			wp_reset_postdata();
		else :
			echo 'No posts found';
		endif;
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
get_sidebar();
get_footer();
