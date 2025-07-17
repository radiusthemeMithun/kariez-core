<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $location              string
 * @var $items                  string
 * @var $item                  string
 * @var $location_img          string
 */

?>

<div class="location-map">
    <div class="map-image">
        <?php echo wp_get_attachment_image( $location_img['id'], 'full' ); ?>
    </div>

	<?php foreach ( $items as $item ): ?>
        <div class="locations-wrapper elementor-repeater-item-<?php echo esc_attr($item['_id']) ?>">

			<?php if ( $item['location'] ) { ?>
                <div class="location-content"><?php echo esc_html( $item['location'] ); ?></div>
			<?php } ?>
            <div class="location-point">
                <div class="blinking-1"></div>
            </div>
        </div>
	<?php
	endforeach; ?>
</div>

