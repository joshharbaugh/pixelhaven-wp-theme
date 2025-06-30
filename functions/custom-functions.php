<?php

// Twitter Followers
function tf_count($user_name='') {
	$tuser_info = file_get_contents('http://twitter.com/users/show/'.$user_name.'.xml');
	$begin_tag = '<followers_count>';
	$end_tag = '</followers_count>';
	$first_part = explode($begin_tag,$tuser_info);
	$sec_part = explode($end_tag,$first_part[1] );
	$fcount = $sec_part[0];
	return  $fcount;
}

//TITLES
function theme_titles() {


	$separator=stripslashes(get_option('theme_separator'));
	
	if(!$separator)
		$separator="|";
	
	if(is_front_page())
		bloginfo('name');	
		
	else if (is_single() or is_page() or is_home()){
		bloginfo('name'); 
		wp_title($separator,true,'');
	}
	
	else if (is_404()){
		bloginfo('name');	
		echo " $separator ";
		_e('404 error - page not found', 'theme');
	}
	
	else{
		bloginfo('name'); 
		wp_title($separator,true,'');
	}
	
	
}

//GET THE PORTFOLIO IMAGE
function theme_post_image(){
	global $post;
	$image = '';
	
	//Get the image from the post meta box
	$image = get_post_meta($post->ID, 'theme_post_image', true);
	if($image) return $image;
	
	//If the above doesn't exist, get the post thumbnail
	$image_id = get_post_thumbnail_id($post->ID);
	$image = wp_get_attachment_image_src($image_id, 'theme_thumb');
	$image = $image[0];
	if($image) return $image;
	
	
	//If there is still no image, get the first image from the post
	return theme_get_first_image();

}

function portfolio_thumbnail() {
  //If the above doesn't exist, get the post thumbnail
	$image_id = get_post_thumbnail_id($post->ID);
	$image = wp_get_attachment_image_src($image_id, 'portfolio_thumb');
	$image = $image[0];
	if($image) return $image;
}

//PORTFOLIO PROJECT LINK
function theme_project_link(){
	global $post;
	$link = '';

	//Get the image from the post meta box
	$link = get_post_meta($post->ID, 'theme_project_link', true);
	if($link) return $link;
}


//GET FIRST IMAGE FROM POST CONTENT
function theme_get_first_image(){
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		
	$first_img="";
		
	if(isset($matches[1][0]))
		$first_img = $matches[1][0];
			
	return $first_img;
}
	
	
	


//BUILD IMAGE RESIZE
function theme_build_image($img='', $w=false, $h=false, $zc=1 ){

	if($h)
		$h = "&amp;h=$h";
	else
		$h = '';
		
	if($w)
		$w = "&amp;w=$w";
	else
		$w = '';
		
	$image_url = THEME_DIR . "/php/timthumb.php?src=" . THEME_CDN . $img . $h . $w;
	
	return $image_url;


}


//DISPLAY MAIN MENU
function theme_menu(){

	//If this is WordPress 3.0 and above AND if the menu location registered in functions/register-wp3.php has a menu assigned to it
	if(function_exists('wp_nav_menu') && has_nav_menu('main_menu')):
	
		/*
		 Display the Nav menu with:
		  - the slug main_menu
		  - no container element
		  - a menu class of sf-menu
		  - a depth of 2 (main level and first child)
		  - the custom walker defined below, theme_menu_walker
		*/
		
		wp_nav_menu( 
			array( 
				'theme_location' => 'main_menu', 
				'container' => '',
				'container_class' => 'menu-header',
				'menu_class' => 'sf-menu', 
				'depth' => 2, 
				'walker' => new theme_menu_walker())
		);
		
	
		
	
	//If either this is WP version<3.0 or if a menu isn't assigned, use wp_list_pages()
	else:
		echo '<ul class="sf-menu">';
			wp_list_pages('depth=1&title_li=');
		echo '</ul>';
	
	endif;		
	
	
}

//CUSTOM EXCERPT LENGTH
function theme_excerpt($len=20, $trim="&hellip;"){
	$limit = $len+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	$num_words = count($excerpt);
	if($num_words >= $len){
		$last_item=array_pop($excerpt);
	}
	else{
	$trim="";
	}
	$excerpt = implode(" ",$excerpt)."$trim";
	echo $excerpt;

}



//THEME MENU WITH DESCRIPTION
class theme_menu_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args){	
	
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		if($depth != 0){
			$description = "";
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $description . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
	}
}




//theme BREADCRUMBS
function theme_breadcrumbs(){

	//No breadcrumbs if disabled
	if(get_option('theme_show_breadcrumbs', 'true') == 'false')
		return;

	//No breadcrumbs on homepage
	if(is_front_page())
		return;
		

	$breadcrumb_sep=' / '; // Separator
			
	global $post;
?>	
	<div class="bread_crumbs">

		<a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'theme'); ?></a>

<?php echo $breadcrumb_sep; ?>

<?php

