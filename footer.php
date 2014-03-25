    <!--Bottom Section
    <section id="bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">

          </div>
        </div>
      </div>
    </section>
  -->

    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 pull-right text-right">
            <?php if ( is_active_sidebar( 'footer1-widget' ) ) : ?>
            <?php dynamic_sidebar( 'footer1-widget' ); ?>
            <?php endif; ?>
          </div>


          <div class="col-lg-3 pull-left">
            <?php if ( is_active_sidebar( 'footer2-widget' ) ) : ?>
            <?php dynamic_sidebar( 'footer2-widget' ); ?>
            <?php endif; ?>
          </div>

          <div class="col-lg-6 pull-left"></div>

        </div>
        <hr>
      </div>
    </section>



  <?php wp_footer(); ?>
  


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.9.1.min.js"><\/script>')</script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/main.js"></script>
<script>
  // ANALYTICS
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47299822-1', 'astrid.se');
  ga('send', 'pageview');


</script>
</body>
</html>