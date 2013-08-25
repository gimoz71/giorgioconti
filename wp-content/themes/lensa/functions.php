<?php
/*-----------------------------------------------------------------------------------*/
/* Start ColorLabs Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/
error_reporting(1);

// Set path to ColorLabs Framework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// ColorLabs Admin
require_once ($functions_path . 'admin-init.php');			// Admin Init

// ColorLabs Includes
require_once ($includes_path . 'theme-js.php');
require_once ($includes_path . 'theme-functions.php');
require_once ($includes_path . 'theme-options.php');
require_once ($includes_path . 'theme-widgets.php');
require_once ($includes_path . 'theme-sidebar-init.php');
require_once ($includes_path . 'theme-custom-type.php');
require_once ($includes_path . 'theme-comments.php');


if ( ! isset( $content_width ) ) $content_width = 978;
?>
