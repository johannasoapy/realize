<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

// ADD WALKER MENU
require_once "library/aria-walker-nav-menu.php";

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // wp_title replaced by title_tag below
  //add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );
        /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
    
} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
   $wp_customize->remove_section('colors');
   $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
        'description' => __( 'The Trim theme remenant sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .widget -->',
		'before_title' => '<h4 class="widget_title">',
		'after_title' => '</h4>',
	) );
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The general sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Courses Sidebar', 'bonestheme' ),
		'description' => __( 'The LearnDash archive sidebar', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'sidebar3',
		'name' => __( 'Zoom Webinar Sidebar', 'bonestheme' ),
		'description' => __( 'Zoom instructions', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
    register_sidebar(array(
		'id' => 'sidebar6',
		'name' => __( 'BBB Webinar Sidebar', 'bonestheme' ),
		'description' => __( 'BigBlueButton instructions', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'sidebar4',
		'name' => __( 'Blog Sidebar', 'bonestheme' ),
		'description' => __( 'The sidebar for the blog', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'sidebar5',
		'name' => __( 'Lessons/Topics Sidebar', 'bonestheme' ),
		'description' => __( 'The LearnDash activities sidebar', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
    
 // Sidebars & Widgetizes Areas from meo-theme
    register_sidebar(array(
    	'id' => 'home-lower-left',
    	'name' => 'Home Lower Left Sidebar',
    	'description' => 'Used on the home page beside the news blog listing',
    	'before_widget' => '<div id="home-left-widget" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 style="display: none;">',
    	'after_title' => '</h3>',
    ));
    register_sidebar(array(
    	'id' => 'conference-sidebar',
    	'name' => 'Conference Sidebar',
    	'description' => 'For use on conference pages only',
    	'before_widget' => '<div class="widget %2$s conference-sidebar">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3>',
    	'after_title' => '</h3>',
    ));
    register_sidebar(array(
    	'id' => 'conference-blog-sidebar',
    	'name' => 'Conference Blog Sidebar',
    	'description' => 'For use on conference blog only',
    	'before_widget' => '<div class="widget %2$s conference-sidebar">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3>',
    	'after_title' => '</h3>',
    ));
}    

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
//function bones_fonts() {
 // wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
//}

//add_action('wp_enqueue_scripts', 'bones_fonts');

//remove empty lines when post is saved as per http://wordpress.stackexchange.com/questions/137738/remove-empty-lines-nbsp-when-author-updates-their-post
function remove_empty_lines( $content ){

  // replace empty lines
  $content = preg_replace("/&nbsp;/", "", $content);

  return $content;
}
add_action('content_save_pre', 'remove_empty_lines');

// remove Category: and Tag: from archive pages as per http://wordpress.stackexchange.com/questions/175884/how-to-customize-the-archive-title/175903#175903
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

/**
 * Adds an Organization column to the user display dashboard.
 */
function theme_add_user_organization_column( $columns ) {

 $columns['organization'] = __( 'Organization', 'theme' );
 return $columns;

} // end theme_add_user_organization_column
add_filter( 'manage_users_columns', 'theme_add_user_organization_column' );

function theme_add_user_jobtitle_column( $columns ) {

$columns['jobtitle'] = __( 'Job Title', 'theme' );
 return $columns;

} // end theme_add_user_organization_column
add_filter( 'manage_users_columns', 'theme_add_user_jobtitle_column' );

/**
 * Populates the Organization column with the specified user's organization
 */
function theme_show_user_organization_data( $value, $column_name, $user_id ) {

 if( 'organization' == $column_name ) {
	 return get_user_meta( $user_id, 'organization', true );
 } // end if
    
if( 'jobtitle' == $column_name ) {
	 return get_user_meta( $user_id, 'jobtitle', true );
 } // end if

} // end theme_show_user_organization_data
add_action( 'manage_users_custom_column', 'theme_show_user_organization_data', 10, 3 );



// add Organization and Title section to profile only for admin to see and edit
function custom_user_profile_fields($user){
    if ( current_user_can('manage_options') ) { // if current user can activate plugins they are admin
    ?>
        <h3>Organization and Title</h3>
        <table class="form-table">
            <tr>
                    <th><label for="organization">Organization</label></th>
                    <td><input type="text" name="organization" value="<?php echo esc_attr(get_the_author_meta( 'organization', $user->ID )); ?>"></td></tr>
            <tr>
                <th><label for="jobtitle">Title</label></th>
                    <td>
                        <?php if($usertitle == 'Administrator') echo 'selected'; ?>
                        <select name="jobtitle">
                            <?php $usertitle = esc_attr(get_the_author_meta( 'jobtitle', $user->ID )); ?>
                            <option value="Administrator" <?php if($usertitle == 'Administrator') echo 'selected'; ?>>Administrator</option>
                            <option value="Coordinator" <?php if($usertitle == 'Coordinator') echo 'selected'; ?>>Coordinator</option>
                            <option value="ESL Practitioner" <?php if($usertitle == 'ESL Practitioner') echo 'selected'; ?>>ESL Practitioner</option>
                            <option value="ESL Volunteer" <?php if($usertitle == 'ESL Volunteer') echo 'selected'; ?>>ESL Volunteer</option>
                            <option value="Employment Councillor" <?php if($usertitle == 'Employment Councillor') echo 'selected'; ?>>Employment Councillor</option>
                            <option value="Assessor" <?php if($usertitle == 'Assessor') echo 'selected'; ?>>Assessor</option>
                            <option value="Settlement Worker" <?php if($usertitle == 'Settlement Worker') echo 'selected'; ?>>Settlement Worker</option>
                            <option value="Other" <?php if($usertitle == 'Other') echo 'selected'; ?>>Other</option>
</select>
</td>
                </tr>
        </table>
    <?php
    }
}
add_action( 'show_user_profile', 'custom_user_profile_fields' );
add_action( 'edit_user_profile', 'custom_user_profile_fields' );
add_action( "user_new_form", "custom_user_profile_fields" );

function save_custom_user_profile_fields($user_id){
    // again do this only if you can
    if(!current_user_can('manage_options'))
        return false;

    // save organization
    update_user_meta($user_id, 'organization', esc_html($_POST['organization']));
    // save jobtitle
    update_user_meta($user_id, 'jobtitle', esc_html($_POST['jobtitle']));
}
add_action('user_register', 'save_custom_user_profile_fields');
add_action('profile_update', 'save_custom_user_profile_fields');


//
//create loggedin shortcode
//
function check_user ($params, $content = null){
  if ( is_user_logged_in() ){
    return $content;
  }
  else{
    return;
  }
}
add_shortcode('loggedin', 'check_user' );

//create notloggedin shortcode
function check_user_not ($params, $content = null){
  if ( !is_user_logged_in() ){
    return $content;
  }
  else{
    return;
  }
}
add_shortcode('notloggedin', 'check_user_not' );

// Accordion shortcodes
function accordionShortcode() {
	return '<div class="accordion">';
}
add_shortcode('accordion', 'accordionShortcode');


// shorten excerpt length
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// add excerpt feature for custom fields from https://wordpress.org/support/topic/how-to-pull-excerpt-from-advanced-custom-field
function custom_field_excerpt() {
	global $post;
	$text = get_field('course_intro');
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 30; // 30 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}
// add excerpt feature for custom fields from https://wordpress.org/support/topic/how-to-pull-excerpt-from-advanced-custom-field
function custom_field_excerpt2() {
	global $post;
	$text = get_field('learning_objectives');
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 30; // 30 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}
// add excerpt feature for custom fields from https://wordpress.org/support/topic/how-to-pull-excerpt-from-advanced-custom-field
function custom_field_excerpt3() {
	global $post;
	$text = get_field('lesson_intro');
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 30; // 30 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}

// GRAVITY FORMS pre-populate names
// define the fields we'll be populating
$fields = array('first_name', 'last_name');
 
// loop through fields and add the Gravity Forms filters
foreach($fields as $field)
  add_filter('gform_field_value_'.$field, 'my_populate_field');
 
 
// the callback that gets called to populate each field
function my_populate_field($value){
  // we have to wrestle the field name out of the filter name,
  // since GF doesn't pass it to us
  $filter = current_filter();
  if(!$filter) return '';
  $field = str_replace('gform_field_value_', '', $filter);
  if(!$field) return '';
 
  // get the current logged in user object
  $user = wp_get_current_user();
 
  // We'll just return the user_meta value for the key we're given.
  // In most cases, we'd want to do some checks and/or apply some special
  // case logic before returning.
  return get_user_meta($user->ID, $field, true);
}

// change wp_mail "from" email and name
add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email )
{
	return "tnedelko@myenglishonline.ca";
}

add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
function my_mail_from_name( $name )
{
	return "English Online Inc.";
}

//make archives include LearnDash post types, from https://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'sfwd-courses'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

/* DON'T DELETE THIS CLOSING TAG */ ?>
