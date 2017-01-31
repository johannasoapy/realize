<?php get_header(); ?>

			<div id="content">
                
				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
                            
							<div class="hero">
                                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<div class="hero-text cf" itemprop="articleBody">
									<?php
										// the hero CTA
                                        $herocta = get_field('hero_cta');
                                        if( $herocta != '') :
                                            echo $herocta;
                                        endif;

									?>
                                </div>
                                
                            </div> <!-- end .hero -->

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1>Realize: <?php bloginfo('description'); ?></h1>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
                                    <section class="article-section">
                                        <blockquote>The Realize Forum is a comprehensive professional development program for ESL/EAL and settlement practitioners. It aims to build expertise in the sector thereby continually elevating the quality of services for the immigrant population.</blockquote>
                                    </section>
                                    <section class="article-section">
                                        <div class="m-all t-2of3 d-2of3 cf">
                                        <?php
                                            // the content (pretty self explanatory huh)
                                            the_content();

                                        ?>
                                            </div>

                                        <div class="m-all t-1of3 d-1of3 last-col cf">
                                                <a href="/volunteer" title="Volunteer with English Online"><img class="shadow" src="<?php bloginfo("template_url"); ?>/library/images/join-us.jpg" alt="Join us - Register"></a>
                                        </div>
                                    </section>
                                    <section class="article-section">
                                        <h2>The Latest&hellip;</h2>
                                        <h3>Teaching With Technology Webinars</h3>
                                        <div class="m-all standout-block cf">
                                            
                                            <?php

                                            $args8 = array(
                                                'posts_per_page' => 4,
                                                'orderby' => 'date',
                                                'order' => 'DESC',
                                                'cat' => '37'
                                            );
                                            $do_not_duplicate = array();
                                            $loop8 = new WP_Query($args8);

                                            while($loop8->have_posts()): $loop8->the_post(); ?>

                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                                    <?php echo the_excerpt(); ?>
                                            <?php
                                        endwhile;
                                        wp_reset_query();
                                        ?>

                                        </div>
                                        <h3>Teacher News</h3>
                                        <div class="m-all standout-block last-col cf">
                                            
                                            <?php

                                            $args9 = array(
                                                'posts_per_page' => 4,
                                                'orderby' => 'date',
                                                'order' => 'DESC',
                                                'cat' => '5',
                                                'category__not_in' => '37'
                                            );
                                            $loop9 = new WP_Query($args9);

                                            while($loop9->have_posts()): $loop9->the_post(); ?>

                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                                    <?php echo the_excerpt(); ?>

                                            <?php
                                        endwhile;
                                        wp_reset_query();
                                        ?>
                                        </div>
                                    </section>
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

				</div>

			</div>

<?php get_footer(); ?>
