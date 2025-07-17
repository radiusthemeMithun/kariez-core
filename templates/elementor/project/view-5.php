<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $post_limit                 string
 * @var $post_ordering              string
 * @var $post_orderby               string
 * @var $query_type                 string
 * @var $content_count              string
 * @var $content_type               string
 * @var $layout                     string
 * @var $item_space                 string
 * @var $col_xl                     string
 * @var $col_lg                     string
 * @var $col_md                     string
 * @var $col_sm                     string
 * @var $col_xs                     string
 * @var $category_display           string
 * @var $button_display             string
 * @var $content_display            string
 * @var $title_tag                  string
 * @var $project_thumbnail_size     string
 * @var $grayscale_display          string
 * @var $button_icon                string
 * @var $link_popup                 string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 * @var $button_text                string
 * @var $read_more_btn              string
 * @var $read_more_text             string
 */

use Elementor\Icons_Manager;

$args = array(
	'post_type'      	=> 'rt-project',
	'posts_per_page' 	=> $post_limit,
	'order' 			=> $post_ordering,
	'orderby' 			=> $post_orderby,
);

if( !empty( $cat_id ) ){
	if( $query_type == 'category'){
		$args['tax_query'] = [
			[
				'taxonomy' => 'rt-project-category',
				'field' => 'term_id',
				'terms' => $cat_id,
			],
		];
	}
}
if( !empty( $post_id ) ){
	if( $query_type == 'posts'){
		$args['post__in'] = $post_id;
	}
}

$thumb_size = '';
if( $project_thumbnail_size ) {
	$thumb_size = $project_thumbnail_size;
} else {
	$thumb_size = 'kariez-size7';
}

$query = new WP_Query( $args );
$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";

?>
<div class="rt-project-default rt-project-multi-layout-default project-grid-<?php echo esc_attr( $layout );?>">
	<div class="row <?php echo esc_attr( $item_space );?>">
		<?php $ade = $delay; $adu = $duration; if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$id = get_the_ID();

				if ( $content_type == 'content' ) {
					$content = apply_filters( 'the_content', get_the_content() );
				}
				else {
					$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
				}
				$content = wp_trim_words( $content, $content_count, '' );
				$content = "$content";

				?>
                <div class="<?php echo esc_attr( $col_class );?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                    <div class="project-item">
                        <div class="project-thumbs <?php if( empty( $button_display ) ) { ?>shape-hidden<?php } ?> <?php echo esc_attr( $grayscale_display );?>">
	                        <?php kariez_post_thumbnail( esc_attr( $thumb_size ) ); ?>
                            
                        </div>
                        <div class="project-content">
                            <div class="project-info">

                                <?php if ( $category_display ) { ?>
                                    <span class="project-cat"><?php
                                        $i = 1;
                                        $term_lists = get_the_terms( get_the_ID(), 'rt-project-category' );
                                        if( $term_lists ) {
                                            foreach ( $term_lists as $term_list ){
                                                $link = get_term_link( $term_list->term_id, 'rt-project-category' ); ?>
                                                <?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>">
                                                <?php echo esc_html( $term_list->name ); ?></a><?php $i++; } } ?></span>
                                <?php } ?>

                                <<?php echo esc_attr( $title_tag ) ?> class="project-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag ) ?>>

	                        <div class="project-hover-content">
		                        <?php if ( $content_display == 'yes' ) { ?>
                                    <div class="project-excerpt"><?php kariez_html( $content , false ); ?></div>
		                        <?php } ?>
		                        <?php if ($read_more_btn == 'yes') {  ?>
                                    <a class="project-btn" href="<?php the_permalink();?>" aria-label="button link">
                                        <span class="button-text"><?php kariez_html( $read_more_text,  false); ?></span>
                                    </a>
		                        <?php } ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $ade = $ade + 200; $adu = $adu + 0; } ?>
	<?php wp_reset_postdata(); ?>
		<?php } ?>
	</div>
</div>