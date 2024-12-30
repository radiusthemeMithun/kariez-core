<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use RT\KariezCore\Abstracts\ElementorBase;
use RT\KariezCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Title extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Section Title', 'kariez-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}


	protected function register_controls() {
		/* General Options */

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_layout',
			[
				'label'       => esc_html__( 'Title Layout', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'kariez-core' ),
					'layout-2' => __( 'Layout 02', 'kariez-core' ),
                    'layout-3' => __( 'Layout 03', 'kariez-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'top_sub_title',
			[
				'label'       => esc_html__( 'Top Sub Title', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Why Choose Our About', 'kariez-core' ),
			]
		);

        $this->add_control(
            'highlight_sub_title',
            [
                'label'       => esc_html__( 'Highlight Sub Title', 'kariez-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'condition'  => [
                    'title_layout' => 'layout-1',
                ],

            ]
        );

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Main Title', 'kariez-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( 'Welcome To Our Kariez', 'kariez-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span>.", 'kariez-core' ),
			]
		);

        $this->add_control(
            'stroke_title',
            [
                'label'       => esc_html__( 'Stroke Title', 'kariez-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => __( 'Transportation', 'kariez-core' ),
                'condition'  => [
                    'title_layout' => 'layout-3',
                ],
            ]
        );


		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'kariez-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default'     => __('Manage and streamline operations across multiple locations, sales channels, and employees to improve efficiency and your bottom line.', 'kariez-core' ),
				'condition'  => [
					'title_layout' => ['layout-1', 'layout-3'],
				],
			]
		);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'list_text',
            [
                'label'       => __( 'List Text', 'kariez-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Powerful database store', 'kariez-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'list_icon',
            [
                'label'            => __( 'Choose Icon', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'icon-rt-correct',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'show_feature_list',
            [
                'label'        => __( 'Feature List', 'kariez-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'kariez-core' ),
                'label_off'    => __( 'Off', 'kariez-core' ),
                'return_value' => 'is-feature',
                'condition'  => [
                    'title_layout' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'feature_lists',
            [
                'label'       => __( 'Feature List', 'kariez-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'list_text'        => __( 'Powerful database store', 'kariez-core' ),
                    ],
                    [
                        'list_text'        => __( 'Easy to access all projects', 'kariez-core' ),
                    ],
                    [
                        'list_text'        => __( 'Effortless courier allocation', 'kariez-core' ),
                    ],
                    [
                        'list_text'        => __( 'Widest coverage network', 'kariez-core' ),
                    ],

                ],
                'title_field' => '{{{ name }}}',
                'condition'   => [
                    'show_feature_list' => [ 'is-feature' ],
                    'title_layout' => ['layout-1'],
                ],
            ]
        );


		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'kariez-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'       => '',
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
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .main-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_two',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Color 2', 'kariez-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span> from main title.", 'kariez-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .main-title span' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_span_typo',
				'label'    => esc_html__( 'Typo 2', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title span',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'main_title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__( 'H1', 'kariez-core' ),
					'h2' => esc_html__( 'H2', 'kariez-core' ),
					'h3' => esc_html__( 'H3', 'kariez-core' ),
					'h4' => esc_html__( 'H4', 'kariez-core' ),
					'h5' => esc_html__( 'H5', 'kariez-core' ),
					'h6' => esc_html__( 'H6', 'kariez-core' ),
					'span' => esc_html__( 'Span', 'kariez-core' ),
					'div' => esc_html__( 'Div', 'kariez-core' ),
				],
			]
		);

		$this->end_controls_section();

        // Stroke Title Settings
        $this->start_controls_section(
            'stroke_settings',
            [
                'label' => esc_html__( 'Stroke Settings', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'stroke_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .section-title-wrapper .stroke-title' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'stroke_typo',
                'label'    => esc_html__( 'Typo', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .section-title-wrapper .stroke-title',
            ]
        );


        $this->add_responsive_control(
            'stroke_margin',
            [
                'label'              => __( 'Margin', 'kariez-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', '%' ],
                'selectors'          => [
                    '{{WRAPPER}} .stroke-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


        $this->add_control(
            'main_stroke_tag',
            [
                'label'   => esc_html__( 'Main Stroke Tag', 'kariez-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'H1', 'kariez-core' ),
                    'h2' => esc_html__( 'H2', 'kariez-core' ),
                    'h3' => esc_html__( 'H3', 'kariez-core' ),
                    'h4' => esc_html__( 'H4', 'kariez-core' ),
                    'h5' => esc_html__( 'H5', 'kariez-core' ),
                    'h6' => esc_html__( 'H6', 'kariez-core' ),
                    'span' => esc_html__( 'Span', 'kariez-core' ),
                    'div' => esc_html__( 'Div', 'kariez-core' ),
                ],
            ]
        );

        $this->end_controls_section();

		// Top Sub Title
		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( 'Sub Title Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'sub_title_style',
            [
                'label'     => __( 'Sub Title Style', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'  => __( 'Default', 'kariez-core' ),
                ],
            ]
        );


		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'top_title_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-title-wrapper .top-sub-title svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'top_title_bg_color',
				'label' => __('Background', 'kariez-core'),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_typo',
				'label'    => esc_html__( 'Typography', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_responsive_control(
			'top_title_padding',
			[
				'label'              => __( 'Padding', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => __( 'Margin', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();



		// Description Settings
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description & List Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'  => [
					'title_layout' => ['layout-1', 'layout-3']
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%','px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
                'selector' => '{{WRAPPER}} .section-title-wrapper ul.feature-list li',
            ]
        );

        $this->add_control(
            'list_column',
            [
                'label'     => __( 'List Column', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'  => __( 'One Column', 'kariez-core' ),
                    'two-column' => __( 'Two Column', 'kariez-core' ),
                ],
            ]
        );

        $this->add_control(
            'list_layout',
            [
                'label'     => __( 'List Layout', 'kariez-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'list-layout-1',
                'options'   => [
                    'list-layout-1' => __( 'Layout 1', 'kariez-core' ),
                    'list-layout-2' => __( 'layout 2', 'kariez-core' ),
                ],
            ]
        );

        $this->add_control(
            'list_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'List Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .section-title-wrapper .feature-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'list_icon_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'List Icon Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'list_icon_bg_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'List Icon BG Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'list_icon_border',
                'label'    => __( 'Border', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .section-title-wrapper .feature-list li span',
            ]
        );
        $this->add_responsive_control(
            'list_icon_radius',
            [
                'label'              => __( 'Radius', 'kariez-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label'              => __( 'Padding', 'kariez-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ '%','px' ],
                'selectors'          => [
                    '{{WRAPPER}} .section-title-wrapper ul.feature-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


		$this->end_controls_section();

		// Background Title Settings
		//==============================================================
		$this->start_controls_section(
			'Common Settings',
			[
				'label' => esc_html__( 'Common Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_title_wrap_margin',
			[
				'label'              => __( 'Wrapper Margin', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		$data     = $this->get_settings();

		switch ( $data['title_layout'] ) {
			case 'layout-2':
				$template = 'view-2';
				break;
            case 'layout-3':
                $template = 'view-3';
                break;
			default:
				$template = 'view-1';
				break;
		}

		Fns::get_template( "elementor/title/$template", $data );
	}

}