<article class="post-content wow fadeInRight">
  <a class="inner" target="_blank" href="<?php the_permalink();?>">
    <figure class="post-thumbnail-img">
       <?php if(has_post_thumbnail() ){
            the_post_thumbnail('medium-width');
         } else {
           echo '<img alt="post-image" src="'. get_template_directory_uri() . '/assets/images/defbg.png' .'">';
         }
       ?>
    </figure>
    </a>
      <figcaption>
        <div class="post-cat"><?php the_category(', '); ?></div>
        <h2 class="post-title"><a target="_blank" href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
        <div class="post-publ-info">
          <a class="author-avatar-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?></a>
          <span class="author-name"><?php _e('By ', 'sao'); ?><?php the_author_posts_link(); ?></span>
          <span class="separator"> | </span>
          <span class="post-time"><?php the_time('F j, Y'); ?></span>
        </div>
      </figcaption>
</article>
