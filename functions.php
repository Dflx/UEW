<?php 

if(! function_exists( 'prowordpress_setup' ) ):
	function prowordpress_setup() {
		add_theme_support('automatic-feed-llinks');
		add_theme_support('post-thumbnails'); 
	}
endif;
add_action('after_setup_theme', 'prowordpress_setup');

/*
*Enque scripts and styles
*/
function prowordPress_scripts_and_styles() {
	wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'prowordpress_scripts_and_styles');



//DEVELOPER FUNCTIONS



function which_page() {
	if(is_page('projects')) {
		return get_permalink($real_projects->ID);
	
	} else if(is_page('process')) {
		return get_permalink($real_process->ID);
		
	} else if(is_page('team')) {
		return get_permalink($real_team->ID);
		
	} else if(is_page('philosophy')) {
		return get_permalink($real_philosophy->ID);
		
	} else if(is_page('contact')) {
		return get_permalink($real_contact->ID);
		
	} else { 
		return '?';
	};
};

function custom_tag($tag_name, $input) {
	if($tag_name == 'title') {
		preg_match_all("/&lt;title&gt;.*&lt;\/title&gt;/", $input, $matches); 
  		return substr( $matches[0][0], 13, (strlen($matches[0][0]) - 27) );
  		
  	} else if($tag_name == 'chinese-title') {
  		preg_match_all("/&lt;chinese-title&gt;(?s).*&lt;\/chinese-title&gt;/", $input, $matches);
		return substr( $matches[0][0], 21, (strlen($matches[0][0]) - 43) );	
  		
  	} else if($tag_name == 'subtitle') {
  		preg_match_all("/&lt;subtitle&gt;(?s).*&lt;\/subtitle&gt;/", $input, $matches);
		return substr( $matches[0][0], 16, (strlen($matches[0][0]) - 33) );
		
	} else if($tag_name == 'chinese-subtitle') {
  		preg_match_all("/&lt;chinese-subtitle&gt;(?s).*&lt;\/chinese-subtitle&gt;/", $input, $matches);
		return substr( $matches[0][0], 24, (strlen($matches[0][0]) - 49) );
	
	} else if($tag_name == "english") {
		preg_match_all("/&lt;english&gt;(?s).*&lt;\/english&gt;/", $input, $matches);
		return substr( $matches[0][0], 15, (strlen($matches[0][0]) - 31) );
		
	} else if($tag_name == "chinese") {
   	preg_match_all("/&lt;chinese&gt;(?s).*&lt;\/chinese&gt;/", $input, $matches);
		return substr( $matches[0][0], 15, (strlen($matches[0][0]) - 31) );
		
	} else if($tag_name == "misc") {
   	preg_match_all("/&lt;misc&gt;(?s).*&lt;\/misc&gt;/", $input, $matches);
		return substr( $matches[0][0], 12, (strlen($matches[0][0]) - 25) );
		
	} else if($tag_name =='chinese-misc') {
  		preg_match_all("/&lt;chinese-misc&gt;(?s).*&lt;\/chinese-misc&gt;/", $input, $matches);
		return substr( $matches[0][0], 24, (strlen($matches[0][0]) - 49) );
  	
  	} else if($tag_name == "degree") {
  		preg_match_all("/&lt;degree&gt;.*&lt;\/degree&gt;/", $input, $matches);
  		return substr( $matches[0][0], 14, (strlen($matches[0][0]) - 29) );
  		
  	} else if($tag_name == "chinese-degree") {
  		preg_match_all("/&lt;chinese-degree&gt;.*&lt;\/chinese-degree&gt;/", $input, $matches);
  		return substr( $matches[0][0], 22, (strlen($matches[0][0]) - 45) );
  	};
};


/*
*USED TO PULL THE IMAGE SOURCE FROM THE POST CONTENT ON index.php
*/
function catch_image($content) {
	global $post, $posts;
   $first_img = '';
   $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
   $first_img = $matches[1][0];
   if(empty($first_img)) {
   	$first_img="/images/default.jpg"; //PROVIDE DEFAULT IMAGE!
   }
   return $first_img;
};


//CUSTOM POST TYPES
add_action('init', 'new_post_types');

