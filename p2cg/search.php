<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="container containerPadding productPage">
    <section class="txtSection sections">
        <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?php if ( have_posts() ) : ?>
                            <h2><?php printf( __( 'Suchergebnisse für: %s', 'myclassic' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
<br>
<br>
                    <?php else : ?>
                            <h2><?php _e( 'Keine Ergebnisse gefunden', 'myclassic' ); ?></h2>
<br>
                    <?php endif; ?>
                </div>
        </div>
    </section>
    <section class="productSection sections innerProduct">
        <div class="Box1">
            <div class="row">
                <div class="col-sm-8 col-md-8">
                    <?php
                    if ( have_posts() ) :
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();

                                    /**
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/post/content', 'excerpt' );

                            endwhile; // End of the loop.

                            the_posts_pagination( array(
                                    'prev_text' => myclassic_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'myclassic' ) . '</span>',
                                    'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'myclassic' ) . '</span>' . myclassic_get_svg( array( 'icon' => 'arrow-right' ) ),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'myclassic' ) . ' </span>',
                            ) );

                    else : ?>

                            <p><?php _e( 'Entschuldigung, aber nichts entsprach Ihrem Suchbegriff. Bitte versuchen Sie es noch einmal mit einem anderen Keyword.', 'myclassic' ); ?></p>
                            <?php
                                    get_search_form();

                    endif;
                    ?>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="productRight cgeSideBar">
                            <h2 class="headingtxt"></h2>
                            <?php get_sidebar(); ?>
                            <?php dynamic_sidebar('sidebar-3'); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer();
