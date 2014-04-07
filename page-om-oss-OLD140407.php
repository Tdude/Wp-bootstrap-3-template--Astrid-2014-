<?php
/*
Template Name: Page Om-Oss
*/

get_header(); ?>




<section class="carousel om-oss">
	<div class="container">
		<div class="row">
			<?php require('includes/slider.php'); ?>
		</div>
	</div>
</section>




<!-- OM OSS CATEGORY FETCHED FROM POSTS, NOT PAGES -->
<section id="om-oss">
	<div class="container">
		<div class="row"><?php

		if ( is_user_logged_in() ) : ?>
			[Inlägg här skapas i "posts" i kategorin om oss]<?php
		endif;

		$args = array( 
		'post_type' => 'posts', 
		'category_name' => 'om-oss-post', // only for tyger in only one cat
		'orderby' => 'date',
		'order' => 'ASC'
		);
		$wp_query = new WP_Query( $args );



	  	if ($wp_query->have_posts()) : 
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

				
				

				<div class="sr-only"><?php 
					if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){
						echo get_post_meta ($post->ID, 'wpboot_spiderfood', true);
					} ?>
				</div>


				<div class="col-md-4 col-xs-12">
				    <div class="img-container-hover grid-<?php echo $sizes; ?>"><?php 

				     	$bgcolor = '';
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

						$thumb_grid = 'thumb-grid-' . $sizes;

						if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_grid ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>" alt="image" width="<?php echo $thumbnail[1];?>" height="<?php echo $thumbnail[2];?>">
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



		endwhile; 
		endif ;

		wp_reset_postdata(); ?>
		</div>
	</div>
</section>




<section id="flipimg" class="flipimg-hover">
	<div class="container">
		<div class="row" id="isotope-container">
		<?php require('includes/flipimg-tyger.php'); ?>
		</div>
	</div>
</section>




<?php get_footer(); ?>