<?php
/*
Plugin Name: EO Custom Login and Registration
Plugin URI: http://myenglishonline.ca
Description: Customizes the fields and appearance of the login and registration forms
Version: 1.0
Author: English Online
Author URI: http://myenglishonline.ca
*/

/**************************
CUSTOMIZE REGISTRATION FORM
**************************/
//from https://codex.wordpress.org/Customizing_the_Registration_Form
//1. Add a new form element...
add_action( 'register_form', 'eo_register_form' );
function eo_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
        
        ?>
        <p class="first half">
            <label for="first_name"><?php _e( 'First Name', 'realizeforum' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
        </p>
        <p class="last half">
            <label for="last_name"><?php _e( 'Last Name', 'realizeforum' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
        </p>
        <p class="first half">
            <label for="organization"><?php _e( 'Organization', 'realizeforum' ) ?><br />
                <input type="text" name="organization" id="organization" class="input" value="<?php echo esc_attr( wp_unslash( $organization ) ); ?>" size="25" /></label>
        </p>
        <p class="last half">
            <label for="jobtitle"><?php _e( 'Position/Title', 'realizeforum' ) ?><br />
                <select name="jobtitle" id="jobtitle" class="input">
                        <option value="" <?php selected( '', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>Select&hellip;</option>
                        <option value="Administrator or Coordinator" <?php selected( 'Administrator or Coordinator', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>Administrator or Coordinator</option>
                        <option value="ESL Practitioner" <?php selected( 'ESL Practitioner', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>ESL Practitioner</option>
                        <option value="ESL Volunteer" <?php selected( 'ESL Volunteer', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>ESL Volunteer</option>
                        <option value="Employment Counsellor" <?php selected( 'Employment Counsellor', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>Employment Counsellor</option>
                        <option value="Assessor" <?php selected( 'Assessor', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>Assessor</option>
                        <option value="Settlement Professional" <?php selected( 'Settlement Professional', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>Settlement Professional</option>
                    <option value="Other" <?php selected( 'Other', get_the_author_meta( 'jobtitle', $user->ID ) ); ?>>Other</option>
                    </select>
            
            
            </label>
        </p>
        <p class="first half">
			<label for="affirmation"><?php _e( 'Affirmation', 'realizeforum' ) ?><br /><input type="checkbox" name="affirmation" id="affirmation" value="<?php echo esc_attr( wp_unslash( $affirmation ) ); ?>" size="25" /></label>
            <span class="description">By checking this box, you are affirming that the above information is true and correct.</span>
		</p>
        <?php
    }

    //2. Add validation. In this case, we make sure first_name is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'realizeforum' ) );
        }
        if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
            $errors->add( 'last_name_error', __( '<strong>ERROR</strong>: You must include a last name.', 'realizeforum' ) );
        }
        if ( empty( $_POST['organization'] ) || ! empty( $_POST['organization'] ) && trim( $_POST['organization'] ) == '' ) {
            $errors->add( 'organization_error', __( '<strong>ERROR</strong>: You must include your organization.', 'realizeforum' ) );
        }
        if ( empty( $_POST['jobtitle'] ) || ! empty( $_POST['jobtitle'] ) && trim( $_POST['jobtitle'] ) == '' ) {
            $errors->add( 'jobtitle_error', __( '<strong>ERROR</strong>: You must select your jobtitle.', 'realizeforum' ) );
        }

        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    function myplugin_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        }
        if ( ! empty( $_POST['last_name'] ) ) {
            update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
        }
        if ( ! empty( $_POST['organization'] ) ) {
            update_user_meta( $user_id, 'organization', trim( $_POST['organization'] ) );
        }
        if ( ! empty( $_POST['jobtitle'] ) ) {
            update_user_meta( $user_id, 'jobtitle', trim( $_POST['jobtitle'] ) );
        }
        if ( ! empty( $_POST['affirmation'] ) ) {
            update_user_meta( $user_id, 'affirmation', trim( $_POST['affirmation'] ) );
        }
    }

/*******************
CUSTOMIZE LOGIN PAGE
********************/

//add our own paragraph to bottom of login screen
function my_loginfooter() { ?>
	<p class="login-addition">This login is for English Online Staff and Volunteers.</p>
<?php }
add_action('login_footer','my_loginfooter');
