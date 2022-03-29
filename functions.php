<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/*The KushRoom Functions*/

add_theme_support( 'custom-logo' );
add_theme_support( 'custom-logo', array(
  'height'      => 100,
  'width'       => 400,
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => array( 'site-title', 'site-description' ),
) );

function nwm_logo(){
  $custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo '<a href="'.site_url().'"></a>';
}

add_theme_support( 'post-thumbnails' );

function theme_all_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
   wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assest/css/bootstrap.min.css', array(), '', 'all');
  wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assest/css/owl.carousel.min.css', array(), '', 'all');
  wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assest/css/owl.theme.default.min.css', array(), '', 'all');
  wp_enqueue_style( 'custom', get_template_directory_uri() . '/assest/css/custom.css', array(), '8.16', 'all');
  wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assest/css/responsive.css', array(), '8.1', 'all');
  wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/assest/css/nice-select.css', array(), '8.1', 'all');

}
add_action( 'wp_enqueue_scripts', 'theme_all_scripts' );
function my_custom_js() {
  wp_enqueue_script( 'min-jquery', get_template_directory_uri() . '/assest/js/jquery.min.js', array ( 'jquery' ), '', true);
  if(!is_checkout()){
    wp_enqueue_script( 'nice-select-jquery', get_template_directory_uri() . '/assest/js/jquery.nice-select.min.js', array ( 'jquery' ), '', true);
  }
  wp_enqueue_script( 'popper', get_template_directory_uri() . '/assest/js/popper.min.js', array ( 'jquery' ), '', true);
  wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assest/js/bootstrap.min.js', array ( 'jquery' ), '', true);
  wp_enqueue_script( 'owl-js', get_template_directory_uri() . '/assest/js/owl.carousel.js', array (), '', true);
  wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assest/js/custom.js', array (), '', true);



}

function wpse108194_remove_empty_paragraphs( $content ) {
   $content = preg_replace( '#<p>\s*</p>#', '', $content );
   return $content;
}
add_filter( 'the_content', 'wpse108194_remove_empty_paragraphs', 11 );


// Add hook for admin <head></head>
//add_action( 'admin_head', 'my_custom_js' );
// Add hook for front-end <head></head>
add_action( 'wp_head', 'my_custom_js' );
// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );

function sdt_remove_ver_css_js( $src, $handle ) 
{
    $handles_with_version = [ 'style' ]; // <-- Adjust to your needs!

    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
        $src = remove_query_arg( 'ver', $src );

    return $src;
}

function get_current_post_cat_name(){

    $cat = get_queried_object();
    $cat_data = array(
      'cat_id' => $cat->term_id,
      'category_name' => $cat->name,
      'category_description' => $cat->description,
    );

    return $cat_data;

}

function nwm_menu() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'nwm_menu' );

function nwm_menu_submenu_css_class( $classes ) {
    $classes[] = 'submenu';
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'nwm_menu_submenu_css_class' );

/*add_action( 'wp_footer', function(){
    ?>
    <script>
    (function( $ ) {
        var itemm = $('#menu-item-474 > a');
        itemm.click(function(){
            document.activeElement && document.activeElement.blur();
            return false;
        });
    })(jQuery);
    </script>
<?php
 }, 1, 0 );*/

/* Add classes and other attributes to the anchor tags if list item is a parent */

/*add_filter( 'nav_menu_link_attributes', 'add_class_to_items_link', 10, 3 );

function add_class_to_items_link( $atts, $item, $args ) {
  // check if the item has children
  $hasChildren = (in_array('menu-item-has-children', $item->classes));
  if ($hasChildren) {
    // add the desired attributes:
    $atts['class'] = 'active'; //This is the main concern according to the question
  }
  return $atts;
}*/


//tidy up img tags. We don't want inline height and width added by WP.
//we'd rather use media queries and fluid img.
function remove_image_dim_attr($html) {
    $html=preg_replace( '/width=(["\'])(.*?)\1/', '', $html );
    $html=preg_replace( '/height=(["\'])(.*?)\1/', '', $html );
    return $html;
}
add_filter( 'get_image_tag','remove_image_dim_attr' );
add_filter( 'image_send_to_editor','remove_image_dim_attr' );
add_filter( 'post_thumbnail_html','remove_image_dim_attr' );


