<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package search-flow
 */

?>

	 <div class="footer-position">

        <footer class="footer">

            <div class="container">

                <div class="row">

                    

                </div>

                <div class="row">

                    <div class="col-md-4 col-sm-12 col-xs-12">

                        <div class="section-title text-left">

                      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" width="150" alt="Search Flow LLC Logo">

                        </div><!-- end title -->



                        <p>Being a digital marketing company, we’re redefining the experience for digital marketing services. For more than 8 years, we’ve been creating powerful brand experiences for our clients worldwide. Our team of 80+ marketing experts, designers, coders, and project managers know the right technology</p>

                    </div><!-- end col -->



                    <div class="col-md-2 col-sm-12 col-xs-12 hidden-xs hidden-sm">

                        <div class="section-title text-left">

                            <h5><strong>Quick Links</strong></h5>

                        </div><!-- end title -->



                        <div class="menu-widget">

                            <ul class="check checl-line">

                                <li><a href="/">Home</a></li>
								<li><a href="https://www.search-flow.com/blog">Blog</a></li>
                                <li><a href="https://www.search-flow.com/our-company.php">Our Company</a></li>
                                <li><a href="https://www.search-flow.com/testimonial.php">Client Testimonial</a></li>
                                <li><a href="https://www.search-flow.com/local-citation.php">Local Citation</a></li>
                                <li><a href="https://www.search-flow.com/social-media.php">Social Media</a></li>
                                <li><a href="https://www.search-flow.com/contact-us.php">Contact</a></li>								

                            </ul><!-- end check -->

                        </div><!-- end menu-widget -->

                    </div><!-- end col -->



                     <div class="col-md-3 col-sm-12 col-xs-12 hidden-xs hidden-sm">

                        <div class="section-title text-left">

                            <h5><strong>Services</strong></h5>

                        </div><!-- end title -->
                        <div class="menu-widget">
                            <ul class="check checl-line">
                                <li><a href="https://www.search-flow.com/website-design.php">Website Design</a></li>     
                                <li><a href="https://www.search-flow.com/cms-development.php">CMS Development</a></li>
                                <li><a href="https://www.search-flow.com/php-development.php">Framework/PHP Development</a></li>
                                <li><a href="https://www.search-flow.com/ecommerce.php">Ecommerce</a></li> 
                                <li><a href="https://www.search-flow.com/seo.php">Search Engine Optimization</a></li>
                                <li><a href="https://www.search-flow.com/ppc.php">PPC</a></li>
                                
                            </ul><!-- end check -->
                        </div><!-- end menu-widget -->
                    </div><!-- end col -->
                     <div class="col-md-3 col-sm-12 col-xs-12 hidden-xs hidden-sm">

                        <div class="section-title text-left">

                            <h5><strong>Office Address</strong></h5>

                        </div><!-- end title -->



                        <div class="menu-widget">
                            <ul class="check">
                                <li>11140 Rockville pike suite 400, <br> Rockville MD 20852.</li>
                                <li>Email : <a href="mailto: Info@search-flow.com">Info@search-flow.com</a></li>
                                <li>Phone : <a href="tel: +1-202-322-7538">+1-202-322-7538</a></li>
                                <li></li>

                            </ul><!-- end check -->

                        </div><!-- end menu-widget -->

                    </div>

                </div>

                <div class="row footer-border">

                    <div class="copyrights">

                    <div class="container" style="margin:0px; padding:0px;">

                        <div class="row">

                        

                        <div class="col-md-4">

                            <ul class="bluts" style="text-align:center; width:100%">

                            <li><a target="blank" href="https://www.facebook.com/Search-Flow-220217901873703/"><i class="fab fa-facebook"></i></a></li>

                            <!-- <li><a target="blank" href="#"><i class="fab fa-google-plus"></i></a></li> -->

                            <li><a target="blank" href="https://twitter.com/SearchFlowUS"><i class="fab fa-twitter"></i></a></li>

                            <li><a target="blank" href="https://www.instagram.com/search.flow/"><i class="fab fa-instagram"></i></a></li>

                            <li><a target="blank" href="https://in.pinterest.com/SearchFlowUS/"><i class="fab fa-pinterest"></i></a></li>

                            <li><a target="blank" href="https://www.linkedin.com/company/search-flow/"><i class="fab fa-linkedin"></i></a></li> 

                        </ul>

                       </div>

                       <div class="col-md-4 text-center" style="padding-top: 5px;">

                            © Copyright 2002-2018 Search Flow

                        </div>

                        <div class="col-md-4">

                            <div class="ft-top-link text-right">

                               <a href="#"> Terms of Service</a>

                               <a href="#"> Privacy Policy</a>

                               <!-- <a href="#"> Sitemap</a> -->

                           </div>

                        </div>

                        </div>

                    </div> 

                </div>

                </div>

            </div>

        </footer>

    </div>

    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/box-slide02.js" defer data-require='["sa"]'></script>

    <script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.js"></script>

    <script src="<?php bloginfo('template_directory'); ?>/js/plugins.js"></script>
	
	   


    <script type="text/javascript">

        $(document).ready(function(){

            $(".btn").click(function(){

                $("article").slideToggle("slow");

            });

        });

    </script>


 <!--start jquery mask -->
<script src="<link href="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.mask.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
  
  $('.phone').mask('000-000-0000');
</script>
<!--end jquery mask -->
<?php wp_footer(); ?>
</body>
</html>
