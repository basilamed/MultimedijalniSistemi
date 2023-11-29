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
                <h2>O nama</h2>
                <p>Istražite svet ukusnih recepata. Kuvajte, delite i uživajte u najfinijim jelima uz našu pažljivo odabranu kolekciju recepata.</p>
            </div>
            <div class="footer-section contact">
                <h2>Kontaktirajte nas</h2>
                <p>Email: info@primer.com</p>
            </div>
            <div class="footer-section links">
                <h2>Brze veze</h2>
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_menu',
                        'menu_class'     => 'your-menu-class-footer', // Dodajte prilagođenu klasu za stilizovanje menija
                    ));
                ?>
                <!-- <ul>
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <p>Početna</p>
                        </a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
    <div class="bottom-bar">
        <div class="container">
            <p>&copy; 2023 WeCook. Sva prava zadržana.</p>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>