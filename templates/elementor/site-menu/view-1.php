<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $nav_menu         string
 */


if ( $nav_menu == '0' ) {
	return;
}
?>
<nav class="kariez-navigation" role="navigation">
	<?php
	wp_nav_menu( [
		'menu'        => $nav_menu,
		'menu_class'  => 'kariez-navbar',
		'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb' => 'kariez_custom_menu_cb',
		'walker'      => has_nav_menu( 'primary' ) ? new RT\Kariez\Core\WalkerNav() : '',
	] );
	?>
</nav>