<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.0
 */
?>
<?php get_header(); ?>
<!-- home -->
	<div id="content" class="blog_uebersicht">
		<div class="container containerPadding productPage ">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
        <?php query_posts('post_type=post&post_status=publish&posts_per_page=100&paged='. get_query_var('paged')); ?>

	<?php if( have_posts() ): ?>

        <?php while( have_posts() ): the_post(); ?>

	    <div id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<div class="entry-meta">
					<span class="headerimage" ><img style="width:48px;" src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/01/blog-grafik-ueber-datum-zentriert-min.png"></span>
					<span class="posted-on">
						<img style="width:16px;margin-right:10px;" src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/01/blog-grafik-datum-zeile-links-min-e1517320989552.png">
						<a href="<?php the_permalink(); ?>" rel="bookmark">Ver&ouml;ffentlicht am 
							<time class="entry-date published" datetime="2018-01-25T22:24:48+00:00"><?php the_time('d.m.Y'); ?></time>
							</a>
							<img style="width:16px;margin-left:12px;" src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/01/blog-grafik-datum-zeile-rechts-min-e1517320956267.png"> 
							 
					</span>
				</div>           
			</header>
			
			<h2 style="text-align:center;margin:0 0 15px 0;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
					<?php the_excerpt(); ?>

            </div><!-- /#post-<?php get_the_ID(); ?> -->

        <?php endwhile; ?>

	<?php else: ?>

		<div id="post-404" class="noposts">

		    <p><?php _e('None found.','example'); ?></p>

	    </div><!-- /#post-404 -->

	<?php endif; wp_reset_query(); ?>

	</div><!-- /#content -->

		</main><!-- #main -->
		<div id="secondary">	
		<?php if ( is_active_sidebar( 'blog-side-bar' ) ) : ?>
			<?php dynamic_sidebar( 'blog-side-bar' ); ?>
		<?php endif; ?>
		</div>
	</div><!-- #primary -->

</div>
<?php get_footer(); ?>
