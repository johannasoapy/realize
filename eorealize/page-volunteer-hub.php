<?php
/*
 Template Name: Volunteer Hub
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

								</header>

								<section class="entry-content cf" itemprop="articleBody">
                                    
                                    <?php if(!is_user_logged_in()) { ?> <!-- if user is NOT logged in -->
                                    <section class="article-section">
                                        <p>The Volunteer Hub is the one stop shop for the information and resources that English Online e-Volunteers need. If you have any questions about this page please feel free to contact Tatiana Nedelko, e-Volunteer coordinator:  tnedelko@myenglishonline.ca.</p>
                                    </section>
                                    <section class="article-section">
                                        
                                        <p>Please login to add a journal entry or to access your learning profile.</p>
                                    
                                        <h3>Login</h3>
                                        
                                        <?php $args = array(
                                        // arguments for login form
                                            'echo'           => true,
                                            'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                                            'form_id'        => 'loginform',
                                            'label_username' => __( 'Username' ),
                                            'label_password' => __( 'Password' ),
                                            //'label_remember' => __( 'Remember Me' ),
                                            'label_log_in'   => __( 'Log In' ),
                                            'id_username'    => 'user_login',
                                            'id_password'    => 'user_pass',
                                            //'id_remember'    => 'rememberme',
                                            'id_submit'      => 'wp-submit',
                                            'remember'       => false,
                                            'value_username' => '',
                                            'value_remember' => true
                                        ); ?>
                                    
                                        <?php wp_login_form( $args ); ?>
                                        
                                        <p style="margin-top: 1.5em;" class="lostpass"><a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Password</a></p>
                                        
                                        
                                    </section>
                                    <section class="article-section">
                                            <?php
                                                // the content (pretty self explanatory huh)
                                                the_content();

                                            ?>
                                    </section>
                            
                                <?php } else { ?> <!-- else if user is logged in -->
                                    
                                    <section class="m-all article-section userwelcome cf">
                                        
                                        <?php $current_user = wp_get_current_user(); ?>

                                            <p class="user-identify">Hello,&nbsp;<strong><?php echo $current_user->user_firstname . '!'?></strong></p>
                                            <p class="user-logout">Not <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?>?&nbsp;<?php wp_loginout($_SERVER['REQUEST_URI'], true); ?></p>
                                    </section><!-- end .userwelcome -->
                                    <section class="article-section">
                                        <p>The Volunteer Hub is the one stop shop for the information and resources that English Online e-Volunteers need. If you have any questions about this page please feel free to contact Tatiana Nedelko, e-Volunteer coordinator:  tnedelko@myenglishonline.ca.</p>
                                    </section>
                                    <section class="article-section">
                                            <?php
                                                // the content (pretty self explanatory huh)
                                                the_content();

                                            ?>
                                    </section>
                                
                                <?php } ?> <!-- end if user is logged in -->
                                    <section class="article-section">		
                                        <h2>Resources</h2>

                                        <?php if(get_field('quick_links')): ?>
                                                <div>
                                                    <h3>Quick Links</h3>
                                                    <?php the_field('quick_links'); ?>
                                                </div>
                                                <hr>
                                        <?php endif; ?>
                                                <?php $today = date('Ymd'); ?>
                                                <?php

                                                    $args3 = array(
                                                        'post_type' => 'post',
                                                        'category_name' => 'teaching-with-technology-blog',
                                                        'meta_query' => array(
                                                            array(
                                                                'key' => 'webinar_date',
                                                                'compare' => '>=',
                                                                'value' => $today,
                                                            )
                                                        ),
                                                        'posts_per_page' => 3,
                                                        'orderby' => 'webinar_date',
                                                        'order' => 'ASC',
                                                    );

                                                    $loop3 = new WP_Query($args3);
                                                    if ( $loop3->have_posts() ) : ?>
                                                        <h3>Upcoming Teaching With Technology Webinars</h3>
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
                                                        <h3>Upcoming Teaching With Technology Webinars</h3>
                                                            <p>There are no live webinars currently scheduled.</p>
                                                    <?php endif;
                                                    wp_reset_query();
                                                    ?>

                                    </section><!--end .article-section -->
                                        
                            </section> <?php // end entry-content ?>
                                

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

						<aside id="sidebar1" class="sidebar m-all t-1of3 d-1of4 cf" role="complementary">
							<?php get_sidebar(); ?>
						</aside>

				</div>

			</div>


<?php get_footer(); ?>
