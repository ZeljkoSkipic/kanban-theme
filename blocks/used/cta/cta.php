<?php

$padding = get_field_object('padding');
$style = get_field_object('cta_style');

$class = 'st_block st_cta';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

if ( ! empty( $style ) ) {
    $class .=  ' ' . $style['value'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$bg = get_field('has_bg');

if( ! empty( $bg ) ) {
	$class .=  ' ' . "has_bg";
}

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container st_cta_inner">
		<div class="left">
			<img src="/wp-content/uploads/2025/04/kanban-plugin-logo-light.svg" alt="">
			<h2><?php echo wp_kses_post( get_field('cta_block_title', 'option') ); ?></h2>
				<div class="cta_text">
			<?php echo wp_kses_post( get_field('cta_block_text', 'option') ); ?>
			</div>
			<a class="btn-1" href="/pricing">Get Started with Kanban Plugin</a>
		</div>
		<div class="right">

			<?php
			$default_cta_image = get_field('default_cta_image', 'option');
			$image = get_field('image');
			$size = 'full';
			?>
			<figure class="cta_image_wrap">
			<?php if( $image ) {
				echo wp_get_attachment_image( $image, $size, "", array( "class" => "cta_image" ) );
			} else {
				echo wp_get_attachment_image( $default_cta_image, $size, "", array( "class" => "cta_image" ) );
			 } ?>
			</figure>
		</div>
	</div>
</section>
