<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-3of4 last-col cf archive-js" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
                            <header class="archive-header">
                                <?php
                                the_archive_title( '<h1 class="page-title">', '</h1>' );
                                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                ?>
                            </header>
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="entry-header article-header">

									<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline entry-meta vcard">
										<?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                  							     /* the time the post was published */
                  							     '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">'.__('by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							); ?>
									</p>

								</header>

								<section class="entry-content cf">

									<?php the_post_thumbnail( 'bones-thumb-300' ); ?>

										<?php if( custom_field_excerpt() ) :
											echo custom_field_excerpt();
										elseif( custom_field_excerpt2() ) :
											echo custom_field_excerpt2();
                                        elseif( custom_field_excerpt3() ) :
											echo custom_field_excerpt3();
                                        else :
                                        the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' );
										endif; ?>

								</section>

								<footer class="article-footer">
                                    <?php printf( '<p class="footer-category">' . __('filed under', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>

                                    <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
								</footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'There are not currently any posts in this categoy.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'Try another category.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>
					<aside id="sidebar1" class="sidebar m-all t-1of3 d-1of4 cf" role="complementary">
						<?php if ( is_active_sidebar( 'sidebar4' ) ) : ?>
							<?php dynamic_sidebar( 'sidebar4' ); ?>
						<?php endif; ?>
					</aside>

				</div>

			</div>

<?php get_footer(); ?>
