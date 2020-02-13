<?php
/**
 * Template Name: Split Homepage
 *
 */
get_header( 'split' );
?>
<div id="multiscroll" class="ms-section">
    <div id="left-side" class="ms-left">
        <?php
        if( have_rows( 'left_slide_contents' ) ):
            $left_i = 1;
            while ( have_rows( 'left_slide_contents' ) ) : the_row();
                ?>
                <div class="ms-section section_<?php echo esc_attr($left_i); ?>" id="left<?php echo esc_attr($left_i); ?>">
                    <?php
                    // Call to Action
                    if( get_row_layout() == 'call_to_action' ):
                        get_template_part( 'template-parts/split_page_items/call-to-action' );
                    endif;

                    // Hotspots
                    if( get_row_layout() == 'hotspot' ):
                        get_template_part( 'template-parts/split_page_items/hotspot' );
                    endif;

                    // Skill Progress Bars
                    if( get_row_layout() == 'skill_progress_bars' ):
                        get_template_part( 'template-parts/split_page_items/skill_progress_bars' );
                    endif;

                    // Featured Image
                    if( get_row_layout() == 'featured_image' ):
                        get_template_part( 'template-parts/split_page_items/featured_image' );
                    endif;

                    // Featured Image
                    if( get_row_layout() == 'shortcode' ):
                        get_template_part( 'template-parts/split_page_items/shortcode' );
                    endif;

                    // Dual Images
                    if( get_row_layout() == 'dual_images' ):
                        get_template_part( 'template-parts/split_page_items/dual_images' );
                    endif;

                    // Title with Buttons
                    if( get_row_layout() == 'title_with_buttons' ):
                        get_template_part( 'template-parts/split_page_items/title_with_buttons' );
                    endif;

                    // Full Image
                    if( get_row_layout() == 'full_image' ):
                        get_template_part( 'template-parts/split_page_items/full_image' );
                    endif;

                    ++ $left_i;
                    ?>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
    <div id="right-part" class="ms-right">
        <?php
        if( have_rows( 'right_slide_contents' ) ):
            $right_i = 1;
            while ( have_rows( 'right_slide_contents' ) ) : the_row();
                $full_image = get_row_layout() == 'full_image' ? get_sub_field( 'full_image' ) : '';
                $full_image = !empty($full_image['url']) ? "style='background: url({$full_image['url']}) no-repeat center top; background-size: cover; top: 0; left: 0; width: 100%; height: 100%;'" : '';
                ?>
                <div class="ms-section section_<?php echo esc_attr($left_i); ?>" id="right<?php echo esc_attr($right_i); ?>" <?php echo wp_kses_post($full_image); ?>>
                    <?php
                    // Call to Action
                    if( get_row_layout() == 'call_to_action' ):
                        get_template_part( 'template-parts/split_page_items/call-to-action' );
                    endif;

                    // Hotspots
                    if( get_row_layout() == 'hotspot' ):
                        get_template_part( 'template-parts/split_page_items/hotspot' );
                    endif;

                    // Skill Progress Bars
                    if( get_row_layout() == 'skill_progress_bars' ):
                        get_template_part( 'template-parts/split_page_items/skill_progress_bars' );
                    endif;

                    // Featured Image
                    if( get_row_layout() == 'featured_image' ):
                        get_template_part( 'template-parts/split_page_items/featured_image' );
                    endif;

                    // Featured Image
                    if( get_row_layout() == 'shortcode' ):
                        get_template_part( 'template-parts/split_page_items/shortcode' );
                    endif;

                    // Dual Images
                    if( get_row_layout() == 'dual_images' ):
                        get_template_part( 'template-parts/split_page_items/dual_images' );
                    endif;

                    // Title with Buttons
                    if( get_row_layout() == 'title_with_buttons' ):
                        get_template_part( 'template-parts/split_page_items/title_with_buttons' );
                    endif;

                    // Full Image
                    if( get_row_layout() == 'full_image' ):
                        get_template_part( 'template-parts/split_page_items/full_image' );
                    endif;

                    ++ $left_i;
                    ++ $right_i;
                    ?>

                </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</div>

<?php
get_footer( 'split' );