<?php


get_header();

$term = get_queried_object();
$term_name = single_term_title('', false);
$term_count = $term->count;
?>

<header class="help_articles_hero">
	<div class="container">
		<span class="prefix">Category</span>
		<h1 class="hc_hero_subtitle"><?php echo $term_name; ?></h1>
	</div>
</header>
<?php
if ( have_posts() ) : ?>
	<main class="help_articles_category space_1">
		<div class="help_articles_category_inner">
		<header class="ha_head">
			<div class="left">
				<?php
				$topic_icon = get_field('topic_icon', $term);
				$size = 'full';
				if( $topic_icon ) {
					echo wp_get_attachment_image( $topic_icon, $size, "", array( "class" => "topic_icon" ) );
				} else { ?>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
					</svg>
				<?php } ?>
			</div>
			<div class="mid">
				<h2 class="cat_title"><?php echo $term_name; ?></h2>
			</div>
			<div class="right">
				(<?php echo $term_count; ?>)
			</div>
		</header>
		<?php while ( have_posts() ) :
			the_post();	?>
			<article class="ha_article">
				<h2 class="article_title" id="<?php echo wp_kses_post( get_field('accordion_anchor') ); ?>">
					<a href="<?php echo get_permalink(); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
					</svg>
					<?php the_title(); ?>
				</a>
				</h2>
			</article>

		<?php endwhile; ?>
		</div>
		<aside class="hc_sidebar">
			<h2>All Categories</h2>
		<?php

			// Get all terms in the 'topic' taxonomy
			$terms = get_terms(array(
				'taxonomy' => 'topic',
				'hide_empty' => false,
			));

			// Check if there are any terms in the taxonomy
			if (!is_wp_error($terms) && !empty($terms)) { ?>
				<ul>
				<?php
				foreach ($terms as $term) { ?>
					<li>
					<a href="<?php echo get_term_link($term) ?>">
						<div class="top">
							<?php
								$topic_icon = get_field('topic_icon', $term);
								$size = 'full';
								if( $topic_icon ) {
									echo wp_get_attachment_image( $topic_icon, $size, "", array( "class" => "topic_icon" ) );
							} else { ?>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
								</svg>
							<?php } ?>
						</div>
						<h4 class="bottom">
							<?php echo $term->name; ?>
						</h4>
						</a>
					</li>
				<?php } ?>
				</ul>
		<?php }	?>
		</aside>
	</main>
	<?php // get_template_part('template-parts/inner-contact'); ?>
<?php endif; ?>

<?php get_footer();