function new_post_types() {
register_post_type('uew_projects',
	array(
		'labels' => array(
			'name' 						=> 'Projects',
			'singular_name' 			=> 'Project',
			'add_new' 					=> 'Add New',
			'add_new_item' 			=> 'Add New Project',
			'edit_item' 				=> 'Edit Project',
			'new_item' 					=> 'New Project',
			'all_items' 				=> 'All Projects',
			'view_item' 				=> 'View Projects',
			'search_items' 			=> 'Search Projects',
			'not_found' 				=> 'No Projects found',
			'not_found_in_trash' 	=> 'No Projects found in trash',
			'parent_item_colon' 		=> '-',
			'menu_name'					=> 'Projects',
		),
		
		'description' 				=>'',
		'exclude_from_search'	=> false,
		'public' 					=> true,
		'publicly_queryable'		=> true,
		'show_in_ui'				=> true,
		'show_in_nav_menus'		=> true,
		'show_in_menu'				=> true,
		'show_in_admin_bar'		=> true,
		'query_var'					=> true,
		'rewrite'					=> array( 'slug' => 'projects' ),
		'capability_type' 		=> 'page',
		'menue_icon' 				=> '',		
		'has_archive' 				=> false,
		'hierarchical' 			=> true,
		'menu_position'			=> 5,
		'supports'					=> array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'post-formats'),
		'can_export'				=> true,
	)
);

register_post_type('uew_home_images',
	array(
		'labels' => array(
			'name' 						=> 'Home Images',
			'singular_name' 			=> 'Home Image',
			'add_new' 					=> 'Add New',
			'add_new_item' 			=> 'Add New Home Image',
			'edit_item' 				=> 'Edit Home Image',
			'new_item' 					=> 'New Home Image',
			'all_items' 				=> 'All Home Images',
			'view_item' 				=> 'View Home Images',
			'search_items' 			=> 'Search Home Images',
			'not_found' 				=> 'No Home Images found',
			'not_found_in_trash' 	=> 'No Home Images found in trash',
			'parent_item_colon' 		=> '-',
			'menu_name'					=> 'Home Images',
		),
		
		'description' 				=>'',
		'exclude_from_search'	=> false,
		'public' 					=> true,
		'publicly_queryable'		=> true,
		'show_in_ui'				=> true,
		'show_in_nav_menus'		=> true,
		'show_in_menu'				=> true,
		'show_in_admin_bar'		=> true,
		'query_var'					=> true,
		'rewrite'					=> array( 'slug' => 'home-images' ),
		'capability_type' 		=> 'post',
		'menue_icon' 				=> '',		
		'has_archive' 				=> false,
		'hierarchical' 			=> false,
		'menu_position'			=> 5,
		'supports'					=> array('title', 'editor', 'page-attributes',),
		'can_export'				=> true,
	)
);

register_post_type('uew_team_members',
	array(
		'labels' => array(
			'name' 						=> 'Team Members',
			'singular_name' 			=> 'Team Member',
			'add_new' 					=> 'Add New',
			'add_new_item' 			=> 'Add New Team Member',
			'edit_item' 				=> 'Edit Team Member',
			'new_item' 					=> 'New Team Member',
			'all_items' 				=> 'All Team Membmers',
			'view_item' 				=> 'View Team Members',
			'search_items' 			=> 'Search Team Members',
			'not_found' 				=> 'No Team Members found',
			'not_found_in_trash' 	=> 'No Team Members found in trash',
			'parent_item_colon' 		=> '-',
			'menu_name'					=> 'Team Members',
		),
		
		'description' 				=>'',
		'exclude_from_search'	=> false,
		'public' 					=> true,
		'publicly_queryable'		=> true,
		'show_in_ui'				=> true,
		'show_in_nav_menus'		=> true,
		'show_in_menu'				=> true,
		'show_in_admin_bar'		=> true,
		'query_var'					=> true,
		'rewrite'					=> array( 'slug' => 'team-members' ),
		'capability_type' 		=> 'page',
		'menue_icon' 				=> '',		
		'has_archive' 				=> false,
		'hierarchical' 			=> false,
		'menu_position'			=> 5,
		'supports'					=> array('title', 'editor', 'thumbnail', 'page-attributes', 'post-formats'),
		'can_export'				=> true,
	)
);
};

