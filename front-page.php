<?php
/*
This is the home page with a carousel gallery ONNATOP. Switch case for different image rows and sizes.
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
	  		'posts_per_page' =>  9,
	  		'exclude' => $page_id,
	  		'orderby' => 'rand',
	  		'order' => 'ASC'
	  		);
			$wp_query = new WP_Query( $args );




			$i = 0;

			while ($wp_query->have_posts()) : $wp_query->the_post(); 
				
				$i = ++$i;

				switch ($i):
					case ($i < 4) : 
						// DO col-lg-4 stuff
						$sizes = '4';
						break;
					case ($i >= 4 && $i < 8) :
						$sizes = '3';
						break;
					case ($i >= 8 && $i < 10) : 
						$sizes = '6';
						break;
					default :
					$sizes = '3';
				endswitch;

					?>


				<?php 
				if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){ ?>

				<div class="sr-only"><?php
					echo get_post_meta ($post->ID, 'wpboot_spiderfood', true); ?>
				</div><?php
				} ?>

				<div class="col-lg-<?php echo $sizes; ?> col-sm-4 col-xs-12">
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
			wp_reset_postdata(); ?>

		</div>
	</div>
</section>


<?php get_footer(); ?>