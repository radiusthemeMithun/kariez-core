<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $top_sub_title                  string
 * @var $sub_title_style                string
 * @var $title                          string
 * @var $main_title_tag                 string
 * @var $animation                      string
 * @var $animation_effect               string
 * @var $delay                          string
 * @var $duration                       string
 * @var $title_layout                   string
 *
 */


?>
<div class="section-title-wrapper section-title-wrapper-<?php echo esc_attr( $title_layout ) ?>">
	<div class="title-inner-wrapper">
		<!--Top Sub Title-->
        <?php if ( $top_sub_title ): ?>
            <div class="top-sub-title-wrap <?php echo esc_attr( $animation );?>
			<?php echo esc_attr( $animation_effect );?>" data-wow-delay="200ms" data-wow-duration="1200ms">
                <div class="top-sub-title <?php echo esc_attr( $sub_title_style );?>">
                    <?php echo esc_html( $top_sub_title ); ?>
                </div>
            </div>
        <?php endif; ?>

		<!--Main Title-->
		<?php if ( $title ): ?>
        <div class="<?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="400ms" data-wow-duration="1200ms">
            <<?php echo esc_attr( $main_title_tag ) ?> class="main-title">
            <?php kariez_html( $title, 'allow_title' );?>
        </<?php echo esc_attr( $main_title_tag ) ?>>
        </div>
        <?php endif; ?>
    </div>
</div>