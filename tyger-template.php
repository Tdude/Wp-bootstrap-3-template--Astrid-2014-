<?php get_header(); 

?>





<section id="services" class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"><?php



				// TYGER OR POSTS SINGLE PAGE CONTENT

				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
   	
						if (get_post_meta ($post->ID, 'wpboot_bgcolor', true)) {
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						} else {
							$bgcolor = '#eee';
						}

						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true); 


						?>


						<article style="background-color:<?php echo $bgcolor; ?>;"><?php

							if ( has_post_thumbnail() ) :
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slider-small' );
								echo '<div class="img-container leftalign">';
								echo '	<img src="' . $image['0'] . '">';
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

				//wp_reset_postdata(); ?>
			</div>
		</div>




		<section id="flipimg" class="flipimg-hover">
			<div class="container">
				<div class="row"><?php


//echo 'The post type is: ' . get_post_type( get_the_ID() );
//echo get_post_type( $post ) ;
	$slug = get_queried_object()->slug;

//$page_id = get_queried_object_id();
//echo 'page_id= ' . $page_id;

$category_id = get_cat_id('naturfiber');
//echo $category_id;


			  		$args = array( 
			  		'post_type' => 'wpboot_tyger',
			  		//'cat' 			=> $category_id,
			  		//'orderby' => 'sort_order',
			  		//'post_parent' => 9,
			  		//'tyger' => $slug,
			  		//'category_name' => 'naturfiber',
			  		//'taxonomy' => 'category',
			  		//'tax_query' => 'category',
			  		'hierarchical' => 1,
			  		'posts_per_page' =>  7,
			  		'exclude' => $page_id,
			  		'orderby' => 'sort_order',
			  		'order' => 'ASC'
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
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
							<div class="card">
								<div class="front face">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
										<img src="<?php echo $thumbnail['0'] ?>">
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
								$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-3' ); ?>
								<div class="card">
									<div class="front face">
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
											<img src="<?php echo $thumbnail['0'] ?>">
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

					<hr>
					Senast skapade:
					<div class="row"><?php



					// NEWS
					$args = array( 
			  		'post_type' => 'wpboot_tyger',
			  		//'category_name' => 'nyheter',
			  		'hierarchical' => 1,
			  		'posts_per_page' => 3,
			  		'orderby' => 'date',
			  		'order' => 'DESC'
			  		);

					$wp_query = null;

					$wp_query = new WP_Query( $args );
					while ($wp_query->have_posts()) : $wp_query->the_post(); 

					?>

					<div class="col-lg-4 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-4"><?php

						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);

							if ( has_post_thumbnail() ) :
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
							<div class="card">
								<div class="front face">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
										<img src="<?php echo $thumbnail['0'] ?>">
									</a>
							  </div>
							  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
				          <h2 class="<?php echo $bigheader ?>"><?php 
				          	the_title(); 		?></h2><?php
				          	the_excerpt();	?>
				        </div>
				      </div><?php
					    
					    else : ?>

				      <div class="card">
							  <div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
				          <h2 class="<?php echo $bigheader ?>"><?php 
				          	the_title();		?></h2><?php
				          	the_excerpt();	?>
				        </div>
				      </div><?php

							endif;		?>

					  </div>
				  </div><?php
					
					endwhile;	?>

					</div>
			  </div>

			</div>
		</section>



<?php get_footer(); ?>