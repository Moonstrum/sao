
<?php
get_header(); ?>
<?php   $do_not_duplicate = array(); ?>
<div class="blog-posts blog-page">
	<div id="blog-header" class="blog-header">
		<h2>All the thing We Wrote</h2>
	</div>
	<div class="blog-page-search">
		<?php get_search_form();  ?>
	</div>
	<div id="hero">
	    <div class="col one">
	        <?php
	              $the_query = new WP_Query(array(
	              'posts_per_page'   => 1,
							'post_type'        => 'post',
							'order' => 'DESC',));
	              while($the_query->have_posts()) : $the_query->the_post();
	              $do_not_duplicate[] = $post->ID; ?>
								<div class="post-content">
									<a class="inner" target="_blank" href="<?php the_permalink();?>">
										<figure class="post-thumbnail-img">
											<?php if(has_post_thumbnail() ){
							             the_post_thumbnail('medium-width');
							          } else {
							            echo '<img alt="" src="'. get_template_directory_uri() . '/assets/images/defbg.png' .'">';
							          }
							        ?>
										</figure>
										</a>
											<figcaption>
												<div class="post-cat"><?php the_category(', '); ?></div>
												<h2 class="post-title"><a><?php the_title(); ?></a></h2>
												<div class="post-publ-info">
													<a class="author-avatar-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?></a>
													<span class="author-name"><?php _e('By ', 'sao'); ?><a><?php the_author_posts_link(); ?></a></span>
													<span class="separator"> | </span>
													<span class="post-time"><?php the_time('F j, Y'); ?></span>
												</div>
											</figcaption>
							</div>
	              <?php   endwhile; wp_reset_postdata(); ?>
	    </div>
			<div class="col two">
	        <?php
	              $the_query = new WP_Query(array(
	              'posts_per_page'   => 2,
							  'post_type'        => 'post',
						   	'order' => 'DESC',
				    		'post__not_in' => $do_not_duplicate));
	              while($the_query->have_posts()) : $the_query->the_post();
	              $do_not_duplicate[] = $post->ID; ?>
								<article class="post-content">
									<a class="inner" target="_blank" href="<?php the_permalink();?>">
										<figure class="post-thumbnail-img">
											<?php if(has_post_thumbnail() ){
							             the_post_thumbnail('medium-width');
							          } else {
							            echo '<img alt="" src="'. get_template_directory_uri() . '/assets/images/defbg.png' .'">';
							          }
							        ?>
										</figure>
										</a>
											<figcaption>
												<div class="post-cat"><?php the_category(', '); ?></div>
												<h2 class="post-title"><a><?php the_title(); ?></a></h2>
												<div class="post-publ-info">
													<a class="author-avatar-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?></a>
													<span class="author-name"><?php _e('By ', 'sao'); ?><a><?php the_author_posts_link(); ?></a></span>
													<span class="separator"> | </span>
													<span class="post-time"><?php the_time('F j, Y'); ?></span>
												</div>
											</figcaption>
							</article>
	              <?php   endwhile; wp_reset_postdata(); ?>
	    </div>
			<div class="col three">
	        <?php
	              $the_query = new WP_Query(array(
	              'posts_per_page'   => 2,
							  'post_type'        => 'post',
						   	'order' => 'DESC',
				    		'post__not_in' => $do_not_duplicate));
	              while($the_query->have_posts()) : $the_query->the_post();
	              $do_not_duplicate[] = $post->ID; ?>
								<article class="post-content">
									<a class="inner" target="_blank" href="<?php the_permalink();?>">
										<figure class="post-thumbnail-img">
											<?php if(has_post_thumbnail() ){
							             the_post_thumbnail('medium-width');
							          } else {
							            echo '<img alt="" src="'. get_template_directory_uri() . '/assets/images/defbg.png' .'">';
							          }
							        ?>
										</figure>
										</a>
											<figcaption>
												<div class="post-cat"><?php the_category(', '); ?></div>
												<h2 class="post-title"><a><?php the_title(); ?></a></h2>
												<div class="post-publ-info">
													<a class="author-avatar-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?></a>
													<span class="author-name"><?php _e('By ', 'sao'); ?><a><?php the_author_posts_link(); ?></a></span>
													<span class="separator"> | </span>
													<span class="post-time"><?php the_time('F j, Y'); ?></span>
												</div>
											</figcaption>
							</article>
	              <?php   endwhile; wp_reset_postdata(); ?>
	    </div>
	</div>
<div class="older_posts_panel">
	<h1 class="older-posts-header">Older Posts</h1>
	<div id="all-posts" class="all-posts flex-row">
					<?php
								$the_query = new WP_Query(array(
								'posts_per_page'   => -1,
								'post_type'        => 'post',
								'order' => 'DESC',
								'post__not_in' => $do_not_duplicate));
								while($the_query->have_posts()) : $the_query->the_post();
								$do_not_duplicate[] = $post->ID; ?>
								<article class="post-content">
									<a class="inner" href="<?php the_permalink();?>" target="_blank">
										<figure class="post-thumbnail-img">
											<?php if(has_post_thumbnail() ){
							             the_post_thumbnail('medium-width');
							          } else {
							            echo '<img alt="" src="'. get_template_directory_uri() . '/assets/images/defbg.png' .'">';
							          }
							        ?>
										</figure>
										</a>
											<figcaption>
												<div class="post-cat"><?php the_category(', '); ?></div>
												<h2 class="post-title"><a><?php the_title(); ?></a></h2>
												<div class="post-publ-info">
													<a class="author-avatar-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?></a>
													<span class="author-name"><?php _e('By ', 'sao'); ?><a><?php the_author_posts_link(); ?></a></span>
													<span class="separator"> | </span>
													<span class="post-time"><?php the_time('F j, Y'); ?></span>
												</div>
											</figcaption>
							</article>
					<?php   endwhile; wp_reset_postdata(); ?>
	</div>
 </div>
</div>

<?php
get_footer();
