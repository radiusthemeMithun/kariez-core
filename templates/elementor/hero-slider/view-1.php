<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $slider_items               string
 * @var $swiper_data                string
 * @var $arrow_hover_visibility     string
 * @var $display_arrow              string
 * @var $display_pagination         string
 * @var $slider_animation           string
 * @var $title_tag                  string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 * @var $thumb_display              string
 * @var $button_icon                string
 */

$banners = array();
foreach ( $slider_items as $banner_list ) {
    $banners[] = array(
        'sub_title'         => $banner_list['sub_title'],
        'title'             => $banner_list['title'],
        'content'           => $banner_list['content'],
        'thumb_text'        => $banner_list['thumb_text'],
        'button_text'       => $banner_list['button_text'],
        'button_url'        => $banner_list['button_url']['url'],
        'image'             => $banner_list['banner_img'],
        'img'               => $banner_list['banner_image']['url'] ? $banner_list['banner_image']['url'] : "",

    );
}
?>

<div class="rt-hero-slider rt-horizontal-slider">
    <div class="swiper-container swiper horizontal-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper <?php if( $slider_animation == 'yes' ) { ?>animation<?php } ?>">
            <?php $i = 1;
            foreach ($banners as $banner){ ?>
            <div class="swiper-slide single-slide slide-<?php echo esc_attr( $i ); ?>">
                <div class="single-slider" data-bg-image="<?php echo esc_attr($banner['img']); ?>">
                    <div class="container">
                        <div class="content-wrap">
                            <div class="slider-content">
	                            <?php if( !empty( $banner['sub_title'] ) ) { ?>
                                    <div class="sub-title"><?php echo kariez_html( $banner['sub_title'], 'allow_title' );?></div>
                                <?php } if( !empty( $banner['title'] ) ) { ?>
                                <<?php echo esc_attr( $title_tag ) ?> class="slider-title"><?php echo kariez_html( $banner['title'], 'allow_title' );?></<?php echo esc_attr( $title_tag ) ?>>
                            <?php } if( !empty( $banner['content'] ) ) { ?>
                                <div class="slider-text"><?php echo kariez_html( $banner['content'], 'allow_title' );?></div>
                            <?php } ?>
                            <?php if( !empty( $banner['button_text'] ) ) { ?>
                                <div class="slider-btn-area rt-button">
                                    <a class="btn button-2" href="<?php echo esc_url( $banner['button_url'] ); ?>">
                                        <span class="button-text"><?php echo esc_html( $banner['button_text'] ); ?></span>
                                        <span class="btn-round-shape">
                                            <?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?>
                                        </span>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; } ?>
    </div>
    <div class="rt-thumbnail-area">
        <div class="swiper swiper-item-wrap horizontal-thumb-slider" data-xld ="<?php echo esc_attr( $swiper_data );?>">
            <div class="swiper-wrapper">
				<?php $ade = $delay; $adu = $duration;
				foreach ( $banners as $banner ) { ?>
                    <div class="swiper-slide <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                        <div class="item-thumb">
							<?php if ( $banner['image']['id'] && $thumb_display ) {
								echo "<div class='banner-sm-img'>";
								echo wp_get_attachment_image( $banner['image']['id']);
								echo "</div>";
							} ?>
                            <?php if ( !empty( $banner['thumb_text'] ) ) { ?>
                                <h3 class="thumb-text-title"><?php echo kariez_html( $banner['thumb_text'], 'allow_title' );?></h3>
                            <?php } ?>
                        </div>
                    </div>
					<?php $ade = $ade + 200; $adu = $adu + 0; } ?>
            </div>
        </div>
    </div>
    <?php if ( $display_arrow == 'yes' ) { ?>
        <div class="swiper-navigation">
            <div class="swiper-button swiper-button-prev"><i class="icon-arrow-left"></i></div>
            <div class="swiper-button swiper-button-next"><i class="icon-arrow-right"></i></div>
        </div>
    <?php } ?>
    <?php if ( $display_pagination == 'yes' ) { ?>
        <div class="swiper-pagination"></div>
    <?php } ?>
</div>
</div>