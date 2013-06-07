<?php
$post_image_info=array(
	'box_name' => 'theme-post-image-meta-box',
	'title' => 'Post Image',
	'location' => array('post','portfolio')
);


$post_image_options=array(

array(
	"type" => "text",
	"name" => "theme_post_image",
	"desc" => "Enter the URL to an image for this post. It will be resized to fit where required. You may also use the <code>Post Thumbnail</code> feature instead.",
	"default" => "" ),

);

$metabox_post_image = new theme_meta_box($post_image_info, $post_image_options);
?>