$blog_page_id=get_option('page_for_posts');

	//Single post
	if(is_single()){	
		//Portfolio posts
		if(get_query_var('post_type') == 'portfolio')
			_e('Portfolio', 'latest');
		//Blog posts
		else{
			echo '<a href="' . get_permalink($blog_page_id) . '">';
			echo get_the_title($blog_page_id);		
			echo '</a>';
		}
		echo $breadcrumb_sep;
		the_title();
	
	}

	if ( is_home()) {
		echo get_the_title($blog_page_id);	
	}	
	

	if ( is_page() && $post->post_parent==0 ) {
			the_title();
	}
	elseif( is_page() && $post->post_parent!=0 ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb)
				echo $crumb . $breadcrumb_sep;
			the_title();
	}
	elseif (is_category() ) {
			_e('Archive for category', 'latest');
			echo ' &#39;';
			single_cat_title();
			echo '&#39;';
 
	}
	elseif ( is_tax() ) {
			global $wp_query;	
			$term = $wp_query->get_queried_object();	
			$taxonomy = get_taxonomy ( get_query_var('taxonomy') );
			$term = $term->name;
			_e('Archive for', 'latest');
			echo ' ' . strtolower($taxonomy->labels->singular_name) . ' &#39;' . $term . '&#39;';
 
	}
	elseif ( is_day() ) {
    	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> / ';
    	echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> / ';
    	echo get_the_time('d');
	} 
	elseif ( is_month() ) {
    	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> / ';
    	echo get_the_time('F'); 
	} 
	elseif ( is_year() ) {
    	echo get_the_time('Y'); 
	} 	
	elseif ( is_search() ) {
			_e('Search results for', 'theme');
			echo ' &#39;' . get_search_query() . '&#39;'; 
	}
	elseif ( is_tag() ) {
			_e('Posts tagged', 'theme');
			echo ' &#39;';
			single_tag_title();
			echo '&#39;';
	}
	
	if ( get_query_var('paged') ) {
		printf( __( ' (Page %s) ', 'theme' ), get_query_var('paged') );
	}
?>
</div>
<?php	
}




//BUILD A LIST OF CATEGORIES TO EXCLUDE
function theme_build_cat_exclude(){

	$categories = get_categories('hide_empty=0&orderby=id');
	$exclude="";
	
	foreach($categories as $cat):
		$cat_field = 'theme_cat_' . $cat->cat_ID;
		if( get_option($cat_field) and get_option($cat_field)=='false')
			$exclude .= "-" . $cat->cat_ID . ",";		
	endforeach;		
	
	if($exclude)
		$exclude = substr($exclude, 0, -1); //Remove the last comma
		
		
	return $exclude;
}

class RecentPostsFooterWidget extends WP_Widget {

		function RecentPostsFooterWidget() {
			parent::WP_Widget( false, 'Recent Posts in Footer' );
		}

		function widget($args, $instance) {
			$cache = wp_cache_get('widget_recent_posts', 'widget');

			if ( !is_array($cache) )
				$cache = array();

			if ( isset($cache[$args['widget_id']]) ) {
				echo $cache[$args['widget_id']];
				return;
			}

			ob_start();
			extract($args);

			$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
			if ( ! $number = absint( $instance['number'] ) )
	 			$number = 10;

			$r = new WP_Query(array('category__not_in' => array( 22 ), 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
			if ($r->have_posts()) :
	?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<?php while ($r->have_posts()) : $r->the_post(); ?>
			<div class="content" id="blog-entry">
				<div class="date"><?php echo get_the_date(); ?></div>
				<?php
				if ( has_post_thumbnail() ) { ?>
					<a class="clearfix" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
					<?php the_post_thumbnail( 'footer_thumb' ); ?>
					</a>
				<?php } ?>
				<h3><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h3>
				<?php the_excerpt(); ?>
			</div>
			<?php endwhile; ?>
			<?php echo $after_widget; ?>
	<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

			endif;

			$cache[$args['widget_id']] = ob_get_flush();
			wp_cache_set('widget_recent_posts', $cache, 'widget');
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];
			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset($alloptions['widget_recent_entries']) )
				delete_option('widget_recent_entries');

			return $instance;
		}

		function flush_widget_cache() {
			wp_cache_delete('widget_recent_posts', 'widget');
		}

		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
			$number = isset($instance['number']) ? absint($instance['number']) : 5;
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<?php
		}
}

function footerposts_register_widgets() {
	register_widget( 'RecentPostsFooterWidget' );
}

add_action( 'widgets_init', 'footerposts_register_widgets' );



/** LEGACY TWENTYTEN FUNCTIONS
 *
 *  Pick up the old functions so as not to break current theme
 */
 
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return '</p><p><a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a></p>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Published:</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'archive_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function archive_posted_on() {
	printf( __( '<div class="alignleft"><span class="%1$s">Published:</span></div> %2$s <div class="alignleft"><span class="meta-sep">Written by:</span></div> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date( 'F jS, Y' )
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

?>