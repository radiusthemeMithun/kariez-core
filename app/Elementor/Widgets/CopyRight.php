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

class CopyRight extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Copy Right', 'kariez-core' );
		$this->rt_base = 'rt-copy-right';
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

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Layout', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'default' => __( 'Default', 'kariez-core' ),
					'custom' => __( 'Custom', 'kariez-core' ),
				],
				'default'     => 'default',
			]
		);


		$this->add_control(
			'important_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'This widget works depending on the copyright setting from [Customize > Footer].', 'kariez-core' ),
				'content_classes' => 'elementor-panel-notice elementor-panel-alert elementor-panel-alert-info',
				'condition'  => [
					'layout' => 'default',
				],
			],

		);

		$this->add_control(
			'copyright_text',
			[
				'label'       => esc_html__( 'Custom Text', 'kariez-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'rows'        => 4,
				'default'     => __( 'Copyright © 2024 Kariez by RadiusTheme', 'kariez-core' ),
				'condition'  => [
					'layout' => 'custom',
				],
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
					'{{WRAPPER}} .copyright-text' => 'text-align: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		// Button Icon Settings
		$this->add_control(
			'copyright_style_heading',
			[
				'label'     => __( 'Copyright Settings', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .copyright-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_link_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_link_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .copyright-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'margin',
			[
				'label'      => __( 'Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .copyright-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .copyright-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);



		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/copy-right/$template", $data );
	}

}