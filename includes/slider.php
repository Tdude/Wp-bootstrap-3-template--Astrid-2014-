<div id="header" class="col-lg-12 carousel slide animated fadeIn">
	<?php

	// http://isabelcastillo.com/related-custom-post-type-taxonomy
	// get the custom post type's taxonomy terms
	 
	$custom_taxterms = wp_get_object_terms( $post->ID, 'bildspel', array('fields' => 'ids') );

	$args = array(
	'post_type' => 'wpboot_bildspel',
	'post_status' => 'publish',
	'posts_per_page' => 10,
	'orderby' => 'date',
	'order' => 'asc',
	// 'tax_query' => array(
	//     array(
	//         'taxonomy' => 'bildspel',
	//         'field' => 'id',
	//         'terms' => $custom_taxterms
	//     )
	// ),
	'post__not_in' => array ($post->ID),
	);
	$wp_query_carousel = new WP_Query( $args );





	if ($wp_query_carousel->have_posts()) : 
		$carousel_class = '';
	?>
	<div class="carousel-inner"><?php
		while ($wp_query_carousel->have_posts()) : $wp_query_carousel->the_post(); 
		
			
		if ($i < 1) {
			$active = " active";
		} else {
			$active = "";
		}
		$i = $i + 1;
	?>
		
		<div class="item<?php echo $active;?>">
	    <?php

		// GET IMG DATA
		if ( has_post_thumbnail()) {
			$image_attributes_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-small');
		}

		// DISPLAY IMG
		echo '<img class="leftalign" src="' . $image_attributes_array[0] . '" alt="tygbild-'. $i .'" />';

		// CHECK IF PORTRAIT OR PANORAMA IN IMG ARRAY, 0=URL, 1=width, 2=height, THEN ADD ".hidden" TEXT CLASS

		$image_ar_1 = intval($image_attributes_array[1]);
		$image_ar_2 = intval($image_attributes_array[2]);

		// RESET BEFORE NEXT POST
	   	$carousel_class = '';

		if ( $image_ar_1 > $image_ar_2 ) {
			$carousel_class = ' hidden';
		}

		
		?>
			
			<div class="container animated fadeInUp">
				<div class="carousel-caption<?php echo $carousel_class; ?>">
					<h1><?php the_title(); ?></h1>
					<p class="lead"><?php the_excerpt(); ?></p>
					
					<?php
					if ($get_meta = get_post_meta($post->ID, 'wpboot_spiderfood', true)){
						echo '<p class="spiderfood"><strong>', get_post_meta($post->ID, 'wpboot_spiderfood', true), '</strong></p>';
					}
					?>
				</div>
			</div>
	   	</div><?php
		endwhile; ?>
	</div>
	<a class="left carousel-control hidden-phone" href="#header" data-slide="prev"><span class=".glyphicon .glyphicon-circle-arrow-left">&lang;</span></a>
	<a class="right carousel-control hidden-phone" href="#header" data-slide="next"><span class=".glyphicon .glyphicon-circle-arrow-right">&rang;</span></a>
	<div class="carousel-fade"></div>
</div><!-- /.carousel -->
<?php endif;
wp_reset_postdata(); ?>