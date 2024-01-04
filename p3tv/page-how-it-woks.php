<?php
/**
 * Template Name: How Works
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
	        <section class="page-header" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/main-slider/slide_v1_2.jpg);">
	            <div class="container">
	                <h2>The easiest way<br/> to book us professional photographer.</h2>
	                <!-- <ul class="thm-breadcrumb list-unstyled">
	                    
	                    <li><span>Are you a photographer? <a href="#">Apply Now</a></span></li>
	                </ul> -->
	            </div>
	        </section>

			<?php get_template_part( 'template-parts/content', 'filter' ); ?>

	        <!--How It Works-->
	        	<section class="four_boxes">
	        	    <div class="container">
	        	        <div class="block-title text-center">
	        	            <h4>LET’S FIND OUT</h4>
	        	            <h2><?php echo get_field('traveltographer_how_it_works_title', 7); ?></h2>
	        	            <p><?php echo get_field('traveltographer_how_it_works_sub_title', 7); ?></p>
	        	        </div>
	        	        <div class="row">

	                    	<?php if( have_rows('traveltographer_how_it_works_columns', 7) ):

	                    		$icons = array(
	                    			'<span class="icon-selection"></span>',
	                    			'<span class="icon-focus"></span>',
	                    			'<span class="icon-delete"></span>',
	                    			'<span class="icon-exploration"></span>',
	                    		);

	                    		$i = 0;

	        				    // Loop through rows.
	        				    while( have_rows('traveltographer_how_it_works_columns', 7) ) : the_row();

	        				        // Load sub field value.
	        				        $icon_title = get_sub_field('traveltographer_how_it_works_icon_title', 7); 
	        				        $icon_sub_title = get_sub_field('traveltographer_how_it_works_icon_sub_title', 7); ?>

	        				        <div class="col-xl-3 col-lg-6 col-md-6">
	                	                <!--Four Boxes Single-->
	                	                <div class="four_boxes_single">
	                	                    <div class="four_boxes_icon">
	                	                        <?php echo $icons[$i]; ?>
	                	                    </div>
	                	                    <h3><?php echo $icon_title; ?></h3>
	                	                    <p><?php echo $icon_sub_title; ?></p>
	                	                    <div class="four_boxes_shape"></div>
	                	                </div>
	                	            </div>


	        				<?php  $i++; endwhile; endif; ?>


	        	        </div>
	        	        <div class="four_boxes_bottom">
	        	            <p>Don’t hesitate, contact us for better business. <a href="#">Book A Photoshoot</a></p>
	        	        </div>
	        	    </div>
	        	</section>


	   		<!--FAQ One Start-->
	        <section class="faq_one" style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/backgrounds/faq-one-bg.jpg)">
	            <div class="container">
	                <div class="block-title text-center">
	                    <h4>Frequently asked questions</h4>
	                    <h2>Have Any Question?</h2>
	                    <p>Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum</p>
	                </div>
	                <div class="row">
	                    <div class="col-xl-6">
	                        <div class="faq_one_image">
	                            <img src="<?php echo get_field('traveltographer_how_works_image')['url']; ?>" alt="<?php echo get_field('traveltographer_how_works_image')['alt']; ?>">
	                        </div>
	                    </div>
	                    <div class="col-xl-6">
	                        <div class="faq_one_right">
	                            <div class="accrodion-grp" data-grp-name="faq-one-accrodion">

	                            	<?php if( have_rows('traveltographer_have_any_question') ):

	                            		$index = 0;

									    // Loop through rows.
									    while( have_rows('traveltographer_have_any_question') ) : the_row();

									        // Load sub field value.
									        $traveltog_any_question = get_sub_field('traveltog_any_question'); 
									        $traveltog_any_answer = get_sub_field('traveltog_any_answer'); ?>

									        <div class="accrodion <?php echo ($index == 1) ? 'active' : ''; ?>">
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
