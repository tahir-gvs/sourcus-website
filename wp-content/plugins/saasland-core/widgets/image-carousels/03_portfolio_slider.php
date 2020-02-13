<?php
wp_enqueue_style( 'saasland-demo' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );
?>
<section class="portfolio_area">
    <div class="container">
        <div class="section_title text-center">
            <?php if(!empty($settings['title_text'])) : ?>
                <<?php echo $title_tag; ?> class="f_p f_size_30 l_height30 f_700 t_color3 mb_20 wow fadeInUp" data-wow-delay="0.2s">
                <?php echo $settings['title_text']; ?>
            </<?php echo $title_tag; ?>>
            <?php endif; ?>
            <?php if(!empty($settings['subtitle_text'])) : ?>
                <?php echo '<p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">'.nl2br(wp_kses_post($settings['subtitle_text'])).'</p>';
            endif;
            ?>
        </div>
    </div>
    <div class="p_slider_inner">
        <div class="portfolio_slider">
            <?php
            foreach ($images as $image ) {
                ?>
                <div class="p_item">
                    <?php echo wp_get_attachment_image($image['id'], 'full' ); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="arrow">
            <i class="ti-arrow-left prevs"></i>
            <i class="ti-arrow-right nexts"></i>
        </div>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            function portfolioSlider(){
                $( '.portfolio_slider' ).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrow: true,
                    centerMode: true,
                    centerPadding: '450px',
                    speed: 800,
                    autoplay: true,
                    infinite: true,
                    prevArrow: ( '.prevs' ),
                    nextArrow: ( '.nexts' ),
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '250px',
                            }
                        },
                        {
                            breakpoint: 1008,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '150px',
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '50px',
                            }
                        }
                    ]
                })
            }
            portfolioSlider();
        }); // End Document.ready
    })(jQuery)
</script>