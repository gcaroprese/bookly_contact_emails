<?php
/*
Plugin Name: Bookly Emails to Customers
Plugin URI: https://inforket.com/
Description: Check customers from a certain period of time to send them notifications by email
Version: 1.2.2
Author: Gabriel Caroprese
Author URI: https://inforket.com/
Requires at least: 5.3
Requires PHP: 7.3
*/ 

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$bklyemailsDir = dirname( __FILE__ );
$bklyemailsPublicDir = plugin_dir_url(__FILE__ );
define( 'BKLYEMAILS_PLUGIN_DIR', $bklyemailsDir);
define( 'BKLYEMAILS_PLUGIN_PUBLIC', $bklyemailsPublicDir);
define( 'BKLYEMAILS_CUSTOMER_PERIOD', 6 );


require_once($bklyemailsDir . '/include/init.php');
require_once($bklyemailsDir . '/include/general_functions.php');
require_once($bklyemailsDir . '/include/ajax_functions.php');

?>