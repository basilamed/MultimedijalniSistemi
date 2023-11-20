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
	.slika{
		width: 100%;
		height: 400px;
		object-fit: cover;
	}
	.post-thumbnail{
		width: 100%;
		height: 400px;
	}
	.ingredient {
        font-weight: bold;
        color: #333;
    }

    .preparation {
        margin-top: 10px;
    }
	.priprema{
		font-weight: bold;
		background: linear-gradient(to right, #990000, #ff6600);
		padding: 10px;
		color: #fff;
		text-align: center;
	}

    .baking-time, .baking-temperature{
        margin-top: 10px;
        font-weight: bold;
        color: #990000; /* Dark red color */
    }
	.basic{
		display: flex;
		justify-content: space-around;
	}
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
				<h2>Vreme pecenja: <?php echo get_field('vreme_pecenja'); ?> min </h2>
			</div>
			<div class="baking-temperature">
				<h2>Temperatura pecenja: <?php echo get_field('temperatura_pecenja'); ?> c</h2>
			</div>
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
			<?php echo get_field('priprema'); ?>
		</div>
		
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'multimedijalnisistemi' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php multimedijalnisistemi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
