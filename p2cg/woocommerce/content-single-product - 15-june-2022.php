<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */
defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

$product_id = get_the_ID();

global $product;

$category_detail = get_the_terms( $product_id, 'product_cat' );

$args = array(
    'post_type' => 'product_variation',
    'post_status' => array('private', 'publish'),
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'desc',
    'post_parent' => $product_id // $post->ID 
);

$variations = get_posts($args);


/* $_product           = wc_get_product( 286 );
$_parent            = wc_get_product( $_product->get_parent_id() );
$gzd_product        = wc_gzd_get_product( $_product );
$gzd_parent_product = wc_gzd_get_product( $_parent );
$delivery_time      = $gzd_product->get_delivery_time( 'edit' );

var_dump($delivery_time ); */


if ($variations) {
    foreach ($variations as $variation) {
        $vars[] = $variation->ID;
    }
}
?>

    <style>
                del { color: #85724c; }
            .short-cta {
                    position: relative;
                }
        .cls_select_color {
            display: inline-block;
                      -webkit-appearance: none;
                      -moz-appearance: none;
                      appearance: none;
            background-color: #5A8239;
            color: #fff;
            border: 2px solid #596567;
            font-size: 18px;
            font-weight: bold;
            outline: none;
            height: 40px;
                    width:175px;
            padding:4px 10px 4px 4px;
            border-radius: 0px;
            background-image: url('https://www.classic-garden-elements.de/wp-content/uploads/2020/12/white-arrow.png');
                      background-repeat: no-repeat;
                      background-position: 145px center;
                      background-size: 20px 20px;
        }
        .variation-link {
            pointer-events: none;
            opacity: 0.6;
        }

        .shortproductdetails.shortproductdetailsSort {
            display: flex;
            flex-direction: column;
        }

        .shortproductdetails.shortproductdetailsSort > .short-vars:nth-child(3) { order: 0; }
        .shortproductdetails.shortproductdetailsSort > .short-vars:nth-child(4) { order: 1; }
        .shortproductdetails.shortproductdetailsSort > .short-vars:nth-child(2) { order: 2; }
        .shortproductdetails.shortproductdetailsSort > .short-vars:nth-child(1) { order: 3; }
        .shortproductdetails.shortproductdetailsSort > .jumptodetails { order: 4; }


    </style>


    <!-- || Product Section || -->  
    <section class="productSection sections innerProduct templatePage singleProduct">


        <?php 

            $varItems = new stdClass;

            foreach ( $variations as $key => $_variation ) {

                // echo "<pre>";
                // var_dump(explode(',', $_variation->post_excerpt));

                $key = explode(',', $_variation->post_excerpt)[0];

                if (isset(explode(',', $_variation->post_excerpt)[1])) {
                    $value = explode(',', $_variation->post_excerpt)[1];
                    $varItems->$key[$_variation->ID] = $value;
                }
                

            }

            $varItems = (array) $varItems;


            

        ?>

        
        <!-- || Text Section End || --> 
        <div class="Box1">
            <div class="row">
                <div class="col-sm-8 col-md-8">
                    <section class="txtSection sections">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1><?php the_title(); ?></h1>
                                <div class="imgObject1 single-product-image mobile">
                                
                                <?php

                                if (has_post_thumbnail()) { 

                                    $imgID  = get_post_thumbnail_id($post->ID);
                                    $imgAlt = get_post_meta($imgID,'_wp_attachment_image_alt', true); ?>
                           <a  data-fancybox="gallery" data-alt="<?php echo $imgAlt; ?>" href="<?=get_the_post_thumbnail_url()?>">
                           <?php
                                the_post_thumbnail();
                           ?>
                         </a>
                         <?php
                                }
                         ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="shortproductdetails <?php echo (!is_single(11354)) ? '' : 'shortproductdetailsSort'; ?>">
                                    <?php
                                        if($vars)
                                        {
                                            global $woocommerce;
                                            
                                            $cart_url = wc_get_cart_url(); 
                                            $coulumn=0;
                                            $total_vars = count($vars);

                                            if(!is_single(11354)) {
                                            
                                                foreach ($vars as $v) {
                                                    // create cart url
                                                    $taxonomy = 'pa_item';
                                                    $var_slug = get_post_meta($v, 'attribute_' . $taxonomy, true);
                
                                                    $variation_url = add_query_arg(array(
                                                        'add-to-cart' => $product_id,
                                                        'variation_id' => $v,
                                                        'attribute_' . $taxonomy => $var_slug,
                                                            ), $cart_url);
                                                    // end cart url
                                                    $j=0;
                                                    $s=0;

                                                    $coulumn++;                                    
                                                    
                                                    $total_vars =$total_vars-1;
                
                                                    echo'<div class="short-vars">';
                                                    
                                                    // get "Produktname" = Variationname
                                                    while ( have_rows('variation_labels') ) : the_row();
                                                               $field_name = get_sub_field('label');
                                                       
                                                       $label='_cstm_label_'.$j;
                                                       $_text_field_label1 = $label.'['.$v.']';

                                                       if ($field_name == 'Farbe') {
                                                           $xColorlabel = '_cstm_label_'. $s;
                                                           $xColorValue = get_post_meta( $v , $xColorlabel, true );
                                                       }

                                                       /* if ($field_name == 'Lieferzeit') {
                                                           $xDeliveryTimelabel = '_cstm_label_'. $s;
                                                           $xDeliveryTimeValue = get_post_meta( $v , $xDeliveryTimelabel, true );
                                                       } */
                                                       
                                                       if( ! empty( $_text_field_label1 ) ) {
                                                        if($field_name=='Produktname')
                                                            {
                                                              echo'<h2 class="productname">' . get_post_meta($v, $label, esc_attr( $_text_field_label1)) . '</h2>';
                                                            }
                                                       }

                                                       $s++;

                                                    endwhile;               
                                                    // get "Produktname" = Variationname END
                                                                
                                                    $price = get_post_meta($v, '_price', true);
                                                    $__variation = new WC_Product_Variation( $v );
                                                    // echo '<pre>';
                                                    // var_dump($__variation->get_sale_price());
                                                    echo '<ul class="hnd-top-specs">';
                                                    if($__variation->get_sale_price() !== '') {

                                                        $date_from = wc_rest_prepare_date_response( $__variation->get_date_on_sale_from(), false );
                                                        $date_to   = wc_rest_prepare_date_response( $__variation->get_date_on_sale_to(), false );

                                                        $date_from_jMy = new DateTime($date_from);
                                                        $date_to_jMy   = new DateTime($date_to);

                                                        $now = new DateTime();

                                                        // var_dump($date_from_jMy);
                                                        // var_dump($now );

                                                        if (!isset($date_from) && !isset($date_to)) {

                                                            $tp = $__variation->get_regular_price() - $__variation->get_sale_price();
                                                            $percentage = ($tp/$__variation->get_regular_price()) * 100;                                                            
                                                            echo '<li class="price"><del>' . wc_price( $__variation->get_regular_price() ) . '</del> <ins>' . wc_price( $price ). '</ins> <span style="">Sie sparen ' . round($percentage) . '%</span></li>';
                                                            
                                                        } else {

                                                            if (($now >= $date_from_jMy) && ($now <= $date_to_jMy)){

                                                                $tp = $__variation->get_regular_price() - $__variation->get_sale_price();
                                                                $percentage = ($tp/$__variation->get_regular_price()) * 100;                                                            
                                                                echo '<li class="price"><del>' . wc_price( $__variation->get_regular_price() ) . '</del> <ins>' . wc_price( $price ). '</ins> <span style="">Sie sparen ' . round($percentage) . '%</span></li>';
                                                                
                                                                
                                                            } else {
                                                                echo '<li class="price">' . wc_price( $__variation->get_regular_price() ). '</li>';
                                                            }

                                                        }
                                                        
                                                    } else {
                                                        echo '<li class="price">' . wc_price( $price ). '</li>';
                                                    }
                                                    
                                                    echo '<li>Inkl. MwSt.</li>';
                                                    $mastercounter=0;
                                                    $countme=0;
                                                    $foundit=0;
                                                    while ( have_rows('variation_labels') ) : the_row();
                                                        $countme++;
                                                    endwhile;
                                                    while ( have_rows('variation_labels') ) : the_row();
                                                            
                                                            
                                                                $mastercounter++;
                                                                                                                                        
                                                            $field_name = get_sub_field('label');
                                                            $label='_cstm_label_'.$j;
                                                            $_text_field_label1 = $label.'['.$v.']';
                                                            if( ! empty( $_text_field_label1 ) ) {
                                                                
                                                                if(strstr(get_post_meta($v, $label, esc_attr($label)),'...') )
                                                                {
                                                                    echo'';
                                                                    $mastercounter++;
                                                                }
                                                                //Offer Section START
                                                                else if($field_name=='Weihnachtsgutschein' && get_post_meta($v, $label, esc_attr( $_text_field_label1))=="50,00 €")
                                                                {
                                                                    echo '<li><strong style="color:#0042e8"><u>Weihnachtsgutschein: 50 €</u></strong></li>';
                                                                }
                                                                else if($field_name=='Weihnachtsgutschein' && trim(get_post_meta($v, $label, esc_attr( $_text_field_label1)))=="100,00 €")
                                                                {
                                                                    echo '<li><strong style="color:#025a02"><u>Weihnachtsgutschein: 100 €</u></strong></li>';
                                                                }
                                                                else if($field_name=='Weihnachtsgutschein' && get_post_meta($v, $label, esc_attr( $_text_field_label1))=="200,00 €")
                                                                {
                                                                    echo '<li><strong style="color:#c60505"><u>Weihnachtsgutschein: 200 €</u></strong></li>';
                                                                }
                                                                 else if($field_name=='Weihnachtsgutschein' && trim(get_post_meta($v, $label, esc_attr( $_text_field_label1)))=="500,00 €")
                                                                {
                                                                    echo '<li><strong style="color:#034444"><u>Weihnachtsgutschein: 500 €</u></strong></li>';
                                                                }                                                                    
                                                                //Offer Section END
                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'Aufbau'))
                                                                                {
                                                                                        echo'<li>Klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a> für eine Aufbau Anleitung' . '</li>';
                                                                                        $mastercounter++;
                                                                                }
                                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'Tipps'))
                                                                {
                                                                    echo'<li>Für Tipps zum Aufbau klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a>' . '</li>';
                                                                    $mastercounter++;
                                                                }
                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'classic-garden-elements.de'))
                                                                {
                                                                    if ( $category_detail[0]->term_id === 168 ) { 
                                                                    // IF beglongs to 'Rankgitter & Wandspaliere aus Metall' category

                                                                        echo '<li>Klicken Sie <a target="_blank" href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline">hier</a> für eine technische Zeichnung. ' . 'Sie benötigen ein Sondermaß? Klicken Sie <a target="_blank" href="https://www.classic-garden-elements.de/fertigung-auf-mass-design-service/" style="text-decoration:underline">hier</a></li>';
                                                                        
                                                                    } else {
                                                                        echo'<li>Klicken Sie <a target="_blank" href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline">hier</a> für eine technische Zeichnung' . '</li>';
                                                                    }
                                                                    $mastercounter++;
                                                                }
                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'www.ralfarbpalette.de'))
                                                                {
                                                                    echo'<li>Für eine Fotogalerie aller verfügbaren Farben klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a>' . '</li>';
                                                                    $mastercounter++;
                                                                }
                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'https://www.youtube.com'))
                                                                {
                                                                    echo'<li>Für ein Produkt Video klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a>' . '</li>';
                                                                    $mastercounter++;
                                                                }
                                                                else
                                                                {
                                                                    if($field_name!="Farbe" )
                                                                    {
                                                                        if ( $field_name=='Frachtfreie Lieferung in') {
                                                                            
                                                                            // Germanized
                                                                            $_product           = wc_get_product( $v );
                                                                            $_parent            = wc_get_product( $_product->get_parent_id() );
                                                                            $gzd_product        = wc_gzd_get_product( $_product );
                                                                            $gzd_parent_product = wc_gzd_get_product( $_parent );
                                                                            $delivery_time      = $gzd_product->get_delivery_time( 'edit' );

                                                                            // var_dump($delivery_time );

                                                                            if ($delivery_time) {
                                                                                echo '<li class="gzd-delivery-time">' . $delivery_time->description . '</li>';
                                                                            } elseif (wc_gzd_get_product( $product )->get_delivery_time_html()) {
                                                                                echo '<li class="gzd-delivery-time">' . wc_gzd_get_product( $product )->get_delivery_time_html() . '</li>';
                                                                            } else {
                                                                                echo '<li class="gzd-delivery-time">Lieferung erfolgt innerhalb von 2 Wochen</li>';
                                                                            }

                                                                            echo'<li>'.$field_name.': ' . get_post_meta($v, $label, esc_attr( $_text_field_label1)) . '</li>';

                                                                        } else {
                                                                            echo'<li>'.$field_name.': ' . get_post_meta($v, $label, esc_attr( $_text_field_label1)) . '</li>';
                                                                        }

                                                                        
                                                                    }
                                                                    
                                                                }
                                                                if($field_name=='Best.-Nr.' || $field_name=='Best-Nr.' || $field_name=='Best.-Nr' )
                                                                {
                                                                    $foundit=1;
                                                                }
                                                                if($foundit==1)
                                                                {
                                                                    if( has_term( 5497, 'product_cat' ) ) {
                                                                    // IF beglongs to 'Rankgitter Weiß' category

                                                                         if (isset($xColorValue) && $xColorValue !== '') {

                                                                            echo '<li>Farbe: ' . $xColorValue . '. Für andere Farben benötigen Sie einen <a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" style="text-decoration:underline">Farbzuschlag</a></li>';

                                                                        } else {
                                                                            echo '<li>Farbe: Weiß. Für andere Farben benötigen Sie einen <a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" style="text-decoration:underline">Farbzuschlag</a></li>';
                                                                        }

                                                                        


                                                                    }
                                                                    // if($variation_id="2507") {
                                                                    // IF product is variation 2507 (2nd Sissinghurst)
                                                                    //    echo '<li>Farbe: Rot-Braun. Für andere Farben benötigen Sie einen <a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" style="text-decoration:underline">Farbzuschlag</a></li>';
                                                                    // }
                                                                    else {

                                                                        if (isset($xColorValue) && $xColorValue !== '') {

                                                                            echo '<li>Farbe: ' . $xColorValue . '. Für andere Farben benötigen Sie einen <a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" style="text-decoration:underline">Farbzuschlag</a></li>';
                                                                            
                                                                        } else {

                                                                            echo '<li>Farbe: Schwarz. Für andere Farben benötigen Sie einen <a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" style="text-decoration:underline">Farbzuschlag</a></li>';
                                                                        }

                                                                        
                                                                    }
                                                                    $foundit=0;
                                                                }
                                                                
                                                            }



                                                            if($mastercounter==$countme)
                                                            {
                                                            /*  if($post->ID!="11342" && $post->ID!="11714" && $post->ID!="11354" && $post->ID!="13540" && $post->ID!="7992" && $post->ID!="16171" && $post->ID!="16177")
                                                                {
                                                                    /* if (isset($xDeliveryTimeValue) && $xDeliveryTimeValue !== '') {
                                                                        echo '<li>' . $xDeliveryTimeValue . '</li>';
                                                                    } else {
                                                                        echo '<li>Lieferung erfolgt innerhalb von 2 Wochen</li>';
                                                                    } */
                                                                    
                                                              /*  } */
                                                               // $mastercounter++;

                                                                if($post->ID=="374")
                                                                    {
                                                                        echo '<li>Ausführlicher Artikel  <a href="https://www.classic-garden-elements.de/kaskadenrosen-sorten-pflege/" style="text-decoration:underline">Prachtvolle Kaskadenrosen.</a></li>
                                                                         <li><a href="https://www.classic-garden-elements.de/wp-content/uploads/2020/04/kaskadenrosen-sorten-und-pflege.pdf" style="text-decoration:underline" target="_blank">PDF Download:</a> Kaskadenrosen: Beste Sorten und Tipps zur Pflege</li>';
                                                                    }
                                                            /*  if($post->ID=="13540" || $post->ID=="7992")
                                                                    {
                                                                        echo '<li>Lieferung erfolgt innerhalb von 2 Wochen</li>';
                                                                    }
                                                                if($post->ID=="16171" || $post->ID=="16177")
                                                                    {
                                                                        echo '<li>Lieferung erfolgt innerhalb von 2 Wochen</li>';
                                                                    } */
                                                            }

                                                      $j++;
                                                                              
                                                    endwhile;

                                                    // Germanized
                                                    /* if (wc_gzd_get_product( $product )->get_delivery_time_html()) {
                                                        echo '<li>' . wc_gzd_get_product( $product )->get_delivery_time_html() . '</li>';
                                                    } */
                                                    
                                                    echo '<li class="short-cta"><a href="' . $variation_url . '">In den Warenkorb</a></li>';
                                                    echo'</ul></div>';
                                                    // $class_var++;
                                                }

                                            } else { ?> 

                                                    <?php foreach ($varItems as $key => $vItems): 

                                                        $v = key($vItems);

                                                        // $v = each($vItems)['key']; // REF - https://stackoverflow.com/questions/16119992/get-array-value-with-unknown-key-name 

                                                        ?>

                                                        <div class="short-vars">
                                                                <ul>
                                                                    
                                                                        <?php $price = get_post_meta($v, '_price', true); ?>
                                                                        <li class="price"><?php echo wc_price( $price ); ?></li>
                                                                 
                                                                    <li>Inkl. MwSt.</li>

                                                                    <?php 

                                                                    $j = 0;                                                    
                                                                    $mastercounter = 0;
                                                                    $countme = 0;
                                                                    $foundit = 0;

                                                                    while ( have_rows('variation_labels') ) : the_row();
                                                                        $countme++;
                                                                    endwhile;
                                                                    
                                                                    while ( have_rows('variation_labels') ) : the_row();
                                                                            
                                                                            $mastercounter++;
                                                                            
                                                                            $field_name = get_sub_field('label');
                                                                            $label='_cstm_label_'.$j;
                                                                            $_text_field_label1 = $label.'['.$v.']';

                                                                            if( ! empty( $_text_field_label1 ) ) {
                                                                                
                                                                                if(strstr(get_post_meta($v, $label, esc_attr($label)),'...') )
                                                                                {
                                                                                    echo'';
                                                                                    $mastercounter++;
                                                                                }
                                                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'Aufbau'))
                                                                                                {
                                                                                                    echo'<li>Klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a> für eine Aufbau Anleitung' . '</li>';
                                                                                                    $mastercounter++;
                                                                                                }
                                                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'Tipps'))
                                                                                                {
                                                                                                    echo'<li>Für Tipps zum Aufbau für Rosenbögen mit Türen und Toren klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a>' . '</li>';
                                                                                                    $mastercounter++;
                                                                                                }
                                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'classic-garden-elements.de'))
                                                                                {
                                                                                    echo'<li>Klicken Sie <a target="_blank" href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline">hier</a> für eine technische Zeichnung' . '</li>';
                                                                                    $mastercounter++;
                                                                                }
                                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'www.ralfarbpalette.de'))
                                                                                {
                                                                                    echo'<li>Für eine Fotogalerie aller verfügbaren Farben klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a>' . '</li>';
                                                                                    $mastercounter++;
                                                                                }
                                                                                else if(strstr(get_post_meta($v, $label, esc_attr( $_text_field_label1)),'https://www.youtube.com'))
                                                                                {
                                                                                    echo'<li>Für ein Produkt Video klicken Sie <a href="'.get_post_meta($v, $label, esc_attr( $_text_field_label1)).'" style="text-decoration:underline" target="_blank">hier</a>' . '</li>';
                                                                                    $mastercounter++;
                                                                                }
                                                                                else
                                                                                {
                                                                                    if($field_name!="Farbe")
                                                                                    {
                                                                                        echo'<li>'.$field_name.': ' . get_post_meta($v, $label, esc_attr( $_text_field_label1)) . '</li>';
                                                                                    }
                                                                                    
                                                                                }
                                                                                if($field_name=='Best.-Nr.' || $field_name=='Best-Nr.' || $field_name=='Best.-Nr' )
                                                                                {
                                                                                    $foundit=1;
                                                                                }
                                                                                
                                                                                if($foundit==1)
                                                                                {
                                                                                    echo '<li>Farbe: Schwarz. Für andere Farben benötigen Sie einen <a href="https://www.classic-garden-elements.de/produkt/farbzuschlaege/" style="text-decoration:underline">Farbzuschlag</a> und geben die Farbe beim check-out ein.</li>';
                                                                                    
                                                                                    $foundit=0;   
                                                                                }
                                                                                

                                                                                
                                                                            }
                                                                            if($mastercounter==$countme)
                                                                            {
                                                                                if($post->ID!="11354")
                                                                                {
                                                                                    echo '<li>Lieferung erfolgt innerhalb von 2 Wochen</li>';
                                                                                }
                                                                               // $mastercounter++;
                                                                            }


                                                                      $j++;
                                                                                              
                                                                    endwhile;

                                                                    ?>
                                                                    

                                                                    <li class="short-cta">
                                                                        <select name="" class="cls_select_color">
                                                                            
                                                                            <option value="" data-url="">Farbe auswählen</option>

                                                                            <?php foreach ($vItems as $vItem_key => $vItem): 

                                                                                $taxonomy = 'pa_item';
                                                                                $var_slug = get_post_meta($vItem_key, 'attribute_' . $taxonomy, true);
                                                                                
                                                                                $variation_url = add_query_arg(array(
                                                                                    'add-to-cart' => $product_id,
                                                                                    'variation_id' => $vItem_key,
                                                                                    'attribute_' . $taxonomy => $var_slug,
                                                                                        ), $cart_url);

                                                                                $variation_img = new WC_Product_Variation( $vItem_key );
                                                                                $image_id = $variation_img->image_id;

                                                                                $image_array = wp_get_attachment_image_src($image_id, 'full');
                                                                                $image_src = $image_array[0];

                                                                            ?>
                                                                                
                                                                            <option data-img="<?php echo $image_src; ?>" value="<?php echo $vItem_key; ?>" data-url="<?php echo $variation_url; ?>"><?php echo str_replace('colours: ', '', $vItem); ?></option>

                                                                            <?php endforeach; ?>
                                                                            
                                                                        </select>
                                                                        <a href="#" class="variation-link">In den Warenkorb</a>
                                                                    </li>
                                                                </ul>
                                                        </div>
                                                        
                                                    <?php endforeach; ?>

                                                    

                                            <?php  } // !is_single(11354)





                                        }
                                ?>
                               
                                <?php if($post->ID!="11342") : ?>

                                    <div class="jumptodetails" style="padding-bottom:15px;">
                                        <h4><a style="font-size:0.80em !important;" href="#Produktdetails"><i class="fas fa-arrow-alt-circle-right"> vollst&auml;ndige Produktdetails anzeigen</i></a></h4>
                                    </div>

                                <?php endif; ?>

                                    </div>

                                    <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="apni_class"></div>
                    </section>
                </div>
                <!-- --------------------- sidebar section------------------------- -->
                <div class="col-sm-4 col-md-4 desktoponly">
                    <div class="productRight tempRight singleRight cgeSideBar">
                        <div class="imgObject1 single-product-image desktop">
                            <?php
                                if (has_post_thumbnail()) { 

                                    $imgID  = get_post_thumbnail_id($post->ID);
                                    $imgAlt = get_post_meta($imgID,'_wp_attachment_image_alt', true); ?>
                           <a  data-fancybox="gallery" data-alt="<?php echo $imgAlt; ?>" href="<?=get_the_post_thumbnail_url()?>">
                           <?php
                                the_post_thumbnail();
                           ?>
                         </a>
                         <?php
                                }
                         ?>
                        </div>
  
                        <?php dynamic_sidebar('single-product-sidebar'); ?>
                    </div>
                </div>
            <!-- --------------------- end sidebar section------------------------- -->
            </div>
            
            <!-- ---------------- images gallery section------------- -->

            <?php global $product; $attachment_ids = $product->get_gallery_image_ids(); 

            if ($attachment_ids) : ?>

            <section class="gallerySection">
                <div class="row">
                <div class="col-sm-12 col-md-12">
                    <h2 class="productHeader">Produktbilder</h2>
                </div>
                    </div>
                <main role="main">
                    <div class="loader-wrapper">
                        <div class="loader"></div>
                    </div>
                    <div class="gallery clearfix">
                        <?php
                        // global $product;
                        // $attachment_ids = $product->get_gallery_image_ids();
                        if ($attachment_ids) {
                            foreach ($attachment_ids as $attachment_id) {
                                $image_link = wp_get_attachment_url($attachment_id);
                                $image_alt  = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true);
                                $image_title  = get_the_title( $attachment_id, '_wp_attachment_image_title', true);
                                $caption = get_post( $attachment_id )->post_excerpt;
                                ?>
                                <?php
                                echo'<div class="grid-item"><figure><a style="display:inline-block; float:left;" data-fancybox="gallery" href="' . $image_link . '"><img data-pin="pinIt" class="picture" src="' . $image_link . '" alt="' . $image_alt . '" title="' . $image_title . '"><figcaption style="font-size:17px;">' . $caption . '</figcaption></a></figure></div>';
                                // echo'<a data-fancybox="gallery" href="' . $image_link . '"><img data-pin="pinIt" class="picture" src="' . $image_link . '" alt="' . $image_alt . '" title="' . $image_title . '"></a>';
                            }
                        }
                        ?>
                    </div>
                </main>
            </section>

            <?php endif; ?>
            <!-- ---------------- end images gallery section------------- -->
            <?php
            if($post->ID=="11354")
            {
            ?>
                        <section class="txtSection sections">
                            <div class="row">
                                 <div class="col-md-12 col-sm-12"><?php the_field('product_short_description_three'); ?></div>
                             </div>
                        </section>

            <?php 
                }
            ?>


        </div> <!--box End-->
        
        <!-- ---------------- all products details section------------- -->
        <?php
            if($post->ID!="11342" && $post->ID!="11714" && $post->ID!="11354")
            {
        ?>
                <section class="productdetailSection">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                            <h2 class="productHeader" id="Produktdetails">Produktdetails</h2>
                      </div>
                        <div class="col-sm-12 col-md-12">
                                        <div class="tableBox">
                                <div class="innertable">                            
                                    <?php
                                    if($vars)
                                    {
                                        global $woocommerce;
                                        $cart_url = wc_get_cart_url();
                                        $coulumn=0;
                                        $total_vars = count($vars);
                                        
                                       
                                    }       

                                        ?>

                                            </div>
                                                </div>
                                        </div>
                                </div>
                        </section>
                        <!-- ---------------- all products details section end------------- -->
        <?php       
            }
        ?>
       
        <!-- || Weitere Produkte Section || --> 
        <section class="productSection sections">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <h2 class="productHeader">Weitere Produkte</h2>
                </div>
        </div>
        <div class="Box1 boxChild">
            <ul class="fiveChild" style="margin-top: 0px;">
                <?php
                if(get_field('product_groups_6_column',4))
                {
                foreach (get_field('product_groups_6_column',4) as $key => $productGroupSix) {
                    
                    $termIDSix[] = $productGroupSix['product_group_category_item_two'];
                    
                }

                foreach ($termIDSix as $prod_cat) :
                    $term = get_term_by( 'id', $prod_cat, 'product_cat' );
                    $product_cat_name=$term->name;
                    $term_link= site_url().'/produkt-kategorie/'.$term->slug;
                    
                    ?>
                    <li>
                        <div class="boxInner">
                                <?php
                                global $wp_query;
                                            $cat = $wp_query->get_queried_object();
                                            $thumbnail_id = get_term_meta( $prod_cat, 'thumbnail_id', true );
                                            //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_ID ),'homepage-category-image');
                                            $image = wp_get_attachment_image_src( $thumbnail_id,'homepage-category-product-image');
                                            $alt   = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);
                                            if ( $image ) {
                                                ?>
                                                <a href="<?php echo $term_link; ?>/">
                                                <?php
                                                    echo '<img src="' . $image[0] . '" alt="' . $alt . '" />';
                                    }
                                 ?>
                                <div class="imgContent">
                                    <p class="txtRank"><a class="firstWord"><?php echo $product_cat_name; ?></a></p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <?php 
                    endforeach; 
                    }
                    ?>
            </ul>
        </div>
        </section>
    <!-- || Weitere Produkte Section End || -->
    </section>

    <!-- || Product Section End || -->
