<?php
/**
 * The template Name: Template-with-sidebar
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="container containerPadding productPage ">
    <section class="productSection sections innerProduct TempSideBar">
            <div class="Box1">
                    <div class="row">
                            <div class="col-sm-8 col-md-8">
                                    <section class="txtSection sections">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <?php
                                                        while ( have_posts() ) : the_post();
                                                        ?>
                                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                                        <?php the_title('<h1 class="txtHdr">', '</h1>'); ?>
                                                        <?php myclassic_edit_link(get_the_ID()); ?>

                                                    </article><!-- #post-## -->
                                                    <?php
                                                    endwhile; // End of the loop.
                                                     if(get_field('sub_title'))
                                                        {
                                                            echo'<h3>'.get_field('sub_title').'</h3>';
                                                        } 
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="entry-content txtSection">
                                                        <?php
                                                        the_content();

                                                        wp_link_pages(array(
                                                            'before' => '<div class="page-links">' . __('Pages:', 'myclassic'),
                                                            'after' => '</div>',
                                                        ));
                                                        ?>
                                                    </div><!-- .entry-content --> 
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="imgObject1">
                                                        <?php if ( has_post_thumbnail() ) 
                                                        {
                                                         the_post_thumbnail();
                                                        } 
                                                        ?> 
                                                    </div>
                                                </div>
                                            </div>
                                    </section>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                    <div class="productRight tempRight  cgeSideBar">
                                        <h2 class="headingtxt">Produktsuche</h2>
                                        <?php dynamic_sidebar('sidebar-template-menu'); ?>
                                    </div>
                            </div>
                    </div>
            </div> <!--box End-->
    </section>
     
     <!-- || Gallery Product Section || -->
        <?php echo do_shortcode('[get_page_gallery]');?> 
     <!-- || End Gallery Product Section || -->
			
        
        <!-- || seller Product Section || -->	
        <section class="productSection sections">
            <?php echo do_shortcode('[getshortcodebestseller]');?> 
        </section>
        <!-- || seller Product Section End || -->	


        <!-- || Service Section || -->	
        <section class="serviceSection sections">
            <h2>Service</h2>
            <?php dynamic_sidebar('service_bottom_section');  ?>
        </section>
        <!-- || Service Section End || -->

</div>

<?php get_footer();
