<?php

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="docs_article_inner space_1">
				<aside class="docs_article_sidebar">
					<h3>In This Category</h3>
					<ul class="related_docs_list">
						<?php
						// Get the current post's terms in the 'topic' taxonomy
						$terms = wp_get_post_terms(get_the_ID(), 'topic');

						if (!empty($terms) && !is_wp_error($terms)) {
							$term_ids = wp_list_pluck($terms, 'term_id'); // Extract term IDs

							// Query for other 'docs' in the same 'topic'
							$related_docs_query = new WP_Query(array(
								'post_type' => 'docs', // Use the 'docs' custom post type
								'tax_query' => array(
									array(
										'taxonomy' => 'topic',
										'field'    => 'term_id',
										'terms'    => $term_ids,
									),
								),
							));

							if ($related_docs_query->have_posts()) {
								while ($related_docs_query->have_posts()) {
									$related_docs_query->the_post(); ?>
									<li>
										<a href="<?php the_permalink(); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
										</svg>
										<?php the_title(); ?></a>
									</li>
								<?php }
								wp_reset_postdata();
							}
						 } ?>
					</ul>
				</aside>
				<article class="docs_article_main">
					<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
