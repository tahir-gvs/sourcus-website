<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/**
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Saasland_slider extends Widget_Base {

    public function get_name() {
        return 'saasland_slider';
    }

    public function get_title() {
        return __( 'Slider', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    protected function render() {
        $settings = $this->get_settings();
        $slides = isset($settings['slides']) ? $settings['slides'] : '';
        ?>
        <section class="saas_banner_area_three owl-carousel">
            <?php
            foreach ($slides as $slide) {
                $button_url = $slide['btn_url'];
                $btn_target = $button_url['is_external'] ? 'target="_blank"' : '';
                $button2_url = $slide['btn2_url'];
                $btn2_target = $button2_url['is_external'] ? 'target="_blank"' : '';
                if ($slide['style'] == '1' ) : ?>
                    <div class="slider_item elementor-repeater-item-<?php echo $slide['_id'] ?>">
                        <div class="container">
                            <div class="slidet_content">
                                <?php echo (!empty($slide['content'])) ? wp_kses_post($slide['content']) : ''; ?>
                                <?php if (!empty($slide['btn_label'])) : ?>
                                    <a href="<?php echo esc_url($button_url['url']) ?>" <?php echo $btn_target; ?>
                                       class="slider_btn btn_hover">
                                        <?php echo esc_html($slide['btn_label']) ?>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($slide['btn2_label'])) : ?>
                                    <a href="<?php echo esc_url($button2_url['url']) ?>" <?php echo $btn2_target; ?>
                                       class="slider_btn btn_hover">
                                        <?php echo esc_html($slide['btn2_label']) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="image_mockup">
                                <?php echo !empty($slide['image1']['id']) ? wp_get_attachment_image($slide['image1']['id'], 'full', false, array( 'class' => 'watch')) : ''; ?>
                                <?php echo !empty($slide['image2']['id']) ? wp_get_attachment_image($slide['image2']['id'], 'full', false, array( 'class' => 'laptop')) : ''; ?>
                                <?php echo !empty($slide['image3']['id']) ? wp_get_attachment_image($slide['image3']['id'], 'full', false, array( 'class' => 'phone')) : ''; ?>
                            </div>
                        </div>
                    </div>
                <?php
                elseif ($slide['style'] == '2' ) :
                    ?>
                    <div class="slider_item slider_item_two elementor-repeater-item-<?php echo $slide['_id'] ?>">
                        <div class="container">
                            <div class="slidet_content_two text-center">
                                <?php echo (!empty($slide['content'])) ? wp_kses_post($slide['content']) : ''; ?>
                                <?php if (!empty($slide['btn_label'])) : ?>
                                    <a href="<?php echo esc_url($button_url['url']) ?>" <?php echo $btn_target; ?>
                                       class="slider_btn btn_hover">
                                        <?php echo esc_html($slide['btn_label']) ?>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($slide['btn2_label'])) : ?>
                                    <a href="<?php echo esc_url($button2_url['url']) ?>" <?php echo $btn_target; ?>
                                       class="slider_btn btn_hover">
                                        <?php echo esc_html($slide['btn2_label']) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="image_mockup">
                                <?php echo !empty($slide['image1']['id']) ? wp_get_attachment_image($slide['image1']['id'], 'full', false, array( 'class' => 'laptop')) : ''; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            }
            ?>
        </section>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    var SSlider = $(".saas_banner_area_three");
                    if( SSlider.length ){
                        SSlider.owlCarousel({
                            loop:<?php echo esc_js($settings['loop']) ?>,
                            margin: 30,
                            items: 1,
                            <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                            animateOut: '<?php echo esc_js($settings['transition_anim']) ?>',
                            autoplay:true,
                            smartSpeed: <?php echo esc_js($settings['slide_speed']) ?>,
                            responsiveClass:true,
                            nav: false,
                            dots: true,
                        })
                    }
                })
            })(jQuery)
        </script>
        <?php
    }

    protected function _register_controls() {

        // ------------------------------ Slider ------------------------------
        $this->start_controls_section(
            'slider', [
                'label' => __( 'Slider', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'style', [
                'label' => __( 'Slide Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Three Images', 'saasland-core' ),
                    '2' => __( 'One Image', 'saasland-core' ),
                ],
                'default' => '2',
            ]
        );

        $repeater->add_control(
            'content', [
                'label' => __( 'Slider content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'btn_divider', [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $repeater->add_control(
            'btn_label', [
                'label' => __( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'btn2_label', [
                'label' => __( 'Button 2 label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn2_url', [
                'label' => __( 'Button 2 URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'image_divider', [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $repeater->add_control(
            'image1', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'image2', [
                'label' => __( 'Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['style' => '1']
            ]
        );

        $repeater->add_control(
            'image3', [
                'label' => __( 'Image 03', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['style' => '1']
            ]
        );

        $repeater->add_control(
            'bg_divider', [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Background Color 01', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'bg_color3', [
                'label' => __( 'Background Color 03', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.slider_item.slider_item_two' => 'background-image: -webkit-linear-gradient(125deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 64%, {{VALUE}} 100%);',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.slider_item' => 'background-image: -webkit-linear-gradient(-120deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 64%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->add_control(
            'slides', [
                'label' => __( 'Slide items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ content }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section();

        // Slider Settings
        $this->start_controls_section(
            'slider_settings', [
                'label' => __( 'Slider Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__( 'True', 'saasland-core' ),
                    'false' => esc_html__( 'False', 'saasland-core' ),
                ],
                'default' => 'true'
            ]
        );

        $this->add_control(
            'slide_speed',
            [
                'label' => __( 'Slide Speed', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000
            ]
        );

        $this->add_control(
            'transition_anim',
            [
                'label' => __( 'Transition Effect', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
                'default' => 'fadeOut'
            ]
        );

        $this->end_controls_section();
    }
}
