<?php
/**
 * Template Name: Portfolio
 *
 * A custom page template with sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Pixelhaven
 * @since Pixelhaven 4.0
 */

get_header(); ?>

	<section class="main">
		<div class="inner" style="background: url(<?php echo THEME_DIR; ?>/images/section_shadow.jpg) no-repeat center bottom;">
			<div class="clearfix">
<?php if(!is_category()) : ?>
			          <div class="article">
<?php get_sidebar(); ?>
			          </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'portfolio-widget-area' ) ) : ?>
				<div class="page">
				          <div class="entry-content">
				                    <ul id="examples" style="flex-wrap: wrap; justify-content: center; gap: 20px;">
				                              <?php dynamic_sidebar( 'portfolio-widget-area' ); ?>
						</ul>
					</div>
				</div>
<?php endif; ?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>
