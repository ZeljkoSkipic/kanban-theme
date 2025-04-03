<?php
$padding = get_field_object('padding');
$btn1 = get_field('button_1');
$btn2 = get_field('button_2');
$btn3 = get_field('video_button');

$class = 'st_block st_home_hero';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

$video_url = get_field('video_button');

?>
<section class="<?php echo $class; ?>">
	<div class="left container">
		<div class="left_inner">
			<?php
			$prefix = get_field('prefix');
			$title = get_field('title');
			$intro_text = get_field('intro_text');
			$style = get_field('intro_style');
			?>
			<div class="st_intro <?php echo $style; ?>">
				<?php if($prefix) { ?>
					<p class="prefix"><?php echo $prefix; ?></p>
				<?php } ?>
				<?php if( $title ) { ?>
				<h1 class="intro_title"><?php echo $title; ?></h1>
				<?php } ?>
				<?php if( $intro_text ) { ?>
				<div class="intro_text">
					<?php echo $intro_text; ?>
				</div>
				<?php } ?>
			</div>

			<div class="btns">
			<?php
				if( $btn1 ):
					$btn1_url = $btn1['url'];
					$btn1_title = $btn1['title'];
					$btn1_target = $btn1['target'] ? $btn1['target'] : '_self';
					?>
					<a class="btn btn-1" href="<?php echo esc_url( $btn1_url ); ?>" target="<?php echo esc_attr( $btn1_target ); ?>"><?php echo esc_html( $btn1_title ); ?></a>
				<?php endif; ?>
				<?php
				if( $btn2 ):
					$btn2_url = $btn2['url'];
					$btn2_title = $btn2['title'];
					$btn2_target = $btn2['target'] ? $btn2['target'] : '_self';
					?>
					<a class="btn btn-2" href="<?php echo esc_url( $btn2_url ); ?>" target="<?php echo esc_attr( $btn2_target ); ?>"><?php echo esc_html( $btn2_title ); ?></a>
				<?php endif; ?>
				<?php
				if( $btn3 ): ?>
					<a class="btn btn-g btn-icon" href="https://vimeo.com/<?php echo $btn3 ?>" data-fancybox>
					<svg height="16" width="16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
							<path d="M460.8,68.452H51.2c-28.16,0-51.2,23.04-51.2,51.2v272.696c0,28.16,23.04,51.2,51.2,51.2h409.6
								c28.16,0,51.2-23.04,51.2-51.2V119.652C512,91.492,488.96,68.452,460.8,68.452z M188.44,359.98V151.108l195.624,104.44
								L188.44,359.98z"></path>
							<polygon style="fill:#FFFFFF;" points="188.44,359.98 384.056,255.548 188.44,151.108 "></polygon>
							</svg>
						<span>Watch Video</span>
					</a>
				<?php endif; ?>
				</div>
			<?php echo wp_kses_post( get_field('additional_content') ); ?>
		</div>
	</div>
	<div class="right">

		<a href="<?php echo $video_url ?>" aria-label="Watch Video" data-fancybox>
			<div class="play-overlay">
			<svg height="800px" width="800px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
				viewBox="0 0 512 512" xml:space="preserve">
			<path d="M460.8,68.452H51.2c-28.16,0-51.2,23.04-51.2,51.2v272.696c0,28.16,23.04,51.2,51.2,51.2h409.6
				c28.16,0,51.2-23.04,51.2-51.2V119.652C512,91.492,488.96,68.452,460.8,68.452z M188.44,359.98V151.108l195.624,104.44
				L188.44,359.98z"/>
			<polygon style="fill:#FFFFFF;" points="188.44,359.98 384.056,255.548 188.44,151.108 "/>
			</svg>
			</div>
			<?php
				$placeholder_image = get_field('placeholder_image');
				$size = 'full';
				if( $placeholder_image ) {
					echo wp_get_attachment_image( $placeholder_image, $size, "", array( "class" => "placeholder_image" ) );
			} ?>
		</a>
	</div>
</section>
