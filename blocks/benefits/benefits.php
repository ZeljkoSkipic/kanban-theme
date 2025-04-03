<?php
$padding = get_field_object('padding');
$text_before_boxes = get_field('text_before_boxes');

$class = 'st_block st_benefits';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

?>

<section class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="st_benefits_inner container">
		<div class="left">
			<?php get_template_part('components/intro'); ?>
		</div>
		<div class="right">
			<?php if( $text_before_boxes ): ?>
			<div class="benefits_text_before_boxes">
				<?php echo wp_kses_post( $text_before_boxes ); ?>
			</div>
			<?php endif; ?>
			<?php
			// Columns repeater
			if( have_rows('info_boxes') ):

				while( have_rows('info_boxes') ) : the_row();

				$title = get_sub_field('title');
				$text = get_sub_field('text');
				$icon = get_sub_field('icon');
				$size = 'full'; ?>
				<div class="st_box">
					<?php
					if( $icon ) {
						echo wp_get_attachment_image( $icon, $size, "", array( "class" => "icon" ) );
					} ?>
				<h3 class="st_col_title"><?php echo $title; ?></h3>
					<div class="st_col_text">
						<?php echo $text; ?>
					</div>
					<?php
					$button = get_sub_field('button');
					if( $button ):
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="learn_more" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<span><?php echo esc_html( $link_title ); ?></span>
							<svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.1667 1.66666L16.5 4.99999M16.5 4.99999L13.1667 8.33332M16.5 4.99999L1.5 4.99999" stroke="#1B232F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					<?php endif; ?>
				</div>
				<?php endwhile;
			endif; ?>
        </div>
	</div>
</section>
