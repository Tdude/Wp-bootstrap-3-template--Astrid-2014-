<?php get_header(); ?>

<section id="services">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
				<h1><?php the_title(); ?></a></h1>

			<div class="col-lg-6">
				<?php
				if ( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-6' ); 
					echo '<img src="' . $thumbnail['0'] . '">';
					$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); 
				} ?>
			</div>
		  <div class="col-lg-6">
		  	<div class="txt-content-wrapper">
		  		<?php the_content(); ?>
		  	</div>
		  </div>
				  
			<?php endwhile; else: ?>
			<div class="alert alert-error">
				<p><?php _e('Sorry, this "page" -page does not exist yet.'); ?></p>
			</div>
			<?php endif; ?>
			
	  </div>
	</div>
</section>









<?php get_footer(); ?>