<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MultimedijalniSistemi
 */

?>
<style>
	.image-recipe{
		width: 100%;
		height: 350px;
	}
	.image-recipe img{
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() || 'wpll_recipe' === get_post_type()) :
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
	<?php
			$image = get_field('image');

			if (!empty($image)) {
			?>
				<div class="image-recipe">
					<img class="image" src="<?php echo $image; ?>" alt="slika recepta">
				</div>
			<?php } ?>
			<?php
			$image = get_field('slika');

			if (!empty($image)) {
			?>
				<div class="image-recipe">
					<img class="image" src="<?php echo $image; ?>" alt="slika recepta">
				</div>
			<?php } ?>
			<?php
			$tekst = get_field('tekst');

			if (!empty($tekst)) {
			?>
				<div class="preparation">
					<?php echo $tekst; ?>
				</div>
			<?php } ?>

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
			<?php
			$vreme_pecenja = get_field('vreme_pecenja');
			if (!empty($vreme_pecenja)) {
			?>
				<div class="baking-time">
					<h2>Vreme pecenja: <?php echo $vreme_pecenja; ?> min</h2>
				</div>
			<?php } ?>

			<?php
			$temperatura_pecenja = get_field('temperatura_pecenja');

			if (!empty($temperatura_pecenja)) {
			?>
				<div class="baking-temperature">
					<h2>Temperatura pečenja: <?php echo $temperatura_pecenja; ?>°C</h2>
				</div>
			<?php } ?>

		</div>
			<?php
			$ingredients = get_field('sastojak');
			if ($ingredients) {
				echo "<div class='ingredient'><h2 class='priprema'>Sastojci</h2>";
				$ingredient_list = explode(',', $ingredients);
				echo '<ul>';
				foreach ($ingredient_list as $ingredient) {
					echo '<li>' . esc_html(trim($ingredient)) . '</li>';
				}
				echo '</ul>';
				echo "</div>";
			}
			?>
			<?php
			$prep = get_field('priprema');
			if ($ingredients) {
				echo "<div class='preparation'><h2 class='priprema'>Priprema</h2><p>";
				echo get_field('priprema');
				echo "</p></div>";
			}
			?>
		
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
