<?php

namespace RT\KariezCore\Controllers;

use RT\Kariez\Helpers\Fns;
use \RT_Postmeta;
use RT\KariezCore\Traits\SingletonTraits;
use RT\KariezCore\Builder\Builder;
use RT\KariezCore\Helper\FnsBuilder;
use RT\KariezCore\Modules\IconList;

class PostMetaController {
	use SingletonTraits;

	public $postmeta;

	public function __construct() {
		$this->postmeta = RT_Postmeta::getInstance();
//		$this->add_meta_box();
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		$this->postmeta->add_meta_box(
			"rt_page_settings",
			__( 'Layout Settings', 'kariez-core' ),
			[ 'page', 'post', 'rt-team', 'rt-service', 'rt-project' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'kariez-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		//Post Info
		$this->postmeta->add_meta_box(
			"rt_post_info",
			__( 'Post Info', 'kariez-core' ),
			[ 'post' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_post_info_meta(),
			]
		);

		//Team meta
		$this->postmeta->add_meta_box(
			"rt_team_info",
			__( 'Team Info', 'kariez-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_info_meta(),
			]
		);
		$this->postmeta->add_meta_box(
			"rt_team_social",
			__( 'Team Social', 'kariez-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_social_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_skill",
			__( 'Team Skill', 'kariez-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_skill_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_qualification",
			__( 'Team Qualification', 'kariez-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_qualification_meta(),
			]
		);

        //service meta
        $this->postmeta->add_meta_box(
            "rt_service_icon",
            __( 'Service Icon', 'kariez-core' ),
            [ 'rt-service' ],
            '',
            '',
            'high',
            [
                'fields' => $this->get_service_icon_meta(),
            ]
        );

		//Project meta
		$this->postmeta->add_meta_box(
			"rt_project_info",
			__( 'Project Info', 'kariez-core' ),
			[ 'rt-project' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_project_info_meta(),
			]
		);

        //header footer build
		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'kariez-core' ),
			[ 'elementor-kariez' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			]
		);
	}

	function get_el_builder_meta_args() {
		return apply_filters( 'kariez_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'kariez-core' ),
					'header'  => __( 'Header', 'kariez-core' ),
					'footer'  => __( 'Footer', 'kariez-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'kariez-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'kariez-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'kariez-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'kariez_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'kariez-core' ),
					'full-width'    => __( 'Full Width', 'kariez-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'kariez-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'kariez-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'kariez-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'1'       => __( 'Layout 1', 'kariez-core' ),
					'2'       => __( 'Layout 2', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'kariez-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'on'      => __( 'ON', 'kariez-core' ),
					'off'     => __( 'OFF', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'topbar_style'      => [
				'label'   => __( 'Top Bar Style', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'1'       => __( 'Layout 1', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'box'     => __( 'Box Width', 'kariez-core' ),
					'full'    => __( 'Full Width', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'kariez-core' ),
					'menu-left'   => __( 'Left Alignment', 'kariez-core' ),
					'menu-center' => __( 'Center Alignment', 'kariez-core' ),
					'menu-right'  => __( 'Right Alignment', 'kariez-core' ),
				],
				'default' => 'default',
			],

			'tr_header'        => [
				'label'   => __( 'Transparent Header', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'on'      => __( 'ON', 'kariez-core' ),
					'off'     => __( 'OFF', 'kariez-core' ),
				],
				'default' => 'default',
			],

			'tr_header_color' => [
				'label'   => __( 'Transparent color', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default'   => __( 'Default from customizer', 'kariez-core' ),
					'tr-header-light'   => __( 'Light Color', 'kariez-core' ),
					'tr-header-dark'    => __( 'Dark Color', 'kariez-core' ),
				],
				'default' => 'default',
			],

			'banner'           => [
				'label'   => __( 'Banner Visibility', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'on'      => __( 'ON', 'kariez-core' ),
					'off'     => __( 'OFF', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb_title' => [
				'label'   => __( 'Banner Title', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'on'      => __( 'ON', 'kariez-core' ),
					'off'     => __( 'OFF', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'       => [
				'label'   => __( 'Banner Breadcrumb', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'on'      => __( 'ON', 'kariez-core' ),
					'off'     => __( 'OFF', 'kariez-core' ),
				],
				'default' => 'default',
			],

			'banner_image'    => [
				'type'  => 'image',
				'label' => __( 'Banner Background Image', 'kariez-core' ),
			],
			'banner_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Banner Background Color', 'kariez-core' ),
			],


			'footer_style'     => [
				'label'   => __( 'Footer Layout', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'kariez-core' ),
					'1'       => __( 'Layout 1', 'kariez-core' ),
					'2'       => __( 'Layout 2', 'kariez-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'    => [
				'label'   => __( 'Footer Schema', 'kariez-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'kariez-core' ),
					'footer-light' => __( 'Light Footer', 'kariez' ),
					'footer-dark'  => __( 'Dark Footer', 'kariez' ),
				],
				'default' => 'default',
			],
			'padding_top'    => [
				'label' => __( 'Padding Top (Page Content)', 'kariez-core' ),
				'type'  => 'number',
			],
			'padding_bottom'   => [
				'label' => __( 'Padding Bottom (Page Content)', 'kariez-core' ),
				'type'  => 'number',
			],
			'page_bg_image'    => [
				'type'  => 'image',
				'label' => __( 'Background Image', 'kariez-core' ),
			],
			'page_bg_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Background Color', 'kariez-core' ),
			],

		] );
	}

	function get_post_info_meta() {
		return apply_filters( 'rt_post_info', [
			'rt_youtube_link' => [
				'label'   => __( 'Youtube Link', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'rt_post_gallery' => [
				'label' => __( 'Post Gallery', 'kariez-core' ),
				'type'  => 'gallery',
				'desc'  => __( 'Only work for the gallery post format', 'kariez-core' ),
			],
		] );
	}

	//Team meta info
	function get_team_info_meta() {
		return apply_filters( 'rt_team_meta_field', [
			'rt_team_info_title' => array(
				'label' => __( 'Information Title', 'kariez-core' ),
				'type'  => 'text',
			),

			'rt_team_designation' => [
				'label'   => __( 'Team Designation', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_phone' => [
				'label'   => __( 'Team Phone', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_website' => [
				'label'   => __( 'Team Website', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_email' => [
				'label'   => __( 'Team Email', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_address' => [
				'label'   => __( 'Team Address', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

		] );
	}
	function get_team_social_meta() {
		return apply_filters( 'rt_team_meta_social', [
			'rt_team_socials' => array(
				'type'  => 'group',
				'value' => Fns::get_team_socials(),
			),
		] );
	}

	function get_team_skill_meta() {
		return apply_filters( 'rt_team_meta_skill', [
			'rt_team_skill_title' => array(
				'label' => __( 'Skill Title', 'kariez-core' ),
				'type'  => 'text',
			),

			'rt_team_skill_info' => [
				'label'   => __( 'Team Skill Info', 'kariez-core' ),
				'type'    => 'textarea',
			],

			'rt_team_skill' => [
				'type'  => 'repeater',
				'button' => __( 'Add New Skill', 'kariez-core' ),
				'value'  => [
					'skill_name' => [
						'label' => __( 'Skill Name', 'kariez-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. Marketing', 'kariez-core' ),
					],
					'skill_value' => [
						'label' => __( 'Skill Percentage (%)', 'kariez-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. 75', 'kariez-core' ),
					],
					'skill_color' => [
						'label' => __( 'Skill Color', 'kariez-core' ),
						'type'  => 'color_picker',
						'desc'  => __( 'If not selected, primary color will be used', 'kariez-core' ),
					],
				]
			],
		] );
	}

	function get_team_qualification_meta() {
		return apply_filters( 'rt_team_meta_qualification', [

            'rt_team_qualification_title' => array(
                'label' => __( 'Qualification Title', 'kariez-core' ),
                'type'  => 'text',
            ),

            'rt_team_qualification_label' => [
                'type'  => 'repeater',
                'button' => __( 'Add New Qualificaton', 'kariez-core' ),
                'value'  => [
                    'qualification_name' => [
                        'label' => __( 'Qualificaton Name', 'kariez-core' ),
                        'type'  => 'text',
                        'desc'  => __( 'eg. Leadership Development', 'kariez-core' ),
                    ],
                ]
            ],

		] );
	}

    // Service meta info

    function get_service_icon_meta() {
        return apply_filters( 'rt_service_meta_icon', [
            'rt_service_icon'    => [
                'label'   => __( 'Service Icon', 'kariez-core' ),
                'type'    => 'select',
                'options' => IconList::fontello_service(),
            ],
            'rt_service_color'    => [
	            'label'   => __( 'Service Color', 'kariez-core' ),
	            'type'  => 'color_picker',
            ],
        ] );
    }


	//Project meta info
	function get_project_info_meta() {
		return apply_filters( 'rt_project_meta_field', [
			'rt_project_title' => [
				'label'   => __( 'Info Title', 'kariez-core' ),
				'type'    => 'text',
				'default' => __( 'Project Info', 'kariez-core' ),
			],

			'rt_project_text' => [
				'label'   => __( 'Info Text', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],
            'rt_project_subtitle' => [
                'label'   => __( 'Subtitle Text', 'kariez-core' ),
                'type'    => 'text',
                'default' => '',
            ],

			'rt_project_client' => [
				'label'   => __( 'Client', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_start' => [
				'label'   => __( 'Starts On', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_end' => [
				'label'   => __( 'End On', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_weblink' => [
				'label'   => __( 'Weblink', 'kariez-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_rating' => [
				'label' => __( 'Select the Rating', 'kariez-core' ),
				'type'  => 'select',
				'options' => array(
					'-1' => __( 'Default', 'kariez-core' ),
					'1'    => '1',
					'2'    => '2',
					'3'    => '3',
					'4'    => '4',
					'5'    => '5'
				),
				'default'  => '-1',
			],

		] );
	}
}

