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
<!-- <script src="<?php bloginfo( 'template_url' ); ?>/js/rotate.js"></script>


<script src="<?php bloginfo( 'template_url' ); ?></js/twitter-feed.js"></script>

  DEPRECATED. KOLLA IN https://dev.twitter.com/docs/tfw-javascript
<script src="http://api.twitter.com/1/statuses/user_timeline.json?screen_name=Tibbedude&amp;include_rts=true&amp;count=4&amp;callback=twitterCallback2" type="text/javascript"></script>
-->



</body>
</html>