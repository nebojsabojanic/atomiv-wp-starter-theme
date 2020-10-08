<!-- Blog page -->

<?php get_header(); ?>


	<div class="a__content a__content--blog">

		<h1 class="a__title"><?php the_title(); ?></h1>

		<?php
			// Title of the category
			the_archive_title( '<h1 class="archive">', '</h1>' );
			// Post category description
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
		<ul>
			<?php
			$paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
			$monthnum = (get_query_var('monthnum')) ? absint(get_query_var('monthnum')) : -1;
			$year = (get_query_var('year')) ? absint(get_query_var('year')) : -1;

			$args = array(
				'post_type'			=> 'post',
				'posts_per_page'	=> 10,
				'paged'				=> $paged,
			);
			if($monthnum != -1 && $year != -1){
				$args["monthnum"] = $monthnum;
				$args["year"] = $year;
			}
			$posts = new WP_Query($args);
			if ($posts->have_posts()) {
				while ($posts->have_posts()) {
					$posts->the_post();
			?>

			<li>
				<a href="<?php echo get_the_permalink(); ?>">

					<span class="datePost"><?php echo get_the_time('d.m.y') ?></span>
					<h3><?php the_title() ?></h3>
					<div class="postContent">

						<?php if( get_field('postthumb') ): ?>
							<div class="postThumb">
								<img alt="" title="" src="<?php the_field('postthumb'); ?>">
							</div>
						<?php endif; ?>

						<div class="postExcerpt"><?php echo get_field('excerpt'); ?></div>

					</div><!-- End: postContent -->

				</a>
				<div class="permalink blogStart">
					<a href="<?php echo get_the_permalink(); ?>">Weiterlesen</a>
				</div>
			</li>

			<?php
				} // End: while
			} else {
				echo 'No matching results found. Please modify your search criteria and try searching again.!';
			}
			?>
		</ul>


		<div class="pagination">
			<?php $big = 999999999; // need an unlikely integer
			echo paginate_links(array(
			'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'    => '?paged=%#%',
			'current'   => max(1, get_query_var('paged')),
			'total'     => $posts->max_num_pages,
			'mid_size'  => 1,
			'prev_text' => "<",
			'next_text' => ">"
			)); ?>
		</div><!-- End: pagination-->

	</div><!-- End: content -->

	<aside>
		<?php dynamic_sidebar( 'blog-sidebar' ); ?>
	</aside>


<?php get_footer();
