<?php
/**
 * Template for displaying search forms in My Classic
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */

?>

<?php //$unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="textbox" class="txtBox form-controls" id="<?php //echo $unique_id; ?>" class="search-field" placeholder="<?php //echo esc_attr_x( 'Search &hellip;', 'placeholder', 'myclassic' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
</form>
