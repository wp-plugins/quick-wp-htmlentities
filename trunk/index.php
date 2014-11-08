<?php
/*
Plugin Name: Quick WP htmlentities
Description: This is a shortcode plugin that applies the PHP htmlentities function to text in a post. 
Version: 1.1
Author: Willy Richardson
Author URI: http://www.brimbox.com/wordpress/
License: GPLv2 or later
*/

//This function allows you to emulate "htmlentities" with the shortcode "[quick-wp-htmlentities]" in posts
//The basic issue with htmlentities this shortcode addresses is the function wpautop puts tags in $content
//This function does not alter the "the_content" hook default behavior and may not work if the hook is altered

//add the shortcode   
add_shortcode('quick-wp-htmlentities', 'quick_wp_htmlentities_func_main');
//add filter to not texterize content in shortcode
add_filter('no_texturize_shortcodes', 'quick_wp_htmlentities_func_filter' );

function quick_wp_htmlentities_func_main($atts, $content = null) {
     
    //shortcode name for matching
    $shortcode = "quick-wp-htmlentities";
    
    //parameters to add tag with optional style and/or class, wrapper inner tag, and inline text to boolean specification
    $a = shortcode_atts( array('tag' => false,'style' => false, 'class' => false, 'wrapper' => false, 'inline'=>false), $atts, $shortcode );
    //since default content is passed through wpautop we need the raw post
    $custom = get_page($id);
    
    //altered Wordpress standard shortcode regex
    $pattern = '\[(\[?)(' . $shortcode . ')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
    
    //match all shortcodes and count
    $count_matches = preg_match_all('/'.$pattern.'/s', $custom->post_content, $matches);
    
    //loop through matches array
    for ($i=0; $i<$count_matches; $i++) {       
        
        //deal with shortcode auto paragraph
        
        $test_content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', wpautop($matches[5][$i],1) );
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        //wpautop apparently fixes ampersands
        $content = str_replace("&#038;", "&", $content);

        //compare content to see if it is the content being passed in, a must for multiple shortcodes        
        if (strstr($content, $test_content)) {            
            //main line, convert return content with htmlentities then run through wpautop
            $return_content = wpautop(htmlentities(trim($matches[5][$i])), 1);
            //purge new lines, tabs, and return carriages 
            $return_content = str_replace(array("\r","\n","\t"), "", $return_content);
            
            //convert string "true" to boolean
            if (filter_var($a['inline'], FILTER_VALIDATE_BOOLEAN)) {
                //remove begin and end paragraphs for inline use
                $return_content = preg_replace( '#^<p>|<\/p>$#', '', trim($return_content));
            }
            //initialize empty strings
            $begin_wrapper = $end_wrapper = $begin_tag = $end_tag = $style = $class = "";
            //inner tag, usually something like a <code> tag
            if ($a['wrapper']) { 
                $begin_wrapper = "<" . $a['wrapper'] . ">";
                $end_wrapper = "</" . $a['wrapper'] . ">";
            }
            //outer tag with optional style and or class for content if set
            if ($a['tag']) {
                if ($a['style']) $style = " style=\"" . $a['style'] . "\"";
                if ($a['class']) $class = " class=\"" . $a['class'] . "\"";
                $begin_tag = "<" . $a['tag'] . $style . $class . ">";
                $end_tag = "</" . $a['tag'] . ">";
            }
        //return content
        return $begin_tag . $begin_wrapper .  $return_content  . $end_wrapper . $end_tag;                         
        }
    }
}

function quick_wp_htmlentities_func_filter() {
    return array('quick-wp-htmlentities');
}

?>