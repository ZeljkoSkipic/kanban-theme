<?php
$title = get_the_title();
$image = get_the_post_thumbnail(get_the_id(), 'large');
$terms = get_the_category();
$post_id = get_the_ID();
$reading_time_text = get_reading_time_text($post_id);

?>

<div class="grid_post">
    <figure class="grid_post_image">
        <?php if ($image) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php echo $image; ?>
            </a>
        <?php endif; ?>
	</figure>

	<div class="grid_post_content">
		<?php if ($title) : ?>
			<h2 class="grid_post_title">
				<a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
			</h2>
		<?php endif; ?>
		<div class="grid_post_meta">
			<time><?php echo get_the_date(); ?></time>
			<?php
			if($terms) :
			foreach ($terms as $term) { ?>
				<div class="post_cat"><?php echo $term->name; ?></div>
			<?php }
			endif; ?>
			<span class="read_time"><?php echo $reading_time_text; ?></span>
		</div>

		<div class="grid_post_excerpt">
		<?php
			if (has_excerpt()) {
				echo wp_strip_all_tags(get_the_excerpt());
			} else {
				echo wp_trim_words(wp_strip_all_tags(get_the_content()), 16, '...');
			}
		?>
		</div>
		<a class="arrow-link" href="<?php the_permalink(); ?>">Read More<svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.1667 1.66666L16.5 4.99999M16.5 4.99999L13.1667 8.33332M16.5 4.99999L1.5 4.99999" stroke="#00aeef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>

	</div>
</div>
