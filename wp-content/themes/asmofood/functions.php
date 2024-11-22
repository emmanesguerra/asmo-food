<?php

/*
 * Disable admin bar
 */
add_filter('show_admin_bar', '__return_false');
/**
 * END disabling admin bar
 */


/** Include bootstrap on all pages * */
function enqueue_custom_styles() {
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_style('notosans', get_stylesheet_directory_uri() . '/fonts/NotoSans/css/font-face.css', time(), 'all');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

/**
 * END Bootstrap
 */

/** ADDING .CSS to a PAGE * */
function custom_css_files_admin_scripts($hook) {
    if ('post.php' != $hook && 'post-new.php' != $hook) {
        return;
    }
    wp_enqueue_script('custom-css-files-js', get_template_directory_uri() . '/js/custom-css-files.js', array('jquery'), null, true);
    wp_enqueue_style('custom-css-files-css', get_template_directory_uri() . '/css/custom-css-files.css');
}

add_action('admin_enqueue_scripts', 'custom_css_files_admin_scripts');

function custom_css_files_meta_box() {
    add_meta_box(
            'custom_css_files', // Unique ID
            'Custom CSS Files', // Box title
            'custom_css_files_meta_box_html', // Content callback
            'page', // Post type
            'normal', // Context
            'high'                       // Priority
    );
}

add_action('add_meta_boxes', 'custom_css_files_meta_box');

function custom_css_files_meta_box_html($post) {
    $values = get_post_meta($post->ID, '_custom_css_files', true);
    $values = is_array($values) ? $values : [];
    $css_files = get_css_files(); // Function to get the list of CSS files
    echo '<label for="custom_css_files_field">Custom CSS Files:</label>';
    echo '<input type="hidden" id="custom_css_files_field" name="custom_css_files_field" value="' . esc_attr(implode(',', $values)) . '" />';
    echo '<select id="custom_css_files_select">';
    foreach ($css_files as $file) {
        echo '<option value="' . esc_attr($file) . '">' . esc_html(basename($file)) . '</option>';
    }
    echo '</select>';
    echo '<button id="custom_css_files_add">Add CSS File</button>';
    echo '<ul id="custom_css_files_list">';
    foreach ($values as $value) {
        echo '<li data-url="' . esc_attr($value) . '">' . esc_html($value) . ' <button class="remove-css-file">Remove</button></li>';
    }
    echo '</ul>';
}

function get_css_files() {
    $css_dir = get_template_directory() . '/css/templates/'; // Directory where CSS files are stored
    $css_url = get_template_directory_uri() . '/css/templates/';
    $files = glob($css_dir . '*.css');
    $file_urls = array();
    foreach ($files as $file) {
        $file_urls[] = $css_url . basename($file);
    }
    return $file_urls;
}

function save_custom_css_files_meta_box_data($post_id) {
    if (isset($_POST['custom_css_files_field'])) {
        $css_files = array_map('trim', explode(',', $_POST['custom_css_files_field']));
        $css_files = array_filter($css_files, function($file) {
            return !empty($file);
        });
        update_post_meta($post_id, '_custom_css_files', $css_files);
    }
}

add_action('save_post', 'save_custom_css_files_meta_box_data');

function enqueue_custom_page_css() {
    if (is_page()) {
        global $post;
        $custom_css_files = get_post_meta($post->ID, '_custom_css_files', true);
        if (!empty($custom_css_files) && is_array($custom_css_files)) {
            foreach ($custom_css_files as $css_file) {
                wp_enqueue_style('custom-page-css-' . sanitize_title(basename($css_file)), esc_url($css_file), array(), null);
            }
        }
    }
}

add_action('wp_enqueue_scripts', 'enqueue_custom_page_css');

/** END ADDING .CSS to a page **/

/*
 * Menu setup
 */

// add menu link in the admin page
function theme_setup() {
    add_theme_support('menus');
}
add_action('after_setup_theme', 'theme_setup');

// display menu for front end
function theme_register_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'text-domain')
        )
    );
}
add_action('after_setup_theme', 'theme_register_menus');

/*
 * End setting up menu
 */