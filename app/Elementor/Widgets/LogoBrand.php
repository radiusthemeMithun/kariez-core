<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\KariezCore\Helper\Fns;
use RT\KariezCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class LogoBrand extends ElementorBase {
	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Logo Brand', 'kariez-core' );
		$this->rt_base = 'rt-logo-brand';
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

	public function get_script_depends() {
		return [
			'swiper',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Logo Option', 'kariez-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Slider Image', 'kariez-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'url',
			[
				'label'       => __( 'Logo Link', 'kariez-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'kariez-core' ),
				'show_label'  => false,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout Slider', 'kariez-core' ),
					'layout-2' => __( 'Layout Grid', 'kariez-core' ),
				],
			]
		);

		$this->add_control(
			'logos',
			[
				'label'   => esc_html__( 'Add as many logos as you want', 'kariez-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
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
				'condition'  => [
					'layout' => ['layout-2'],
				],
			]
		);

        $this->add_responsive_control(
            'item_justify',
            [
                'label'     => __( 'Horizontal Align', 'kariez-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start'   => [
                        'title' => __( 'Start', 'kariez-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'kariez-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end'  => [
                        'title' => __( 'End', 'kariez-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-logo-brand .rt-logo-wrap' => 'justify-content: {{VALUE}};justify-content: {{VALUE}};',
                ],
                'separator' => 'before',
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
                    '{{WRAPPER}} .rt-logo-brand' => 'text-align: {{VALUE}};justify-content: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		// Logo Settings
		$this->start_controls_section(
			'logo_settings',
			[
				'label' => esc_html__( 'Logo Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_color_mode',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Logo Color Mode', 'kariez-core' ),
				'options' => array(
					'normal' 		=> esc_html__( 'Default Color', 'kariez-core' ),
					'gray' 		=> esc_html__( 'Gray Scale', 'kariez-core' ),
					'brightness' 		=> esc_html__( 'Gray Brightness', 'kariez-core' ),
				),
				'default' => 'gray',
			]
		);

		$this->add_control(
			'logo_bg_color',
			[
				'label'     => __( 'Background Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'logo_radius',
			[
				'label'      => __( 'Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label'      => __( 'Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'logo_box_height',
			[
				'label'      => __( 'Box Height', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Navigation Settings
		$this->start_controls_section(
			'navigation_settings',
			[
				'label' => esc_html__( 'Navigation Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);
		$this->add_control(
			'navigation_size',
			[
				'label'     => __( 'Icon Size', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:after' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->start_controls_tabs(
			'navigation_style_tabs'
		);

		$this->start_controls_tab(
			'navigation_style_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);
		$this->add_control(
			'navigation_color',
			[
				'label'     => __( 'Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'navigation_bg_color',
			[
				'label'     => __( 'Background Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
				],
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
			'navigation_hover_color',
			[
				'label'     => __( 'Hover Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'navigation_bg_hover_color',
			[
				'label'     => __( 'Background Hover Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// Pagination Settings

		$this->start_controls_section(
			'pagination_settings',
			[
				'label' => esc_html__( 'Pagination Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);
		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __( 'Active Color', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'  => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '2',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
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
				'default' => '5',
				'options' => array(
					'1' => esc_html__( '1', 'kariez-core' ),
					'2' => esc_html__( '2', 'kariez-core' ),
					'3' => esc_html__( '3',  'kariez-core' ),
					'4' => esc_html__( '4',  'kariez-core' ),
					'5' => esc_html__( '5',  'kariez-core' ),
					'6' => esc_html__( '6',  'kariez-core' ),
					'7' => esc_html__( '7',  'kariez-core' ),
					'8' => esc_html__( '8',  'kariez-core' ),
				),
			]
		);
		$this->add_control(
			'md_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1200px', 'kariez-core' ),
				'default' => '4',
				'options' => array(
					'1' => esc_html__( '1', 'kariez-core' ),
					'2' => esc_html__( '2', 'kariez-core' ),
					'3' => esc_html__( '3',  'kariez-core' ),
					'4' => esc_html__( '4',  'kariez-core' ),
					'5' => esc_html__( '5',  'kariez-core' ),
					'6' => esc_html__( '6',  'kariez-core' ),
					'7' => esc_html__( '7',  'kariez-core' ),
				),
			]
		);
		$this->add_control(
			'sm_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 992px', 'kariez-core' ),
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1', 'kariez-core' ),
					'2' => esc_html__( '2', 'kariez-core' ),
					'3' => esc_html__( '3',  'kariez-core' ),
					'4' => esc_html__( '4',  'kariez-core' ),
					'5' => esc_html__( '5',  'kariez-core' ),
					'6' => esc_html__( '6',  'kariez-core' ),
				),
			]
		);
		$this->add_control(
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'kariez-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'kariez-core' ),
					'2' => esc_html__( '2', 'kariez-core' ),
					'3' => esc_html__( '3',  'kariez-core' ),
					'4' => esc_html__( '4',  'kariez-core' ),
					'5' => esc_html__( '5',  'kariez-core' ),
				),
			]
		);
		$this->add_control(
			'mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 576px', 'kariez-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'kariez-core' ),
					'2' => esc_html__( '2', 'kariez-core' ),
					'3' => esc_html__( '3',  'kariez-core' ),
					'4' => esc_html__( '4',  'kariez-core' ),
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
					'3' => esc_html__( '3',  'kariez-core' ),
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
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'kariez-core' ),
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
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
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
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'next_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'next_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
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
				'default' => [
					'size' => 1,
				],
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
				'425'    =>array('slidesPerView' =>$data['sm_mobile']),
				'576'    =>array('slidesPerView' =>$data['mobile']),
				'768'    =>array('slidesPerView' =>$data['tablet']),
				'992'    =>array('slidesPerView' =>$data['sm_desktop']),
				'1200'    =>array('slidesPerView' =>$data['md_desktop']),
				'1600'    =>array('slidesPerView' =>$data['desktop'])
			),
			'auto'   =>$data['slider_autoplay']
		);

		if ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-1' == $data['layout'] ) {
			$data['swiper_data'] = json_encode( $swiper_data );
			$template = 'view-1';
		}

		Fns::get_template( "elementor/logo-brand/$template", $data );
	}

}