<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;


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
class Saasland_featured_image extends Widget_Base {

    public function get_name() {
        return 'saasland_featured_image';
    }

    public function get_title() {
        return __( 'Image with Shape', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
            ]
        );

        // Style
        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style 01 (single image)', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style 02 (single image)', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style 03 (two images)', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style 04 (single image)', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style 05 (two images)', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ---------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Image', 'saasland-core' ),
            ]
        );

        /// --------------- Images ----------------
        $this->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'image2', [
                'label' => __( 'Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => ['style_03', 'style_05']
                ]
            ]
        );

        $this->add_control(
            'bg_shape', [
                'label' => __( 'Background Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/new_shape.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_03', 'style_04', 'style_05']
                ]
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'shape_section', [
                'label' => __( 'Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['style' => ['style_01', 'style_02']]
            ]
        );

        // Shape 01
        $this->add_control(
            'is_shape1',
            [
                'label' => __( 'Shape 01', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape1_color', [
                'label'     => esc_html__( 'Shape 1 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .seo_features_img .round_circle' => 'background: {{VALUE}};',
                ),
                'condition' => [
                    'is_shape1' => ['yes'],
                ],
            ]
        );

        // Shape 2
        $this->add_control(
            'is_shape2',
            [
                'label' => __( 'Shape 2', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape2_color', [
                'label'     => esc_html__( 'Shape 2 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .round_circle.two' => 'background: {{VALUE}};',
                ),
                'condition' => [
                    'is_shape2' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        if($settings['style'] == 'style_01' || $settings['style'] == 'style_02' ) {
            ?>
            <div class="seo_features_img <?php echo ($settings['style'] == 'style_02' ) ? 'seo_features_img_two' : ''; ?>">
                <?php if ($settings['is_shape1'] == 'yes' ) : ?>
                    <div class="round_circle"></div>
                <?php endif; ?>
                <?php if ($settings['is_shape2'] == 'yes' ) : ?>
                    <div class="round_circle two"></div>
                <?php endif; ?>
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
            </div>
            <?php
        }
        elseif($settings['style'] == 'style_03' ) {
            if(!empty($settings['bg_shape']['url'])) :
                ?>
                <style>
                    .stratup_service_img .shape {
                        background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll left 0;
                    }
                </style>
            <?php endif; ?>
            <div class="stratup_service_img">
                <div class="shape"></div>
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full', '', array( 'class' => 'laptop_img')) ?>
                <?php echo wp_get_attachment_image($settings['image2']['id'], 'full', '', array( 'class' => 'phone_img')) ?>
            </div>
            <?php
        }
        elseif($settings['style'] == 'style_04' ) {
            if(!empty($settings['image']['url'])) :
                ?>
                <style>
                    .payment_features_img:before {
                        content: "";
                        background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center left;
                    }
                </style>
            <?php endif; ?>
            <div class="payment_features_img">
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
            </div>
            <?php
        }
        elseif($settings['style'] == 'style_05' ) {
            if(!empty($settings['bg_shape']['url'])) : ?>
                <style>
                    .startup_tab_img:before {
                        background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center 0/contain;
                    }
                </style>
                <?php
            endif;
            ?>
            <div class="startup_tab_img">
                <div class="web_img">
                    <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
                </div>
                <div class="phone_img">
                    <?php echo wp_get_attachment_image($settings['image2']['id'], 'full' ); ?>
                </div>
            </div>
            <?php
        }
    }
}