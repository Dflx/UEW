<?php 
session_start();
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
?>

 <?php get_header(); ?>
 
<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/team.css"; ?>>

<?php
$members = array(
	'post_type' 	=> 'uew_team_members',
	'orderby' 	=> 'menu_order',
	'numberposts' => -1,
	'order' => 'ASC',
);


$team = get_posts($members);

//ROUND UP TO THE NEXT PAGE
function pages($num) {
	if(is_float($num / 4)) {
		return intval($num / 4) + 1;
	} else {
		return $num / 4;
	};
};	

echo '<div id="leftArrow" class="boxes" onclick="Slider.prev();"><div class="wrapper"><img src="' .get_template_directory_uri(). '/images/leftArrow.png" height="25px" width="25px"></div></div>';
echo '<div id="rightArrow" class="boxes" onclick="Slider.next();"><div class="wrapper"><img src="' .get_template_directory_uri(). '/images/rightArrow.png" height="25px" width="25px"></div></div>';
  

echo '<ul id="theSlider">';

for($page = 0; $page < pages(count($team)); $page++) {
echo '<!-- Page ' .($page +1). ' -->';
echo '<li>';
echo '<div class="frame">';

		for($post = ($page * 4); $post < (($page * 4) + 4); $post++) {
			if($post == (($page * 4) + 2)) {
				echo '<div class="imagePanels" style="clear: left">' . get_the_post_thumbnail($team[$post]->ID, 'full') . '</div>';
			} else {
				echo '<div class="imagePanels">' . get_the_post_thumbnail($team[$post]->ID, 'full') . '</div>';
			};
			echo '<div class="textFrames">';
			echo '<div class="memberTitle">';
			
			$memberName = explode(' ', $team[$post]->post_title);
			echo '<h2>';
			foreach($memberName as $member) {
				if($memberName[count($memberName) - 1] == $member) {
					echo '<span style="color: cyan">' . $member . '</span>';
				} else {
				echo $member . ' ';
			};
		};
			echo '</h2>';
			
			if($_GET['language'] == 'Chinese') {
			echo '<span id="pedigree">';
				echo custom_tag('chinese-degree', $team[$post]->post_content);
			echo '</span>';
			echo '</div>'; //memberTitle
			
			
			echo '<div class="memberDescriptionCHN">';
				echo custom_tag('chinese', $team[$post]->post_content);
			echo '</div>'; //memberDescriptionCHN 
			
			echo '</div>';
			
			} else {
			echo '<span id="pedigree">';
				echo custom_tag('degree', $team[$post]->post_content);
			echo '</span>';
			echo '</div>'; //memberTitle
			
			echo '<div class="memberDescriptionENG">';
				echo custom_tag('english', $team[$post]->post_content);
			echo '</div>'; //memberDescriptionENG
			
			
			echo '</div>';
		};

		}; 
	echo '</div></li>';
};

echo '</ul>';
?>

<script src="wp-content/themes/UEW/js/slider.js"></script>

<script>
//setSlider(string[page], string[slider Id default="theSlider"], int[slide size], float[max opacity], float[min opacity], bool[use max opacity])
Slider.setSlider("team", 'theSlider', 940, .3, 1, true);
</script>

<?php get_footer(); ?> 