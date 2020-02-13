<?php
/**
 * Custom Post Types
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Custom Post Types', 'saasland' ),
    'id'        => 'cpt_opt',
    'icon'      => 'dashicons dashicons-admin-post',
));

/**
 * Post Types
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Post Types', 'saasland' ),
    'id'        => 'cpt',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'        => 'cpt_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Enable Disable Custom Post Types', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => esc_html__( 'If you want, you can disable any custom post type of Saasland from here.', 'saasland' )
        ),

        array(
            'id'       => 'is_service_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Service Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_portfolio_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Portfolio Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_case_study_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Case Study Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_faq_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('FAQ Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_job_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Job Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_mega_menu_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Mega Menu Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),
        
        array(
            'id'       => 'is_header_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Header Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),
        
        array(
            'id'       => 'is_footer_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Footer Post Type', 'saasland' ),
            'on'       => esc_html__( 'Enable', 'saasland' ),
            'off'      => esc_html__( 'Disable', 'saasland' ),
            'default'  => true,
        ),
    )
));

/**
 * Slug Re-write
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Post Type Slugs', 'saasland' ),
    'id'        => 'saasland_cp_slugs',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'        => 'cp_slug_note',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => esc_html__( 'Slug Re-write:', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => sprintf (
                '%1$s <a href="%2$s"> %3$s</a> %4$s',
                esc_html__( "These are the custom post's slugs offered by Saasland. You can customize the permalink structure (site_domain/post_type_slug/post_lug) by changing the slug from here. Don't forget to save the permalinks settings from", 'saasland' ),
                get_admin_url( null, 'options-permalink.php' ),
                esc_html__( 'Settings > Permalinks', 'saasland' ),
                esc_html__( 'after changing the slug value.', 'saasland' )
            )
        ),
        
        array(
            'title'     => esc_html__( 'Service Slug', 'saasland' ),
            'id'        => 'service_slug',
            'type'      => 'text',
            'default'   => 'service'
        ),
        
        array(
            'title'     => esc_html__( 'Portfolio Slug', 'saasland' ),
            'id'        => 'portfolio_slug',
            'type'      => 'text',
            'default'   => 'portfolio'
        ),
        
        array(
            'title'     => esc_html__( 'Case Study Slug', 'saasland' ),
            'id'        => 'case_study_slug',
            'type'      => 'text',
            'default'   => 'case_study'
        ),

        array(
            'title'     => esc_html__( 'Jobs Slug', 'saasland' ),
            'id'        => 'job_slug',
            'type'      => 'text',
            'default'   => 'job'
        ),
    )
));