<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

$post_id = get_the_ID();
$reading_time_text = get_reading_time_text($post_id);
$terms = get_the_category();

get_header();
?>
<main id="primary" class="content-wrap">
	<article>
		<header class="post_intro space_4_0">


			<div class="c-blog post_intro_inner">
			<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

			<div class="grid_post_meta">
				<div class="post_cats">
					<?php
					if($terms) :
					foreach ($terms as $term) { ?>
						<div class="post_cat"><?php echo $term->name; ?></div>
					<?php }
					endif; ?>
				</div>
				<span class="read_time"><?php echo $reading_time_text; ?></span>
			</div>

				<div class="left">
				<?php the_title( '<h1>', '</h1>' ); ?>

					<time datetime="<?php echo get_the_date( 'Y-m-d G:i:s' ); ?>"><span>Published:</span> <?php echo get_the_date(); ?></time>

				</div>
				<div class="right">
					<?php the_post_thumbnail('post-featured', [ 'alt' => esc_attr( get_the_title() ), 'title' => '' ]); ?>
				</div>
			</div>
		</header>
		<div class="post_main c-blog space_0_1">
			<div class="post_content">
				<?php
				while ( have_posts() ) :
				the_post();
				the_content(); ?>
				<?php the_post_navigation(
				array(
					'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"></circle></svg><span class="nav-subtitle" title="%title">' . esc_html__( 'Previous Post', 'stier' ) . '</span>',
					'next_text' => '<span class="nav-subtitle" title="%title">' . esc_html__( 'Next Post', 'stier' ) . '</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg>',
				)
				); ?>
			</div>
				<!--<aside class="post_sidebar">
			 <h3 class="t_space_3">Need <b-3>assistance</b-3>?</h3>
				<p>Send us a message if you have a question or need a consultation.</p>
				<?php // echo do_shortcode('[wpforms id="1645"]'); ?> -->
			</aside>
		</div>
		<?php endwhile; // End of the loop.
		?>
	</article>
	<div class="cta_track_wrap">
		<div class="cta_track c-wide">
			<div class="cta_track_content c-narrow">
				<h3 class="title-4"><?php echo get_field('cta_title', 'option'); ?></h3>
				<?php
				$cta_button = get_field('cta_button', 'option');
				if( $cta_button ):
					$cta_button_url = $cta_button['url'];
					$cta_button_title = $cta_button['title'];
					$cta_button_target = $cta_button['target'] ? $cta_button['target'] : '_self';
					?>
					<a class="btn-1" href="<?php echo esc_url( $cta_button_url ); ?>" target="<?php echo esc_attr( $cta_button_target ); ?>"><?php echo esc_html( $cta_button_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php get_template_part('template-parts/related-posts'); ?>
</main><!-- #main -->

<?php
get_footer();
