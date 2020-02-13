<div class="split_banner_content height">
    <div class="square one"></div>
    <div class="square two"></div>
    <div class="intro">
        <div class="split_slider_content">
            <div class="square three"></div>
            <div class="br_shap"></div>
            <div class="content">
                <h2> <?php the_sub_field( 'title' ) ?> </h2>
                <p> <?php the_sub_field( 'subtitle' ) ?> </p>
                <?php
                $button = get_sub_field( 'button' );
                if ( !empty($button['title']) ) : ?>
                    <a href="<?php echo esc_url($button['url']) ?>" class="btn_get btn_hover">
                        <?php echo esc_html($button['title']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>