<!--Testimonials One Start-->
<section class="testimonials_one">
    <div class="testimonial_one_map"
        style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/shapes/testimonial-one-map.png)">
    </div>
    <div class="container-box">
       
        <div class="row">
            <div class="col-xl-7">
                 <div class="block-title text-left ml60">
                    <h4>Our testimonials</h4>
                    <h2><?php echo get_field('traveltographer_what_they_say_title'); ?></h2>
                    <p><?php echo get_field('traveltographer_what_they_say_sub_title'); ?></p>
                </div>
                <div class="testimonials_one_carousel owl-theme owl-carousel">
                    
                    <?php $the_query = new WP_Query(array(
                        'post_type' => 'testimonials',
                        'post_status' => 'publish',
                        'posts_per_page' => -1
                    )); 

                    if($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post(); ?>

                    <!--Testimonials One Single-->
                    <div class="testimonials_one_single">
                        <div class="shadow-box"></div>
                        <div class="row">
                            <div class="col-xl-4">
                                <img src="<?php echo get_field('traveltographer_reviewer_image')['url']; ?>" />
                            </div>
                            <div class="col-xl-8">
                                 <div class="testimonials_one_text">
                                        <div class="testimonials_one_rating_box">
                                            <?php $rating = (int) get_field('traveltographer_review_rating'); for ($i=0; $i < $rating; $i++) : ?>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="testimonials_one_text_box">
                                            <p><?php echo get_field('traveltographer_review'); ?></p>
                                        </div>
                                        <div class="testimonials_quote_icon">
                                            <span class="icon-quote"></span>
                                        </div>
                                        <div class="customer_info">
                                            <h3><?php the_title(); ?>,<span>Customer</span></h3>
                                        </div>
                                </div>
                             </div>
                        </div>
                       
                    </div>

                    <?php endwhile; endif; wp_reset_postdata(); ?>

                    
                </div>
            </div>
            <div class="col-xl-5">
                
                <div class="Get-quote-box">
                    <div class="block-title text-center">
                        <h2>Get a quote</h2>
                        <p>Complete the form below and our team will get back to you within 24-hours. </p>
                    </div>
                    
                    <?php echo do_shortcode( '[contact-form-7 id="668" title="Get a Quote"]' ); ?>

                </div> 
            </div>
        </div>
    </div>
</section>