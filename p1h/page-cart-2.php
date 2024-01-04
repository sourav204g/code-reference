<?php
/**
 * Template Name: Cart 2
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package handyman_pro
 */

session_start();
$_SESSION['cart2'] = 'success';

wp_redirect( home_url( '/cart/' ) ); exit();

?>