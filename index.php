<?php get_header(); 
// INDEX.PHP



	// GET TYGER SLUG FOR
	$slug = get_queried_object()->slug;

	$args = array( 
		'post_type'			=> 'wpboot_tyger',
		'tyger'				=> $slug,
		'paged'				=> $paged,
		'posts_per_page'	=> 17,
		'orderby' 			=> 'date', // rand FOR LIVE SITE (needs all)
		'order' 			=> 'ASC' 
	);
	$wp_query = new WP_Query( $args ); ?>

	<section id="flipimg" class="flipimg-hover">
		<div class="container">
			<div class="row"><?php

			$i = 0;
	    	$bgcolor = '#fafafa';

			while ($wp_query->have_posts()) : $wp_query->the_post(); 
			if ( has_post_thumbnail() ) :

					$i = ++$i;
				if ($i < 5) :

					?>

				<div class="col-lg-3 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-3"><?php
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-3' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
				        		<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
				        		<?php the_excerpt();
								// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
							</div>
						</div>
					</div>
				</div><?php


				elseif ($i >= 5 && $i < 8) : ?>

				<div class="col-lg-4 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-4"><?php 

						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">
			          			<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
			          			<?php the_excerpt();
			          			// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
				        	</div>
				    	</div>
				    </div>
				</div><?php


				elseif ($i >= 8 && $i < 11) : ?>

				<div class="col-lg-6 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-6"><?php 

						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-6' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">	
					        	<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
					          	<?php the_excerpt();
					          	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
					        </div>
					    </div>
					</div>
				</div><?php
					

				elseif ($i >= 11 && $i < 15) : ?>

				<div class="col-lg-3 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-3"><?php

						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-3' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">	
					    		<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
					        	<?php the_excerpt();
					        	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
					        </div>
					    </div>
					</div>
				</div><?php


				elseif ($i >= 15 && $i < 21) : ?>

				<div class="col-lg-4 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-4"><?php

						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">	
					    		<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
					        	<?php the_excerpt();
					        	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
					        </div>
					    </div>
					</div>
				</div><?php


				else : ?>

				<div class="col-lg-4 col-md-6 col-sm-12">
				    <div class="img-container-hover grid-4"><?php

						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);
						$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true);
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
						<div class="card">
							<div class="front face">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
									<img src="<?php echo $thumbnail['0'] ?>">
								</a>
							</div>
							<div class="back-hover face" style="background-color:<?php echo $bgcolor; ?>;"  onclick="location.href='<?php the_permalink(); ?>'" title="Klicka för sidan <?php the_title(); ?>">	
					    		<h2 class="textfill little <?php echo $bigheader ?>"><?php the_title(); ?></h2>
					        	<?php the_excerpt();
					        	// echo get_post_meta ($post->ID, 'txt_fritext', true);	?>
					        </div>
					    </div>
					</div>
				</div><?php


			  	endif; // ROWS FROM $i
				else : // if NOT has_post_thumbnail ?>

				<div class="col-lg-4 col-md-6 col-sm-12">
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
				endwhile; ?>
			</div>
			<div class="pull-right"><?php 
				// PAGINATE
				bootstrap_pagination (); ?>
			</div>
		</div>
	</div>
</section>





<?php get_footer(); ?>