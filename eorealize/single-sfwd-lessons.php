<?php
/*
LEARNDASH LESSONS TEMPLATE
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
									
                                    <!-- Check if post is volunteer training -->
                                    <?php if( has_category( 'volunteer-training' ) ): ?>
                                        
                                        <?php
											$intro = get_field('lesson_intro');
											if( !empty($intro) ): ?>
											<section class="article-section cf" itemprop="lessonIntro">
												
												<?php echo $intro; ?>
											</section>
											<?php endif; ?>
                                    
                                        <?php if( get_field('lesson_handouts') ): ?>
                                            <section class="article-section handouts clear cf" itemprop="workshopHandouts">
                                                <h2>Files for Download</h2>
                                                <?php while( has_sub_field('lesson_handouts') ): ?>
                                                    <div class="blue-btn"><a href="<?php esc_url(the_sub_field('handout')); ?>" target="_blank" ><?php esc_html(the_sub_field('handout_title')); ?></a></div>

                                                <?php endwhile; ?>
                                            </section>
                                        <?php endif; ?>
                                        <?php

                                        // check if the Steps repeater field has rows of data
                                        if( have_rows('steps') ):
                                            
                                            // set a value to start counting rows/steps to display in title
                                            $i = 1;
                                    
                                            // loop through the rows of data
                                            while ( have_rows('steps') ) : the_row(); ?>
                                                <section class="article-section cf" itemprop="workshopResources">
                                                    
                                                    <?php $steptitle = (get_sub_field('step_title'));
                                                    
                                                    // if there is a title entered it will be displayed after "Step $i: ", if not the title wil just read "Step $i"
                                                    if( !empty($steptitle) ): ?>
                                                        <h2>Step <?php echo $i . ': ' . $steptitle; ?></h2>
                                                    <?php else: ?>
                                                        <h2>Step <?php echo $i; ?></h2>
                                                    <?php endif;
                                                    
                                                    $step = (the_sub_field('step'));
                                                    if( !empty($step) ):
                                                        // display a sub field value
                                                        echo $step;
                                                    endif;
                                                    
                                                    // add to i to count rows/steps for title
                                                    $i++; ?>
                                                    
                                                </section>
                                            <?php endwhile;

                                        endif; // end if have_rows

                                        ?>
										
											
										<?php
											$quiz = get_field('lesson_inline_quiz');
											if( !empty($quiz) ): ?>
											<section class="article-section cf" itemprop="workshopResources">
												
												<?php echo $quiz; ?>
											</section>
											<?php endif; ?>
                                    
                                        
                                        <?php if( get_field('lesson_conclusion') ): ?>
                                        <section class="article-section cf" itemprop="lessonConclusion">
                                                <h2>Conclusion</h2>
                                                <?php esc_html(the_field('lesson_conclusion')); ?>
                                                
                                        </section>
                                        <?php endif; ?>
                                    
                                    <?php endif; ?> <!--endif has term volunteer-training-->
                                    <section class="article-section cf">
                                        <?php
                                            // the content in a LearnDash template will include any sub-content (lessons or topics) and the Mark Complete button
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
