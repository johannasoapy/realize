<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="gt-ie8 no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!--title is added by WP title_tag, called in functions.php-->

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-61352141-3', 'auto');
          ga('send', 'pageview');

        </script>
		<?php // end analytics ?>
        <meta name="msvalidate.01" content="546BB48CEBAB6F6812A9F1D23EAEB6DB" />
        <meta name="google-site-verification" content="bkT1zhf4mkhhcKpbYqjrZw7hAY8am0sg30uH2IHiLl0" />
	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
                <a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to page content', 'bonestheme' ); ?></a> <!--Accessibility feature-->
				<div id="inner-header" class="wrap cf">

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
                    <div class="site-identity m-all t-1of2 d-1of3">
						<h1 id="logo" class="h1" itemscope itemtype="http://schema.org/Organization">
							
							<a href="<?php echo home_url(); ?>" rel="nofollow" title="Realize homepage">
                                <img class="svgimg" src="<?php echo get_template_directory_uri(); ?>/library/images/eo-realize-logo.svg" alt="Realize: a project of English Online">
                                <img style="display:none;" class="no-svgimg" src="<?php echo get_template_directory_uri(); ?>/library/images/eo-realize-logo.png" alt="Realize: a project of English Online">
							</a>
						</h1><!-- end .site-identity-->
	
						<?php // if you'd like to use the site description you can un-comment it below ?>
						<p id="site-tagline" class="site-tagline"><?php bloginfo('description'); ?></p>
					</div>
                    
                    <!-- <button class="header-link search-toggle" title="Menu">Search</button>-->
                    <div class="project-links">
                        
                        <?php if ( is_user_logged_in() ): ?>
                        <div class="user-links loggedin cf">
                            
                            <?php $current_user = wp_get_current_user(); ?>

                            <span id="profile-toggle">
                                    <span tabindex="0" class="poptrigger" aria-haspopup="true" aria-expanded="false">Hi, <?php echo $current_user->user_firstname; ?></span>
                                    <ul class="sub-menu popup">
                                        <!--<li><a href="<?php //echo home_url(); ?>/profile" title="My Learning Profile">My Activities</a></li>-->
                                        <li><a href="<?php echo home_url(); ?>/volunteer-hub" title="Volunteer Hub">Volunteer Hub</a></li>
                                        <li><a href="<?php echo home_url(); ?>/volunteer-journal" title="Volunteer Journal">Volunteer Journal</a></li>
                                        
                                    </ul>
                            </span>
                            <a id="logout" class="logout" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Learner Logout">Logout</a>    
                            <button class="search-toggle" title="Search">Search</button> <!-- triggers header opening for menu, mobile only -->
                            <button class="menu-toggle" title="Menu">Menu</button> <!-- triggers shorter header for search bar only -->
                            
                            <?php else: ?> <!--if user is not logged in-->
                        <div class="user-links notloggedin cf">
                            <a id="login" class="login" href="<?php echo wp_login_url( get_permalink() ); ?>" title="Learner Login">Login</a>

                            
                            
                            <span class="search-toggle" title="Search">Search</span> <!-- triggers header opening for menu, mobile only -->
                            <span class="menu-toggle" title="Menu">Menu</span> <!-- triggers shorter header for search bar only -->
                            
                            <?php endif; ?><!--end if user is logged in or not-->
                        </div> <!--end .user-links either way, whether logged in or not-->
                        
							
                    </div>
                    
                            
					<div id="search-container" class="search-box">
						<?php get_search_form();?>
						
					</div>
                </div><!-- end #inner-header .wrap -->
                <div class="header-nav-wrap">
                    <div class="wrap cf">
                        <!--accessible menu with aria from https://codeable.io/wordpress-accessibility-creating-accessible-dropdown-menus/-->
                    <nav class="collapse  navbar-collapse main-menu" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php _e( 'Main Menu', 'textdomain' ); ?>">
                      <?php
                        if ( has_nav_menu( 'main-nav' ) ) {
                          wp_nav_menu( array(
                            'theme_location' => 'main-nav',
                            'container'      => false,
                            'menu_class'     => 'nav-menu cf',
                            'walker'         => new Aria_Walker_Nav_Menu(),
                            'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                          ) );
                        }
                      ?>
                    </nav>
                    </div><!-- end .wrap -->
                </div><!-- end .header-nav-wrap -->

			</header>
