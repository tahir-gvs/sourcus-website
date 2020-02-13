<?php
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );
?>
<section class="slider_demos_area">
    <div class="container">
        <div class="section_title text-center">
            <?php if ( !empty( $settings['upper_title'] ) ) : ?>
                <div class="number wow fadeInUp" data-wow-delay="200ms"><?php echo wp_kses_post( $settings['upper_title'] ) ?></div>
            <?php endif; ?>
            <?php if ( !empty( $settings['title'] ) ) : ?>
                <h2 class="wow fadeInUp" data-wow-delay="400ms"><?php echo esc_html( $settings['title'] ) ?></h2>
            <?php endif; ?>
            <?php if ( !empty( $settings['subtitle'] ) ) : ?>
                <p class="wow fadeInUp" data-wow-delay="600ms"><?php echo esc_html( $settings['subtitle'] ) ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="slick marquee">
        <?php
        foreach ( $images as $image ) {
            ?>
            <div class="slick-slide">
                <div class="inner">
                    <?php echo wp_get_attachment_image($image['id'], 'full' ); ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            $( '.slick.marquee' ).slick({
                speed: 8000,
                autoplay: true,
                autoplaySpeed: 1000,
                centerMode: true,
                cssEase: 'linear',
                slidesToShow: 1,
                slidesToScroll: 1,
                variableWidth: true,
                infinite: true,
                initialSlide: 1,
                arrows: false,
                pauseOnHover:true,
                buttons: false
            });
        }); // End Document.ready
    })(jQuery)
</script>