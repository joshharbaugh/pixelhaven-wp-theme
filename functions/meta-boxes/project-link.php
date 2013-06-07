<?php
$project_link_info=array(
	'box_name' => 'theme-project-link-meta-box',
	'title' => 'Project Link',
	'location' => array('portfolio')
);


$project_link_options=array(

array(
	"type" => "text",
	"name" => "theme_project_link",
	"desc" => "Enter the URL.",
	"default" => "" ),

);

$metabox_portfolio = new theme_meta_box($project_link_info, $project_link_options);
?>