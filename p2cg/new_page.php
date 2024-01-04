<?php /* Template Name: New Landing Page */ ?>
<?php
/**
 * The template for displaying all pages
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


<div class="container pflanzkuebel bgd">
    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/pflanzkuebel-banner.png"/> 
</div>

<div class="container pflanzkuebel bgd">
    <ul class="primary-menu2">
        <li><a href="#">Shop</a>
        <div  class="roundbox"></div>
        </li>
        <li><a href="#">Angebote</a>
        <div  class="roundbox"></div>
        </li>
        <li><a href="#">Service</a>
         <div  class="roundbox"></div>
        </li>
        <li><a href="#">Überuns</a>
        <div  class="roundbox"></div>
        </li>
        <li><a href="#">Blog</a>
        
        </li>
    </ul>
</div>


<div class="container containerPadding pflanzkuebel">

    <!-- || Text Section End || -->     

    <section class="txtSection sections box-40">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1 class="head8">Metall Rosenbögen & Rankgitter aus eigener Produktion</h1>
             </div>
        </div>

         <div class="row dgbox">
            <div class="col-md-6 col-sm-12">
                <h3>Klassische Designs verbunden,<br/> mit hohem handwerklichen Anspruch</h3>
                <p>Classic Garden Elements steht seit 1998 für Design & Qualität im Garten. Gärtnerischer Luxus für den privaten Raum und öffentliche Parks. Wir entwerfen und fertigen Metall Gartenpavillons, Rosenbögen, Rankgitter, Rankhilfen, Laubengänge, Metallpavillons, Rankgerüste, Rosenpavillons und Metall Pflanzkübel in garantiert bester handwerklicher Ausführung. Mit 50 Mitarbeitern produzieren wir für Ihren Erfolg im Garten. Im Standardmaß oder als Sonderbestellung.</p>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="img-left">
                    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/box-icon01.png"/>
                </div>
                <div class="img-right">
                    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/sws-img01.jpg"/>
                </div>
            </div>
        </div>

        <div class="row dgbox2">

            <div class="col-md-6 col-sm-12">
                <div class="img-left bd88">
                    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/box-icon02.png"/>
                </div>
                <div class="img-right">
                    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/sws-img02.jpg"/>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <h3>Erstklassiger Service <br/> und Qualität die man sieht</h3>
                <p>Alle Rankelemente kommen aus unserer eigenen Produktion. Sie sind aus massiven Stahlbändern und Stahlrohren geschweißt, feuerverzinkt und pulverbeschichtet gegen Rost mit 10-jähriger Garantie. Optional lackieren wir jedes Rankgitter in der gewünschten RAL-Farbe. Unser eigenes Montageteam baut Ihnen gerne größerer Projekte vor Ort auf. Classic Garden Elements liefert Fachkompetenz in jeder Phase der Gartenplanung. Wir stehen Ihnen mit Rat und Tat zur Seite.</p>
            </div>
            
        </div>


        <div class="row dgbox">
            <div class="col-md-6 col-sm-12">
                <h3>Gartenarchitektur<br/>  für höchste Ansprüche</h3>
                <p>Ein antiker Pinienzapfen aus dem Vatikanischen Museum in Rom wurde zum Markenzeichen unseres Unternehmens. In ihm spiegelt sich die Harmonie und Schönheit der Natur. Eine Bildhauerin schuf 1997 das Gussmodell hierfür, basierend auf dem alten etruskischen Original. Dieser antike Zapfen, in seiner unmittelbar ansprechenden, völlig zeitlosen Attraktivität von Form und Material steht sinnbildlich für unser Firmenkonzept: Faszinierende Gärten und glückliche Kunden.</p>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="img-left bd89" style="vertical-align: bottom;">
                    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/box-icon03.png"/>
                </div>
                <div class="img-right">
                    <img src="https://www.classic-garden-elements.de/wp-content/themes/myclassic/assets/images/sws-img03.jpg"/>
                </div>
            </div>
        </div>
    </section>

    <!-- || Text Section End || --> 

    <!-- || Service Section || -->  
            
    <section class="serviceSection sections box-40">
        <h2>Service</h2>
        <?php dynamic_sidebar('service_bottom_section');  ?>
    </section>
            <!-- || Service Section End || -->  <!--#primary -->
</div>


<?php get_footer();