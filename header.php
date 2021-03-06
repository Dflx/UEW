<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('', true, 'right'); ?></title>
<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/style.css"; ?>>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="container">	


	<div id="header"> 

   		<ul id="navigation">
   


<?php
if(is_page('projects')) {
	$the_page = 'projects';
};

if(is_page('process')) {
	$the_page = 'process';
}; 

if(is_page('team')) {
	$the_page = 'team';
}

if(is_page('philosophy')) {
	$the_page = 'philosophy';
}

if(is_page('contact')) {
	$the_page = 'contact';
}
?>

<?php
/*
*THIS SETS THE QUERIES AND VARIABLES USED TO
*PRINT BOTH THE ENGLISH AND CHINESE TOOLBARS
*/
$query_all_pages = array( 
	'sort_order' => 'DESC',
	'post_type' => 'page',
);



$query_all_projects = array(
	'post_type'			=> 'uew_projects',
	'hierarchical'		=> 1,
	'sort_order'		=> 'ASC',
	'sort_column' 		=> 'menu_order',
	'post_status' 		=> 'publish'
);		

$query_all_processes = array(
		'category_name' => 'process',
		'orderby' => 'post_date',
		'numberposts' => -1,
		'exclude' => 'home-images',
		'order' => 'ASC',
);

	
//SET TRUE PAGE ID's FOR CONSITENT LINKING (Regardless of language)
$all_pages = get_pages($query_all_pages);

foreach($all_pages as $page) {
	if($page->post_title == "Projects" || $page->post_title == "projects") {
		$real_projects = $page;
	};
		
	if($page->post_title == "Team" || $page->post_title == "team") {
		$real_team = $page;
	};
		
	if($page->post_title == "Process" || $page->post_title == "process") {
		$real_process = $page;
	};
		
	if($page->post_title == "Philosophy" || $page->post_title == "philosophy") {
		$real_philosophy = $page;
	};
		
	if($page->post_title == "Contact" || $page->post_title == "contact") {
		$real_contact = $page;
	};
};


//SET ENGLISH PAGE ID
foreach($all_pages as $page) {
	if($page->post_title == "English" || $page->post_title == "english") {
		$english_page_id = $page->ID;
	};
};

//SET CHINESE PAGE ID
foreach($all_pages as $page) {
	if($page->post_title == "Chinese" || $page->post_title == "chinese") {
		$chinese_page_id = $page->ID;
	};
};

//SET PROCESS PAGE ID
$process_pages = get_pages($query_all_pages);
foreach($process_pages as $a_page) {
   if($a_page->post_title == "process" || $a_page->post_title == "Process") {
   	$process_page_id = $a_page->ID;
   };
};

//SET PROJECT PAGE ID
$project_pages = get_pages($query_all_pages);
foreach($project_pages as $a_page) {
   if($a_page->post_title == "project" || $a_page->post_title == "Project") {
   	$project_page_id = $a_page->ID;
   };
};

$query_english_pages = array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'post_type' => 'page',
	'child_of' => $english_page_id,
	'exclude' => $english_page_id,
	'exclude_tree' => $chinese_page_id,
);	

$query_chinese_pages = array(
	'sort_order' => 'DESC',
	'post_type' => 'page',
	'child_of' => $chinese_page_id,
	'exclude' => $chinese_page_id,
	'exclude_tree' => $english_page_id,
);	
		
$processes = get_posts($query_all_processes);
$projects = get_pages($query_all_projects);
$english_pages = get_pages($query_english_pages);
$chinese_pages = get_pages($query_chinese_pages);

function get_chinese_title($type, $post) {
	if($type == "page") { return custom_tag('title', $post->post_content);} 
	else if($type == "post") { return custom_tag('chinese-title', $post->post_content); };
 };
?>		


