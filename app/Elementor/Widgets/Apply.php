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

class Apply extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Apply', 'kariez-core');
		$this->rt_base = 'rt-job-apply';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_apply_item',
			[
				'label' => esc_html__('Apply Item', 'kariez-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


        $this->add_control(
            'upper_title', [
                'label' => __('Upper Title', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Position', 'kariez-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'upper_title2', [
                'label' => __('Upper Title', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Position', 'kariez-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'upper_title3', [
                'label' => __('Upper Title', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Position', 'kariez-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'upper_title4', [
                'label' => __('Upper Title', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );


		// Features
		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'title', [
				'label' => __('Title', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('UX/UI Designer', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content', [
				'label' => __('Content', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam.', 'kariez-core'),
				'label_block' => true,
			]
		);

        $repeater->add_control(
            'location', [
                'label' => __('Location', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('2307 Beverley Rd Brooklyn, New York', 'kariez-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'type', [
                'label' => __('Type', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Full Time', 'kariez-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rt-button',
            [
                'label'        => __( 'Apply Button', 'kariez-core' ),
                'type'        => Controls_Manager::TEXT,
                'default' => __( 'Apply Now', 'kariez-core' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'         => __( 'Button Link', 'kariez-core' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'kariez-core' ),
                'show_external' => true,
                'dynamic'       => [
                    'active' => true,
                ],
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
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
				],

			]
		);

		$this->add_control(
			'job_list',
			[
				'label' => __('Apply List', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('UX/UI Designer', 'kariez-core'),
                        'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam.', 'kariez-core'),
                        'location' => __('2307 Beverley Rd Brooklyn, New York', 'kariez-core'),
                        'type' => __('Full Time', 'kariez-core'),
                        'rt-button' => __('Apply Now', 'kariez-core'),

					],
					[
                        'title' => __('Project Manager', 'kariez-core'),
                        'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam.', 'kariez-core'),
                        'location' => __('2307 Beverley Rd Brooklyn, New York', 'kariez-core'),
                        'type' => __('Full Time', 'kariez-core'),
                        'rt-button' => __('Apply Now', 'kariez-core'),
					],
					[

                        'title' => __('Sr. Software Engineer', 'kariez-core'),
                        'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam.', 'kariez-core'),
                        'location' => __('2307 Beverley Rd Brooklyn, New York', 'kariez-core'),
                        'type' => __('Full Time', 'kariez-core'),
                        'rt-button' => __('Apply Now', 'kariez-core'),
					],
					[

                        'title' => __('Software Engineer', 'kariez-core'),
                        'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam.', 'kariez-core'),
                        'location' => __('2307 Beverley Rd Brooklyn, New York', 'kariez-core'),
                        'type' => __('Full Time', 'kariez-core'),
                        'rt-button' => __('Apply Now', 'kariez-core'),
					],
                    [
                        'title' => __('Senior Front-end Engineer', 'kariez-core'),
                        'content' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam.', 'kariez-core'),
                        'location' => __('2307 Beverley Rd Brooklyn, New York', 'kariez-core'),
                        'type' => __('Full Time', 'kariez-core'),
                        'rt-button' => __('Apply Now', 'kariez-core'),
                    ],
				],
				'title_field' => '{{{ title }}}',
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
					'{{WRAPPER}} .job-apply-wrap .apply-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);


		$this->end_controls_section();

        //Option setting
        $this->start_controls_section(
            'section_option',
            [
                'label' => __( 'Option', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'title_display',
            [
                'label'        => __( 'Title Display', 'kariez-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'kariez-core' ),
                'label_off'    => __( 'Hide', 'kariez-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );


        $this->add_control(
            'btn_display',
            [
                'label'        => __( 'Button Display', 'kariez-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'kariez-core' ),
                'label_off'    => __( 'Hide', 'kariez-core' ),
                'return_value' => 'no',
                'default'      => 'no',
            ]
        );


        $this->end_controls_section();

        //Box Title list Settings

        $this->start_controls_section(
            'box_title_settings',
            [
                'label' => esc_html__('Box Up Title Settings', 'kariez-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_title_padding',
            [
                'label' => __('Padding', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .box-list' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_title_border',
                'selector' => '{{WRAPPER}} .job-apply-wrap .box-list ',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'box_title_typo',
                'label' => esc_html__('Box Up Title Typo', 'kariez-core'),
                'selector' => '{{WRAPPER}} .job-apply-wrap .box-list .box-title',
            ]
        );

        $this->add_responsive_control(
            'box_title_space',
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
                    '{{WRAPPER}} .job-apply-wrap .box-list .box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Box Title Up Color', 'kariez-core'),
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .box-list .box-title' => 'color: {{VALUE}}',
                ],
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
				'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box .info-title',
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
					'{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box .info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box .info-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box .info-title' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box p',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box p' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __('Margin', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .title-box p' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);



		$this->end_controls_section();

        // Location Settings
        $this->start_controls_section(
            'location_settings',
            [
                'label' => esc_html__('Location Settings', 'kariez-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'location_typo',
                'label'    => esc_html__( 'Typo', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .rt-location',
            ]
        );

        $this->add_control(
            'location_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .rt-location' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'location_margin',
            [
                'label' => __('Margin', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .rt-location' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
            ]
        );

        $this->end_controls_section();

        // Type Settings
        $this->start_controls_section(
            'type_settings',
            [
                'label' => esc_html__('Type Settings', 'kariez-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'type_typo',
                'label'    => esc_html__( 'Typo', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .rt-type',
            ]
        );

        $this->add_control(
            'type_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .rt-type' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'type_margin',
            [
                'label' => __('Margin', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .rt-type' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
            ]
        );

        $this->end_controls_section();

        // Button Settings

        $this->start_controls_section(
            'rt_button_settings',
            [
                'label'     => esc_html__( 'Button Settings', 'kariez-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'rt_button_typo',
                'label'    => esc_html__( 'Typo', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .apply-btn',
            ]
        );

        $this->add_control(
            'rt_button_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .apply-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'rt_button_bg',
                'label' => __('Background', 'kariez-core'),
                'types' => ['classic', 'gradient'],
                'fields_options'  => [
                    'background' => [
                        'label' => esc_html__( 'Background', 'kariez-core' ),
                    ],
                ],
                'selector' => ' {{WRAPPER}} .job-apply-wrap .apply-item .apply-content .apply-btn',
            ]
        );

        $this->add_responsive_control(
            'rt_button_border_radius',
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
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .apply-btn' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'rt_button_padding_spacing',
            [
                'label'      => __( 'Padding', 'kariez-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item .apply-content .apply-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
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
				'selector' => '{{WRAPPER}} .job-apply-wrap',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'kariez-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .job-apply-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .job-apply-wrap  ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .job-apply-wrap ',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .job-apply-wrap ',
			]
		);



		$this->end_controls_section();

        // Box Item Settings
        $this->start_controls_section(
            'box_item_settings',
            [
                'label' => esc_html__('Box Item Settings', 'kariez-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_item_bg_color',
                'label' => __('Background', 'kariez-core'),
                'types' => ['classic', 'gradient'],
                'fields_options'  => [
                    'background' => [
                        'label' => esc_html__( 'Background', 'kariez-core' ),
                    ],
                ],
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item',
            ]
        );

        $this->add_responsive_control(
            'box_item_padding',
            [
                'label' => __('Padding', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_item_radius',
            [
                'label' => __('Radius', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .job-apply-wrap .apply-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_item_border',
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item',
            ]
        );


        $this->add_responsive_control(
            'info_item_wrap_space',
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
                    '{{WRAPPER}} .job-apply-wrap .apply-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'box_item_shadow_style_tabs'
        );
        $this->start_controls_tab(
            'box_item_shadow_normal_tab',
            [
                'label' => __('Normal', 'kariez-core'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_item_shadow',
                'label' => __('Shadow', 'kariez-core'),
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_item_shadow_hover_tab',
            [
                'label' => __( 'Hover', 'kariez-core' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_hover_item_shadow',
                'label' => __('Shadow', 'kariez-core'),
                'selector' => '{{WRAPPER}} .job-apply-wrap .apply-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
		}
		Fns::get_template( "elementor/apply/$template", $data );
	}
}