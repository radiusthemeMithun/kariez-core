<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\KariezCore\Abstracts\ElementorBase;
use RT\KariezCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SiteLogo extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Site Logo', 'kariez-core' );
		$this->rt_base = 'rt-site-logo';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

//        $this->add_control(
//            'layout',
//            [
//                'label'   => esc_html__( 'Layout', 'kariez-core' ),
//                'type'    => Controls_Manager::SELECT,
//                'default' => 'layout-1',
//                'options' => [
//                    'layout-1' => __( 'Logo', 'kariez-core' ),
//                ],
//            ]
//        );

		$this->add_control(
			'logo_mode',
			[
				'label'       => esc_html__( 'Logo Mode', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'dark' => __( 'Default', 'kariez-core' ),
					'light' => __( 'Light', 'kariez-core' ),
				],
				'default'     => 'dark',
			]
		);


		$this->add_control(
			'important_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'This widget works depending on the logo setting from [Customize > Site Identity].', 'kariez-core' ),
				'content_classes' => 'elementor-panel-notice elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'logo_title',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Logo Title', 'kariez-core' ),
				'default' => '',
				'content_classes' => 'elementor-panel-notice elementor-panel-alert elementor-panel-alert-info',
				'desciption' => esc_html__('If you don\'t upload logo from the Customize this title will display as a text logo.', 'kariez-core'),
			]
		);


		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'kariez-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'kariez-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'kariez-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'kariez-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .site-branding' => 'text-align: {{VALUE}};justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);


		$this->add_responsive_control(
			'logo_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Logo Width', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .site-branding img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'logo_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Logo Height', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .site-branding img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';

		Fns::get_template( "elementor/site-logo/$template", $data );
	}

}