<?php get_header(); ?>

<section id="services">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php
				// GET TYGER SLUG FOR
				$slug = get_queried_object()->slug;
			  	$args = array( 'post_type' => 'wpboot_tyger', 'tyger' => $slug, 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' );
				$wp_query = new WP_Query( $args );


				//$wp_query = new WP_Query('cat=4&showposts=3&order=DESC');
				while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				<div class="col-lg-4 col-md-6 col-sm-12">
			    <div class="img-container-grid-4"><?php 

			     	$bgcolor = '';
						$bgcolor = get_post_meta ($post->ID, 'wpboot_bgcolor', true);

						if ( has_post_thumbnail() ) {
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-grid-4' ); ?>
						<div class="card">
							<div class="front face"><?
								$class = 'back';
								echo '<img src="' . $thumbnail['0'] . '">';
							 ?>
						  </div>
						  <div class="<?php echo $class; ?> face" style="background-color:<?php echo $bgcolor; ?>;">
			          <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent l&auml;nk till - <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
	</div>
</section>

<?php get_footer(); ?>