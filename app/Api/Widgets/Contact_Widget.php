<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Api\Widgets;

use \WP_Widget;
use \RT_Widget_Fields;

class Contact_Widget extends WP_Widget {

	public function __construct() {
		$id    = KARIEZ_CORE_PREFIX . '_contact';
		$title = __( 'Kariez: Contact', 'kariez-core' );
		$args  = [
			'description' => esc_html__( 'Displays Contact Info', 'kariez-core' )
		];
		parent::__construct( $id, $title, $args );
	}


	public function form( $instance ) {
		$defaults = [
            'phone'   => kariez_option( 'rt_phone' ),
            'website' => kariez_option( 'rt_website' ),
			'address' => kariez_option( 'rt_contact_address' ),
			'mail'    => kariez_option( 'rt_email' ),
            'label-text' => kariez_option( 'rt-label' ),
            'label-text-2' => kariez_option( 'rt-label-2' ),
            'label-text-3' => kariez_option( 'rt-label-3' ),
            'label-text-4' => kariez_option( 'rt-label-4' ),
			'logo'        => '',
			'facebook'    => '',
			'twitter'     => '',
			'linkedin'    => '',
			'pinterest'   => '',
			'instagram'   => '',
			'youtube'     => '',
			'rss'         => '',
			'tiktok'      => '',
			'shortcode'   => '',
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'   => [
				'label' => esc_html__( 'Title', 'kariez-core' ),
				'type'  => 'text',
			],
			'logo'        => [
				'label' => esc_html__( 'Logo', 'kariez-core' ),
				'type'  => 'image',
				'desc'  => esc_html__( 'Conditionally display the light or dark logo based on the chosen footer style; refrain from preselecting any logo. ', 'kariez-core' ),
			],
			'address' => [
				'label' => esc_html__( 'Address', 'kariez-core' ),
				'type'  => 'textarea',
			],
			'mail'    => [
				'label' => esc_html__( 'Mail', 'kariez-core' ),
				'type'  => 'text',
			],
			'phone'   => [
				'label' => esc_html__( 'Phone', 'kariez-core' ),
				'type'  => 'text',
			],
            'label-text'   => [
                'label' => esc_html__( 'Label-text', 'kariez-core' ),
                'type'  => 'text',
            ],
            'label-text-2'   => [
                'label' => esc_html__( 'Label-text-2', 'kariez-core' ),
                'type'  => 'text',
            ],
            'label-text-3'   => [
                'label' => esc_html__( 'Label-text-3', 'kariez-core' ),
                'type'  => 'text',
            ],
            'label-text-4'   => [
                'label' => esc_html__( 'Label-text-4', 'kariez-core' ),
                'type'  => 'text',
            ],
			'website' => [
				'label' => esc_html__( 'Website', 'kariez-core' ),
				'type'  => 'text',
			],
			'facebook'    => [
				'label' => esc_html__( 'Facebook URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'twitter'     => [
				'label' => esc_html__( 'Twitter URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'linkedin'    => [
				'label' => esc_html__( 'Linkedin URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'pinterest'   => [
				'label' => esc_html__( 'Pinterest URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'instagram'   => [
				'label' => esc_html__( 'Instagram URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'youtube'     => [
				'label' => esc_html__( 'YouTube URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'rss'         => [
				'label' => esc_html__( 'Rss Feed URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'tiktok'        => [
				'label' => esc_html__( 'TikTok URL', 'kariez-core' ),
				'type'  => 'url',
			],
			'shortcode'    => [
				'label' => esc_html__( 'Input Shortcode', 'kariez-core' ),
				'type'  => 'textarea',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['logo']        = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
		$instance['address']     = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['mail']        = ( ! empty( $new_instance['mail'] ) ) ? strip_tags( $new_instance['mail'] ) : '';
		$instance['phone']       = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		$instance['website']     = ( ! empty( $new_instance['website'] ) ) ? strip_tags( $new_instance['website'] ) : '';
        $instance['label-text']     = ( ! empty( $new_instance['label-text'] ) ) ? strip_tags( $new_instance['label-text'] ) : '';
        $instance['label-text-2']     = ( ! empty( $new_instance['label-text-2'] ) ) ? strip_tags( $new_instance['label-text-2'] ) : '';
        $instance['label-text-3']     = ( ! empty( $new_instance['label-text-3'] ) ) ? strip_tags( $new_instance['label-text-3'] ) : '';
        $instance['label-text-4']     = ( ! empty( $new_instance['label-text-4'] ) ) ? strip_tags( $new_instance['label-text-4'] ) : '';
		$instance['facebook']    = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']     = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']    = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest']   = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['instagram']   = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['youtube']     = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['rss']         = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';
		$instance['tiktok']      = ( ! empty( $new_instance['tiktok'] ) ) ? sanitize_text_field( $new_instance['tiktok'] ) : '';
		$instance['shortcode']    = ( ! empty( $new_instance['shortcode'] ) ) ? sanitize_text_field( $new_instance['shortcode'] ) : '';

		return $instance;
	}

	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			echo $html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}


		echo kariez_contact_render( $instance );

		kariez_about_social( $instance );

		if ( ! empty( $instance['shortcode'] ) ) {
			echo "<div class='footer-shortcode'>";
			echo do_shortcode( $instance['shortcode'] );
			echo "</div>";
		}

		echo wp_kses_post( $args['after_widget'] );
	}
}