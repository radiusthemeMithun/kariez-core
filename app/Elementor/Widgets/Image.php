<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use RT\KariezCore\Helper\Fns;
use RT\KariezCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Image extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Image', 'kariez-core' );
		$this->rt_base = 'rt-image';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'rt-parallax-scroll' ];
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
				'label'       => esc_html__( 'Shape Layout', 'kariez-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'kariez-core' ),
					'layout-2' => __( 'Layout 02', 'kariez-core' ),
				],
				'default'     => 'layout-1',
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
					'{{WRAPPER}} .rt-image-layout' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
				'condition'   => [
					'layout!' => ['layout-5', 'layout-6'],
				],
			]
		);

		$this->add_control(
			'main_image',
			[
				'label'   => __( 'Main Image', 'kariez-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Logo Link', 'kariez-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'kariez-core' ),
				'show_label'  => false,
				'condition'   => [
					'layout!' => ['layout-5', 'layout-6'],
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

		// layout 2
		$this->add_control(
			'position',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Position', 'kariez-core' ),
				'options' => array(
					'relative' 		=> esc_html__( 'Relative', 'kariez-core' ),
					'absolute' 		=> esc_html__( 'Absolute', 'kariez-core' ),
				),
				'default' => 'relative',
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_control(
			'z_index',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Z-Index', 'kariez-core' ),
				'default' => 1,
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_responsive_control(
			'position_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Horizontal', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image-layout .rt-image' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

        $this->add_responsive_control(
            'position_left',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Position Left', 'kariez-core' ),
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1200,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-image-layout .rt-image' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'layout' => ['layout-2'],
                ],
            ]
        );

		$this->add_responsive_control(
			'position_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Vertical', 'kariez-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image-layout .rt-image' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

        $this->add_responsive_control(
            'position_bottom',
            [
                'type'    => Controls_Manager::SLIDER,
                'mode'          => 'responsive',
                'label'   => esc_html__( 'Position Bottom', 'kariez-core' ),
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1200,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-image-layout .rt-image' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'layout' => ['layout-2'],
                ],
            ]
        );

		$this->add_control(
			'animation',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Animation', 'kariez-core' ),
				'options' => array(
					'default' 		=> esc_html__( 'default', 'kariez-core' ),
					'spin' 		=> esc_html__( 'Spin', 'kariez-core' ),
					'move' 	    => esc_html__( 'Move 1', 'kariez-core' ),
					'move1' 	=> esc_html__( 'Move 2', 'kariez-core' ),
					'move2' 	=> esc_html__( 'Move 3', 'kariez-core' ),
				),
				'default' => 'default',
				'condition'   => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'duration',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Duration', 'kariez-core' ),
				'default' => 15,
				'condition'   => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->end_controls_section();

		// Image style
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			],
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'blend',
				'label'   => esc_html__( 'Image Blend', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-image img',
			]
		);

		$this->add_responsive_control(
			'image_width',
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
					'{{WRAPPER}} .rt-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
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
					'{{WRAPPER}} .rt-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Image Shape Settings
		$this->add_control(
			'image_shape_heading',
			[
				'label'     => __( 'Image Shape Settings', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'     => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'image_shape',
			[
				'label'        => __( 'Image Shape', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'kariez-core' ),
				'label_off'    => __( 'Hide', 'kariez-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'     => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'image_shape_style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Shape Style', 'kariez-core' ),
				'options' => array(
					'rt-blr-default rt-blr-shape' 		=> esc_html__( 'Shape 1', 'kariez-core' ),
					'rt-blr-default rt-blr-shape2' 	=> esc_html__( 'Shape 2', 'kariez-core' ),
					'rt-blr-default rt-blr-shape3' 	=> esc_html__( 'Shape 3', 'kariez-core' ),
					'rt-blr-default rt-blr-shape4' 	=> esc_html__( 'Shape 4', 'kariez-core' ),
				),
				'default' => 'rt-blr-default rt-blr-shape',
				'condition'     => [
					'layout' => ['layout-1'], 'image_shape' => 'yes',
				],
			]
		);

		$this->add_control(
			'image_shape_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Shape Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-blr-shape' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-blr-default:after' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'layout' => ['layout-1'], 'image_shape' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Width', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-blr-shape' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-blr-default:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'layout' => ['layout-1'], 'image_shape' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Height', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-blr-shape' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-blr-default:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'layout' => ['layout-1'], 'image_shape' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'shape_radius',
			[
				'label'      => __( 'Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-blr-default:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_box_style',
			[
				'label' => esc_html__( 'Image Box Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-image img' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-image img',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .rt-image img',
			]
		);

		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => __( 'Padding', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
			'animations',
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
					'animations' => [ 'wow' ]
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
					'animations' => [ 'wow' ]
				],
			],
		);

		$this->add_control(
			'durations',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Duration', 'kariez-core' ),
				'default' => '1200',
				'condition'   => [
					'animations' => [ 'wow' ]
				],
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data  = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/image/$template", $data );
	}

}