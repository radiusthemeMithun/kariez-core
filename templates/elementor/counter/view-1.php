<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $number             string
 * @var $unit               string
 * @var $title              string
 * @var $layout             string
 * @var $counter_shape      string
 * @var $icon_type          string
 * @var $counter_icon       string
 * @var $speed              string
 * @var $steps              string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 * @var $scroll_animation   string
 * @var $range_one          string
 * @var $range_two          string
 * @var $x_range            string
 * @var $y_range            string
 *
 */
use Elementor\Icons_Manager;
$range_one = ( $scroll_animation == 'yes' ) ? $range_one : '';
$range_two = ( $scroll_animation == 'yes' ) ? $range_two : '';

?>

<div class="rt-counter-layout rt-counter-<?php echo esc_attr( $layout ) ?>" data-parallax='{"<?php echo esc_attr( $x_range );?>" : <?php echo esc_attr( $range_one );?>, "<?php echo esc_attr( $y_range );?>" : <?php echo esc_attr( $range_two );?>}'>
	<div class="rt-counter-box <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
        <div class="counter-wrap">

        <div class="counter-number">
            <span class="counter" data-num="<?php echo esc_html( $number ); ?>" data-rtspeed="<?php echo esc_attr( $speed );?>" data-rtsteps="<?php echo esc_attr( $steps );?>" data-hover="<?php echo esc_html( $number ); ?>"><?php echo esc_html( $number ); ?></span>
            <?php if( $unit ) { ?><span class="counter-unit" data-hover="<?php echo esc_html( $unit ); ?>"><?php echo esc_html( $unit ); ?> </span><?php } ?>
        </div>
            <?php if( $layout == 'layout-1') { ?>
                <p class="counter-label"><?php kariez_html( $title, 'allow_title' );?></p>
            <?php } ?>
            <?php if( $layout == 'layout-2' ) { ?>
                <p class="counter-label"><?php kariez_html( $title, 'allow_title' );?></p>
            <?php } ?>

        </div>

    </div>
</div>