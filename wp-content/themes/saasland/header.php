<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package saasland
 */

// Theme settings options
$opt = get_option( 'saasland_opt' );

/**
* Header Nav-bar Layout
 */
$page_header_layout = function_exists( 'get_field' ) ? get_field( 'header_layout' ) : '';

if( !empty($page_header_layout) && $page_header_layout != 'default' ) {
    $nav_layout = $page_header_layout;
} elseif ( !empty($_GET['menu']) ) {
    $nav_layout = $_GET['menu'];
} else {
    $nav_layout = !empty($opt['nav_layout']) ? $opt['nav_layout'] : '';
}

$nav_layout_header = '';
$nav_layout_start = '<div class="container">';
$nav_layout_end = '</div>';

switch ( $nav_layout ) {
    case 'boxed':
        $nav_layout_start = '<div class="container">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'wide':
        $nav_layout_start = '<div class="container custom_container">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'full_width':
        $nav_layout_start = '';
        $nav_layout_header = 'header_area_three header_area_five nav_full_width';
        $nav_layout_end = '';
        break;
}

/**
* Menu Alignment
 */
$menu_alignment = !empty($opt['menu_alignment']) ? $opt['menu_alignment'] : 'menu_right';
if ( !empty($_GET['menu_align']) ) {
    $menu_alignment = $_GET['menu_align'];
}
switch ( $menu_alignment ) {
    case 'menu_right':
        $nav_alignment = 'navbar navbar-expand-lg menu_one menu_right';
        $ul_class = ' ml-auto';
        $menu_container = '';
        break;
    case 'menu_left':
        $nav_alignment = 'navbar navbar-expand-lg menu_one menu_four menu_left';
        $ul_class = ' pl_120';
        $menu_container = '';
        break;
    case 'menu_center':
        $nav_alignment = 'navbar navbar-expand-lg menu_center';
        $menu_container = 'justify-content-center';
        $ul_class = ' ml-auto mr-auto';
        break;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <!-- For IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- For Resposive Device -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="70">
    <?php wp_body_open(); ?>

    <?php
    // Preloader
    $is_preloader = !empty($opt['is_preloader']) ? $opt['is_preloader'] : '';
    $preloader_style = !empty($opt['preloader_style']) ? $opt['preloader_style'] : 'text';
    if( $is_preloader == '1' ) {
        if ( defined( 'ELEMENTOR_VERSION' ) ) {
            if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                echo '';
            } else {
                if( $preloader_style == 'text' ) {
                    get_template_part( 'template-parts/header_elements/pre', 'loader' );
                } else {
                    ?>
                    <div id="preloader">
                        <div id="status"></div>
                    </div>
                    <?php
                }
            }
        }
        else {
            if( $preloader_style == 'text' ) {
                get_template_part( 'template-parts/header_elements/pre', 'loader' );
            } else {
                ?>
                <div id="preloader">
                    <div id="status"></div>
                </div>
                <?php
            }
        }
    }
    ?>

<div class="body_wrapper">
<?php
$header_style = '';
if( !empty($opt['header_style']) && ($opt['header_style'] != 'default' ) ) {
    $header_style = new WP_Query(array(
        'post_type' => 'header',
        'posts_per_page' => -1,
        'p' => $opt['header_style'],
    ));
}

