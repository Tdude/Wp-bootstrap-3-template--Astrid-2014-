<?php
/*
 * Template Name: Page Contact
 * Description: A Page Template with a contact form from a plugin and news listing below. Ask Linnea!
 */

get_header(); ?>



	<!-- Contact form plugin -->
	<section id="maincontent">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
		  		<?php
		
		  		if ( have_posts() ) : while ( have_posts() ) : the_post();
		    		$bgcolor = '';
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); ?>

					<div class="contact face" style="background-color:<?php echo $bgcolor; ?>;">
		     		<!--
		     		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
		      		<?php the_title(); ?></a>
		      		-->
		      	<?php the_content(); ?>
		      </div>
		    </div>
		  </div>
	  </div>
	</section>
	<?php
			endwhile; 
			endif;
			wp_reset_postdata(); ?>
		




<!-- Latest work thumbs with flipstuff -->
<section id="flipimg">
	<div class="container">
		<div class="row">

		<?php if ( is_user_logged_in() ) : ?>
		[Poster från "Posts", kategori kontakt-post. Man får skriva dessa separat.]
	  	<?php endif;
	  	
	  	
	  	$wp_query = new WP_Query('category_name=kontakt-post&posts_per_page=3&order=DESC');
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<div class="col-lg-4 col-md-6 col-sm-12">
	      <div class="img-container-grid-4"><?php 
				if ( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
					<div class="card">
						<div class="front face"><?
							$class = 'back';
							echo '<img src="' . $thumbnail['0'] . '">';
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); ?>
				  	</div>
				  	<div class="<?php echo $class; ?> face" style="background-color:<?php echo $bgcolor; ?>;">
	            <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
	            <?php the_content(); ?>
	          </div>
	        </div><?php
				} else { ?>
					<div class="lead" style="background-color:<?php echo $bgcolor; ?>;">
	          <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>"><h2 class="big-block"><?php the_title(); ?></h2></a>
	          <?php the_content(); ?>
	        </div><?php
				} ?>
	      </div>
	    </div><?php
			endwhile; 
			wp_reset_postdata(); ?>
		</div>
	</div>	
</section>


<?php
$args = array( 
'post_type' => 'wpboot_tyger',
'posts_per_page' => 19,
'orderby' => 'date',
'order' => 'ASC',
'paged'=> $paged 
);
$wp_query = new WP_Query( $args ); ?>






	<section id="flipimg" class="flipimg-hover">
		<div class="container">
			<div class="row">
			<?php if ( is_user_logged_in() ) : ?>
				[Poster från senast inlagda tygkategorier. Hur ska det vara?]
			<?php endif;



			$i = 0;
	    	$bgcolor = '#fafafa';

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