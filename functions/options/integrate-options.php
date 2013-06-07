<?php
$info=array(
	'name' => 'integration',
	'pagename' => 'code-integration',
	'title' => 'Code Integration',
	'sublevel' => 'yes'
);

$options=array(

array(
	"type" => "checkbox",
	"name" => "Add these",
	"id" => array( "theme_header_js_code", "theme_footer_js_code", "theme_css_code", "theme_child_stylesheet"),
	"options" => array( "Add JavaScript to &lt;head&gt;", "Add JavaScript to &lt;footer&gt;", "Add custom CSS", "Add child stylesheet"),					
	"desc" => "Choose whether to display the code below in the given locations. You can uncheck the box and let the code remain in the boxes below to preserve it.",
	"default" => array( "checked", "checked", "checked", "checked") ),

array(
	"type" => "textarea",
	"name" => "Header Javascript",
	"id" => "theme_header_js",
	"desc" => "Enter any Javascript you may want for the header. You MUST enter &lt;script&gt; tags",
	"default" => "" ),
	
array(
	"type" => "textarea",
	"name" => "Footer Javascript",
	"id" => "theme_footer_js",
	"desc" => "Enter any Javascript you may want for the footer. You MUST enter &lt;script&gt; tags",
	"default" => "" ),
	
array(
	"type" => "textarea",
	"name" => "Custom CSS",
	"id" => "theme_custom_css",
	"desc" => "Enter any custom CSS you want. You MUST NOT enter &lt;style&gt; tags",
	"default" => "" ),
	
array(
	"type" => "text",
	"name" => "Child stylesheet",
	"id" => "theme_child_css",
	"desc" => "Enter the URL of a child stylesheet to display, if you wish..",
	"default" => "" )
	
);

$optionspage=new theme_options_page($info, $options);
?>