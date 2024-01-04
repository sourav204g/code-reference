<?php
get_header();
?>

<section class="bannerSection sections revolution-slider">
    <div class="row">
        <?php echo do_shortcode('[smartslider3 slider=2]'); ?>
    </div>
</section>


<div class="container containerPadding">    


    <!-- || Text Section End || -->  	

    <section class="txtSection sections">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            		<h1> <?php echo get_field("homepage_title"); ?></h1>
                <div class="h1"><?php echo get_field("homepage_title2"); ?></div>
                <h3><?php echo get_field("homepage_title3"); ?></h3>
                <?php echo get_field("homepage_content"); ?>
            </div>
        </div>
    </section>

    <!-- || Text Section End || -->	

    <!-- || Product Section || -->	

    <section class="productSection sections">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2 class="productHeader">Produktgruppen</h2>
            </div>
        </div>
        <div class="Box1">
            <div class="row">
                <?php
                if(get_field('product_groups_3_column'))
                {
                   //$getcategories= get_field('product_groups_3_column');
                foreach (get_field('product_groups_3_column') as $key => $productGroupThree) {

                    $termIDThree[] = $productGroupThree['product_group_category_item'];
                }
                foreach ($termIDThree as $termID)
                {
                    $term = get_term_by( 'id', $termID, 'product_cat' );
                    $product_cat_name=$term->name;
                    $term_link= site_url().'/produkt-kategorie/'.$term->slug;
                
                    
                    ?>

                    <div class="col-sm-4 col-md-4 homebox28">
                        <div class="boxInner">
                            <a href="<?php echo $term_link; ?>/">
                                <?php
                                global $wp_query;
                                            $cat = $wp_query->get_queried_object();
                                            $thumbnail_id = get_term_meta( $termID, 'thumbnail_id', true );
                                            //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_ID ),'homepage-category-image');
                                            $image = wp_get_attachment_image_src( $thumbnail_id,'homepage-category-image');
                                            $alt   = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);
                                            if ( $image ) {
                                                    echo wp_get_attachment_image($thumbnail_id, 'homepage-category-image');
                                                    // echo '<img src="' . $image[0] . '" alt="' . $alt . '" />';
                                    }
                                 ?>
                                <div class="imgContent">
                                    <p><a class="firstWord"><?php echo $product_cat_name; ?></a></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php 
                }
                //endforeach; 
                }
                ?>
            </div>
        </div>
        <div class="Box1 boxChild">
            <ul class="fiveChild">
                <?php
                if(get_field('product_groups_6_column'))
                {
                    foreach (get_field('product_groups_6_column') as $key => $productGroupSix) {
                        
                        $termIDSix[] = $productGroupSix['product_group_category_item_two'];
                        
                    }

                    foreach ($termIDSix as $prod_cat) :
                        $term = get_term_by( 'id', $prod_cat, 'product_cat' );
                        $product_cat_name=$term->name;
                        $term_link= site_url().'/produkt-kategorie/'.$term->slug;
                    ?>

                    <li>
                        <div class="boxInner">
                            <a href="<?php echo $term_link; ?>/">
                                <?php
                                global $wp_query;
                                            $cat = $wp_query->get_queried_object();
                                            $thumbnail_id = get_term_meta( $prod_cat, 'thumbnail_id', true );
                                            //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_ID ),'homepage-category-image');
                                            $image = wp_get_attachment_image_src( $thumbnail_id,'homepage-category-product-image');
                                            $alt   = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);
                                            if ( $image ) {
                                                echo wp_get_attachment_image($thumbnail_id, 'homepage-category-product-image');
                                                    // echo '<img src="' . $image[0] . '" alt="' . $alt . '" />';
                                    }
                                 ?>
                                

                                <div class="imgContent">
                                    <p class="txtRank"><a class="firstWord"><?php echo $product_cat_name; ?></a></p>
                                </div>
                            </a>
                        </div>
                    </li>

                    <?php endforeach; 

                } ?>

            </ul>

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2 class="productHeader">Bestseller</h2>
            </div>
        </div>
        <?php if(get_field('best_seller_products')): ?>
                
        <div class="Box1 boxFourSection">
            <div class="row">                
                <?php 
                
                foreach (get_field('best_seller_products') as $key => $productbest) {
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
                                echo wp_get_attachment_image(get_post_thumbnail_id( $product_ID ), 'bestsaller-product-image', false, ['alt' => $product_title]);
                            ?>

                                
                                <div class="imgContent">
                                    <p><a class="firstWord"><?php echo $product_title; ?></a></p>
                                </div></a>
                        </div>
                    </div>

                <?php  endforeach;  ?>

            </div>
        </div>
    <?php endif; ?>
    </section>
    <!-- || Product Section End || -->	

   
    <!-- || New Content Section || -->  
    <?php if ( get_field('new_homepage_content2') ) : ?>

        <section class="ncontentsections sections" style="margin-bottom: 30px;">
            <?php echo get_field('new_homepage_content2'); ?>
        </section>      
        
    <?php endif; ?>
    <!-- || New Content Section End || -->


    <!-- || Service Section || -->	
    <section class="serviceSection sections">
        <h2>Service</h2>
        <?php dynamic_sidebar('service_bottom_section'); ?>
    </section>
    <!-- || Service Section End || -->
    

</div>	
<!-- || Social Section || -->	
<?php
get_footer();