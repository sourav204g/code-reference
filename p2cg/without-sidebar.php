<?php
/**
 * The template Name: Template-without-sidebar
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

<div class="container containerPadding productPage">
    <section class="productSection sections innerProduct templatePage">
            <div class="Box1">
                <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <section class="txtSection sections">
                                <div class="row">
                                    <?php
                                        while ( have_posts() ) : the_post();
                                        ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="col-md-12 col-sm-12">
                                                <?php the_title('<h1>', '</h1>'); ?>
                                                <?php myclassic_edit_link(get_the_ID()); ?> 
                                        <div class="entry-content txtSection bantu">
                                            <?php
                                            if(get_field('sub_title'))
                                            {
                                                echo'<h3>'.get_field('sub_title').'</h3>';
                                            }
                                            if ( has_post_thumbnail() ) 
                                                {
                                                 echo "<p>"; the_post_thumbnail(); echo "</p>";
                                                } 
                                                
                                            the_content();

                                            wp_link_pages(array(
                                                'before' => '<div class="page-links">' . __('Pages:', 'myclassic'),
                                                'after' => '</div>',
                                            ));
                                            ?>
                                        </div><!-- .entry-content -->
                                    </div>
                                    </article><!-- #post-## -->
                                        <?php
                                        endwhile; // End of the loop.
                                        ?>
                                </div>
                            </section>
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
