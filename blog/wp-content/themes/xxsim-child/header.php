<?php
/* *
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package sparkling
 */

if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
	header( 'X-UA-Compatible: IE=edge,chrome=1' );
} ?>
<!doctype html>
<!--[if !IE]>
<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="<?php echo of_get_option( 'nav_bg_color' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>
<div id="page" class="hfeed site">

	<header class="main-header">
        <div class="google-translate">
            <div class="col-sm-6 hidden-xs">
                <div class="head-support">
                    <p>Support <a href="tel:+37254609000">+37254609000</a></p>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="google_translate_element"></div> 
            </div>
            <div class="clearfix"></div>
        </div>
        <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://www.xxsim.com"><img src="https://www.xxsim.com/front/images/logo.png" alt="logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav main-menu">
                <li><a href="https://www.xxsim.com">Home</a></li>
                <li><a href="https://www.xxsim.com/features">FEATURES</a></li>
                <li><a href="https://www.xxsim.com/about-internation-sim-card">ABOUT</a></li>
                <li><a href="https://www.xxsim.com/online-shop">ONLINE SHOP</a></li>
                <li><a href="https://www.xxsim.com/support">SUPPORT</a></li>
                <li><a href="https://www.xxsim.com/quick-start">QUICK START</a></li>
                <li><a href="https://www.xxsim.com#call-rates">RATES AND COVERAGE</a></li>
                <li class="active"><a href="<?php echo site_url();?>">BLOG</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right login-menu">
                                    <li><a href="https://www.xxsim.com/login"><img src="https://www.xxsim.com/front/images/log-in-arrow.png" alt="log-in-arrow"> <span>Log in / Register</span></a></li>
                                <!-- <li><a href="#"><img src="https://www.xxsim.com/front/images/comments.png" alt="comments"></img></a></li> -->
            </ul>
        </div>
    </div>
</nav>     </header>

	<div id="content" class="site-content">

		<div class="top-section">
			<?php sparkling_featured_slider(); ?>
			<?php sparkling_call_for_action(); ?>
		</div>

		<div class="container main-content-area">
			<?php $layout_class = get_layout_class(); ?>
			<div class="row <?php echo $layout_class; ?>">
				<div class="main-content-inner <?php echo sparkling_main_content_bootstrap_classes(); ?>">
