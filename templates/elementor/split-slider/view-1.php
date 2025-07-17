<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $items                 string
 * @var $item                  string
 * @var $button_icon           string
 */

?>

<div id="radiustheme-multiscroll" class="multiscroll-wrapper">
    <div class="ms-left">
		<?php foreach ( $items as $item ): ?>
            <div class="ms-section">
                <div class="ms-content">
	                <?php
	                $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($item['tab_content']);
	                print($content);
	                ?>
                </div>

            </div>
		<?php endforeach; ?>
    </div>
    <div class="ms-right">
		<?php foreach ( $items as $item ): ?>
        <div class="ms-section">
            <div class="full">
	            <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
            </div>
        </div>
		<?php endforeach; ?>
    </div>
</div>