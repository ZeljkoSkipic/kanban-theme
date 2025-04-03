<section class="hc_contact">
	<div class="hc_contact_inner container">
		<div class="left">
			<h2 class="prefix"><?php echo wp_kses_post( get_field('hc_contact_prefix', 'option') ); ?></h2>
			<h3 class="hc_contact_title"><?php echo wp_kses_post( get_field('hc_contact_title', 'option') ); ?></h2>
			<div class="hc_contact_text">
				<?php echo wp_kses_post( get_field('hc_contact_text', 'option') ); ?>
			</div>
			<?php echo do_shortcode(get_field('hc_form_shortcode', 'option')); ?>
		</div>
		<div class="right">
			<?php
			$hc_contact_image = get_field('hc_contact_image', 'option');
			$size = 'full';
			if( $hc_contact_image ) {
				echo wp_get_attachment_image( $hc_contact_image, $size, "", array( "class" => "hc_contact_image" ) );
			} ?>
		</div>
	</div>
</section>
