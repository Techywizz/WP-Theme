<?php get_header();
$banner_logo = get_field('banner_logo');
$banner_heading = get_field('banner_heading');
$banner_content = get_field('banner_content');
$banner_button = get_field('banner_button');	

?>
<section class="home-banner d-flex align-items-center justify-content-center flex-column">
	<div class="container d-flex align-items-center justify-content-center flex-column text-center home-content">
		<img src="<?php echo $banner_logo;?>" alt="THEKUSHROOM">
		<h1 class="txt-light-g text-uppercase font-weight-bold font-32 mt-3"><?php echo $banner_heading;?></h1>
		<p class="txt-light-g font-w-400 mb-5"><?php echo $banner_content;?></p>	
		<a href="<?php echo $banner_button;?>" class="btn btn-border btn-border-g">shop now</a>						
	</div>
	<i class="fa fa-angle-down down" aria-hidden="true"></i>
</section>
<section class="home-product-section after-banner home-product-row1">
	<div class="container">
		<h2 class="text-uppercase font-weight-bold mb-5">Our favourites</h2>
		
		<div class="row">

			<?php
				   $taxonomy     = 'product_cat';
    $show_count   = 0;     
    $pad_counts   = 0;     
    $hierarchical = 1;     
    $title        = '';  
    $empty        = 0;
    $args = array(
        'taxonomy'     => $taxonomy,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty,
        'number'       => 99,
        'parent'		=> 0,
    );

				 $all_categories = get_categories( $args );
				 foreach ($all_categories as $cat_list) {
				 	$thumbnail_id = get_term_meta ( $cat_list->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					$value = get_field('fav_cat', 'category_'.$cat_list->term_id);

						if($value[0] == 'yes'){
							echo '<div class="col res-full-767">
							<div class="product-box">
								<div class="flex">
									<a href="'.get_term_link($cat_list->term_id).'" class="img"><img src="'.$image.'" class="w-100"></a>
									<div class="info">
									<h4 class="title">'.$cat_list->name.'</h4>
									<p class="mb-4">'.truncate($cat_list->description,120).'</p>
									</div>
								</div>	
								<a href="'.get_term_link($cat_list->term_id).'" class="btn btn-border dark">shop now</a>
							</div>	
						</div>';
						} 
					}
				?>		
		</div>
	
		
		<div class="clearfix"></div>
		
		<div class="divider"></div>
		
		
		
	</div>

	
</section>





<section class="home-product-section home-product-section2">
	<div class="container">
		<h2 class="text-uppercase font-weight-bold mb-5">featured</h2>
		<div class="row" id="featured-products">
			<?php echo do_shortcode('[featured_products limit="4" columns="4"]');?>
		</div>
	</div>
</section>

<section class="home-product-section news">
	<div class="container">
		<h2 class="text-uppercase font-weight-bold mb-5">News</h2>
		<div class="row" id="news-slider">
			<?php $the_query = new WP_Query( 'posts_per_page=3' ); 
			while ($the_query -> have_posts()) : $the_query -> the_post();?>
			
				<div class="col res-full-767">
					<div class="product-box">
						<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail()) : ?>
								        <?php the_post_thumbnail('full', array('class' => 'w-100')); ?>
								<?php endif; ?></a>
						<h4 class="title"><?php echo the_title();?></h4>
						<p class="mb-4"><?php echo get_the_excerpt();?></p>
						<a href="<?php the_permalink(); ?>" class="btn btn-border dark">read the blog</a>
					</div>	
				</div>
			<?php endwhile;wp_reset_postdata();?>
		</div>
		<div class="clearfix"></div>
		
		<div class="divider res-show"></div>
	


	</div>
		
</section>
<?php get_footer();