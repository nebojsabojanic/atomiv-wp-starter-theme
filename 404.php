<!-- This is template for error 404 - page is not found -->

<?php get_header();?>


<div class="page-content">


	<div class="grid-1160">

		<div class="page-404">

			<div class="page-404__logo">
				<!-- <a href="<?php echo get_home_url(); ?>" title="Logo"></a> -->
				<?php the_custom_logo(); ?>
			</div>

			<h1>404</h1>
			<h4>Page not found</h4>
			<p>Are you sure you entered the correct address?
			It may be better if you return to the <a href="<?php echo get_home_url(); ?>"title="Home page">home page</a> and click on the content that interests you.</p>

		</div><!-- End: .page-404 -->

	</div><!-- End: .grid-1160 -->


</div>
<!-- ##################################################

################################################## -->            


<?php get_footer();?>