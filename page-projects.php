<?php 
session_start();
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language']; };
if(isset($_SESSION['language']) && $_SESSION['language'] != 'Chinese') { $_SESSION['language'] = 'English'; };
 ?>
 
<?php get_header(); ?>

<?php
/*
*Arrows and accompanying divs to scroll through the slideshow
*/
echo '<div id="arrowBox">';
echo '<div id="leftArrow" class="boxes" onclick="Slider.prev();"><div class="wrapper"><img class="arrowBoxButtons" src="' .get_template_directory_uri(). '/images/leftArrow.png" height="25px" width="25px" ></div></div> ';
echo '<div id="rightArrow" class="boxes" onclick="Slider.next();"><div class="wrapper"><img class="arrowBoxButtons" src="' .get_template_directory_uri(). '/images/rightArrow.png" height="25px" width="25px" ></div></div>';
echo '</div>';
?>


<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/projects.css"; ?>>



<?php
$query_all_projects = array(
	'post_type'			=> 'uew_projects',
	'hierarchical'		=> 0,
	'sort_order'		=> 'ASC',
	'sort_column' 		=> 'menu_order',
);
$projects = get_pages($query_all_projects);

$the_projects = array(); //holds project pages && thier children(pictures) a as multi-dimensional array


//create an array of parent pages (projects)
foreach($projects as $post) {
	if($post->post_parent) { continue; }; //skip the other parent pages
	$the_projects[] = array($post,);
};

//$the_projects[n][$wp_post, image, image, image...]
for($i = 0; $i < count($the_projects); $i++) {
	$args = array(
		'post_type'		=> 'uew_projects',
		'child_of' 		=> $the_projects[$i][0]->ID,
	);
	
	$images = get_pages($args);
	for($j = 0; $j < count($images); $j++) {
		array_push($the_projects[$i], $images[$j]);
	};
};
?>

<?php
/*
*Print the indicator boxes underneath the Project Page's pictues
*/
   echo '<div id="indicator">';
   for($i=0; $i < (count($the_projects[$_GET['project']]) - 1); $i++) {
   	echo '<div class="indicatorBoxes" onclick="Slider.gotoSlide(' . ( count($the_projects[$_GET['project']]) - ($i + 1) ) . ');"></div>';
   };
   echo '</div>';
?>


<div id="TextFrame">
<?php 
if($_GET['language'] == "Chinese") {
   	echo '<h2>'; 
   		echo custom_tag('chinese-title', $the_projects[$_GET['project']][0]->post_content);
   	echo '</h2>';
   
   	echo '<h5 id="projectSubtitle">';
   		echo custom_tag('chinese-subtitle', $the_projects[$_GET['project']][0]->post_content);
		echo '</h5>';
	
	
   echo '<div  id="descriptionCHN">';
   	echo custom_tag('chinese', $the_projects[$_GET['project']][0]->post_content);
    echo '</div>'; //descriptionCHN

   
   echo '<div id="miscInfo">';
   	echo custom_tag('chinese-misc', $the_projects[$_GET['project']][0]->post_content);
	echo '</div>'; //miscInfo
	
} else {

echo '<h2>' . $the_projects[$_GET['project']][0]->post_title . '</h2>';
   
   echo '<h5 id="projectSubtitle">';
   	echo custom_tag('subtitle', $the_projects[$_GET['project']][0]->post_content);
	echo '</h5>';
	
  
   echo '<div id="descriptionENG">';
   	echo custom_tag('english', $the_projects[$_GET['project']][0]->post_content);
	echo '</div>'; //descriptionENG

   
   echo '<div id="miscInfo">';
   	echo custom_tag('misc', $the_projects[$_GET['project']][0]->post_content);
	echo '</div>'; //miscInfo 
};

?>
</div>


<ul id="theSlider">
<?php 
/*
*print images to the slider
*/
for($i = 1; $i < count($the_projects[$_GET['project']]); $i++) {//stars at 1 because $the_projects[n][0] == WP_POST object
	if($the_projects[$_GET['project']][$i]->post_parent == $the_projects[$_GET['project']][0]->ID) {
		echo '<li><div class="projectImage">';
		echo  get_the_post_thumbnail($the_projects[$_GET['project']][$i]->ID, 'full');
		echo '</div></li>';
	};
}; 
?>
</ul>


<?php  
   
   //SETS THE SLIDER LENGTH DYNAMICALLY. OTHERWISE IMAGES WILL NOT BE INLINE
   echo '<script>';
   echo 'var theSlider = document.getElementById("theSlider");';
   echo 'theSlider.style.width = (702 * ' . (count($the_projects[$_GET['project']]) - 1) . ' + "px");';
   echo '</script>';

?>

<script src="wp-content/themes/UEW/js/slider.js"></script>

<script>
//setSlider(string[page], string[slider-Id default="theSlider"], int[slide size], float[max opacity], float[min opacity], int[offset])
Slider.setSlider("projects", "theSlider", 700, .3, .5, false, 260);
</script>

<?php
//JUMP TO SLIDE $_GET['slide']
if(isset($_GET['slide'])) {
	echo '<script> Slider.gotoSlide(' . $_GET['slide'] . '); </script>';
};
?>

<?php get_footer(); ?>
