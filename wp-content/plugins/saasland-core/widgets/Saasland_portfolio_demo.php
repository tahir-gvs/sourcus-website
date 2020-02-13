<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use WP_Query;

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
class Saasland_portfolio extends Widget_Base {

    public function get_name() {
        return 'saasland_portfolio';
    }

    public function get_title() {
        return __( 'Filterable Portfolio', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'imagesloaded', 'isotope' ];
    }

    protected function _register_controls() {

        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All'
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 8
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'description' => esc_html__( '‘ASC‘ – ascending order from lowest to highest values (1, 2, 3; a, b, c). ‘DESC‘ – descending order from highest to lowest values (3, 2, 1; c, b, a).', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Name (by post slug)',
                    'date' => 'Date',
                    'rand' => 'Random',
                    'comment_count' => 'Comment Count',
                ],
                'default' => 'none'
            ]
        );

        $this->add_control(
            'exclude', [
                'label' => esc_html__( 'Exclude Portfolio', 'saasland-core' ),
                'description' => esc_html__( 'Enter the portfolio post ID to hide. Input the multiple ID with comma separated', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();


        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_layout', [
                'label' => __( 'Layout', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover' => esc_html__( 'Hover Contents', 'saasland-core' ),
                    'normal' => esc_html__( 'Normal Contents', 'saasland-core' ),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'is_full_width', [
                'label' => __( 'Full Width', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio_fullwidth_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'portfolio_color', [
                'label' => __( 'Colors', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'filter_color', [
                'label' => __( 'Filter Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();

        $portfolios = new WP_Query(array(
            'post_type'     => 'portfolio',
            'posts_per_page'=> $settings['show_count'],
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
            'post__not_in' => !empty($settings['exclude']) ? explode( ',', $settings['exclude']) : ''
        ));

        $portfolio_cats = get_terms(array(
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => true
        ));

        ?>
        <section class="demo_area sec_pad" id="demo">
            <div class="bg_demo"></div>
            <div class="container custom_container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title text-center">
                            <div class="number wow fadeInUp" data-wow-delay="200ms">25<sup>+</sup></div>
                            <h2 class=" wow fadeInUp" data-wow-delay="400ms">Stunning Demos</h2>
                            <p>All Home page demos, inner pages  everything is included in the purchase! You can import use existing demos, pages. You can create new pages using element blocks included. You can also mix elements from different demos to your own need or liking.</p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav class="filtering_demos wow fadeInUp" data-wow-delay="500ms">
                            <div class="nav nav-tabs" id="nav-tab">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#home_demos">Home Demos <span>25</span></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#utility_pages">Utility Pages <span>7</span></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#inner_pages">Inner Pages <span>11</span></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#portfolio_pages">Portfolio <span>21</span></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#shop_pages">Shop Pages<span>5</span></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#blog_pages">Blog Pages<span>4</span></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#rtl_pages">RTL</a>
                            </div>
                        </nav>
                    </div>
                </div>




                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="home_demos">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo1.png" alt="">
                                        <a href="https://saasland.droitthemes.com" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com" target="_blank">
                                        <h6>Design Studio</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo2.png" alt="">
                                        <span class="new">New</span>
                                        <a href="https://saasland2.droitthemes.com/home-hosting/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland2.droitthemes.com/home-hosting/" target="_blank">
                                        <h6>Hosting</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo3.png" alt="">
                                        <span class="new">New</span>
                                        <a href="https://saasland2.droitthemes.com/home-erp/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland2.droitthemes.com/home-erp/" target="_blank">
                                        <h6>ERP</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo4.png" alt="">
                                        <span class="new">New</span>
                                        <a href="https://saasland2.droitthemes.com/home-pos/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland2.droitthemes.com/home-pos/" target="_blank">
                                        <h6>POS</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo6.png" alt="">
                                        <a href="https://saasland.droitthemes.com/home-mail/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-mail/" target="_blank">
                                        <h6>Email Client</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo7.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-cloud/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-cloud/" target="_blank">
                                        <h6>Cloud Based Saas</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo8.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-prototyping/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-prototyping/" target="_blank">
                                        <h6>Prototype & Wireframing</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo9.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-marketing/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-marketing/" target="_blank">
                                        <h6>Digital Marketing</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo10.jpg" alt="">
                                        <a href="https://onepage.saasland.droitthemes.com/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://onepage.saasland.droitthemes.com/" target="_blank">
                                        <h6>Mobile App (One Page)</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo11.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-software-dark/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-software-dark/" target="_blank">
                                        <h6>Software (Dark)</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo12.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-app-showcase/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-app-showcase/" target="_blank">
                                        <h6>App Showcase</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo13.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-startup/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-startup/" target="_blank">
                                        <h6>Startup</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo14.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-payment-processing/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-payment-processing/" target="_blank">
                                        <h6>Payment Processing</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo15.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-saas/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-saas/" target="_blank">
                                        <h6>Classic Saas</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo16.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/accounts-billing/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/accounts-billing/" target="_blank">
                                        <h6>Accounts & Billing</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo17.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-company/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-company/" target="_blank">
                                        <h6>Home Company</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo18.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-crm-software/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-crm-software/" target="_blank">
                                        <h6>CRM Software</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo19.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-hr-management/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-hr-management/" target="_blank">
                                        <h6>HR Management</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo20.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-digital-agency/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-digital-agency/" target="_blank">
                                        <h6>Digital Agency</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo21.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-saas-2-slider/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-saas-2-slider/" target="_blank">
                                        <h6>Saas 2 (Slider)</h6>
                                    </a>
                                </div>
                            </div>
                            <!--
                                                        <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                                            <div class="portfolio-image">
                                                                <div class="img">
                                                                    <img src="img/home/demo22.jpg" alt="">
                                                                    <a href="#" target="_blank" class="overlay_link"></a>
                                                                </div>
                                                                <a href="#" target="_blank">
                                                                    <h6>Design Studio</h6>
                                                                </a>
                                                            </div>
                                                        </div>
                            -->
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/demo23.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-project-management/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-project-management/" target="_blank">
                                        <h6>Project Management</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="utility_pages">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p1.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/jobs/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/jobs/" target="_blank">
                                        <h6>Jobs</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p2.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/job/senior-web-designer-team-lead/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/job/senior-web-designer-team-lead/" target="_blank">
                                        <h6>Job Details</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p7.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/job-apply-form/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/job-apply-form/" target="_blank">
                                        <h6>Job Apply</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p3.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/sign-in/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/sign-in/" target="_blank">
                                        <h6>Sign In</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p4.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/sign-up/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/sign-up/" target="_blank">
                                        <h6>Sign Up</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p5.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/alerts/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/alerts/" target="_blank">
                                        <h6>Alerts</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/home/utility_p6.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/faqs/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/faqs/" target="_blank">
                                        <h6>Faq</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="inner_pages">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_1.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/about-us/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/about-us/" target="_blank">
                                        <h6>About</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_02.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/our-services-01/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/our-services-01/" target="_blank">
                                        <h6>Services 01</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_04.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/business-analytics/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/business-analytics/" target="_blank">
                                        <h6>Services 02</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_03.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/what-we-offer/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/what-we-offer/" target="_blank">
                                        <h6>Services 03</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_09.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/our-process/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/our-process/" target="_blank">
                                        <h6>Our Process</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_07.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/our-pricing/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/our-pricing/" target="_blank">
                                        <h6>Our Pricing</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_08.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/team/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/team/" target="_blank">
                                        <h6>Team</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_15.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/contact/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/contact/" target="_blank">
                                        <h6>Contact 01</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_16.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/our-pricing/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/our-pricing/" target="_blank">
                                        <h6>Contact 02</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_37.jpg" alt="">
                                        <a href="http://saasland.droitthemes.com/404" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="http://saasland.droitthemes.com/404" target="_blank">
                                        <h6>404-01</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_38.jpg" alt="">
                                        <a href="https://onepage.saasland.droitthemes.com/404" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://onepage.saasland.droitthemes.com/404" target="_blank">
                                        <h6>404-02</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="portfolio_pages">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/demo_18.png" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-grid-2-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-grid-2-columns/" target="_blank">
                                        <h6>portfolio 01</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_19.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-grid-3-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-grid-3-columns/" target="_blank">
                                        <h6>portfolio 02</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_24.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-grid-4-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-grid-4-columns/" target="_blank">
                                        <h6>portfolio 03</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_22.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-grid-2-column-normal/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-grid-2-column-normal/" target="_blank">
                                        <h6>portfolio 04</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_20.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-grid-3-column-normal/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-grid-3-column-normal/" target="_blank">
                                        <h6>portfolio 05</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_21.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-grid-4-column-normal/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-grid-4-column-normal/" target="_blank">
                                        <h6>portfolio 06</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_22.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-masonry-2-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-masonry-2-columns/" target="_blank">
                                        <h6>portfolio 07</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_23.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-masonry-3-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-masonry-3-columns/" target="_blank">
                                        <h6>portfolio 08</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_24.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-masonry-4-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-masonry-4-columns/" target="_blank">
                                        <h6>portfolio 09</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_26.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-normal-masonry-4-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-normal-masonry-4-columns/" target="_blank">
                                        <h6>portfolio 10</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_25.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-fullwidth-2-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-fullwidth-2-columns/" target="_blank">
                                        <h6>portfolio 11</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_26.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-fullwidth-3-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-fullwidth-3-columns/" target="_blank">
                                        <h6>portfolio 12</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_27.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-fluid-4-column/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-fluid-4-column/" target="_blank">
                                        <h6>portfolio 13</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_28.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-fluid-normal-2-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-fluid-normal-2-columns/" target="_blank">
                                        <h6>portfolio 14</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/inner-page/demo_26.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-fluid-normal-3-column/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-fluid-normal-3-column/" target="_blank">
                                        <h6>portfolio 15</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_29.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-fluid-normal-4-column/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-fluid-normal-4-column/" target="_blank">
                                        <h6>portfolio 16</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_30.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio/proin-tortor-orcus/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio/proin-tortor-orcus/" target="_blank">
                                        <h6>portfolio 17</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_31.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio-normal-masonry-4-columns/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio-normal-masonry-4-columns/" target="_blank">
                                        <h6>portfolio 18</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_32.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio/double-exposure/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio/double-exposure/" target="_blank">
                                        <h6>portfolio 19</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_33.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio/cras-commodo-ets/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio/cras-commodo-ets/" target="_blank">
                                        <h6>portfolio 20</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/portfolio/portfolio_34.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/portfolio/cozy-sphinx-waves/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/portfolio/cozy-sphinx-waves/" target="_blank">
                                        <h6>portfolio 21</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shop_pages">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/shop/demo_03.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/shop/?view=list" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/shop/?view=list" target="_blank">
                                        <h6>Product List View</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/shop/demo_01.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/shop/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/shop/" target="_blank">
                                        <h6>Product Grid View</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/shop/demo_05.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/cart/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/cart/" target="_blank">
                                        <h6>Shopping Cart</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/shop/demo_07.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/checkout/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/checkout/" target="_blank">
                                        <h6>Checkout</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/shop/demo_06.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/wishlist/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/wishlist/" target="_blank">
                                        <h6>Wishlist</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/shop/demo_08.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/home-shop/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/home-shop/" target="_blank">
                                        <h6>Digital Shop</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="blog_pages">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/demo_02.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/blog/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/blog/" target="_blank">
                                        <h6>Blog List</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/demo_01.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/blog-grid/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/blog-grid/" target="_blank">
                                        <h6>Blog Grid</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/demo_04.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/blog-masonry/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/blog-masonry/" target="_blank">
                                        <h6>Blog Masonry</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/demo_05.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/interdum-luctus-accusamus-habitant-error-nostra-nostrum/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/interdum-luctus-accusamus-habitant-error-nostra-nostrum/" target="_blank">
                                        <h6>Blog Single</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rtl_pages">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/r1.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/rtl/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/rtl/" target="_blank">
                                        <h6>RTL Home</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/r2.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/rtl/blog/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/rtl/blog/" target="_blank">
                                        <h6>RTL Blog</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/r3.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/rtl/blog-grid/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/rtl/blog-grid/" target="_blank">
                                        <h6>RTL Blog Grid</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12 portfolio-item nav-home">
                                <div class="portfolio-image">
                                    <div class="img">
                                        <img src="img/blog/r4.jpg" alt="">
                                        <a href="https://saasland.droitthemes.com/rtl/2019/01/14/أحيانا-الحزن-اتهم-جاره-من-سكان-هو-خطأ-لد/" target="_blank" class="overlay_link"></a>
                                    </div>
                                    <a href="https://saasland.droitthemes.com/rtl/2019/01/14/أحيانا-الحزن-اتهم-جاره-من-سكان-هو-خطأ-لد/" target="_blank">
                                        <h6>RTL Blog Single</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}