<?php
/*
 Template Name: Webinar Event Category
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-3of4 last-col cf webinars-js" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title entry-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
                                    
                                    
                                        <?php
                                            $description = get_field('webinar_category_description');
                                                if( $description ): ?>
                                                    <section class="article-section">
                                                        <?php the_field('webinar_category_description'); ?>
                                                    </section>
                                            <?php endif; ?>
                                        <?php
                                            // the content (pretty self explanatory huh)
                                            if($post->post_content !=''): ?>
                                                <section class="article-section">
                                                    <?php the_content(); ?>
                                                </section>
                                            <?php endif; ?>
                                
                                <?php $term = get_field('webinar_category'); ?>
                                <?php $datehere = new DateTime("now", new DateTimeZone('America/Winnipeg'));
                                    $today = $datehere->format('Ymd'); ?>

                                <?php if( $term ): ?>
                            			
                                    <section class="article-section">
     
                                            <?php

                                            $args3 = array(
                                                'post_type' => 'post',
                                                'category_name' => $term,
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'webinar_date',
                                                        'compare' => '>=',
                                                        'value' => $today,
                                                    )
                                                ),
                                                'posts_per_page' => 6,
                                                'orderby' => 'webinar_date',
                                                'order' => 'ASC',
                                            );
                                        
                                            $loop3 = new WP_Query($args3);
                                            if ( $loop3->have_posts() ) : ?>
                                                <h2 class="page-sub">Upcoming <?php the_title(); ?></h2>
                                                <?php while($loop3->have_posts()): $loop3->the_post(); ?>
                                                    <?php $webinardate = get_field('webinar_date'); ?>
                                                    <?php $webinarhour = get_field('webinar_hour'); ?>
                                                    <?php $ampm = get_field('hour_am_or_pm'); ?>

                                                <div class="webinar-events">
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?><br><small><?php echo date('F j, Y', strtotime($webinardate)) ?>, <?php echo $webinarhour; ?> <?php echo $ampm; ?></small></a></h4>
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                <?php endwhile; ?>

                                            <?php else: ?>
                                                <h2 class="page-sub">Upcoming <?php the_title(); ?></h2>
                                                    <p>There are no live webinars currently scheduled.</p>
                                            <?php endif;
                                            wp_reset_query();
                                            ?>

                                    </section><!--end .article-section -->
                                
								<?php endif; ?>

                                <?php // EO link to past webinars
                                    $posts = get_field('past_webinars');
                                    if( $posts ): ?>
                                        <section class="article-section past">
											<div class="cf">
												<h2 class="page-sub clear">View recordings of our Past Webinars</h2>
												<ul>
													<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
															<li><a href="<?php echo get_permalink( $p ); ?>"><?php echo get_the_title( $p ); ?></a></li>
													<?php endforeach; ?>
												</ul>
											</div>
										</section>	
                                    <?php endif; ?>
									
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
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
								

						</main>

						<aside id="sidebar3" class="sidebar m-all t-1of3 d-1of4 cf" role="complementary">
							<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                                <?php dynamic_sidebar( 'sidebar' ); ?>
                            <?php endif; ?>
						</aside>

				</div>

			</div>


<?php get_footer(); ?>
