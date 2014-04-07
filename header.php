<!DOCTYPE html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
	  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/animate.css">


	  <script src="<?php bloginfo( 'template_url' ); ?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

	  <!-- Fav and touch icons -->
	  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-144-precomposed.png">
	  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-114-precomposed.png">
	  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-72-precomposed.png">
	  <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-57-precomposed.png">
	  <link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/favicon32.png">

      <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

      <?php wp_enqueue_script("jquery"); ?>
      <?php wp_head(); ?>
  </head>
<body>

	    <!-- NAVBAR
	    ================================================== -->
<nav class="navbar" role="navigation">
  <div class="container">

    <div class="navbar-ex1-collapse">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="navbar-center col-sm-12 col-xs-12">
        <a class="navbar-brand-center" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" rel="home"><span id="logo-svg"><?php bloginfo('name'); ?></span></a>
      </div>

      <div class="navbar-right searchbox text-right col-lg-2 col-md-3 col-sm-12 col-xs-12">
        <?php if ( is_active_sidebar( 'search-widget-top' ) ) : ?>
        <?php dynamic_sidebar( 'search-widget-top' ); ?>
        <?php endif; ?>
      </div>

      <?php // wp_list_pages(array('title_li' => '', 'exclude' => 20)); 
        // http://twittem.github.io/wp-bootstrap-navwalker/

        wp_nav_menu (array(
          'menu'            => 'Primary Menu',
          'theme_location'  => 'top-bar',
          'depth'           => 3,
          'container'       => false,
          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          'fallback_cb'     => 'wp_page_menu',
           'container'         => 'div',
           //'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse navbar-left col-sm-12 col-xs-12',
          'menu_class'      => 'nav navbar-nav ',
          'post_type'       => array('page', 'wpboot_tyger'),
          'walker'          => new wp_bootstrap_navwalker()
        ));

		  ?>



      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Klicka för meny</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
    
    </div>
  </div>
</nav>
