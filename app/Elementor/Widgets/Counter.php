<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use RT\KariezCore\Helper\Fns;
use RT\KariezCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Counter extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Counter', 'kariez-core' );
		$this->rt_base = 'rt-counter';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'rt-counterup', 'rt-waypoints' ];
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
				'label'       => esc_html__( 'Counter Layout', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'kariez-core' ),
                    'layout-2' => __( 'Layout 02', 'kariez-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Clients Worldwide', 'kariez-core' ),
			]
		);

		$this->add_control(
			'number',
			[
				'label'       => esc_html__( 'Count Number', 'kariez-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 567,
			]
		);

		$this->add_control(
			'unit',
			[
				'label'       => esc_html__( 'Counter Unit', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '',
			]
		);

		$this->add_control(
			'speed',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Counter Speed', 'kariez-core' ),
				'default' => 5000,
				'description' => esc_html__( 'The total duration of the count animation in milisecond eg. 5000', 'kariez-core' ),
			]
		);

		$this->add_control(
			'steps',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Counter Steps', 'kariez-core' ),
				'default' => 10,
				'description' => esc_html__( 'Counter steps eg. 10', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-counter-layout' => 'text-align: {{VALUE}};',
				],
			]
		);

		// scroll animation
		$this->add_control(
			'scroll_animation',
			[
				'label'        => __( 'Scroll Animation', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'kariez-core' ),
				'label_off'    => __( 'Hide', 'kariez-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'x_range',
			[
				'label'       => esc_html__( 'Animation Property', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'x' => __( 'x', 'kariez-core' ),
					'y' => __( 'y', 'kariez-core' ),
					'z' => __( 'z', 'kariez-core' ),
					'rotateX' => __( 'rotateX', 'kariez-core' ),
					'rotateY' => __( 'rotateY', 'kariez-core' ),
					'rotateZ' => __( 'rotateZ', 'kariez-core' ),
					'scaleX' => __( 'scaleX', 'kariez-core' ),
					'scaleY' => __( 'scaleY', 'kariez-core' ),
					'scaleZ' => __( 'scaleZ', 'kariez-core' ),
					'scale' => __( 'scale', 'kariez-core' ),
				],
				'label_block' => true,
				'default'     => 'y',
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);
		$this->add_control(
			'y_range',
			[
				'label'       => esc_html__( 'Animation Property', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'x' => __( 'x', 'kariez-core' ),
					'y' => __( 'y', 'kariez-core' ),
					'z' => __( 'z', 'kariez-core' ),
					'rotateX' => __( 'rotateX', 'kariez-core' ),
					'rotateY' => __( 'rotateY', 'kariez-core' ),
					'rotateZ' => __( 'rotateZ', 'kariez-core' ),
					'scaleX' => __( 'scaleX', 'kariez-core' ),
					'scaleY' => __( 'scaleY', 'kariez-core' ),
					'scaleZ' => __( 'scaleZ', 'kariez-core' ),
					'scale' => __( 'scale', 'kariez-core' ),
				],
				'label_block' => true,
				'default'     => 'x',
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);
		$this->add_control(
			'range_one',
			[
				'label'       => esc_html__( 'Range Value One', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 50,
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);
		$this->add_control(
			'range_two',
			[
				'label'       => esc_html__( 'Range Value Two', 'kariez-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 0,
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-label',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_space',
			[
				'label'      => __( 'Space', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Counter number setting
		$this->start_controls_section(
			'counter_style',
			[
				'label' => esc_html__( 'Counter Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number',
			]
		);

		$this->add_control(
			'counter_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'counter_stroke_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Stroke Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number' => '-webkit-text-stroke: 1px {{VALUE}}',
				],
			]
		);
        $this->add_control(
            'stroke_width',
            [
                'type'    => Controls_Manager::SLIDER,
                'label'     => esc_html__( 'Stroke Width', 'kariez-core' ),
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-wrap .counter-number' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


		$this->add_control(
			'counter_space',
			[
				'label'      => __( 'Counter Space', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Box Style
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'              => __( 'Padding', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label'              => __( 'Radius', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
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
		$data  = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/counter/$template", $data );
	}

}