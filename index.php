<?php
// INDEX.PHP SIDA FOR TYGERS HUVUDKATEGORIER

get_header(); 


?>


<section id="xtraimg" class="">
	<div class="container">
		<div class="row"><?php
		// SHOW FOR LOGGED IN USERS
		if ( is_user_logged_in() ) :
			// GET LIST OF RELATED TERM CATS
			$category_terms_array = wp_get_post_terms($post->ID, 'tyger', array('fields' => 'names') );
			// ADD COMMA BETWEEN ARRAY VALUES
			$parent_ids = implode(", ",$category_terms_array);
			//$parent_ids = $category_terms_array [0];
			echo '<hr><small>(Endast inloggad ser detta) Tyger från kategorierna: ' . $parent_ids . '</small><hr>';
			//echo '<hr><small>Tyger från kategorierna: ' . $parent_ids . '</small><hr>';
			wp_reset_postdata();
		endif; // END USER LOGGED IN

		?>
		</div>
	</div>
</section>




<section id="flipimg" class="flipimg-hover">
	<div class="container">
		<div class="row"><?php

		 // http://isabelcastillo.com/related-custom-post-type-taxonomy
		// get the custom post type's taxonomy terms
		 
		$custom_taxterms = wp_get_object_terms( $post->ID, 'tyger', array('fields' => 'ids') );
		
		//$parent_ids = implode(",",$custom_taxterms);
		//echo $parent_ids;
		// arguments






		// GET TYGER SLUG FOR
		$slug = get_queried_object()->slug;

		$args = array( 
			'post_type'			=> 'wpboot_tyger',
			'tyger'				=> $slug,
			'paged'				=> $paged,
			'posts_per_page'	=> -1,
			'orderby' 			=> 'date', // rand FOR LIVE SITE (needs all)
			'order' 			=> 'ASC' 
		);
		$related_items = new WP_Query( $args ); 


		// loop over query
		if ($related_items->have_posts()) :

			$i = 0;

			while ( $related_items->have_posts() ) : $related_items->the_post();

			// CHOOSE CORRECT NUMBER OF ITEMS PER ROW. THEY ARE FLOATED LEFT, SO YOU CAN CREATE SOME INTERESTING RESULTS.
			$i = ++$i;
			
			// CHANGE CONTAINER AND IMG SIZES
			switch ($i):
				case ($i < 9) : 
					// DO col-md-x stuff
					$sizes = '3';
					break;
				case ($i >= 9 && $i < 12) :
					$sizes = '4';
					break;
				case ($i >= 12 && $i < 13) : 
					$sizes = '6';
					break;
				case ($i >= 13 && $i < 16) : 
					$sizes = '3';
					break;
				default:
					$sizes = '3';
			endswitch;




					?>


				<div class="sr-only"><?php 
					if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){
						echo get_post_meta ($post->ID, 'wpboot_spiderfood', true);
					} ?>
				</div>


				<div class="col-lg-<?php echo $sizes; ?> col-sm-6 col-xs-12">
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
			endif;
			wp_reset_postdata(); ?>

		</div>
	</div>
</section>



<?php get_footer(); ?>