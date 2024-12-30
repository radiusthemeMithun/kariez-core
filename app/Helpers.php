<?php
/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 *
 * @package kariez-core
 */


if ( ! function_exists( 'kariez_about_social' ) ) {
	/**
	 * Get about social icon list
	 * @return void
	 */
	function kariez_about_social( $instance ) {
		$icon_style = kariez_option( 'rt_social_icon_style' ) ?? '';
		$html       = '';

		if ( ! empty( $instance['facebook'] ) ) :
			$html .= '<a href="' . esc_url( $instance["facebook"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'facebook' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["twitter"] ) ) :
			$html .= '<a href="' . esc_url( $instance["twitter"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'twitter' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["linkedin"] ) ) :
			$html .= '<a href="' . esc_url( $instance["linkedin"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'linkedin' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["pinterest"] ) ) :
			$html .= '<a href="' . esc_url( $instance["pinterest"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'pinterest' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["instagram"] ) ) :
			$html .= '<a href="' . esc_url( $instance["instagram"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'instagram' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["youtube"] ) ) :
			$html .= '<a href="' . esc_url( $instance["youtube"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'youtube' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["rss"] ) ) :
			$html .= '<a href="' . esc_url( $instance["rss"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'rss' . $icon_style ) . '</a>';
		endif; ?>

		<?php if ( ! empty( $instance["tiktok"] ) ) :
			$html .= '<a href="' . esc_url( $instance["tiktok"] ) . '" target="_blank" aria-label="social icon">' . kariez_get_svg( 'tiktok' . $icon_style ) . '</a>';
		endif;
		?>
		<?php if ( $html ) : ?>
            <div class="footer-social">
				<?php echo $html; ?>
            </div>
		<?php endif ?>
		<?php
	}
}

if ( ! function_exists( 'kariez_contact_render' ) ) {
	function kariez_contact_render( $instance ) {
		ob_start();
		?>
        <div class="kariez-contact-widget-wrapper">
			<?php if ( ! empty( $instance['logo'] ) ) { ?>
                <div class="footer-widget-logo">
					<?php echo wp_get_attachment_image( $instance['logo'], 'full' ); ?>
                </div>
			<?php } ?>
            <ul>

                <?php if ( ! empty( $instance['phone'] ) ) : ?>
                    <li class="phone-no">
                        <div class="phone-box">
                            <span class="phone-icon"><i class="icon-phone-fill"></i></span>
                            <div class="content">
                                <span class="rt-sm-footer-text"><?php echo esc_html( $instance['label-text'] );?></span>
                                <a target="_blank" href="tel:<?php echo esc_attr( $instance['phone'] ); ?>">
                                    <?php echo esc_html( $instance['phone'] ); ?>
                                </a>
                            </div>
                        </div>

                    </li>
                <?php endif; ?>

                <?php if ( ! empty( $instance['website'] ) ) : ?>
                    <li>
                        <div class="website-box">
                            <span class="rt-sm-footer-text"><?php echo esc_html( $instance['label-text-2'] );?></span>
                            <a target="_blank" href="<?php echo esc_url( $instance['website'] ); ?>">
                                <?php echo esc_html( $instance['website'] ); ?>
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
				<?php if ( ! empty( $instance['address'] ) ) : ?>
                    <li>
                        <div class="address-box">
                            <span class="rt-sm-footer-text"><?php echo esc_html( $instance['label-text-3'] );?></span>
                            <?php echo esc_html( $instance['address'] ); ?>
                        </div>

                    </li>
				<?php endif; ?>



				<?php if ( ! empty( $instance['mail'] ) ) : ?>
                    <li>
                        <div class="mail-box">
                            <span class="rt-sm-footer-text"><?php echo esc_html( $instance['label-text-4'] );?></span>
                            <a target="_blank"
                               href="mailto:<?php echo esc_html( $instance['mail'] ); ?>"><?php echo esc_html( $instance['mail'] ); ?>
                            </a>
                        </div>
                    </li>
				<?php endif; ?>


            </ul>
        </div>
		<?php
		return ob_get_clean();
	}
}

//Custom post category list

function rt_all_posts( $post_type ) {
	global $post;
	$type  = $post_type ? $post_type : 'post';
	$args  = [ 'numberposts' => - 1, 'post_type' => $type, ];
	$posts = get_posts( $args );

	$categories = [];

	foreach ( $posts as $pn_cat ) {
		$categories[ $pn_cat->ID ] = get_the_title( $pn_cat->ID );
	}

	return $categories;
}

function rt_taxonomy_post( $taxonomy = 'category' ) {
	$categories = get_categories( [ 'taxonomy' => $taxonomy ] );

	if ( empty( $categories ) ) {
		return;
	}

	$category_dropdown = [];

	foreach ( $categories as $category ) {
		$category_dropdown[ $category->term_id ] = $category->name;
	}

	return $category_dropdown;
}

//post category list
function rt_category_list() {
	$categories = get_categories( [ 'hide_empty' => false ] );
	$lists      = [];
	foreach ( $categories as $category ) {
		$lists[ $category->cat_ID ] = $category->name;
	}

	return $lists;
}


// post tags lists
function rt_tag_list() {
	$tags     = get_tags( [ 'hide_empty' => false ] );
	$tag_list = [];
	foreach ( $tags as $tag ) {
		$tag_list[ $tag->slug ] = $tag->name;
	}

	return $tag_list;
}

//Get all thumbnail size
function rt_get_all_image_sizes() {
	global $_wp_additional_image_sizes;
	$image_sizes = [ '0' => __( 'Default Image Size', 'kariez-core' ) ];
	foreach ( $_wp_additional_image_sizes as $index => $item ) {
		$image_sizes[ $index ] = __( ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] ), 'kariez-core' );
	}
	$image_sizes['full'] = __( "Full Size", 'kariez-core' );

	return $image_sizes;
}