<?php 
session_start();
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
if(isset($_GET['language'])) { $_SESSION['language'] = $_GET['language'] = $_GET['language']; };
?>

<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href= <?php echo get_template_directory_uri() . "/contact.css"; ?>>
<div class="imagePanels">

<?php
$contact_pic = get_posts( array(
	'category_name' => 'contact',
	'orderby' => 'post_date',
	'order' => 'ASC',
) );

foreach($contact_pic as $post) {
	echo get_the_post_thumbnail($post->ID, full); 
	echo '</div>';
	
	if($_GET['language'] == 'Chinese') {
	 echo '<h1 id="contactUs" style="bottom:-40px">';
	 echo custom_tag('chinese-title', $post->post_content);
    echo '</h1>';
   } else {
   	echo '<h1 id="contactUs">';
	 echo $post->post_title;
    echo '</h1>';
   }
   	
   	
   echo '</div>';
   echo '<p id="contactInfo">';
   if($_GET['language'] == 'Chinese') {
   	echo custom_tag('chinese', $post->post_content);
   } else {
   	echo custom_tag('english', $post->post_content);
   };
 };
 ?>
   
<?php get_footer(); ?>