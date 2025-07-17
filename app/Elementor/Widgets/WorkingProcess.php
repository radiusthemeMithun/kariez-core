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

class WorkingProcess extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Working Process', 'kariez-core');
		$this->rt_base = 'rt-working-process';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'kariez-core' ),
				'6'  => esc_html__( '2 Col', 'kariez-core' ),
				'4'  => esc_html__( '3 Col', 'kariez-core' ),
				'3'  => esc_html__( '4 Col', 'kariez-core' ),
				'2'  => esc_html__( '6 Col', 'kariez-core' ),
			),
		);
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_process_item',
			[
				'label' => esc_html__('Process Item', 'kariez-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',  [
				'label'   => __( 'Choose Image', 'kariez-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'number', [
				'label' => __('Number', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title', [
				'label' => __('Title', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Online Application', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content', [
				'label' => __('Content', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Donec Sodales Sagittis Neamagna Cras Dapibus. Praesent Utter Ligula Varius Sagittis.', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url', [
				'label' => __('Link', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'kariez-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

//		$repeater->add_control(
//			'step_color',
//			[
//				'label' => __('Step Color', 'kariez-core'),
//				'type' => \Elementor\Controls_Manager::COLOR,
//				'default' => '',
//				'selectors' => [
//					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} .title-link' => 'color: {{VALUE}}',
//				],
//			]
//		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-2',
				'options' => [
					'layout-1' => __( 'Layout 1', 'kariez-core' ),
					'layout-2' => __( 'Layout 2', 'kariez-core' ),
				],

			]
		);

		$this->add_control(
			'process_list',
			[
				'label' => __('Process List', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'number' => __('01', 'kariez-core'),
						'title' => __('Step 1: Receive Package', 'kariez-core'),
						'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer.', 'kariez-core'),
					],
					[
						'number' => __('02', 'kariez-core'),
						'title' => __('Step 2: Transport Packages', 'kariez-core'),
						'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer.', 'kariez-core'),
					],
					[
						'number' => __('03', 'kariez-core'),
						'title' => __('Step 3: Deliver Packages', 'kariez-core'),
						'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer.', 'kariez-core'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'item_space',
			[
				'type'        => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Item Gutter', 'kariez-core' ),
				'options' => [
					'g-0' => __( 'Gutters 0', 'kariez-core' ),
					'g-1' => __( 'Gutters 1', 'kariez-core' ),
					'g-2' => __( 'Gutters 2', 'kariez-core' ),
					'g-3' => __( 'Gutters 3', 'kariez-core' ),
					'g-4' => __( 'Gutters 4', 'kariez-core' ),
					'g-5' => __( 'Gutters 5', 'kariez-core' ),
				],
				'default' => 'g-4',
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
					'{{WRAPPER}} .rt-working-process .process-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_xs',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Small Phones: < 480px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			]
		);

		$this->end_controls_section();

		// Title Settings
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__('Title Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => esc_html__('Typo', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-title',
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
		$this->add_responsive_control(
			'title_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-working-process .rt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => __('Normal', 'kariez-core'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-working-process .rt-title .title-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => __('Hover', 'kariez-core'),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-title .title-link:hover' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Thumb Settings
		$this->start_controls_section(
			'thumb_settings',
			[
				'label' => esc_html__('Thumb Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_display',
			[
				'label'        => __( 'Thumb Display', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'kariez-core' ),
				'label_off'    => __( 'Hide', 'kariez-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_responsive_control(
			'thumb_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%', 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-working-process .process-info-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition'   => [
					'thumb_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Width', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-info-img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'thumb_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Height', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-info-img' => 'Height: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'thumb_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-working-process .process-info-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'thumb_display' => 'yes',
				],
			]
		);


		$this->end_controls_section();

		// Step Settings
		$this->start_controls_section(
			'step_settings',
			[
				'label' => esc_html__('Step Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'step_display',
			[
				'label'        => __( 'Step Display', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'kariez-core' ),
				'label_off'    => __( 'Hide', 'kariez-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step_typo',
				'label' => esc_html__('Typo', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-step',
				'condition'   => [
					'step_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'step_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-working-process .rt-step' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'step_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'step_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-step' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'step_display' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Number Settings
		$this->start_controls_section(
			'number_settings',
			[
				'label' => esc_html__('Number Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_display',
			[
				'label'        => __( 'Number Display', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'kariez-core' ),
				'label_off'    => __( 'Hide', 'kariez-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typo',
				'label' => esc_html__('Typo', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-process-layout-1 .rt-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-process-layout-2 .rt-number' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-process-layout-3 .rt-number' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'number_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-working-process .rt-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'number_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Width', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-working-process .rt-number' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'number_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Height', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-working-process .rt-number' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		// Number tab
		$this->start_controls_tabs(
			'number_style_tabs',
		);

		$this->start_controls_tab(
			'number_normal_tab',
			[
				'label' => __('Normal', 'kariez-core'),
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'number_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-number' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'number_bg_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'number_border',
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'number_box_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'number_hover_tab',
			[
				'label' => __('Hover', 'kariez-core'),
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'number_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-item:hover .rt-number' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'number_bg_hover_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .process-item:hover .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'number_hover_border',
				'selector' => '{{WRAPPER}} .rt-working-process .process-item:hover .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'number_box_hover_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .process-item:hover .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Content Settings
		$this->start_controls_section(
			'content_settings',
			[
				'label' => esc_html__('Content Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .process-content',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __('Padding', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_responsive_control(
			'content_radius',
			[
				'label' => __('Radius', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .rt-working-process .process-content',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'label' => __('Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .process-content',
			]
		);

		$this->end_controls_section();

		// Box Settings
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__('Box Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
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
				'selector' => '{{WRAPPER}} .rt-working-process .process-item',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Radius', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .rt-working-process .process-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .process-item',
			]
		);

		$this->add_responsive_control(
			'info_wrap_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Info Wrap Space', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-info' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'line_heading',
			[
				'label'     => __( 'Line Shape Style', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'line_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Line Space', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-process-layout-1 .rt-center-line' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => [ 'layout-1' ]
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .rt-process-layout-1 .rt-center-line',
				'condition'   => [
					'layout' => [ 'layout-1' ]
				],
			]
		);

		$this->add_control(
			'line_round_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Round Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-process-layout-1 .rt-step-dot' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		//Animation setting
		$this->start_controls_section(
			'animation_style',
			[
				'label' => esc_html__( 'Animation Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animation',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Animation', 'kariez-core' ),
				'options' => [
					'wow' => esc_html__( 'On', 'kariez-core' ),
					'wow-off'         => esc_html__( 'Off', 'kariez-core' ),
				],
				'default' => 'wow-off',
			]
		);

		$this->add_control(
			'animation_effect',
			[
				'type'    => Controls_Manager::SELECT,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'kariez-core' ),
				'options' => [
					'bounce' => esc_html__( 'bounce', 'kariez-core' ),
					'flash' => esc_html__( 'flash', 'kariez-core' ),
					'pulse' => esc_html__( 'pulse', 'kariez-core' ),
					'headShake' => esc_html__( 'headShake', 'kariez-core' ),
					'swing' => esc_html__( 'swing', 'kariez-core' ),
					'hinge' => esc_html__( 'hinge', 'kariez-core' ),
					'flipInX' => esc_html__( 'flipInX', 'kariez-core' ),
					'flipInY' => esc_html__( 'flipInY', 'kariez-core' ),
					'fadeIn' => esc_html__( 'fadeIn', 'kariez-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'kariez-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'kariez-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'kariez-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'kariez-core' ),
					'bounceIn' => esc_html__( 'bounceIn', 'kariez-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'kariez-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'kariez-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'kariez-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'kariez-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'kariez-core' ),
					'slideInDown' => esc_html__( 'slideInDown', 'kariez-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'kariez-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'kariez-core' ),
					'zoomIn' => esc_html__( 'zoomIn', 'kariez-core' ),
					'zoomInDown' => esc_html__( 'zoomInDown', 'kariez-core' ),
					'zoomInUp' => esc_html__( 'zoomInUp', 'kariez-core' ),
					'zoomInLeft' => esc_html__( 'zoomInLeft', 'kariez-core' ),
					'zoomInRight' => esc_html__( 'zoomInRight', 'kariez-core' ),
					'zoomOut' => esc_html__( 'zoomOut', 'kariez-core' ),
				],
				'default' => 'fadeInUp',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			]
		);

		$this->add_control(
			'delay',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Delay', 'kariez-core' ),
				'default' => '200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->add_control(
			'duration',
			[
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'kariez-core' ),
				'default' => '1200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();
		if ( 'layout-1' == $data['layout'] ) {
			$template = 'view-1';
		} elseif ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} 
		Fns::get_template( "elementor/working-process/$template", $data );
	}
}