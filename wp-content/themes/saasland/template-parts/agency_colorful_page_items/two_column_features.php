<?php
$title_sec = get_sub_field( 'title_section' );
$features = get_sub_field( 'features_list' );
$floating_img = get_sub_field( 'floating_images' );
$featured_images = get_sub_field( 'featured_images_sec' );
$bg_img = get_sub_field( 'background_image' );
?>

<div class="scroll-wrap">
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php if ( $floating_img['image_one']['url'] ) : ?>
        <img class="p_absoulte pp_triangle t_left" src="<?php echo esc_url($floating_img['image_one']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
    <?php endif; ?>
    <?php if ( $floating_img['image_two']['url'] ) : ?>
        <img class="p_absoulte pp_block" src="<?php echo esc_url($floating_img['image_two']['url']); ?>" alt="<?php echo esc_attr($floating_img['alt']) ?>">
    <?php endif; ?>
    <div class="p-section-bg">
        <?php
        if ( !empty( $bg_img['url'] ) ) :
            ?>
            <style>
                .pagepiling .section-3 .p-section-bg {
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
                <div class="row flex-row-reverse">
                    <div class="col-lg-4">
                        <div class="section_one_img">
                            <div class="round p_absoulte"></div>
                            <?php if ( $featured_images['featured_image_one']['url'] ) : ?>
                                <img src=" <?php echo esc_url( $featured_images['featured_image_one']['url'] ); ?>" alt="<?php echo esc_attr($featured_images['alt']) ?>">
                            <?php endif; ?>
                            <?php if ( $featured_images['featured_image_two']['url'] ) : ?>
                                <img class="p_absoulte dots" src=" <?php echo esc_url( $featured_images['featured_image_two']['url'] ); ?>" alt="<?php echo esc_attr($featured_images['alt']) ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="pp_features_info">
                            <div class="hosting_title pp_sec_title">
                                <?php if ( !empty( $title_sec['upper_title'] ) ) : ?>
                                    <h3><?php echo esc_html( $title_sec['upper_title'] ) ?></h3>
                                <?php endif; ?>
                                <?php if ( !empty( $title_sec['title'] ) ) : ?>
                                    <h2><?php echo esc_html( $title_sec['title'] ) ?></h2>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <?php
                                if ( !empty( $features ) ) {
                                    foreach ( $features as  $feature ) {
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="pp_features_item">
                                                <?php if ( !empty( $feature['icon_image']['url'] ) ) : ?>
                                                    <div class="icon">
                                                        <img src="<?php echo esc_url($feature['icon_image']['url']); ?>" alt="<?php echo esc_attr($feature['alt']) ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                 echo !empty( $feature['title'] ) ? '<h4>' . esc_html($feature['title']) . '</h4>' : '';
                                                 echo !empty( $feature['subtitle'] ) ? wpautop($feature['subtitle']) : '';
                                                 ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>