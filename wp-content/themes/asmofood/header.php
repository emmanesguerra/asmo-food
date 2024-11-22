<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    </head>
    <body <?php body_class(); ?>>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-12 px-5">
                        <div class="row">
                            <div class="col-8 px-0">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Site Logo" class="site-logo" />
                                </a>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-12 px-0">
                                                        &nbsp;
                                                    </div>
                                                    <div class="col-12 px-0">
                                                        <a><img src="<?php echo get_template_directory_uri(); ?>/images/sitemap.png" alt="Sitemap" 
                                                                class="header-link" data-hover="<?php echo get_template_directory_uri(); ?>/images/sitemap_btn_hv.png"/></a>
                                                        <a><img src="<?php echo get_template_directory_uri(); ?>/images/inquiry.png" alt="Inquiry" 
                                                                class="header-link" data-hover="<?php echo get_template_directory_uri(); ?>/images/inquiry_btn_hv.png"/></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/fblogo.png" alt="FB Logo" class="fb-logo" width="65px" />
                                                </a>
                                                <a>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/instalogo.png" alt="INSTA Logo" class="insta-logo"  width="50px" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <hr class="header-hr" />
                    </div>
                </div>
                <?php
                if (has_nav_menu('header-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'header-menu', // Matches the identifier registered in functions.php.
                        'container' => 'nav', // Wraps the menu in a <nav> tag.
                        'container_class' => 'header-menu', // Adds a class to the <nav> tag.
                        'menu_class' => 'menu-list', // Adds a class to the <ul> tag.
                        'fallback_cb' => false, // Prevents the default menu from displaying if none is set.
                    ));
                } else {
                    echo '<p>Please assign a menu to the Header Menu location in Appearance > Menus.</p>';
                }
                ?>
            </div>
        </header>