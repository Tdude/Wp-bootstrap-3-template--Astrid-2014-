<div id="header" class="col-md-12 carousel slide animated fadeIn">
	<?php


	// Translator for bildspel taxonomies...ugly as hell, but howdoyoudoit?
	switch ('Which page?'):
		case is_home() : 
			// Home bildspel ID
			$my_term_id = '23';
			break;
		case is_page(2) : 
			// Om oss bildspel ID
			$my_term_id = '27';
			break;
		case is_page(194) : 
			// Nyheter bildspel ID
			$my_term_id = '29';
			break;
		default:
			// Any other page
			$my_term_id = '23';
	endswitch;



	 // http://isabelcastillo.com/related-custom-post-type-taxonomy
	// get the custom post type's taxonomy terms
	 
	$custom_taxterms_ids = wp_get_object_terms( $post->ID, 'bildspel', array('fields' => 'ids') );
	// arguments
	$args = array(
	'post_type' => 'wpboot_bildspel',
	'post_status' => 'publish',
	'posts_per_page' => 12,
	'orderby' => 'date',
	'order' => 'asc',
    'tax_query' => array(
        array(
            'taxonomy' => 'bildspel',
            'terms' => $my_term_id, //$custom_taxterms_ids, // 23 is front-page
            //'field' => 'term_id',
        )
    ),

	'post__not_in' => array ($post->ID),
	);


	$wp_query_carousel = new WP_Query( $args );


	if ($wp_query_carousel->have_posts()) : 
		$carousel_class = '';
	?>
	<div class="carousel-inner"><?php
		while ($wp_query_carousel->have_posts()) : $wp_query_carousel->the_post(); 
		
			//$i = 0;
		if ($i < 1) {
			$active = " active";
		} else {
			$active = "";
		}
		$i = ++$i; 

			// GET IMG DATA
			if ( has_post_thumbnail()) {
				$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'img-big');
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


		?>

		<div class="item<?php echo $active;?>">

			<div class="animated fadeInUp pull-right">
				<div class="carousel-caption<?php echo $carousel_class; ?>" style="width:<?php echo $calculated_width;?>px">
					<h1><?php the_title(); ?></h1>
					<p class="lead aligncenter"><?php the_excerpt(); ?></p>
					
					<?php
					if ($get_meta = get_post_meta($post->ID, 'wpboot_spiderfood', true)){
						echo '<p class="spiderfood"><strong>', get_post_meta($post->ID, 'wpboot_spiderfood', true), '</strong></p>';
					}
					?>
				</div>
			</div>

	    	<div class="pull-left"><?php



			// DISPLAY IMG
			echo '<img class="pull-left" src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '" alt="tygbild-'. $i .'" />';

			// CHECK IF PORTRAIT OR PANORAMA IN IMG ARRAY, 0=URL, 1=width, 2=height, THEN ADD ".hidden" TEXT CLASS


			
			?>
			</div>


	   	</div><?php
		endwhile; ?>
	</div>
	<a class="left carousel-control hidden-phone" href="#header" data-slide="prev"><span class=".glyphicon .glyphicon-circle-arrow-left">&lang;</span></a>
	<a class="right carousel-control hidden-phone" href="#header" data-slide="next"><span class=".glyphicon .glyphicon-circle-arrow-right">&rang;</span></a>
	<div class="carousel-fade"></div>
<?php endif;
wp_reset_postdata(); ?>
</div><!-- /.carousel -->
