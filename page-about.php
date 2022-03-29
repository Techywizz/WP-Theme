<?php
    /**
    * Template Name: About Page
    */
get_header();
?>
<!-- Custom Field Data -->
<?php
	$about_logo = get_field('about_logo'); 
	$about_description = get_field('about_description'); 
	$custom_title = get_field('custom_page_title');
	$custom_page_description = get_field('custom_page_description');
?>
 <!-- Custom Field Data End -->
<div class="after-header"></div>
<section class="bg-g-dark">
	<div class="container">
		<?php if(!empty($about_logo)){?>
			<div class="text-center w-50 m-auto res-full">
				<img src="<?php echo $about_logo;?>" class="about-logo">
				<?php if($about_description) : ?>		
					<br>
					<br>
					<p class="mb-0"><?php echo $about_description;?></p>
				<?php endif; ?>
			</div>
		<?php }?>
		<div class="res-full space about-section">
			<h2 class="text-uppercase mb-3 about-custom-title"><?php echo $custom_title;?></h2>
			<div class="clearfix"></div><br class="res-hide">
			<?php if($custom_page_description) : ?>
				<p class="mb-0"><?php echo $custom_page_description;?></p>
				<br>
				<br>
			<?php endif; ?>
			<div class="divider top-0 black"></div>	
				<!-- // Check rows exists. -->
					<?php if( have_rows('about_content') ):
					    // Loop through rows.
					    while( have_rows('about_content') ) : the_row();
					        // Load sub field value.
					        $row_title = get_sub_field('row_title');
					        $row_content = get_sub_field('row_content');
					        // Do something...
					        echo '
					        <br>
							<br>
					        	<h2 class="text-uppercase mb-3">'.$row_title.'</h2>
								<div class="clearfix"></div><br class="res-hide">
								<p class="mb-0">
									'.$row_content.'
								</p>
							<br>
							<br>
							<div class="divider top-0 black"></div>';
					    // End loop.
					    endwhile;
						endif;
					?>
			</div>
		</div>
	</div>
</section>
<?php get_footer();?>