<!-- Banner Section One Start -->
<section class="banner-one">
    <div class="banner-bg-slide"
        data-options='{ "delay": 5000, "slides": <?php echo json_encode($gallery_arr); ?>, "transition": "fade", "timer": false, "align": "top" }'>
    </div><!-- /.banner-bg-slide -->

    <div class="container">
        <div class="content-box">
            <div class="top-title">
                <div class="sub-title">Let’s Explore</div>
                <h1><?php echo get_field('traveltographer_hero_image_title'); ?></h1>
                <p><?php echo get_field('traveltographer_hero_image_sub_title'); ?></p>
            </div>
            <form class="banner_one_form select_one">
                <ul class="input_box_inner list-unstyled">
                    <!-- <li class="input_box">
                        <input type="text" name="listing_name" placeholder="What are you looking for?">
                    </li> -->
                    <li class="input_box banner_one_select_one">
                        <select class="selectpicker" data-width="100%">
                            <option selected="selected">Enter Your Destination Name</option>
                            <option>UAE</option>
                            <option>India</option>
                            <option>Pakistan</option>
                        </select>
                    </li>
                    
                </ul>
                <div class="banner_one_form_btn">
                    <button class="thm-btn" type="submit"><span
                            class="icon-magnifying-glass"></span>Search</button>
                </div>
            </form>
        </div>
        <div class="banner_one_bottom">
            <div class="banner_one_bottom_bg"
                style="background-image: url(<?php bloginfo('stylesheet_directory'); ?>/assets/images/shapes/banner-1-shape-1.png)">
            </div>
            <p>Or browse the selected Destination</p>
        </div>
    </div>
</section>