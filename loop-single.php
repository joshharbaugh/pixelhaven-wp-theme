<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title">
				<?php the_title(); ?>
			</h2>
			
			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php next_post_link( __( '%link', 'twentyten' ), 'PREV <br />%title' ); ?></div>
				<div class="nav-next"><?php previous_post_link( __( '%link', 'twentyten' ), 'NEXT <br />%title' ); ?></div>
			</div><!-- #nav-below -->
		<?php if(get_post_type( $post ) == 'portfolio'): ?>
		          <div class="entry-meta">
		                    <?php
				$project_link = theme_project_link();
				if($project_link) : ?>
		                    <a href="<?php echo $project_link; ?>" class="button" target="_blank">Launch project</a>
		                    <?php endif; ?>
		                    <div class="alignleft"><span class="meta-prep">Role:</span></div>
				<?php
				$posttags = get_the_tags();
				$html = '<span class="post_tags">';
				if ($posttags) {
					foreach($posttags as $tag) {
					          $html .= "{$tag->name}<br />";
					}
				}
				$html .= '</span>';
				echo $html;
				?>
		          </div><!-- .entry-meta -->
		<?php else: ?>
			<div class="entry-meta">
				<?php archive_posted_on(); ?>
				<?php
				$_values = get_post_custom_values('video_link');
				if ($_values) {
					foreach ( $_values as $key => $value ) {
						echo "<div class='alignleft'><span class='meta-sep'>Video</span></div> <a href='$value' target='_blank'>Link</a>";
					}
				}
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
			<div class="entry-summary">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-summary -->

		</div><!-- #post-## -->
		<?php if(get_post_type( $post ) !== 'portfolio'): ?>
			<?php //comments_template( '', true ); ?>
		<?php endif; ?>

<?php endwhile; // end of the loop. ?>