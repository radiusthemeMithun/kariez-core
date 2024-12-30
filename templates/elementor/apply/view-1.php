<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout             string
 * @var $title              string
 * @var $title_tag          string
 * @var $job_list           string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 * @var $item_space         string
 * @var $title_display      string
 * @var $btn_display        string
 * @var $upper_title        string
 * @var $upper_title2       string
 * @var $upper_title3       string
 * @var $upper_title4       string
 */


?>

<div class="rt-job-apply rt-job-apply-<?php echo esc_attr( $layout ); ?>">

    <div class="job-apply-wrap">
        <div class="box-list">
            <div class="box-title"><?php kariez_html( $upper_title, 'allow_title' );?></div>
            <div class="box-title"><?php kariez_html( $upper_title2, 'allow_title' );?></div>
            <div class="box-title"><?php kariez_html( $upper_title3, 'allow_title' );?></div>
            <div class="box-title"><?php kariez_html( $upper_title4, 'allow_title' );?></div>
        </div>
    <?php $ade = $delay; $adu = $duration;

        foreach($job_list as $item) {

            $attr = '';
            if (!empty($item['link']['url'])) {
                $attr = 'href="' . $item['link']['url'] . '"';
                $attr .= !empty($item['url']['is_external']) ? ' target="_blank"' : '';
                $attr .= !empty($item['url']['nofollow']) ? ' rel="nofollow"' : '';
            }
            ?>

            <div class="apply-item <?php if( !empty( $alignment ) ) { ?><?php echo esc_attr( $alignment );?><?php } ?> elementor-repeater-item-<?php echo esc_attr($item['_id']) ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <div class="apply-content">
                    <div class="title-box">
                        <?php if ( $item['title'] && $title_display ) { ?>
                            <h3 class="info-title"><?php echo esc_html( $item['title'] ); ?></h3>
                        <?php } ?>
                        <p><?php echo esc_html( $item['content'] ); ?></p>
                    </div>
                    <div class="rt-location"><?php echo esc_html( $item['location'] ); ?></div>
                    <div class="rt-type"><?php echo esc_html( $item['type'] ); ?></div>
                    <?php if ($btn_display) { ?>
                        <a class="apply-btn" <?php echo $attr; ?> ><?php echo esc_html( $item['rt-button'] ); ?></a><?php }?>
                </div>
            </div>
        <?php $ade = $ade + 200; $adu = $adu + 0; } ?>
    </div>
</div>
