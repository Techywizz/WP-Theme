<section class="subscribe d-flex align-items-center justify-content-center flex-column">
	<div class="container">
		<h2 class="text-center text-uppercase font-weight-bold mb-3">Get $20 Off Your First Order</h2>
		<p class="text-center mb-5">Subscribe for the latest deals and best offers on  alternative healing substances.</p>
		<?php echo do_shortcode('[contact-form-7 id="504" title="News Letter" html_class="m-auto d-flex align-items-center flex-column"]');?>
	</div>
</section>
<footer class="mission-section space">
	<div class="container">
		<div class="row">
			<div class="col-md-3 column col1">
				<?php if ( is_active_sidebar( 'footer-section-1' ) ) : ?>
					    <?php dynamic_sidebar( 'footer-section-1' ); ?>
				<?php endif; ?>
			</div>
			
			
			<div class="col-md-6 col2">
				<div class="row">
					<div class="col-md-4  column">

						<h4 class="text-uppercase text-white font-weight-bold">company</h4>
						<?php wp_nav_menu( array( 
							'theme_location' => 'footer-menu',
							'menu_class' =>'list list-inline mb-0',
							) 
						);?>
					</div>
					
					
					<div class="col-md-8 column">
						<?php if ( is_active_sidebar( 'footer-section-3' ) ) : ?>
					    	<?php dynamic_sidebar( 'footer-section-3' ); ?>
						<?php endif; ?>
					</div>
					
					
				</div>
			</div>
			
			
			
			<div class="col-md-3 column last col3">
				<?php if ( is_active_sidebar( 'footer-section-4' ) ) : ?>
					    <?php dynamic_sidebar( 'footer-section-4' ); ?>
				<?php endif; ?>
			</div>
			
			
			
		</div>
		
		<br class="res-hide">

		<div class="divider"></div>
		<div class="copyright text-center">
			<?php if ( is_active_sidebar( 'footer-section-2' ) ) : ?>
					    <?php dynamic_sidebar( 'footer-section-2' ); ?>
			<?php endif; ?>
		</div>
		</div>
	
	
	
	<div class="gototop d-flex align-items-center justify-content-center">
		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</div>
	
	
</footer>



</div>
<?php wp_footer();?>
<?php if(!is_checkout()){?>
<script>
	$('select').niceSelect();
	
	$('.add_to_cart_button').text()
</script>
<?php } ?>
</body>
</html>