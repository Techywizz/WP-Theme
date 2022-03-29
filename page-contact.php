<?php
    /**
    * Template Name: Contact Page
    */
get_header();
?>
<?php 
	$custom_page_title = get_field('custom_page_title');
	$custom_page_description = get_field('custom_page_description');
	$contact_form_data = get_field('left_contact_form');
	$contact_form_title = $contact_form_data['form_title'];
	$contact_form_description = $contact_form_data['form_description'];
	$map = get_field('map');

?>
<div class="after-header"></div>
<section class="bg-g-dark contact-page">
	<div class="container">
		<div class="res-full space about-section">
		<div class="w-50 res-full contact-title">
			<h2 class="text-uppercase mb-2"><?php echo $custom_page_title;?></h2>
			<div class="clearfix"></div>
			<?php if($custom_page_description) : ?>
				<p class="mb-0"><?php echo $custom_page_description;?></p>
			<?php endif; ?>
			</div>
		<div class="divider top-0 black"></div>	
		<div class="row contact-section">
			<div class="col-md-6 part1">
				<h2 class="text-uppercase mb-2"><?php echo $contact_form_title;?></h2>
				<div class="clearfix"></div>
				<p><?php echo $contact_form_description;?></p>
			<?php echo do_shortcode('[contact-form-7 id="323" title="Contact Form" html_class="form"]');?>
			</div>
			
			<div class="col-md-6 part2 pl-5">
				<!-- // Check rows exists. -->
				<?php if( have_rows('contact_right_content') ):
				    // Loop through rows.
				    while( have_rows('contact_right_content') ) : the_row();
				        // Load sub field value.
				        $right_content_title = get_sub_field('right_content_title');
				        $right_content_content = get_sub_field('right_content_content');
				        // Do something...
				        echo '<div class="equal-space">
				        	<h2 class="text-uppercase mb-2 margin-class">'.$right_content_title.'</h2>
							<div class="clearfix"></div>
							<p class="text-uppercase font-w-500 font-16">'.$right_content_content.'</p></div>';
				    // End loop.
				    endwhile;
					endif;
				?>		
			</div>	
		</div>
		</div>
	</div>
</section>
<style type="text/css">
	.subscribe{ margin-top:-20px;}
</style>
<?php echo $map ;?>
<?php get_footer();?>