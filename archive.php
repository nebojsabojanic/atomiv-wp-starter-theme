<?php
/**
 * The template shows Archive Page
 */

get_header(); ?>


            <div class="content blog searchResults">
              <a href="<?php echo bloginfo('url'); ?>/blog" title="">
                 <h1 class="archive">Blog</h1>
               </a>
               <!-- start content -->
               <?php
                  the_archive_title( '<h1 class="archive">', '</h1>' );
                  the_archive_description( '<div class="taxonomy-description">', '</div>' );
                     ?>
               <ul>
                  <?php
                     $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
                     $monthnum = (get_query_var('monthnum')) ? absint(get_query_var('monthnum')) : -1;
                     $year = (get_query_var('year')) ? absint(get_query_var('year')) : -1;
                     
                     $args = array(
                        'post_type'     => array('infopool','post'),
                        'post_per_page' => 10,
                        'paged'         => $paged,
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
                     <span class="date"><?php echo get_the_time('d.m.y') ?></span>
                     <a href="<?php echo get_the_permalink(); ?>"><h3><?php the_title() ?></h3></a>
                     <div class="postContent">
                        <!-- start postContent -->
                        <div class="postExcerpt"><?php the_excerpt(); ?></div>
                        <div class="permalink"><a href="<?php echo get_the_permalink(); ?>">Read More</a></div> <!-- ### ADD READ MORE TEXT HERE-->
                     </div>
                     <!-- end postContent -->
                  </li>
                  <?php
                     }
                     } else {
                     echo 'No matching results found. Please modify your search criteria and try searching again.!';
                     }
                     ?>
                  <div class="pagination">
                     <!-- start pagination-->
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
                  </div><!-- end pagination-->

               </ul>
            </div><!-- end content -->


         <aside>
            <?php dynamic_sidebar( 'blog-sidebar' ); ?>
         </aside><!-- End: Sidebar -->


<?php get_footer();