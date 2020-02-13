<?php
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Job Settings', 'saasland' ),
    'id'               => 'job_sec_opt',
    'icon'             => 'dashicons dashicons-clipboard',
));


Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Job Apply Form', 'saasland' ),
    'id'               => 'job_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Form Shortcode', 'saasland' ),
            'subtitle'  => __( 'Get the Job Apply form template from <a href="https://is.gd/N6sJVo" target="_blank">here.</a>', 'saasland' ),
            'id'        => 'apply_form_shortcode',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__( 'Apply Button Title', 'saasland' ),
            'id'        => 'apply_btn_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Apply Now', 'saasland' )
        ),
        array(
            'title'     => esc_html__( 'Before Apply Form', 'saasland' ),
            'subtitle'  => esc_html__( 'Place contents to show before the Apply Form', 'saasland' ),
            'id'        => 'before_form',
            'type'      => 'editor',
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                //'tabindex' => 1,
                //'editor_css' => '',
                'teeny'         => false,
                //'tinymce' => array(),
                'quicktags'     => false,
            )
        ),
    )
));


Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Styling', 'saasland' ),
    'id'               => 'opt_job_styling',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(

        array(
            'title'         => esc_html__( 'Icons Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Job attribute icons color', 'saasland' ),
            'id'            => 'job_atts_icon_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.job_info .info_item i, .job_info .info_head i',
            ),
        ),

        array(
            'title'         => esc_html__( 'Job Info Background', 'saasland' ),
            'subtitle'      => esc_html__( 'Job info box background color', 'saasland' ),
            'id'            => 'job_info_bg_color',
            'type'          => 'color',
            'output'        => array (
                'background'      => '.job_info',
            ),
        ),

        array(
            'title'         => esc_html__( 'Attribute Title Color', 'saasland' ),
            'id'            => 'job_atts_title_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.job_info .info_item h6, .job_info .info_head h6',
            ),
        ),

        array(
            'title'         => esc_html__( 'Attribute Value Color', 'saasland' ),
            'id'            => 'job_atts_value_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.job_info .info_item p',
            ),
        ),
    )
));