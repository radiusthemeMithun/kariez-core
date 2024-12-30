<?php
namespace RT\KariezCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\KariezCore\Abstracts\ElementorBase;
use RT\KariezCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class ImageGallery extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Image Gallery', 'kariez-core' );
		$this->rt_base = 'rt-image-gallery';
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
			'section_gallery',
			[
				'label' => esc_html__( 'RT Gallery', 'kariez-core' ),
			]
		);

		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'kariez-core' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
			]
		);

		$this->add_control(
			'gallery_display_caption',
			[
				'label' => esc_html__( 'Caption', 'kariez-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'none' => esc_html__( 'None', 'kariez-core' ),
					'' => esc_html__( 'Attachment Caption', 'kariez-core' ),
				],
			]
		);

		$this->add_control(
			'gallery_link',
			[
				'label' => esc_html__( 'Link', 'kariez-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'file',
				'options' => [
					'file' => esc_html__( 'Media File', 'kariez-core' ),
					'none' => esc_html__( 'None', 'kariez-core' ),
				],
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => esc_html__( 'Lightbox', 'kariez-core' ),
				'type' => Controls_Manager::SELECT,
				'description' => sprintf(
					/* translators: 1: Link open tag, 2: Link close tag. */
					esc_html__( 'Manage your site’s lightbox settings in the %1$sLightbox panel%2$s.', 'kariez-core' ),
					'<a href="javascript: $e.run( \'panel/global/open\' ).then( () => $e.route( \'panel/global/settings-lightbox\' ) )">',
					'</a>'
				),
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'kariez-core' ),
					'no' => esc_html__( 'No', 'kariez-core' ),
				],
				'condition' => [
					'gallery_link' => 'file',
				],
			]
		);

		$this->add_control(
			'gallery_masonry',
			[
				'label' => esc_html__( 'Gallery Item', 'kariez-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'kariez-core' ),
					'rt-masonry-grid' => esc_html__( 'Masonry', 'kariez-core' ),
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

		// Image style

		$this->start_controls_section(
			'section_gallery_images',
			[
				'label' => esc_html__( 'Images', 'kariez-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .rt-gallery-item img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'kariez-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rt-gallery-item .image-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'blend',
				'selector' => '{{WRAPPER}} .rt-gallery-item img',
			]
		);

		$this->end_controls_section();

		// caption style

		$this->start_controls_section(
			'section_caption',
			[
				'label' => esc_html__( 'Caption', 'kariez-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'kariez-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'kariez-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'kariez-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'kariez-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'kariez-core' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .rt-gallery-item .rt-gallery-caption' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'kariez-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-gallery-item .rt-gallery-caption' => 'color: {{VALUE}};',
				],
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .rt-gallery-item .rt-gallery-caption',
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_shadow',
				'selector' => '{{WRAPPER}} .rt-gallery-item .rt-gallery-caption',
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->add_responsive_control(
			'caption_space',
			[
				'label' => esc_html__( 'Spacing', 'kariez-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rt-gallery-item .rt-gallery-caption' => 'margin-block-start: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'kariez-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_display',
			[
				'label'        => __( 'Icon Display', 'kariez-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'kariez-core' ),
				'label_off'    => __( 'Hide', 'kariez-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'            => __( 'Choose Icon', 'kariez-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-plus',
					'library' => 'solid',
				],
				'condition'   => [
					'icon_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'kariez-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-gallery-item .image-link i' => 'font-size: {{VALUE}}px;',
				],
				'condition' => [
					'icon_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'kariez-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-gallery-item .image-link i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'icon_display' => 'yes',
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
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'kariez-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
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
		Fns::get_template( "elementor/image-gallery/$template", $data );
	}
}
