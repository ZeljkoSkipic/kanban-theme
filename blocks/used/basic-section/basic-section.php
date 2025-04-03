<?php
$layout = get_field_object('layout');
$stack = get_field_object('stack');

$padding = get_field_object('padding');

$class = 'st_block st_section';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

if ( ! empty( $margin ) ) {
    $class .=  ' ' . $margin['value'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

$sec_in_class = 'st_section_inner container';
if ( ! empty( $layout ) ) {
    $sec_in_class .=  ' ' . $layout['value'];
}
if ( ! empty( $stack ) ) {
    $sec_in_class .=  ' ' . $stack['value'];
}

?>

<section class="<?php echo $class; ?>">
	<?php get_template_part('components/background'); ?>
	<div class="<?php echo $sec_in_class ?>">
		<?php if( have_rows('info_box') ): ?>
		<?php while( have_rows('info_box') ): the_row();
		$prefix = get_sub_field('prefix');
		$title = get_sub_field('title');
		$text = get_sub_field('text'); ?>

		<div class="left">
			<h1 class="prefix"><?php echo $prefix; ?></h1>
			<h2 class="title-2"><?php echo $title; ?></h2>
			<div class="st_section_text"><?php echo $text ?></div>
			<?php get_template_part('components/buttons'); ?>
		</div>

		<?php endwhile; ?>
		<?php endif; ?>
		<div class="right">
			<?php
			$media = get_field('media');
			$size = 'full';
			if( $media ) {
				echo wp_get_attachment_image( $media, $size, "", array( "class" => "media" ) );
			} ?>
		</div>
	</div>
</section>
