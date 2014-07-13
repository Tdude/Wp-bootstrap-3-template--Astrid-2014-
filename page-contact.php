<?php
/*
 * Template Name: Page Contact
 * Description: A Page Template with a contact form from a plugin and news listing below. Ask Linnea!
 */

get_header(); ?>


<!-- Contact form plugin -->
<section id="maincontent">
	<div class="container">
		<div class="row">
			<div class="col-xs-12"><?php
			// NORMAL QUERY FOR 1 POST
	  		if ( have_posts() ) : while ( have_posts() ) : the_post();
	    		$bgcolor = '';
				$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); ?>

				<div class="contact face" style="background-color:<?php echo $bgcolor; ?>;">
	     			<!-- <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>"><?php the_title(); ?></a> -->
	      			<?php the_content(); ?>
	      		</div><?php

			endwhile; 
			endif;
			wp_reset_postdata(); ?>
	    	</div>
		</div>
	</div>
</section>


<section id="contact" class="flipimg-hover">
	<div class="container">
		<div class="row"><?php


//		if ( is_user_logged_in() ) :
//		echo '[Poster från "Posts", kategori kontakt-post. Man får skriva dessa separat.]';
//	  	endif;

		$args = array(
		'post_type' => 'post',
		'category_name' => 'kontakt-post',
		'post_status' => 'publish',
		'posts_per_page' => 10,
		'order' 		=> 'DESC'
		);
		$wp_query = new WP_Query( $args );


		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			

			<div class="col-md-4 col-xs-12">
				<div class="img-container-hover grid-4"><?php 

					if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>" alt="image" width="<?php echo $thumbnail[1];?>" height="<?php echo $thumbnail[2];?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
				          		<h2 class="little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
				          		<?php the_content();
				          		// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
				        	</div>
			          	</div><?php
					
					else : 

						?>
						<div class="card" style="background-color:<?php echo $bgcolor; ?>;"><?php
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); ?>
						  	<div class="back face-noimg">
					            <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
			            		<?php the_content(); ?>
			          		</div>
			          	</div><?php

					endif; ?>

				</div>
	    	</div><?php



		endwhile; 
		wp_reset_postdata(); ?>
		</div>
	</div>	
</section>



<section id="map" class="">
	<div class="container">
		<div class="row"><?php

		$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'order' 		=> 'DESC'
		);
		$wp_query = new WP_Query( $args );

			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				if (get_post_meta ($post->ID, 'txt_fritext', true)) {
					echo get_post_meta ($post->ID, 'txt_fritext', true);
				} 
			endwhile; 
			endif;
			wp_reset_postdata(); ?>

		</div>
	</div>
</section>


<?php get_footer(); ?>