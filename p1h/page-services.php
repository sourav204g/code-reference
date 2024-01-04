<?php

/**
 * Template Name: All Services
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro

 */

function handyman_service_count($id) {

  $args = array(
    'post_type' => 'services',
    'tax_query' => [
          [

            'taxonomy' => 'service_categories',
            'terms' => $id,
          ],

      ],
  );

  $handyman_services = get_posts($args);

  $service_count = 0;

  foreach ( $handyman_services as $key => $handyman_service ) {

    if(get_field('handyman_post_type', $handyman_service->ID)['value'] !== 'product') {

      $service_count++;

    }

  }

  return $service_count;

}

get_header(); ?>



  <style type="text/css">
    
.service-pro2 .handyman-servbox {
    border: 1px solid #eeefed;
    padding: 15px 20px 30px;
    margin-bottom: 25px;
}
.service-pro2 .handyman-servbox h3 {
    font-size: 21px;
    line-height: 26px;
    text-align: left;
    padding-bottom: 10px;
    margin-bottom: 10px;
    border-bottom: 1px solid #eeefed;
    color: #f2ae00;
    text-transform: capitalize;
}
.service-pro2 .handyman-servbox ul {
    list-style: outside none none;
    margin: 10px 0 10px;
    padding: 0;
    max-height: 920px;
    /*height: 100vh;*/
    overflow: auto;
}
.service-pro2 .handyman-servbox ul li {
    padding-bottom: 5px;
    margin-bottom: 0px;
}
.service-pro2 .handyman-servbox ul li a {
    font-size: 16px;
    line-height: 26px;
    text-align: left;
    color: #000000;
    text-transform: capitalize;
    font-weight: 500;
}
.service-pro2 .handyman-servbox ul li a:hover {
    font-size: 16px;
    color: #f2ae00;
    text-decoration: none;
}
.service-pro2 .handyman-servbox .sev-but {
    border: 1px solid #000000;
    padding: 8px 10px 8px 15px;
    background: #ffffff;
    font-size: 16px !important;
    line-height: 22px;
    position: relative;
    text-decoration: none;
    color: #000;
    display: inline-block;
    margin-top: 0.2rem;
}
.service-pro2 .handyman-servbox .sev-but:hover {
    border: 1px solid #323232;
    background: #323232;
    color: #fff;
}
/* width */
.service-pro2 .handyman-servbox ul::-webkit-scrollbar {
  width: 6px;
}

/* Track */
.service-pro2 .handyman-servbox ul::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
.service-pro2 .handyman-servbox ul::-webkit-scrollbar-thumb {
  background: #e1e1e1; 
}

ul.sub-cat-srv-list {
    /*max-height: 100px!important;*/
    width: 88%;
    margin: 5px!important;
}
ul.sub-cat-srv-list li {
    padding: 0px 0 0 10px!important;
    line-height: 2px!important;
}
ul.sub-cat-srv-list li a {
    font-size: 15px!important;
    font-weight: 400!important;
    letter-spacing: -0.4px;
    line-height: 26px!important;
}

.service-pro2 h2 {
    font-size: 30px;
    line-height: 30px;
    text-align: left;
    padding-bottom: 0px;
    margin-bottom: 30px;
    color: #f2ae00;
}

  .essential-home-services .service-pro3, .home-improvement-projects .service-pro3, .remodeling-products .service-pro3 {
    display: flex;
    flex-wrap: wrap;
  }

.essential-home-services .service-pro3 > .col-md-4, .home-improvement-projects .service-pro3 > .col-md-4, .remodeling-products .service-pro3 > .col-md-4 { order: 99; }

  </style>
</head>
<body>

  <section class="service-page-sec">
        <div class="block no-padding">
            <div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php echo get_field('handyman_pro_pages_hero_banner')['url']; ?>) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                            <h3><?php the_title(); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


  <?php get_template_part( 'template-parts/content', 'essential-home-services' ); ?>

  <?php get_template_part( 'template-parts/content', 'home-improvement-projects' ); ?>

  <?php get_template_part( 'template-parts/content', 'remodeling-products' ); ?>

<?php get_footer(); ?>