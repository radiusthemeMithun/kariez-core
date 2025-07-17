<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use RT\KariezCore\Helper\Fns;
use RT\KariezCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class Tab extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Tab', 'kariez-core');
		$this->rt_base = 'rt-tab';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_tabs',
			[
				'label' => esc_html__('RT Tabs', 'kariez-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => __('Opening Day', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Investment', 'kariez-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content', [
				'label' => __('Opening Hour', 'kariez-core'),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_type', [
				'label' => __('Icon Type', 'kariez-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'icon' => __('Icon', 'kariez-core'),
					'none' => __('None', 'kariez-core'),
				],
			]
		);
		$repeater->add_control(
			'tab_icon', [
				'label'            => __( 'Choose Icon', 'kariez-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-paper-plane',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Tab Layout', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Horizontal 01', 'kariez-core' ),
					'layout-2' => __( 'Horizontal 02', 'kariez-core' ),
					'layout-3' => __( 'Vertical 01', 'kariez-core' ),
				],
				'default'     => 'layout-1',
			]
		);


		$this->add_control(
			'lists',
			[
				'label' => __('Tab Content', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Investment', 'kariez-core'),
						'content' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'kariez-core'),
					],
					[
						'title' => __('Marketing Cost', 'kariez-core'),
						'content' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'kariez-core'),
					],
					[
						'title' => __('Data Analysis', 'kariez-core'),
						'content' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'kariez-core'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		// Tab List Settings
		$this->start_controls_section(
			'tab_list_settings',
			[
				'label' => esc_html__('Tab List Settings', 'kariez-core'),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .rt-tab-block .tab-block-tabs' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['layout-1', 'layout-2'],
				],
			]
		);

		$this->add_responsive_control(
			'alignment2',
			[
				'label'     => __( 'Alignment', 'kariez-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'row'   => [
						'title' => __( 'row', 'kariez-core' ),
						'icon'  => 'eicon-arrow-right',
					],
					'column-reverse' => [
						'title' => __( 'column-reverse', 'kariez-core' ),
						'icon'  => 'eicon-arrow-down',
					],
					'row-reverse'  => [
						'title' => __( 'row-reverse', 'kariez-core' ),
						'icon'  => 'eicon-arrow-left',
					],
					'column'  => [
						'title' => __( 'column', 'kariez-core' ),
						'icon'  => 'eicon-arrow-up',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-layout-3 .tab-block' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['layout-3'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_list_typo',
				'label' => esc_html__('Typo', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab',
			]
		);
		$this->add_responsive_control(
			'tab_list_padding',
			[
				'label' => __('Padding', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_list_radius',
			[
				'label' => __('Radius', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_list_space',
			[
				'label'      => __( 'Tab List Space', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tabs' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_content_space',
			[
				'label'      => __( 'Tab Content Space', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tabs' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => [ 'layout-1', 'layout-2' ]
				],
			]
		);
		$this->add_responsive_control(
			'tab_content_space2',
			[
				'label'      => __( 'Tab Content Space', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-tab-layout-3 .tab-block' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => [ 'layout-3' ]
				],
			]
		);

		$this->start_controls_tabs(
			'tab_list_style_tabs'
		);

		$this->start_controls_tab(
			'tab_normal_tab',
			[
				'label' => __('Normal', 'kariez-core'),
			]
		);
		$this->add_control(
			'tab_list_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_list_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-tab-layout-1 .tab-block-tab::before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_list_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_list_border',
				'label' => __('Border', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_active_tab',
			[
				'label' => __('Active', 'kariez-core'),
			]
		);
		$this->add_control(
			'tab_list_active_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_list_active_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-tab-layout-1 .tab-block-tab.is-active::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-tab-layout-1 .tab-block-tab.is-active::after' => 'background-color: {{VALUE}}; z-index: -1;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_list_active_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_list_active_border',
				'label' => __('Border', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'icon_style_heading',
			[
				'label' => __( 'Icon Style', 'kariez-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_icon_typo',
				'label' => esc_html__('Icon Typo', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab i',
			]
		);
		$this->add_control(
			'tab_icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Icon Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_icon_active_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Icon Active Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_icon_space',
			[
				'label'      => __( 'Tab Icon Space', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Tab Content setting
		$this->start_controls_section(
			'tab_content_style',
			[
				'label' => esc_html__( 'Tab Content Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_content_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content',
			]
		);
		$this->add_control(
			'tab_content_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'tab_content_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color', 'kariez-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_responsive_control(
			'tab_content_margin',
			[
				'label' => __('Margin', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_content_padding',
			[
				'label' => __('Padding', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_content_radius',
			[
				'label' => __('Radius', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_content_border',
				'label' => __('Border', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content',
			]
		);

		$this->add_control(
			'des_list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'des_list_typo',
				'label'    => esc_html__( 'List Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content ul li',
			]
		);
		$this->add_control(
			'des_list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'des_list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'des_list_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon BG Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'des_list_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before',
			]
		);
		$this->add_responsive_control(
			'des_list_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		$template = 'view-1';
		Fns::get_template( "elementor/tab/$template", $data );
	}
}