<?php
if($_SESSION['language'] == 'Chinese') {

/*
*PRINT CHINESE TOOLBAR
*/
foreach($chinese_pages as $page) {
	echo '<li class="page_item page-item-' .$page->ID. '">';
	
	if($page->post_title == "Projects-Chinese" || $page->post_title == "projects-chinese") {
		echo '<a id="page' . $real_projects->ID . '" onclick="dropProjects(\'page' .$real_projects->ID. '\');" style="cursor: pointer;">' . get_chinese_title('page', $page);
		echo '</a></li>';
		$project_button_id = 'page' . $real_projects->ID;
		
	} else if($page->post_title == "Process-Chinese" || $page->post_title == "process-chinese") {
		echo '<a id="page' . $real_process->ID . '" onclick="dropProcess(\'page' .$real_process->ID. '\');" style="cursor: pointer;">' . get_chinese_title('page', $page);
		echo '</a></li>';
		$process_button_id = 'page' . $real_process->ID;
		
	} else if($page->post_title == "Team-Chinese" || $page->post_title == "team-chinese") {
		echo '<a id="page' . $real_team->ID . '" href="' . get_permalink($real_team->ID) . '&language=' . $_GET['language'] . '">' . get_chinese_title('page', $page);
		echo '</a></li>';
		$team_button_id = 'page' . $real_team->ID;
		
	} else if($page->post_title == "Philosophy-Chinese" || $page->post_title =="philosophy-chinese") {
		echo '<a id="page' . $real_philosophy->ID . '" href="' . get_permalink($real_philosophy->ID) . '&language=' . $_GET['language'] . '">' . get_chinese_title('page', $page);
		echo '</a></li>';
		$philosophy_button_id = 'page' . $real_philosophy->ID;
		
	} else if($page->post_title == "Contact-Chinese" || $page->post_title == "contact-chinese") {
		echo '<a id="page' . $real_contact->ID . '" href="' . get_permalink($real_contact->ID) . '&language=' . $_GET['language'] . '">' . get_chinese_title('page', $page);
		echo '</a></li>';
		$contact_button_id = 'page' . $real_contact->ID;
	}		
}; 

} else {
	if(!isset($_SESSION['language'])) { $_SESSION['language'] = 'English'; };

/*
*PRINT ENGLISH TOOLBAR
*/
foreach($english_pages as $page) {
	echo '<li class="page_item page-item-' .$page->ID. '">';
	
	if($page->post_title == "Projects" || $page->post_title == "projects") {
		echo '<a id="page' . $page->ID . '" onclick="dropProjects(\'page' .$page->ID. '\', \'' . $the_page . '\');" style="cursor: pointer;">' . $page->post_title;
		echo '</a></li>';
		$project_button_id = 'page' . $page->ID;
		
	} else if($page->post_title == "Process" || $page->post_title == "process") {
		echo '<a id="page' . $page->ID . '" onclick="dropProcess(\'page' .$page->ID. '\', \'' . $the_page . '\');" style="cursor: pointer;">' . $page->post_title;
		echo '</a></li>';
		$process_button_id = 'page' . $page->ID;
		
	} else if($page->post_title == "Team" || $page->post_title == "team") {
		echo '<a id="page' . $page->ID . '" href="' . get_permalink($page) . '&language=' . $_GET['language'] . '">' . $page->post_title;
		echo '</a></li>';
		$team_button_id = 'page' . $page->ID;
		
	} else if($page->post_title == "Philosophy" || $page->post_title =="philosophy") {
		echo '<a id="page' . $page->ID . '" href="' . get_permalink($page) . '&language=' . $_GET['language'] . '">' . $page->post_title;
		echo '</a></li>';
		$philosophy_button_id = 'page' . $page->ID;
		
	} else if($page->post_title == "Contact" || $page->post_title == "contact") {
		echo '<a id="page' . $page->ID . '" href="' . get_permalink($page) . '&language=' . $_GET['language'] . '">' . $page->post_title;
		echo '</a></li>';
		$contact_button_id = 'page' . $page->ID;
	}		 	 
}; };
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
/*
*PRINT PROJECT DROP DOWN TOOLBAR
*/

/*
$the_projects = array();

//create an array of parent pages (projects)
foreach($projects as $post) {
	if($post->post_parent) { continue; };
	$the_projects[] = array($post,);
};



$project_number = 0; 
/*
*muliti-dimensional array; the_projects[year][title,title,title...]


for($i = 0, $j = (date('Y') - 2012); $i <= $j; $i++) { //2012 == first post year
	$years = new WP_Query( array( 'post_type' => 'uew_projects', 'year' => (2012 + $i), 'post_parent' => 0, 'order' => 'ASC',));
	if($years->have_posts() ) {
			$counter = 0;
			$the_projects[2012 + $i] = array();
			
			while( $years->have_posts() ) {
				$years->the_post();
				
				if($_SESSION['language'] == 'Chinese') {
					$the_projects[2012 + $i][] = custom_tag('chinese-title', get_the_content());
				} else {
					$the_projects[2012 + $i][] = get_the_title();
				};
			};
	};
};


//$to_print = 0;
for($i = 0, $j = (date('Y') - 2012); $i <= $j; $i++) { //loop through $the_projects[years]
	
		for($c = 0; $c < count($the_projects[(2012 + $i)]); $c++ ) {
			echo '<li class="projectNavLink">';
			echo '<a href="' . get_permalink($real_projects->ID) . '&project=' . $project_number++ . '&language=' . $_GET['language'];
			if(is_page($real_projects->ID) && ($project_number - 1) == $_GET['project']) { echo '" style="color: cyan';};
			echo '">';
			

			echo $the_projects[(2012 + $i)][$c];
			echo '</a></li>';
			$last_year = 2012 + $i;
			$last_project = $c;
		};
}; 
?>
*/
	
//create an array of parent pages (projects)

foreach($projects as $post) {
	if($post->post_parent) { continue; };
	$the_projects[] = $post;
}

$project_number = 0;
for($i=0; $i < count($the_projects); $i++) {
		echo '<li class="projectNavLink">';
		echo '<a href="' . get_permalink($real_projects->ID) . '&project=' . $project_number++ . '&language=' . $_GET['language'];
		if(is_page($real_projects->ID) && ($project_number - 1) == $_GET['project']) { echo '" style="color: cyan';};
		echo '">';
			
		if($_SESSION['language'] == 'Chinese') {
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
/*
*PRINT PROCESS DROP DOWN TOOLBAR
*/
$slide_number = 0; 
foreach($processes as $post) {
   echo '<li id="">';
   	echo '<a href="' . get_permalink($process_page_id) . '&slide=' . ++$slide_number . '&language=' . $_GET['language'];
   	if(is_page($process_page_id) && $slide_number == $_GET['slide']) { echo '" style="color: cyan';};
   	
	if($_SESSION['language'] == 'Chinese') {
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
/*
*COLOR THE TOOLBAR LINK CYAN WHEN ON THAT PAGE
*/
if(is_page('projects')) {
	echo '<script> dropProjects("' .$project_button_id. '", "projects"); </script>';
};

if(is_page('process')) {
	echo '<script> dropProcess("' .$process_button_id. '", "process"); </script>';
}; 

if(is_page('team')) {
	echo '<script> document.getElementById("' . $team_button_id . '").style.color = "cyan"; </script>';
}

if(is_page('philosophy')) {
	echo '<script> document.getElementById("' . $philosophy_button_id . '").style.color = "cyan"; </script>';
}

if(is_page('contact')) {
	echo '<script> document.getElementById("' . $contact_button_id . '").style.color = "cyan"; </script>';
}
?>



<div id="content" class="slider">
	