<?php
/*
 * Thumb
 * Version 1.0
 * @author: Alexander Conroy
 * @blog: http://www.geilt.com
 * @website: http://www.esotech.org
 * @email: alex@esotech.org
 * 
 * Insert the following code into your Wordpress theme functions.php 
 * Make sure that your timthumb cache folder is set to 777 and is in the includes folder of your theme.
 * 
 * Allows you to use thumb() throughout your templates with options
 * $args = array of values to pass to timthumb.
 * License: GPLv3+
 * Use it as you like, fork it, or whatever. Give credit if you can.
 */
$thumb = get_template_directory_uri() . "/includes/timthumb.php?";
if(!function_exists( 'get_thumb' ) ):
    function get_thumb( $args = array(), $echo = false) {
        global $thumb;
        if( empty($args['src']) ):  
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
            $args['src'] = $thumbnail[0]; 
            if( empty( $args['src'] ) && $args['placeholder'] !== 'disable' ):
                $args['src'] = "http://placehold.it/" . ( isset($args['w']) ?  $args['w'] : "150" ) . "x" . ( isset($args['h']) ?  $args['h'] : "150" );            
            endif;
        endif;
        
        if( $echo ):
            echo $thumb . http_build_query($args);
            return;
        else:
            return $thumb . http_build_query($args);
        endif;
    }
endif;
if(!function_exists( 'the_thumb' ) ):
    function the_thumb( $args = array()) {
        get_thumb($args, true);
    }
endif;