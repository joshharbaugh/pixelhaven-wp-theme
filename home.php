<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<section class="main">
		<div class="inner" style="background: url(<?php echo THEME_DIR; ?>/images/section_shadow.jpg) no-repeat center bottom;">
			<div class="clearfix">
				<a name="about"></a>
				<h1>Pixelhaven is a small<br /><strong>web design studio</strong></h1>
				<h2>Led by designer <a href="http://www.twitter.com/joshharbaugh" target="_blank">@joshharbaugh</a> located in the city of Cincinnati, Ohio</h2>
				<div class="about">
					<p>In the intimidating world of bits-n-bytes Pixelhaven is here to lead you through the wilderness and into the exciting realm that is the world wide web.</p>
					<p>Pixelhaven is passionate about creating attractive, easy to use, and structurally clean web sites &ndash; using the latest in <a href="http://www.webstandards.org/">web standards</a>.</p>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>