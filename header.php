<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/style.css"; ?>>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="container">	


	<div id="header"> 

   		<ul id="navigation">


<?php
/* ****************************************************************************
 *The first section of this file sets up a bunch of variables, and queries,   * 
 *to make the theme more flexible.															*
 *																										*
 *The workflow goes something like:															* 
 *	1.get the current page (36) 																*
 *	2.set up the queries (59) 																	*
 *	3.separate the main pages (by ID) into variables (100)							*
 *	4.set the (english|chinese|project|process)_page_id (129)						* 
 *	5.print the toolbar (177)																	*
 *	6.print the dropdown toolbars	(292)														*
 ******************************************************************************
*/

if( is_page('projects') ) {
	$the_page = 'projects';
};

if( is_page('process') ) {
	$the_page = 'process';
}; 

if( is_page('team') ) {
	$the_page = 'team';
}

if( is_page('philosophy') ) {
	$the_page = 'philosophy';
}

if(  is_page('contact') ) {
	$the_page = 'contact';
}
?>

<?php

$all_pages = get_pages( array( 
	'sort_order' 	=> 'DESC',
	'post_type' 	=> 'page',
) );



$all_projects = get_pages( array(
	'post_type'			=> 'uew_projects',
	'hierarchical'		=> 1,
	'sort_order'		=> 'ASC',
	'sort_column' 		=> 'menu_order',
	'post_status' 		=> 'publish'
) );	

$all_processes = get_pages( array(
		'category_name' 	=> 'process',
		'orderby' 			=> 'post_date',
		'numberposts' 		=> -1,
		'exclude' 			=> 'home-images',
		'order' 				=> 'ASC',
) );

$processes = get_posts( array(
		'category_name'	=> 'process',
		'orderby' 			=> 'post_date',
		'numberposts' 		=> -1,
		'exclude' 			=> 'home-images',
		'order' 				=> 'ASC',
) );


$projects = get_pages( array(
	'post_type'			=> 'uew_projects',
	'hierarchical'		=> 1,
	'sort_order'		=> 'ASC',
	'sort_column' 		=> 'menu_order',
	'post_status' 		=> 'publish',
) );


foreach( $all_pages as $page ) { 

	switch( strtolower($page->post_title) ) {
		case "projects":
			$real_projects = $page;
			break;
		case "team":
			$real_team = $page;
			break;
		case "process":
			$real_process = $page;
			break;
		case "philosophy":
			$real_philosophy = $page;
			break;
		case "contact":
			$real_contact = $page;
			break;
	};
};

/*
*The toolbar items are printed using page titles.
*Every item on the toolbar is a child of either the "English" or "Chinese" page
*This was done to make switching languages easier.
*
*Here, we get the ID of the English and Chinese page. 
*Also, the ID of the Project and Process page
*/
foreach( $all_pages as $page ) {
	switch( strtolower($page->post_title) ) {
		case "english":
			$english_page_id = $page->ID;
			break;
		case "chinese":
			$chinese_page_id = $page->ID;
			break;
		case "process":
			$process_page_id = $page->ID;
			break;
		case "project":
			$project_page_id = $page->ID;
			break;
		};
};
?>		


<?php
if( $_SESSION['language'] == 'Chinese' ) {

	$chinese_pages = get_pages( array(
	'sort_order' => 'DESC',
	'post_type' => 'page',
	'child_of' => $chinese_page_id,
	'exclude' => $chinese_page_id,
	'exclude_tree' => $english_page_id,
) ); 

} else {

	$english_pages = get_pages( array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'post_type' => 'page',
	'child_of' => $english_page_id,
	'exclude' => $english_page_id,
	'exclude_tree' => $chinese_page_id,
) );
};


function get_chinese_title( $type, $post ) {
	if( $type == "page" ) { return custom_tag( 'title', $post->post_content ); } 
	else if( $type == "post" ) { return custom_tag( 'chinese-title', $post->post_content ); };
};
 
