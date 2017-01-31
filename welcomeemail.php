<?php
/*
Plugin Name: EO Custom Welcome Email
Plugin URI: http://realizeforum.ca
Description: Customizes the new user welcome email
Version: 1.1
Author: English Online
Author URI: http://myenglishonline.ca
License: GPL2
*/
if ( !function_exists( 'wp_new_user_notification' ) ) :
function wp_new_user_notification( $user_id, $notify = '' ) {
    global $wpdb;
	$user = get_userdata( $user_id );

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    
    // Generate something random for a password reset key.
	$key = wp_generate_password( 20, false );

	/** This action is documented in wp-login.php */
	do_action( 'retrieve_password_key', $user->user_login, $key );

	// Now insert the key, hashed, into the DB.
	if ( empty( $wp_hasher ) ) {
		require_once ABSPATH . WPINC . '/class-phpass.php';
		$wp_hasher = new PasswordHash( 8, true );
	}
	$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );

    $message = '<h2>Welcome to the Realize!</h2><p style="font-family: Calibri, sans-serif;font-size: 12px; color: #000; background: #e5e5e5; padding: 8px;"><strong>CONFIDENTIALITY NOTE:</strong> This message is intended only for the use of the individual to whom it is addressed and may contain information that is privileged/confidential. Any other distribution, copying or disclosure is strictly prohibited. If you are not the intended recipient or have received this message in error, please notify us immediately by reply e-mail and permanently delete this message without reading it or making a copy. Thank you.</p>
        <h3>1. CREATE A PASSWORD</h3><div style="margin-left: 20px;">';
	$message .= sprintf(__('<p>Your username is: %s'), $user->user_login) . "</p>";
	$message .= __('<p>To set your password, click this link, or copy and paste into your browser:') . "<br>";
	$message .= '<a href="' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . '">' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . '</a></p>';
    $message .=  '<p>A password suggestion will come up, but you can delete that and enter a password of your choosing.</p><p>Usernames and passwords are case sensitive. New passwords can have letters (ABC), numbers (123), and special characters (@#$).</p></div>';
	$message .= '<h3>2. LOGIN TO ACCESS VOLUNTEER JOURNAL</h3>
        <div style="margin-left: 20px;">
        <p>Go to realizeforum.ca and click Login in the header to login from any page.</p>
        <p>You can then access the Volunteer Journal under your name at the top of the page, or from the Volunteer Hub page under the Volunteers menu item.</p></div>
        <p>If you have any questions, please don&rsquo;t hesitate to Skype, phone or email me. I will be happy to help out.</p>
<p>Tatiana</p>
         <div style="font-family: Calibri, sans-serif;font-size: 12px; color: #000;">
        <p><strong>Tatiana Nedelko</strong><br>
<em style="color: #616161;">e-Volunteer Coordinator</em><br>
204.946.5140 ext. 205<br>
tnedelko@myenglishonline.ca<br>
Skype: englishonlinemb7</p>
             <p><img src="https://livelearn.ca/wp-content/uploads/2016/08/signature-line-220px.png" style="width: 220px;" alt="dotted line"></p>

<p><strong>English Online Inc.</strong><br>
    <strong><a href="myenglishonline.ca" style="color: #616161; text-decoration: none;">myenglishonline.ca</a></strong><br>
610-294 Portage Avenue<br>
Winnipeg, MB R3C 0B9<br>
<p><img src="https://livelearn.ca/wp-content/uploads/2016/08/eo-logo-tagline-220px.png" style="width: 220px;" alt="English Online: Your settlement and language learning network"></p></div>';
    
    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	wp_mail($user->user_email, sprintf(__('%s Volunteer Login Details'), $blogname), $message);
    remove_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

}
endif;

?>