
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
 * @var $button_icon                string
 * @var $button_text                string
 * @var $button_url                 string
 * @var $button_text_display        string
 *
 */
use Elementor\Icons_Manager;

?>
<div class="rt-service-slider position-relative rt-service-slider-<?php echo esc_attr( $layout ) ?>">
    <div class="cursor">
        <div class="cursor__inner">
            <svg width="25" height="14" viewBox="0 0 25 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.71875 10.4375L5.28125 7L8.71875 3.5625" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.9062 10.4375L19.3438 7L15.9062 3.5625" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    <div class="custom-cursor-swiper rt-swiper-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
            <?php $ade = $delay; $adu = $duration; ?>
            <?php foreach ( $items as $item ):
	            $attr = '';
	            if ( !empty( $item['button_url']['url'] ) ) {
		            $attr  = 'href="' . $item['button_url']['url'] . '"';
		            $attr .= !empty( $item['is_external'] ) ? ' target="_blank"' : '';
		            $attr .= !empty( $item['nofollow'] ) ? ' rel="nofollow"' : '';
	            }?>
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
	                        <?php if ( $item['stroke'] && $stroke_display ) { ?>
                                <div class="stroke-title"><?php echo esc_html( $item['stroke'] ); ?></div>
	                        <?php } ?>
                            <p><?php echo esc_html( $item['content'] ); ?></p>

	                        <?php if ( $item['button_text'] && $button_text_display ) { ?>
                                <div class="rt-button">
                                    <a class="btn button-3" <?php echo $attr; ?>>
                                        <span class="button-text"><?php echo esc_html( $item['button_text'] ); ?></span>
                                        <span class="btn-round-shape">
                                            <?php Icons_Manager::render_icon( $item['button_icon'] ); ?>
                                        </span>
                                    </a>
                                </div>
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