if( $_SESSION['language'] == 'Chinese' ) {

	//PRINT CHINESE TOOLBAR
	foreach( $chinese_pages as $page ) {
		echo '<li class="page_item page-item-' .$page->ID. '">';
		
		switch( strtolower($page->post_title) ) {
			case "projects-chinese":
				echo '<a id="page' . $real_projects->ID . '" onclick="dropProjects(\'page' .$real_projects->ID. '\');" style="cursor: pointer;">' . get_chinese_title('page', $page);
				echo '</a></li>';
				$project_button_id = 'page' . $real_projects->ID;
				break;
				
			case "team-chinese":
				echo '<a id="page' . $real_team->ID . '" href="' . get_permalink($real_team->ID) . '&language=' . $_GET['language'] . '">' . get_chinese_title('page', $page);
				echo '</a></li>';
				$team_button_id = 'page' . $real_team->ID;
				break;
				
			case "process-chinese":
				echo '<a id="page' . $real_process->ID . '" onclick="dropProcess(\'page' .$real_process->ID. '\');" style="cursor: pointer;">' . get_chinese_title('page', $page);
				echo '</a></li>';
				$process_button_id = 'page' . $real_process->ID;
				break;
				
			case "philosophy-chinese":
				echo '<a id="page' . $real_philosophy->ID . '" href="' . get_permalink($real_philosophy->ID) . '&language=' . $_GET['language'] . '">' . get_chinese_title('page', $page);
				echo '</a></li>';
				$philosophy_button_id = 'page' . $real_philosophy->ID;
				break;
				
			case "contact-chinese":
				echo '<a id="page' . $real_contact->ID . '" href="' . get_permalink($real_contact->ID) . '&language=' . $_GET['language'] . '">' . get_chinese_title('page', $page);
				echo '</a></li>';
				$contact_button_id = 'page' . $real_contact->ID;
				break; 
		};		
	}; 

} else {
	
	if(! isset($_SESSION['language']) ) { $_SESSION['language'] = 'English'; };
	
	//PRINT ENGLISH TOOLBAR
	foreach( $english_pages as $page ) {
		echo '<li class="page_item page-item-' .$page->ID. '">';
		
		switch( strtolower($page->post_title) ) {
			case "projects":
				echo '<a id="page' . $page->ID . '" onclick="dropProjects(\'page' .$page->ID. '\', \'' . $the_page . '\');" style="cursor: pointer;">' . $page->post_title;
				echo '</a></li>';
				$project_button_id = 'page' . $page->ID;
				break;
				
			case "team":
				echo '<a id="page' . $page->ID . '" href="' . get_permalink($page) . '&language=' . $_GET['language'] . '">' . $page->post_title;
				echo '</a></li>';
				$team_button_id = 'page' . $page->ID;
				break;
				
			case "process":
				echo '<a id="page' . $page->ID . '" onclick="dropProcess(\'page' .$page->ID. '\', \'' . $the_page . '\');" style="cursor: pointer;">' . $page->post_title;
				echo '</a></li>';
				$process_button_id = 'page' . $page->ID;
				break;
				
			case "philosophy":
				echo '<a id="page' . $page->ID . '" href="' . get_permalink($page) . '&language=' . $_GET['language'] . '">' . $page->post_title;
				echo '</a></li>';
				$philosophy_button_id = 'page' . $page->ID;
				break;
				
			case "contact":
				echo '<a id="page' . $page->ID . '" href="' . get_permalink($page) . '&language=' . $_GET['language'] . '">' . $page->post_title;
				echo '</a></li>';
				$contact_button_id = 'page' . $page->ID;
				break; 
		};	 
	}; 
};
?>

<?php echo '<li id="English"><a href="' . which_page() . '&language=English' . '&project=' . $_GET['project'] .'">en</a></li>'; ?>
<?php echo '<li id="Chinese"><a href="' . which_page() . '&language=Chinese' . '&project=' . $_GET['project'] . '">cn</a></li>'; ?>
	
<?php
/*
*SCRIPT SETS THE COLOR OF THE CURRENT LANGUAGE PER PAGE
*/
 echo'<script>
var English = document.getElementById("English").children;
var Chinese = document.getElementById("Chinese").children;
var language = "' . $_SESSION['language'] . '";

if(language == "Chinese") {
	Chinese[0].style.color = "cyan";
} else if(language == "English") {
	English[0].style.color = "cyan";
};
</script>'
?>
   </ul> 
</div> 


<div id="secondaryNav">
		<h1 id="logo"><a href=" <?php echo home_url() . '?language=' . $_SESSION['language']; ?>" style="color: #FFFFFF">UEW</a></h1>				

<div id="secondaryNavWrapper">
<div id="toolbarDrop" class="dropNav">
	<ul id="nav2">
	
<?php 
//PRINT PROJECT DROP DOWN TOOLBAR
//create an array of parent pages (projects)
foreach( $projects as $post ) {
	if($post->post_parent) { continue; };
	$the_projects[] = $post;
}

$project_number = 0;
for( $i=0; $i < count($the_projects); $i++ ) {
		echo '<li class="projectNavLink">';
		echo '<a href="' . get_permalink($real_projects->ID) . '&project=' . $project_number++ . '&language=' . $_GET['language'];
		if( is_page($real_projects->ID) && ($project_number - 1 ) == $_GET['project']) { echo '" style="color: cyan';};
		echo '">';
			
		if( $_SESSION['language'] == 'Chinese' ) {
			echo custom_tag("chinese-title", $the_projects[$i]->post_content);
		} else { 
			echo $the_projects[$i]->post_title;
		};
		
		echo '</a></li>';
};
?>
	
		
	</ul> 

</div>
	<div id="processDrop" class="dropNav">
		<ul id="nav3">
		
<?php 
//PRINT PROCESS DROP DOWN TOOLBAR
$slide_number = 0; 
foreach( $processes as $post ) {
   echo '<li id="">';
   	echo '<a href="' . get_permalink($process_page_id) . '&slide=' . ++$slide_number . '&language=' . $_GET['language'];
   	if( is_page($process_page_id) && $slide_number == $_GET['slide'] ) { echo '" style="color: cyan';};
   	
	if( $_SESSION['language'] == 'Chinese' ) {
   	echo '">' . get_chinese_title('post', $post);
   } else {
   	echo '">' . $post->post_title;
   };
   echo '</a></li>';
};
?>
		
		</ul> 
		</div> 
	</div>
</div>


<script src="wp-content/themes/UEW/js/global.js"></script>

<?php
//COLOR THE TOOLBAR LINK CYAN WHEN ON THAT PAGE
if( is_page('projects') ) {
	echo '<script> dropProjects("' .$project_button_id. '", "projects"); </script>';
};

if( is_page('process') ) {
	echo '<script> dropProcess("' .$process_button_id. '", "process"); </script>';
}; 

if( is_page('team') ) {
	echo '<script> document.getElementById("' . $team_button_id . '").style.color = "cyan"; </script>';
}

if( is_page('philosophy') ) {
	echo '<script> document.getElementById("' . $philosophy_button_id . '").style.color = "cyan"; </script>';
}

if( is_page('contact') ) {
	echo '<script> document.getElementById("' . $contact_button_id . '").style.color = "cyan"; </script>';
}
?>



<div id="content" class="slider">
	