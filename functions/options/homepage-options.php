<?php
$info=array(
	'name' => 'home-page',
	'pagename' => 'home-page-options',
	'title' => 'Home Page Options',
	'sublevel' => 'yes'
);

$options=array(

array(
	"type" => "text",
	"name" => "Homepage mission statement",
	"id" => "theme_mission_statement",
	"desc" => "Type in a mission statement or similar sentence to display on the homepage",
	"default" => "&#34;Our mission statement, a statement about our mission&#34;" ),
	
array(
	"type" => "select",
	"name" => "Homepage slider - source?",
	"id" => "theme_slider_source",
	"options" => array( "Latest Posts", "Slider Manager"),					
	"desc" => "Choose the source for the homepage slider - should it be populated with images and text from the latest portfolio posts, or should it be using the slider manager?",
	"default" => "Latest Posts" ),
	

array(
	"type" => "text",
	"name" => "Homepage slider - number of items?",
	"id" => "theme_slider_items",
	"desc" => "Choose the number of recent items to display. Default is 5",
	"default" => "5" ),
	
);

$optionspage=new theme_options_page($info, $options);
?>