<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout             string
 * @var $title              string
 * @var $title_tag          string
 * @var $process_list       string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 * @var $item_space         string
 * @var $col_xl             string
 * @var $col_lg             string
 * @var $col_md             string
 * @var $col_sm             string
 * @var $col_xs             string
 * @var $number_display     string
 * @var $step_display       string
 */

//$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
?>

<div class="rt-working-process rt-process-<?php echo esc_attr( $layout ); ?>">
    <div class="rt-center-line">
        <?php $i = 1; foreach($process_list as $item) { ?>
            <div class="rt-step-dot has-animation rt-step-dot-item<?php echo esc_attr( $i );?>"></div>
        <?php $i++; } ?>
    </div>
    <div class="process-wrap">
    <?php $ade = $delay; $adu = $duration; $j = 1;

        foreach($process_list as $item) {
            if ( $j % 2 == 0 ) {
                $item_parity  = 'even';
            }
            else {
                $item_parity  = 'odd';
            }
            ?>

            <div class="process-item <?php echo esc_attr( $item_parity  );?> <?php if( !empty( $alignment ) ) { ?><?php echo esc_attr( $alignment );?><?php } ?> elementor-repeater-item-<?php echo esc_attr($item['_id']) ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <div class="process-content">
                    <?php if( $item['title'] ) { ?><<?php echo esc_attr( $title_tag ) ?> class="rt-title"><a class="title-link"><?php echo kariez_html( $item['title'], 'allow_title' );?></a></<?php echo esc_attr( $title_tag ) ?>><?php } ?>
                    <div class="rt-content"><?php echo kariez_html( $item['content'], 'allow_title' );?></div>
                </div>
            </div>
        <?php $ade = $ade + 200; $adu = $adu + 0; $j++; } ?>
    </div>
</div>
