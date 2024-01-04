<?php
/**
 * Template Name: Faq
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TravelTographer
 */

get_header();
?>

			<!--Page Header Start-->
	        <section class="page-header" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/main-slider/slide_v1_5.jpg);">
	            <div class="container">
	                <h2>The easiest way<br/> to book a professional photographer.</h2>
	                <!-- <ul class="thm-breadcrumb list-unstyled">	                    
	                    <li><span>Are you a photographer? <a href="#">Apply Now</a></span></li>
	                </ul> -->
	            </div>
	        </section>

			<?php get_template_part( 'template-parts/content', 'filter' ); ?>

	   		<!--FAQ One Start-->
	        <section class="faq_one">
	            <div class="container">
	                <div class="block-title text-center">
	                    <h4>Frequently asked questions</h4>
	                    <h2>Have Any Question?</h2>
	                    <p>Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum</p>
	                </div>
	                <div class="row">
	                    
	                    <div class="col-xl-12">
	                        <div class="faq_one_right">
	                            <div class="accrodion-grp" data-grp-name="faq-one-accrodion">


	                            	<?php if( have_rows('traveltographer_faq') ):

	                            		$index = 0;

									    // Loop through rows.
									    while( have_rows('traveltographer_faq') ) : the_row();

									        // Load sub field value.
									        $traveltog_any_question = get_sub_field('traveltographer_faq_question'); 
									        $traveltog_any_answer = get_sub_field('traveltographer_faq_answer'); ?>

									        <div class="accrodion <?php echo ($index == 0) ? 'active' : ''; ?>">
									            <div class="accrodion-title">
									                <h4><?php echo $traveltog_any_question; ?></h4>
									            </div>
									            <div class="accrodion-content">
									                <div class="inner">
									                    <p><?php echo $traveltog_any_answer; ?></p>
									                </div><!-- /.inner -->
									            </div>
									        </div>

									<?php  $index++; endwhile; endif; ?>
	                                
	                          
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>     

	      

			<?php get_template_part( 'template-parts/content', 'book-photoshoot' ); ?>

<?php
// get_sidebar();
get_footer();
