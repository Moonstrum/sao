<div class="single-post">
	<div id="sp-featured-image" class="sp-featured-image">
		<div class="sp-ft-img-bg" <?php if ( $id = get_post_thumbnail_id() ) { if ( $src = wp_get_attachment_url( $id ) ) printf( ' style="background-image: url(%s);"', $src );} ?>>
		</div>
	</div>
	<div class="sp-title">
		<div class="sp-entry-header">
			<div class="sp-breadcrumbs">
				<span class="span12"><?php the_category( '&bull;' ); ?></span>
			</div>
			<div class="sp-title-holder">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="sp-byline">
				<span class="post-author"><?php echo the_author_posts_link(); ?></span>
				<span class="post-separator">//</span>
				<span class="post-date"><?php echo the_time(get_option('date_format')); ?></span>
			</div>
		</div>
	</div>
	<div class="sp-wrap">
		<article class="post-<?php post_class();?>">
			<section class="sp-entry">
				<?php the_content(); ?>
			</section>
			<footer class="sp-footer">
				<div class="share-and-tags">

				</div>
				<div class="sp-footer">

				</div>
				<div class="sp-footer">

				</div>
			</footer>
		</article>
		<div class="tags-section">
			<div class="bottom">
				<div class="tag-links">
					<?php
						$post_tags = get_the_tags();
						$post_tags = get_the_tags();

                            if( $post_tags ):

                                foreach( $post_tags as $tags ):

                                    $term_id = $tags->term_id;

                                    $name = $tags->name;

                                    ?>

                                    <a href="<?php echo esc_url( get_tag_link( $term_id ) ); ?>"><?php echo esc_attr( $name ); ?></a>

                                    <?php

                                endforeach;

                            endif;
					 ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php
      the_post_navigation(array(
          'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next:', 'sao') . '</span> ' .
          '<span class="screen-reader-text">' . __('Next post:', 'sao') . '</span> ' .
          '<span class="post-title">%title</span>',
          'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous:', 'sao') . '</span> ' .
          '<span class="screen-reader-text">' . __('Previous post:', 'sao') . '</span> ' .
          '<span class="post-title">%title</span>',
      ));
    ?>
		<?php
      if (comments_open() || get_comments_number()):
        comments_template();
      endif;
    ?>
	</div>
</div>
