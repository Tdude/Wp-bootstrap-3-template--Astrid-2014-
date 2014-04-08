<?php
/*
 * Template Name: Page News
 * Description: A Page Template with a news listing in flippable images.
 */

get_header(); 




// GET POSTS FROM POST -> NYHETER
$args = array( 
'post_type' => 'post',
//'cat' => array( 9, 13, 22 ), 		// IF YOU NEED MULTIPLE CATEGORIES
'category_name' => 'nyheter-post',	// MORE VERBOSE FOR ONLY ONE CAT
//'posts_per_page' => $this_is_paged,
'orderby' => 'date',
'order' => 'DESC',
'paged'=> $paged 
);
$wp_query = new WP_Query( $args );

$i = 0;

while ($wp_query->have_posts()) : $wp_query->the_post(); 


$i = ++$i;

switch ($i):
	case ($i >= 2 && $i < 4) :
		$sizes = '6';
		break;
	case ($i >= 4 && $i < 7) :
		$sizes = '4';
		break;
	case ($i >= 7 && $i < 11) :
		// DO col-lg-3
		$sizes = '3';
		break;
	default:
		$sizes = '4';
endswitch;




if ($get_meta = get_post_meta ($post->ID, 'wpboot_bgcolor', true)){
	$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); 
}


if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){ 
	echo '<div class="sr-only">' . get_post_meta ($post->ID, 'wpboot_spiderfood', true) . '</div>';
} 

// DISPLAY FIRST POST LARGE ON TOP
if ($i <= 1) : ?>

<section>
	<div class="container">
		<div class="row">
			<article itemscope itemtype="http://schema.org/Product" id="header">
				<div class="col-md-12 carousel-inner">
					<div class="item-active leftalign"><?php

						// GET IMG DATA
						if ( has_post_thumbnail()) {
							$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-small');
						}

							// DISPLAY IMG
							echo '<img class="leftalign" src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '" alt="tygbild-'. $i .'" />';

							// CHECK IF PORTRAIT OR PANORAMA IN IMG ARRAY, 0=URL, 1=width, 2=height, THEN ADD ".hidden" TEXT CLASS

							$image_ar_1 = intval($image_attributes[1]);
							$image_ar_2 = intval($image_attributes[2]);
							$lead_hidetext = ($image_ar_1 / $image_ar_2);
							$calculated_width = (1000 - $image_attributes[1]); 
							// RESET BEFORE NEXT POST
						   	$carousel_class = '';


						if ( $lead_hidetext > 1.4 ) {
							$carousel_class = ' hidden';
						}

						?>
					</div>

					<div class="animated fadeInUp leftalign">
						<div class="carousel-caption<?php echo $carousel_class; ?>" style="width:<?php echo $calculated_width;?>px">
		     	  			<a itemprop="brand" itemscope itemtype="http://schema.org/Brand" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
		  						<h1 itemprop="name" class="<?php if ( $bigheader != '') echo $bigheader ;?>"><?php the_title(); ?></h1>
		 					</a>
		 					<p class="lead aligncenter"><?php the_excerpt(); ?></p>
		        		</div>
	        		</div>
        		</div>
      		</article>
      	</div>
    </div>
</section><?php


// CARRY ON WITH THUMBNAILS
elseif ($i > 1) : 

	// INSERT CODE (INSIDE LOOP) ON NEXT POST
	if ( $i == 2 ) {
		echo '<section id="flipimg" class="flipimg-hover">
				<div class="container">
					<div class="row">';
	}
		?>

      		<article itemscope itemtype="http://schema.org/Product">
				<div class="col-lg-<?php echo $sizes; ?> col-sm-6 col-xs-12">
				    <div class="img-container-hover grid-<?php echo $sizes; ?>"><?php 

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
				</div>
			</article><?php

		// INSERT CODE AFTER LAST POST
		if ($i == $wp_query->post_count) {
				echo '</div>
				</div>
			</section>';
		}
		
	endif; // END $i > 1
endwhile;

wp_reset_postdata(); ?>

<?php

get_footer(); ?>