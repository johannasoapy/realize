			<footer class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
				<div class="footer-top">
				    <div class="wrap">
					<p class="cic-brand"><a href="http://www.cic.gc.ca/english/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/cic-logo.png" alt="Citizenship and Immigration Canada Logo"></a></p>
				    </div>
				</div>
				<div id="inner-footer" class="inner-footer wrap clear">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
                    <ul class="nav-menu social-media">
							<li><a href="https://twitter.com/englishonlinemb" target="_blank" class="twitter" title="Follow us on Twitter">Twitter</a></li>
							<li><a href="https://www.facebook.com/myEnglishOnlineMB" target="_blank" class="facebook" title="Follow us on Facebook">Facebook</a></li>
							<li><a href="https://www.pinterest.com/EnglishOnlineMB/" target="_blank" class="pinterest" title="Follow us on Pinterest">Pinterest</a></li>
							<li><a href="https://delicious.com/englishonlinemb" target="_blank" class="delicious" title="Follow us on Delicious">Delicious</a></li>
							<!--<li><a class="rss" href="<?php //esc_url( bloginfo('rss2_url') ); ?>" target="_blank" title="Subscribe to our RSS feed">RSS</a></li>-->
						</ul>


				</div>
                <div class="footer-bottom wrap clear">
					<p class="eo-brand m-all t-1of2 d-1of2"><a href="http://myenglishonline.ca" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/eo-logo-lg.png" alt="English Online Logo"></a> Realize is an <a href="http://myenglishonline.ca" target="_blank">English Online Inc.</a> project.</p>
					<p class="source-org copyright m-all t-1of2 d-1of2 last-col">&copy; <?php echo date('Y'); ?> English Online Inc.  &#8226; <a href="<?php echo home_url(); ?>/privacy-policy" title="">Privacy Policy</a> &#8226; <a href="<?php echo home_url(); ?>/terms-of-use" title="">Terms of Use</a></p>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
