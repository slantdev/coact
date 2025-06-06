<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_67ef6f19a2341',
	'title' => 'Site Settings - Hello Bar',
	'fields' => array(
		array(
			'key' => 'field_67ef6f1a26ed8',
			'label' => 'Hello Bar',
			'name' => 'hello_bar',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'acfe_seamless_style' => 1,
			'sub_fields' => array(
				array(
					'key' => 'field_67ef6f5d26ed9',
					'label' => 'Set Active',
					'name' => 'set_active',
					'aria-label' => '',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui_on_text' => 'Active',
					'ui_off_text' => 'Inactive',
					'ui' => 1,
				),
				array(
					'key' => 'field_67ef6f8c26eda',
					'label' => 'Hello Bar Text',
					'name' => 'hello_bar_text',
					'aria-label' => '',
					'type' => 'group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'acfe_seamless_style' => 1,
					'sub_fields' => array(
						array(
							'key' => 'field_67ef6fa926edb',
							'label' => 'Message',
							'name' => 'message',
							'aria-label' => '',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'basic',
							'media_upload' => 0,
							'delay' => 0,
						),
						array(
							'key' => 'field_67ef6fdd26edd',
							'label' => 'Link',
							'name' => 'link',
							'aria-label' => '',
							'type' => 'link',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
						),
					),
					'acfe_group_modal' => 0,
					'acfe_group_modal_close' => 0,
					'acfe_group_modal_button' => '',
					'acfe_group_modal_size' => 'large',
				),
				array(
					'key' => 'field_67ef6ff826ede',
					'label' => 'Hello Bar Settings',
					'name' => 'hello_bar_settings',
					'aria-label' => '',
					'type' => 'group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'acfe_seamless_style' => 1,
					'sub_fields' => array(
						array(
							'key' => 'field_67ef6fff26edf',
							'label' => 'Closeable',
							'name' => 'closeable',
							'aria-label' => '',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '33.33',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui_on_text' => '',
							'ui_off_text' => '',
							'ui' => 1,
						),
						array(
							'key' => 'field_67ef702326ee0',
							'label' => 'Background Color',
							'name' => 'background_color',
							'aria-label' => '',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '33.33',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#B2519E',
							'enable_opacity' => 0,
							'return_format' => 'string',
						),
						array(
							'key' => 'field_67ef704b26ee1',
							'label' => 'Text Color',
							'name' => 'text_color',
							'aria-label' => '',
							'type' => 'color_picker',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '33.33',
								'class' => '',
								'id' => '',
							),
							'default_value' => '#FFFFFF',
							'enable_opacity' => 0,
							'return_format' => 'string',
						),
					),
					'acfe_group_modal' => 0,
					'acfe_group_modal_close' => 0,
					'acfe_group_modal_button' => '',
					'acfe_group_modal_size' => 'large',
				),
			),
			'acfe_group_modal' => 0,
			'acfe_group_modal_close' => 0,
			'acfe_group_modal_button' => '',
			'acfe_group_modal_size' => 'large',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => false,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => '',
	'acfe_autosync' => array(
		0 => 'php',
		1 => 'json',
	),
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
	'acfe_categories' => array(
		'site-settings' => 'Site Settings',
	),
	'modified' => 1744908866,
));

endif;