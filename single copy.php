<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

get_header();
?>
<?php
while ( have_posts() ) :
the_post(); ?>
<main id="primary" class="site-main">
	<header class="help_articles_hero">
		<div class="container">
			<?php the_title( '<h1 class="hc_hero_subtitle">', '</h1>' ); ?>
		</div>
	</header>
	<article class="post_main container space_1">
		<?php the_content(); ?>
	</article>
</main><!-- #main -->
<?php endwhile; ?>

<?php
get_footer();