<!-- || Service Section || -->  
    <section class="serviceSection sections" id="serviceSection">
        <h2>Service</h2>
        <?php dynamic_sidebar('service_bottom_section'); ?>
    </section>
    <!-- || Service Section End || -->

<!--</div>-->

<!-------------------------------------------------------------->

<?php do_action('woocommerce_after_single_product'); ?>

<script>
    
    jQuery(function($) {

        var d = $('.single-product-image > a > img').attr('src');

        $('.cls_select_color').change(function() {

            $('.single-product-image > a > img').css('opacity', '0.3');

            $('.cls_select_color').not($(this)).prop('selectedIndex',0);
            $('.cls_select_color').not($(this)).next().attr('href', '#');
            $('.cls_select_color').not($(this)).next().css({ 'opacity' : '0.6', 'pointer-events' : 'none' });

            if ($(this).val()) {
                let val = $(this).val();
                let url = $(this).find('[value="' + val + '"]').data('url');
                let img = $(this).find('[value="' + val + '"]').data('img');

                $('.single-product-image > a').attr('href', img);
                $('.single-product-image > a > img').attr('src', img);
                $('.single-product-image > a > img').attr('srcset', '');
                $('.single-product-image > a > img').css('opacity', '1');

                // console.log(url);
                $(this).next().attr('href', url);
                $(this).next().css({ 'opacity' : '1', 'pointer-events' : 'initial' });
            } else {

                $('.single-product-image > a').attr('href', img);
                $('.single-product-image > a > img').attr('src', d);
                $('.single-product-image > a > img').css('opacity', '1');

                $(this).next().attr('href', '#');
                $(this).next().css({ 'opacity' : '0.6', 'pointer-events' : 'none' });
            }
        });
    });

    /* jQuery(function($) {
        $('.cls_select_color').change(function() {
            if ($(this).val()) {
                let val = $(this).val();
                let url = $(this).find('[value="' + val + '"]').data('url');
                // console.log(url);
                $(this).next().attr('href', url);
                $(this).next().css({ 'opacity' : '1', 'pointer-events' : 'initial' });
            } else {
                $(this).next().attr('href', '#');
                $(this).next().css({ 'opacity' : '0.6', 'pointer-events' : 'none' });
            }
        });
    }); */
</script>