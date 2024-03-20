<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* 
Init Functions
Creation Date: 15/12/2021
Last Update: 17/12/2021
Author: Gabriel Caroprese
*/

// I add menus on WP-admin
add_action('admin_menu', 'ik_bklyemails_wpmenu', 99);
function ik_bklyemails_wpmenu(){
    add_submenu_page('bookly-menu', 'Customer Emails', 'Customer Emails', 'manage_options', 'ik_bklyemails_customer_emails_template', 'ik_bklyemails_customer_emails_template', 3 );
}

function ik_bklyemails_customer_emails_template(){
    echo '<h1>Recent Customer Emails</h1>';
    include (BKLYEMAILS_PLUGIN_DIR.'/templates/customer-emails.php');
}