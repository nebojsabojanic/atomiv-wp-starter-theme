<?php
/* The template shows Archive Page */
   
get_header(); ?>


<div class="mainContent">
  
	<div class="desktop">

		<div class="table">

			<div class="gap">

				<div class="content blog searchResults">
					<a href="<?php echo bloginfo('url'); ?>/blog" title="">
						<h1 class="archive">Blog</h1>
					</a>

					<?php
					the_archive_title( '<h1 class="archive">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>

					<ul>

					<?php
						$paged = (get_query_var('page_val') ? get_query_var('page_val') : 1);
						$monthnum = (get_query_var('monthnum')) ? absint(get_query_var('monthnum')) : -1;
						$year = (get_query_var('year')) ? absint(get_query_var('year')) : -1;

						$args = new WP_Query(
							array(
								'post_type'			=> 'post',
								'posts_per_page'	=> 5, /* Number of posts per page */
								'cat'				=> $cat,
								'orderby'			=> 'date',
								'paged'				=> $paged,
								'order'				=> 'DESC'
							)
						);

						if($monthnum != -1 && $year != -1){
							$args["monthnum"] = $monthnum;
							$args["year"] = $year;
						}

						if ($args->have_posts()) {
							while ($args->have_posts()) {
								$args->the_post();
					?>

						<li>
							<span class="date"><?php echo get_the_time('d.m.y') ?></span>
							<a href="<?php echo get_the_permalink(); ?>"><h3><?php the_title() ?></h3></a>
							<div class="postContent">
								<div class="postExcerpt"><?php the_excerpt(); ?></div>
								<div class="permalink"><a href="<?php echo get_the_permalink(); ?>">Read More</a></div> <!-- ### ADD READ MORE TEXT HERE-->
							</div><!-- end postContent -->

						</li>
					<?php
							}// END while
					?>
						<div class="pagination"><!-- start pagination-->
							<?php $big = 999999999; // need an unlikely integer
							echo paginate_links(array(
								'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format' => '/page/%#%',
								'current' => max(1, $paged),
								'prev_text' => __('Previous Page'),
								'next_text' => __('Next Page'),
								'show_all' => true,
								'total' => $args->max_num_pages
							)); 
							?> 
						</div><!-- end pagination-->

					<?php   
					}// END if 
					else {
						echo 'No matching results found. Please modify your search criteria and try searching again.!';
					}
					?>

					</ul>

				</div><!-- end content -->
			
			</div><!-- end gap -->

			<aside>
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside>
		
		</div><!-- end table -->

	</div><!-- end desktop -->
   
</div>
<!-- ##################################################
   PAGE STRUCTURE:= end mainContent
################################################## -->


<?php get_footer();