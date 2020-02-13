<?php
wp_enqueue_script( 'owl-carousel' );
?>
<section class="pos_banner_area">
    <div class="pos_slider owl-carousel">
        <?php
        if ( !empty( $slide_images ) ) {
            foreach ( $slide_images as $slide_image ) {
                ?>
                <div class="pos_banner_item" style="background: url(<?php echo esc_url( $slide_image['slides_img']['url']) ?>)"></div>
                <?php
            }
        }
        ?>
    </div>
    <div class="container">
        <div class="pos_banner_text text-center">
            <?php if(!empty($settings['subtitle'])) : ?>
                <h6><?php echo esc_html(nl2br($settings['subtitle'])) ?></h6>
            <?php endif; ?>
            <?php if ( !empty($settings['title']) ) : ?>
                <<?php echo $title_tag; ?> class="saasland_hero_pos"><?php echo wp_kses_post(nl2br($settings['title'])) ?></<?php echo $title_tag; ?>>
            <?php endif; ?>
            <div class="action_btn d-flex align-items-center justify-content-center wow fadeInLeft" data-wow-delay="0.6s">
                <?php
                if (!empty( $buttons )) {
                    foreach ( $buttons as $button ) {
                        ?>
                        <?php if (!empty($button['btn_title'])) : ?>
                            <a href="<?php echo esc_url($button['btn_url']['url']) ?>" class="software_banner_btn elementor-repeater-item-<?php echo $button['_id'] ?>" data-wow-delay="0.7s"
                                <?php saasland_is_external($button['btn_url']) ?>>
                                <?php echo esc_html($button['btn_title']) ?>
                            </a>
                        <?php endif; ?>
                        <?php
                    }
                }
                if($settings['is_play_btn'] == 'yes' ) : ?>
                    <?php if ( !empty($settings['play_btn_title']) ) : ?>
                        <a href="<?php echo esc_url($settings['play_url']) ?>" class="video_btn popup-youtube">
                            <div class="icon"><i class="fas fa-play"></i></div>
                            <span><?php echo esc_html($settings['play_btn_title']) ?></span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            function posSlider(){
                var posS = $(".pos_slider");
                if( posS.length ){
                    posS.owlCarousel({
                        loop:true,
                        margin:0,
                        items: 1,
                        dots: false,
                        nav:false,
                        autoplay: true,
                        slideSpeed: 300,
                        mouseDrag: false,
                        animateIn: 'fadeIn',
                        animateOut: 'fadeOut',
                        responsiveClass:true,
                    })
                }
            }
            posSlider();

        })
    })(jQuery)
</script>