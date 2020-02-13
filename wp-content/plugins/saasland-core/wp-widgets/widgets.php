<?php

// Require widget files
require plugin_dir_path(__FILE__) . 'widget-recent-posts.php';
require plugin_dir_path(__FILE__) . 'Saasland_Widget_Tag_Cloud.php';
require plugin_dir_path(__FILE__) . 'Saasland_widget_recent_comments.php';
require plugin_dir_path(__FILE__) . 'Saasland_Widget_Subscribe.php';
require plugin_dir_path(__FILE__) . 'Saasland_Widget_Social.php';

// Register Widgets
add_action( 'widgets_init', function() {
    register_widget( 'Saasland_Recent_Posts');
    register_widget( 'Saasland_Widget_Tag_Cloud');
    register_widget( 'Saasland_widget_recent_comments');
    register_widget( 'Saasland_Widget_Subscribe');
    register_widget( 'Saasland_Widget_Social');
});
