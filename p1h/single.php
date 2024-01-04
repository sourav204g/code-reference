<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package handyman_pro
 */

get_header();
?>

	<style>

		.post-metas li i {
			color: #a7a7a7;
			float: left;
			float: left;
		    line-height: 17px;
		    font-size: 20px;
		    margin-right: 5px;
		}

		[for="comment"]:before {
			border: none;
			content: '';
			padding-left: 0;
		}

		footer.comment-meta { background: transparent; }

		h2.comments-title { font-size: 24px; }

	</style>

	<section class="overlape">
		<div class="block no-padding">
			<div class="parallax scrolly-invisible no-parallax" data-velocity="-.1" style="background: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>) repeat scroll 50% 422.28px transparent;"></div><!-- PARALLAX BACKGROUND IMAGE -->
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

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 column">
						<div class="blog-single">
							<div class="bs-thumb"><img alt="" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>"></div>

							<?php

								while ( have_posts() ) : the_post(); ?>

									<ul class="post-metas">
										<li>
											<a href="#" title=""><img alt="" src="images/resource/admin.jpg"></a>
										</li>
										<li>
											<a href="#" title=""><i class="la la-calendar-o"></i><?php echo get_the_date(); ?></a>
										</li>
										<li>
											<a class="metascomment" href="#" title=""><i class="la la-comments"></i><?php echo get_comments_number(); ?> comments</a>
										</li>
										<li>

											<?php 

											$selected_categories = get_the_terms( $post->ID, 'category' );

  										    ?><?php 

  										    	if ($selected_categories) :

	  										    	foreach ( $selected_categories as $key => $category ) : ?>

														<i class="la la-file-text"></i>
	  										    		<a href="<?php echo get_term_link($category->term_id); ?>" title=""><?php echo $category->name . ','; ?></a>

	  										    	<?php endforeach;

  										    	endif;

  										    ?>


											
										</li>
									</ul>

							<?php	endwhile; // End of the loop. ?>
							
							<h2><?php the_title(); ?></h2>

							<div class="entry-content">
							
							<?php
								while ( have_posts() ) : the_post();

									the_content();

								endwhile; // End of the loop.
							?>

							</div>


							<div class="tags-share">

								<?php if (get_the_tags($post->ID)): ?>
									
								

								<div class="tags_widget">
									<span>Tags</span> 

									<?php
										while ( have_posts() ) : the_post(); ?>

											<?php foreach ( get_the_tags($post->ID) as $key => $tag ): ?>
												<a href="<?php echo get_term_link($tag->term_id); ?>" title=""><?php echo $tag->name ?></a> 
											<?php endforeach; ?>

									<?php		endwhile; // ?>	

								</div>

								<?php endif; ?>

								<div class="share-bar">
									<a class="share-fb" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title=""><i class="fa fa-facebook"></i></a>
									<a class="share-twitter" href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" title=""><i class="fa fa-twitter"></i></a>
									<a class="share-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title=""><i class="la la-google"></i></a><span>Share</span>
								</div>
							</div>		

							
							<?php
							
								/*  IF NEEDED UNCOMMENT IT
								==================================

								while ( have_posts() ) : the_post();

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop. */

							?>

							
						</div>
					</div>

					<aside class="col-lg-3 column">

						<div class="widget">
							<h3>Categories</h3>
							<div class="sidebar-links">
								<a href="#" title=""><i class="la la-angle-right"></i>Education</a> <a href="#" title=""><i class="la la-angle-right"></i>Information</a> <a href="#" title=""><i class="la la-angle-right"></i>Jobs</a> <a href="#" title=""><i class="la la-angle-right"></i>Learn</a> <a href="#" title=""><i class="la la-angle-right"></i>Skill</a>
							</div>
						</div>

						<div class="widget">
							<h3>Recent Posts</h3>
							<div class="post_widget">

								<?php 

									$recent_posts = wp_get_recent_posts(); 

									// var_dump($recent_posts);

									foreach ( $recent_posts as $key => $recent_post ) : ?>

										<div class="mini-blog">
											<span>
												<a href="<?php echo get_permalink($recent_post['ID']); ?>" title="">
													<img alt="" src="<?php echo get_the_post_thumbnail_url($recent_post['ID']); ?>">
												</a>
											</span>
											<div class="mb-info">
												<h3><a href="<?php echo get_permalink($recent_post['ID']); ?>" title="<?php echo $recent_post['post_title']; ?>"><?php echo $recent_post['post_title']; ?></a></h3>
												<span><?php echo date('F d, Y', strtotime($recent_post['post_date'])); ?></span>
											</div>
										</div>

								<?php endforeach; ?>

							</div>
						</div>

						<div class="widget">
							<h3>Tags</h3>
							<div class="tags_widget">

								<?php 

									$alltags = get_tags(
										array( 'hide_empty' => false ) );

									foreach ($alltags as $key => $atag ) : ?>
										<a href="<?php echo get_term_link($atag->term_id); ?>" title=""><?php echo $atag->name; ?></a>
								<?php endforeach; ?>

							</div>
						</div>

					</aside>
				</div>
			</div>
		</div>
	</section>

<?php
// get_sidebar();
get_footer();
