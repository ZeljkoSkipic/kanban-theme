<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package stier
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function stier_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'stier_body_classes' );

// Add a pingback url auto-discovery header for single posts, pages, or attachments.

function stier_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'stier_pingback_header' );


// Login Screen

add_filter( 'login_headerurl', 'my_custom_login_url' );
function my_custom_login_url($url) {
    return '/';
}

function get_custom_logo_url() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    if (has_custom_logo()) {
        return $logo[0];
    } else {
        return ''; // Return an empty string or a default logo URL if no custom logo is set
    }
}

function custom_login_logo() {
    $logo_url = get_custom_logo_url();
    if ($logo_url != '') {
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($logo_url); ?>);

            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'custom_login_logo');

// Admin footer modification

function dashboard_footer_admin () {
    echo '<span id="footer-thankyou">Thank you for developing with <a href="https://stierdev.com/" target="_blank">S Tier Dev</a>. Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>.</span> ';
}

add_filter('admin_footer_text', 'dashboard_footer_admin');

// Settings pages

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Website Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
		'position' => '2.69',
		'icon_url'          => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIHZlcnNpb249IjEuMSI+CjxnIGlkPSJzdXJmYWNlMSI+CjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMCUsMCUsMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSAxLjU4MjAzMSA2LjE3OTY4OCBMIDEuNTgyMDMxIDEwLjc3MzQzOCBMIDEuNzIyNjU2IDEwLjc2NTYyNSBMIDEuODU5Mzc1IDEwLjc1MzkwNiBMIDEuODcxMDk0IDYuMzEyNSBMIDEuODc4OTA2IDEuODc4OTA2IEwgMTAuODA0Njg4IDEuODc4OTA2IEwgMTAuODA0Njg4IDEuNTgyMDMxIEwgMS41ODIwMzEgMS41ODIwMzEgWiBNIDEuNTgyMDMxIDYuMTc5Njg4ICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gOS40ODQzNzUgNC42MTMyODEgQyA4LjI0NjA5NCA0LjczNDM3NSA3LjM0Mzc1IDUuMjEwOTM4IDYuODIwMzEyIDYuMDIzNDM4IEMgNi4zMzU5MzggNi43ODkwNjIgNi4zMzU5MzggOC4wODU5MzggNi44MjAzMTIgOC45MTc5NjkgQyA2Ljk3NjU2MiA5LjE4MzU5NCA3LjQxMDE1NiA5LjYwOTM3NSA3LjcxODc1IDkuODAwNzgxIEMgOC4wOTc2NTYgMTAuMDMxMjUgOC42NTIzNDQgMTAuMjYxNzE5IDkuNjgzNTk0IDEwLjYwMTU2MiBDIDExLjEyMTA5NCAxMS4wODIwMzEgMTEuNTM5MDYyIDExLjMxNjQwNiAxMS43NjU2MjUgMTEuNzg1MTU2IEMgMTEuODcxMDk0IDExLjk5NjA5NCAxMS44NzUgMTIuMDE1NjI1IDExLjg3NSAxMi40MTc5NjkgQyAxMS44NzUgMTIuOTAyMzQ0IDExLjgyNDIxOSAxMy4xMDE1NjIgMTEuNjM2NzE5IDEzLjM3MTA5NCBDIDExLjM5MDYyNSAxMy43MTg3NSAxMC45NTMxMjUgMTMuOTI5Njg4IDEwLjMwODU5NCAxNCBDIDEwLjExNzE4OCAxNC4wMjM0MzggOS44Mzk4NDQgMTQuMDI3MzQ0IDkuNjgzNTk0IDE0LjAxNTYyNSBDIDguOTIxODc1IDEzLjk1NzAzMSA3Ljk3NjU2MiAxMy42MjUgNy4zMzk4NDQgMTMuMTk5MjE5IEwgNy4xMTcxODggMTMuMDU0Njg4IEwgNi43NTM5MDYgMTMuNjU2MjUgTCA2LjM5NDUzMSAxNC4yNTc4MTIgTCA2LjUxNTYyNSAxNC4zNjMyODEgQyA2Ljk3NjU2MiAxNC43NzM0MzggNy44MzIwMzEgMTUuMTQ0NTMxIDguNzM0Mzc1IDE1LjMzNTkzOCBDIDkuMjg5MDYyIDE1LjQ1MzEyNSAxMC4yMTg3NSAxNS40ODA0NjkgMTAuNzY1NjI1IDE1LjQwMjM0NCBDIDExLjc3MzQzOCAxNS4yNTM5MDYgMTIuNTkzNzUgMTQuODU1NDY5IDEzLjA2NjQwNiAxNC4yOTI5NjkgQyAxMy4yNTM5MDYgMTQuMDYyNSAxMy40ODgyODEgMTMuNTg1OTM4IDEzLjU3MDMxMiAxMy4yNjU2MjUgQyAxMy42OTE0MDYgMTIuNzczNDM4IDEzLjY4NzUgMTIuMDYyNSAxMy41NTQ2ODggMTEuNTQ2ODc1IEMgMTMuMzI4MTI1IDEwLjY3MTg3NSAxMi44MDg1OTQgMTAuMTQ0NTMxIDExLjY5NTMxMiA5LjY0ODQzOCBDIDExLjQ5MjE4OCA5LjU1NDY4OCAxMC44ODY3MTkgOS4zMzU5MzggMTAuMzUxNTYyIDkuMTUyMzQ0IEMgOS4wMzUxNTYgOC43MTA5MzggOC42MjEwOTQgOC40OTYwOTQgOC4zOTg0MzggOC4xNDQ1MzEgQyA4LjIwNzAzMSA3Ljg0NzY1NiA4LjE3OTY4OCA3LjE1NjI1IDguMzQzNzUgNi44MzU5MzggQyA4LjcwMzEyNSA2LjEyNSA5Ljk4NDM3NSA1LjgzMjAzMSAxMS4zMTI1IDYuMTY0MDYyIEMgMTEuNjQwNjI1IDYuMjQ2MDk0IDEyLjI0NjA5NCA2LjUzOTA2MiAxMi40NjQ4NDQgNi43MTQ4NDQgQyAxMi41NTA3ODEgNi43OTI5NjkgMTIuNjM2NzE5IDYuODUxNTYyIDEyLjY1MjM0NCA2Ljg1MTU2MiBDIDEyLjY2NDA2MiA2Ljg1MTU2MiAxMi44NTE1NjIgNi42MjUgMTMuMDYyNSA2LjM0NzY1NiBDIDEzLjI3MzQzOCA2LjA3NDIxOSAxMy40NjA5MzggNS44MjgxMjUgMTMuNDgwNDY5IDUuODA0Njg4IEMgMTMuNTU4NTk0IDUuNzA3MDMxIDEyLjc5Mjk2OSA1LjE0NDUzMSAxMi4zNTE1NjIgNC45NzY1NjIgQyAxMS41NjY0MDYgNC42NzU3ODEgMTAuNDAyMzQ0IDQuNTI3MzQ0IDkuNDg0Mzc1IDQuNjEzMjgxIFogTSA5LjQ4NDM3NSA0LjYxMzI4MSAiLz4KPHBhdGggc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigwJSwwJSwwJSk7ZmlsbC1vcGFjaXR5OjE7IiBkPSJNIDE4LjE0ODQzOCAxMy43MDMxMjUgTCAxOC4xNDg0MzggMTguMTQ4NDM4IEwgOS4yMjI2NTYgMTguMTQ4NDM4IEwgOS4yMjI2NTYgMTguNDQ1MzEyIEwgMTguNDQ1MzEyIDE4LjQ0NTMxMiBMIDE4LjQ0NTMxMiA5LjI1MzkwNiBMIDE4LjE0ODQzOCA5LjI1MzkwNiBaIE0gMTguMTQ4NDM4IDEzLjcwMzEyNSAiLz4KPC9nPgo8L3N2Zz4K'
    ));

	acf_add_options_sub_page(array(
		'page_title'    => 'External Scripts',
		'menu_title'    => 'External Scripts',
		'parent_slug'   => 'site-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Inner Contact Section',
		'menu_title'    => 'Inner Contact',
		'parent_slug'   => 'site-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Footer Settings',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'site-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Help Center Archive',
		'menu_title'    => 'Archive',
		'parent_slug'   => 'edit.php?post_type=help-center',
	));


}

