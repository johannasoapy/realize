<?php
/*
 Template Name: Grammar
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-3of4 last-col cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

									<p class="byline vcard">
										<?php printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
									</p>


								</header>

								<section class="entry-content cf" itemprop="articleBody">
                                    
                                    <?php the_content(); ?>
									
								</section>


								<footer class="article-footer">

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

							

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-grammarresources.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
							<h2 class="page-sub">Upcoming Webinars</h2>
										
										<section class="upcoming">
											<ul>

												<?php
												
												$args3 = array(
													'post_type' => 'tribe_events',
													'tribe_events_cat' => 'twt-webinars',
                                                    'posts_per_page' => 6,
													'orderby' => 'event_date',
													'order' => 'ASC'
												);
												$loop3 = new WP_Query($args3);
												
												while($loop3->have_posts()): $loop3->the_post(); ?>

                                                <div class="post-grid coffee-chat">
													<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?><br><small><?php echo tribe_get_start_date(); ?></small></a></h4>
													<?php if (has_post_thumbnail()): ?>
													<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'bones-thumb-600' ); ?></a>
												<?php else: ?>
													<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo("template_url"); ?>/library/images/learn-thumbnail.jpg" alt="Article thumbnail fallback"></a>
												<?php endif; ?>
													
													<?php the_excerpt(); ?>
												</div>
													<?php
												endwhile;
												wp_reset_query();
												?>
											</ul>
										</section><!--end .upcoming -->

						</main>

						<aside id="sidebar1" class="sidebar m-all t-1of3 d-1of4 cf" role="complementary">
							<?php get_sidebar(); ?>
						</aside>

				</div>

			</div>

<?php get_footer(); ?>
