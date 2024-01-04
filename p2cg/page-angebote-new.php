<?php

/**
 * Template Name: Angebote NEW Page
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header('new');?>

<style type="text/css">
    
    .has_fixed_background {
        background-attachment:scroll;

        /*//position: relative;
        z-index: 101;*/
    }

</style>

<?php if ( get_post_thumbnail_id($post->ID) ): ?>

    <div class="title title_size_medium  position_center has_fixed_background" style="background-size:1920px auto; background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>); height:350px; background-position: top center; background-repeat: no-repeat;">
    </div>
    
<?php endif ?>




<div class="container paddingNone">

<div class="container containerPadding productPage ">
 <div class="wrap">
    <div id="primary" class="content-area txtSection">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/page/content-notitle', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div>
    
<!-- || Service Section || -->  
            
    <section class="serviceSection sections">
        <h2>Service</h2>
        <?php dynamic_sidebar('service_bottom_section');  ?>
    </section>
            <!-- || Service Section End || -->  <!--#primary -->
 </div><!-- .wrap -->
</div>

<?php get_footer();