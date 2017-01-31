<?php
/*
LEARNDASH COURSES TEMPLATE
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-3of4 last-col cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="article-header">

									<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
									<p class="byline vcard">
										<?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
											/* the time the post was published */
											'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
											/* the author of the post */
											'<span class="by">'.__( 'by', 'bonestheme' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
										 ); ?>
									</p>

								</header>

								<section class="entry-content cf">
                                    <?php if( has_category( 'volunteer-training' ) ): ?>	
																			
                                        <?php
											$intro = get_field('course_intro');
											if( !empty($intro) ): ?>
											<section class="article-section cf" itemprop="courseIntro">
												
												<?php echo $intro; ?>
											</section>
											<?php endif; ?>
                                    
                                        
                                        <?php
                                            $objectives = get_field('learning_objectives');
                                            if( !empty($objectives) ): ?>
                                            <section class="article-section cf" itemprop="courseObjectives">
                                                <h2>Learning Objectives</h2>
                                                <?php echo $objectives; ?>
											</section>
											<?php endif; ?>
                                    
                                        <?php
                                            $outcomes = get_field('learning_outcomes');
                                            if( !empty($outcomes) ): ?>
                                            <section class="article-section cf" itemprop="courseOutcomes">
                                                <h2>Learning Outcomes</h2>
                                                <?php echo $outcomes; ?>
											</section>
											<?php endif; ?>
                                    
                                    <?php endif; ?> <!--endif has term volunteer-training-->
                                        <section class="article-section cf" itemprop="courseLessons">
                                            <?php
                                                // the content, includes the LearnDash fields and buttons
                                                the_content();

                                            ?>
                                        </section>
								</section> <!-- end entry-content section -->

								<footer class="article-footer">
									<?php printf( __( 'filed under', 'bonestheme' ).': %1$s', get_the_category_list(', ') ); ?>

									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
								</footer>

								<?php if ( is_user_logged_in() ) { ?>
                                    <?php comments_template(); ?>
                                <?php } else { ?>
                                    <p>Please <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">login</a> to comment or view discussion.</p>
                                <?php } ?>

							</article>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
										</footer>
                                        <?php if ( is_user_logged_in() ) { ?>
                                    <?php comments_template(); ?>
                                <?php } else { ?>
                                    <p>Please <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">login</a> to comment or view discussion.</p>
                                <?php } ?>
									</article>

							<?php endif; ?>

						</main>

						<aside id="sidebar2" class="sidebar m-all t-1of3 d-1of4 cf" role="complementary">
							<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>
							<?php dynamic_sidebar( 'sidebar2' ); ?>
						<?php endif; ?>
						</aside>

				</div>

			</div>

<?php get_footer(); ?>
