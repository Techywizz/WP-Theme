<?php get_header();?>
<?php $bg_url = get_field('post_bg');?>
<section class="home-banner blog-post" style="background:url(<?php echo $bg_url ;?>);background-attachment: fixed;background-position: center;background-repeat: no-repeat;background-size: cover;"></section>
<section class="padding blog-post-page">
	<div class="container space">
		<?php if (have_posts()) : ?>
		    <?php while (have_posts()) : the_post(); ?>
		     	<h2 class="text-uppercase mb-3"><?php echo the_title();?></h2>
				<?php echo the_content();?>
		    <?php endwhile; ?> 
		<?php endif; ?>
	<div class="divider top-0"></div>
	<br>
	<br>
		<div class="d-flex">
			<?php previous_post_link( '%link', 'prev blog', true ); ?> 
			<?php next_post_link( '%link', 'next blog', true ); ?>
		</div>
	</div>
</section>
<?php get_footer();?>