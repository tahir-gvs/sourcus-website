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
class Saasland_image_carousels extends Widget_Base {

	public function get_name() {
		return 'saasland-screenshots';
	}

	public function get_title() {
		return __( 'Saasland Carousels', 'saasland-core' );
	}

	public function get_icon() {
		return ' eicon-post-slider';
	}

	public function get_style_depends() {
		return [ 'saasland-demo' ];
	}

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
            'section_bg_style',
            [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Carousel Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( '01 Screenshot Carousel', 'saasland-core' ),
                    'style_02' => esc_html__( '02 Masonry Carousel', 'saasland-core' ),
                    'style_03' => esc_html__( '03 Portfolio Slider', 'saasland-core' ),
                    'style_04' => esc_html__( '04', 'saasland-core' ),
                    'style_05' => esc_html__( '05', 'saasland-core' ),
                    'style_06' => esc_html__( '06 Blog Slider', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();

		// ------------------------------  Title Section ------------------------------
		$this->start_controls_section(
			'title_sec', [
				'label' => __( 'Title section', 'saasland-core' ),
			]
		);

		$this->add_control(
			'title_text', [
				'label' => esc_html__( 'Title text', 'saasland-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Awesome app Screenshots'
			]
		);

		$this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
		);

		$this->add_control(
			'subtitle_text', [
				'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_06']
                ]
			]
		);

		$this->end_controls_section(); // End title section


		// ------------------------------  Featured images ------------------------------
		$this->start_controls_section(
			'images_sec', [
				'label' => __( 'Images', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_04']
                ]
			]
		);

		$this->add_control(
			'images', [
				'label' => esc_html__( 'Add images', 'saasland-core' ),
				'type' => Controls_Manager::GALLERY,
			]
		);

		$this->end_controls_section(); // End title section

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
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'site_url', [
                'label' => __( 'URL', 'saasland-core' ),
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
            'carousel5', [
                'label' => __( 'Images with Title', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ site_title }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section(); // Carousels 05

        // ------------------------------ Carousels2 ------------------------------
        $this->start_controls_section(
            'carousels6_sec', [
                'label' => __( 'Carousel Gallery', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_06'
                ]
            ]
        );

        $carousels6 = new \Elementor\Repeater();

        $carousels6->add_control(
            'gallery_items',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $carousels6->add_control(
            'img_badge', [
                'label' => __( 'Image Badge', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $carousels6->add_control(
            'image1', [
                'label' => __( 'Image 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $carousels6->add_control(
            'image2', [
                'label' => __( 'Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'carousels6', [
                'label' => __( 'Images', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ gallery_items }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section(); // Carousels02


		/**
		 * Style Tab
		 * ------------------------------ Style Title ------------------------------
		 */
		$this->start_controls_section(
			'style_title', [
				'label' => __( 'Style section title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'color_title', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .t_color3.mb_20' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section_title h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .u_content h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area_two h2' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '
				    {{WRAPPER}} .t_color3.mb_20,
				    {{WRAPPER}} .section_title h2,
                    {{WRAPPER}} .u_content h2,
                    {{WRAPPER}} .portfolio_area_two h2',
			]
		);
		$this->end_controls_section();


		//------------------------------ Style subtitle ------------------------------
		$this->start_controls_section(
			'style_subtitle', [
				'label' => __( 'Style subtitle', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03']
                ]
			]
		);
		$this->add_control(
			'color_subtitle', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section_title p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .u_content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '
				    {{WRAPPER}} .sec_title p,
				    {{WRAPPER}} .section_title p,
                    {{WRAPPER}} .u_content p',
			]
		);
		$this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_screenshot_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slider_demos_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .blog_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area_two' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio_area_three' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app_screenshot_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slider_demos_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$images = isset($settings['images']) ? $settings['images'] : '';
		$title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( $settings['style'] == 'style_01' ) {
            include 'image-carousels/01_screenshot-carousel.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'image-carousels/02_masonry-carousel.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'image-carousels/03_portfolio_slider.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'image-carousels/04_.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'image-carousels/05_.php';
        }

        if ( $settings['style'] == 'style_06' ) {
            include 'image-carousels/06_.php';
        }
	}

}