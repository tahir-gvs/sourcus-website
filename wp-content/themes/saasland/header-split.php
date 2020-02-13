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
    <?php
    $opt = get_option( 'saasland_opt' );
    // Preloader
    $is_preloader = !empty($opt['is_preloader']) ? $opt['is_preloader'] : '';
    $preloader_style = !empty($opt['preloader_style']) ? $opt['preloader_style'] : 'text';
    if( $is_preloader == '1' ) {
        if (defined( 'ELEMENTOR_VERSION')) {
            if (\Elementor\Plugin::$instance->preview->is_preview_mode()) {
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

    <header class="full_header">
        <div class="float-left">
            <a class="logo" href="<?php echo esc_url(home_url( '/')) ?>">
                <?php
                if (isset($opt['main_logo']['url'])) {
                    $reverse_logo = function_exists( 'get_field' ) ? get_field( 'reverse_logo' ) : '';
                    if ($reverse_logo || is_home()) {
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
                    ?>
                    <img src="<?php echo esc_url($main_logo); ?>" srcset="<?php echo esc_url($retina_logo) ?> 2x"
                         alt="<?php bloginfo( 'name' ); ?>">
                    <img src="<?php echo esc_url($sticky_logo); ?>"
                         srcset="<?php echo esc_url($retina_sticky_logo) ?> 2x" alt="<?php bloginfo( 'name' ); ?>">
                    <?php
                } else {
                    echo '<h3>' . get_bloginfo( 'name' ) . '</h3>';
                }
                ?>
            </a>
        </div>
        <?php
        if ( has_nav_menu( 'overlay_menu' ) ) :
            ?>
            <div class="float-right">
                <div class="bar_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <?php
        endif;
        ?>
    </header>

    <?php
    if ( has_nav_menu( 'overlay_menu' ) ) :
        ?>
        <div class="hamburger-menu-wrepper" id="menu">
            <div class="animation-box">
                <i class="icon_close close_icon"></i>
                <div class="menu-box d-table navbar">
                    <?php
                    wp_nav_menu ( array (
                        'menu' => 'overlay_menu',
                        'theme_location' => 'overlay_menu',
                        'container' => null,
                        'menu_class' => 'navbar-nav justify-content-end menu offcanfas_menu',
                        'walker' => new Saasland_Overlay_Nav(),
                        'depth' => 2
                    ));
                    if ( $opt['is_omenu_footer'] == '1' ) : ?>
                        <div class="header_footer">
                            <?php if ( !empty($opt['omenu_btm_title']) ) : ?>
                                <h5> <?php echo wp_kses_post($opt['omenu_btm_title']) ?> </h5>
                            <?php endif; ?>
                            <ul class="list-unstyled">
                                <?php saasland_social_links() ?>
                            </ul>
                            <?php echo !empty($opt['omenu_btm_content']) ? wp_kses_post(wpautop($opt['omenu_btm_content'])) : ''; ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php
    endif;