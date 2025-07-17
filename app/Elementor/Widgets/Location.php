<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\KariezCore\Helper\Fns;
use RT\KariezCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class Location extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Location', 'kariez-core');
		$this->rt_base = 'rt-location';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_location',
			[
				'label' => esc_html__( 'Location', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'location_img',
			[
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'label'   => esc_html__( 'Location Image', 'kariez-core' ),
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'location', [
				'label'       => __( 'Location Name', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Democratic Works Republic of the Congo, Kamina ', 'kariez-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'location_position',
			[
				'label'     => __( 'Location Position', 'kariez-core' ),
				'type'        => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$repeater->add_responsive_control(
			'position_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Horizontal', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{size}}{{unit}}',
				],
			]
		);

		$repeater->add_responsive_control(
			'position_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Vertical', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{size}}{{unit}}',
				],
			]
		);





//
//		$repeater->add_responsive_control(
//			'location_position_horizontal_left',
//			[
//				'label'      => __( 'Horizontal Position', 'kariez-core' ),
//				'type'        => Controls_Manager::SELECT,
//				'size_units' => [ 'px', '%' ],
//				'range'      => [
//					'px' => [
//						'min'  => - 5000,
//						'max'  => 5000,
//						'step' => 1,
//					],
//					'%'  => [
//						'min' => - 100,
//						'max' => 100,
//					],
//				],
//				'default'    => [
//					'unit' => 'px',
//					'size' => 0,
//				],
//				'selectors'  => [
//					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{size}}{{unit}}',
//				],
//				'condition'  => [
//					'location_horizontal_position' => 'left',
//				],
//
//			]
//		);
//
//		$repeater->add_responsive_control(
//			'location_position_horizontal_right',
//			[
//				'label'      => __( 'Horizontal Position', 'kariez-core' ),
//				'type'        => Controls_Manager::SLIDER,
//				'size_units' => [ 'px', '%' ],
//				'range'      => [
//					'px' => [
//						'min'  => - 5000,
//						'max'  => 5000,
//						'step' => 1,
//					],
//					'%'  => [
//						'min' => - 100,
//						'max' => 100,
//					],
//				],
//				'default'    => [
//					'unit' => 'px',
//					'size' => 0,
//				],
//				'selectors'  => [
//					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{size}}{{unit}}',
//				],
//				'condition'  => [
//					'location_horizontal_position' => 'right',
//				],
//
//			]
//		);
//		$repeater->add_responsive_control(
//			'location_vertical_position',
//			[
//				'label'   => __( 'Vertical Position Base', 'kariez-core' ),
//				'type'        => Controls_Manager::SELECT,
//				'default' => 'top',
//				'options' => [
//					'top'    => __( 'Top', 'kariez-core' ),
//					'bottom' => __( 'Bottom', 'kariez-core' ),
//				],
//			]
//		);
//		$repeater->add_responsive_control(
//			'location_position_vartical_top',
//			[
//				'label'      => __( 'Vertical Position', 'kariez-core' ),
//				'type'        => Controls_Manager::SLIDER,
//				'size_units' => [ 'px', '%' ],
//				'range'      => [
//					'px' => [
//						'min'  => - 5000,
//						'max'  => 5000,
//						'step' => 1,
//					],
//					'%'  => [
//						'min' => - 100,
//						'max' => 100,
//					],
//				],
//				'default'    => [
//					'unit' => 'px',
//					'size' => 0,
//				],
//				'selectors'  => [
//					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{size}}{{unit}}',
//				],
//				'condition'  => [
//					'location_vertical_position' => 'top',
//				],
//
//			]
//		);
//		$repeater->add_responsive_control(
//			'location_position_vartical_bottom',
//			[
//				'label'      => __( 'Vertical Position', 'kariez-core' ),
//				'type'        => Controls_Manager::SLIDER,
//				'size_units' => [ 'px', '%' ],
//				'range'      => [
//					'px' => [
//						'min'  => - 5000,
//						'max'  => 5000,
//						'step' => 1,
//					],
//					'%'  => [
//						'min' => - 100,
//						'max' => 100,
//					],
//				],
//				'default'    => [
//					'unit' => 'px',
//					'size' => 0,
//				],
//				'selectors'  => [
//					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{size}}{{unit}}',
//				],
//				'condition'  => [
//					'location_vertical_position' => 'bottom',
//				],
//
//			]
//		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Location Item', 'kariez-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[

						'content' => __( 'Democratic Works Republic of the Congo, Kamina', 'kariez-core' ),

					],

				],
				'title_field' => '{{{ name }}}',
			]
		);


		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/location/$template", $data );
	}
}