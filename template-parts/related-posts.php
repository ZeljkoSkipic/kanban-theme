<?php
// Get current post's categories
$categories = get_the_category();
$category_ids = array();

// Extract category IDs
if ($categories) {
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
}

// Set up query arguments
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'category__in'   => $category_ids,
    'post__not_in'   => array(get_the_ID()), // Exclude current post
    'orderby'        => 'rand', // Random order
);

// Run the query
$related_posts_query = new WP_Query($args);

// Check if we have posts
if ($related_posts_query->have_posts()) :
?>
    <div class="container space_2">
        <h2 class="title-2 t_space_1">Related Posts</h2>

        <section class="posts_grid">
            <?php
            // Loop through each post in the results
            while ($related_posts_query->have_posts()) :
                $related_posts_query->the_post();
                // Include the grid-post template for each post
                get_template_part('template-parts/grid-post');
            endwhile;
            ?>
        </section>
    </div>
<?php
    // Reset post data
    wp_reset_postdata();
endif;
?>
