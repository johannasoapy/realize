<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-3of4 last-col cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                                <header class="article-header entry-header">

                                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                                  <p class="byline entry-meta vcard">

                                    <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                                       /* the time the post was published */
                                       '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                                       /* the author of the post */
                                       '<span class="by">'.__( 'by', 'bonestheme' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                                    ); ?>

                                  </p>

                                </header> <?php // end article header ?>

                                <section class="entry-content cf" itemprop="articleBody">

                                    <?php if( has_category('teaching-with-technology-blog')) : ?>
                                    
                                        
                                        <?php $webinardate = get_field('webinar_date');
                                                $livebbbsession = get_field('bbb_meeting');
                                                $webinarlink = get_field('webinar_link');
                                                $webinartime = get_field('webinar_hour');
                                            // from http://stackoverflow.com/questions/8006692/get-current-date-given-a-timezone-in-php
                                            $datehere = new DateTime("now", new DateTimeZone('America/Winnipeg'));
                                            $today = $datehere->format('Ymd');
                                    
                                            if( !empty($webinardate) && $webinardate >= $today ): ?>
                                                <section class="article-section">
                                                    <h2>Live Webinar<br>
                                                    <small>
                                                    <?php echo date('F j, Y', strtotime($webinardate)) ?>
                                                    <?php if( !empty($webinartime) ): ?>, <?php echo $webinartime; ?>
                                                        <?php $ampm = get_field('hour_am_or_pm');
                                                        if( !empty($ampm) ): ?>
                                                            <?php echo ' ' . $ampm . ' CDT'; ?>
                                                        <?php endif; ?>
                                                        <?php endif; ?></small>

                                                    </h2>

                                                        
                                                        <?php if( !empty($webinarlink) && $webinardate == $today ) : ?>
                                                    
                                                            <p>Click the button to join the Zoom webinar. If you have not already installed the Zoom app, you will be prompted to download and install it.</p>
                                                            <p>
                                                                <a href="<?php echo esc_url($webinarlink); ?>" class="blue-btn" target="_blank">Join the Webinar</a>
                                                            </p>

                                                            <p>
                                                                If you have trouble with the button, copy and paste this url into your browser: <?php echo esc_url($webinarlink); ?>.
                                                            </p>
                                                    
                                                        <?php elseif( !empty($webinarlink) && $webinardate > $today ) : ?>
                                                    
                                                            <p>On the day of the webinar, a Join button will appear here.</p>
                                                    
                                                            <p>
                                                                Webinar url: <?php echo esc_url($webinarlink); ?>.
                                                            </p>

                                                        <?php endif; ?><!-- end if there is a zoom link -->
                                                    
                                                        <?php 
                                                        // EO BigBlueButton Meeting room link and instructions
                                                        
                                                        if ( is_array( $livebbbsession ) && in_array('yes', $livebbbsession) && $webinardate == $today ): ?>
                                                            <div class="cf" itemprop="workshopSynchronous">

                                                                <p><?php echo do_shortcode('[bigbluebutton token="a9902699a8c4"]'); ?></p>
                                                                <!-- this bigbluebutton token is from the "Realize Event" meeting room, details found here: https://realizeforum.ca/wp-admin/options-general.php?page=bigbluebutton_general: a9902699a8c4  localhost development use: d1a302de0ffb-->

                                                                <p>If you have any problems or want to test your setup ahead of time, check out our <a href="/joining-events-bigbluebutton/" target="_blank">"Joining Events with BigBlueButton"</a> page.</p>
                                                            </div>
                                                        <?php elseif ( is_array( $livebbbsession ) && in_array('yes', $livebbbsession) && $webinardate > $today ): ?>
                                                            <div class="cf" itemprop="workshopSynchronous">

                                                                <p>On the day of the webinar you will see a "Join the Webinar" button here.</p>

                                                                <p>You can test your setup ahead of time - instructions are on our <a href="/joining-events-bigbluebutton/" target="_blank">"Joining Events with BigBlueButton"</a> page.</p>
                                                            </div>
                                                        <?php endif; ?><!--endif has $livebbbsession and is today or later -->
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    

                                                    <p>All dates and time are <a href="http://www.timeanddate.com/worldclock/canada/winnipeg" target="_blank">Winnipeg local time</a>.</p>
                                                </section>
                                                    
                                            <?php elseif( !empty($webinardate) && $webinardate < $today ) : ?><!-- if has webinar date is passed -->   
                                                    
                                                <section class="article-section">
                                                        <h2>Live Webinar</h2>
                                                        <p>This webinar was previously run on <?php echo date('F j, Y', strtotime($webinardate)) ?>
                                                        <?php if( !empty($webinartime) ): ?>, <?php echo $webinartime; ?>
                                                            <?php $ampm = get_field('hour_am_or_pm');
                                                            if( !empty($ampm) ): ?>
                                                                <?php echo ' ' . $ampm . ' CDT'; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        
                                                        </p>
                                                        <?php $webinarlink = get_field('webinar_link'); ?>
                                                        <?php if( !empty($webinarlink) ) : ?>
                                                            <p>
                                                                Webinar url: <?php echo esc_url($webinarlink); ?>.
                                                            </p>
                                                        <?php endif; ?>
                                                    

                                                </section>

                                            <?php endif; ?><!-- endif has webinar date and is less than to today-->
                                    
                                    <?php endif; ?><!-- endif has_category teaching-with-technology-blog-->
                                    
                                    <section class="article-section">
                                          <?php
                                            // the content (pretty self explanatory huh)
                                            the_content();

                                          ?>
                                    </section>
                                    
                                </section> <?php // end entry-content ?>

                                <footer class="article-footer">

                                  <?php printf( __( 'filed under', 'bonestheme' ).': %1$s', get_the_category_list(', ') ); ?>

                                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                                </footer> <?php // end article footer ?>

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
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</main>

					<aside id="sidebar" class="sidebar m-all t-1of3 d-1of4 cf" role="complementary">
                        
                        <?php if( has_category('teaching-with-technology-blog') || has_category('promising-practices') ) : ?>
                        
                            <!--if webinar is using bbb, show bbb sidebar-->
                            <?php 
                                if ( is_array( $livebbbsession ) && in_array('yes', $livebbbsession) ): ?>
                            
                                <?php if ( is_active_sidebar( 'sidebar6' ) ) : ?>
                                    <?php dynamic_sidebar( 'sidebar6' ); ?>
                                <?php endif; ?>
                                <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                                    <?php dynamic_sidebar( 'sidebar' ); ?>
                                <?php endif; ?>
                        
                            <!--else if webinar is using zoom, show zoom sidebar-->
                            
                            <?php elseif( !empty($webinarlink)) : ?>
                        
                                    <?php if ( is_active_sidebar( 'sidebar3' ) ) : ?>
                                    <?php dynamic_sidebar( 'sidebar3' ); ?>
                                    <?php endif; ?>
                                    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'sidebar' ); ?>
                                    <?php endif; ?>
                        
                            <?php else : ?>
                                <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                                    <?php dynamic_sidebar( 'sidebar' ); ?>
                                <?php endif; ?>
                        
                            <?php endif; ?>
                            <?php else : ?>
                                <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                                    <?php dynamic_sidebar( 'sidebar' ); ?>
                                <?php endif; ?>
                        
                        <?php endif; ?><!-- end if has category teaching with technology blog -->
                                            
						
					</aside>

				</div>

			</div>

<?php get_footer(); ?>
