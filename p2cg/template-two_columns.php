<?php
/**
 * Template Name: Two Columns
 */
get_header(); ?>

<div class="container containerPadding productPage txtRightUl">
    <div class="wrap">
        <div id="primary" class="content-area txtSection">
            <main id="main" class="site-main" role="main">

                <article id="post-<?php the_ID() ?>" <?php post_class() ?>>
                    <header class="entry-header">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 text-center">
                                <h1><?php the_title() ?></h1>
                                <h3><?php the_field('second_heading'); ?></h3>
                            </div>
                        </div>
                    </header>
                    <div class="single-clm-content">
                        <?php
                                        while ( have_posts() ) : the_post();
                                        
                                            the_content();

                                            wp_link_pages(array(
                                                'before' => '<div class="page-links">' . __('Pages:', 'myclassic'),
                                                'after' => '</div>',
                                            ));
                                          
                                        endwhile; // End of the loop.
                                        ?>
                    </div>
                    <div class="two-columns-content">
                        <div class="col-md-6 col-sm-6">
                            <?php  the_field('left_content');?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?php  the_field('right_content');?>
                        </div>
                    </div>

                </article>
                
                <!-- || Gallery Product Section || -->
                    <?php echo do_shortcode('[get_page_gallery]');?> 
                <!-- || End Gallery Product Section || -->

                <section class="productSection sections">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2 class="productHeader">Bestseller</h2>
                    </div>
                </div>
                <?php if(get_field('best_seller_products',4)): ?>                
                    <div class="Box1 boxFourSection">
                        <div class="row">                
                            <?php 
                            foreach (get_field('best_seller_products',4) as $key => $productbest) {
                                $termbest[] = $productbest['product'];
                                
                            }
                            foreach ($termbest as $prod_cat) :
                                $product_title= $prod_cat->post_title;
                                $product_ID=$prod_cat->ID;
                                $product_link=get_permalink( $product_ID );
                                ?>
                                <div class="col-sm-3 col-md-3">
                                    <div class="boxInner">
                                        <a href="<?php echo $product_link; ?>">
                                        <?php  
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_ID ), 'bestsaller-product-image' );
                                        ?>
                                            <img src="<?php  echo $image[0]; ?>" alt="<?php echo $product_title; ?>">
                                            <div class="imgContent">
                                                <p><?php echo $product_title; ?></p>
                                            </div></a>
                                    </div>
                                </div>

                                <?php  endforeach;  ?>
                        </div>
                    </div>
                <?php endif; ?>
                </section>

                <section class="serviceSection sections">
                    <h2>Service</h2>
                    <?php dynamic_sidebar('service_bottom_section'); ?>
                </section>

            </main><!-- #main -->
        </div> <!--#primary -->
    </div><!-- .wrap -->
</div>

<?php
get_footer();
