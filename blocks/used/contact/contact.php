<?php

$padding = get_field_object('padding');

$class = 'st_block st_contact';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="st_contact_inner space_0_1">
		<div class="left">
			<?php
			$contact_image = get_field('contact_image');
			$size = 'full';
			if( $contact_image ) {
				echo wp_get_attachment_image( $contact_image, $size, "", array( "class" => "contact_image" ) );
			} ?>
		</div>
		<div class="right">
			<?php get_template_part('components/intro'); ?>
			<?php echo do_shortcode(get_field('form_shortcode')); ?>
		</div>
	</div>
</section>
