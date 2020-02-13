<?php
/**
 * Plugin Name: Saasland Core
 * Plugin URI: https://themeforest.net/user/droitthemes/portfolio
 * Description: This plugin adds the core features to the Saasland WordPress theme. You must have to install this plugin to get all the features included with the Saasland theme.
 * Version: 2.2.9
 * Author: DroitThemes
 * Author URI: https://themeforest.net/user/droitthemes/portfolio
 * Text domain: saasland-core
 */

if ( !defined( 'ABSPATH') )
    die( '-1');

// Saasland Core Directories
define( 'SC_IMAGES', plugins_url( 'widgets/images/', __FILE__));

// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'Saasland_core' ) ) {
	/**
	 * Main Saasland Core Class
	 *
	 * The main class that initiates and runs the Saasland Core plugin.
	 *
	 * @since 1.7.0
	 */
	class Saasland_core {
		/**
		 * Saasland Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 Moved from property with that name to a constant.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0' ;
		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 Moved from property with that name to a constant.
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 Moved from property with that name to a constant.
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.4' ;
        /**
         * Plugin's directory paths
         * @since 1.0
         */
        const CSS = null;
        const JS = null;
        const IMG = null;
        const VEND = null;

		/**
		 * Instance
		 *
		 * Holds a single instance of the `Saasland_Core` class.
		 *
		 * @since 1.7.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Saasland_Core A single instance of the class.
		 */
		private static  $_instance = null ;
		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 * @static
		 *
		 * @return Saasland_Core An instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @since 1.7.0
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'saasland-core' ), '1.7.0' );
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @since 1.7.0
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'saasland-core' ), '1.7.0' );
		}

		/**
		 * Constructor
		 *
		 * Initialize the Saasland Core plugins.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function __construct() {
            add_action( 'init', [$this, 'mega_menu_include'] );
			$this->init_hooks();
			$this->core_includes();
			do_action( 'saasland_core_loaded' );
		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function core_includes() {
		    $opt = get_option('saasland_opt');
		    $is_service_cpt = isset($opt['is_service_cpt']) ? $opt['is_service_cpt'] : '1';
		    $is_portfolio_cpt = isset($opt['is_portfolio_cpt']) ? $opt['is_portfolio_cpt'] : '1';
		    $is_case_study_cpt = isset($opt['is_case_study_cpt']) ? $opt['is_case_study_cpt'] : '1';
		    $is_faq_cpt = isset($opt['is_faq_cpt']) ? $opt['is_faq_cpt'] : '1';
		    $is_job_cpt = isset($opt['is_job_cpt']) ? $opt['is_job_cpt'] : '1';
		    $is_header_cpt = isset($opt['is_header_cpt']) ? $opt['is_header_cpt'] : '1';
		    $is_footer_cpt = isset($opt['is_footer_cpt']) ? $opt['is_footer_cpt'] : '1';
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';

		    // Extra functions
			require_once __DIR__ . '/inc/extra.php';

			// Custom post types
            if ( $is_service_cpt == '1' ) {
                require_once __DIR__ . '/post-type/service.pt.php';
            }
            if ( $is_portfolio_cpt == '1' ) {
                require_once __DIR__ . '/post-type/portfolio.pt.php';
            }
            if ( $is_case_study_cpt == '1' ) {
                require_once __DIR__ . '/post-type/case_study.pt.php';
            }
            if ( $is_faq_cpt == '1' ) {
                require_once __DIR__ . '/post-type/faq.pt.php';
            }
            if ( $is_job_cpt == '1' ) {
                require_once __DIR__ . '/post-type/job.pt.php';
            }
            if ( $is_mega_menu_cpt == '1' ) {
                require_once __DIR__ . '/post-type/Saasland_mega_menu.pt.php';
            }
			if ( $is_header_cpt == '1' ) {
                require_once __DIR__ . '/post-type/header.pt.php';
            }
			if ( $is_footer_cpt == '1' ) {
                require_once __DIR__ . '/post-type/footer.pt.php';
            }
            require_once __DIR__ . '/post-type/none.pt.php';

            /**
             * Register widget area.
             *
             * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
             */
			require_once __DIR__ . '/wp-widgets/widgets.php';

			// Elementor custom field icons
			require_once __DIR__ . '/fields/icons.php';

            // RGBA color picker
            require plugin_dir_path(__FILE__) . '/acf-rgba-color-picker/acf-rgba-color-picker.php';

            // ACF Metaboxes
            require plugin_dir_path(__FILE__) . '/inc/metaboxes.php';
		}

		function mega_menu_include() {
            // Mega Menu
            $mega_menus = new WP_Query(array(
                'post_type' => 'megamenu',
                'posts_per_page' => -1,
            ));
            $mega_menu_count = $mega_menus->post_count;
            if ( $mega_menu_count > 0 && has_nav_menu( 'main_menu') ) {
                require plugin_dir_path(__FILE__) . '/inc/mega_menu.php';
            }
        }

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @since 1.7.0
		 *
		 * @access private
		 */
		private function init_hooks() {
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'saasland-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}


		/**
		 * Init Saasland Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @since 1.0.0
		 * @since 1.7.0 The logic moved from a standalone function to this class method.
		 *
		 * @access public
		 */
		public function init() {

			if ( !did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}

			// Check for required Elementor version

			if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}

			// Check for required PHP version

			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}

			// Add new Elementor Categories
			add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

			// Register Widget Scripts
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_scripts' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			// Register Widget Scripts
            add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_elementor_editor_styles' ] );
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );

			// Register New Widgets
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		}


		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.1.0
		 * @since 1.7.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'saasland-core' ) . '</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.1.0
		 * @since 1.7.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland Core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'saasland-core' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland Core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'saasland-core' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Add new Elementor Categories
		 *
		 * Register new widget categories for Saasland Core widgets.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function add_elementor_category() {
			\Elementor\Plugin::instance()->elements_manager->add_category( 'saasland-elements', [
				'title' => __( 'Saasland Elements', 'saasland-core' ),
			], 1 );
		}

		/**
		 * Register Widget Scripts
		 *
		 * Register custom scripts required to run Saasland Core.
		 *
		 * @since 1.6.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function register_widget_scripts() {

            wp_register_script( 'slick', plugins_url( 'assets/vendors/slick/slick.min.js', __FILE__ ), 'jquery', '1.9.0', true );

			wp_register_script( 'ajax-chimp', plugins_url( 'assets/js/ajax-chimp.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'owl-carousel', plugins_url( 'assets/vendors/owl-carousel/owl.carousel.min.js', __FILE__ ), 'jquery', '2.3.4', true );

			wp_register_script( 'waypoints', plugins_url( 'assets/vendors/counterup/jquery.waypoints.min.js', __FILE__ ), 'jquery', '4.0.1', true );

			wp_register_script( 'counterup', plugins_url( 'assets/vendors/counterup/jquery.counterup.min.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'appear', plugins_url( 'assets/vendors/counterup/appear.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'parallax-scroll', plugins_url( 'assets/vendors/sckroller/jquery.parallax-scroll.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'parallax', plugins_url( 'assets/js/appart-parallax.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'stellar', plugins_url( 'assets/vendors/stellar/jquery.stellar.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'circle-progress', plugins_url( 'assets/vendors/circle-progress/circle-progress.js', __FILE__ ), 'jquery', '1.1.3', true );

			wp_register_script( 'isotope', plugins_url( 'assets/vendors/isotope/isotope-min.js', __FILE__ ), 'jquery', '3.0.1', true );

			// Event Date Count Down Js
            wp_register_script( 'knob', plugins_url( 'assets/vendors/red-countdown/knob.js', __FILE__), array( 'jquery'), '1.2.11', true );
            wp_register_script( 'throttle', plugins_url( 'assets/vendors/red-countdown/throttle.js', __FILE__), array( 'jquery'), '1.1', true );
            wp_register_script( 'moment', plugins_url( 'assets/vendors/red-countdown/moment.js', __FILE__), array( 'jquery'), '2.9.0', true );
            wp_register_script( 'redcountdown', plugins_url( 'assets/vendors/red-countdown/redcountdown.js', __FILE__), array( 'jquery'), '1.0', true );
            wp_register_script( 'red-countdown-settings', plugins_url( 'assets/vendors/red-countdown/red-countdown-settings.js', __FILE__), array( 'jquery'), '1.0', true );

            wp_enqueue_script( 'wow', plugins_url( 'assets/vendors/wow/wow.min.js', __FILE__), array( 'jquery'), '1.1.3', true );


            wp_enqueue_script( 'appart-custom', plugins_url( 'assets/js/appart-custom.js', __FILE__), array( 'jquery'), '1.0.0', true );

            if ( is_rtl() ) {
                wp_enqueue_script( 'saasland-main-rtl', plugins_url( 'assets/js/main-rtl.js', __FILE__), 'jquery', '1.0', true);
            } else {
                wp_enqueue_script( 'saasland-main', plugins_url( 'assets/js/main.js', __FILE__), 'jquery', '1.0', true);
            }
		}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run Saasland Core.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		
		public function enqueue_widget_styles() {

            wp_enqueue_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.css', __FILE__ ) );

            wp_register_script( 'slick', plugins_url( 'assets/vendors/slick/slick.css', __FILE__ ) );

            wp_enqueue_style( 'slick-theme', plugins_url( 'assets/vendors/slick/slick-theme.css', __FILE__ ) );

            wp_register_style( 'appart-style', plugins_url( 'assets/css/appart-style.css', __FILE__ ) );

            wp_register_style( 'appart-responsive', plugins_url( 'assets/css/appart-responsive.css', __FILE__ ) );

            wp_register_style( 'owl-carousel', plugins_url( 'assets/vendors/owl-carousel/assets/owl.carousel.min.css', __FILE__) );

            // Section Dependency CSS
            wp_register_style( 'hero-chat', plugins_url( 'widgets/heros/chat/hero-chat.css', __FILE__ ) );

            wp_register_style( 'price-table-event', plugins_url( 'widgets/pricing-table/event/price-table-event.css', __FILE__ ) );

            wp_register_style( 'hero-event', plugins_url( 'widgets/heros/event/hero-event.css', __FILE__ ) );

            wp_register_style( 'parallax-image', plugins_url( 'assets/css/section-base-css/parallax-image.css', __FILE__ ) );

            wp_register_style( 'curve-counter-event', plugins_url( 'assets/css/section-base-css/curve-counter-event.css', __FILE__ ) );

            wp_register_style( 'date-countdown', plugins_url( 'assets/css/section-base-css/date-countdown.css', __FILE__ ) );

            wp_register_style( 'event-schedule', plugins_url( 'assets/css/section-base-css/event-schedule.css', __FILE__ ) );

            wp_register_style( 'team', plugins_url( 'assets/css/section-base-css/team.css', __FILE__ ) );

            wp_register_style( 'chat-features', plugins_url( 'assets/css/section-base-css/chat-features.css', __FILE__ ) );

            //Saasland Demo
            wp_register_style( 'saasland-demo', plugins_url( 'assets/css/saasland-demo.css', __FILE__) );

            if ( defined( 'ELEMENTOR_VERSION') ) {
                if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                    wp_enqueue_style( 'owl-carousel' );
                    wp_enqueue_style( 'appart-style' );
                    wp_enqueue_style( 'appart-responsive' );
                }
            }

            wp_register_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ) );

            if ( is_page_template( 'page-split.php') ) {
                wp_enqueue_style( 'multiscroll', plugins_url( 'assets/vendors/multiscroll/jquery.multiscroll.css', __FILE__));
            }

            wp_enqueue_style( 'themify-icons' );

            wp_enqueue_style( 'saasland-flaticons', plugins_url( 'assets/vendors/flaticon/flaticon.css', __FILE__ ) );
		}

		public function enqueue_elementor_editor_styles() {

            wp_enqueue_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.css', __FILE__ ) );

            wp_enqueue_style( 'saasland-elementor-editor', plugins_url( 'assets/css/saasland-elementor-editor.css', __FILE__ ) );

            wp_register_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ) );

            wp_enqueue_style( 'themify-icons' );

            wp_enqueue_style( 'saasland-flaticons', plugins_url( 'assets/vendors/flaticon/flaticon.css', __FILE__ ) );
		}

        public function enqueue_scripts() {
            if( class_exists( 'WooCommerce' ) ) {
                // WooCommerce stylesheets
                wp_deregister_style( 'woocommerce-layout' );
                wp_deregister_style( 'woocommerce-smallscreen' );
                wp_deregister_style( 'tinvwl' );

                if( is_shop() || is_tax( 'product_cat') || is_singular( 'product') || is_tax( 'product_tag') || is_checkout() || is_cart() || is_account_page() ) {
                    wp_enqueue_style( 'woocommerce-general' );
                } else {
                    wp_deregister_style( 'woocommerce-general' );
                }

                if( is_shop() || is_tax( 'product_cat') || is_singular( 'product') || is_tax( 'product_tag') || is_checkout() || is_cart() ) {
                    wp_enqueue_script( 'woocommerce' );
                    wp_enqueue_script( 'jquery-blockui' );
                    wp_enqueue_script( 'wc-cart-fragments' );
                } else {
                    wp_deregister_script( 'woocommerce' );
                    wp_deregister_script( 'jquery-blockui' );
                    wp_deregister_script( 'wc-cart-fragments' );
                }

                if ( function_exists( 'is_wishlist') ) {
                    if ( is_shop() || is_tax( 'product_cat') || is_singular( 'product') || is_tax( 'product_tag') || is_wishlist() ) {
                        wp_enqueue_script( 'tinvwl');
                    } else {
                        wp_deregister_script( 'tinvwl');
                    }
                }
            }
        }


		/*public function register_admin_styles() {
            wp_enqueue_style( 'saasland_core_admin', plugins_url( 'assets/css/saasland-core-admin.css', __FILE__ ) );
        }*/

		/**
		 * Register New Widgets
		 *
		 * Include Saasland Core widgets files and register them in Elementor.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function on_widgets_registered() {
			$this->include_widgets();
			$this->register_widgets();
		}

		/**
		 * Include Widgets Files
		 *
		 * Load Saasland Core widgets files.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access private
		 */
		private function include_widgets() {
			require_once __DIR__ . '/widgets/Saasland_subscribe.php';
			require_once __DIR__ . '/widgets/Saasland_services_shapes.php';
			require_once __DIR__ . '/widgets/Saasland_solar_system.php';
			require_once __DIR__ . '/widgets/Saasland_integrations.php';
			require_once __DIR__ . '/widgets/Saasland_integrations_row.php';
			require_once __DIR__ . '/widgets/Saasland_pricing_table.php';
			require_once __DIR__ . '/widgets/Saasland_pricing_table_tabs.php';
			require_once __DIR__ . '/widgets/Saasland_pricing_table_tabs_carousel.php';
			require_once __DIR__ . '/widgets/Saasland_subscribe.php';
			require_once __DIR__ . '/widgets/Saasland_navbar.php';
			require_once __DIR__ . '/widgets/Saasland_hero.php';
			require_once __DIR__ . '/widgets/Saasland_two_column_features.php';
			require_once __DIR__ . '/widgets/Saasland_services.php';
			require_once __DIR__ . '/widgets/Saasland_c2a.php';
			require_once __DIR__ . '/widgets/Saasland_footer.php';
			require_once __DIR__ . '/widgets/Saasland_client_logos.php';
			require_once __DIR__ . '/widgets/Saasland_features.php';
			require_once __DIR__ . '/widgets/Saasland_bubble_features.php';
			require_once __DIR__ . '/widgets/Saasland_features_vertical.php';
			require_once __DIR__ . '/widgets/Saasland_prototype_features.php';
			require_once __DIR__ . '/widgets/Saasland_tabs.php';
			require_once __DIR__ . '/widgets/Saasland_tabs_horizontal.php';
			require_once __DIR__ . '/widgets/Saasland_tabs_with_icon.php';
			require_once __DIR__ . '/widgets/Saasland_blog.php';
			require_once __DIR__ . '/widgets/Saasland_testimonial.php';
			require_once __DIR__ . '/widgets/Saasland_testimonial_bubble.php';
			require_once __DIR__ . '/widgets/Saasland_testimonial_ratting.php';
			require_once __DIR__ . '/widgets/Saasland_testimonial_single.php';
			require_once __DIR__ . '/widgets/Saasland_paired_images.php';
			//require_once __DIR__ . '/widgets/Saasland_features_tabs.php';
			require_once __DIR__ . '/widgets/Saasland_features_with_shapes.php';
			require_once __DIR__ . '/widgets/Saasland_features_with_image.php';
            require_once __DIR__ . '/widgets/Saasland_features_with_image_white.php';
			require_once __DIR__ . '/widgets/Saasland_counter.php';
			require_once __DIR__ . '/widgets/Saasland_curve_counter.php';
			require_once __DIR__ . '/widgets/Saasland_circle_counter.php';
			require_once __DIR__ . '/widgets/Saasland_hero_app.php';
			require_once __DIR__ . '/widgets/Saasland_hero_seo.php';
			require_once __DIR__ . '/widgets/Saasland_hero_integration.php';
			require_once __DIR__ . '/widgets/Saasland_hero_videos.php';
			require_once __DIR__ . '/widgets/Saasland_hero_crm.php';
			require_once __DIR__ . '/widgets/Saasland_hero_with_bg_img.php';
			require_once __DIR__ . '/widgets/Saasland_image_carousels.php';
			require_once __DIR__ . '/widgets/Saasland_downloads.php';
			require_once __DIR__ . '/widgets/Saasland_team.php';
			require_once __DIR__ . '/widgets/Saasland_map.php';
			require_once __DIR__ . '/widgets/Saasland_map2.php';
			require_once __DIR__ . '/widgets/Saasland_processes.php';
			require_once __DIR__ . '/widgets/Saasland_hotspot.php';
			require_once __DIR__ . '/widgets/Saasland_portfolio.php';
			require_once __DIR__ . '/widgets/Saasland_portfolio_masonry.php';
			require_once __DIR__ . '/widgets/Saasland_login.php';
			require_once __DIR__ . '/widgets/Saasland_signup_form.php';
			require_once __DIR__ . '/widgets/Saasland_jobs.php';
			require_once __DIR__ . '/widgets/Saasland_icon_boxes.php';
			require_once __DIR__ . '/widgets/Saasland_single_video.php';
			require_once __DIR__ . '/widgets/Saasland_single_feature.php';
			require_once __DIR__ . '/widgets/Saasland_icons.php';
			require_once __DIR__ . '/widgets/Saasland_icon_dual.php';
			require_once __DIR__ . '/widgets/Saasland_seo_check_form.php';
			require_once __DIR__ . '/widgets/Saasland_posts_carousel.php';
			require_once __DIR__ . '/widgets/Saasland_featured_image.php';
			require_once __DIR__ . '/widgets/Saasland_slider.php';
			require_once __DIR__ . '/widgets/Saasland_serialized_features.php';
			require_once __DIR__ . '/widgets/Saasland_alerts_box.php';
            require_once __DIR__ . '/widgets/Saasland_faq.php';
            require_once __DIR__ . '/widgets/Saasland_pricing_table_comparison.php';


			//Appart Widgets
            require_once __DIR__ . '/widgets/Saasland_appart_hero.php';

            require_once __DIR__ . '/widgets/Saasland_appart_c2a.php';

            require_once __DIR__ . '/widgets/Saasland_appart_screen_feature.php';

            require_once __DIR__ . '/widgets/Saasland_appart_pricing_table.php';

            require_once __DIR__ . '/widgets/Saasland_appart_app_info.php';

            require_once __DIR__ . '/widgets/Saasland_appart_testimonials.php';

            require_once __DIR__ . '/widgets/Saasland_appart_features.php';

            require_once __DIR__ . '/widgets/Saasland_appart_single_video.php';

            require_once __DIR__ . '/widgets/Saasland_appart_parallax_hero.php';

            require_once __DIR__ . '/widgets/Saasland_appart_single_info_with_icon.php';

            require_once __DIR__ . '/widgets/Saasland_appart_shop_categories.php';

            require_once __DIR__ . '/widgets/Saasland_appart_products.php';


            //ERP, Hosting, Pos
            require_once __DIR__ . '/widgets/Saasland_ticket_plan.php';

            require_once __DIR__ . '/widgets/Saasland_hero_erp.php';

            require_once __DIR__ . '/widgets/Saasland_icon_with_featured_img.php';

            require_once __DIR__ . '/widgets/Saasland_domain_form.php';

            require_once __DIR__ . '/widgets/Saasland_locations.php';

            require_once __DIR__ . '/widgets/Saasland_table_tabs.php';

            require_once __DIR__ . '/widgets/Saasland_button_icons.php';

            require_once __DIR__ . '/widgets/Saasland_parallax_img_effect.php';

            require_once __DIR__ . '/widgets/Saasland_countdown.php';

            require_once __DIR__ . '/widgets/Saasland_event_schedule.php';
        }


		/**
		 * Register Widgets
		 *
		 * Register Saasland Core widgets.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access private
		 */
		private function register_widgets() {
			// Site Elements
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_subscribe() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_services_shapes() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_solar_system() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_integrations() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_integrations_row() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_pricing_table() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_pricing_table_tabs() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_pricing_table_tabs_carousel() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_subscribe() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_navbar() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_crm() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_two_column_features() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_services() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_c2a() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_footer() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_client_logos() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_features() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_bubble_features() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_features_vertical() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_prototype_features() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_tabs() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_tabs_with_icon() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_blog() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_testimonial() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_testimonial_bubble() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_testimonial_ratting() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_testimonial_single() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_paired_images());

			//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_features_tabs());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_tabs_horizontal());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_features_with_shapes());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_features_with_image());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_features_with_image_white());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_counter());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_curve_counter());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_circle_counter());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_app());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_seo());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_integration());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_videos());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_with_bg_img());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_image_carousels());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_downloads());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_team());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_map());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_map2());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_processes());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hotspot());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_portfolio());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_portfolio_masonry());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_login());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_signup_form());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_jobs());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_icon_boxes());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_single_video());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_single_feature());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_single_feature());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_icons());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_icon_dual());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_seo_check_form());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_posts_carousel());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_featured_image());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_slider());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_serialized_features());

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_alerts_box());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_faq());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_pricing_table_comparison());


            //  Appart Widgets
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_hero());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_c2a());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_screen_feature());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_pricing_table());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_app_info());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_testimonials());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_features());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_single_video());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_parallax_hero());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_single_info_with_icon());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_shop_categories());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_appart_products());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_ticket_plan());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_hero_erp());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_icon_with_featured_img());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_domain_form());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_locations());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_table_tabs());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_button_icons());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_parallax_img_effect());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_countdown());

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SaaslandCore\Widgets\Saasland_event_schedule());

        }
	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if ( !function_exists( 'saasland_core_load' ) ) {
	/**
	 * Load Saasland Core
	 *
	 * Main instance of Saasland_Core.
	 *
	 * @since 1.0.0
	 * @since 1.7.0 The logic moved from this function to a class method.
	 */
	function saasland_core_load() {
		return Saasland_core::instance();
	}

	// Run Saasland Core
    saasland_core_load();
}


function saasland_admin_cpt_script( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'service' === $post->post_type ) {
            wp_enqueue_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ));
        }
    }
}
add_action( 'admin_enqueue_scripts', 'saasland_admin_cpt_script', 10, 1 );