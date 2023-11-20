<?php 
return [
	'advanced_settings'=> array(
	    'type'=> 'group',
	    'heading'=> 'Advanced Settings',
	    'description' => 'Can be use as shortcode or function name',
	    'options'=> array(	    	
	    	'search' => [
				'type' =>'textfield',
				'heading' => 'Search',
				'default' => '',
			],
			'replace' => [
				'type' =>'textfield',
				'heading' => 'Replace',
				'default' => '',
			],
			'$content' => [
				'heading' => 'Template',
				'type' =>'text-editor',
				'full_width' => false,
				'height'     => '100px',
				'tinymce'    => false,
				"description" => "[ux_image id=\"XXX\"]"
			],
			'class' => [
				'type' =>'textfield',
				'heading' => 'Class',
				'default' => '',
				'placeholder' => "",				
			],
			'css' => [
				'type' =>'textarea',
				'heading' => 'CSS',
				'default' => '',
				'placeholder' => "",				
			],
	    )
	)
];

