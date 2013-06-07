<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

          <section>
               <div class="inner">
                    <div class="clearfix">
<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
                              
                         <div class="article reading">
								<h2>The Book Club</h2>
								<div class="content">
								<?php
								$GoodreadsResponse = new Book_Details("12910715");
								$details = $GoodreadsResponse->getDetails();
								foreach($details as $detail) { ?>
										<img src="http://photo.goodreads.com/books/1318982331s/<?=$detail->id;?>.jpg" alt="Cover of <?=$detail->title;?>" />
										<h3><a href="http://www.goodreads.com/book_link/follow/1?book_id=<?=$detail->id;?>" title="<?=$detail->title;?>" target="_blank"><?=$detail->title;?></a></h3>
										<p class="author">by <a href="<?=$detail->author_url;?>" title="<?=$detail->author;?>" target="_blank"><?=$detail->author;?></a></p>
										<?php if ($detail->book_description) : ?>
										<blockquote><?=$detail->book_description;?><cite>&mdash;Goodreads.com</cite></blockquote>
										<?php endif; ?>
								<? } ?>
                              </div>
                         </div>
                         <div class="article">
                              <h2>Recent Last.fm Tracks</h2>
                              <ul class="tracks">
                                   <?php
                                   $lfm = new LFM_RecentlyPlayed("pixelhaven", "2b727a366ef29c9b72088dc0e7db1352");
                                   $tracks = $lfm->getSongs();
                                   foreach($tracks as $track) { ?>
                                   <li><img src="<?=$track->image;?>" width="34" height="34" /> <p><?=$track->artist;?> - <a href="<?=$track->url;?>" target="_blank" title="More info about <?=$track->name;?> on Last.fm"><?=$track->name;?></a></p></li>
                                   <?php } ?>
                              </ul>
                         </div>
                    </div>
               </div>
          </section>
	<footer>
	          <div class="inner">
                    	<div class="clearfix">
                    	  <div class="article reading">
                          <h2>Pixelhaven LLC</h2>
                          <p>6701 Woodland Trace Court<br>Liberty Township, Ohio 45044<br />+1 740 202 0906 | <a href="mailto:josh@pixelhaven.co">josh@pixelhaven.co</a></p>
		                    </div>
		                    <div class="article">
		                              <h2>Follow Pixelhaven</h2>
		                              <ul class="social">
		                                  <li><a class="twitter" href="http://www.twitter.com/pixelhavenllc" title="Follow us on Twitter"></a></li>
		                                  <li><a class="facebook" href="http://facebook.com/pixelhaven" title="Like us on Facebook"></a></li>
		                                  <li><a class="rss" href="http://feeds.feedburner.com/Pixelhaven" title="Subscribe via RSS"></a></li>
		                                  <li><a class="lastfm" href="http://last.fm/user/pixelhaven" title="Connect on Last.fm"></a></li>
		                                  <li><a class="skype" href="skype:joshharbaugh?add" title="Contact me on Skype"></a></li>
		                              </ul>
		                    </div>
		                    <div class="article">
					<h2>My Netflix Recommendation</h2>
		                              <div id="netflix_recommended" style="position: relative; /*height: 90px;*/ cursor: pointer;">
		                              <?php
		                                   $NetflixDetails = new Netflix_Details("Sherlock");
		                                   $movies = $NetflixDetails->getMovie();
		                                   foreach($movies as $movie) { ?>
		                                   <div style="position: relative; height: 90px; display: table;">
		                                        <img class="imgHover" src="<?=$movie->image_medium;?>" style="float: left; margin-left: 20px;" />
		                                        <h3 class="titleHover" style="vertical-align: middle; display: table-cell;"><?=$movie->title;?><br /><em>Roll over for synopsis</em></h3>
		                                   </div>
		                                   <script src="http://jsapi.netflix.com/us/api/js/api.js"></script>
		                                   <div id="details" style="display:none;width:300px;position:absolute;bottom:0px;left:-292px;background:#11161C;border-right: 1px solid #000; border-bottom: 1px solid #000;padding-top:15px;">
		                                        <p><?=$movie->synopsis;?></p>
		                                        <p><a id="addMe" style="cursor:pointer;" onclick="javascript:nflx.addToQueue('http://api.netflix.com/catalog/titles/series/70021357/seasons/70021357', -100, -265, 'vx6vbgt4yv9hekyc6hcqqyrg', 'instant', 'netflix_recommended');">Add to Your Instant Queue</a></p>
		                                   </div>
		                              <?php } ?>
		                              </div>
		                    </div>

			</div>
		</div>
	</footer>
	<div id="bottom"><p>&copy; 2012 <?php bloginfo( 'name' ); ?> <a href="/terms-of-use">Terms of Use</a> | <a href="/privacy-policy">Privacy</a> | <a href="/contact">Contact</a></p></div>

</div>

<?php	wp_footer(); ?>

	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">google.load("jquery", "1.4");</script>
	<script type="text/javascript">google.load("jqueryui", "1.8");</script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
	<script src="<?php echo THEME_DIR; ?>/assets/js/jquery.easing.min.js"></script>
  <script src="<?php echo THEME_DIR; ?>/assets/js/jquery.isotope.min.js"></script>

	<!-- Twitter -->
	<script src="http://twitter.com/javascripts/blogger.js" type="text/javascript"></script>
	<script src="http://api.twitter.com/1/statuses/user_timeline.json?callback=twitterCallback2&amp;include_entities=false&amp;include_rts=false&amp;screen_name=pixelhavenllc&amp;count=1" type="text/javascript"></script>

	<script src="<?php echo THEME_DIR; ?>/assets/js/plugins.js"></script>
	<script src="<?php echo THEME_DIR; ?>/assets/js/script.js?v=1"></script>
	
	<!--[if lt IE 7 ]>
	<script src="js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg'); </script>
	<![endif]-->
	
	<script>
	var _gaq = [['_setAccount', 'UA-1333987-1'], ['_trackPageview']];
	(function(d, t) {
	var g = d.createElement(t),
	   s = d.getElementsByTagName(t)[0];
	g.async = true;
	g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g, s);
	})(document, 'script');
	</script>

  <script type="text/javascript">
  setTimeout(function(){var a=document.createElement("script");
  var b=document.getElementsByTagName("script")[0];
  a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0016/3839.js?"+Math.floor(new Date().getTime()/3600000);
  a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
  </script>

</body>
</html>