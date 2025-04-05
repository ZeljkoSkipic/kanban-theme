<?php


$class = 'st_block st_features_list space_1';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
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
<?php get_template_part('components/background'); ?>
	<div class="container">
		<?php get_template_part('components/intro'); ?>
		<?php

		if( have_rows('features') ): ?>
			<ul>
			<?php while( have_rows('features') ) : the_row(); ?>

				<?php
				$feature = get_sub_field('feature'); ?>
				<li>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#06c6a8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
				<?php echo $feature; ?></li>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php get_template_part('components/buttons'); ?>

	</div>
</section>
