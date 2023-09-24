<?php

function add_styles(){
	wp_enqueue_style('main','https://www.xxsim.com/front/css/style.css');
	wp_enqueue_style('child',get_stylesheet_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts','add_styles',20);