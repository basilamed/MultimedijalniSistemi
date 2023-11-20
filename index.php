<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MultimedijalniSistemi
 */

get_header();
?>
<header class="page-header">
            <?php
            $header_image_url = get_header_image();
            if ($header_image_url) {
                echo '<img src=" ' . esc_url($header_image_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
            }
            ?>
            
</header>


<div class="naslov">	
	<h1>Inspiriši se i pripremi nešto dobro!</h1>
</div>
<main id="primary" class="site-main">

    <?php
    if (have_posts()) :

        if (is_home() && !is_front_page()) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
			
            <?php
        endif;
        
        /* Start the Loop */
        echo '<div class="article-container">';
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" class='index-class'>
                <?php
                if (has_post_thumbnail()) {
                    ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                            <?php the_post_thumbnail('custom-size'); ?>
                        </a>
                    </div>
                    <?php
                }
                ?>

                <header class="entry-header">
                    <?php the_title('<h2 class="entry-title" <a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                </header><!-- .entry-header -->

            </article><!-- #post-<?php the_ID(); ?> -->
        <?php
        endwhile;
        echo '</div>';

        the_posts_navigation();

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
