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
class Saasland_gallery_carousel extends Widget_Base {

    public function get_name() {
        return 'saasland_gallery_carousel';
    }

    public function get_title() {
        return __( 'Auto Gallery Carousel', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'slick' ];
    }

    public function get_style_depends() {
        return [ 'saasland-demo', 'slick', 'slick-theme' ];
    }

    protected function _register_controls() {

        // ------------------------------ Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'upper_title', [
                'label' => __( 'Upper Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '250 <sup>+</sup>',
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section();


        // ------------------------------ Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section();


        // ------------------------------ Carousels ------------------------------
        $this->start_controls_section(
            'carousels_sec', [
                'label' => __( 'Carousel Gallery', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gallery_items',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $repeater->add_control(
            'gallery_images', [
                'label' => __( 'Gallery Image', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->add_control(
            'carousels', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ gallery_items }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section(); // Carousels


        // ------------------------------ Carousels2 ------------------------------
        $this->start_controls_section(
            'carousels2_sec', [
                'label' => __( 'Carousel Gallery', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gallery_items',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $repeater->add_control(
            'img_badge', [
                'label' => __( 'Image Badge', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'gallery_images', [
                'label' => __( 'Gallery Image', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->add_control(
            'carousels2', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ gallery_items }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section(); // Carousels02


        // ------------------------------ Image Carousels 03  ------------------------------
        $this->start_controls_section(
            'images_sec', [
                'label' => __( 'Image Carousel', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'images_items',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $repeater->add_control(
            'image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'images', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ images_items }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section(); // Carousels 03


        // ------------------------------ Image Carousels 05  ------------------------------
        $this->start_controls_section(
            'carousels5_sec', [
                'label' => __( 'Carousel', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_05',
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'site_title', [
                'label' => __( 'Site Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'site_url', [
                'label' => __( 'Site URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'carousels5', [
                'label' => __( 'Screenshots With Title', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ site_title }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section(); // Carousels 05

        // ---------------------------------------- Upper Title Style  ------------------------------
        $this->start_controls_section(
            'style_upper_title_sec',
            [
                'label' => __( 'Upper Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'style_upper_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .u_content h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'style_upper_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .u_content h3',
            ]
        );

        $this->end_controls_section(); // End Upper Title Style


        // ----------------------------------------  Title Style  ------------------------------
        $this->start_controls_section(
            'style_title_sec',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section_title h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .u_content h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area_two h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'style_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .section_title h2,
                    {{WRAPPER}} .u_content h2,
                    {{WRAPPER}} .portfolio_area_two h2
                    '
            ]
        );

        $this->end_controls_section(); // End Title Style


        // ----------------------------------------  Subtitle Style  ------------------------------
        $this->start_controls_section(
            'style_subtitle_sec',
            [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'style_subtitle_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section_title p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .u_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'style_subtitle_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                        {{WRAPPER}} .section_title p,
                        {{WRAPPER}} .u_content p
                        '
            ]
        );

        $this->end_controls_section(); // End Title Style


        // ---------------------------------------- Image Badge Style  ------------------------------
        $this->start_controls_section(
            'style_img_badge_sec',
            [
                'label' => __( 'Image Badge', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  'style_02',
                ]
            ]
        );

        $this->add_control(
            'style_img_badge_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_slider .item .round .text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'style_img_badge_text_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .blog_slider .item .round .text'
            ]
        );

        $this->add_control(
            'style_img_badge_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_slider .item .round' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Image Badge Style


        // ---------------------------------------- Section Background Style ------------------------------
        $this->start_controls_section(
            'section_bg_style',
            [
                'label' => __( 'Section Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Carousel Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One ( Slider Area )', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two ( Blog Slider )', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three ( Portfolio Slider )', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style Five', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider_demos_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .blog_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area_two' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area_three' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __( 'Section Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slider_demos_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings();

        if ( $settings['style'] == 'style_01' ) {
            include 'demo-carousel/part-one.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'demo-carousel/part-two.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'demo-carousel/part-three.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'demo-carousel/part-four.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'demo-carousel/part-five.php';
        }
    }
}


