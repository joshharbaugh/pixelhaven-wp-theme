<?php


//Highlight
function shortcode_highlight($atts, $content=null){

	 extract( shortcode_atts( array(
	  'color' => '#000',
	  'textcolor' => '#484747'
      ), $atts ) );
	
$style = ' style="color:' . $textcolor . '; background-color:' . $color . '; padding: 2px 4px;"';
return '<span' . $style . '">'.do_shortcode($content).'</span>';

}
add_shortcode('hilite', 'shortcode_highlight');



?>