<?php 
session_start();
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
?>

<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/process.css"; ?>>

<?php
echo '<div id="leftArrow" class="boxes" onclick="Slider.prev();"><div class="wrapper"><img src="' .get_template_directory_uri(). '/images/leftArrow.png" height="25px" width="25px" /></div></div>';
echo '<div id="rightArrow" class="boxes" onclick="Slider.next();"><div class="wrapper"><img src="' .get_template_directory_uri(). '/images/rightArrow.png" height="25px" width="25px" /></div></div>';
?>
<style>



</style>

<?php 
echo '<ul id="theSlider">';

$query_all_processes = array(
		'category_name' => 'process',
		'orderby' => 'post_date',
		'numberposts' => -1,
		'exclude' => 'home-images',
		'order' => 'ASC',
);

$processes = get_posts($query_all_processes);
foreach ($processes as $post) { 
	echo '<li>';
		echo '<div id="frame">';
			echo '<div id="headingText"><h1>';
			
			if($_GET['language'] == 'Chinese') {
				echo custom_tag('chinese-title', $post->post_content);
			} else {
				echo $post->post_title;
			};
			echo '</h1></div>';
			
		if(has_post_thumbnail($post->ID)) {
			setup_postdata($post);
			echo '<div class="imagePanel">';
				echo get_the_post_thumbnail($post->ID, 'full');
			echo '</div>';
		};
		
			echo '<div id="bodyText"><div id="processText">';
			if($_GET['language'] == 'Chinese') {
				echo custom_tag('chinese', $post->post_content);
			} else {
				echo custom_tag('english', $post->post_content);
			};
			
			echo '</div></div>';
		echo '</div>'; //frame
	echo '</li>';
};
echo '</ul>';
echo '<script> var theSlider = document.getElementById("theSlider"); theSlider.style.width = (960 * ' . count($processes) . ' + "px"); </script>';
?>

<script src="wp-content/themes/UEW/js/slider.js"></script>
<script>
//setSlider(string[slider Id default="theSlider"], int[slide size], float[max opacity], float[min opacity], bool[use max opacity])
Slider.setSlider("process", 'theSlider', 960, .5, 1, true);
</script>

<?php if(isset($_GET['slide'])) { echo '<script> Slider.gotoSlide(' . $_GET['slide'] . '); </script>'; }; ?>
<?php get_footer(); ?> 