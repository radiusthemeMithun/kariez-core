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

class HeroSlider extends ElementorBase {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name = __( 'RT Hero Slider', 'kariez-core' );
        $this->rt_base = 'rt-hero-slider';
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
            'sec_general',
            [
                'label' => esc_html__( 'General', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'banner_image', [
                'type' => Controls_Manager::MEDIA,
                'label' =>   esc_html__('Choose Hero Image', 'kariez-core'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

	    $repeater->add_control(
		    'banner_img',
		    [
			    'label'   => __( 'Choose Thumb Image', 'kariez-core' ),
			    'type'    => \Elementor\Controls_Manager::MEDIA,
			    'default' => [
				    'url' => \Elementor\Utils::get_placeholder_image_src(),
			    ],
		    ]
	    );

	    $repeater->add_control(
		    'banner_slider_image',
		    [
			    'label'   => __( 'Choose Image', 'kariez-core' ),
			    'type'    => \Elementor\Controls_Manager::MEDIA,
			    'default' => [
				    'url' => \Elementor\Utils::get_placeholder_image_src(),
			    ],
		    ]
	    );


        $repeater->add_control(
            'sub_title', [
                'label' => __('Sub Title', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Top Financial Advisor', 'kariez-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'title', [
                'label' => __('Title', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Fast and Secure Transportation of Your Cargo', 'kariez-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'content', [
                'label' => __('Content', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('A good strategy is a strategy that can successfully lead the business in a more developed direction.', 'kariez-core'),
                'label_block' => true,
            ]
        );
	    $repeater->add_control(
		    'thumb_text', [
			    'label' => __('Thumb Text', 'kariez-core'),
			    'type' => \Elementor\Controls_Manager::TEXTAREA,
			    'default' => __('Land Transport', 'kariez-core'),
			    'label_block' => true,
		    ]
	    );
        $repeater->add_control(
            'button_text', [
                'type' => Controls_Manager::TEXT,
                'label'   => esc_html__( 'Button Text', 'kariez-core' ),
                'default' => esc_html__( 'Who We Are', 'kariez-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'button_url', [
                'type' => Controls_Manager::URL,
                'label'   => esc_html__( 'Button URL', 'kariez-core' ),
                'placeholder' => esc_url('https://your-link.com' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'layout',
            [
                'label'       => esc_html__( 'Layout', 'kariez-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'   => [
                    'layout-1' => __( 'Thumb Slider', 'kariez-core' ),
                    'layout-2' => __( 'Hero Slider', 'kariez-core' ),
                    'layout-3' => __( 'Hero Slider 02', 'kariez-core' ),
                ],
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
                    '{{WRAPPER}} .content-wrap' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'slider_items',
            [
                'label' => __('Slider Items', 'kariez-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'sub_title' => __('Top Financial Advisor', 'kariez-core'),
                        'title' => __('Fast and Secure Transportation of Your Cargo', 'kariez-core'),
                        'content' => __('A good strategy is a strategy that can successfully lead the business in a more developed direction.', 'kariez-core'),
                    ],
                    [
                        'sub_title' => __('Top Financial Advisor', 'kariez-core'),
                        'title' => __('Fast and Secure Transportation of Your Cargo', 'kariez-core'),
                        'content' => __('A good strategy is a strategy that can successfully lead the business in a more developed direction.', 'kariez-core'),
                    ],
                    [
                        'sub_title' => __('Top Financial Advisor', 'kariez-core'),
                        'title' => __('Fast and Secure Transportation of Your Cargo', 'kariez-core'),
                        'content' => __('A good strategy is a strategy that can successfully lead the business in a more developed direction.', 'kariez-core'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->add_responsive_control(
            'slider_height',
            [
                'type'    => Controls_Manager::SLIDER,
                'label'   => esc_html__( 'Slider Height', 'kariez-core' ),
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
                    '{{WRAPPER}} .rt-hero-slider .single-slider' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
	    $this->add_responsive_control(
		    'slider_padding',
		    [
			    'label'      => __( 'Slider Padding', 'kariez-core' ),
			    'type'       => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors'  => [
				    '{{WRAPPER}} .rt-hero-slider .single-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
		    ]
	    );
        $this->add_responsive_control(
            'slider_width',
            [
                'type'    => Controls_Manager::SLIDER,
                'label'   => esc_html__( 'Slider Content Width', 'kariez-core' ),
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
                    '{{WRAPPER}} .rt-hero-slider .slider-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_animation',
            [
                'label'        => __( 'Slider Animation', 'kariez-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'kariez-core' ),
                'label_off'    => __( 'Hide', 'kariez-core' ),
                'default'      => 'yes',
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

	    $this->add_responsive_control(
		    'thumb_size_width',
		    [
			    'label'      => __( 'Thumb Size Width ', 'kariez-core' ),
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
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb img' => 'width: {{SIZE}}{{UNIT}};',
				    '{{WRAPPER}} .rt-hero-slider .single-slider .content-slider-img img' => 'width: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );
	    $this->add_responsive_control(
		    'thumb_size_height',
		    [
			    'label'      => __( 'Thumb Size Height', 'kariez-core' ),
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
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb img' => 'height: {{SIZE}}{{UNIT}};',
				    '{{WRAPPER}} .rt-hero-slider .single-slider .content-slider-img img' => 'height: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );
	    $this->add_responsive_control(
		    'box_padding',
		    [
			    'label'      => __( 'Padding', 'kariez-core' ),
			    'type'       => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors'  => [
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'box_radius',
		    [
			    'label'      => __( 'Radius', 'kariez-core' ),
			    'type'       => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors'  => [
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
			    'name' => 'border',
			    'selector' => '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb',
		    ]
	    );
	    $this->add_responsive_control(
		    'img_alignment',
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
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb' => 'text-align: {{VALUE}};',
			    ],
			    'separator' => 'before',
		    ]
	    );

        $this->end_controls_section();

        // Sub Title setting
        $this->start_controls_section(
            'sub_title_style',
            [
                'label' => esc_html__( 'Sub Title Style', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typo',
                'label' => esc_html__('Typo', 'kariez-core'),
                'selector' => '{{WRAPPER}} .rt-hero-slider .sub-title',
            ]
        );
        $this->add_control(
            'sub_title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Color', 'kariez-core'),
                'selectors' => [
                    '{{WRAPPER}} .rt-hero-slider .sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );
	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
			    'name' => 'sub_title_bg_color',
			    'label' => __('Background', 'kariez-core'),
			    'types' => ['classic', 'gradient'],
			    'fields_options'  => [
				    'background' => [
					    'label' => esc_html__( 'Background', 'kariez-core' ),
				    ],
			    ],
			    'selector' => '{{WRAPPER}} .rt-hero-slider .sub-title',
		    ]
	    );
	    $this->add_responsive_control(
		    'sub_title_radius',
		    [
			    'label'              => __( 'Radius', 'kariez-core' ),
			    'type'               => Controls_Manager::DIMENSIONS,
			    'size_units'         => [ 'px' ],
			    'selectors'          => [
				    '{{WRAPPER}} .rt-hero-slider .sub-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
			    'separator' => 'before',
		    ]
	    );
	    $this->add_responsive_control(
		    'sub_title_padding',
		    [
			    'label' => __('Padding', 'kariez-core'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .rt-hero-slider .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
			    'separator' =>'before',
		    ]
	    );
        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label' => __('Margin', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rt-hero-slider .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
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
                'name' => 'title_typo',
                'label' => esc_html__('Typo', 'kariez-core'),
                'selector' => '{{WRAPPER}} .rt-hero-slider .slider-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Color', 'kariez-core'),
                'selectors' => [
                    '{{WRAPPER}} .rt-hero-slider .slider-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Margin', 'kariez-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rt-hero-slider .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'the-post-grid' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1' => esc_html__( 'H1', 'the-post-grid' ),
                    'h2' => esc_html__( 'H2', 'the-post-grid' ),
                    'h3' => esc_html__( 'H3', 'the-post-grid' ),
                    'h4' => esc_html__( 'H4', 'the-post-grid' ),
                    'h5' => esc_html__( 'H5', 'the-post-grid' ),
                    'h6' => esc_html__( 'H6', 'the-post-grid' ),
                ],
            ]
        );
        $this->end_controls_section();

        // Content setting
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content Style', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typo',
                'label' => esc_html__('Typo', 'kariez-core'),
                'selector' => '{{WRAPPER}} .rt-hero-slider .slider-text',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Color', 'kariez-core'),
                'selectors' => [
                    '{{WRAPPER}} .rt-hero-slider .slider-text' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .rt-hero-slider .slider-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' =>'before',
            ]
        );

        $this->end_controls_section();

	    // Thumb Text setting
	    $this->start_controls_section(
		    'thumb_text_style',
		    [
			    'label' => esc_html__( 'Thumb Title Style', 'kariez-core' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'thumb_text_typo',
			    'label' => esc_html__('Typo', 'kariez-core'),
			    'selector' => '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb .thumb-text-title',
		    ]
	    );
	    $this->add_control(
		    'thumb_text_color',
		    [
			    'type' => Controls_Manager::COLOR,
			    'label' => esc_html__('Color', 'kariez-core'),
			    'selectors' => [
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb .thumb-text-title' => 'color: {{VALUE}}',
			    ],
		    ]
	    );
	    $this->add_responsive_control(
		    'thumb_text_margin',
		    [
			    'label' => __('Margin', 'kariez-core'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .rt-hero-slider .rt-thumbnail-area .item-thumb .thumb-text-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
			    'separator' =>'before',
		    ]
	    );
	    $this->end_controls_section();


	    // Button Settings
	    $this->start_controls_section(
		    'button_settings',
		    [
			    'label' => esc_html__( 'Button Settings', 'kariez-core' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name'     => 'button_typo',
			    'label'    => esc_html__( 'Typography', 'kariez-core' ),
			    'selector' => '{{WRAPPER}} .rt-button .btn',
		    ]
	    );

	    $this->add_responsive_control(
		    'button_padding',
		    [
			    'label'              => __( 'Padding', 'kariez-core' ),
			    'type'               => Controls_Manager::DIMENSIONS,
			    'size_units'         => [ 'px' ],
			    'selectors'          => [
				    '{{WRAPPER}} .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				    '{{WRAPPER}} .rt-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
			    'separator' => 'before',
		    ]
	    );

	    $this->add_responsive_control(
		    'button_width',
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
				    '{{WRAPPER}} .rt-button .btn' => 'width: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'button_height',
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
				    '{{WRAPPER}} .rt-button .btn' => 'height: {{SIZE}}{{UNIT}};',
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
				    '{{WRAPPER}} .rt-button .btn .button-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
		    ]
	    );

	    //Button style Tabs
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
				    '{{WRAPPER}} .rt-button .btn .button-text' => 'color: {{VALUE}}',
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
			    'selector' => '{{WRAPPER}} .rt-button .btn',
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
			    'name' => 'button_border',
			    'selector' => '{{WRAPPER}} .rt-button .btn',
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'button_box_shadow',
			    'label' => __('Box Shadow', 'kariez-core'),
			    'selector' => '{{WRAPPER}} .rt-button .btn',
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
				    '{{WRAPPER}} .rt-button .btn .button-text:hover' => 'color: {{VALUE}}',

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
			    'selector' => '{{WRAPPER}} .rt-button .btn:hover',
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
			    'name' => 'button_hover_border',
			    'selector' => '{{WRAPPER}} .rt-button .btn:hover',
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'button_hover_box_shadow',
			    'label' => __('Box Shadow', 'kariez-core'),
			    'selector' => '{{WRAPPER}} .rt-button .btn:hover',
		    ]
	    );

	    $this->end_controls_tab();

	    $this->end_controls_tabs();

	    $this->end_controls_section();

	    // Button Icon
	    $this->start_controls_section(
		    'icon_settings',
		    [
			    'label' => esc_html__( 'Button Icon Settings', 'kariez-core' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_responsive_control(
		    'icon_alignment',
		    [
			    'label'     => __( 'Alignment', 'kariez-core' ),
			    'type'      => Controls_Manager::CHOOSE,
			    'options'   => [
				    'row'   => [
					    'title' => __( 'left', 'kariez-core' ),
					    'icon'  => 'eicon-arrow-right',
				    ],
				    'row-reverse'  => [
					    'title' => __( 'right', 'kariez-core' ),
					    'icon'  => 'eicon-arrow-left',
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rt-button .btn' => 'flex-direction: {{VALUE}};',
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
				    'value'   => 'icon-rt-right-arrow',
				    'library' => 'solid',
			    ],
		    ]
	    );
	    $this->add_responsive_control(
		    'icon_shape_height',
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
				    '{{WRAPPER}} .rt-button .btn .btn-round-shape' => 'height: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );
	    $this->add_responsive_control(
		    'icon_shape_width',
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
				    '{{WRAPPER}} .rt-button .btn .btn-round-shape' => 'width: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
			    'name' => 'button_icon_shape_bg_color',
			    'label' => __('Icon Shape Background', 'kariez-core'),
			    'types' => ['classic', 'gradient'],
			    'fields_options'  => [
				    'background' => [
					    'label' => esc_html__( 'Icon Shape Background', 'kariez-core' ),
				    ],
			    ],
			    'selector' => '{{WRAPPER}} .rt-button .btn .btn-round-shape',
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
			    'name' => 'button_icon_shape_bg_hover_color',
			    'label' => __('Icon Shape Hover Background', 'kariez-core'),
			    'types' => ['classic', 'gradient'],
			    'fields_options'  => [
				    'background' => [
					    'label' => esc_html__( 'Icon Shape Hover Background', 'kariez-core' ),
				    ],
			    ],
			    'selector' => '{{WRAPPER}} .rt-button .btn:hover .btn-round-shape',
		    ]
	    );

	    $this->add_responsive_control(
		    'button_icon_shape_radius',
		    [
			    'label'              => __( 'Icon Shape Radius', 'kariez-core' ),
			    'type'               => Controls_Manager::DIMENSIONS,
			    'size_units'         => [ '%', 'px'  ],
			    'selectors'          => [
				    '{{WRAPPER}} .rt-button .btn .btn-round-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
			    'separator' => 'before',
		    ]
	    );


	    $this->add_control(
		    'icon_size',
		    [
			    'label'      => __( 'Icon Size', 'kariez-core' ),
			    'type'       => Controls_Manager::SLIDER,
			    'size_units' => [ 'px' ],
			    'range'      => [
				    'px' => [
					    'min'  => 5,
					    'max'  => 40,
					    'step' => 1,
				    ],
			    ],
			    'default'    => [
				    'unit' => 'px',
				    'size' => 14,
			    ],
			    'selectors'  => [
				    '{{WRAPPER}} .rt-button .btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
				    '{{WRAPPER}} .rt-button .btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'button_icon_color',
		    [
			    'type'      => Controls_Manager::COLOR,
			    'label'     => esc_html__( 'Icon Color', 'kariez-core' ),
			    'selectors' => [
				    '{{WRAPPER}} .rt-button .btn i'        => 'color: {{VALUE}}',
				    '{{WRAPPER}} .rt-button .btn svg path' => 'fill: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'icon_space',
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
				    '{{WRAPPER}} .rt-button .btn' => 'column-gap: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->end_controls_section();



	    // Responsive Settings
//	    $this->start_controls_section(
//		    'sec_grid_responsive',
//		    [
//			    'label' => esc_html__( 'Number of Responsive Columns', 'kariez-core' ),
//			    'tab'   => Controls_Manager::TAB_CONTENT,
//
//		    ]
//	    );
//
//	    $this->add_control(
//		    'col_xl',
//		    [
//			    'type' => Controls_Manager::SELECT,
//			    'label'   => esc_html__( 'Desktops: > 1199px', 'kariez-core' ),
//			    'options' => $this->rt_translate['cols'],
//			    'default' => '4',
//		    ]
//	    );
//	    $this->add_control(
//		    'col_lg',
//		    [
//			    'type' => Controls_Manager::SELECT,
//			    'label'   => esc_html__( 'Desktops: > 991px', 'kariez-core' ),
//			    'options' => $this->rt_translate['cols'],
//			    'default' => '4',
//		    ]
//	    );
//	    $this->add_control(
//		    'col_md',
//		    [
//			    'type' => Controls_Manager::SELECT,
//			    'label'   => esc_html__( 'Tablets: > 767px', 'kariez-core' ),
//			    'options' => $this->rt_translate['cols'],
//			    'default' => '6',
//		    ]
//	    );
//	    $this->add_control(
//		    'col_sm',
//		    [
//			    'type' => Controls_Manager::SELECT,
//			    'label'   => esc_html__( 'Phones: < 768px', 'kariez-core' ),
//			    'options' => $this->rt_translate['cols'],
//			    'default' => '6',
//		    ]
//	    );
//	    $this->add_control(
//		    'col_xs',
//		    [
//			    'type' => Controls_Manager::SELECT,
//			    'label'   => esc_html__( 'Small Phones: < 480px', 'kariez-core' ),
//			    'options' => $this->rt_translate['cols'],
//			    'default' => '12',
//		    ]
//	    );
//
//	    $this->end_controls_section();
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

		// Slider responsive
	    $this->start_controls_section(
		    'section_slider_grid',
		    [
			    'label' => __( 'Slider Grid', 'kariez-core' ),
		    ]
	    );

	    $this->add_control(
		    'desktop',
		    [
			    'type'    => Controls_Manager::SELECT2,
			    'label'   => esc_html__( 'Desktops: > 1600px', 'kariez-core' ),
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
		    'md_desktop',
		    [
			    'type'    => Controls_Manager::SELECT2,
			    'label'   => esc_html__( 'Desktops: > 1200px', 'kariez-core' ),
			    'default' => '1',
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
		    'sm_desktop',
		    [
			    'type'    => Controls_Manager::SELECT2,
			    'label'   => esc_html__( 'Desktops: > 992px', 'kariez-core' ),
			    'default' => '1',
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
		    'tablet',
		    [
			    'type'    => Controls_Manager::SELECT2,
			    'label'   => esc_html__( 'Tablets: > 768px', 'kariez-core' ),
			    'default' => '1',
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
			    'default' => '1',
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
		    'sm_mobile',
		    [
			    'type'    => Controls_Manager::SELECT2,
			    'label'   => esc_html__( 'Phones: > 425px', 'kariez-core' ),
			    'default' => '1',
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
		    'xs_mobile',
		    [
			    'type'    => Controls_Manager::SELECT2,
			    'label'   => esc_html__( 'Phones: > 320px', 'kariez-core' ),
			    'default' => '1',
			    'options' => array(
				    '1' => esc_html__( '1', 'kariez-core' ),
				    '2' => esc_html__( '2', 'kariez-core' ),
				    '3' => esc_html__( '3',  'kariez-core' ),
			    ),
		    ]
	    );

	    $this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'slider_style',
            [
                'label' => esc_html__( 'Slider Style', 'kariez-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                'condition'   => [
                    'display_arrow' => 'yes',
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
                'condition'   => [
                    'display_arrow' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
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
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'display_arrow' => 'yes',
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
                'name' => 'arrow_border',
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
                    '{{WRAPPER}} .swiper-navigation .swiper-button:hover i' => 'color: {{VALUE}}',
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
                'name' => 'arrow_hover_border',
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

        $this->add_responsive_control(
            'pagination_up_down',
            [
                'type'    => Controls_Manager::SLIDER,
                'label'   => esc_html__( 'Pagination UP / Down', 'kariez-core' ),
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
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition'   => [
                    'display_pagination' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_left_right',
            [
                'type'    => Controls_Manager::SLIDER,
                'label'   => esc_html__( 'Pagination Right / Left', 'kariez-core' ),
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
                    '{{WRAPPER}} .swiper-pagination' => 'right: {{SIZE}}{{UNIT}} !important;',
                ],
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
                    '{{WRAPPER}} .rt-hero-slider .swiper-pagination .swiper-pagination-bullet' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .rt-hero-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-hero-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active:after' => 'background-color: {{VALUE}}',
                ],
                'condition'   => [
                    'display_pagination' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Slider option
        $this->start_controls_section(
            'section_slider_option',
            [
                'label' => __( 'Slider Option', 'kariez-core' ),
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


	    switch ( $data['layout'] ) {
		    case 'layout-1':
			    $data['swiper_data'] = json_encode( $swiper_data );
			    $template = 'view-1';
			    break;
		    case 'layout-2':
			    $data['swiper_data'] = json_encode( $swiper_data );
			    $template = 'view-2';
			    break;
		    case 'layout-3':
			    $data['swiper_data'] = json_encode( $swiper_data );
			    $template = 'view-3';
			    break;
		    default:
			    $template = 'view-2';
			    break;
	    }

        Fns::get_template( "elementor/hero-slider/$template", $data );
    }

}