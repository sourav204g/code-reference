<?php
/**
 * The template Name: template-references
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
    <section class="productSection sections ReferenzenContent">  <!--Referenzen S-->
            <div class="Box1 boxReferenzen">
                <section class="txtSection sections">
                    <div class="row text-center">
                        <div class="col-md-10 col-sm-12 col-md-offset-1">
                            <?php
                                while ( have_posts() ) : the_post();
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                   <?php the_title('<h1>', '</h1>'); ?>
                                   <?php myclassic_edit_link(get_the_ID()); ?> 
                                    <div class="entry-content txtSection">
                                    <?php
                                    the_content();

                                    wp_link_pages(array(
                                        'before' => '<div class="page-links">' . __('Pages:', 'myclassic'),
                                        'after' => '</div>',
                                    ));
                                    ?>
                                    </div><!-- .entry-content -->

                                 </article>
                                <?php
                                endwhile; // End of the loop.
                                    ?>   
                        </div>
                    </div>
                </section>
                <section class="innerItems">
                    <?php
                    $referenze_data = get_field('referenzen_content_image'); //////////////////////////////////referenzen_content_image is my custom field nam// 
                    $totalrec=count($referenze_data);
                    foreach ($referenze_data as $referenzevalue) {
                       $totalrec=$totalrec-1;
                    ?>
                       <div class="templateBox txtSection text-center">
                           <div class="row">
                               <div class="col-sm-12 col-md-10 col-md-offset-1">
                                  <h3><?php echo $referenzevalue['referenzen_title']?></h3>
                                  <p><?php echo $referenzevalue['referenzen_description']?></p>
                               </div>  
                           </div>
                           <div class="row">
                               <?php 
                        if($referenzevalue['referenzen_images'])
                        {
                        ?>
                        <?php
                            $referenzen_images=$referenzevalue['referenzen_images'];
                            $total_images=count($referenzen_images);
                            $img_cls=0;
                            foreach ($referenzen_images as $referenzen_image)
                            {
                                
                                if($total_images==2)
                                {
                                    $img_cls++;
                                    if($img_cls==1)
                                {
                                    $first_image="col-md-offset-2 col-sm-offset-2";
                                }
                                else
                                {
                                   $first_image=''; 
                                }
                                }
                                
                            ?>
                               <div class="col-sm-4 col-md-4 <?php echo $first_image;?>">
                                <div class="imgBorderBold">
                                    <a data-fancybox="gallery" href="<?php echo $referenzen_image['Referenzen_image'] ?>"><img class="picture" src="<?php echo $referenzen_image['Referenzen_image'];?>"/></a>
                                </div>
                               </div>
                            <?php
                            $img_cls++;
                            }
                        }
                        ?>
                           </div>
                           <?php
                           if($totalrec!=0)
                           {
                           ?>
                           <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <hr class="hrImages"></hr>
                                </div>
                            </div>
                           <?php
                            }
                           ?>
                        </div>    
                       <?php 
                        }
                       ?>
                    </section>						
        </div> <!--box End-->
    </section>  <!--Referenzen End-->
			
			<!-- || Product Section End || -->	
       <!-- || Gallery Product Section || -->
        <?php echo do_shortcode('[get_page_gallery]');?> 
    <!-- || End Gallery Product Section || -->

			<!-- || seller Product Section || -->	
				
    <section class="productSection sections">
        <?php echo do_shortcode('[getshortcodebestseller]');?>
    </section>
			
			<!-- || end seller Product Section End || -->	

			
			<!-- || Service Section || -->	
      <section class="serviceSection sections">
        <h2>Service</h2>
        <?php dynamic_sidebar('service_bottom_section');  ?>
      </section>
			<!-- || Service Section End || -->


      
</div>
		<!-- || Social Section || -->	
			
<!---------------------------------------------------------------------------------------->



<?php get_footer();
