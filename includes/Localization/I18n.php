<?php

namespace AwesomeCoder\School\Localization;

class L18n
{
	/**
	 * Load the template text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_template_textdomain()
	{
		load_theme_textdomain(
			'school',
			false,
			SCHOOL_THEME_PATH . 'languages/'
		);
	}
}
