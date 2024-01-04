<style>

body{
    position: relative;
    overflow: hidden;
}

section.new-category-menu-sec {
    background: #525252;
    z-index: 1;
}


/**/

ul.category-parent-ul {
    margin: 0;
}
ul.category-parent-ul li {
    display: inline-block;
    margin-bottom: 0;
}
ul.category-parent-ul li a {
    margin: 0 5px;
    padding: 16px!important;
    color: white;
    position: relative;
}
.category-pop-submenu-sec {
    background: #fff!important;
    padding: 2rem;
    width:100%!important;
    border-top: none!important;
}
.category-pop-submenu-sec ul li {
    width: calc(100% / 7 - 3px);
    display: inline-block;
    padding: 16px;
    text-align: center;
    font-weight: 600;
    margin-bottom: 0;
}
.category-pop-submenu-sec ul li a {
    color: #1e1e1e;
    display: table;
}
.category-pop-submenu-sec ul li a img {
    margin-bottom: 1rem;
    max-height: 140px;
    height: 100vh;
    width: 100%;
    /*object-fit: cover;*/
    object-position: bottom;
}
ul.category-parent-ul li.nav-item:nth-child(1) a {
    /* background: black;*/
    margin: 0;
}
ul.category-parent-ul li .dropdown-toggle::after{
    display: none;
}
.category-pop-submenu-sec ul li:nth-child(4) {
    border: solid 1px rgb(128 128 128 / 44%);
}

.overlay-bg{
    position: absolute;
    width:100%;
    top:0;
    bottom: 0;
    left:0;
    right: 0;
    background: rgb(30 30 30 / 90%);
    z-index: 0;
    transition: 0.7s ease;

}

.category-parent-ul li .dropdown-toggle .current {
    content: "";
    position: absolute;
    bottom: -4px;
    z-index: 9;
    left: 50%;
    border-top: 8px solid rgb(255 255 255);
    border-left: 11px solid rgb(255 255 255);
    border-right: 11px solid rgb(255 255 255);
    border-bottom: 8px solid #ffffff;
    width: 6px;
    clip-path: polygon(47% -4%, -4% 80%, 97% 78%);
    transform: translateX(-50%);
}

@media screen and (max-width: 1600px) {

    ul.category-parent-ul li a {
    margin: 0 2px;
    padding: 16px 14px!important;
}
}
@media screen and (max-width: 1366px){
    
ul.category-parent-ul li a {
    margin: 0 1px;
    padding: 16px 8px!important;
}
}

</style>

<section class="new-category-menu-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <nav class="navbar navbar-expand-lg">
                    <ul class="category-parent-ul">

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php // echo home_url('/all-services/'); ?>"> SEE ALL CATEGORIES  </a></li> -->

                        <?php 

                        function wp_get_menu_array($current_menu) {

                                            $array_menu = wp_get_nav_menu_items($current_menu);
                                            
                                            $menu = array();
                                            
                                            foreach ($array_menu as $m) {

                                                if (empty($m->menu_item_parent)) {

                                                    $menu[$m->ID] = array();
                                                    $menu[$m->ID]['ID']      =   $m->ID;
                                                    $menu[$m->ID]['title']       =   $m->title;
                                                    $menu[$m->ID]['url']         =   $m->url;
                                                    $menu[$m->ID]['children']    =   array();
                                                }
                                            }

                                            $submenu = array();
                                            
                                            foreach ($array_menu as $m) {

                                                if ($m->menu_item_parent) {

                                                    $submenu[$m->ID] = array();
                                                    $submenu[$m->ID]['ID']       =   $m->ID;
                                                    $submenu[$m->ID]['title']    =   $m->title;
                                                    $submenu[$m->ID]['url']  =   $m->url;
                                                    $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
                                                }
                                            }

                                            return $menu;

                        }

                        $menu_name = 'menu-6';

                        $locations = get_nav_menu_locations();

                        $menu_items = wp_get_menu_array(  $locations[ $menu_name ] );     

                    
                        foreach ( $menu_items as $key => $menu_item ) : ?>

                            <li class="nav-item <?php echo ( !empty($menu_item['children']) ) ? ' dropdown has-megamenu' : ''; ?>">
                                <a class="nav-link dropdown-toggle" href="<?php echo $menu_item['url']; ?>" data-toggle="dropdown"> <?php echo $menu_item['title']; ?></a>

                                <?php if (!empty($menu_item['children'])): ?>
                                    
                                <div class="dropdown-menu megamenu category-pop-submenu-sec ">
                                    <ul>

                                    <?php foreach ($menu_item['children'] as $key => $child): ?>

                                        <li><a href="<?php echo $child['url']; ?>">

                                            <?php if (get_field('hnd_cat_image_thumbnail', $child['ID'])['url']): ?>

                                                <img src="<?php echo get_field('hnd_cat_image_thumbnail', $child['ID'])['url']; ?>" alt="<?php echo get_field('hnd_cat_image_thumbnail', $child['ID'])['alt']; ?>" class="img-fluid"><?php echo $child['title']; ?>

                                            <?php else: ?>

                                                <img src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/images/default-png02.png" alt="<?php echo $child['title']; ?>" class="img-fluid"><?php echo $child['title']; ?>
                                                
                                            <?php endif; ?>

                                            
                                        </a></li>
                                        
                                    <?php endforeach; ?>

                                    </ul>
                                </div>

                                <?php endif; ?>
                            </li>

                        <?php endforeach; ?>

                 </ul>
             </nav>





         </div>
     </div>
 </div>
</section>

<script>

    jQuery(document).ready(function(){
          
          jQuery(".new-category-menu-sec li.has-megamenu").mouseover(function() {
              jQuery(this).find('a').append("<span class='current'></span>");
              jQuery('body').append("<div class='overlay-bg'></div>");
          });
            
          jQuery(".new-category-menu-sec").mouseout(function() {
              jQuery('.current').remove();
              jQuery('.overlay-bg').remove();
          });
    
    });


</script>