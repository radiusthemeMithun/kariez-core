
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $project_items              string
 * @var $rt_icon                    string
 * @var $title_tag                  string

 */

$projects = array();
foreach ( $project_items as $project_list ) {
	$projects[] = array(
		'title'             => $project_list['title'],
		'title_url'         => $project_list['title_url']['url'],
		'category'          => $project_list['category'],
		'rt_desc'           => $project_list['rt_desc'],
		'accordion_btn'     => $project_list['accordion_btn'],
		'img'               => $project_list['project_image']['url'] ? $project_list['project_image']['url'] : '',
	);
}
?>

<div class="rt-project-accordion">
    <div class="rt-project-accordion-wrap">
		<?php $i = 1;
		foreach ($projects as $project){

        ?>
        <div class="item item-<?php echo esc_attr( $i ); ?>" data-bg-image="<?php echo esc_attr($project['img']); ?>">
            <div class="content">
                <div class="inner">
                    <span class="rt-accordion-category">
                        <a href="<?php echo esc_url( $project['title_url'] ); ?>">
		                    <?php echo kariez_html( $project['category'], 'allow_title' ); ?>
                        </a>
                    </span>
					<?php if( !empty( $project['title'] ) ) { ?>
                    <<?php echo esc_attr( $title_tag ) ?> class="accordion-title">
                    <a href="<?php echo esc_url( $project['title_url'] ); ?>">
		                <?php echo kariez_html( $project['title'], 'allow_title' ); ?>
                    </a>
                </<?php echo esc_attr( $title_tag ) ?>>
				<?php } ?>
            </div>
            <div class="hover-content">
	            <span class="rt-accordion-category">
                        <a href="<?php echo esc_url( $project['title_url'] ); ?>">
		                    <?php echo kariez_html( $project['category'], 'allow_title' ); ?>
                        </a>
                    </span>
	            <?php if( !empty( $project['title'] ) ) { ?>
                <<?php echo esc_attr( $title_tag ) ?> class="accordion-title">
                <a href="<?php echo esc_url( $project['title_url'] ); ?>">
		            <?php echo kariez_html( $project['title'], 'allow_title' ); ?>
                </a>
            </<?php echo esc_attr( $title_tag ) ?>>
	        <?php } ?>
                <div class="desc">
	                <?php echo kariez_html( $project['rt_desc'] ); ?>
                </div>
                <div class="accordion-button">
                    <a href="<?php echo esc_url( $project['title_url'] ); ?>">
		                <?php echo kariez_html( $project['accordion_btn'], 'allow_title' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
	<?php $i++; } ?>
</div>
</div>
