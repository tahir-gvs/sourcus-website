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
class Saasland_map extends Widget_Base {

    public function get_name() {
        return 'saasland_map';
    }

    public function get_title() {
        return __( 'Embed Map with Info', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'map_sec', [
                'label' => __( 'Map Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'map_embed_code', [
                'label' => esc_html__( 'Map Embed Code', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Info Items ------------------------------
        $this->start_controls_section(
            'info_items_sec', [
                'label' => esc_html__( 'Info', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'info_items', [
                'label' => esc_html__( 'Info Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Address:'
                    ],
                    [
                        'name' => 'subtitle',
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => '07rd Avenue, Upper East Side, New Yourk:'
                    ],
                    [
                        'name' => 'icon',
                        'label' => __( 'Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-location-pin',
                    ],
                ]
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <section class="map_area">
            <?php echo $settings['map_embed_code'] ?>
            <div class="app_contact_info">
                <span class="triangle"></span>
                <?php
                if(!empty($settings['info_items'])) {
                    foreach ($settings['info_items'] as $info) {
                        ?>
                        <div class="info_item">
                            <i class="<?php echo esc_attr($info['icon']) ?>"></i>
                            <?php if(!empty($info['title'])) : ?>
                                <h6 class="f_p f_size_15 f_500"> <?php echo esc_html($info['title']) ?> </h6>
                            <?php endif; ?>
                            <?php if(!empty($info['subtitle'])) : ?>
                                <p class="f_p f_size_15 f_300"> <?php echo wp_kses_post(nl2br($info['subtitle'])) ?> </p>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
        <?php
    }

}