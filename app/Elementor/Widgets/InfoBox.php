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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class InfoBox extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Info Box', 'kariez-core' );
		$this->rt_base = 'rt-info-box';


		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Info Box Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1', 'kariez-core' ),
					'layout-2' => __( 'Layout 2', 'kariez-core' ),
                    'layout-3' => __( 'Layout 3', 'kariez-core' ),
					'layout-4' => __( 'Layout 4', 'kariez-core' ),
					'layout-5' => __( 'Layout 5', 'kariez-core' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Welcome To Kariez', 'kariez-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'       => esc_html__( 'Sub Title', 'kariez-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'I am Info Text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit','kariez-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'kariez-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __('Icon', 'kariez-core'),
					'image' => __('Image', 'kariez-core'),
				],
			]
		);

		$this->add_control(
			'info_icon',
			[
				'label'            => __( 'Choose Icon', 'kariez-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-home',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => [ 'icon' ],
				],
			]
		);


		$this->add_control(
			'image_icon',
			[
				'label'     => __( 'Choose Image', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_control(
			'info_top_icon',
			[
				'label'            => __( 'Choose Top Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-truck',
					'library' => 'solid',
				],
				'condition'   => [
					'layout' => 'layout-4',
				],
			]
		);
		$this->add_control(
			'info_content_icon',
			[
				'label'            => __( 'Choose Content Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-truck',
					'library' => 'solid',
				],
				'condition'   => [
					'layout' => 'layout-5',
				],
			]
		);


		$this->add_control(
			'show_read_more_btn',
			[
				'label'        => __( 'Read More Button', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'kariez-core' ),
				'label_off'    => __( 'Off', 'kariez-core' ),
				'return_value' => 'is-read-more',
			]
		);

		$this->add_control(
			'read_more_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Read More',
				'label_block' => true,
				'condition'   => [
					'show_read_more_btn' => [ 'is-read-more' ],
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'kariez-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'kariez-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .rt-info-box *' => 'text-align: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box .icon-holder'     => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);


		$this->end_controls_section();


		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .info-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Title Spacing', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-info-box:not(.rt-info-layout-1) .info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-layout-1 .info-icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
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

		// Content Settings
		$this->start_controls_section(
			'sec_content_settings',
			[
				'label'     => esc_html__( 'Content Settings', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .content-holder p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .content-holder p',
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'      => __( 'Content Spacing', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-info-box .content-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-layout-7 .info-box .info-content-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'layout' => ['layout-7'],
				],
			]
		);
		$this->add_control(
			'list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_typo',
				'label'    => esc_html__( 'List Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .feature-list li',
			]
		);

		$this->add_control(
			'list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .feature-list li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .feature-list li span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon BG Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .feature-list li span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Icon Settings
		//==============================================================
		$this->start_controls_section(
			'icon_settings',
			[
				'label'     => esc_html__( 'Icon Settings', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'icon' ],
				],

			]
		);

		$this->add_responsive_control(
			'icon_box_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Box Width', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info-box .info-icon'   => 'width: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_box_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Box Height', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info-box .info-icon'   => 'height: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info-box .info-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .info-box .info-icon svg' => 'transform: scale({{SIZE}});',
				],

			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'      => __( 'Icon Spacing / Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box .info-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Icon Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'kariez-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box .info-icon'    => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		//Start Icon Style Tab
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box .info-icon i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .info-box .info-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box .info-icon'  => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box .info-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box .info-icon',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'kariez-core' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box:hover .info-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .info-box:hover .info-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box:hover .info-icon'  => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border_hover',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box:hover .info-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_hover_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box:hover .info-icon',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->end_controls_section();

		// Image Icon Settings
		$this->start_controls_section(
			'image_icon_settings',
			[
				'label'     => esc_html__( 'Image Icon Settings', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_margin_bottom',
			[
				'label'      => __( 'Image Wrapper Margin Bottom', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_icon_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Width', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-icon img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition'  => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'      => __( 'Image Wrapper Width / Height', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .info-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_align',
			[
				'label'   => esc_html__( 'Image Align', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'center' => esc_html__( 'Center', 'kariez-core' ),
					'self-start' => esc_html__( 'Top', 'kariez-core' ),
					'self-end' => esc_html__( 'Bottom', 'kariez-core' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .info-icon' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['layout-6'],
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'      => __( 'Image Spacing / Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Radius', 'kariez-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .info-icon img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_box_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Box Radius', 'kariez-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info-box .info-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		//Start image Style Tab
		$this->start_controls_tabs(
			'image_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'image_style_normal_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);
		$this->add_control(
			'image_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box .info-icon'  => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box .info-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box .info-icon',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'image_style_hover_tab',
			[
				'label' => __( 'Hover', 'kariez-core' ),
			]
		);

		$this->add_control(
			'image_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box:hover .info-icon'  => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'image_border_hover',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box:hover .info-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_hover_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box:hover .info-icon',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->end_controls_section();

		// Info Image Settings
		$this->start_controls_section(
			'info_image_settings',
			[
				'label' => esc_html__( 'Info Image Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'    => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'info_image_display',
			[
				'label'        => __( 'Image Display', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'kariez-core' ),
				'label_off'    => __( 'Off', 'kariez-core' ),
				'default' => 'no',
			]
		);

		$this->add_control(
			'info_image',
			[
				'label'     => __( 'Choose Image', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'info_image_display' => [ 'yes' ],
				],
			]
		);

		$this->add_responsive_control(
			'info_image_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Width', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-info-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'info_image_display' => [ 'yes' ],
				],
			]
		);

		$this->add_responsive_control(
			'info_image_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Height', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-info-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'info_image_display' => [ 'yes' ],
				],
			]
		);

		$this->add_responsive_control(
			'info_image_radius',
			[
				'label'      => __( 'Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'info_image_display' => [ 'yes' ],
				],
			]
		);

		$this->end_controls_section();

		// Info top Icon

		$this->start_controls_section(
			'top_icon_settings',
			[
				'label'     => esc_html__( 'Top Icon Settings', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'layout-4',
				],
			]
		);
		$this->add_responsive_control(
			'top_icon_width',
			[
				'label'      => __( 'Icon Width', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'top_icon_height',
			[
				'label'      => __( 'Icon Height', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon' => 'height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'top_icon_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'kariez-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'top_icon_font_size',
			[
				'label'      => __( 'Icon Size', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon'   => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon svg' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'top_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .info-box .info-top-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'top_icon_bg_color',
				'label' => __('Icon Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-info-box .info-box .info-top-icon',
			]
		);

		$this->end_controls_section();


		// Read More Button Settings
		$this->start_controls_section(
			'read_more_settings',
			[
				'label'     => esc_html__( 'Button Settings', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_read_more_btn' => [ 'is-read-more' ],
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'read_more_btn_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn',
			]
		);

		$this->add_responsive_control(
			'read_more_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'btn_more_width',
			[
				'label'      => __( 'Button Width', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_more_height',
			[
				'label'      => __( 'Button Height', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
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
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn' => 'height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'read_more_padding_spacing',
			[
				'label'      => __( 'Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'button_text_margin',
			[
				'label'              => __( 'Button Text Margin', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn .button-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);


		// Button Icon Settings
		$this->add_control(
			'button_icon_heading',
			[
				'label'     => __( 'Button Icon Settings', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_btn_icon',
			[
				'label'        => __( 'Show Button Icon', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'kariez-core' ),
				'label_off'    => __( 'No', 'kariez-core' ),
				'return_value' => 'yes',
				'default'      => true,
			]
		);

		$this->add_control(
			'show_btn_text',
			[
				'label'        => __( 'Show Button Text', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'No', 'kariez-core' ),
				'label_off'    => __( 'Yes', 'kariez-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'     => __( 'Button Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'icon-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_btn_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_font_size',
			[
				'label'      => __( 'Icon Size', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn i'   => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box .rt-button .btn svg' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'show_btn_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .rt-button .btn svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn:hover i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .rt-button .btn:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Space', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_shape_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Shape Height', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-info-box .rt-button .btn .btn-round-shape' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'btn_icon_shape_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Shape Width', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-info-box .rt-button .btn .btn-round-shape' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_icon_shape_bg_color',
				'label' => __('Icon Shape Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Shape Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn .btn-round-shape',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_icon_shape_bg_hover_color',
				'label' => __('Icon Shape Hover Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Shape Hover Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn:hover .btn-round-shape',
			]
		);

		$this->add_responsive_control(
			'btn_icon_shape_radius',
			[
				'label'              => __( 'Icon Shape Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%', 'px'  ],
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn .btn-round-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);


		//Start read_more Style Tab
		$this->start_controls_tabs(
			'read_more_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'read_more_style_normal_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .rt-button .btn svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'read_more_bg',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => ' {{WRAPPER}} .rt-info-box .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'read_more_style_hover_tab',
			[
				'label' => __( 'Hover', 'kariez-core' ),
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn .button-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_icon_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-button .btn:hover i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .rt-button .btn:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'read_more_hover_bg',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => ' {{WRAPPER}} .rt-info-box .rt-button .btn:before',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'label'    => __( 'Box Shadow Hover', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_border_hover',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .rt-button .btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Box Settings
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-info-layout-4 .info-box:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'box_bg',
				'label'          => __( 'Background', 'kariez-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Box Background', 'kariez-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .rt-info-box .info-box',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .rt-info-box .info-box',
			]
		);
		$this->add_control(
			'shape_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Shape Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-layout-1 .info-box .rt-shape svg' => 'color: {{VALUE}}',
				],
				'condition'     => [
					'shape_display' => ['yes'],'layout' => ['layout-1'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __( 'Hover', 'kariez-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow Hover', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-box:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'box_bg_hover',
				'label'          => __( 'Background Hover', 'kariez-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Box Background - Hover', 'kariez-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .rt-info-box .info-box:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hover_border',
				'selector' => '{{WRAPPER}} .rt-info-box .info-box:hover',
			]
		);

		$this->add_control(
			'shape_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Shape Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-layout-1 .info-box:hover .rt-shape svg' => 'color: {{VALUE}}',
				],
				'condition'     => [
					'shape_display' => ['yes'],'layout' => ['layout-1'],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'content_bg',
			[
				'label'     => __( 'Content Background', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-info-layout-4 .info-box:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-layout-5 .info-box .info-content-holder' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'layout' => ['layout-4','layout-5'],
				],
			]
		);

		// Box Shape Settings


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
		$data     = $this->get_settings();

		$template = 'view-1';
		if ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'layout-4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'layout-5' == $data['layout'] ) {
			$template = 'view-5';
		}

		Fns::get_template( "elementor/info-box/{$template}", $data );
	}

}