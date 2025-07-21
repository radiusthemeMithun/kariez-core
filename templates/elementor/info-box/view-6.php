<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                     string
 * @var $link                       string
 * @var $bg_animation               string
 * @var $icon_animation             string
 * @var $image_invert               string
 * @var $icon_type                  string
 * @var $image_icon                 string
 * @var $info_icon                  string
 * @var $info_image_display         string
 * @var $info_image                 string
 * @var $title                      string
 * @var $sub_title                  string
 * @var $show_read_more_btn         string
 * @var $read_more_btn_text         string
 * @var $button_icon                string
 * @var $title_tag                  string
 * @var $show_btn_icon              string
 * @var $show_btn_text              string
 * @var $shape_display              string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 */

$attr = '';
if ( !empty( $link['url'] ) ) {
	$attr  = 'href="' . $link['url'] . '"';
	$attr .= !empty( $link['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
	$attr .= ' aria-label="info link"';
}
?>

<div class="rt-info-box rt-info-<?php echo esc_attr( $layout ) ?>">
    <div class="info-box <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
        <?php if( $image_icon['id'] || $info_icon ) { ?>
        <div class="info-icon-holder icon-holder">
            <div class="info-icon">
                <?php
                echo $link['url'] ? '<a ' . $attr . '>' : null;
                if ( 'image' == $icon_type ) {
                    echo wp_get_attachment_image( $image_icon['id'], 'full' );
                } else {
                    \Elementor\Icons_Manager::render_icon( $info_icon, [ 'aria-hidden' => 'true' ] );
                }
                echo $link['url'] ? '</a>' : null;
                ?>
            </div>
        </div>
        <?php } ?>


        <div class="info-content-holder">
            <?php if ( $title ) { ?>
                <<?php echo esc_attr( $title_tag ); ?> class="info-title"><a <?php echo $attr; ?>>
                <?php kariez_html( $title, 'allow_title' );?></a></<?php echo esc_attr( $title_tag ); ?>>
            <?php } ?>
			<?php if ( $sub_title ) : ?>
                <div class="content-holder"><p><?php kariez_html( $sub_title, 'allow_title' );?></p></div>
			<?php endif; ?>

	        <?php if ( $info_image_display == 'yes' ) : ?>
            <div class="rt-info-image">
		        <?php echo wp_get_attachment_image( $info_image['id'], 'full' ); ?>
            </div>
	        <?php endif; ?>


			<?php if ( $show_read_more_btn ) : ?>
                <div class="rt-button <?php if( $show_btn_text ) { ?>button-hover-visibility<?php } ?>">
                    <a class="btn" <?php echo $attr; ?>>
                        <span class="button-text"><?php echo esc_html( $read_more_btn_text );?></span>
                        <span class="btn-round-shape">
                            <?php if( $show_btn_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?>
                        </span>
                    </a>
                </div>
			<?php endif; ?>
        </div>
    </div>
</div>