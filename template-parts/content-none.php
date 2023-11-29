<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MultimedijalniSistemi
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Ništa nije pronađeno', 'multimedijalnisistemi' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) :

            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __( 'Spremni da postavite prvu obajavu? <a href="%1$s">Započnite ovde</a>.', 'multimedijalnisistemi' ),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url( admin_url( 'post-new.php' ) )
            );

        elseif ( is_search() ) :
            ?>

            <p><?php esc_html_e( 'Izvinjavamo se, ali ništa ne odgovara vašim kriterijumima pretrage. Pokušajte ponovo sa nekim drugim ključnim rečima.', 'multimedijalnisistemi' ); ?></p>
            <?php
            get_search_form();

        else :
            ?>

            <p>
                <?php esc_html_e( 'Čini se da ne možemo pronaći ono što tražite. Možda pretraga može pomoći.', 'multimedijalnisistemi' ); ?>
            </p>
            <?php
            get_search_form();

        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
