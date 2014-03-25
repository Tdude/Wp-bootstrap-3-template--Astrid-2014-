<?php get_header(); 

?>



<section id="single-content" class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"><?php




				// TYGER OR POSTS SINGLE PAGE CONTENT

				if ( have_posts() ) : while ( have_posts() ) : the_post();






						if (get_post_meta ($post->ID, 'wpboot_bgcolor', true)) {
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						}

						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true); 


						?>


						<article style="background-color:<?php echo $bgcolor; ?>;"><?php

							if ( has_post_thumbnail() ) :
								$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slider-small' );
								echo '<div class="img-container leftalign">';
								echo '	<img src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '">';
								echo '</div>';
							endif ; 
										?>
							<div class="lead leftalign" style="background-color:<?php echo $bgcolor; ?>;">
			     	  	<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
		      				<h2<?php 
		      				if ( $bigheader != '') {  
		      					echo 'class="' . $bigheader . '"';
		      				}  ?>><?php the_title(); ?></h2>
		     				</a>
			          <?php the_content(); 
			          		// echo get_post_meta ($post->ID, 'txt_fritext', true); ?>
			        </div>
			      </article><?php
				endwhile ;
				endif ; 

				wp_reset_postdata(); ?>
			</div>
		</div>




		<section id="flipimg" class="flipimg-hover">
			<div class="container">
				<div class="row"><?php





						//Returns All Term Items for "my_term_here": 
						// http://codex.wordpress.org/Function_Reference/wp_get_post_terms

						$term_list = wp_get_post_terms($post->ID, 'tyger', array(
							'term_id' => "all"
							));
						
						print_r($term_list);



					$args_temp = array(
						'fields' => 'names'
						);

					$category_term_slug = wp_get_post_terms($post->ID, 'tyger', $args_temp );

					// ADD COMMA BETWEEN AND DISPLAY ARRAY VALUES
					$parent_ids = implode(",",$category_term_slug);
					echo $parent_ids;



					$this_page_id = get_queried_object_id();
					//echo $this_page_id;


					// http://codex.wordpress.org/Function_Reference/get_terms

			  		$args = array( 
			  		'post_type' => 'wpboot_tyger',

			  		'term_group' => array($parent_ids),
			  		//'category__and' => array($parent_ids),
			  		//'tyger' => $slug,
			  		//'category_name' => 'transparenta',
			  		//'taxonomy' => 'transparenta',
			  		//'tax_query' => 'category',
			  		//'cat' => array( '9', '13', '22' ),


			  		//'term_id' 		=>	array($parent_ids),
			  		
			  		//'parent'			=> array($parent_ids),
			  		'exclude'			=> $this_page_id,

			  		'posts_per_page'	=>  11,
			  		'orderby'			=> 'name',
			  		'order'				=> 'asc'
			  		);
					$wp_query = new WP_Query( $args );






					$i = 0;

					while ($wp_query->have_posts()) : $wp_query->the_post(); 
						
						$i = ++$i;
						if ($i < 4) : ?>


					<div class="col-lg-4 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-4"><?php

				     	$bgcolor = '';
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

							if ( has_post_thumbnail() ) :
							$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
							<div class="card">
								<div class="front face">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
										<img <?php echo 'src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '"'; ?>>
									</a>
							  </div>
							  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
				          <h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
				          	<?php the_excerpt();
				          	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
				        </div>
				      </div><?php
							endif; ?>
				    </div>
				  </div><?php




					 else : ?>

						<div class="col-lg-3 col-md-6 col-sm-12">
					    <div class="img-container-hover grid-3"><?php 

					     	$bgcolor = '';
								$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
								$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

								if ( has_post_thumbnail() ) :
								$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-3' ); ?>
								<div class="card">
									<div class="front face">
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
											<img <?php echo 'src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '"'; ?>>
										</a>
								  </div>
								  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
					          <h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
					          	<?php the_excerpt();
					          	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
					        </div>
					      </div><?php
								endif; ?>
					    </div>
					  </div><?php



			  		endif;
					endwhile; 
					wp_reset_postdata(); ?>

					</div>
			  </div>

			</div>
		</section>



<?php get_footer(); ?>