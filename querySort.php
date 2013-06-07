<?php
    // load wordpress into template. dont touch me!
    $path = $_SERVER['DOCUMENT_ROOT'];
    define('WP_USE_THEMES', false);
    require($path .'/wp-load.php');
    // ah, wordpress is loaded. balance has been restored.
    query_posts($_GET["query"]);
?>

<div id="queryContainer">
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
    <!-- place your post template here. -->
    <?php endwhile; ?>
    <?php endif; ?>
</div>
