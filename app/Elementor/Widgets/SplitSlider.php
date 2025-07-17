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

class SplitSlider extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT SplitSlider', 'kariez-core' );
		$this->rt_base = 'rt-split-slider';
		parent::__construct( $data, $args );
	}


	private function rt_load_scripts() {
		wp_enqueue_style( 'rt-multiscroll-min' );
		wp_enqueue_script( 'rt-multi-scroll' );
		wp_enqueue_script( 'rt-ease' );
	}


	public function get_post_template( $type = 'page' ) {
		$posts     = get_posts(
			array(
				'post_type'      => 'elementor_library',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
			)
		);
		$templates = array();
		foreach ( $posts as $post ) {
			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $templates;
	}

	public function get_saved_data( $type = 'section' ) {
		$saved_widgets  = $this->get_post_template( $type );
		$options[ - 1 ] = __( 'Select', 'kariez-core' );
		if ( count( $saved_widgets ) ) {
			foreach ( $saved_widgets as $saved_row ) {
				$options[ $saved_row['id'] ] = $saved_row['name'];
			}
		} else {
			$options['no_template'] = __( 'It seems that, you have not saved any template yet.', 'kariez-core' );
		}

		return $options;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_split_section',
			[
				'label' => esc_html__( 'Rt SplitSlider', 'kariez-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_content',
			array(
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Select Template', 'kariez-core' ),
				'options' => $this->get_saved_data( 'section' ),
				'default' => 'key',
			)
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


		$this->add_control(
			'items',
			[
				'label'       => __( 'List', 'kariez-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[

						'title' => __( 'Moving Your Products Across All Borders. ', 'kariez-core' ),

					],

				],
				'title_field' => '{{{ name }}}',
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		$this->rt_load_scripts();
		Fns::get_template( "elementor/split-slider/$template", $data );
	}
}