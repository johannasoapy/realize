
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

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
                    <section class="article-section">
                        <h2>Live Webinar Session</h2>
                        <p>
                        <?php $webinardate = get_field('webinar_date');
                              $today = date('Ymd');
                            if( !empty($webinardate) && $webinardate >= $today ): ?>
                                <span class="date"><?php echo $webinardate; ?></span>
                            
                                <?php $webinartime = get_field('webinar_hour');
                                  $currenttime = current_time; //flesh this out to compare time field to current time only if today's date is EQUAL to webinar date
                                if( !empty($webinartime) ): ?>
                                    <span class="time">, <?php echo $webinartime; ?> </span>
                                    <?php $ampm = get_field('hour_am_or_pm');
                                    if( !empty($ampm) ): ?>
                                        <?php echo $ampm; ?> CST (UTC-6)
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else : ?>
                            
                                There are no live webinars currently scheduled for this topic.
                            
                            <?php endif; ?><!-- endif has webinar date and is greater than or equal to today-->
                        </p>
                    </section>
                    <?php endif; ?><!-- endif has_category teaching-with-technology-blog-->
                            
                  <?php
                    // the content (pretty self explanatory huh)
                    the_content();

                  ?>
                </section> <?php // end article section ?>

                <footer class="article-footer">

                  <?php printf( __( 'filed under', 'bonestheme' ).': %1$s', get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <?php // end article footer ?>

                <?php if ( is_user_logged_in() ) { ?>
                                    <?php comments_template(); ?>
                                <?php } else { ?>
                                    <p>Please <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">login</a> to comment or view discussion.</p>
                                <?php } ?>

              </article>