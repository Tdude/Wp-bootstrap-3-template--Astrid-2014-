<?php
/*
Template Name: Page Om-Oss
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
				// QUERY POST BILDSPEL. SEE FUNCTIONS.PHP

				$temp = $wp_query;
				$wp_query = null;
				$i = 0;

				//$queried_object = get_queried_object();
				//$term_id = $queried_object->term_id;

				$term = get_term( $term_id, $taxonomy );
				$slug = $term->slug;


				$args = array( 
					'post_type' => 'wpboot_bildspel',
					'bildspel' => $slug,
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'ASC'
					);
				$wp_query = new WP_Query( $args );



				//query_posts( 'wpboot_bildspel');
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
				<a class="left carousel-control hidden-phone" href="#header" data-slide="prev"><i class=".glyphicon .glyphicon-circle-arrow-left"></i></a>
				<a class="right carousel-control hidden-phone" href="#header" data-slide="next"><i class=".glyphicon .glyphicon-circle-arrow-right"></i></a>
				<div class="carousel-fade"></div>
			</div><!-- /.carousel -->
			<?php endif;
			wp_reset_postdata();
			$wp_query = null; 
			$wp_query = $temp;	

			?>

		</div>
	</div>
</section>





<!-- Latest work thumbs with flipstuff -->
<section id="flipimg">
	<div class="container">
		<div class="row">
		<?php if ( is_user_logged_in() ) : ?>
			[Inlägg här skapas i "posts" i kategorin om oss]
	  	<?php endif;
	  	



	  	
	  	$wp_query = new WP_Query('category_name=om-oss-post&posts_per_page=6&order=DESC');

	  	if ($wp_query->have_posts()) : 
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div class="col-lg-4 col-md-6 col-sm-12">
	      <div class="img-container-grid-4"><?php 
				if ( has_post_thumbnail() ) :
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
				else : ?>
					<div class="lead" style="background-color:<?php echo $bgcolor; ?>;">
	          <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>"><h2 class="big-block"><?php the_title(); ?></h2></a>
	          <?php the_content(); ?>
	        </div><?php
				endif; ?>
	      </div>
	    </div><?php
			endwhile; 
			endif ;

			wp_reset_postdata(); ?>
		</div>
	</div>
</section>




<?php get_footer(); ?>