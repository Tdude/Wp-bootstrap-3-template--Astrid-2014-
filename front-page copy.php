<?php
/*
This is the home page with a carousel gallery ONNATOP.
*/

get_header(); ?>

<div class="spiderfood"><?php 
	if ($get_meta = get_post_meta ($post->ID, 'wpboot_spiderfood', true)){
		echo get_post_meta ($post->ID, 'wpboot_spiderfood', true);
	} ?></div>

<section class="carousel">
	<div class="container">
		<div class="row">
			<div id="header" class="col-lg-12 carousel slide animated fadeIn">
				<?php		
				// QUERY BILDSPEL. SEE FUNCTIONS.PHP

				$temp = $wp_query;
				$wp_query= null;
				$i = 0;

				query_posts( 'wpboot_bildspel');
				if ($wp_query->have_posts()) : 
				?>
				<div class="carousel-inner"><?php
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					
						
					if ($i < 1) {
						$active = " active";
					} else {
						$active = "";
					}
					$i = $i + 1;
				?>
					
					<div class="item<?php echo $active;?>">
				    <?php
					if ($get_meta = get_post_meta($post->ID, 'wpboot_img', true)){
						echo '<img src="', get_post_meta($post->ID, 'wpboot_img', true), '" alt="img-'. $i .'" />';
					} ?>
						
						<div class="container animated fadeInUp">
							<div class="carousel-caption">
								<h1><?php the_title(); ?></h1>
								<p class="lead"><?php
								if ($get_meta = get_post_meta ($post->ID, 'wpboot_text', true)){
									echo get_post_meta ($post->ID, 'wpboot_text', true);
								} ?></p>
								
								<?php
								if ($get_meta = get_post_meta($post->ID, 'wpboot_spiderfood', true)){
									echo '<p class="hidden"><strong>', get_post_meta($post->ID, 'wpboot_spiderfood', true), '</strong></p>';
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
			$wp_query = null; 
			$wp_query = $temp;	?>

		</div>
	</div>
</section>


<!-- Latest updates/news thumbs from a cat with flip imgs -->
<section id="flipimg">
	<div class="container">
		<div class="row">
	  	<?php
			$wp_query = new WP_Query('cat=4&showposts=3&order=DESC');
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div class="col-lg-4 col-md-6 col-sm-12">
	      <div class="img-container-grid-4"><?php 
				if ( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
					<div class="card">
						<div class="front face"><?
							$class = 'back';
							echo '<img src="' . $thumbnail['0'] . '">';
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); 
							$bigheader = get_post_meta($post->ID, 'wpboot_bigblock', true); ?>
				  	</div>
				  	<div class="<?php echo $class; ?> face" style="background-color:<?php echo $bgcolor; ?>;">
          		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
          			<h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
          		</a>
	            <?php the_content(); ?>
	          </div>
	        </div><?php
				} else { ?>
					<div class="lead" style="background-color:<?php echo $bgcolor; ?>;">
      			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
      				<h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
      			</a>
	          <?php the_content(); ?>
	        </div><?php
				} ?>
	      </div>
	    </div><?php
			endwhile; 
			wp_reset_postdata(); ?>
		</div>


		<div class="row"><?php
			$wp_query = new WP_Query('cat=3&showposts=4&order=DESC');
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
	      <div class="img-container-grid-3"><?php 
				if ( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-3' ); ?>
					<div class="card">
						<div class="front face"><?
							$class = 'back';
							echo '<img src="' . $thumbnail['0'] . '">';
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); ?>
				  	</div>
				  	<div class="<?php echo $class; ?> face" style="background-color:<?php echo $bgcolor; ?>;">
	          	<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
	           		<h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
	           	</a>
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



		<div class="row"><?php
		$wp_query = new WP_Query('cat=5&showposts=2&order=DESC');
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
     	<div class="col-lg-6 col-sm-12">
	      <div class="img-container-grid-6"><?php 
				if ( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-6' ); ?>
					<div class="card">
						<div class="front face"><?
							$class = 'back';
							echo '<img src="' . $thumbnail['0'] . '">';
							$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true); ?>
				  	</div>
				  	<div class="<?php echo $class; ?> face" style="background-color:<?php echo $bgcolor; ?>;">
	         	  <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
	         			<h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
	           	</a>
	            <?php the_content(); ?>
	          </div>
	        </div><?php
				} else { ?>
					<div class="lead" style="background-color:<?php echo $bgcolor; ?>;">
	       	  <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>">
	      			<h2 class="<?php echo $bigheader ?>"><?php the_title(); ?></h2>
         		</a>
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









    

   


<?php get_footer(); ?>