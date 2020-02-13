<?php

Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Portfolio Settings', 'saasland' ),
	'id'        => 'portfolio_settings',
	'icon'      => 'dashicons dashicons-images-alt2',
	'fields'    => array(
		array(
			'title'     => esc_html__( 'Default Layout', 'saasland' ),
			'subtitle'  => esc_html__( 'Select the default portfolio layout for portfolio details page', 'saasland' ),
			'id'        => 'portfolio_layout',
			'type'      => 'select',
			'default'   => 'leftc_righti',
            'options'   => array(
                'leftc_righti' => esc_html__( 'Left Content Right Images', 'saasland' ),
                'lefti_rightc' => esc_html__( 'Left Images Right Content', 'saasland' ),
                'topi_bottomc' => esc_html__( 'Top Images Bottom Content', 'saasland' ),
            )
		),

		// Portfolio Share Options
		array(
            'id' => 'portfolio_share_start',
            'type' => 'section',
            'title' => __( 'Share Options', 'saasland' ),
            'subtitle' => __( 'Enable/Disable social media share options as you want.', 'saasland' ),
            'indent' => true
        ),

        array(
            'id'       => 'share_options',
            'type'     => 'switch',
            'title'    => esc_html__( 'Share Options', 'saasland' ),
            'default'  => true,
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'share_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'saasland' ),
            'default'  => esc_html__( 'Share on', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
        ),
        array(
            'id'       => 'is_portfolio_fb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Facebook', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_twitter',
            'type'     => 'switch',
            'title'    => esc_html__( 'Twitter', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_googleplus',
            'type'     => 'switch',
            'title'    => esc_html__( 'Google Plus', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_linkedin',
            'type'     => 'switch',
            'title'    => esc_html__( 'Linkedin', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_pinterest',
            'type'     => 'switch',
            'title'    => esc_html__( 'Pinterest', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),

        array(
            'id'     => 'portfolio_share_end',
            'type'   => 'section',
            'indent' => false,
        ),
	)
));

