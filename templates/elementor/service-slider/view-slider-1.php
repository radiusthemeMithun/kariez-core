
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $display_arrow              string
 * @var $display_pagination         string
 * @var $thumb_display              string
 * @var $layout                     string
 * @var $swiper_data                string
 * @var $items                      string
 * @var $title_tag                  string
 * @var $alignment                  string
 * @var $arrow_hover_visibility     string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 * @var $stroke_display             string
 * @var $icon_display               string
 * @var $rt_icon                    string
 *
 */
use Elementor\Icons_Manager;
?>
<div class="rt-service-slider position-relative rt-service-slider-<?php echo esc_attr( $layout ) ?>">
    <div class="rt-swiper-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
            <?php $ade = $delay; $adu = $duration; ?>
            <?php foreach ( $items as $item ): ?>
            <div class="swiper-slide <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <div class="slider-item <?php if( !empty( $alignment ) ) { ?><?php echo esc_attr( $alignment ) ?><?php } ?>">
                    <div class="service-slider-content">
                        <?php if ( $item['image']['id'] && $thumb_display ) {
                            echo "<div class='service-slider-img'>";
                            echo wp_get_attachment_image( $item['image']['id'], 'full' );
                            if ( $icon_display ) { ?><span class="rt-icon"><?php Icons_Manager::render_icon( $item['rt_icon'] ); ?></span><?php }
                            echo "</div>";

                        } ?>
                        
                        <div class="rt-content">
                            <p><?php echo esc_html( $item['content'] ); ?></p>

                            <?php if ( $item['stroke'] && $stroke_display ) { ?>
                                <div class="stroke-title"><?php echo esc_html( $item['stroke'] ); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
        </div>
        <?php if ( $display_arrow == 'yes' ) { ?>
            <div class="swiper-navigation">
                <div class="swiper-button swiper-button-prev"><i class="icon-arrow-left"></i></div>
                <div class="swiper-button swiper-button-next active"><i class="icon-arrow-right"></i></div>
            </div>
        <?php } ?>
        <?php if ( $display_pagination == 'yes' ) { ?>
            <div class="swiper-pagination"></div>
        <?php } ?>
    </div>
</div>
