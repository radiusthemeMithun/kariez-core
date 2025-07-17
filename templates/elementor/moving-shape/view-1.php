<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout             string
 *@var  $image_shape        string
 * @var $animation          string
 *
 *
 */

?>

<?php if ($layout == 'moving-style1') { ?>
    <div class="moving-shape-wrap <?php echo esc_attr( $layout ) ?>">
        <div class="about-round-box">
            <div class="moving-shape-box">
                <i class="icon-logo-shape"></i>
                <div class="about-shape">
                    <div class="shape <?php echo $animation? 'spin' : ''; ?>">
				        <?php echo wp_get_attachment_image( $image_shape['id'], 'full' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


