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


	        'before' => [
				'type' =>'textarea',
				'heading' => 'Before',
				'default' => '',
				'placeholder' => "{shortcode attr='",
				"description" => "Make output like a shortcode? Use { and ' instead of [ and \" "
			],
			'after' => [
				'type' =>'textfield',
				'heading' => 'After',
				'default' => '',
				'placeholder' => "'}",
				"description" => "Don't forget close tag."
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

