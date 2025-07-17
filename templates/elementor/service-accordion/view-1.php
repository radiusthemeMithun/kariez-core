
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $service_items              string
 * @var $rt_icon                    string
 * @var $title_tag                  string

 */

$services = array();
foreach ( $service_items as $service_list ) {
	$services[] = array(
		'icon'              => $service_list['rt_icon'],
		'title'             => $service_list['title'],
		'title_url'         => $service_list['title_url']['url'],
		'img'               => $service_list['service_image']['url'] ? $service_list['service_image']['url'] : '',
	);
}
?>

<div class="rt-service-accordion">
    <div class="rt-service-accordion-wrap">
		<?php $i = 1;
		foreach ($services as $service){

        ?>
        <div class="item item-<?php echo esc_attr( $i ); ?>" data-bg-image="<?php echo esc_attr($service['img']); ?>">
            <div class="content">
                <div class="inner">
                    <span class="rt-accordion-icon">
                         <?php if( $service['icon'] ) { ?><?php \Elementor\Icons_Manager::render_icon( $service['icon']); ?><?php } ?>
                    </span>
					<?php if( !empty( $service['title'] ) ) { ?>
                    <<?php echo esc_attr( $title_tag ) ?> class="accordion-title">
                    <a href="<?php echo esc_url( $service['title_url'] ); ?>">
		                <?php echo kariez_html( $service['title'], 'allow_title' ); ?>
                    </a>
                </<?php echo esc_attr( $title_tag ) ?>>
				<?php } ?>
            </div>
        </div>
    </div>
	<?php $i++; } ?>
</div>
</div>
