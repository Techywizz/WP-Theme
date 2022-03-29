<?php if ( is_home() || is_front_page() ) {

    $classes = 'home-header';

}elseif (is_page('about-us') || is_page('contact-us') || is_page('faq') || is_page('/category/news/')) {
	# code...
	$classes = 'home-header bggreen header-white';
} 
else {
	# code...
	$classes = 'home-header header-white';
} 

?>	
<div class="menu-panel-overlay"></div>
<div class="menu-panel">
<div class="content">
	<!--menu panel header start here-->
	<form>
		<div class="head d-flex align-items-center">
			<div class="search">
				<?php echo do_shortcode('[wpdreams_ajaxsearchlite]');?>
			</div>
			<ul class="list list-inline mb-0 ml-auto align-items-center">
				
				<li class="list-inline-item"><a class="cursor d-flex align-items-center justify-content-center text-white close-menu-panel"><i class="fa fa-times"></i></a></li>
			</ul>
			
		</div>
	</form>	
	<!--menu panel header ends here-->
	<br>

	<?php wp_nav_menu( array( 
		'theme_location' => 'main-menu',
		'menu_class' =>'menu text-center',
		'sub_menu'    => true,
			'show_parent' => true
		) 
	);?>
</div>	
</div>




<div class="wrapper">


<!--header start here-->
<header class="d-flex align-items-center <?php echo $classes;?>">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<span class="normal"><?php nwm_logo();?></span>
                <?php // if ( is_home() || is_front_page() ) { ?>
                    <span class="sticky"><?php nwm_theme_light_logo();?></span>
                    <style>
                        header.home-header span.sticky,header.home-header.sticky span.normal {
                            display: block;
                        }
                        /* header.home-header span.normal,header.home-header.sticky span.sticky  {
                            display: none;
                        } */
                    </style>

				<?php // } ?>
            </div>
			
			<div class="col-md-6 d-flex align-items-center part2">
				<ul class="list list-inline ml-auto mb-0">
					<li class="list-inline-item">
						 <?php if ( is_user_logged_in() ) { ?>
						 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><img src="<?php echo get_stylesheet_directory_uri()?>/assest/images/map.png" class="invert" /></a>
						 <?php } 
						 else { ?>
						 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><img src="<?php echo get_stylesheet_directory_uri()?>/assest/images/map.png" class="invert" /></a>
						 <?php } ?>
						</li>
					<?php wc_get_template_part( 'woocommerce/cart/mini', 'cart' ); ?>
					<li class="list-inline-item mr-0 open-menu-panel"><a class="cursor"><i class="fa fa-bars"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</header>
<!--header ends here-->