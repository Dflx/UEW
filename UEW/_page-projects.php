<?php get_header(); ?>

<?php
echo '<div id="arrowBox">';
echo '<div id="leftArrow" class="boxes" onclick="Slider.prev();"><div class="wrapper"><img src="' .get_template_directory_uri(). '/images/leftArrow.png" height="25px" width="25px" ></div></div> ';
echo '<div id="rightArrow" class="boxes" onclick="Slider.next();"><div class="wrapper"><img src="' .get_template_directory_uri(). '/images/rightArrow.png" height="25px" width="25px" ></div></div>';
echo '</div>';
?>


<?php

	$args = array(
		'category_name' => 'projects',
		'orderby' => 'post_date',
		'numberposts' => -1,	
		'order' => 'ASC',		
	);			
	$projects = get_posts($args);

   echo '<div id="indicator">';
   for($i=0; $i < count($projects); $i++) {
   	echo '<div class="indicatorBoxes"></div>';
   };
   echo '</div>';
?>

<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/projects.css"; ?>>



<?php   	
	$args = array(
		'category_name' => 'projects',
		'orderby' => 'post_date',
		'numberposts' => -1,	
		'order' => 'ASC',		
	);			
			

   $projects = get_posts($args);
   

echo '<ul id="theSlider">';
  	     	
foreach($projects as $post) {
   echo '<li>';
	echo '<div id="frame">';
	echo '<div id="TextFrame">';
	

	if($_GET['language'] == "Chinese") {
   	echo '<h2>'; 
   		echo custom_tag('chinese-title', $post->post_content);
   	echo '</h2>';
   
   	echo '<h5 id="projectSubtitle">';
   		echo custom_tag('chinese-subtitle', $post->post_content);
		echo '</h5>';
	
	
   echo '<div  id="descriptionCHN">';
   	echo custom_tag('chinese', $post->post_content);
    echo '</div>'; //descriptionCHN

   
   echo '<div id="miscInfo">';
   	echo custom_tag('chinese-misc', $post->post_content);
	echo '</div>'; //miscInfo
	
	
	
} else { 


	echo '<h2>' . $post->post_title . '</h2>';
   
   echo '<h5 id="projectSubtitle">';
   	echo custom_tag('subtitle', $post->post_content);
	echo '</h5>';
	
  
   echo '<div id="descriptionENG">';
   	echo custom_tag('english', $post->post_content);
	echo '</div>'; //descriptionENG

   
   echo '<div id="miscInfo">';
   	echo custom_tag('misc', $post->post_content);
	echo '</div>'; //miscInfo
	};


	echo '</div><!-- TextFrame -->';
   
   echo '<div class="projectImage">';
 	setup_postdata($post);
	echo get_the_post_thumbnail($post->ID, 'full');
	echo '</div> <!--projectImage-->';
	echo '</div> <!--frame-->';
   echo '</li>';
};
            	
   echo '</ul> <!--slider-->';
   

   echo '<script>';
   echo 'var theSlider = document.getElementById("theSlider");';
   echo 'theSlider.style.width = (960 * ' . count($projects) . ' + "px");';
   echo '</script>';
?>

<script src="wp-content/themes/UEW/js/slider.js"></script>

<script>

Slider.setSlider("projects", false, 960, .3, .5, false);
</script>

<?php
if(isset($_GET['slide'])) {
	echo '<script> Slider.gotoSlide(' . $_GET['slide'] . '); </script>';
};
?>

<?php get_footer(); ?>