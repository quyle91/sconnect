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
			'template' => [
				'type' =>'textarea',
				'heading' => 'Template',
				'default' => '',
				'placeholder' => "",
				"description" => "Make output like a shortcode? Use { and ' instead of [ and \" "
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

