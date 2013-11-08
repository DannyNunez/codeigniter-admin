<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/******************************SETTING SITE WIDE VARIABLES********************************/

// Site Name - Used for Templates
$config['site_name'] = '';
$config['meta_author'] = '';
$config['meta_description'] = '';
$config['meta_google_plus'] = '';
$config['meta_keywords'] = 'PHP ROCKS!';

// Set URL 
$config['root_url'] = '';

$config['sub-directory'] = '';


// Set root directory 
$config['root_path'] = $_SERVER['DOCUMENT_ROOT'] . '';

//Set Javascript files to load from CDN
$config['theme_jscdn'] = array('jquery', 'jqueryui');
//Set Javascript files to load
$config['theme_js'] = array('bootstrap.min.js','jquery-ui-timepicker-addon.js');
//Set CSS files to load
$config['theme_css'] = array('bootstrap-combined.no-icons.min.css','font-awesome.css','styles.css');

//----------------------------------------------------------------------------------------------------------------------------------------------
//  Admin Theme specific JS and CSS files to load
//----------------------------------------------------------------------------------------------------------------------------------------------

//Set Javascript files to load
$config['admin_theme_js'] = array('bootstrap.min.js','jquery-ui-timepicker-addon.js' );
//Set CSS files to load
$config['admin_theme_css'] = array('bootstrap-combined.no-icons.min.css','font-awesome.css','styles.css');

/* * SET THEME VARIABLES* */

$config['theme'] = 'poster';
$config['theme_path_home'] = 'theme/' . $config['theme'] . '/pagetypes/home';
$config['theme_path_left_siderbar'] = 'theme/' . $config['theme'] . '/pagetypes/left-sidebar';
$config['theme_path_right_sidebar'] = 'theme/' . $config['theme'] . '/pagetypes/right-sidebar';
$config['theme_path_three_column'] = 'theme/' . $config['theme'] . '/pagetypes/three-column';
$config['theme_header'] = 'theme/' . $config['theme'] . '/elements/header';
$config['theme_footer'] = 'theme/' . $config['theme'] . '/elements/footer';
$config['meta_analytics'] = 'theme/' . $config['theme'] . '/elements/analytics';

/** PARTIALS * */

$config['theme_right_side_bar'] = 'theme/' . $config['theme'] . '/partials/right-sidebar';
$config['theme_left_side_bar_menu'] = 'theme/' . $config['theme'] . '/partials/left-sidebar-menu';
$config['theme_top_nav'] = 'theme/' . $config['theme'] . '/partials/nav';
$config['theme_main_ad'] = 'theme/' . $config['theme'] . '/partials/main-ad';
$config['theme_sidebar_ad'] = 'theme/' . $config['theme'] . '/partials/sidebar-ad';
$config['theme_disqus'] = 'theme/' . $config['theme'] . '/partials/disqus';
$config['theme_disqus_count'] = 'theme/' . $config['theme'] . '/partials/disqus-count';

/* * SET ADMIN THEME VARIABLES* */

$config['admin_theme'] = 'admin';
$config['admin_theme_path'] = 'theme/' . $config['admin_theme'] . '/home';
$config['admin_theme_header'] = 'theme/' . $config['admin_theme'] . '/elements/header';
$config['admin_theme_footer'] = 'theme/' . $config['admin_theme'] . '/elements/footer';

/** PARTIALS * */
$config['admin_left_side_bar'] = 'theme/' . $config['admin_theme'] . '/nav/left-sidebar';
$config['admin_top_nav'] = 'theme/' . $config['admin_theme'] . '/nav/nav';