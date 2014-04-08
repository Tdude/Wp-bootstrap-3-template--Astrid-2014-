<?php get_header(); 


?>
<section id="single-content" class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php



			// TYGER OR POSTS SINGLE PAGE CONTENT
			if ( have_posts() ) : while ( have_posts() ) : the_post();


				if (get_post_meta ($post->ID, 'wpboot_bgcolor', true)) {
					$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
				} else {
					$bgcolor = '#fff';
				}

				$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true); 


				?>
				<article itemscope itemtype="http://schema.org/Product"><?php

					if ( has_post_thumbnail() ) :
						$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'img-big' );
						$calculated_width = (2000 - $image_attributes[1]); 
						echo '<div class="magnify img-container leftalign"  style="background-color:' . $bgcolor .'">';
						echo '	<img data-toggle="magnify" itemprop="image" src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '">';
						echo '</div>';
					endif ; 
								?>
	
					<div class="lead leftalign">
	     	  			<a itemprop="brand" itemscope itemtype="http://schema.org/Brand" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
      						<h2 itemprop="name" class="<?php if ( $bigheader != '') echo $bigheader ;?>"><?php the_title(); ?></h2>
     					</a><?php

     					if (get_post_meta ($post->ID, 'wpboot_artikel', true) || get_post_meta ($post->ID, 'wpboot_ikon', true) ) : ?>
						<div class="col-md-5 col-xs-12 pull-right">
							<div class="infobox">
								<?php include('includes/tyger-infobox.php'); ?>
							</div>
						</div>

     					<div class="row description" itemprop="description">
	          				<div class="col-md-7 col-xs-12"><?php 
	          					the_content(); ?>
	          				</div>
	          			</div><?php

	          			else : ?>
	          		    <div class="row description" itemprop="description">
	          				<div class="col-md-12"><?php 
	          					the_content(); ?>
	          				</div>
	          			</div><?php
	          			endif ; ?>
	        		</div>
	      		</article><?php


			endwhile ;
			endif ; 
			wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>



<section id="xtraimg" class="">
	<div class="container">
		<div class="row"><?php
		// SHOW FOR LOGGED IN USERS
		if ( is_user_logged_in() ) :
			// GET LIST OF RELATED TERM CATS
			$args_temp = array('fields' => 'names');
			$category_terms_array = wp_get_post_terms($post->ID, 'tyger', $args_temp );
			// ADD COMMA BETWEEN DISPLAY ARRAY VALUES
			$parent_ids = implode(",",$category_terms_array);
			echo '<hr><small>(Endast inloggad ser detta) Tyget ovan finns i kategorierna: ' . $parent_ids . '</small><hr>';
		endif;
		?>
		</div>
	</div>
</section>




<section id="flipimg" class="flipimg-hover">
	<div class="container">
		<div class="row">
		<?php


//		// GET LIST OF RELATED TERM CATS
//		$args_temp = array('fields' => 'names');
//		$category_terms_array = wp_get_post_terms($post->ID, 'tyger', $args_temp );
//		// ADD COMMA BETWEEN DISPLAY ARRAY VALUES
//		$parent_ids = implode(",",$category_terms_array);
//

		 // http://isabelcastillo.com/related-custom-post-type-taxonomy
		// get the custom post type's taxonomy terms
		 
		$custom_taxterms = wp_get_object_terms( $post->ID, 'tyger', array('fields' => 'ids') );
		//$parent_ids = implode(",",$custom_taxterms);

		// arguments
		$args = array(
		'post_type' => 'wpboot_tyger',
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'orderby' => 'date',
		'order' => 'asc',
		//'orderby' => 'date',
		'tax_query' => array(
		    array(
		        'taxonomy' => 'tyger',
		        'field' => 'id',
		        'terms' => $custom_taxterms[0]
		    )
		),
		'post__not_in' => array ($post->ID),
		);
		$related_items = new WP_Query( $args );

		// loop over query
		if ($related_items->have_posts()) :

			$i = 0;



			while ( $related_items->have_posts() ) : $related_items->the_post();

			// CHOOSE CORRECT NUMBER OF ITEMS PER ROW
			$i = ++$i;
			
			// CHANGE CONTAINER AND IMG SIZE
			switch ($i):
				case ($i < 4) : 
					// DO col-lg-4 stuff
					$sizes = '4';
					break;
				case ($i >= 4 && $i < 8) :
					$sizes = '3';
					break;
				case ($i >= 8 && $i < 9) : 
					$sizes = '6';
					break;
				default:
					$sizes = '3';
			endswitch;


			?>

			<div class="col-lg-<?php echo $sizes; ?> col-sm-4 col-xs-12">
			    <div class="img-container-hover grid-<?php echo $sizes; ?>"><?php 

			     	$bgcolor = '';
					$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
					$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

					$thumb_grid = 'thumb-grid-' . $sizes;

					if ( has_post_thumbnail() ) :
					$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_grid ); ?>
					<div class="card">
						<div class="front face">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
							<img <?php echo 'src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '"'; ?>>
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