<?php


$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'st_block st_carousel_block st_carousel space_1';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container">
		<?php get_template_part('components/intro'); ?>
	</div>
	<div class="main-carousel">
		<?php

		if( have_rows('slides') ): ?>

			<?php while( have_rows('slides') ) : the_row(); ?>
			<div class="carousel-cell">
				<div class="carousel-content">
					<?php
					$slide_title = get_sub_field('slide_title');
					$slide_text = get_sub_field('slide_text');
					$slide_button = get_sub_field('slide_button'); ?>

					<h3 class="title-3"><?php echo $slide_title; ?></h3>
					<?php if( $slide_button ):
						$link_url = $slide_button['url'];
						$link_title = $slide_button['title'];
						$link_target = $slide_button['target'] ? $slide_button['target'] : '_self';
						?>
						<a class="btn-1 slide_button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
					<div class="slide_image">
					<?php
					$slide_background = get_sub_field('slide_image');
					$size = 'full';
					if( $slide_background ) {
						echo wp_get_attachment_image( $slide_background, $size, "", array( "class" => "slide_image" ) );
					} ?>
				</div>
				</div>

			</div>
			<?php endwhile; ?>

		<?php endif; ?>

	</div>

</section>
