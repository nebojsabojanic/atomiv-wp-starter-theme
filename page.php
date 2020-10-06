<!-- Tepmlate which displays every Page -->

<?php get_header();?>

<?php if ( have_posts() ) : ?>

  <?php while ( have_posts() ) : the_post(); ?>


		<div class="page-content">

			<div class="grid-1280">

				<?php the_content(); ?>

			</div><!-- end grid-1280 -->

		</div>
		<!-- ##################################################
			End: .page-content
		################################################## -->


  <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();?>