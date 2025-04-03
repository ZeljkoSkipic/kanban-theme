<?php

$padding = get_field_object('padding');

$class = 'st_block st_help_center';
if ( ! empty( $block['className'] ) ) {
	$class .= ' ' . $block['className'];
}

if ( ! empty( $padding) ) {
	$class .=  ' ' . $padding['value'];
}

?>
<section class="<?php echo $class ?>">
	<div class="container">
	<?php get_template_part('components/intro'); ?>
		<div class="st_help_center_inner">
			<div class="st_hc_col hc_video_1">
				<?php if( have_rows('video_1') ): ?>
					<?php while( have_rows('video_1') ): the_row();
						$VimeoVideoId = get_sub_field('video_1_id');
					?>
					<a href="https://vimeo.com/<?php echo $VimeoVideoId ?>" data-fancybox>
						<figure>
							<?php

							$video_1_image = get_sub_field('video_1_image');
							$size = 'full';
							if( $video_1_image ) {
								echo wp_get_attachment_image( $video_1_image, $size, "", array( "class" => "video_image" ) );
							} ?>
						</figure>
						<div class="hc_video_content">
							<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="32" cy="32" r="32" fill="#1B232F"/> <path d="M40.5 30.634C41.1667 31.0189 41.1667 31.9811 40.5 32.366L27.75 39.7272C27.0833 40.1121 26.25 39.631 26.25 38.8612L26.25 24.1388C26.25 23.369 27.0833 22.8879 27.75 23.2728L40.5 30.634Z" fill="white"/> </svg>
							<time><?php echo wp_kses_post( get_sub_field('video_1_time') ); ?></time>
							<h3><?php echo wp_kses_post( get_sub_field('video_1_title') ); ?></h3>
						</div>
					<?php endwhile; ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="st_hc_col hc_video_2">
				<?php if( have_rows('video_2') ): ?>
					<?php while( have_rows('video_2') ): the_row();
						$VimeoVideoId = get_sub_field('video_2_id');
					?>
					<a href="https://vimeo.com/<?php echo $VimeoVideoId ?>" data-fancybox>
						<figure>
							<?php

							$video_2_image = get_sub_field('video_2_image');
							$size = 'full';
							if( $video_2_image ) {
							echo wp_get_attachment_image( $video_2_image, $size, "", array( "class" => "video_image" ) );
							} ?>
						</figure>

						<div class="hc_video_content">
							<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="32" cy="32" r="32" fill="#1B232F"/> <path d="M40.5 30.634C41.1667 31.0189 41.1667 31.9811 40.5 32.366L27.75 39.7272C27.0833 40.1121 26.25 39.631 26.25 38.8612L26.25 24.1388C26.25 23.369 27.0833 22.8879 27.75 23.2728L40.5 30.634Z" fill="white"/> </svg>
							<time><?php echo wp_kses_post( get_sub_field('video_2_time') ); ?></time>
							<h3><?php echo wp_kses_post( get_sub_field('video_2_title') ); ?></h3>
						</div>
					<?php endwhile; ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="st_hc_col hc_video_faq">
				<?php if( have_rows('faq') ): ?>
					<?php while( have_rows('faq') ): the_row();	?>
						<figure>
							<?php

							$faq_icon = get_sub_field('faq_icon');
							$size = 'full';
							if( $faq_icon ) {
							echo wp_get_attachment_image( $faq_icon, $size, "", array( "class" => "faq_icon" ) );
							} ?>
						</figure>

						<div class="hc_video_content">
							<h3><?php echo wp_kses_post( get_sub_field('faq_title') ); ?></h3>
							<div class="hc_faq_text"><?php echo wp_kses_post( get_sub_field('faq_text') ); ?></div>
							<?php
							$faq_button = get_sub_field('faq_button');
							if( $faq_button ):
								$link_url = $faq_button['url'];
								$link_title = $faq_button['title'];
								$link_target = $faq_button['target'] ? $faq_button['target'] : '_self';
								?>
								<a class="btn-3 faq_button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
