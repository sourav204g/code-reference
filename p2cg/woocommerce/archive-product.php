<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$service_category_object = get_queried_object();

// echo '<pre>';
// var_dump($service_category_object);

get_header();
?>

<?php if (isset($service_category_object->term_id)): ?>

    <!-- Start Banner Section -->
    <section>

    <?php if ( $service_category_object->term_id == 4805 ): ?>
        <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=14]'); ?>
        </div>
    <?php elseif ($service_category_object->term_id == 213 ): ?>  
        <div class="container pflanzkuebel bgd">
        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/08/Metall-Pflanzkübel01.jpg"/>
        </div>
    <?php elseif ($service_category_object->term_id == 4811 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=15]'); ?>
        </div> 
    <?php elseif ($service_category_object->term_id == 4519 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=16]'); ?>
        </div>
    <?php elseif ($service_category_object->term_id == 4803 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=17]'); ?>
        </div>
    <?php elseif ($service_category_object->term_id == 4521 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=18]'); ?>
        </div>
    <?php elseif ($service_category_object->term_id == 4523 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=19]'); ?>
        </div>
    <?php elseif ($service_category_object->term_id == 4520 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=20]'); ?>
        </div> 
    <?php elseif ($service_category_object->term_id == 4522 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=21]'); ?>
        </div>
    <?php elseif ($service_category_object->term_id == 4627 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=22]'); ?>
        </div> 
        <?php elseif ($service_category_object->term_id == 4804 ): ?>
            <div class="container pflanzkuebel bgd">
        <?php echo do_shortcode ('[smartslider3 slider=24]'); ?>
        </div> 
    <?php else: ?>  
        <div class="container pflanzkuebel bgd" style="display: none;">
           
        </div> 
    <?php endif; ?>

    </section>
    <!-- End Banner Section -->
    
<?php endif ?>

<?php do_action('woocommerce_before_main_content'); ?>


<style> .classic-text-desc { margin-top: 30px; } .classic-text-desc p { margin-bottom: 20px; } </style>
        
<!-- || Text Section End || -->	

    <section class="txtSection sections">

         <div class="row" style="padding:1px 0 15px;">
             <div class="col-sm-12 col-md-12 serchrb dkonly" >           
            
                 <?php dynamic_sidebar('smartslider_area_1'); ?>

                </div>
         </div>
            <div class="row">
                
               
                    <div class="col-md-12 col-sm-12">
                            <h1><?php woocommerce_page_title(); ?></h1>
                    </div>
                    
            </div>
    </section>

<!-- || Text Section End || -->	



<!-- || Product Section || -->	

<?php  $rosenboegen = array(158, 4130, 4131, 4132, 4133, 4134, 4128, 4126, 4127, 4125, 5168);  ?>
<?php if( isset( $service_category_object->term_id) && in_array( $service_category_object->term_id, $rosenboegen ) /* || $service_category_object->taxonomy === 'product_tag' */ ) : ?>

    <section class="productSection sections innerProduct wp869" >
        <div class="Box1">
            <div class="row">

                <div class="col-sm-4 col-md-4 serchrb mbonly" style="margin-top: 15px;">           
            
                 <?php dynamic_sidebar('smartslider_area_1'); ?>

                </div>
				
				<div class="col-sm-8 col-md-8 filterbg">
				<div class="storefront-sorting tag-filter">


    <form class="woocommerce-ordering1">
	   

            <select name="orderby" class="hnd-tag-filter0">
                     <option value="popularity" selected="selected">Sortierung nach: Preis</option>
 					 <option value="<?php echo get_site_url(); ?>/produkt-kategorie/rosenboegen/?orderby=price-desc">Sortierung nach: Preis absteigend</option>
					<option value="<?php echo get_site_url(); ?>/produkt-kategorie/rosenboegen/?orderby=price">Sortierung nach: Preis aufsteigend</option>
                    <option value="<?php echo get_site_url(); ?>/produkt-kategorie/rosenboegen/?orderby=popularity">Sortierung nach: Popularität</option>
                    <option value="<?php echo get_site_url(); ?>/produkt-kategorie/rosenboegen/?orderby=date">Sortierung nach: Neue Produkte</option>
			</select>
	</form>
					
	      

            <?php
			
			$terms = get_terms( 'product_tag' );					
			
            ?>
	       

           <select name="orderby" class="hnd-tag-filter" style="display:none;">
		
		          <option value="">Filterprodukte</option>
		
		          <?php				
	
		
		

                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                        foreach ( $terms as $term ) { ?>
                    		
                    					
                    					<option value="<?php echo get_term_link( $term->term_id ); ?>"><?php echo $term->name; ?></option>
                    	<?php				
                    		}
                    }	
				
				?>
						
			</select>
				
				
					
            		<select name="orderby" class="hnd-tag-filter1" style="display:nonee;">
            		    <option value="" selected="true" disabled="disabled" >Sortierung nach: Design </option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-portofino/">Rosenbogen Portofino</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-brighton/">Rosenbogen Brighton</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-bagatelle/">Rosenbogen Bagatelle</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-kiftsgate/">Rosenbogen Kiftsgate</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/japan-torbogen-torii/">Japan Torbogen Torii</option>		
            		</select>				
				
					<select name="orderby" class="hnd-tag-filter2" style="display:nonee;">
            		    <option value="" selected="true" disabled="disabled" >Sortierung nach: Art </option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-nur-bogen/">Nur Rosenbogen</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/freistehende-rosenboegen/">Freistehender Rosenbogen</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-mit-gartentuere/">Rosenbogen mit Gartentüre</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-mit-bank">Rosenbogen mit Bank</option>
            			<option value="<?php echo get_site_url(); ?>/produkt-schlagwort/rosenboegen-mit-zaun/">Rosenbogen mit Zaun</option>	
					</select>
					
					
					
															
