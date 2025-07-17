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

class InfoSlider extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Info Slider', 'kariez-core' );
		$this->rt_base = 'rt-info-slider';
        $this->rt_translate = array(
            'cols'  => array(
                '12' => esc_html__( '1 Col', 'kariez-core' ),
                '6'  => esc_html__( '2 Col', 'kariez-core' ),
                '4'  => esc_html__( '3 Col', 'kariez-core' ),
                '3'  => esc_html__( '4 Col', 'kariez-core' ),
                '2'  => esc_html__( '6 Col', 'kariez-core' ),
            ),
        );

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_slider',
			[
				'label' => esc_html__( 'Info Slider Settings', 'kariez-core' ),
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
					'layout-1' => __( 'Slider Layout', 'kariez-core' ),
				],
			]
		);



        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'kariez-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Welcome To Kariez', 'kariez-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Choose Image', 'kariez-core' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'rt_icon',
            [
                'label'            => __( 'RT Icon', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'icon-truck-1',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'   => __( 'Content', 'kariez-core' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter Content', 'kariez-core' ),
            ]
        );

        $repeater->add_control(
            'rt-button',
            [
                'label'        => __( 'Read More Button', 'kariez-core' ),
                'type'        => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'kariez-core' ),
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
            'items',
            [
                'label'       => __( 'InfoSlider List', 'kariez-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'        => __( 'Real-Time Tracking', 'kariez-core' ),
                        'content'     => __( 'Lorem ipsum dolor as consectetur adipisg elit. Mauris nulla the integer the semper the ipsum dolor sit amet consectetur adipiscing nteger dolor nunc semper.',
                            'kariez-core' ),

                    ],
                    [
                        'title'        => __( 'Real-Time Tracking', 'kariez-core' ),
                        'content'     => __( 'Lorem ipsum dolor as consectetur adipisg elit. Mauris nulla the integer the semper the ipsum dolor sit amet consectetur adipiscing nteger dolor nunc semper.',
                            'kariez-core' ),

                    ],
                    [
                        'title'        => __( 'Real-Time Tracking', 'kariez-core' ),
                        'content'     => __( 'Lorem ipsum dolor as consectetur adipisg elit. Mauris nulla the integer the semper the ipsum dolor sit amet consectetur adipiscing nteger dolor nunc semper.', 'kariez-core' ),

                    ],

                ],
                'title_field' => '{{{ name }}}',
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
					'{{WRAPPER}} .rt-info-slider-box *' => 'text-align: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-slider-box .icon-holder'     => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
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
            'thumb_display',
            [
                'label'        => __( 'Thumb Display', 'kariez-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'kariez-core' ),
                'label_off'    => __( 'Hide', 'kariez-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
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
            'icon_display',
            [
                'label'        => __( 'Icon Display', 'kariez-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'kariez-core' ),
                'label_off'    => __( 'Hide', 'kariez-core' ),
                'return_value' => 'no',
                'default'      => 'no',
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
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-slider-box .info-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-slider-box .info-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-slider-box .info-title a:hover' => 'color: {{VALUE}} !important',
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
					'{{WRAPPER}} .rt-info-slider-box:not(.rt-info-layout-1) .info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-info-slider-box p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box p',
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
					'{{WRAPPER}} .rt-info-slider-box p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon'   => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon'   => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-slider-box .rt-icon svg' => 'transform: scale({{SIZE}});',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon'    => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-slider-box .rt-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-slider-box .rt-icon'  => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .rt-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .rt-icon',
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
					'{{WRAPPER}} .rt-info-slider-box .rt-icon:hover .rt-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-slider-box .rt-icon:hover .rt-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-slider-box .rt-icon:hover .rt-icon'  => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border_hover',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .rt-icon:hover .rt-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_hover_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .rt-icon:hover .rt-icon',
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
				'label'     => esc_html__( 'Image Settings', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .rt-info-slider-box .info-slider-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-info-slider-box .info-slider-img img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
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
					'{{WRAPPER}} .rt-info-slider-box .info-slider-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-info-slider-box .info-slider-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-info-slider-box .info-slider-img img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __('Icon Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-slider-img',
			]
		);

		$this->end_controls_tab();



		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

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
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-btn',
			]
		);

        $this->add_control(
            'rt_button_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .rt-info-slider-box .info-btn' => 'color: {{VALUE}}',
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
                'selector' => ' {{WRAPPER}} .rt-info-slider-box .info-btn',
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
					'{{WRAPPER}} .rt-info-slider-box .info-btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'rt_button_width',
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
					'{{WRAPPER}} .rt-info-slider-box .info-btn' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rt_button_height',
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
					'{{WRAPPER}} .rt-info-slider-box .info-btn' => 'height:{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-info-slider-box .info-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);


		//Start read_more Style Tab
		$this->start_controls_tabs(
			'read_more_style_tabs'
		);


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-btn',
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
					'{{WRAPPER}} .rt-info-slider-box .info-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'read_more_bg_hover',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => ' {{WRAPPER}} .rt-info-slider-box .info-btn:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'label'    => __( 'Box Shadow Hover', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_border_hover',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-info-slider-box .info-btn:hover',
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
					'{{WRAPPER}} .rt-info-slider-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-info-slider-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .rt-info-slider-box',
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
				'selector'       => '{{WRAPPER}} .rt-info-slider-box',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .rt-info-slider-box',
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
				'selector' => '{{WRAPPER}} .rt-info-slider-box:hover',
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
				'selector'       => '{{WRAPPER}} .rt-info-slider-box:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hover_border',
				'selector' => '{{WRAPPER}} .rt-info-slider-box:hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();


		// Box Shape Settings


		$this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'slider_style',
            [
                'label' => esc_html__( 'Slider Style', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['layout-1'],
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_visibility',
            [
                'label'   => esc_html__( 'Arrow Visibility', 'kariez-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'kariez-core' ),
                    'hover-visibility' => __( 'Hover', 'kariez-core' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_radius',
            [
                'label'      => __( 'Radius', 'kariez-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_width',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Navigation Width', 'kariez-core' ),
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_height',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Navigation Height', 'kariez-core' ),
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'nex_prev_arrow',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Arrow Top / Bottom', 'kariez-core' ),
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'prev_arrow',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Prev Arrow', 'kariez-core' ),
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'next_arrow',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Next Arrow', 'kariez-core' ),
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'navigation_style_tabs',
            [
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]

        );

        $this->start_controls_tab(
            'navigation_style_tab',
            [
                'label' => __( 'Normal', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Arrow Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button i' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_width',
            [
                'type'    => Controls_Manager::SLIDER,
                'label'     => esc_html__( 'Arrow Stroke Width', 'kariez-core' ),
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button i ' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'arrow_bg_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Arrow BG Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'navigation_style_hover_tab',
            [
                'label' => __( 'Hover', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'arrow_hover_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'ArrowHover Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Arrow BG Hover Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'pagination_heading',
            [
                'label'     => __( 'Pagination Style', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'   => [
                    'display_pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => __( 'Pagination Color', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_pagination' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'pagination_active_color',
            [
                'label'     => __( 'Pagination Active Color', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_pagination' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Slider responsive
        $this->start_controls_section(
            'section_slider_grid',
            [
                'label' => __( 'Slider Grid', 'kariez-core' ),
                'condition' => [
                    'layout' => ['layout-1'],
                ],
            ]
        );

        $this->add_control(
            'desktop',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Desktops: > 1600px', 'kariez-core' ),
                'default' => '2',
                'options' => array(
                    '1' => esc_html__( '1', 'kariez-core' ),
                    '2' => esc_html__( '2', 'kariez-core' ),
                    '3' => esc_html__( '3', 'kariez-core' ),
                    '4' => esc_html__( '4', 'kariez-core' ),
                    '5' => esc_html__( '5', 'kariez-core' ),
                    '6' => esc_html__( '6', 'kariez-core' ),
                ),
            ]
        );
        $this->add_control(
            'md_desktop',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Desktops: > 1200px', 'kariez-core' ),
                'default' => '2',
                'options' => array(
                    '1' => esc_html__( '1', 'kariez-core' ),
                    '2' => esc_html__( '2', 'kariez-core' ),
                    '3' => esc_html__( '3', 'kariez-core' ),
                    '4' => esc_html__( '4', 'kariez-core' ),
                    '5' => esc_html__( '5', 'kariez-core' ),
                    '6' => esc_html__( '6', 'kariez-core' ),
                ),
            ]
        );
        $this->add_control(
            'sm_desktop',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Desktops: > 992px', 'kariez-core' ),
                'default' => '1',
                'options' => array(
                    '1' => esc_html__( '1', 'kariez-core' ),
                    '2' => esc_html__( '2', 'kariez-core' ),
                    '3' => esc_html__( '3', 'kariez-core' ),
                    '4' => esc_html__( '4', 'kariez-core' ),
                ),
            ]
        );
        $this->add_control(
            'tablet',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Tablets: > 768px', 'kariez-core' ),
                'default' => '1',
                'options' => array(
                    '1' => esc_html__( '1', 'kariez-core' ),
                    '2' => esc_html__( '2', 'kariez-core' ),
                    '3' => esc_html__( '3', 'kariez-core' ),
                    '4' => esc_html__( '4', 'kariez-core' ),
                ),
            ]
        );
        $this->add_control(
            'mobile',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Phones: > 576px', 'kariez-core' ),
                'default' => '1',
                'options' => array(
                    '1' => esc_html__( '1', 'kariez-core' ),
                    '2' => esc_html__( '2', 'kariez-core' ),
                ),
            ]
        );
        $this->add_control(
            'sm_mobile',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Phones: > 425px', 'kariez-core' ),
                'default' => '1',
                'options' => array(
                    '1' => esc_html__( '1', 'kariez-core' ),
                    '2' => esc_html__( '2', 'kariez-core' ),
                ),
            ]
        );
		$this->add_control(
			'xs_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 320px', 'kariez-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'kariez-core' ),
					'2' => esc_html__( '2', 'kariez-core' ),
				),
			]
		);

        $this->end_controls_section();

        // Slider option

        $this->start_controls_section(
            'section_slider_option',
            [
                'label' => __( 'Slider Option', 'kariez-core' ),
                'condition' => [
                    'layout' => ['layout-1'],
                ],
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'type'        => Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Autoplay', 'kariez-core' ),
                'label_on'    => esc_html__( 'On', 'kariez-core' ),
                'label_off'   => esc_html__( 'Off', 'kariez-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'kariez-core' ),
            ]
        );

        $this->add_control(
            'display_arrow',
            [
                'type'        => Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Navigation Arrow', 'kariez-core' ),
                'label_on'    => esc_html__( 'On', 'kariez-core' ),
                'label_off'   => esc_html__( 'Off', 'kariez-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Navigation Arrow. Default: On', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'display_pagination',
            [
                'type'        => Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Pagination', 'kariez-core' ),
                'label_on'    => esc_html__( 'On', 'kariez-core' ),
                'label_off'   => esc_html__( 'Off', 'kariez-core' ),
                'default'     => 'no',
                'description' => esc_html__( 'Navigation Arrow. Default: On', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'slides_per_group',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode' 			=> 'responsive',
                'label'   => esc_html__( 'slides Per Group', 'kariez-core' ),
                'default' => array(
                    'size' => 1,
                ),
                'description' => esc_html__( 'slides Per Group. Default: 1', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'centered_slides',
            [
                'type'        => Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Centered Slides', 'kariez-core' ),
                'label_on'    => esc_html__( 'On', 'kariez-core' ),
                'label_off'   => esc_html__( 'Off', 'kariez-core' ),
                'default'     => 'no',
                'description' => esc_html__( 'Centered Slides. Default: On', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'slides_space',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode' 			=> 'responsive',
                'label'   => esc_html__( 'Slides Space', 'kariez-core' ),
                'size_units' => array( 'px', '%' ),
                'default' => array(
                    'unit' => 'px',
                    'size' => 24,
                ),
                'description' => esc_html__( 'Slides Space. Default: 24', 'kariez-core' ),
            ]
        );
        $this->add_control(
            'slider_autoplay_delay',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Autoplay Slide Delay', 'kariez-core' ),
                'default' => 5000,
                'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'kariez-core' ),
                'condition'   => [
                    'slider_autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slider_autoplay_speed',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Autoplay Slide Speed', 'kariez-core' ),
                'default' => 1000,
                'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'kariez-core' ),
                'condition'   => [
                    'slider_autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slider_loop',
            [
                'type'        => Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Loop', 'kariez-core' ),
                'label_on'    => esc_html__( 'On', 'kariez-core' ),
                'label_off'   => esc_html__( 'Off', 'kariez-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Loop to first item. Default: On', 'kariez-core' ),
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

        if($data['slider_autoplay']=='yes'){
            $data['slider_autoplay']=true;
        }
        else{
            $data['slider_autoplay']=false;
        }

        $swiper_data = array(
            'slidesPerView' 	=>2,
            'loop'				=>$data['slider_loop']=='yes' ? true:false,
            'spaceBetween'		=>$data['slides_space']['size'],
            'slidesPerGroup'	=>$data['slides_per_group']['size'],
            'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
            'slideToClickedSlide' =>true,
            'autoplay'				=>array(
                'delay'  => $data['slider_autoplay_delay'],
            ),
            'speed'      =>$data['slider_autoplay_speed'],
            'breakpoints' =>array(
                '0'    =>array('slidesPerView' =>1),
                '320'    =>array('slidesPerView' =>$data['xs_mobile']),
                '425'    =>array('slidesPerView' =>$data['sm_mobile']),
                '576'    =>array('slidesPerView' =>$data['mobile']),
                '768'    =>array('slidesPerView' =>$data['tablet']),
                '992'    =>array('slidesPerView' =>$data['sm_desktop']),
                '1200'    =>array('slidesPerView' =>$data['md_desktop']),
                '1600'    =>array('slidesPerView' =>$data['desktop'])
            ),
            'auto'   =>$data['slider_autoplay']
        );

		$template = 'view-1';
        $data['swiper_data'] = json_encode( $swiper_data );
		if ( 'layout-1' == $data['layout'] ) {
            $template = 'view-slider-1';
		}
		Fns::get_template( "elementor/info-slider/{$template}", $data );
	}

}