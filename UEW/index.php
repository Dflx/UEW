   <?php get_header(); ?>   
	    
<?php 
		
   $the_page = get_pages($query_all_pages);
   foreach($the_page as $a_page) {
   	if($a_page->post_title == "projects" || $a_page->post_title == "Projects") {
   		$project_page_id = $a_page->ID;
   	};
   };



$args = array(
	'post_type' 	=> 'uew_home_images',
	'posts_per_page' => 5,
	'orderby' 	=> 'menu_order',
	'order' => 'ASC',
);
$home_images = get_posts($args);

$count = 0;
foreach ($home_images as $image) { 
	echo '<div class="imagePanels">';
	echo '<a href="' . get_permalink($project_page_id) . '&language=' . $_GET['language'] . '&project=' . $count++ . '"><img src="' .catch_image($image->post_content). '" width=185 height=500 /></a>';
	echo '</div>';
};
?>       
</div>
<?php get_footer(); ?>   