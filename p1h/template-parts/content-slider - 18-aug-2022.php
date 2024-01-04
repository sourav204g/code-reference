<style>
    
    section.home-banner-section {
        margin-top: 2rem;
    }
   
    .mob-slider-txt {
        display: none;
    }

    .main-slider-left-sec {
        background-color: #e6b46b;
        /* max-height: 438px; */
        padding: 2.7rem 2rem 0;
        background-size: contain;
        background-position: center bottom;
        background-repeat: no-repeat;
        
    }
    .main-slider-left-sec h4 {
        color: black;
        font-weight: 600!important;
        font-size: 38px;
        text-align: left;
        line-height: 48px;
        letter-spacing: -0.9px;
    }
    .main-slider-left-sec .or-browser {
        margin: 15px;
    }
    .main-slider-left-sec .or-browser ul li {
        font-size: 18px;
        color: #615f5f;
        line-height: 33px;
        font-weight: 600;
        letter-spacing: 0.6px;
    }
    .main-slider-left-sec ul li img {
        filter: grayscale(1) invert(1);
    }
    .main-slider-left-sec .bullets85 {
        text-align: left;
        padding: 1.5rem 1rem;
        display: table;
    }
    .main-slider-left-sec span {
        color: #000;
        font-weight: 500;
        font-size: 16px;
    }
    .main-featured-sec {
        /*max-height: 438px;*/
    }
    ul.main-slider-sec {
        /* max-height: 333px;
        height: 100vh; */
        overflow: hidden;
    }
    ul.main-slider-sec .slideHome {
        /*max-height: 438px !important;*/
        height: 100%!important;
    }
    li.slideHome img {
        height: fit-content;
        max-height: 613px;
        object-fit: cover;
        object-position: right;
    }
    .main-slider-sec::before {
        background: transparent;
    }
    .main-slider-sec img {
        opacity: 1;
    }

    @media screen and (max-width: 1200px) {

      section.home-banner-section {
            margin-top: 0rem;
        }

        ul.main-slider-sec {
            max-height: 493px;
        }
        .main-slider-left-sec {
            padding: 1.5rem 2rem 0;
        }
        .main-slider-left-sec h4 {
            font-size: 31px;
            line-height: 43px;
        }
    }

    @media screen and (max-width: 992px) {
        
           .main-slider-left-sec {
            display: none;
        } 
        .job-search-sec.mob-slider-txt {
            display: block;
            width: 65%;
        }
        .home-slider-wrapper .main-slider-sec .slick-arrow {
            display: block !important;
        }
    }

    @media screen and (max-width: 576px){
        .job-search-sec.mob-slider-txt {
            width: 100%;
            padding: 1rem 3rem!important;
        }
    }

</style>
<section class="home-banner-section">
    <div class="block no-padding">
        <div class="fix-wrap">
            <div class="row">
                <div class="col-lg-12 home-slider-wrapper" style="padding-left:0;">
                    <div class="main-featured-sec">
                        <ul class="main-slider-sec text-arrows">
                        <!--
                        <li><img src="<?php bloginfo('template_directory');?>/assets/images/handyman-banner1.jpg"></li>
                     -->
                     <?php 
                            // check if the repeater field has rows of data
                            if( have_rows('hnd_home_page_sliders') ):
                            // loop through the rows of data
                            while ( have_rows('hnd_home_page_sliders') ) : the_row(); ?>

                            <?php if (get_sub_field('select_hnd_home_slider_image')): ?>

                                <li>
                                    <img src="<?php echo get_sub_field('hnd_home_slider_image')['url']; ?>" alt="<?php echo get_sub_field('hnd_home_slider_image')['alt']; ?>" />
                                </li>
                                
                            <?php endif; ?>
                            
                            

                            <?php       
                                endwhile;
                            endif; ?>
                        </ul>
                        <div class="job-search-sec mob-slider-txt">
                            <div class="job-search">
                            
                                <h4>One Call Handyman Can Solve All Your House Problems</h4>
                                <span>US Patent 7,774,233</span>
                            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
