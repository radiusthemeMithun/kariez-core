
<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                     string
 * @var $link                       string
 * @var $bg_animation               string
 * @var $icon_animation             string
 * @var $icon_type                  string
 * @var $image_icon                 string
 * @var $info_icon                  string
 * @var $title                      string
 * @var $sub_title                  string
 * @var $show_read_more_btn         string
 * @var $button_icon                string
 * @var $title_tag                  string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 * @var $service_hovers              string

 */

$services = array();
foreach ( $service_hovers as $service_list ) {
	$services[] = array(
		'sub_title'              => $service_list['sub_title'],
		'title'                   => $service_list['title'],
		'show_read_more_btn'      => $service_list['show_read_more_btn'],
		'button_url'              => $service_list['button_url']['url'],
		'img'                     => $service_list['service_image']['url'],
	);
}
?>

<div class="rt_creative-service_wrapper creative-service-style-01">

    <div class="service-images">
        <?php $i = 1; foreach ($services as $service){ ?>
        <div id="rt-service-id-<?php echo esc_attr( $i ); ?>" class="service-img-box service-img-box-<?php echo esc_attr( $i ); ?>" data-bg-image="<?php echo esc_url($service['img']); ?>">
        </div>
        <?php $i++; }  ?>
    </div>
    <div class="service-items">
        <?php  $i = 1;  foreach ($services as $service){ ?>
            <div data-tab="rt-service-id-<?php echo esc_attr( $i ); ?>" class="service-item service-item-<?php echo esc_attr( $i ); ?>">
                <div class="service-image-mobile" style="background-image: url('<?php echo esc_url($service['img']); ?>')"></div>
                <div class="info-content-holder">
                    <?php if( !empty( $service['title'] ) ) { ?>
                        <<?php echo esc_attr( $title_tag ) ?> class="service-title"><?php echo kariez_html( $service['title'], 'allow_title' );?>
                        </<?php echo esc_attr( $title_tag ) ?>>
                    <?php } ?>

                    <?php if ( !empty($service['sub_title'] ) ) { ?>
                        <div class="content-holder"><p><?php kariez_html( $service ['sub_title'], 'allow_title' );?></p></div>
                    <?php } ?>

                    <?php if ( !empty($service['show_read_more_btn'] ) ) { ?>
                        <div class="rt-view-button">
                            <a class="rt-view-btn" href="<?php echo esc_url( $service['button_url'] ); ?>">
                                <span class="button-text"><?php echo esc_html( $service['show_read_more_btn'] );?>
                                    <?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?>
                                </span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php $i++; } ?>
    </div>
</div>