</div></div>
</div></div></section>

<?php endif; ?>


<!-- RINKU - START -->
<?php  $rosenboegen = array(213, 4519, 4520, 4521, 4522, 4627, 4803, 4804, 4805, 4523, 4811, 4813, 4810);  ?>
<?php if( isset( $service_category_object->term_id) && in_array( $service_category_object->term_id, $rosenboegen ) /* || $service_category_object->taxonomy === 'product_tag' */ ) : ?>

    <section class="productSection sections innerProduct wp869" >
        <div class="Box1">
            <div class="row">

                <div class="col-sm-4 col-md-4 serchrb mbonly" style="margin-top: 15px;">           
            
                 <?php dynamic_sidebar('smartslider_area_1'); ?>

                </div>
                
                <div class="col-sm-8 col-md-8 filterbg">
                <div class="storefront-sorting tag-filter">


    <form class="woocommerce-ordering1">
       

            <select name="orderby" class="hnd-tag-filter0">
                     <option value="popularity" selected="selected">Sortierung nach: Preis</option>
                     <option value="<?php echo get_site_url(); ?>/produkt-kategorie/pflanzkuebel/?orderby=price-desc">Sortierung nach: Preis absteigend</option>
                    <option value="<?php echo get_site_url(); ?>/produkt-kategorie/pflanzkuebel/?orderby=price">Sortierung nach: Preis aufsteigend</option>
                    <option value="<?php echo get_site_url(); ?>/produkt-kategorie/pflanzkuebel/?orderby=popularity">Sortierung nach: Popularität</option>
                    <option value="<?php echo get_site_url(); ?>/produkt-kategorie/pflanzkuebel/?orderby=date">Sortierung nach: Neue Produkte</option>
            </select>
    </form>
                    
          

            <?php
            
            $terms = get_terms( 'product_tag' );                    
            
            ?>
           

           <select name="orderby" class="hnd-tag-filter" style="display:none;">
        
                  <option value="">Filterprodukte</option>
        
                  <?php             
    
        
        

                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                        foreach ( $terms as $term ) { ?>
                            
                                        
                                        <option value="<?php echo get_term_link( $term->term_id ); ?>"><?php echo $term->name; ?></option>
                        <?php               
                            }
                    }   
                
                ?>
                        
            </select>
                
                
                    
                    <select name="orderby" class="hnd-tag-filter1" style="display:nonee;">
                        <option value="" selected="true" disabled="disabled" >Sortierung nach: Design </option>
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/versailler-pflanzkuebel/">Versailler Pflanzkübel</option>
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/ibiza-pflanzkuebel/">IBIZA Pflanzkübel</option>

                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/caisse-de-versailles-pflanzkuebel/">Caisse de Versailles Pflanzkübel</option>

                        
                       
                    </select>               
                
                    <select name="orderby" class="hnd-tag-filter2" style="display:nonee;">
                        <option value="" selected="true" disabled="disabled" >Sortierung nach: Art </option>
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/nur-metall-pflanzkuebel/">Nur Metall Pflanzkübel</option>
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/metall-pflanzkuebel-bank-rankpyramide/">Metall Pflanzkübel + Bank & Rankpyramide</option>
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/metall-pflanzkuebel-festes-rankgitter/">Metall Pflanzkübel + festes Rankgitter</option>
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/metall-pflanzkuebel-abnehmbares-rankgitter/">Metall Pflanzkübel + abnehmbares Rankgitter</option> 
                        <option value="<?php echo get_site_url(); ?>/produkt-schlagwort/abnehmbare-rankgitter-fuer-metall-pflanzkuebel/">Abnehmbare Rankgitter für Metall Pflanzkübel</option>   
                    </select>
                    
                    
                    
                                                            
