<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s-tier
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer_main">
			<div class="container">
				<div class="footer_logo">
					<?php
						$footer_logo = get_field('footer_logo', 'option');
						$size = 'full';
						if( $footer_logo ) {
						echo wp_get_attachment_image( $footer_logo, $size, "", array( "class" => "footer_logo" ) );
					} ?>
				</div>
				<div class="footer_menu">
					<h3 class="footer_menu_title">Useful Links</h3>
					<?php
						wp_nav_menu(
						array(
							'theme_location' => 'footer_nav',
						)
						);
					?>
				</div>

				<div class="footer_menu">
					<h3 class="footer_menu_title">Helpful Resources</h3>
					<?php
						wp_nav_menu(
						array(
							'theme_location' => 'footer_team',
						)
						);
					?>
				</div>
				<div class="footer_menu">
					<a class="btn btn-g btn-icon" href="https://youtu.be/E8EvRA7_aOQ" data-fancybox="">
					<svg height="16" width="16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
							<path d="M460.8,68.452H51.2c-28.16,0-51.2,23.04-51.2,51.2v272.696c0,28.16,23.04,51.2,51.2,51.2h409.6
								c28.16,0,51.2-23.04,51.2-51.2V119.652C512,91.492,488.96,68.452,460.8,68.452z M188.44,359.98V151.108l195.624,104.44
								L188.44,359.98z"></path>
							<polygon style="fill:#FFFFFF;" points="188.44,359.98 384.056,255.548 188.44,151.108 "></polygon>
							</svg>
						<span>Watch Video</span>
					</a>
					<a href="/pricing" class="btn btn-1">Get Kanban Plugin</a>

				</div>
			</div>
		</div>

		<?php get_template_part('template-parts/footer-bottom'); ?>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<!--
	         (__)
     `\------(oo)
       ||    (__) <(What are you looking for?)
       ||w--||
-->
<?php echo get_field('body_bottom_script', 'option'); ?> <!-- Body Bottom External Code -->
</body>
</html>
