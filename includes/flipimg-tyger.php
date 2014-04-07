<?php

// SMALLER ONHOVER (FLIP)IMAGE LISTING FROM LATEST UPDATED TYGER CATEGORIES
if ( is_paged() ){
	$this_is_paged = 12;
} else {
	$this_is_paged = 7;
}

$args = array( 
'post_type' => 'wpboot_tyger',
//'cat' => array( 9, 13, 22 ), 
//'category_name' => 'nyheter', // only for tyger in only one cat
'posts_per_page' => $this_is_paged,
'orderby' => 'date',
'order' => 'ASC',
'paged'=> $paged 
);
$wp_query = new WP_Query( $args );


$i = 0;
$bgcolor = '#fff';

while ($wp_query->have_posts()) : $wp_query->the_post(); 
if ( has_post_thumbnail() ) :

$i = ++$i;

switch ($i):
	case ($i < 4) : 
		$sizes = '4';
		break;
	case ($i >= 4 && $i < 8) : 
		$sizes = '3';
		break;
	case ($i >= 8 && $i < 10) : 
		$sizes = '6';
		break;
	default:
		$sizes = '4';
endswitch; ?>



<div class="sr-only"><?php 
	if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){
		echo get_post_meta ($post->ID, 'wpboot_spiderfood', true);
	} ?>
</div>

<article itemscope itemtype="http://schema.org/Product">
	<div class="col-lg-<?php echo $sizes; ?> col-sm-6 col-xs-12 isotope">
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
	</div>
</article><?php


else : // if NOT has_post_thumbnail ?>

<div class="col-md-4 col-xs-12">
	<div class="img-container-hover grid-4"><?php 

		$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
		$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true); ?>
		<div class="card">
			<div class="front face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
		  		<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
      			<?php the_excerpt();
      			// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
    		</div>
  		</div>
	</div>
</div>
<?php


endif; // has_post_thumbnail clause
endwhile; 
wp_reset_postdata(); 



?>
<div class="pull-right"><?php 

	// PAGINATE
	bootstrap_pagination ();

	?>
</div>


