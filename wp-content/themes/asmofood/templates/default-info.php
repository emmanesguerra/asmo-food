<?php
/*
  Template Name: AF Information
*/
?>

<?php get_header(); ?>

<div class="page-banner">
    <?php
    global $wpdb;

    // Replace 'wp_page_banners' with your actual table name
    $table_name = $wpdb->prefix . 'page_banner';

    // Get the current page ID
    $current_page_id = get_the_ID();

    // Fetch the banner associated with this page ID
    $banner = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE page_id = %d ORDER BY id DESC LIMIT 1",
        $current_page_id
    ));

    if ($banner) :
    ?>
        <div class="banner-image">
            <img src="<?php echo esc_url($banner->image); ?>" alt="<?php echo esc_attr($banner->title); ?>">
        </div>
        <div class="banner-content">
            <h1><?php echo esc_html($banner->title); ?></h1>
            <h2><?php echo esc_html($banner->subtitle); ?></h2>
            <div class="banner-description">
                <?php echo wp_kses_post($banner->description); ?>
            </div>
        </div>
    <?php else : ?>
        <p>No banner available for this page. <?php echo $current_page_id ?></p>
    <?php endif; ?>
</div>

<?php echo the_content(); ?>

<?php get_footer(); ?>
