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
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_active_color', [
                'label' => __( 'Active Filter Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item.active, .portfolio_filter .work_portfolio_item:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item.active:before, .portfolio_filter .work_portfolio_item:hover:before' => 'background: {{VALUE}}',
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
        <section class="<?php echo ($settings['is_full_width'] == 'yes' ) ? 'portfolio_fullwidth_area' : 'portfolio_area'; ?>">
            <?php echo ($settings['is_full_width'] == 'yes' ) ? '' : '<div class="container">'; ?>

            <div id="portfolio_filter" class="portfolio_filter mb_50">
                <?php if(!empty($settings['all_label'])) : ?>
                    <div data-filter="*" class="work_portfolio_item active">
                        <?php echo esc_html($settings['all_label']); ?>
                    </div>
                <?php endif; ?>
                <?php
                if(is_array($portfolio_cats)) {
                    foreach ($portfolio_cats as $portfolio_cat) { ?>
                        <div data-filter=".<?php echo $portfolio_cat->slug ?>" class="work_portfolio_item">
                            <?php echo $portfolio_cat->name ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <?php echo ($settings['is_full_width'] == 'yes' ) ? '<div class="container-fluid pl-0 pr-0">' : ''; ?>

            <?php
            if($settings['style'] == 'hover' ) :
                ?>
                <div class="row portfolio_gallery <?php echo ($settings['is_full_width'] == 'yes' ) ? 'ml-0 mr-0' : 'mb_30'; ?>" id="work-portfolio">
                    <?php
                    while ($portfolios->have_posts()) : $portfolios->the_post();
                        $cats = get_the_terms(get_the_ID(), 'portfolio_cat' );
                        $cat_slug = '';
                        if(is_array($cats)) {
                            foreach ($cats as $cat) {
                                $cat_slug .= $cat->slug.' ';
                            }
                        }
                        $column = !empty($settings['column']) ? $settings['column'] : '6';
                        if($settings['is_full_width'] == 'yes' ) {
                            switch ($column) {
                                case '6':
                                    $image_size = 'saasland_960x500';
                                    $title_size = '20';
                                    break;
                                case '4':
                                    $image_size = 'saasland_640x450';
                                    $title_size = '16';
                                    break;
                                case '3':
                                    $image_size = 'saasland_480x450';
                                    $title_size = '16';
                                    break;
                            }
                        }else {
                            switch ($column) {
                                case '6':
                                    $image_size = 'saasland_570x400';
                                    $title_size = '20';
                                    break;
                                case '4':
                                    $image_size = 'saasland_370x400';
                                    $title_size = '16';
                                    break;
                                case '3':
                                    $image_size = 'saasland_270x350';
                                    $title_size = '16';
                                    break;
                            }
                        }
                        ?>
                        <div class="col-sm-<?php echo esc_attr($column.' ' ); echo esc_attr($cat_slug); echo ($settings['is_full_width'] == 'yes' ) ? ' p0' : ' mb-30'; ?> portfolio_item">
                            <div class="portfolio_img">
                                <?php the_post_thumbnail($image_size) ?>
                                <div class="hover_content <?php echo ($column == '6' ) ? '' : 'h_content_two'; ?>">
                                    <a href="<?php the_post_thumbnail_url() ?>" class="img_popup leaf"><i class="ti-plus"></i></a>
                                    <div class="portfolio-description leaf">
                                        <a href="<?php the_permalink() ?>" class="portfolio-title"><h3 class="f_500 f_size_<?php echo esc_attr($title_size) ?> f_p"> <?php the_title() ?> </h3></a>
                                        <div class="links">
                                            <?php
                                            if($cats) {
                                                $cat_i = 0;
                                                $cat_count = count($cats);
                                                foreach ($cats as $cat) {
                                                    $separator = '';
                                                    if (++$cat_i != $cat_count) {
                                                        $separator .= ', ';
                                                    }
                                                    echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php

            elseif($settings['style'] == 'normal' ):
                ?>
                <div class="row portfolio_gallery <?php echo ($settings['is_full_width'] == 'yes' ) ? 'ml-0 mr-0' : 'mb-50'; ?>" id="work-portfolio">
                    <?php
                    while ($portfolios->have_posts()) : $portfolios->the_post();
                        $cats = get_the_terms(get_the_ID(), 'portfolio_cat' );
                        $cat_slug = '';
                        if(is_array($cats)) {
                            foreach ($cats as $cat) {
                                $cat_slug .= $cat->slug.' ';
                            }
                        }
                        $column = !empty($settings['column']) ? $settings['column'] : '6';
                        if($settings['is_full_width'] == 'yes' ) {
                            switch ($column) {
                                case '6':
                                    $image_size = 'saasland_960x500';
                                    $title_size = '20';
                                    break;
                                case '4':
                                    $image_size = 'saasland_640x450';
                                    $title_size = '16';
                                    break;
                                case '3':
                                    $image_size = 'saasland_480x450';
                                    $title_size = '16';
                                    break;
                            }
                        }else {
                            switch ($column) {
                                case '6':
                                    $image_size = 'saasland_570x400';
                                    $title_size = '20';
                                    break;
                                case '4':
                                    $image_size = 'saasland_370x400';
                                    $title_size = '16';
                                    break;
                                case '3':
                                    $image_size = 'saasland_270x350';
                                    $title_size = '16';
                                    break;
                            }
                        }
                        ?>
                        <div class="col-sm-<?php echo esc_attr($column) ?> portfolio_item <?php echo esc_attr($cat_slug) ?> mb_50">
                            <div class="portfolio_img">
                                <a href="<?php the_post_thumbnail_url() ?>" class="img_popup">
                                    <?php the_post_thumbnail($image_size, array( 'class' => 'img_rounded')) ?>
                                </a>
                                <div class="portfolio-description">
                                    <a href="<?php the_permalink() ?>" class="portfolio-title">
                                        <h3 class="f_500 f_size_20 f_p mt_30"> <?php the_title() ?> </h3>
                                    </a>
                                    <div class="links">
                                        <?php
                                        if($cats) {
                                            $cat_i = 0;
                                            $cat_count = count($cats);
                                            foreach ($cats as $cat) {
                                                $separator = '';
                                                if (++$cat_i != $cat_count) {
                                                    $separator .= ', ';
                                                }
                                                echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php
            endif;

            echo ($settings['is_full_width'] == 'yes' ) ? '</div>' : ''; ?>
        </section>
        <?php
    }

}