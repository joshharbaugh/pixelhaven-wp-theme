<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<section class="main">
		<div class="inner" style="background: url('<?php echo THEME_DIR; ?>/images/section_shadow.jpg') no-repeat center bottom;">
			<div class="clearfix">

                                        <?php

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'single' );
				?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>
