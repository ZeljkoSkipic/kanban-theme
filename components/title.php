<?php

$title = get_field('title');

$heading_tag = 'h2';
$tag = get_field('title_tag');

if ( ! empty( $tag ) ) {
	$heading_tag = $tag['value'];
}

if( $title ) { ?>
<<?php echo $heading_tag ?> class="intro_title"><?php echo $title; ?></<?php echo $heading_tag ?>>
<?php }
