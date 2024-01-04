<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage My_Classic
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		echo myclassic_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>
	<header class="entry-header">
		<div class="entry-meta">
			<span class="headerimage" ><img style="width:48px;" src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/01/blog-grafik-ueber-datum-zentriert-min.png"></span>
			<span class="posted-on"><img style="width:16px;margin-right:10px;" src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/01/blog-grafik-datum-zeile-links-min-e1517320989552.png"><a href="<?php the_permalink(); ?>" rel="bookmark">Ver&ouml;ffentlicht am <time class="entry-date published" datetime="2018-01-25T22:24:48+00:00"><?php the_time('d.m.Y'); ?></time>
				</a> <img style="width:16px;margin-left:12px;" src="<?php echo get_site_url(); ?>/wp-content/uploads/2018/01/blog-grafik-datum-zeile-rechts-min-e1517320956267.png">
			</span>
		</div>           
	</header>

	<h2 style="text-align:center;margin:0 0 15px 0;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(  ); ?></a>


	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'myclassic' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'myclassic' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		myclassic_entry_footer();
	}
	?>

</article><!-- #post-## -->
