<?php
class Saasland_helper {

    /**
     * Hold an instance of Saasland_helper class.
     * @var Saasland_helper
     */
    protected static $instance = null;

    /**
     * Main Saasland_helper instance.
     * @return Saasland_helper - Main instance.
     */
    public static function instance() {

        if(null == self::$instance) {
            self::$instance = new Saasland_helper();
        }

        return self::$instance;
    }

    /**
     * [ajax_url description]
     * @method ajax_url
     * @return [type]   [description]
     */
    public function ajax_url() {
        return admin_url( 'admin-ajax.php', 'relative' );
    }

    public function output_css( $styles = array() ) {

        // If empty return false
        if ( empty( $styles ) ) {
            return false;
        }

        $out = '';
        foreach ( $styles as $key => $value ) {

            if( ! $value ) {
                continue;
            }

            if( is_array( $value ) ) {

                switch( $key ) {

                    case 'padding':
                    case 'margin':
                        $new_value = '';
                        foreach( $value as $k => $v ) {

                            if( '' != $v ) {
                                $out .= sprintf( '%s: %s;', esc_html( $k ), $this->sanitize_unit($v) );
                            }
                        }
                        break;

                    default:
                        $value = join( ';', $value );
                }
            }
            else {
                $out .= sprintf( '%s: %s;', esc_html( $key ), $value );
            }
        }

        return rtrim( $out, ';' );
    }
    
    public function get_current_page_id() {

        global $post;
        $page_id = false;
        $object_id = is_null($post) ? get_queried_object_id() : $post->ID;

        // If we're on search page, set to false
        if( is_search() ) {
            $page_id = false;
        }
        // If we're not on a singular post, set to false
        if( ! is_singular() ) {
            $page_id = false;
        }
        // Use the $object_id if available
        if( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
            $page_id = $object_id;
        }
        // if we're on front-page
        if( ! is_home() && is_front_page() && isset( $object_id ) ) {
            $page_id = $object_id;
        }
        // if we're on posts-page
        if( is_home() && ! is_front_page() ) {
            $page_id = get_option( 'page_for_posts' );
        }
        // The woocommerce shop page
        if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
            if( $shop_page = wc_get_page_id( 'shop' ) ) {
                $page_id = $shop_page;
            }
        }
        // if in the loop
        if( in_the_loop() ) {
            $page_id = get_the_ID();
        }

        return $page_id;
    }
    
    /**
     * [active_tab description]
     * @method active_tab
     * @return [type]          [description]
     */
    public function active_tab( $page ) {
        if( isset( $_GET['page'] ) && $page === $_GET['page'] ) {
            echo 'is-active';
        }
    }

    /**
     * [get_theme_name description]
     * @method get_theme_name
     * @return [type]         [description]
     */
    public function get_current_theme() {
        $current_theme = wp_get_theme();
        if( $current_theme->parent_theme ) {
            $template_dir  = basename( get_template_directory() );
            $current_theme = wp_get_theme( $template_dir );
        }
        return $current_theme;
    }
}

/**
 * Main instance of Saasland_helper.
 *
 * Returns the main instance of Saasland_helper to prevent the need to use globals.
 *
 * @return Saasland_helper
 */
function saasland_helper() {
    return Saasland_helper::instance();
}