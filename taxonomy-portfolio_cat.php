<?php

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
				                    <ul id="examples">
				                              <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			                                        <li class="thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<img src="<?php echo theme_build_image(theme_post_image(), 199, 137); ?>" alt="<?php the_title(); ?>" />
								</a>
							</li>
				                              <?php endwhile; endif; ?>
						</ul>
					</div>
				</div>
<?php endif; ?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>