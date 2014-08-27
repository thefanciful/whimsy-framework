<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'whimsy'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'whimsy'),
		'two' => __('Two', 'whimsy'),
		'three' => __('Three', 'whimsy'),
		'four' => __('Four', 'whimsy'),
		'five' => __('Five', 'whimsy')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'whimsy'),
		'two' => __('Pancake', 'whimsy'),
		'three' => __('Omelette', 'whimsy'),
		'four' => __('Crepe', 'whimsy'),
		'five' => __('Waffle', 'whimsy')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	// Basic Settings
	$options[] = array(
		'name' => __('Basic Settings', 'whimsy'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Favicon', 'whimsy'),
		'desc' => __('This is the little graphic displayed by your title in tabs.', 'whimsy'),
		'id' => 'whimsy_favicon',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Google Analytics', 'whimsy'),
		'desc' => __('Copy and paste the code generated by Google Analytics here.', 'whimsy'),
		'id' => 'whimsy_analytics',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Twitter Handle', 'whimsy'),
		'desc' => __('Your Twitter username, without the @.', 'whimsy'),
		'id' => 'whimsy_twitter',
		'placeholder' => 'twitterhandle',
		'type' => 'text');
		
	// Content
	$options[] = array(
		'name' => __('Typography', 'whimsy'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Change your website text', 'whimsy'),
		'desc' => __('Pick new fonts and text colors and customize the way your text is displayed. ', 'whimsy'),
		'type' => 'info');

	$options[] = array( 'name' => __('Headline Text Style', 'whimsy'),
		'desc' => __('Example typography.', 'whimsy'),
		'id' => "whimsy_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );

	$options[] = array( 'name' => __('Body Text Style', 'whimsy'),
		'desc' => __('Example typography.', 'whimsy'),
		'id' => "whimsy_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );
		
	// Sidebar
	$options[] = array(
		'name' => __('Sidebar Display', 'whimsy'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Your Photo', 'whimsy'),
		'desc' => __('A picture of your smiling face. :)', 'whimsy'),
		'id' => 'whimsy_user_photo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Bio Blurb', 'whimsy'),
		'desc' => __('A short paragraph about you and/or your blog.', 'whimsy'),
		'id' => 'whimsy_analytics',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input with Placeholder', 'whimsy'),
		'desc' => __('A text input field with an HTML5 placeholder.', 'whimsy'),
		'id' => 'whimsy_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text');
		
	// Social
	$options[] = array(
		'name' => __('Social Media', 'whimsy'),
		'type' => 'heading');
		
	// Advanced
	$options[] = array(
		'name' => __('Advanced Settings', 'whimsy'),
		'type' => 'heading');
		
	// Test
	$options[] = array(
		'name' => __('All Options for Testing', 'whimsy'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Input Text Mini', 'whimsy'),
		'desc' => __('A mini text input field.', 'whimsy'),
		'id' => 'whimsy_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input Text', 'whimsy'),
		'desc' => __('A text input field.', 'whimsy'),
		'id' => 'whimsy_text',
		'std' => 'Default Value',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input with Placeholder', 'whimsy'),
		'desc' => __('A text input field with an HTML5 placeholder.', 'whimsy'),
		'id' => 'whimsy_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text');

	$options[] = array(
		'name' => __('Textarea', 'whimsy'),
		'desc' => __('Textarea description.', 'whimsy'),
		'id' => 'whimsy_textarea',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input Select Small', 'whimsy'),
		'desc' => __('Small Select Box.', 'whimsy'),
		'id' => 'whimsy_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'whimsy'),
		'desc' => __('A wider select box.', 'whimsy'),
		'id' => 'whimsy_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array);

	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select a Category', 'whimsy'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'whimsy'),
		'id' => 'whimsy_select_categories',
		'type' => 'select',
		'options' => $options_categories);
	}

	if ( $options_tags ) {
	$options[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'whimsy_select_tags',
		'type' => 'select',
		'options' => $options_tags);
	}

	$options[] = array(
		'name' => __('Select a Page', 'whimsy'),
		'desc' => __('Passed an pages with ID and post_title', 'whimsy'),
		'id' => 'whimsy_select_pages',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Input Radio (one)', 'whimsy'),
		'desc' => __('Radio select with default options "one".', 'whimsy'),
		'id' => 'whimsy_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Example Info', 'whimsy'),
		'desc' => __('This is just some example information you can put in the panel.', 'whimsy'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'whimsy'),
		'desc' => __('Example checkbox, defaults to true.', 'whimsy'),
		'id' => 'whimsy_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'whimsy'),
		'desc' => __('Click here and see what happens.', 'whimsy'),
		'id' => 'whimsy_showhidden',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Hidden Text Input', 'whimsy'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'whimsy'),
		'id' => 'whimsy_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'whimsy'),
		'desc' => __('This creates a full size uploader that previews the image.', 'whimsy'),
		'id' => 'whimsy_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "whimsy_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' =>  __('Example Background', 'whimsy'),
		'desc' => __('Change the background CSS.', 'whimsy'),
		'id' => 'whimsy_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'whimsy'),
		'desc' => __('Multicheck description.', 'whimsy'),
		'id' => 'whimsy_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);

	$options[] = array(
		'name' => __('Colorpicker', 'whimsy'),
		'desc' => __('No color selected by default.', 'whimsy'),
		'id' => 'whimsy_colorpicker',
		'std' => '',
		'type' => 'color' );

	$options[] = array( 'name' => __('Typography', 'whimsy'),
		'desc' => __('Example typography.', 'whimsy'),
		'id' => "whimsy_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );

	$options[] = array(
		'name' => __('Custom Typography', 'whimsy'),
		'desc' => __('Custom typography options.', 'whimsy'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Default Text Editor', 'whimsy'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'whimsy' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'whimsy_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	return $options;
}