<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0*
 * @var $top_sub_title                  string
 * @var $sub_title_style                string
 * @var $title                          string
 * @var $main_title_tag                 string
 * @var $description                    string
 * @var $feature_lists                  string
 * @var $show_feature_list              string
 * @var $list_column                    string
 * @var $alignment                      string
 * @var $animation                      string
 * @var $animation_effect               string
 * @var $delay                          string
 * @var $duration                       string
 * @var $list_layout                    string
 * @var $title_layout                   string
 * @var $double_small_shape             string
 *
 */
use Elementor\Icons_Manager;


?>
<div class="section-title-wrapper section-title-wrapper-<?php echo esc_attr( $title_layout ) ?>">
	<div class="title-inner-wrapper">
		<!--Top Sub Title-->
		<?php if ( $top_sub_title ): ?>
			<div class="top-sub-title-wrap <?php echo esc_attr( $animation );?>
			<?php echo esc_attr( $animation_effect );?>" data-wow-delay="200ms" data-wow-duration="1200ms">
                <div class="top-sub-title has-animation <?php echo esc_attr( $sub_title_style );?>">
	                <?php if ($double_small_shape == 'yes') { ?>
                        <span class="double-round-subtitle-shape"></span>
	                <?php } ?>
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

        <!--Description-->
        <?php if ( $description ): ?>
            <div class="description <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="600ms" data-wow-duration="1200ms"><?php kariez_html( $description, 'allow_title' );?></div>
        <?php endif; ?>
        <?php if ( $feature_lists && $show_feature_list ) { ?>
            <ul class="feature-list <?php echo esc_attr( $list_layout );?> <?php echo esc_attr( $list_column );?>">
                <?php $ade = $delay; $adu = $duration; foreach ( $feature_lists as $feature): ?>
                    <li class="<?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms"><?php if( $feature['list_icon'] ) { ?><span class="icon"><?php Icons_Manager::render_icon( $feature['list_icon'] ); ?></span><?php } ?><?php echo esc_html( $feature['list_text'] ); ?></li>
                    <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
            </ul>
        <?php } ?>

    </div>
</div>