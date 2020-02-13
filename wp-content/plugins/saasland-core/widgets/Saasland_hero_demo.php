<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;


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
class Saasland_hero_demo extends Widget_Base {

    public function get_name() {
        return 'saasland_hero_demo';
    }

    public function get_title() {
        return __( 'Hero Demo', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends()
    {
        return [ 'saasland-demo' ];
    }
    public function get_script_depends() {
        return [ 'parallax' ];
    }


    protected function _register_controls() {

        // ---------------------------------------- Title ---- ----------------------------------//
        $this->start_controls_section(
            'title_sec',
            [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section(); // End Title


        //------------------------------------- Subtitle ------------------------------------------//
        $this->start_controls_section(
            'subtitle_sec',
            [
                'label' => __( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section(); // End Subtitle


        // ----------------------------------  Slide Images ----------------------------------//
        $this->start_controls_section(
            'feature_images_sec',
            [
                'label' => __( 'Feature Images', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_items',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $repeater->add_control(
            'feature_image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_responsive_control(
            'horizontal',
            [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'vertical', [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'feature_images', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ feature_items }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Features Images

        // ------------------------------------  Buttons ---------------------------------- //
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $buttons = new \Elementor\Repeater();

        $buttons->add_control(
            'btn_label', [
                'label' => __( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $buttons->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $buttons->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $buttons->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );
        $buttons->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );
        $buttons->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );
        $buttons->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}',
                )
            ]
        );
        $buttons->end_controls_tab();
        /// Hover Button Style
        $buttons->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $buttons->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );
        $buttons->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );
        $buttons->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '.header_area.navbar_fixed {{WRAPPER}} .nav_right_btn {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}',
                )
            ]
        );
        $buttons->end_controls_tab();

        $buttons->end_controls_tabs();

        $buttons->add_control(
            'btn_padding_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $buttons->add_responsive_control(
            'btn_padding',
            [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_control(
            'btn_border_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $buttons->add_responsive_control(
            'btn_border_radius',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Buttons repeater field
        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ btn_label }}}',
                'fields' => $buttons->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .banner_text h2',
            ]
        );

        $this->end_controls_section(); // End Title

         //------------------------------ Style Subtitle ------------------------------

        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style_color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'style_typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .banner_text p',
            ]
        );

        $this->end_controls_section(); // End Subtitle

        /**
         * Hero Default Shape Images Options
         **/
        //------------------------------ Shape Images Home dark  ------------------------------//
        $this->start_controls_section(
            'bg_shape_images_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'shape1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/circle-2.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape5', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape6', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_06.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape7', [
                'label' => esc_html__( 'Image Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_07.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape8', [
                'label' => esc_html__( 'Image Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/shape_08.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape9', [
                'label' => esc_html__( 'Image Nine', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-demo/dot.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        //------------------------------ Background Section  ------------------------------//
        $this->start_controls_section(
            'section_background', [
                'label' => __( 'Section Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();
        ?>
        <section class="banner_area d-flex align-items-center" id="apps_craft_animation">
            <div class="image_mockup">
                <?php
                $delay = 0.2;
                $depth = 0.5;
                if ( !empty($settings['feature_images'] )) {
                    foreach (  $settings['feature_images'] as $index=> $feature_image ) {
                        switch ($index) {
                            case 0:
                                $align_class = 'slideInnew';
                                break;
                            case 1:
                                $align_class = 'zoomIn';
                                break;
                            default:
                                $align_class = 'slideInnew';
                                break;
                        }
                        ?>
                        <div class="one_img wow <?php echo esc_attr($align_class) ?> elementor-repeater-item-<?php echo $feature_image['_id'] ?>" data-wow-delay="<?php echo esc_attr( $delay ) ?>s">
                            <div class="layer layer2" data-depth="<?php echo esc_attr( $depth ) ?>">
                                <img src="<?php echo esc_url( $feature_image['feature_image']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                            </div>
                        </div>
                        <?php
                        $delay = $delay + 0.2;
                        $depth = $depth + 0.5;
                    }
                }

                if ( !empty( $settings['shape1']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": 0, "y": 100, "rotateZ":0}'>
                        <img class="faa-spin animated" src="<?php echo esc_url( $settings['shape1']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                if ( !empty( $settings['shape2']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": -180, "y": 80, "rotateY":2000}'>
                        <img src="<?php echo esc_url( $settings['shape2']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                if ( !empty( $settings['shape3']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": 250, "y": 160, "rotateZ":500}'>
                        <img src="<?php echo esc_url( $settings['shape3']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                 if ( !empty( $settings['shape4']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": 20, "y": -100, "rotateZ":0}'>
                        <img src="<?php echo esc_url( $settings['shape4']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                if ( !empty( $settings['shape5']['url'] ) ) : ?>
                    <div class="one_img">
                        <img src="<?php echo esc_url( $settings['shape5']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                 if ( !empty( $settings['shape6']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": 0, "y": 100, "rotateZ":0}'>
                        <img src="<?php echo esc_url( $settings['shape6']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                if ( !empty( $settings['shape7']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": 250, "y": 360, "rotateZ":500}'>
                        <img src="<?php echo esc_url( $settings['shape7']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                 if ( !empty( $settings['shape8']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": -180, "y": 80, "rotateY":2000}'>
                        <img src="<?php echo esc_url( $settings['shape8']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif;
                if ( !empty( $settings['shape9']['url'] ) ) : ?>
                    <div class="one_img" data-parallax='{"x": -10, "y": 80, "rotateY":0}'>
                        <img src="<?php echo esc_url( $settings['shape9']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                    </div>
                <?php endif; ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="banner_text">
                            <?php
                            echo !empty( $settings['title'] ) ? '<h2 class="wow fadeInUp" data-wow-delay="0.2s">' . esc_html( $settings['title'] ) . '</h2>' : '';
                            echo !empty( $settings['subtitle'] ) ? '<p class="wow fadeInUp" data-wow-delay="0.4s">' . esc_html( $settings['subtitle'] ) . '</p>' : '';

                            if ( !empty($settings['buttons'] )) {
                                foreach (  $settings['buttons'] as $button ) {
                                    if ( !empty($button['btn_label'] )) : ?>
                                        <a href="<?php echo esc_url( $button['btn_url']['url'] ) ?>" class="dmeo_banner_btn wow fadeInUp scrolls elementor-repeater-item-<?php echo $button['_id'] ?>" data-wow-delay="0.6s"
                                            <?php saasland_is_external( $button['btn_url'] ) ?>>
                                            <?php echo esc_html( $button['btn_label'] ) ?>
                                        </a>
                                    <?php endif;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    if ($( '#apps_craft_animation' ).length > 0 ) {
                        $( '#apps_craft_animation' ).parallax({
                            scalarX: 5.0,
                            scalarY: 0.0,
                        });
                    }
                }); // End Document.ready
            })(jQuery)
        </script>
        <?php
    }
}