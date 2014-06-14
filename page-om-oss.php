<?php
/*
Template Name: Page Om-Oss
*/

get_header(); ?>
<section class="carousel">
	<div class="container">
		<div class="row">
			<div id="header" class="col-md-12 carousel slide animated fadeIn"><?php

			if ($wp_query->have_posts()) : 

				$carousel_class = '';
				?>
				<div class="carousel-inner"><?php
					




// https://github.com/ankitpokhrel/Dynamic-Featured-Image/wiki/API-Functions#getting-image-title-alt-and-caption-attributes
// http://wordpress.org/support/topic/display-caption-with-the_post_thumbnail
// function the_post_thumbnail_caption() {
//   global $post;
// 
//   $thumb_id = get_post_thumbnail_id($post->id);
// 
//   $args = array(
// 	'post_type' => 'attachment',
// 	'post_status' => null,
// 	'post_parent' => $post->ID,
// 	'include'  => $thumb_id
// 	); 
// 
//    $thumbnail_image = get_posts($args);
// 
//    if ($thumbnail_image && isset($thumbnail_image[0])) {
//      //show thumbnail title
//      echo $thumbnail_image[0]->post_title; 
// 
//      //Uncomment to show the thumbnail caption
//      echo 'TEST' . $thumbnail_image[0]->post_excerpt; 
// 
//      //Uncomment to show the thumbnail description
//      //echo $thumbnail_image[0]->post_content; 
// 
//      //Uncomment to show the thumbnail alt field
//      //$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
//      //if(count($alt)) echo $alt;
//   }
// }






				while ($wp_query->have_posts()) : $wp_query->the_post();
					
					$i = 0;
					if ($i < 1) {
						$active = " active";
					} else {
						$active = "";
					}
					$i = ++$i;

					// GET IMG DATA
					if ( has_post_thumbnail()) {
						$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-small');
					}
					
					$image_ar_1 = intval($image_attributes[1]);
					$image_ar_2 = intval($image_attributes[2]);
					$lead_hidetext = ($image_ar_1 / $image_ar_2);
					$calculated_width = (1000 - $image_attributes[1]); 
					// RESET BEFORE NEXT POST
				   	$carousel_class = '';

					if ( $lead_hidetext > 1.4 ) {
						$carousel_class = ' hidden';
					} 


					if ($get_meta = get_post_meta ($post->ID, 'wpboot_bgcolor', true)){
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); 
					}

					?>




					<div class="item<?php echo $active;?>" style="background-color:<?php echo $bgcolor; ?>; overflow:hidden;">
						<div class="animated fadeInUp pull-right">
							<div class="carousel-caption<?php echo $carousel_class; ?>" style="width:<?php echo $calculated_width;?>px">
								<h1><?php the_title(); ?></h1>
								<p class="lead aligncenter"><?php the_content(); ?></p>
							</div>
						</div>

					    <div class="pull-left"><?php
							echo '<img class="pull-left" src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '" alt="image-'. $i .'" />';
						?>
						</div>
			   		</div>

	   		
		    		<?php // PLUGIN https://github.com/ankitpokhrel/Dynamic-Featured-Image/wiki/Retrieving-data-in-a-theme

					if( class_exists('Dynamic_Featured_Image') ) { 

					 	global $dynamic_featured_image;
     					$featured_images = $dynamic_featured_image->get_featured_images( $postId );

				       if( !is_null($featured_images) ){

				           foreach($featured_images as $images) { ?>
				           		<div class="item" style="background-color:<?php echo $bgcolor; ?>; overflow:hidden;">
									<div class="animated fadeInUp pull-right">
										<div class="carousel-caption-xtraimg"><?php

											$title = $dynamic_featured_image -> get_image_title( $images['thumb']); 
											$caption = $dynamic_featured_image -> get_image_caption( $images['thumb']);
											$myimage = $dynamic_featured_image -> get_image_thumb( $images['thumb']); 

											?>
											<h1><?php echo $title; ?></h1>
											<p class="lead aligncenter"><?php echo $caption; ?></p>
										</div>
									</div>
		   							<div class="pull-left"><?php
						               //echo "<a href='" . get_permalink() . "' title = '" . get_image_alt_by_id($images['attachment_id']) . "'>";
						              
						               echo '<img class="pull-left" src="' . $myimage . '" alt="image-xtra" />';
						               //echo "</a>";  ?>
						            </div>
   								</div><?php	
   							}
						}
					} 



				endwhile; ?>
			</div>
			<a class="left carousel-control hidden-phone" href="#header" data-slide="prev"><span class=".glyphicon .glyphicon-circle-arrow-left">&lang;</span></a>
			<a class="right carousel-control hidden-phone" href="#header" data-slide="next"><span class=".glyphicon .glyphicon-circle-arrow-right">&rang;</span></a>
			<div class="carousel-fade"></div>
		</div><!-- /.carousel -->
		<?php endif;
		wp_reset_postdata(); ?>
		</div>
	</div>
</section>


<!-- OM OSS DATA NOW FETCHED FROM PAGES -->
<section id="om-oss">
	<div class="container">
		<div class="row"><?php



	  	if ($wp_query->have_posts()) : 
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

			<div class="col-md-12 container">
				<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div><?php

		endwhile; 
		endif ;

		wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<section id="flipimg" class="flipimg-hover">
	<div class="container">
		<div class="row">
		<?php require('includes/flipimg-tyger.php'); ?>
		</div>
	</div>
</section>


<?php get_footer(); ?>