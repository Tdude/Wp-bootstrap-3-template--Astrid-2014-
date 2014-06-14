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

<section id="flipimg-large" class="flipimg-hover">
	<div class="container">
		<div class="row">


      		<article itemscope itemtype="http://schema.org/Product">
				<div class="col-lg-12">
				    <div class="img-container-hover grid-<?php echo $sizes; ?>"><?php 

						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumb_grid = 'slider-small';

						if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_grid ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail[0] ?>" alt="image" width="<?php echo $thumbnail[1];?>" height="<?php echo $thumbnail[2];?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
				          		<h2 class="textfill <?php echo $bigheader ?>"><?php the_title(); ?></h2>
				          		<?php the_excerpt();
				          		// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
				        	</div>
				    	</div><?php
						endif; ?>
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
									<img src="<?php echo $thumbnail[0] ?>" alt="image" width="<?php echo $thumbnail[1];?>" height="<?php echo $thumbnail[2];?>">
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