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
class Saasland_footer extends Widget_Base {

    public function get_name() {
        return 'saasland_footer';
    }

    public function get_title() {
        return __( 'Website Footer', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        /**
         * Style Tab
         */
        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'bg_image', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/c2a_bg_shape.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_01'],
                ]
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .new_footer_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $opt = get_option( 'saasland_opt' );
        $copyright_text = !empty($opt['copyright_txt']) ? $opt['copyright_txt'] : esc_html__( '© 2018 DroitThemes. All rights reserved', 'saasland' );
        $right_content = !empty($opt['right_content']) ? $opt['right_content'] : '';

        if ($settings['style'] == 'style_01' ) :
            ?>
            <footer class="new_footer_area bg_color">
                <div class="new_footer_top">
                    <?php if (is_active_sidebar( 'footer_widgets')) { ?>
                        <div class="container">
                            <div class="row">
                                <?php dynamic_sidebar( 'footer_widgets' ) ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="footer_bg">
                        <?php if(!empty($opt['footer_obj_1']['url'])) : ?>
                            <div class="footer_bg_one"></div>
                        <?php endif; ?>
                        <?php if(!empty($opt['footer_obj_2']['url'])) : ?>
                            <div class="footer_bg_two"></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="footer_bottom">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-7">
                                <?php echo wp_kses_post(wpautop($copyright_text)); ?>
                            </div>
                            <div class="col-lg-6 col-sm-5 text-right">
                                <?php echo wp_kses_post(wpautop($right_content)) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <?php
        elseif ($settings['style'] == 'style_02' ) : ?>
            <footer class="footer_nine_area">
                <div class="footer_nine_top">
                    <div class="footer_shap left"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="f_widget company_widget pr_100">
                                    <a href="index.html" class="f-logo"><img src="img/logo.png" srcset="img/logo2x.png 2x" alt=""></a>
                                    <p class="f_400 f_p f_size_16 mb-0 l_height28 mt_40">Tickety-boo victoria sponge only a quid I don't want no agro morish bum bag gutted mate up the duff, bloke blag cup of char super bugger all mate.!</p>
                                    <div class="f_social_icon_two mt_30">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-vimeo-alt"></i></a>
                                        <a href="#"><i class="ti-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="f_widget about-widget">
                                    <h3 class="f-title f_500 f_size_16 mb-30">About Us</h3>
                                    <ul class="list-unstyled f_list">
                                        <li><a href="#">Developer</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Investor</a></li>
                                        <li><a href="#">Sitemap</a></li>
                                        <li><a href="#">Jobs</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="f_widget about-widget">
                                    <h3 class="f-title f_500 f_size_16 mb-30">Help &amp; Suport</h3>
                                    <ul class="list-unstyled f_list">
                                        <li><a href="#">Help aand Contact</a></li>
                                        <li><a href="#">Fees</a></li>
                                        <li><a href="#">Security</a></li>
                                        <li><a href="#">App</a></li>
                                        <li><a href="#">Shop</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 pl_100">
                                <div class="f_widget about-widget">
                                    <h3 class="f-title f_500 f_size_16 mb-30">Privacy Contact</h3>
                                    <ul class="list-unstyled f_list">
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Legal Agreement</a></li>
                                        <li><a href="#">Feedback</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer_nine_bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7 align-self-center">
                                <p class="mb-0 f_400">Copyright © 2018 Desing by <a href="#">DroitThemes</a></p>
                            </div>
                            <div class="col-sm-5">
                                <div class="dropdown bootstrap-select flag_selector fit-width"><select class="selectpicker flag_selector" data-width="fit" tabindex="-98">
                                        <option data-content="<span class=&quot;flag-icon flag-icon-us&quot;></span> English">English</option>
                                        <option data-content="<span class=&quot;flag-icon flag-icon-mx&quot;></span> Español">Español</option>
                                        <option data-content="<span class=&quot;flag-icon flag-icon-us&quot;></span> English">Potogal</option>
                                        <option data-content="<span class=&quot;flag-icon flag-icon-mx&quot;></span> Español">Brazil</option>
                                    </select><button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="button" title="English"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner"><span class="flag-icon flag-icon-us"></span> English</div></div> </div></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <?php
        endif;
    }
}