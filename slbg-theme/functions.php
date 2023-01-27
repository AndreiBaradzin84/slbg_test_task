<?php

function slbg_theme_setup()
{
    load_theme_textdomain('slbgtheme', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'slbg_theme_setup');

function slbg_theme_add_custom_field( $post_id ) {
    add_post_meta( $post_id, 'random_bytes', bin2hex(random_bytes(10)), true );
}
add_action( 'save_post', 'slbg_theme_add_custom_field' );

add_theme_support('post-thumbnails');
set_post_thumbnail_size(300, 200);

function slbg_theme_enqueue_styles()
{
    wp_enqueue_style('style-name', get_stylesheet_uri());
    wp_enqueue_style('script-name', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_script('jquery');
    wp_register_script('category-filter', get_stylesheet_directory_uri() . '/js/category-filter.js', ['jquery'], time(), true);
    wp_enqueue_script('category-filter');

    $data = [
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ];

    wp_add_inline_script('category-filter', 'const cfScriptData = ' . wp_json_encode($data), 'before');
}

add_action('wp_enqueue_scripts', 'slbg_theme_enqueue_styles');

function load_category_posts_callback()
{
    $category_id = $_POST['category_id'];
    $args = [
        'post_type' => 'post',
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $category_id
            ]
        ]
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            require(locate_template('content.php'));
        }
    }
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_load_category_posts', 'load_category_posts_callback');
add_action('wp_ajax_nopriv_load_category_posts', 'load_category_posts_callback');
