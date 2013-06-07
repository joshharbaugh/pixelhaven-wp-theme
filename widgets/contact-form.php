<?php

class Theme_Contact extends WP_Widget {

	function Theme_Contact(){
		$widget_ops = array( 'classname' => 'theme-contact', 'description' => 'Display a contact form in a widget area. The recipient email is set in the theme options.' );
		$this->WP_Widget( 'theme_contact', 'Theme Contact', $widget_ops );
	}
	

	 function widget($args, $instance){  
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);		
		if ( empty($title) ) $title = false;
		
		
        echo $before_widget; 
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;	
		
?>
		<form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" class="contact">
			<div class="alert"></div>
			<fieldset>
				<input type="hidden" value="theme_contact_form" name="action" />
				<input type="text" name="name" value="<?php _e('Your Name', 'theme'); ?>" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}" id="contact_name" />
				<input type="text" name="email" value="<?php _e('Email', 'theme'); ?>" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}" id="contact_email" />
				<textarea rows="8" cols="25" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}" name="message" id="contact_message"><?php _e('Message', 'theme'); ?></textarea>
				<input type="submit" class="button" value="<?php _e('Submit', 'theme'); ?>" />
			</fieldset>
		</form>
<?php
			
	
		echo $after_widget;
		
	}
	
	
	
	
	
	function form($instance) {
	
        $title = esc_attr($instance['title']); 
?>		
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		
		<p>
			<code><em>This widget is best used in the footer columns widget area. It will display an AJAX contact form.</em></code>
		</p>
		
<?php		
    }


	function update($new_instance, $old_instance) {
        $instance=$old_instance;
        $instance['title']=strip_tags($new_instance['title']);		
        return $instance;

    }
	
}



//AJAX Contact form submission
add_action('wp_ajax_theme_contact_form', 'theme_send_contact');
add_action('wp_ajax_nopriv_theme_contact_form', 'theme_send_contact');

function theme_send_contact(){


	$name		= $_REQUEST['name'];
	$email		= $_REQUEST['email'];
	$message	= $_REQUEST['message'];

	if(trim($name) == '') {
		_e('Please enter your name', 'theme');
		die();
	} else if(trim($email) == '') {
		_e('Please enter your email', 'theme');
		die();
	} else if(!is_email($email)) {
		_e('Please enter a valid email', 'theme');
		die();	
	} else if(trim($message) == '') {
		_e('Please enter a message', 'theme');
		die();
    }
	
	
	
	if(get_magic_quotes_gpc())
        $message = stripslashes($message);
		
		
	$address = get_option('theme_email');
	if(!$address or $address=="")
			$address=get_option('admin_email'); 
	 
	$placeholders=array("%sitename%", "%name%");
	$replacements=array(get_bloginfo('name'), $name); 
	
	$subject = stripslashes(get_option('theme_form_subject'));
	$subject=str_replace($placeholders, $replacements, $subject);
	
	
    if(wp_mail($address, $subject, $message, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n"))
		_e('Thanks! Your message was sent.', 'theme');
	else
		_e('There was an error sending your message!', 'theme');
		
		
     
	die();

}


?>