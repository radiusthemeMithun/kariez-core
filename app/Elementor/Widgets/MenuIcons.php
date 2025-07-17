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

class MenuIcons extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Menu Icons', 'kariez-core' );
		$this->rt_base = 'rt-menu-icons';
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
		$this->add_responsive_control(
			'action_item_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Item Space', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'has_separator',
			[
				'label'       => esc_html__( 'Item Separator', 'kariez-core' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'On', 'kariez-core' ),
				'label_off'   => esc_html__( 'Off', 'kariez-core' ),
				'default'     => 'yes',
				'render_type' => 'template',
			]
		);
		$this->add_control(
			'separator_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Separator Color', 'kariez-core' ),
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .has-separator li:not(:last-child):after' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'has_separator' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'separator_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Separator Space', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .has-separator li:not(:last-child)' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'has_separator' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'kariez-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'kariez-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'kariez-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'kariez-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper' => 'justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'direction',
			[
				'label'       => esc_html__( 'Direction', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'default' => __( 'Default', 'kariez-core' ),
					'row-reverse' => __( 'Reverse', 'kariez-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action' => 'flex-direction: {{VALUE}};',
				],
				'default'     => 'default',
			]
		);

		$this->end_controls_section();

		// Action button
		$this->start_controls_section(
			'sec_action_button',
			[
				'label' => esc_html__( 'Action Button', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'button',
			[
				'label'     => esc_html__( 'Action Button Display', 'kariez-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'kariez-core' ),
				'label_off' => esc_html__( 'Off', 'kariez-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Get Started', 'kariez-core' ),
				'condition'   => [
					'button' => [ 'yes' ],
				],
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
				'condition'   => [
					'button' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
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
				'condition'   => [
					'button' => [ 'yes' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_login_button',
			[
				'label' => esc_html__( 'Login Button', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'login',
			[
				'label'     => esc_html__( 'Login Display', 'kariez-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'kariez-core' ),
				'label_off' => esc_html__( 'Off', 'kariez-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'log_button_text',
			[
				'label'       => esc_html__( 'Login Button Text', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Log In', 'kariez-core' ),
				'condition'   => [
					'login' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'login_icon',
			[
				'label'            => __( 'Choose Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-user',
					'library' => 'solid',
				],
				'condition'   => [
					'login' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'sec_phone',
			[
				'label' => esc_html__( 'Phone', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'phone',
			[
				'label'     => esc_html__( 'Phone Display', 'kariez-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'kariez-core' ),
				'label_off' => esc_html__( 'Off', 'kariez-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'phone_label',
			[
				'label'       => esc_html__( 'Phone Label', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Hotline', 'kariez-core' ),
				'condition'   => [
					'phone' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'phone_number',
			[
				'label'       => esc_html__( 'Phone Number', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( '+123-7767-8989', 'kariez-core' ),
				'condition'   => [
					'phone' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'phone_icon',
			[
				'label'            => __( 'Choose Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-phone',
					'library' => 'solid',
				],
				'condition'   => [
					'phone' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_section();

		// Icon Style
		$this->start_controls_section(
			'search_style',
			[
				'label' => __( 'Search Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'search',
			[
				'label'     => esc_html__( 'Search', 'kariez-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'kariez-core' ),
				'label_off' => esc_html__( 'Off', 'kariez-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'search_size',
			[
				'label' => __( 'Button Size', 'kariez-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-search-bar' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'search_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-search-bar i' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'search' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'search_icon_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper a.menu-search-bar:hover'  => 'color: {{VALUE}}',
				],
				'condition'   => [
					'search' => [ 'yes' ],
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'search_border',
                'label'    => __( 'Border', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .menu-icon-wrapper .menu-search-bar',
            ]
        );

        $this->add_responsive_control(
            'search_width',
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
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-icon-wrapper .menu-search-bar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_height',
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
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-icon-wrapper .menu-search-bar' => 'Height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


		$this->end_controls_section();

		// Hamburger Style
		$this->start_controls_section(
			'hamburger_style',
			[
				'label' => __( 'Hamburger Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hamburger',
			[
				'label'     => esc_html__( 'Hamburg menu', 'kariez-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'kariez-core' ),
				'label_off' => esc_html__( 'Off', 'kariez-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'hamburger_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .btn-hamburger span' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_control(
			'hamburger_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar:hover .btn-hamburger span' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_control(
			'hamburger_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_control(
			'hamburger_hover_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar:hover' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'hamburger_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'hamburger_width',
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
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'hamburger_height',
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
					'{{WRAPPER}} .ham-burger .menu-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'hamburger_border',
				'selector' => '{{WRAPPER}} .ham-burger .menu-bar',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hamburger_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .ham-burger .menu-bar',
			]
		);

		$this->end_controls_section();

		

		// Button Style
		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-action-button .btn',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'              => __( 'Padding', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-action-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-action-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		// Login Button style Tabs
		$this->start_controls_tabs(
			'button_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);
		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-action-button .btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rt-action-button .btn i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-action-button .btn:before',
			]
		);
		$this->add_responsive_control(
			'button_tab_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-action-button .btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .rt-action-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-action-button .btn',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'kariez-core' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-action-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-action-button .btn:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-action-button .btn:before',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .rt-action-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-action-button .btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Login Button Style
		$this->start_controls_section(
			'login_style',
			[
				'label' => __( 'Login Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'login' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'login_typo',
				'label'    => esc_html__( 'Typography', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-user-login .btn',
			]
		);

		$this->add_responsive_control(
			'login_padding',
			[
				'label'              => __( 'Padding', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-user-login .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'login_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-user-login .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		// Login Button style Tabs
		$this->start_controls_tabs(
			'login_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'login_style_normal_tab',
			[
				'label' => __( 'Normal', 'kariez-core' ),
			]
		);
		$this->add_control(
			'login_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-user-login .btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rt-user-login .btn i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'login_bg_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-user-login .btn:before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'login_border',
				'selector' => '{{WRAPPER}} .rt-user-login .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'login_box_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-user-login .btn',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'login_style_hover_tab',
			[
				'label' => __( 'Hover', 'kariez-core' ),
			]
		);

		$this->add_control(
			'login_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-user-login .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-user-login .btn:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'login_bg_hover_color',
				'label' => __('Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-user-login .btn:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'login_hover_border',
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .rt-user-login a:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'login_hover_box_shadow',
				'label' => __('Box Shadow', 'kariez-core'),
				'selector' => '{{WRAPPER}} .rt-user-login .btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Phone Style
		$this->start_controls_section(
			'phone_style',
			[
				'label' => __( 'Phone Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'phone' => 'yes',
				],
			]
		);
		$this->add_control(
			'phone_layout',
			[
				'label'   => esc_html__( 'Layout', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'phone-1',
				'options' => [
					'phone-1' => __( 'Layout 1', 'kariez-core' ),
					'phone-2' => __( 'Layout 2', 'kariez-core' ),
				],

			]
		);
		// Phone Icon Settings
		$this->add_control(
			'phone_icon_heading',
			[
				'label'     => __( 'Phone Icon Settings', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_icon_typo',
				'label'    => esc_html__( 'Icon Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-phone .phone-icon',
			]
		);
		$this->add_control(
			'phone_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-phone .phone-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'phone_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon BG Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-phone .phone-icon i' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'phone_layout!' => ['phone-1'],
				],
			]
		);
		$this->add_responsive_control(
			'phone_icon_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Space', 'kariez-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-phone .phone-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Phone Label Settings
		$this->add_control(
			'phone_label_heading',
			[
				'label'     => __( 'Phone Label Settings', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_label_typo',
				'label'    => esc_html__( 'Label Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-phone .phone-label',
			]
		);
		$this->add_control(
			'phone_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Label Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-phone .phone-label' => 'color: {{VALUE}}',
				],
			]
		);
		// Phone Number Settings
		$this->add_control(
			'phone_number_heading',
			[
				'label'     => __( 'Phone Number Settings', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_number_typo',
				'label'    => esc_html__( 'Number Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-phone .phone-number',
			]
		);
		$this->add_control(
			'phone_number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Number Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-phone .phone-number' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'phone_number_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Number Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-phone .phone-number:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/menu-icons/$template", $data );
	}

}