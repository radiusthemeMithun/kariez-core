
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
 * @var $title_display              string
 * @var $alignment                  string
 * @var $arrow_hover_visibility     string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 *
 * @var $title                      string
 * @var $image_icon                 string
 * @var $info_icon                  string
 * @var $icon_type                  string
 * @var $sub_title                  string
 * @var $show_read_more_btn         string
 * @var $read_more_btn_text         string
 * @var $button_icon                string
 * @var $show_btn_icon              string
 * @var $show_btn_text              string
 * @var $info_image_display         string
 * @var $info_image                 string
 * @var $btn_display                string
 * @var $icon_display               string
// * @var $link                       string
 */
use Elementor\Icons_Manager;


?>
<div class="rt-info-slider rt-info-slider-<?php echo esc_attr( $layout ) ?>">
    <div class="rt-swiper-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
            <?php $ade = $delay; $adu = $duration; ?>
            <?php foreach ( $items as $item ): ?>
            <?php
                $attr = '';
                if ( !empty( $item['link']['url'] ) ) {
                $attr  = 'href="' . $item['link']['url'] . '"';
                $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
                }
                ?>
                <div class="swiper-slide <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                    <div class="slider-item <?php if( !empty( $alignment ) ) { ?><?php echo esc_attr( $alignment ) ?><?php } ?>">
                        <div class="rt-info-slider-box">
                            <div class="info-slider-box">

                                <?php if ( $item['image']['id'] && $thumb_display ) {
                                    echo "<div class='info-slider-img'>";
                                    echo wp_get_attachment_image( $item['image']['id'], 'full' );
                                    echo "</div>";

                                } ?>
                                <?php if ( $icon_display ) { ?><div class="rt-icon"><?php Icons_Manager::render_icon( $item['rt_icon'] ); ?></div><?php } ?>
                            <?php if ( $item['title'] && $title_display ) { ?>
                                <h3 class="info-title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <?php } ?>
                                <p><?php echo esc_html( $item['content'] ); ?></p>
                                <?php if ($btn_display) { ?>
                                    <a class="info-btn" <?php echo $attr; ?> ><?php echo esc_html( $item['rt-button'] ); ?></a><?php }?>
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
