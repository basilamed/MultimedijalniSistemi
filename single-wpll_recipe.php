<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MultimedijalniSistemi
 */

get_header();
?>
<style>
    .nav-title{
        color: #ef4229;
        text-transform: uppercase;
    }
    .comments{
        border: 1px solid #ef4229;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
    }
</style>
<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
        // Display the post thumbnail at a specific size
        
        get_template_part('template-parts/content', get_post_type());

        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Prethodni:', 'multimedijalnisistemi') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Sledeći:', 'multimedijalnisistemi') . '</span> <span class="nav-title">%title</span>',
            )
        );
        // echo '<div class="comments">';
        //     // If comments are open or we have at least one comment, load up the comment template.
        //     if (comments_open() || get_comments_number()) :
        //         comments_template();
        //     endif;
        // echo '</div>';
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
