<?php
$info=array(
	'name' => 'general',
	'pagename' => 'general-options',
	'title' => 'General Settings'
);


$options=array(


array(
	"type" => "image",
	"name" => "Logo",
	"id" => "theme_logo",
	"desc" => "Paste the URL to your logo, or upload it here.",
	"default" => get_bloginfo('template_directory')."/assets/img/logo.jpg" ),

	
array(
	"type" => "image",
	"name" => "Favicon",
	"id" => "theme_favicon",
	"desc" => "Paste the URL to your favicon, or upload it here.",
	"default" => "" ),
	
array(
	"type" => "text",
	"name" => "Your email ID",
	"id" => "theme_email",
	"desc" => "Enter your email ID, for use in the contact form widgets",
	"default" => get_option('admin_email') ),
	
array(
	"type" => "text",
	"name" => "Contact form subject",
	"id" => "theme_form_subject",
	"desc" => "Enter a subject for the contact form. You can use the following placeholders: <code>%name%</code> for the sender's name, <code>%sitename%</code> for your site's name.",
	"default" => "%sitename% : email from %name%" ),
	
array(
	"type" => "text",
	"name" => "Alternate RSS URL",
	"id" => "theme_rss_url",
	"desc" => "If you have an alternate RSS URL (eg Feedburner), enter it here.",
	"default" => "" ),
	
array(
	"type" => "checkbox",
	"name" => "Enable timthumb?",
	"id" => array( "theme_enable_timthumb"),
	"options" => array( "Enable"),					
	"desc" => "Check this to allow dynamic TimThumb image resizing. Uncheck to do manual crops",
	"default" => array( "checked") ),
	
array(
	"type" => "checkbox",
	"name" => "Show breadcrumbs?",
	"id" => array( "theme_show_breadcrumbs"),
	"options" => array( "Show"),					
	"desc" => "Check this to show breadcrumbs (eg About &raquo; Our Company &raquo; Mission)",
	"default" => array( "checked") ),
	
array(
	"type" => "text",
	"name" => "Breadcrumb separator",
	"id" => "theme_breadcrumb_separator",
	"desc" => "Type a separator to be used in the breadcrumbs (eg '/' &rarr; Home / Page name / Subpage name)",
	"default" => "/" ),
	

array(
	"type" => "text",
	"name" => "Title separator",
	"id" => "theme_separator",
	"desc" => "Type a separator to be used in titles (eg '&raquo;' &rarr; Sitename &raquo; Pagename)",
	"default" => "|" ),
	
array(
	"type" => "textarea",
	"name" => "404 error message",
	"id" => "theme_404",
	"desc" => "Enter a message to display on your 404 (page not found) error pages.",
	"default" => "" )
	
);

$optionspage=new theme_options_page($info, $options);
?>