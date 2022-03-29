<!DOCTYPE html>
<html lang="en">
<head>
  <title>THEKUSHROOM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php wp_head();?>
  <script type="text/javascript">
  	jQuery(document).ready(function(){
  		jQuery(".woocommerce-ordering").appendTo(jQuery(".default-sorting.dropdown"));
        a = jQuery('.default-sorting.dropdown').text()
        if(!a || !a.trim()){
          jQuery('#make-display-none').css('display','none');
        }
        jQuery( '.woocommerce-ordering' ).on( 'click', '.nice-select.orderby li', function () {
          var uri = window.location.toString();
          if (uri.indexOf("?") > 0) {
              var clean_uri = uri.substring(0, uri.indexOf("?"));
              window.history.replaceState({}, document.title, clean_uri);
          }
              var value = $(this).attr('data-value');
              var url = document.location.href+"?orderby="+value;
                          document.location = url;
        });

        jQuery('button.clear-filters').on( 'click', function () {
            location.href = 'https://thekushroom.com/all-products/';
        });
  	});
  
  </script>
</head>
<body <?php body_class( 'class-name' ); ?>>
<?php get_template_part('inc/header/main','header');?>