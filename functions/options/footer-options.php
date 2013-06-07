<?php
$info=array(
	'name' => 'footer',
	'pagename' => 'footer-options',
	'title' => 'Footer Options',
	'sublevel' => 'yes'
);


$options=array(

array(
	"type" => "image",
	"name" => "Footer Logo",
	"id" => "theme_footer_logo",
	"desc" => "Paste the URL to your logo, or upload it here.",
	"default" => get_bloginfo('template_directory')."/assets/img/footer_logo.jpg" ),
	
array(
	"type" => "text",
	"name" => "Footer copyright text",
	"id" => "theme_footer_copyright",
	"desc" => "Enter the text to be used in the footer copyright region",
	"default" => "Your copyright - footer info here" ),	
	

array(
	"type" => "checkbox",
	"name" => "Social media",
	"id" => array( "theme_add_rss", "theme_add_twitter", "theme_add_social3", "theme_add_social4", "theme_add_social5" ),
	"options" => array( "RSS feed", "Twitter link", "Social icon 3", "Social icon 4", "Social icon 5"),					
	"desc" => "Choose whether to display the icons and links for these sites.",
	"default" => array( "checked", "checked", "not", "not", "not") ),
	
	
array(
	"type" => "text",
	"name" => "Your Twitter link",
	"id" => "theme_twitter_link",
	"desc" => "Enter your Twitter URL for the footer",
	"default" => "" ),
	

array(
	"type" => "image",
	"name" => "Social icon 3 - image",
	"id" => "theme_social_icon3",
	"desc" => "Upload the image for social icon 3.",
	"default" => "" ),	
	
array(
	"type" => "text",
	"name" => "Social icon 3 - link",
	"id" => "theme_social_link3",
	"desc" => "Enter the link for social icon 3.",
	"default" => "" ),
	
array(
	"type" => "image",
	"name" => "Social icon 4 - image",
	"id" => "theme_social_icon4",
	"desc" => "Upload the image for social icon 4.",
	"default" => "" ),	
	
array(
	"type" => "text",
	"name" => "Social icon 4 - link",
	"id" => "theme_social_link4",
	"desc" => "Enter the link for social icon 4.",
	"default" => "" ),
	
array(
	"type" => "image",
	"name" => "Social icon 5 - image",
	"id" => "theme_social_icon5",
	"desc" => "Upload the image for social icon 5.",
	"default" => "" ),	
	
array(
	"type" => "text",
	"name" => "Social icon 5 - link",
	"id" => "theme_social_link5",
	"desc" => "Enter the link for social icon 5.",
	"default" => "" )
);

$optionspage=new theme_options_page($info, $options);
?>