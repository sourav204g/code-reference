<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.2
 */

?>

<script>

  jQuery('#woocommerce-product-search-field-1').attr('placeholder', 'Suchbegriff eingeben');
  jQuery('#woocommerce-product-search-field-2').attr('placeholder', 'Suchbegriff eingeben');
  jQuery('.woocommerce-product-search [type="submit"]').attr('value', 'Suchen');
  
  // console.log('sourav');
  let urlParams = new URLSearchParams(window.location.search);
  if( urlParams.has('orderby') && urlParams.get('orderby') === 'date' ){
      jQuery('.productSection .row .innerField').each(function(){
        if ( jQuery(this).find('.boxInner .imgContent p a').text() == 'Viktorianischer Rosenbogen Brighton' || jQuery(this).find('.boxInner .imgContent p a').text() == 'Metall Rosenbogen Portofino mit Versailler Kübeln' || jQuery(this).find('.boxInner .imgContent p a').text() == 'Metall Rosenbogen Brighton mit Versailler Kübeln' || jQuery(this).find('.boxInner .imgContent p a').text() == 'Japanischer Torbogen Torii' || jQuery(this).find('.boxInner .imgContent p a').text() == 'Rosenhalbbogen Bagatelle' || jQuery(this).find('.boxInner .imgContent p a').text() == 'Viktorianischer Rosenbogen Kiftsgate' || jQuery(this).find('.boxInner .imgContent p a').text() == 'Romanischer Rosenbogen Bagatelle' ) {

          jQuery(this).remove();

        }
        
      });

  } 

</script>


</div>
<div class="container paddingNone transparnt line">
        <section class="socialSection fotter-social">

                <div class="row">
                        <div class="col-md-12 col-sm-12">
                                <?php dynamic_sidebar( 'social_icon' ); ?>
                        </div>
                </div>


        </section>
</div>


<!-- || Fooper Section || -->
<div class="container paddingNone transparnt">
    <section class="FooterSection">

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?php dynamic_sidebar('copy_right'); ?>

            </div>
            <div class="col-md-6 col-sm-6 text-right">
                <?php
                dynamic_sidebar('footer_links');
                ?>
            </div>
        </div>
    </section>
</div>
<!-- || Fooper Section End || --> 


</div><!-- #page -->

<script type="text/javascript">

 jQuery(document).ready(function(){
    
    is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
    is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
    is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
    is_safari = navigator.userAgent.indexOf("Safari") > -1;
    is_opera = navigator.userAgent.indexOf("Presto") > -1;
    is_mac = (navigator.userAgent.indexOf('Mac OS') != -1);
    is_windows = !is_mac;

    if (is_chrome && is_safari){
      is_safari=false;
    }
    if (is_safari || is_windows){
      jQuery('body').css('-webkit-text-stroke', '0.1px');
    }

  });

</script>

<?php wp_footer(); ?>

<script language="javascript">

  jQuery("[data-fancybox]").fancybox({
    afterLoad: function (instance, slide) {
       jQuery(".fancybox-image").attr("alt", slide.opts.$orig.data('alt'));
    }
  });

  jQuery('.hnd-tag-filter, .hnd-tag-filter1, .hnd-tag-filter2, .hnd-tag-filter0').change(function(){
    let link = jQuery(this).val();
    window.location.href = link;
  });

  jQuery('[name="order_comments"]').prop('placeholder', 'Anmerkungen zu Ihrer Bestellung:');
	
</script>

</body>
</html>
