<?php
$title = get_sub_field( 'title' );
$featured_img = get_sub_field( 'featured_images' );
$floating_img = get_sub_field( 'floating_images' );
$bg_img = get_sub_field( 'background_image' );
$button = get_sub_field( 'button' );
?>

<div class="scroll-wrap">
    <div class="round_line one"></div>
    <div class="round_line two"></div>
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php if ( $floating_img['image_one']['url'] ) : ?>
        <img class="p_absoulte pp_triangle" src="<?php echo esc_url($floating_img['image_one']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
    <?php endif; ?>
    <?php if ( $floating_img['image_two']['url'] ) : ?>
        <img class="p_absoulte pp_snak" src="<?php echo esc_url($floating_img['image_two']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
    <?php endif; ?>
    <?php if ( $floating_img['image_three']['url'] ) : ?>
        <img class="p_absoulte pp_block" src="<?php echo esc_url($floating_img['image_three']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
    <?php endif; ?>
    <div class="p-section-bg">
        <?php
            if ( !empty( $bg_img['url'] ) ) :
                ?>
                <style>
                    .pagepiling .section-1 .p-section-bg {
                        background-image:url(<?php echo esc_url($bg_img['url']) ?>);
                        background-size: cover;
                        background-position: center;
                    }
                </style>
                <?php
            endif;
        ?>
    </div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="section_one_img">
                            <div class="round"></div>
                                <?php if ( $featured_img['featured_image']['url'] ) : ?>
                                    <img src="<?php echo esc_url( $featured_img['featured_image']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
                                <?php endif; ?>
                                <?php if ( $featured_img['featured_image_two']['url'] ) : ?>
                                    <img class="dots" src="<?php echo esc_url( $featured_img['featured_image_two']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="section_one-content">
                            <?php if ( !empty( $title ) ) : ?>
                                <h2><?php echo wp_kses_post(nl2br($title)) ?></h2>
                            <?php endif; ?>
                            <?php if (!empty( $button['button_label'] ) ) : ?>
                                <a href="<?php echo esc_url($button['button_url']['url']) ?>" class="btn_scroll btn_hover">
                                    <?php echo esc_html( $button['button_label'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>