<?php get_header(); ?>


<section id="searchresults">
  <div class="container">    
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="row">
      <div class="clickable" onclick="location.href='<?php the_permalink(); ?>'">
        <div class="col-md-1">
          <?php
          if ( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small-thumb' ); 
            echo '<img src="' . $thumbnail['0'] . '">';
          } ?>
        </div>
        <div class="col-md-11">
           <h1><?php the_title(); ?></h1>
            <?php echo content(23); ?>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <div class="alert alert-error">
      <p><?php _e('Close but no cigar! Din sökning gav ingen träff. Prova skriv något annat eller leta innehåll med menyn.'); ?></p>
    </div>
    <?php endif; ?>
  </div>
</section>


<?php get_footer(); ?>