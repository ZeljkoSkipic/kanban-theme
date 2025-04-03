<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'st_block st_about_hero space_2_4';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container">
		<?php get_template_part('components/intro'); ?>
	</div>
</section>
