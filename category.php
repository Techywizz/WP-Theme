<?php get_header();?>
<div class="after-header"></div>
<section class="home-product-section news news-page">
	<div class="container">
		<div class="w-50 res-full">
			<h2 class="text-uppercase font-weight-bold mb-2"><?php echo get_current_post_cat_name()['category_name'];?></h2><br>
			<p><?php echo get_current_post_cat_name()['category_description'];?></p>
		</div>
<div class="clearfix"></div>
<br>
<div class="divider top-0 d-block"></div>
		
		<div class="row mt-5 news-listing">
			<?php 
			$id = get_current_post_cat_name()['cat_id'];
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array(
				  'post_type' 		=> 'post' ,
				  'orderby' 		=> 'date' ,
				  'order' 			=> 'DESC' ,
				  'cat'     		=> $id,
				  'paged' 			=> $paged,
				); 

			$post_data = new WP_Query($args);
			if ( $post_data->have_posts() ) :
			  	while ( $post_data->have_posts() ) : $post_data->the_post();?>
		  			<div class="col-md-4 res-full-767">
						<div class="product-box">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail()) : ?>
								        <?php the_post_thumbnail('full', array('class' => 'w-100')); ?>
								<?php endif; ?>
							</a>
							<h4 class="title"><?php echo the_title();?></h4>
							<p class="mb-4"><?php echo get_the_excerpt();?></p>
							<a href="<?php the_permalink(); ?>" class="btn btn-border dark">read the blog</a>
						</div>	
					</div>
		   <?php endwhile;endif;?>
		</div>
	<br>

	<div class="divider top-0 d-block "></div>	
	
	
	<br>
	<br>
	<?php nwm_cat_paginate_links();?>
	</div>
		
</section>


<?php get_footer();