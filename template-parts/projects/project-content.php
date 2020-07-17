<div class="single-post">
	<div id="sp-featured-image" class="sp-featured-image">
		<div class="sp-ft-img-bg" <?php if ( $id = get_post_thumbnail_id() ) { if ( $src = wp_get_attachment_url( $id ) ) printf( ' style="background-image: url(%s);"', $src );} ?>>
		</div>
	</div>
	<div class="sp-title">
		<div class="sp-entry-header">
			<div class="sp-title-holder">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<div class="sp-wrap">
		<article class="post-<?php post_class();?>">
			<section class="sp-entry">
				<?php the_content(); ?>
			</section>
		</article>
		<div class="gallery-wrapper">
			<div class="project-gallery">
				<div class="gallery-header">
					<h2>View the Gallery</h2>
				</div>
				<?php
					$gallery = get_post_meta($post->ID, 'sao_gallery', true);
					$images = explode(",", $gallery);
					foreach($images as $image){
						?>
						<div class="sp-gallery-image" <?php if ( $src = wp_get_attachment_url( $image ) ) printf( ' style="background-image: url(%s);"', $src );?>>
							<?php  echo wp_get_attachment_link($image, 'large') ?>
						</div>

						<?php
					}
				 ?>
			</div>
		</div>
	</div>
</div>
