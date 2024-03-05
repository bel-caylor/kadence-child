<?php
$accordion_items = get_field('songs');
?>
<div class="wp-block-kadence-accordion alignnone song-accordion">
    <div class="kt-accordion-wrap kt-accordion-has-3-panes kt-active-pane-0 kt-accordion-block kt-pane-header-alignment-left kt-accodion-icon-style-arrow kt-accodion-icon-side-left" style="max-width:none">
        <div class="kt-accordion-inner-wrap kt-accordion-initialized" data-allow-multiple-open="true" data-start-open="none">
            <?php
            // Initialize a counter variable
            $accordion_number = 1;
            
            // Assuming you have an array of accordion items (you can replace this with your actual data)
            
            foreach ($accordion_items as $item) {
                ?>
                <div class="wp-block-kadence-pane kt-accordion-pane kt-accordion-pane-<?php echo esc_attr($accordion_number); ?> kt-pane1405_7c0f1e-3f">
                    <div class="kt-accordion-header-wrap">
                        <button class="kt-blocks-accordion-header kt-acccordion-button-label-show" id="kt-accordion-header-<?php echo esc_attr($accordion_number); ?>" aria-controls="kt-accordion-panel-<?php echo esc_attr($accordion_number); ?>" data-kt-accordion-header-id="<?php echo esc_attr($accordion_number - 1); ?>" aria-expanded="false">
                            <span class="kt-blocks-accordion-title-wrap">
                                <span class="kt-blocks-accordion-title">
                                    <?php 
                                    // echo '<pre>';
                                    // var_dump($accordion_items);
                                    // echo '</pre>';
                                    echo esc_html($item->post_title); 
                                    ?>
                                </span>
                            </span>
                            <span class="kt-blocks-accordion-icon-trigger"></span>
                        </button>
                    </div>
                    <div class="kt-accordion-panel kt-accordion-panel-hidden" id="kt-accordion-panel-<?php echo esc_attr($accordion_number); ?>" aria-labelledby="kt-accordion-header-<?php echo esc_attr($accordion_number); ?>" role="region" data-panel-height="0px">
                        <div class="kt-accordion-panel-inner">
                            <?php echo wp_kses_post($item->post_content); ?>
                        </div>
                    </div>
                </div>
                <?php
                // Increment the counter
                $accordion_number++;
            }
            ?>
        </div>
    </div>
</div>