// Calculate Post Reading Time
function calculate_reading_time($post_id)
{
	// Get the post content
	$post_content = get_post_field('post_content', $post_id);

	// Count the number of words
	$word_count = str_word_count(strip_tags($post_content));

	// Calculate the reading time in minutes
	$reading_time = ceil($word_count / 249);

	return $reading_time;
}

function get_reading_time_text($post_id)
{
	$reading_time = calculate_reading_time($post_id);
	return $reading_time . ' minute read';
}


// Block Category

add_filter( 'block_categories_all' , function( $categories ) {

    // Adding a new category.
	$categories[] = array(
		'slug'  => 'stier',
		'title' => 'S-Tier'
	);

	return $categories;
} );


// Blocks

add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/../blocks/used/home-hero' );
	register_block_type( __DIR__ . '/../blocks/used/info-boxes' );
	register_block_type( __DIR__ . '/../blocks/used/pricing' );
	register_block_type( __DIR__ . '/../blocks/used/basic-section' );
	register_block_type( __DIR__ . '/../blocks/used/inner-hero' );
	register_block_type( __DIR__ . '/../blocks/used/comparison' );
	register_block_type( __DIR__ . '/../blocks/used/contact' );
	register_block_type( __DIR__ . '/../blocks/used/carousel' );

	//register_block_type( __DIR__ . '/../blocks/help-center' );

	//register_block_type( __DIR__ . '/../blocks/testimonials' );
	//register_block_type( __DIR__ . '/../blocks/accordion' );

	//register_block_type( __DIR__ . '/../blocks/inner-contact' );

	//register_block_type( __DIR__ . '/../blocks/features-overview' );

}


// Nav Menu Icons

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {

    // loop
    foreach( $items as &$item ) {

        // vars
        $icon = get_field('icon', $item);


        // append icon
        if( $icon ) {

			$item->title .= ' <img class="mob-nav-icon" src="'.$icon.'">';

        }

    }


    // return
    return $items;

}
