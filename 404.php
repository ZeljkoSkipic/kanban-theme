<?php
get_header();
?>

<main id="primary" class="site-main">
	<article class="container space_3">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cow404.png">
		<h1>404</h1>
		<h2>Page not found</h2>
		<div class="text404">
			Looks like you got lost
		</div>
		<a href="<?php echo get_home_url(); ?>" class="btn-1">Go Home</a>
	</article>

</main><!-- #main -->

<?php
get_footer();
