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

class ProjectAccordion extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Project Accordion', 'kariez-core' );
		$this->rt_base = 'rt-project-accordion-addon';
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


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'project_image', [
				'type' => Controls_Manager::MEDIA,
				'label' =>   esc_html__('Choose Image', 'kariez-core'),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'category',
			[
				'label' => __('Category', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Cargo Ship', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title', [
				'label' => __('Title', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Air Freight Transport', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'accordion_btn',
			[
				'label' => __('Button', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Read More', 'kariez-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'rt_desc',
			[
				'label' => __('Description', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit.', 'kariez-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title_url',
			[
				'label'       => __( 'Link', 'kariez-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'kariez-core' ),
				'show_label'  => false,
			]
		);


		$this->add_control(
			'project_items',
			[
				'label' => __('Project list', 'kariez-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Cargo ship loading port Services 2025 ', 'kariez-core'),
					],
					[
						'title' => __('Mauritius Maritime Ship Port Week 2025', 'kariez-core'),
					],
					[
						'title' => __('Cargo container Ship Port Services in New york', 'kariez-core'),
					],
					[
						'title' => __('Industrial Container Cargo freight ship', 'kariez-core'),
					],
				],
				'title_field' => '{{{ title }}}',
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

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .accordion-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-project-accordion-wrap .item .content .accordion-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __( 'Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .accordion-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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

		// Icon setting
		$this->start_controls_section(
			'category_style',
			[
				'label' => esc_html__( 'Category Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .rt-accordion-category a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rt-project-accordion-wrap .item .content .rt-accordion-category a',
			]
		);
		$this->add_responsive_control(
			'category_radius',
			[
				'label'      => __( 'Border Radius', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .rt-accordion-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);


		$this->add_control(
			'category_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .rt-accordion-category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'category_size',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Font Size', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .rt-accordion-category a' => 'font-size: {{VALUE}}px',
				],
			]
		);
		$this->add_responsive_control(
			'category_margin',
			[
				'label'      => __( 'Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .rt-accordion-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		//Description Style
		$this->start_controls_section(
			'description_style',
			[
				'label' => esc_html__( 'Description', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'      => __( 'Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .desc',
			]
		);

		$this->end_controls_section();

		//Read More Style
		$this->start_controls_section(
			'read_more_style',
			[
				'label' => esc_html__( 'Read More Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'read_more_margin',
			[
				'label'      => __( 'Margin', 'kariez-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .accordion-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'read_more_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'kariez-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .accordion-button a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'read_more_typo',
				'label'    => esc_html__( 'Typo', 'kariez-core' ),
				'selector' => '{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .accordion-button a',
			]
		);

		$this->add_responsive_control(
			'read_more_line_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Line Width', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .accordion-button a:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'read_more_line_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Line Height', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .accordion-button a:before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'read_more_line_background',
				'label' => __('Line Background', 'kariez-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Line Background', 'kariez-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-accordion-wrap .item .content .hover-content .accordion-button a:before',
			]
		);

		$this->end_controls_section();

		//Content Position
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Position', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_horizontal',
			[
				'label'      => __( 'Horizontal Position', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_vertical',
			[
				'label'      => __( 'Vertical Position', 'kariez-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-accordion-wrap .item .content' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Box Setting
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Height', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-project-accordion-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Width', 'kariez-core' ),
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
					'{{WRAPPER}} .rt-project-accordion-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/project-accordion/$template", $data );
	}

}