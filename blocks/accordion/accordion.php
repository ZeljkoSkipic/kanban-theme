<?php

$padding = get_field_object('padding');
$layout = get_field_object('layout');

$VimeoVideoId = get_field('vimeo_video_id');

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}


$class = 'st_block st_accordion';
if ( ! empty( $block['className'] ) ) {
	$class .= ' ' . $block['className'];
}
if ( ! empty( $margin ) ) {
	$class .=  ' ' . $margin['value'];
}

if ( ! empty( $padding) ) {
	$class .=  ' ' . $padding['value'];
}

if ( ! empty( $layout ) ) {
    $class .=  ' ' . $layout['value'];
}

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="container">
	<?php get_template_part('components/intro'); ?>
		<div class="st_accordion_inner">
			<div class="left">
				<?php $item=1;?>
				<?php while( have_rows('accordion') ) : the_row();

				$accordion_title = get_sub_field('title');
				$accordion_content = get_sub_field('content');

				if($item == 1 && get_field('first_open') ){

					$open = 'open';
					$display = 'display: block';

					}else{
						$open = '';
						$display = 'display: none';
					}
					?>
					<div class="st_accordion-item <?php echo $open ?>">
						<h3 class="st_accordion-header">
							<?php echo $accordion_title; ?>
						</h3>
						<div class="st_accordion-body" style="<?php echo $display ?>">
							<?php echo $accordion_content; ?>
						</div>
					</div>

				<?php $item++;?>
				<?php endwhile; ?>
			</div>
			<div class="right">
				<figure>
					<?php
						$placeholder_image = get_field('placeholder_image');
						$size = 'full';
						if( $placeholder_image ) {
							echo wp_get_attachment_image( $placeholder_image, $size, "", array( "class" => "placeholder_image" ) );
					} ?>
					<?php if( $VimeoVideoId ) { ?>
						<a href="https://vimeo.com/<?php echo $VimeoVideoId ?>" aria-label="Watch Video" data-fancybox>
							<div class="play-overlay">
								<svg width="228" height="228" viewBox="0 0 228 228" fill="none" xmlns="http://www.w3.org/2000/svg"> 			<g filter="url(#filter0_d_7967_9772)"> 			<circle cx="114" cy="114" r="50" fill="#1B232F"/> 			</g> 			<path d="M128 110.536C130.667 112.075 130.667 115.925 128 117.464L110 127.856C107.333 129.396 104 127.472 104 124.392L104 103.608C104 100.528 107.333 98.604 110 100.144L128 110.536Z" fill="white"/> 			<defs> 			<filter id="filter0_d_7967_9772" x="0" y="0" width="228" height="228" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"> 			<feFlood flood-opacity="0" result="BackgroundImageFix"/> 			<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/> 			<feOffset/> 			<feGaussianBlur stdDeviation="32"/> 			<feComposite in2="hardAlpha" operator="out"/> 			<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.14 0"/> 			<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_7967_9772"/> 			<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_7967_9772" result="shape"/> 			</filter> 			</defs> 		</svg>
							</div>
						</a>
					<?php } ?>
				</figure>
			</div>
		</div>


	</div>
</section>
