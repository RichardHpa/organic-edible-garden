<?php

/* Function to enqueue stylesheet from parent theme */
function child_enqueue__parent_scripts() {
    wp_enqueue_style( ‘parent’, get_template_directory_uri().’/style.css’ );
}

add_action( ‘wp_enqueue_scripts’, ‘child_enqueue__parent_scripts’);

function wpa_latest_in_category_redirect($request)
{
    if (isset($_GET['latest']) && isset($request->query_vars['category_name'])) {
        $latest = new WP_Query([
            'category_name' => $request->query_vars['category_name'],
            'posts_per_page' => 1,
        ]);
        if ($latest->have_posts()) {
            wp_redirect(get_permalink($latest->post->ID));
            exit();
        }
    }
}
add_action('parse_request', 'wpa_latest_in_category_redirect');
