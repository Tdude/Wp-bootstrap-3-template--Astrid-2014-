<?php 
// SINGLE.PHP

get_header();
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
						$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slider-small' );
						echo '<div class="img-container"  style="background-color:' . $bgcolor .'">';
						echo '	<img itemprop="image" src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '">';
						echo '</div>';
					endif ; 
								?>
	
					<div class="lead">
	     	  			<a itemprop="brand" itemscope itemtype="http://schema.org/Brand" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
      						<h2 itemprop="name" class="<?php if ( $bigheader != '') echo $bigheader ;?>"><?php the_title(); ?></h2>
     					</a>
     					
     					<div class="row description" itemprop="description">
	          				<div class="col-md-12"><?php 
	          					the_content(); ?>
	          				</div>
	          			</div>
	        		</div>
	      		</article><?php


			endwhile ;
			endif ; 
			wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>