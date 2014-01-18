<?php get_header(); ?>

<section id="services">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"> 
				<div class="page-header text-center">
					<h1 class="big-block"> 404 = Lite pinsamt</h1>
		  	</div>
		  	<div class="well">	
					<div class="alert alert-error">
						<p>Det finns inget inneh&aring;ll p&aring; denna sida. </p>
						<p>Prova <a href="<?php echo site_url();  ?>">förstasidan</a> eller en sökning här nedan!</p>
								<?php get_search_form(); ?>
						<p>Your are on a 404 page. Nothing to see here.</p>
						<p>Please try our <a href="<?php echo site_url();  ?>">Homepage</a> or get wild and search for content!</p>
					</div>
				</div>
			</div>
	  </div>
	</div>
</section>

<?php get_footer(); ?>