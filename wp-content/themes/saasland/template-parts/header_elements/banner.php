<?php
$opt = get_option('saasland_opt');
$titlebar_align = !empty($opt['titlebar_align']) ? $opt['titlebar_align'] : 'center';
?>
<section class="breadcrumb_area <?php echo esc_attr($titlebar_align) ?>">
    <?php
    $background_image = function_exists( 'get_field' ) ? get_field( 'background_image' ) : '';
    if (!empty($background_image)) {
        echo "<img src='" . esc_url($background_image) . "' class='breadcrumb_shap' alt='" . get_the_title() . "'>";;
    }
    else {
        $banner_bg = !empty($opt['banner_bg']['url']) ? $opt['banner_bg']['url'] : SAASLAND_DIR_IMG . '/banners/banner_bg.png';
        if ( class_exists('WooCommerce') ) {
            if ( is_shop() ) {
                $banner_bg = !empty($opt['shop_header_bg']['url']) ? $opt['shop_header_bg']['url'] : SAASLAND_DIR_IMG . '/banners/banner_bg.png';
            }
        }
        echo "<img src='" . esc_url($banner_bg) . "' class='breadcrumb_shap' alt='" . get_the_title() . "'>";
    }
    ?>
    <div class="container">
        <div class="breadcrumb_content text-center">
            <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">
                <?php saasland_banner_title(); ?>
            </h1>
            <?php saasland_banner_subtitle() ?>
        </div>
    </div>
</section>