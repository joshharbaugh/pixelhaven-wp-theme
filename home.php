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
				<h1><strong>Hi, I'm Josh Harbaugh</strong></h1>
				<h2 style="letter-spacing: 0.125em; text-transform: inherit">
					A frontend developer with 15+ years of experience creating web applications and user interfaces.<br />
					This is my digital portfolio showcasing selected projects and explorations.
				</h2>
				<div class="about">
					<p>In the intimidating world of bits-n-bytes Pixelhaven exists to explore the intersection of design, code, and user experience.</p>
					<p>I am passionate about creating attractive, easy-to-use, and structurally clean web sites &ndash; using the latest in <a href="http://www.webstandards.org/">web standards</a>.</p>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
