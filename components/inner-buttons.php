<?php
$btn1 = get_sub_field('button_1');
$btn2 = get_sub_field('button_2');
$btn3 = get_sub_field('video_button');


if( !empty($btn1 || $btn2 || $btn3 ) ) { ?>

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
	<a class="btn btn-2 btn-icon" href="https://vimeo.com/<?php echo $btn3 ?>" data-fancybox>
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM7.5547 5.16795C7.24784 4.96338 6.8533 4.94431 6.52814 5.11833C6.20298 5.29235 6 5.63121 6 6V10C6 10.3688 6.20298 10.7077 6.52814 10.8817C6.8533 11.0557 7.24784 11.0366 7.5547 10.8321L10.5547 8.83205C10.8329 8.64659 11 8.33435 11 8C11 7.66565 10.8329 7.35342 10.5547 7.16795L7.5547 5.16795Z" fill="#98A2B3"/>
		</svg>
		<span>Watch Video</span>
	</a>
<?php endif; ?>
</div>

<?php }

?>
