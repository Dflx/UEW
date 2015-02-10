<?php 
session_start();
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
?>

<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/philosophy.css"; ?>>

<?php
$philosophy_pic = get_posts( array(
	'category_name' => 'philosophy',
	'posts_per_page' => '1',
	'orderby' => 'post_date',
	'order' => 'ASC',
) );
	foreach($philosophy_pic as $post) {
	echo '<div class="imagePanels">';				
	echo get_the_post_thumbnail($post->ID, 'full');
	echo '</div>'; 
	echo '<div class="textFrame">';
	echo '<div id="textFrameBackground">';
	echo '<div id="philosophyText">';
	if($_GET['language'] == 'Chinese') {
		echo custom_tag('chinese', $post->post_content);
	} else {
		echo custom_tag('english', $post->post_content);
	};
	echo '</div></div></div>';
};
?>


<?php get_footer(); ?>