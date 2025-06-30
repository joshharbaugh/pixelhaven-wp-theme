<?php //error_reporting(E_ALL); ?>
<?php include(dirname(__FILE__) . '/includes/twitter.class.php') ?>
<?php include(dirname(__FILE__) . '/includes/goodreads.class.php') ?>
<?php include(dirname(__FILE__) . '/includes/lastfm.class.php') ?>
<?php include(dirname(__FILE__) . '/includes/netflix.class.php') ?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="dns-prefetch" href="//pixelhavenllc.s3.amazonaws.com">
<link rel="dns-prefetch" href="//ajax.googleapis.com">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<meta name="revisit-after" content="14 days" />
<meta name="viewport" content="initial-scale=1.0,width=device-width">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'wpurl' ); ?>/wp-content/themes/pixelhaven/style.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="https://use.typekit.net/znw3dwn.js"></script>
<script>try{Typekit.load({ async: false });}catch(e){}</script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="container" class="hfeed">
          <header class="clearfix <?php if( !is_home() || !is_front_page() ) : ?>narrow<?php endif; ?>">
                  <div class="clearfix" id="top">
                         <div class="inner">
                              <div id="twitter" class="tweet">
                                   <blockquote id="twitter_update_list">
					<?php $Tweets = new Tweets('pixelhavenllc'); ?>
                                    	<?php $latestTweets = $Tweets->getLatestTweet(); ?>
                                    	<?php foreach($latestTweets as $tweet) { ?>
                                    	<p><?php echo $tweet->text; ?> <a href="http://twitter.com/<?php echo $tweet->screen_name; ?>">@<?php echo $tweet->screen_name; ?></a></p>
                                    	<?php } ?>
                                   </blockquote>
                              </div>
                              <div id="availability" class="right">Availability:<!-- <em>Sorry, not accepting new projects</em>--> <a onclick="window.open(this.href,  null, 'height=1323, width=680, toolbar=0, location=0, status=1, scrollbars=1, resizable=1'); return false" href="http://pixelhaven.wufoo.com/forms/z7x3k7/" title="Website Project Sheet">Accepting new projects &rarr;</a>
                              </div>
                         </div>
                  </div>
                  <div class="inner highlight">
						<nav class="clearfix">
                            <div id="logo"><a style="display: block; height: 69px; overflow: hidden;" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>: Portfolio of Josh Harbaugh" rel="home"><img src="<?php dirname(__FILE__)?>/images/logo.gif" alt="" /></a></div>
                            <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
						</nav>
						<?php if( is_home() || is_front_page() ) : ?>
						<div class="headline clearfix" id="work">
							<h1>Building websites</h1>
							<h2>And just about anything else</h2>
							<?php if ( is_active_sidebar( 'portfolio-widget-area' ) ) : ?>
							<ul>
								<?php dynamic_sidebar( 'portfolio-widget-area' ); ?>
							</ul>
							<?php endif; ?>
						</div>
						<?php else : ?>
						<div class="headline clearfix narrow" id="work"></div>
						<?php endif; ?>
                  </div>
          </header>