function posts_link_next_class($format){
     $format = str_replace('href=', 'class="btn btn-border dark mr-auto left-margin" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="btn btn-border dark mr-auto rigth-margin" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');


function nwm_paginate_links() {
  ob_start();
  ?>
    <div class="d-flex d-res-block pagination-wrap">
      <?php
        global $wp_query;
        $current = max( 1, absint( get_query_var( 'paged' ) ) );
        $pagination = paginate_links( array(
          'base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
          'format' => '?paged=%#%',
          'current' => $current,
          'total' => $wp_query->max_num_pages,
          'type' => 'array',
          'prev_text' => __('<i class="fa fa-angle-left" aria-hidden="true"></i>'),
          'next_text' => __('<i class="fa fa-angle-right" aria-hidden="true"></i>'),
        ) ); ?>
      <?php if ( ! empty( $pagination ) ) : ?>
        <ul class="pagination  m-auto mb-0">
          <?php foreach ( $pagination as $key => $page_link ) : ?>
            <li class="page-item<?php 
              if ( strpos( $page_link, 'current' ) !== false ) { 

                echo ''; 
              }
              elseif (strpos( $page_link, 'current' ) >= '1'  ) {
                # code...
                echo ' prev';
              } ?>">
            <?php 
              echo str_replace( array('class="page-numbers"', 'class="prev page-numbers"' ,'class="next page-numbers"' ,'class="page-numbers current"','class="page-numbers dots"' ), array( 'class="page-link d-flex align-items-center justify-content-center"' , 'class="page-link d-flex align-items-center justify-content-center"', 'class="page-link d-flex align-items-center justify-content-center"' , 'class="page-link d-flex align-items-center justify-content-center act"', 'class="page-link d-flex align-items-center justify-content-center"'), $page_link );?>            
            </li>
          <?php endforeach ?>
        </ul>
      <?php endif ?>
    </div>
  <?php
  $links = ob_get_clean();
  return apply_filters( 'nwm_cat_paginate_links', $links );
}

function nwm_cat_paginate_links() {
  echo nwm_paginate_links();
}

// These are actions you can unhook/remove!
 
// WOOCOMMERCE
function nwm_add_woocommerce_support() {
  add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'nwm_add_woocommerce_support' );

//
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail();
	} 
 }


/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce;

			//$output='';	
			if ( has_post_thumbnail() ) {
				
				$output .= get_the_post_thumbnail( $post->ID ); 
				
			} else {
			
				$output .= '<img class="w-100" src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" />';
			}
			
			return $output;
	}
 }

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

/**
* Show the product title in the product loop. By default this is an H2.
*/
function woocommerce_template_loop_product_title() {
echo '<h4 class="title">' . get_the_title() . '</h4>';
}
}

// add_filter( 'woocommerce_get_price_html', 'wpa83368_price_html', 10, 2 );
// function wpa83368_price_html( $price,$product ){
//    // return $product->price;
//     if ( $product->price > 0 ) {
//       if ( $product->price && isset( $product->regular_price ) ) {
//         $from = $product->regular_price;
//         $to = $product->price;
//         return '<del>'. ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) .'</del>  | '.( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to );
//       } else {
//         $to = $product->price;
//         return ( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to );
//       }
//    }
// }

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to Cart', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Shop Now', 'woocommerce' );
}

// Minimum CSS to remove +/- default buttons on input field type number
add_action( 'wp_head' , 'custom_quantity_fields_css' );
function custom_quantity_fields_css(){
    ?>
    <style>
    .quantity input::-webkit-outer-spin-button,
    .quantity input::-webkit-inner-spin-button {
        display: none;
        margin: 0;
    }
    .quantity input.qty {
        appearance: textfield;
        -webkit-appearance: none;
        -moz-appearance: textfield;
    }
    </style>
    <?php
}


add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?php
}