if( $header_style != '' ) {
    if ( $header_style->have_posts() ) {
        while ($header_style->have_posts() ) : $header_style->the_post();
            the_content();
        endwhile;
    }
} else {

    if ( isset($opt['is_header_sticky']) ) {
        $is_header_sticky = $opt['is_header_sticky'] == '1' ? ' header_stick' : '';
    }
    else {
        $is_header_sticky = ' header_stick';
    }

    if ( is_page_template( 'page-agency-colorful.php' ) ) {
        $is_header_sticky = '';
    }
    ?>

    <header class="header_area <?php echo esc_attr($nav_layout_header . $is_header_sticky); ?>">
        <?php
        $is_header_top = !empty($opt['is_header_top']) ? $opt['is_header_top'] : '';
        $is_header_top_social = !empty($opt['is_header_top_social']) ? $opt['is_header_top_social'] : '';
        if ($is_header_top == '1' ) :
            ?>
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <?php if (!empty($opt['header_top_left_content'])) : ?>
                            <div class="col-lg-6 header_top_column left_content">
                                <?php echo wp_kses_post(wpautop($opt['header_top_left_content'])) ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-6 header_top_column right_content">
                            <?php
                            if ($is_header_top_social == '1' ) {
                                ?>
                                <ul class="header_social_icon list-unstyled">
                                    <?php saasland_social_links() ?>
                                </ul>
                                <?php
                            } else {
                                echo !empty($opt['header_top_right_content']) ? wp_kses_post(wpautop($opt['header_top_right_content'])) : '';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endif;
        ?>

        <nav class="<?php echo esc_attr($nav_alignment) ?>">
            <?php echo wp_kses_post($nav_layout_start); ?>
            <a class="navbar-brand sticky_logo" href="<?php echo esc_url(home_url( '/')) ?>">
                <?php
                if (isset($opt['main_logo']['url'])) {
                    $reverse_logo = function_exists( 'get_field' ) ? get_field( 'reverse_logo' ) : '';
                    $error_img_select = !empty($opt['error_img_select']) ? $opt['error_img_select'] : '1';
                    $is_blog_sticky_logo = isset($opt['is_blog_sticky_logo']) ? $opt['is_blog_sticky_logo'] : '';
                    if ($reverse_logo || (is_home() && $is_blog_sticky_logo == '1') || ($error_img_select == '2' && is_404())) {
                        // Normal Logo
                        $main_logo = isset($opt['sticky_logo'] ['url']) ? $opt['sticky_logo'] ['url'] : '';
                        $retina_logo = isset($opt['retina_sticky_logo'] ['url']) ? $opt['retina_sticky_logo'] ['url'] : '';
                        // Sticky Logo
                        $sticky_logo = isset($opt['sticky_logo'] ['url']) ? $opt['sticky_logo'] ['url'] : '';
                        $retina_sticky_logo = isset($opt['retina_sticky_logo'] ['url']) ? $opt['retina_sticky_logo'] ['url'] : '';
                    } else {
                        // Normal Logo
                        $main_logo = isset($opt['main_logo'] ['url']) ? $opt['main_logo'] ['url'] : '';
                        $retina_logo = isset($opt['retina_logo'] ['url']) ? $opt['retina_logo'] ['url'] : '';
                        // Sticky Logo
                        $sticky_logo = isset($opt['sticky_logo'] ['url']) ? $opt['sticky_logo'] ['url'] : '';
                        $retina_sticky_logo = isset($opt['retina_sticky_logo'] ['url']) ? $opt['retina_sticky_logo'] ['url'] : '';
                    }
                    $logo_srcset = !empty($retina_logo) ?  "srcset='$retina_logo 2x'" : '';
                    $logo_srcset_sticky = !empty($retina_sticky_logo) ?  "srcset='$retina_sticky_logo 2x'" : '';
                    ?>
                    <img src="<?php echo esc_url($main_logo); ?>" <?php echo wp_kses_post($logo_srcset) ?> alt="<?php bloginfo( 'name' ); ?>">
                    <img src="<?php echo esc_url($sticky_logo); ?>" <?php echo wp_kses_post($logo_srcset_sticky) ?> alt="<?php bloginfo( 'name' ); ?>">
                    <?php
                } else {
                    echo '<h3>' . get_bloginfo( 'name' ) . '</h3>';
                }
                ?>
            </a>

            <?php
            $is_menu_btn = !empty($opt['is_menu_btn']) ? $opt['is_menu_btn'] : '';
            if (!empty($menu_btn_title) & $is_menu_btn == '1' ) : ?>
                <a class="btn_get btn_hover mobile_btn ml-auto" href="<?php echo esc_url($menu_btn_url); ?>">
                    <?php echo esc_html($menu_btn_title); ?>
                </a>
            <?php endif; ?>

            <?php
            if (has_nav_menu( 'main_menu')) : ?>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'saasland' ) ?>">
                            <span class="menu_toggle">
                                <span class="hamburger">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="hamburger-cross">
                                    <span></span>
                                    <span></span>
                                </span>
                            </span>
                </button>
            <?php endif; ?>

            <div class="<?php echo 'collapse navbar-collapse ' . $menu_container; ?>" id="navbarSupportedContent">
                <?php
                if (has_nav_menu( 'main_menu')) {
                    wp_nav_menu(array(
                        'menu' => 'main_menu',
                        'theme_location' => 'main_menu',
                        'container' => null,
                        'menu_class' => 'navbar-nav menu '.$ul_class,
                        'walker' => new Saasland_Nav_Navwalker(),
                        'depth' => 5
                    ));
                }
                get_template_part( 'template-parts/header_elements/buttons' );
                ?>
            </div>

            <?php
            get_template_part( 'template-parts/header_elements/mini', 'cart' );

            echo wp_kses_post($nav_layout_end);
            ?>
        </nav>
    </header>
    <?php
    }
    ?>

    <?php
    $is_banner = '1';
    if ( is_home() ) {
        $is_banner = '1';
    } elseif ( is_page() || is_singular('post') || is_singular( 'job' ) || is_singular('product') ) {
        $is_banner = function_exists( 'get_field' ) ? get_field( 'is_banner' ) : '1';
        $is_banner = isset($is_banner) ? $is_banner : '1';
    }

    if ( is_404() || is_page_template('elementor_canvas') ) {
        $is_banner = '';
    }

    if ( is_home() ) {
        $banner_style = !empty($opt['blog_banner_style']) ? $opt['blog_banner_style'] : '2';
    } else {
        $banner_style = !empty($opt['banner_style']) ? $opt['banner_style'] : '1';
    }

    if ( !isset($_GET['elementor_library']) ) {
        if ( $is_banner == '1' ) {
            if (!is_singular( 'post')) {
                if ($banner_style == '1' ) {
                    get_template_part( 'template-parts/header_elements/banner' );
                } elseif ($banner_style == '2' ) {
                    get_template_part( 'template-parts/header_elements/banner2' );
                }
            } elseif (is_singular( 'post')) {
                get_template_part( 'template-parts/header_elements/banner', 'post' );
            }
        }
    }