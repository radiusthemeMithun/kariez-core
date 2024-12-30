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

class ContactInfo extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Contact Info', 'kariez-core' );
		$this->rt_base = 'rt-contact-info';
		parent::__construct( $data, $args );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Contact Info Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'list_type', [
				'type'    	  => Controls_Manager::SELECT2,
				'label'   	  => esc_html__( 'List Type', 'kariez-core' ),
				'options' 	  => array(
					'default'    => esc_html__( 'Default List', 'kariez-core' ),
					'title_list' => esc_html__( 'Title List', 'kariez-core' ),
					'icon_list'  => esc_html__( 'Icon List', 'kariez-core' ),
				),
				'default' 	  => 'default',
				'description' => esc_html__( '2 list type available here. (default list is normal text list)', 'kariez-core' ),
			]
		);
		$repeater->add_control(
			'list_title', [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'kariez-core' ),
				'default' => 'List title put here',
				'condition' => [
					'list_type' => 'title_list',
				],
			]
		);
		
		$repeater->add_control(
			'list_icon', [
				'type'      => \Elementor\Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'kariez-core' ),
				'default' => [
					'value' => 'fas fa-map-marker-alt',
					'library' => 'fa-solid',
				],
				'condition' => [
					'list_type' => 'icon_list',
				],
			]
		);
		
		$repeater->add_control(
			'list_text', [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'List Text', 'kariez-core' ),
				'default' => 'Lists text put here',
			]
		);
		
		$this->add_control(
			'title',
			[
				'label'     => __('Title', 'kariez-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'List Title',
			
			]
		);

        $this->add_control(
            'description',
            [
                'label'     => __('Description', 'kariez-core'),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the integer quam dolor nunc semper. ',

            ]
        );

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-contact-info' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);
		
		$this->add_control(
			'items',
			[
				'label'   => esc_html__( 'Test Repeater', 'kariez-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
                    [ 'list_text'        => __( 'info@example.com', 'kariez-core' ),],
					[ 'list_text'        => __( '4140 Parker Rd. Allentown, New Mexico 31134', 'kariez-core' ), ],
					[ 'list_text'        => __( '(+1) 123-456-3389', 'kariez-core' ),],

				],
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
		
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .info-title'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .info-title',
			]
		);
		
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-contact-info .info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();

        // Description Settings
        //==============================================================
        $this->start_controls_section(
            'description_settings',
            [
                'label' => esc_html__( 'Description Settings', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'kariez-core' ),
                'selectors' => [
                    '{{WRAPPER}} .rt-contact-info p'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'label'    => esc_html__( 'Typo', 'kariez-core' ),
                'selector' => '{{WRAPPER}} .rt-contact-info p',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label'              => __( 'Description Spacing', 'kariez-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .rt-contact-info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
		
		// Contact List
		//==============================================================
		$this->start_controls_section(
			'list_item_settings',
			[
				'label'     => esc_html__( 'List Item', 'kariez-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_item_layout',
			[
				'label'   => esc_html__( 'List Layout', 'kariez-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'list-vertical',
				'options' => [
					'list-vertical' => esc_html__( 'Vertical', 'kariez-core' ),
					'list-horizontal' => esc_html__( 'Horizontal', 'kariez-core' ),
				],
			]
		);
		
		$this->add_control(
			'list_item_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'list_item_link_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_link_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Hover Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_typo',
				'label'    => esc_html__( 'List Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li',
			]
		);
		
		$this->add_responsive_control(
			'list_item_spacing',
			[
				'label'              => __( 'List Spacing', 'kariez-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-contact-info .contact-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_list_heading',
			[
				'label'     => __( 'List Heading Setting', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_heading_typo',
				'label'    => esc_html__( 'List Heading Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li span',
			]
		);

		$this->add_control(
			'list_item_heading_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Heading Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_heading_space',
			[
				'label'      => __( 'List Heading Space', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li span'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_list_heading',
			[
				'label'     => __( 'List Icon Setting', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'list_item_icon_size',
			[
				'label'      => __( 'List Icon Size', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 12,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i'   => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_item_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_icon_space',
			[
				'label'      => __( 'List Icon Space', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'phone_list_heading',
			[
				'label'     => __( 'Phone Number Setting', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_phone_typo',
				'label'    => esc_html__( 'Phone Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li.phone-no a',
			]
		);

		$this->add_control(
			'list_item_phone_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li.phone-no a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		$template = 'view-1';
		Fns::get_template( "elementor/contact-info/{$template}", $data );
	}

}