function woocommerce_content() {

    if ( is_singular( 'product' ) ) {

      while ( have_posts() ) :
        the_post();
        wc_get_template_part( 'content', 'single-product' );
      endwhile;

    } else {
      ?>

      <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

        <?php if(is_shop() || is_product_category()){ ?>
          <div class="after-header"></div>
            <section class="space product-listing">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6 res-full">
                        <h2 class="text-uppercase mb-3"><?php woocommerce_page_title();?></h2>
                        <div class="clearfix"></div><br class="res-hide">
                        <p class="mb-0">
                           <?php  global $wp_query;
                              $current = max( 1, absint( get_query_var( 'paged' ) ) ); 
                          
                          if (is_product_category()) {
                            echo category_description( get_category_by_slug( 'category-slug' )->term_id );
                          }?> 
                        </p>
                      </div>
                    </div>
                  <br>
                  <div class="divider top-0 mt-3"></div>
                <!--filter start here-->
                	<div class="filter">
                  		<div class="row">
                  			<div class="col-md-12">
                  				<div class="res-filter d-none res-show">
                  					<h4 class="text-uppercase font-16 font-weight-bold d-flex align-items-center cursor">Filters
                  						<i class="fa fa-angle-down ml-auto ml-auto font-24" aria-hidden="true"></i>
                  					</h4>
                  				</div>
                    			<div class="filter-panel">
                    				<div class="row">
                    					<div class="col-md-7">
                    						<div class="row">
                        					<div class="col">
                        					<?php if ( is_active_sidebar( 'custom-header-widget' ) ) : ?>
                										    <?php dynamic_sidebar( 'custom-header-widget' ); ?>
                									<?php endif; ?>
                        					</div>
                        					<div class="col">
                        						<?php if ( is_active_sidebar( 'custom-price-widget' ) ) : ?>
                  										    <?php dynamic_sidebar( 'custom-price-widget' ); ?>
                  									<?php endif; ?>
                        					</div>
                        					<div class="col">

                        					
                        						<h4 class="text-uppercase font-16 font-weight-bold" id="make-display-none">sort by</h4>
                       						   <div class="default-sorting dropdown" id="check-empty">
            
                        						</div>
                        					</div>
                        				</div>
                    				  </div>
                              <div class="col-md-5 d-flex">
                                  <button type="button" class="btn btn-border dark ml-auto clear-filters">clear filters</button>       
                              </div>
                    				</div>
                    			</div>
                  			</div>
                  		</div>
                	</div>
	              <!--filter ends here-->	
              	
  	            <br class="res-hide">
                <br class="res-hide">
                <br>
      <?php } endif; ?>
      <?php if ( woocommerce_product_loop() ) : ?>

        <?php do_action( 'woocommerce_before_shop_loop' ); ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php if ( wc_get_loop_prop( 'total' ) ) : ?>
          <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php wc_get_template_part( 'content', 'product' ); ?>
          <?php endwhile; ?>
        <?php endif; ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php do_action( 'woocommerce_after_shop_loop' ); ?>
        <?php
      else :
        do_action( 'woocommerce_no_products_found' );
		echo '</div></div>';
      endif;
    }
  }
function mycode_woocommerce_add_salediscount_to_catalog_ordering_args( $args ) {
    $orderby_value = isset( $_GET['orderby'] ) 
        ? wc_clean( $_GET['orderby'] ) 
        : apply_filters('woocommerce_default_catalog_orderby'
                       ,get_option('woocommerce_default_catalog_orderby' )
                       );
    if ( 'discount' == $orderby_value ) {
        $args['orderby']    = 'meta_value_num';
        $args['order']      = 'DESC';
        $args['meta_key']   = 'discount_amount';
    }
    return $args;
}

  //* http://gasolicious.com/remove-tabs-keep-product-description-woocommerce/
//  Location: add to functions.php
//  Output: removes woocommerce tabs

/*remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
//* http://gasolicious.com/remove-tabs-keep-product-description-woocommerce/
//  Location: add to functions.php
//  Output: adds full description to below price

function woocommerce_template_product_description() {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_product_description', 20 );*/
function wpb_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Custom Header Widget Area',
        'id'            => 'custom-header-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-uppercase font-16 font-weight-bold">',
        'after_title'   => '</h4>',
    ) );
 
}
add_action( 'widgets_init', 'wpb_widgets_init' );

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});


/*Custom Widgets Start*/
register_sidebar( 
  array(
    'name' => 'Footer Section One',
    'id' => 'footer-section-1',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  )
);

register_sidebar( 
  array(
    'name' => 'Footer Section Two',
    'id' => 'footer-section-2',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="text-uppercase text-white font-weight-bold">',
    'after_title' => '</h4>',
  )  

);

register_sidebar( 
  array(
    'name' => 'Footer Section Three',
    'id' => 'footer-section-3',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="text-uppercase text-white font-weight-bold">',
    'after_title' => '</h4>',
  )  
);

