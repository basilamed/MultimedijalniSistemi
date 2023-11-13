<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MultimedijalniSistemi
 */

?>
<style>
	.site-footer{
		background-color: #ef4229;
		position: absolute;
		bottom: 0;
		width: 100%;
		color: #fff;
		padding: 0 20px;
	}
	.site-info{
		margin: auto;
		display: flex;
		justify-content: center;
		
	}
	h3{
		color : #fff;
	}
</style>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<h3>Home</h3>
			</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