</div></div>
</div></div></section>

<?php endif; ?>
<!-- / RINKU - END -->




<section class="productSection sections innerProduct wp869">
        <div class="Box1">
            <div class="row">
      		
			
                <div class="col-sm-12 col-md-12">
                    <?php if (have_posts()) : ?>
					
                        <?php do_action('woocommerce_before_shop_loop'); ?>
					
                        <?php woocommerce_product_loop_start(); ?>

                        <?php woocommerce_product_subcategories();  ?>
                        <div class="clearfix"></div>

                        <?php while (have_posts()) : the_post(); ?>

                            <?php
                            /**
                             * woocommerce_shop_loop hook.
                             *
                             * @hooked WC_Structured_Data::generate_product_data() - 10
                             */
                            do_action('woocommerce_shop_loop');
                            ?>

                            <?php wc_get_template_part('content', 'product'); ?>

                        <?php endwhile; // end of the loop.  ?>

                        <?php woocommerce_product_loop_end(); ?>

                        <?php //do_action('woocommerce_after_shop_loop'); ?>

                    <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                        <?php
                        /**
                         * woocommerce_no_products_found hook.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action('woocommerce_no_products_found');
                        ?>

                    <?php endif; ?>
                </div>
                <div class="col-sm-12 col-md-12 cgeSideBar" style="margin-top: 25px;">
                    <?php //get_sidebar(); ?>
                   <?php //dynamic_sidebar( 'filter_1' ); ?>
                </div>

                        <?php if( isset( $service_category_object->term_id) && $service_category_object->term_id === 158 || isset( $service_category_object->term_id) && $service_category_object->taxonomy === 'product_tag' ) : ?>

                           <?php if ( $service_category_object->taxonomy === 'product_tag' ): ?>
                               <div class="classic-text-desc col-sm-12 col-md-12">
                                    <?php echo tag_description($service_category_object->term_id); ?>
                                </div>
                            <?php else: ?>
                                <div class="classic-text-desc col-sm-12 col-md-12">
                                    <?php echo category_description($service_category_object->term_id); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                



                <div class="col-sm-4 col-md-4" style="display: none;">
                        <div class="productRight cgeSideBar">
                                <!-- <h2 class="headingtxt">Produktsuche</h2> -->
                                <?php get_sidebar(); ?>
                                <div class="text-center">
                                        <hr class="hrColor"></hr>
                                </div>
                                <?php dynamic_sidebar('sidebar-3'); ?>

                        </div>
                </div>
            </div>
	</div> <!--box End-->
<?php $catgory_id = get_queried_object_id();
        if($catgory_id){ ?>
        <section class="bottomsection">
            <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                            <hr class="hrColor"></hr>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <?php
                        $product_category_title = get_field('product_group_title','term_'.$catgory_id );
                        $product_category_content= get_field('gar_product_group_content','term_'.$catgory_id );
                    ?>
                    <h2 class="txtSubline"><?php echo $product_category_title; ?></h2>
                    <div class="txtBrucat"><?php echo $product_category_content; ?></div>
                    
                </div>
                
            </div>
        </section>
        <?php } ?>
        <?php if ( is_post_type_archive( 'product' ) ) {  ?>
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
                                            <div class="imgContent new">
                                                <p><?php echo $product_title; ?></p>
                                            </div></a>
                                    </div>
                                </div>

                                <?php  endforeach;  ?>
                        </div>
                    </div>
                <?php endif; ?>
        <?php } ?>
    </section>
    <!-- || Product Section End || -->	

    <!-- || New Content Section || -->  
    <?php if ( get_field('new_homepage_content2', 1246) && !is_product_category() ) : ?>

        <section class="ncontentsections sections" style="margin-bottom: 30px;">
            <?php echo get_field('new_homepage_content2', 1246); ?>
        </section>      
        
    <?php endif; ?>
    <!-- || New Content Section End || -->

    <!-- || Service Section || -->	
    <section class="serviceSection sections">
        <h2>Service</h2>
            <?php dynamic_sidebar('service_bottom_section'); ?>
    </section>
    <!-- || Service Section End || -->
	
<?php do_action('woocommerce_after_main_content'); ?>
	
<?php get_footer(); ?>