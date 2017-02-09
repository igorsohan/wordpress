<?php
/*
Plugin Name: Підпис для постів
Description: Плагін додає підпис під кожним опублікованим постом
Version: 1.0
Author: Anatoly Skidkin
Author URI:
*/

add_filter( 'the_content', 'wfm_sign_content' );

function wfm_sign_content($content){
	if( !is_single() ) return $content;
	$wfm_sign = '<div class="alignright"><em>Author: Igor </em></div>';
	return $content . $wfm_sign;
}