register_sidebar( 
  array(
    'name' => 'Footer Section Four',
    'id' => 'footer-section-4',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="text-uppercase text-white font-weight-bold">',
    'after_title' => '</h4>',
  )
  ) ;
  register_sidebar( 
  array(
    'name' => 'Custom Price Widget',
    'id' => 'custom-price-widget',
    'description' => 'Appears in the Shop Filter',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="text-uppercase font-16 font-weight-bold">',
    'after_title' => '</h4>',
  ) 

);

function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}
 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );


  //* http://gasolicious.com/remove-tabs-keep-product-description-woocommerce/
//  Location: add to functions.php
//  Output: removes woocommerce tabs

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

/**
 * Remove Reviews tab
 */
add_filter( 'woocommerce_product_tabs', 'wpd_wc_remove_product_review_tab', 15 );
function wpd_wc_remove_product_review_tab( $tabs ) {
    //Removing Reviews tab
    if ( comments_open() ) {
        unset( $tabs['reviews'] );
    }
    
    return $tabs;
}
 
/**
 * Add custom CSS class to body tag.
 * We shall use this class into the CSS
 */
add_filter( 'body_class', 'wpd_add_new_class' );
function wpd_add_new_class( $classes ) {
    if( comments_open() && is_singular( 'product' ) ) {
        $classes[] = 'has-reviews';
    }
    
    return $classes;
}
 
/**
 * Add the product reviews
 */
add_action( 'woocommerce_after_single_product_summary', 'wpd_wc_add_product_reviews', 15 );
function wpd_wc_add_product_reviews() {
    global $product;
 
    if ( ! comments_open() )
        return;
?>
    <div class="product-reviews">
        <?php call_user_func( 'comments_template', 999 ); ?>
    </div>
    <div class="clearfix clear"></div>
<?php
}

function custom_excerpt_length($length){
return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length',999);
//truncate a string only at a whitespace (by nogdog)

function truncate($text, $length) {
   $length = abs((int)$length);
   if(strlen($text) > $length) {
      $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
   }
   return($text);
}
add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
    return str_replace( '<ins>', '<span>', $price );
}
//Second Logo
add_action( 'customize_register', 'nwm_customize_register' );

function nwm_light_logo_customizer_setting($wp_customize) {
// add a setting
    $wp_customize->add_setting('nwm_theme_light_logo');
// Add a control to upload the hover logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nwm_theme_light_logo', array(
        'label' => 'Upload Light Logo',
        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
        'settings' => 'nwm_theme_light_logo',
        'priority' => 8 // show it just below the custom-logo
    )));
}

add_action('customize_register', 'nwm_light_logo_customizer_setting');
function nwm_theme_light_logo(){
  $nwm_theme_light_logo_id = get_theme_mod( 'nwm_theme_light_logo' );
  $dark = 'logo-dark';
  if(is_single() ) {
    echo '<a href="'.site_url().'"><img src="'.$nwm_theme_light_logo_id.'" class="logo '.$dark.'" alt="'.get_bloginfo( 'name' ).'"></a>';

  } else {
    echo '<a href="'.site_url().'"><img src="'.$nwm_theme_light_logo_id.'" class="logo" alt="'.get_bloginfo( 'name' ).'"></a>';

  }
  
}
add_action('wp_enqueue_scripts', 'my_select_dropdown');

function my_select_dropdown() {

        if( is_shop() || is_product_category()) {

        wp_enqueue_style( 'select2');
        wp_enqueue_script( 'selectinit', get_stylesheet_directory_uri() . '/js/select2-init.js', array( 'selectWoo' ), '1.0.0', true );

        }
}

function changing_price_location_for_simple_products(){
    global $product;

    if($product->is_type('simple')) // Only for simple products (thanks to helgathevicking)
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);
    }
}
add_action('woocommerce_before_single_product', 'changing_price_location_for_simple_products');

//remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
//add_action('woocommerce_after_order_notes', 'woocommerce_checkout_coupon_form');
add_action( 'woocommerce_before_checkout_form', 'bbloomer_cart_on_checkout_page_only', 5 );
 
function bbloomer_cart_on_checkout_page_only() {
 
if ( is_wc_endpoint_url( 'order-received' ) ) return;
 
echo do_shortcode('[woocommerce_cart]');
 
}
add_action( 'template_redirect', 'bbloomer_redirect_empty_cart_checkout_to_home' );
 
function bbloomer_redirect_empty_cart_checkout_to_home() {
   if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
      wp_safe_redirect( home_url() );
      exit;
   }
}