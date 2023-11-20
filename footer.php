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
	h3{
		color : #fff;
	}
</style>

<footer id="footer" class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>About Us</h2>
                <p>Explore a world of delicious recipes. Cook, share, and enjoy the finest dishes with our curated collection of recipes.</p>
            </div>
            <div class="footer-section contact">
                <h2>Contact Us</h2>
                <p>Email: info@example.com</p>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                    <li>
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<p>Home</p>
						</a>
					</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom-bar">
        <div class="container">
            <p>&copy; 2023 WeCook. All Rights Reserved.</p>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
