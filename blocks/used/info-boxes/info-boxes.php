<?php
$cols = get_field_object('columns');
$tab_cols = get_field_object('tab_columns');
$mob_cols = get_field_object('mob_columns');

$padding = get_field_object('padding');
$style = get_field_object('style');

$class = 'st_block st_info_boxes';

if ( ! empty( $cols ) ) {
    $class .=  ' ' . $cols['value'];
}
if ( ! empty( $tab_cols ) ) {
    $class .=  ' ' . $tab_cols['value'];
}
if ( ! empty( $mob_cols ) ) {
    $class .=  ' ' . $mob_cols['value'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}
if ( ! empty( $style ) ) {
    $class .=  ' ' . $style['value'];
}

if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>

<section class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="container">
		<?php get_template_part('components/intro'); ?>
		<?php
		$ib_banner = get_field('ib_banner');
		$size = 'full';
		if( $ib_banner ) {
			echo wp_get_attachment_image( $ib_banner, $size, "", array( "class" => "ib_banner" ) );
		} ?>
		<?php $subtitle = get_field('ib_subtitle');

		if($subtitle) { ?>
		<div class="ib_intro_subtitle">
			<?php echo $subtitle; ?>
		</div>
		<?php } ?>

        <div class="st_info_boxes_inner">
        <?php
            // Columns repeater
            if( have_rows('info_boxes') ):

                while( have_rows('info_boxes') ) : the_row();

				$title = get_sub_field('title');
                $text = get_sub_field('text');
				$ib_image = get_sub_field('ib_image');
				$icon = get_sub_field('icon');
                $size = 'full';
				$col_class = 'st_col column';
				if( $icon ) {
					$col_class = 'st_col column svg_image';
				}
				?>
                <div class="<?php echo $col_class; ?>">
					<figure class="ib_image_wrap">
					<?php
					if( $ib_image ) {
						echo wp_get_attachment_image( $ib_image, $size, "", array( "class" => "ib_image" ) );
					} ?>
					<?php if( $icon ) { ?>
						<?php echo $icon; ?>
					<?php } ?>
					</figure>
					<?php if($title) { ?>
                   	<h3 class="st_col_title"><?php echo $title; ?></h3>
					<?php } ?>

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
						<a class="learn_more" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" aria-label="<?php echo $title; ?>">
							<span><?php echo esc_html( $link_title ); ?></span>
							<svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.1667 1.66666L16.5 4.99999M16.5 4.99999L13.1667 8.33332M16.5 4.99999L1.5 4.99999" stroke="#00aeef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>						</a>
					<?php endif; ?>
                </div>
                <?php endwhile;
            endif; ?>
        </div>
	</div>
</section>
