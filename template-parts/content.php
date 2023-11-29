<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MultimedijalniSistemi
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				multimedijalnisistemi_posted_on();
				multimedijalnisistemi_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php
	if (has_post_thumbnail()) {
		echo '<div class="post-thumbnail">';
		echo get_the_post_thumbnail(get_the_ID(), 'custom-size', array('class' => 'slika', 'alt' => 'food'));
		echo '</div>';
	}
	?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'multimedijalnisistemi' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
		<div class="basic">
			<div class="baking-time">
				<h2>Vreme pripreme: <?php echo get_field('vreme_pecenja'); ?> min </h2>
			</div>

			<?php
			$temperatura_pecenja = get_field('temperatura_pecenja');

			// Check if the field is not empty before displaying it
			if (!empty($temperatura_pecenja)) {
			?>
				<div class="baking-temperature">
					<h2>Temperatura pečenja: <?php echo $temperatura_pecenja; ?>°C</h2>
				</div>
			<?php } ?>
		</div>
		
		<div class="ingredient">
			<h2 class='priprema'>Sastojci</h2>
			<?php
				$ingredients = get_field('sastojak');
				if ($ingredients) {
					$ingredient_list = explode(',', $ingredients);
					echo '<ul>';
					foreach ($ingredient_list as $ingredient) {
						echo '<li>' . esc_html(trim($ingredient)) . '</li>';
					}
					echo '</ul>';
				}		
			?>
		</div>
		
		<div class="preparation">
			<h2 class='priprema'>Priprema</h2>
			<p><?php echo get_field('priprema'); ?></p>
		</div>
		
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Stranice:', 'multimedijalnisistemi' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php multimedijalnisistemi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
