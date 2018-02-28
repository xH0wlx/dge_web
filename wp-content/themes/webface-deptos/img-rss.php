<?php
/*
add img thumbnail to RSS()
*/

/*****************
# agrega la imagen en el rss
******************/
add_action('rss2_item', function(){
  global $post;

  $output = '';
  $thumbnail_ID = get_post_thumbnail_id( $post->ID );
  $thumbnail = wp_get_attachment_image_src($thumbnail_ID, 'large');
  $output .= '<postthumbnail><![CDATA[';
    $output .= $thumbnail[0];
    $output .= ']]></postthumbnail>';

  echo $output;
});