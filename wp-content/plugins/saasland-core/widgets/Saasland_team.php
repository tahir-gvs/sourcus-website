<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
//use WP_Query;



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
class Saasland_team extends Widget_Base {

    public function get_name() {
        return 'Saasland_team';
    }

    public function get_title()
    {
        return __('Team', 'saasland-core');
    }

    public function get_icon()
    {
        return ' eicon-person';
    }

    public function get_categories()
    {
        return ['saasland-elements'];
    }

    public function get_script_depends()
    {
        return [ 'slick', 'owl-carousel' ];
    }

    public function get_style_depends()
    {
        return [ 'owl-carousel', 'team' ];
    }

    protected function _register_controls()
    {


        //---------------------------------------- Select Style -----------------------------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two (Carousel)', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __('Title section', 'saasland-core'),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'title_text', [
                'label' => esc_html__('Title text', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'The Experts Team'
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __('Title HTML Tag', 'saasland-core'),
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
                'label' => esc_html__('Subtitle text', 'saasland-core'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => esc_html__('Button', 'saasland-core'),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'btn_title', [
                'label' => esc_html__('Button Title', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Meet All Members',
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__('Button URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'font_color', [
                'label' => __('Normal Text Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .learn_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __('Hover Text Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experts_team_area .learn_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bottom_color', [
                'label' => __('Bottom Border Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .learn_btn:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section(); // End title section

        /// ------------------------------------ Team Section ---------------------------------- ///
        $this->start_controls_section(
            'team_sec',
            [
                'label' => __('Team', 'saasland-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name', [
                'label' => esc_html__('Member Name', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Tom Modie',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'profile_pic', [
                'label' => esc_html__('Profile picture', 'saasland-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'designation', [
                'label' => esc_html__('Designation', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'CTO @ DroitLab',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'fb', [
                'label' => esc_html__('Facebook URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'twitter', [
                'label' => esc_html__('Twitter URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'google_plus', [
                'label' => esc_html__('Google Plus URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'instagram', [
                'label' => esc_html__('Instagram URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'pinterest', [
                'label' => esc_html__('Pinterest URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'linkedin', [
                'label' => esc_html__('Linkedin URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        // Buttons repeater field
        $this->add_control(
            'members', [
                'label' => __('Team Member', 'saasland-core'),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ name }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Team Section


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_title', [
                'label' => __('Style section title', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );
        $this->add_control(
            'color_title', [
                'label' => __('Text Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sec_main_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sec_main_title',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __('Style subtitle', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );
        $this->add_control(
            'color_subtitle', [
                'label' => __('Text Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sec_title p',
            ]
        );

        $this->end_controls_section();


        //---------------------------------------- Style Item Author Name -------------------------------------------
        $this->start_controls_section(
            'item_author_name_color_sec', [
                'label' => __('Author Name', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_author_name_typo_style',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .event_team_slider .item h4',
            ]
        );

        $this->start_controls_tabs(
            'item_author_name_style'
        );

        // Normal Color
        $this->start_controls_tab(
            'item_author_name_normal_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'item_author_name_normal_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_team_slider .item h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover Color
        $this->start_controls_tab(
            'item_author_name_hover_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'item_author_name_hover_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_team_slider .item h4:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        //------------------------------------------- Item Box Hover Gradient Color --------------------------------------------//
        $this->start_controls_section(
            'item_box_bg_color', [
                'label' => __('Item Box Hover Gradient Color', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /// Hover Button Style
        $this->start_controls_tabs(
            'item_box_bg_style_tabs'
        );

        $this->add_control(
            'bg_color', [
                'label' => esc_html__('Color One', 'saasland-core'),
                'type' => Controls_Manager::COLOR,

            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => esc_html__('Color Two', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ex_team_item .hover_content' => 'background-image: -webkit-linear-gradient( 140deg, {{bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .event_team_slider .item .e_team_img' => 'background-image: -webkit-linear-gradient(60deg, {{bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        //------------------------------------------- Section Background --------------------------------------------//
        $this->start_controls_section(
            'sec_bg_style', [
                'label' => __('Style section', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'column', [
                'label' => __('Column', 'saasland-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__('Two', 'saasland-core'),
                    '4' => esc_html__('Three', 'saasland-core'),
                    '3' => esc_html__('Four', 'saasland-core'),
                ],
                'default' => '3',
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __('Section padding', 'saasland-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .experts_team_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .event_team_slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings();
        $members = !empty($settings['members']) ? $settings['members'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        $column = isset($settings['column']) ? $settings['column'] : '3';

        if ( $settings['style'] == 'style_01' ) { ?>
            <section class="experts_team_area sec_pad">
                <div class="container">
                    <div class="sec_title text-center mb_70">
                        <?php if (!empty($settings['title_text'])) : ?>
                        <<?php echo $title_tag; ?> class="sec_main_title f_p f_size_30 l_height30 f_700 t_color3 mb_20
                        wow fadeInUp" data-wow-delay="0.2s">
                        <?php echo $settings['title_text']; ?>
                    </<?php echo $title_tag ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle_text'])) : ?>
                        <?php echo '<p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">' . nl2br(wp_kses_post($settings['subtitle_text'])) . '</p>';
                    endif; ?>
                </div>
                <div class="row">
                    <?php
                    if (is_array($members)) {
                        foreach ($members as $member) {
                            ?>
                            <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                                <div class="ex_team_item wow fadeInUp" data-wow-delay="0.2s">
                                    <img src="<?php echo $member['profile_pic']['url'] ?>"
                                         alt="<?php echo $member['name'] ?>">
                                    <div class="team_content">
                                        <?php if (!empty($member['name'])) : ?>
                                            <a href="#"><h3
                                                        class="f_p f_size_16 f_600 t_color3"> <?php echo esc_html($member['name']) ?> </h3>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!empty($member['designation'])) : ?>
                                            <h5> <?php echo esc_html($member['designation']) ?> </h5>
                                        <?php endif; ?>
                                    </div>
                                    <div class="hover_content">
                                        <div class="n_hover_content">
                                            <ul class="list-unstyled">
                                                <?php if (!empty($member['fb']['url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($member['fb']['url']) ?>" <?php saasland_is_external($member['fb']) ?>>
                                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($member['twitter']['url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($member['twitter']['url']) ?>" <?php saasland_is_external($member['twitter']) ?>>
                                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($member['google_plus']['url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo $member['google_plus']['url'] ?>" <?php saasland_is_external($member['google_plus']) ?>>
                                                            <i class="fab fa-google-plus" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($member['instagram']['url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($member['instagram']['url']) ?>" <?php saasland_is_external($member['twitter']) ?>>
                                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($member['pinterest']['url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo $member['pinterest']['url'] ?>" <?php saasland_is_external($member['pinterest']) ?>>
                                                            <i class="fab fa-pinterest" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($member['linkedin']['url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo $member['linkedin']['url'] ?>" <?php saasland_is_external($member['linkedin']) ?>>
                                                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                            </ul>
                                            <div class="br"></div>
                                            <?php if (!empty($member['name'])) : ?>
                                                <a href="#"><h3
                                                            class="f_p f_size_16 f_600 w_color"> <?php echo esc_html($member['name']) ?> </h3>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($member['designation'])) : ?>
                                                <h5> <?php echo esc_html($member['designation']) ?> </h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    if (!empty($settings['btn_title'])) : ?>
                        <div class="col-lg-12 text-center">
                            <a href="<?php echo esc_url($settings['btn_url']['url']) ?>" <?php saasland_is_external($settings['btn_url']) ?>
                               class="learn_btn wow fadeInLeft" data-wow-delay="0.2s">
                                <?php echo esc_html($settings['btn_title']); ?>
                                <i class="ti-arrow-right"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
                </div>
            </section>
            <?php
        }
        elseif ( $settings['style'] == 'style_02' ) { ?>

            <div class="event_team_slider owl-carousel">
                <?php
                if ( !empty( $members ) ) {
                    foreach ( $members as $member ) { ?>
                        <div class="item">
                            <div class="e_team_img">
                                <?php
                                if (!empty( $member['profile_pic']['id'] ) ) {
                                    echo wp_get_attachment_image( $member['profile_pic']['id'], 'full' );
                                } ?>
                                <ul class="list-unstyled">
                                    <?php
                                    if ( !empty( $member['twitter']['url'] ) ) {
                                        echo '<li><a href="' . esc_url($member['twitter']['url'] ) . '"><i class="social_twitter"></i></a></li>';
                                    }

                                    if ( !empty( $member['fb']['url'] ) ) {
                                        echo '<li><a href="' . esc_url($member['fb']['url']) . '"><i class="social_facebook"></i></a></li>';
                                    }

                                    if ( !empty( $member['linkedin']['url'] ) ) {
                                        echo '<li><a href="' . esc_url( $member['linkedin']['url'] ) . '"><i class="social_linkedin"></i></a></li>';
                                    }

                                    if ( !empty( $member['google_plus']['url'] ) ) {
                                        echo '<li><a href="' . esc_url( $member['google_plus']['url'] ) . '"><i class="social_googleplus"></i></a></li>';
                                    }

                                    if ( !empty ($member['instagram']['url'] ) ) {
                                        echo '<li><a href="' . esc_url($member['instagram']['url']) . '"><i class="social_instagram"></i></a></li>';
                                    }

                                    if ( !empty( $member['pinterest']['url'] ) ) {
                                        echo '<li><a href="' . esc_url($member['pinterest']['url']) . '"><i class="social_pinterest"></i></a></li>';
                                    } ?>
                                </ul>
                            </div>
                            <?php
                            if ( !empty( $member['name'] ) ) {
                                echo '<a href="#"><h4>' . esc_html( $member['name'] ) . '</h4></a>';
                            }

                            if ( !empty( $member['designation'] ) ) {
                                echo '<p>' . esc_html( $member['designation'] ) . '</p>';
                            } ?>
                        </div>
                        <?php
                    }
                } ?>
            </div>

            <script>
                ;(function ($) {
                    "use strict";
                    $(document).ready(function () {
                        function EventSlider() {
                            var event_slider = $(".event_team_slider");
                            if (event_slider.length) {
                                event_slider.owlCarousel({
                                    loop: true,
                                    margin: 25,
                                    items: 3,
                                    nav: false,
                                    autoplay: false,
                                    smartSpeed: 2000,
                                    responsiveClass: true,
                                    responsive: {
                                        0: {
                                            items: 1,
                                        },
                                        576: {
                                            items: 2,
                                        },
                                        1199: {
                                            items: 3,
                                        }
                                    },
                                })
                            }
                        }
                        EventSlider();
                    });
                })(jQuery);
            </script>
            <?php
        }
    }
}