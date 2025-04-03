<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'st_block st_pricing space_1';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>

<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container">
		<?php get_template_part('components/intro'); ?>
		<div class="st_pricing_inner">


		<?php

		if( have_rows('pricing_box') ): ?>

			<?php while( have_rows('pricing_box') ) : the_row(); ?>

				<?php
				$price_title = get_sub_field('title');
				$price = get_sub_field('price');
				$best_value = get_sub_field('best_value');
				$free = get_sub_field('free');

				$item_class = '';
				if ( $best_value == 1 ) {
					$item_class .= ' ' . 'best_value';
				}

				if ( $free == 1 ) {
					$item_class .= ' ' . 'free';
				}

				?>
				<div class="pricing_item <?php echo $item_class; ?>">
					<?php if($best_value): ?>
						<div class="best_value">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
						</svg>
							Best Value</div>
					<?php endif; ?>
					<div class="pricing_item_inner">
						<div class="pricing_item_header">
							<h3><?php echo $price_title; ?></h3>
							<span class="item_header_right"></span>

							<p class="price"><?php echo $price; ?></p>
							<?php
							$button = get_sub_field('button');
							if( $button ):
								$link_url = $button['url'];
								$link_title = $button['title'];
								$link_target = $button['target'] ? $button['target'] : '_self';
								?>
								<a class="checkout-btn" href="<?php echo $link_url; ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
						<div class="pricing_item_body">
							<?php

							if( have_rows('features') && $free == 0): ?>
								<ul>
								<?php while( have_rows('features') ) : the_row(); ?>

									<?php
									$feature = get_sub_field('feature'); ?>
									<li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e92eb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><?php echo $feature; ?></li>
								<?php endwhile; ?>
							</ul>
							<?php endif; ?>
							<?php

							if( have_rows('features') && $free == 1): ?>
								<ul>
								<?php while( have_rows('free_features') ) : the_row(); ?>

									<?php
									$feature = get_sub_field('feature'); ?>
									<li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e92eb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><?php echo $feature; ?></li>
								<?php endwhile; ?>
							</ul>
							<?php endif; ?>
						</div>
						<div class="pricing_item_footer">
							<a href="/features" class="features_btn">See all features</a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
		</div>
		<p class="disclaimer">
			*Legacy pricing will be discontinued at January 1st 2026. Members who sign up before the end of the year will be grandfathered in at the current rate.
		</p>
	</div>
</section>
