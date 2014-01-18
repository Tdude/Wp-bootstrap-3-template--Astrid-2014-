<?php
/*
This is the home page with a carousel gallery ONNATOP.
*/

get_header(); ?>



<section class="carousel">
	<div class="container">
		<div class="row">
			<?php require('includes/slider.php'); ?>
		</div>
	</div>
</section>




<section id="flipimg" class="flipimg-hover">
	<div class="container">
		<div class="row"><?php




	  		$args = array( 
	  		'post_type' => 'wpboot_tyger',
	  		'hierarchical' => 1,
	  		'posts_per_page' =>  11,
	  		'exclude' => $page_id,
	  		'orderby' => 'rand',
	  		'order' => 'ASC'
	  		);
			$wp_query = new WP_Query( $args );






			$i = 0;

			while ($wp_query->have_posts()) : $wp_query->the_post(); 
				
				$i = ++$i;
				if ($i < 4) : ?>


			<div class="spiderfood"><?php 
				if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){
					echo get_post_meta ($post->ID, 'wpboot_spiderfood', true);
				} ?>
			</div>


			<div class="col-lg-4 col-md-6 col-sm-12">
		    <div class="img-container-hover grid-4"><?php

		     	$bgcolor = '';
				$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
				$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

					if ( has_post_thumbnail() ) :
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
					<div class="card">
						<div class="front face">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
								<img src="<?php echo $thumbnail['0'] ?>">
							</a>
					  </div>
					  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
		          <h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
		          	<?php the_excerpt();
		          	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
		        </div>
		      </div><?php
					endif; ?>
		    </div>
		  </div><?php




			 elseif ($i >= 4 && $i < 8) : ?>

				<div class="col-lg-3 col-md-6 col-sm-12">
			    <div class="img-container-hover grid-3"><?php 

			     	$bgcolor = '';
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

						if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-3' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
						  </div>
						  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
			          <h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
			          	<?php the_excerpt();
			          	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
			        </div>
			      </div><?php
						endif; ?>
			    </div>
			  </div><?php


			 elseif ($i >= 8 && $i < 10) : ?>

				<div class="col-lg-6 col-md-6 col-sm-12">
			    <div class="img-container-hover grid-6"><?php 

			     	$bgcolor = '';
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

						if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-6' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
						  </div>
						  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
			          <h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
			          	<?php the_excerpt();
			          	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
			        </div>
			      </div><?php
						endif; ?>
			    </div>
			  </div><?php



	  		endif;
			endwhile; 
			wp_reset_postdata(); ?>

			</div>
	  </div>

	</div>
</section>








    

   


<?php get_footer(); ?>