<?php

get_header(); ?>

<main class="site-main">
	<header class="help_articles_hero">
		<div class="container">
			<h1 class="prefix">Documentation</h1>
			<h2 class="hc_hero_subtitle"><?php echo wp_kses_post( get_field('hc_archive_subtitle', 'option') ); ?></h2>
		</div>
	</header>
    <section class="help_articles container space_1">
        <h3 class="hc_topics_title"><?php echo wp_kses_post( get_field('topic_title', 'option') ); ?></h3>
        <div class="help_articles_inner">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'topic',
                'hide_empty' => true,
            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) { ?>
					<div class="help_topic">
						<div class="help_topic_top">
							<figure>
								<?php
								$topic_icon = get_field('topic_icon', $term);
								$size = 'full';
								if( $topic_icon ) {
									echo wp_get_attachment_image( $topic_icon, $size, "", array( "class" => "topic_icon" ) );
								} else { ?>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
								</svg>
								<?php }	?>
							</figure>
							<h4 class="topic_title"><?php echo $term->name ?></h4>
						</div>
						<div class="topic_description">
							<?php echo $term->description ?>
						</div>
						<ul class="articles_list">
						<?php
						$query = new WP_Query(array(
							'post_type' => 'docs', // Use the 'article' custom post type
							'tax_query' => array(
								array(
									'taxonomy' => 'topic',
									'field'    => 'term_id',
									'terms'    => $term->term_id,
								),
							),
						));

						if ($query->have_posts()) {
							while ($query->have_posts()) {
								$query->the_post(); ?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
							<?php }
							wp_reset_postdata();
						} else { ?>
							<li>No articles found under this topic.</li>
						<?php } ?>
					</ul>
						</div> <!-- .help_article -->
                <?php }
            }
            ?>
        </div>
		<div class="help_articles_banner">
			<div class="help_articles_banner_inner">
				<p><?php echo wp_kses_post( get_field('small_banner_title', 'option') ); ?></p>
				<a class="btn-3" href="/contact">Contact us</a>
				<?php
				$small_banner_button = get_field('small_banner_button');
				if( $small_banner_button ):
					$link_url = $small_banner_button['url'];
					$link_title = $small_banner_button['title'];
					$link_target = $small_banner_button['target'] ? small_banner_button['target'] : '_self';
					?>
					<a class="btn-3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php // get_template_part('template-parts/inner-contact'); ?>
</main>

<?php get_footer(); ?>
