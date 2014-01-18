<?php
/*
 * Template Name: Page News
 * Description: A Page Template with a news listing in flippable images. Ask Linnea!
 */

get_header(); 
?>






	<section id="flipimg" class="flipimg-hover">
		<div class="container">
			<div class="row"><?php












			$args = array( 
			'post_type' => 'wpboot_tyger',
			//'cat' => array( 9, 13, 22 ), 
			//'category_name' => 'nyheter', // only for tyger in only one cat
			'posts_per_page' => 19,
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

				if ($i < 4) :

					?>

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




			 elseif ($i >= 4 && $i < 6) : ?>

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


			 elseif ($i >= 6 && $i < 9) : ?>

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
				

			 elseif ($i >= 9 && $i < 13) : ?>

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



			 elseif ($i >= 13 && $i < 16) : ?>

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
			  </div><?


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

				endwhile; 
				//wp_reset_postdata();

				?>

				</div>
				<div class="pull-right"><?php 
				
					// PAGINATE
					bootstrap_pagination ();

					?>
				</div>
			</div>
		</div>
	</section>







<?php get_footer(); ?>