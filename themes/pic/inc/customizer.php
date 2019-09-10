<?php
/**
 * weedgets Theme Customizer
 *
 * @package pic
 */

add_action('customize_register', function($wp_customize){

	/**
	 * Updating Settings type
	 * @var string
	 */

	$transport = 'refresh';


	/**
	 * Init customize data
	 */

	$customize_data = array(
		'transport' => 'refresh',
		'sections' => array(
			'pic_settings' => array(
				'panel' => '',
				'title' => __( 'Extra Site Settings', 'pic' ),
				'priority' => 50,
				'settings' => array(
					// Mail
					'pic_mail' => array(
						'label' => __( 'E-mail', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Phone
					'pic_tel' => array(
						'label' => __( 'Phone', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Address
					'pic_addr' => array(
						'label' => __( 'Address', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Copyrights
					'pic_cr' => array(
						'label' => __( 'Copyrights', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Years
					'pic_y' => array(
						'label' => __( 'Years', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Checkbox ad
					'pic_ad_show' => array(
						'label' => __( 'Enable Advertisement and Analytics Code?', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'checkbox',
					),

					// Analytics
					'pic_ac' => array(
						'label' => __( 'Analytics Code', 'pic' ),
						'default_content' => '',
						'setting_type' => 'option',
						'control_type' => 'textarea',
					),
				),
			),
		),
	);


	/**
	 * Create customize options
	 */

	foreach ($customize_data['sections'] as $section_name => $section) {

		/**
		 * Add settings and controls
		 */

		foreach ($section['settings'] as $setting_name => $setting) {
			$wp_customize->add_setting(
				$setting_name,
				array(
					'type'      => $setting['setting_type'],
					'default'   => $setting['default_content'],
					'transport' => $customize_data['transport'],
				)
			);

			$wp_customize->add_control(
				$setting_name,
				array(
					'section' => $section_name,
					'label' => $setting['label'],
					'type' => $setting['control_type'],
				)
			);
		}

		/**
		 * Add sections
		 */

		$wp_customize->add_section(
			$section_name,
			array(
				'panel' => $section['panel'],
				'title' => $section['title'],
				'priority' => $section['priority'],
			)
		);
	}
});
