<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 *
 * @var $thumbnail_visibility       string
 * @var $project_thumbnail_size     string
 * @var $cat_visibility             string
 * @var $content_visibility         string
 * @var $readmore_visibility        string
 * @var $readmore_text              string
 * @var $author_visibility          string
 * @var $date_visibility            string
 * @var $comment_visibility         string
 * @var $reading_visibility         string
 * @var $content_limit              string
 * @var $views_visibility           string
 * @var $title_tag                  string
 * @var $title_count                string
 */


$has_entry_meta  = ( $author_visibility || $cat_visibility || $comment_visibility || $reading_visibility ) ? true : false;

$content = wp_trim_words( get_the_excerpt(), $content_limit, '.' );
$content = "<p>$content</p>";
$title = wp_trim_words( get_the_title(), $title_count, '' );
$comments_number = get_comments_number();
$comments_text   = sprintf( _n( 'Comment: %s', 'Comments: %s', $comments_number, 'kariez-core' ), number_format_i18n( $comments_number ) );

?>
<div class="article-inner-wrapper">
	<?php if( 'visible' === $thumbnail_visibility && !empty( has_post_thumbnail() ) ) { ?>
        <div class="post-thumbnail-wrap">
            <figure class="post-thumbnail">
                <a class="post-thumb-link alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( $project_thumbnail_size ); ?>
                </a>
            </figure>
	        <?php if ( $cat_visibility ) { ?>
            <div class="separate-meta title-above-meta">
	            <?php echo kariez_posted_in(); ?>
            </div>
	        <?php } ?>
        </div>
	<?php } ?>
    <div class="entry-wrapper">
        <header class="entry-header">
	        <?php if ( $has_entry_meta ) { ?>
                <div class="rt-post-meta">
                    <ul class="entry-meta">
				        <?php if ( $author_visibility ) { ?>
                            <li><i class="icon-rt-user-1"></i><?php echo kariez_posted_by(esc_html__( 'by ', 'kariez-core' )); ?></li>
				        <?php } if ( $date_visibility ) { ?>
                            <li><i class="icon-rt-calender-4"></i><?php echo kariez_posted_on(); ?></li>
				        <?php } if ( $cat_visibility && empty( has_post_thumbnail() ) ) { ?>
                            <li><i class="icon-rt-calender-4"></i><?php echo kariez_posted_in(); ?></li>
				        <?php } if ( $comment_visibility ) { ?>
                            <li><i class="icon-rt-comments"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $comments_text , 'allowed_html' );?></a></li>
				        <?php } if ( $reading_visibility ) { ?>
                            <li><i class="icon-rt-clock"></i><?php echo kariez_reading_time(); ?></li>
				        <?php } if ( $views_visibility ) { ?>
                            <li><i class="icon-rt-eye"></i><?php echo rt_post_views(); ?></li>
				        <?php } ?>
                    </ul>
                </div>
	        <?php } ?>
            <<?php echo esc_attr( $title_tag ) ?> class="entry-title default-max-width"><a href="<?php the_permalink();?>"><?php kariez_html( $title, 'allow_title' ); ?></a></<?php echo esc_attr( $title_tag ) ?>>
        </header>
		<?php if( 'visible' === $content_visibility ) { ?>
            <div class="entry-content">
	            <?php kariez_html( $content , false ); ?>
            </div>
		<?php } ?>
		<?php if( 'visible' === $readmore_visibility ) { ?>
            <div class="rt-button entry-footer">
                <a class="btn button-2" href="<?php the_permalink();?>">
	                <?php echo esc_html( $readmore_text );?><i class="icon-rt-arrow-right-1"></i>
                </a>
            </div>
		<?php } ?>
    </div>
</div>
