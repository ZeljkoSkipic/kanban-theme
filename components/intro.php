<?php
$prefix = get_field('prefix');
$intro_text = get_field('intro_text');
$style = get_field('intro_style');
?>

<div class="st_intro <?php echo $style; ?>">
	<?php if($prefix) { ?>
		<p class="prefix"><?php echo $prefix; ?></p>
	<?php } ?>
	<?php get_template_part('components/title');
	if( $intro_text ) { ?>
	<div class="intro_text">
		<?php echo $intro_text; ?>
	</div>
	<?php } ?>

</div>
