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

class ServiceHover extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Service Hover', 'kariez-core' );
		$this->rt_base = 'rt-services-hover-addon';
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


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'service_image', [
				'type' => Controls_Manager::MEDIA,
				'label' =>   esc_html__('Choose Image', 'kariez-core'),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater->add_control(
			'title', [
				'label' => __('Title', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Boxes Transportation', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'sub_title', [
				'label' => __('Content', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit mauris nullam the as integer.', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'show_read_more_btn', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'kariez-core' ),
				'default' => esc_html__( 'View More', 'kariez-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_url', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Button URL', 'kariez-core' ),
				'placeholder' => esc_url('https://your-link.com' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'service_hovers',
			[
				'label' => __('Service list', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Boxes Transportation', 'kariez-core'),
					],
					[
						'title' => __('Furniture Transportation', 'kariez-core'),
					],
					[
						'title' => __('Inland Transportation', 'kariez-core'),
					],
					[
						'title' => __('Cargo Transportation', 'kariez-core'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		// Title setting
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .service-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .service-title',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'kariez-core' ),
					'h2' => esc_html__( 'H2', 'kariez-core' ),
					'h3' => esc_html__( 'H3', 'kariez-core' ),
					'h4' => esc_html__( 'H4', 'kariez-core' ),
					'h5' => esc_html__( 'H5', 'kariez-core' ),
					'h6' => esc_html__( 'H6', 'kariez-core' ),
				],
			]
		);

		$this->end_controls_section();

		//Content

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder p',
			]
		);

		$this->end_controls_section();



		//view More Button Settings
		$this->start_controls_section(
			'view_button_settings',
			[
				'label' => esc_html__( 'Button Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typography', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn',
			]
		);
		$this->add_control(
			'view_button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'view_button_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn:hover' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'view_button_line_color',
				'label' => __('Active Line Color', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Active Line Color', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn .button-text:before',
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'            => __( 'Choose Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_read_more_btn' => [ 'is-read-more' ],
				],
			]
		);

		$this->add_control(
			'view_btn_icon_size',
			[
				'label'      => __( 'Icon Size', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 40,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors'  => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn .button-text i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn .button-text svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label'              => __( 'Icon Margin', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn .button-text i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item .info-content-holder .rt-view-button .rt-view-btn .button-text svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		//Box Setting
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Height', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Width', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'              => __( 'Padding', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .creative-service-style-01 .service-items .service-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .creative-service-style-01 .service-items .service-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .creative-service-style-01 .service-items .service-item',
			]
		);

		$this->end_controls_section();

	}


	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/service-hover/$template", $data );
	}

}