<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* 
Ajax Functions
Creation Date: 15/12/2021
Last Update: 19/12/2021
Author: Gabriel Caroprese
*/


//Function to send test email
add_action( 'wp_ajax_ik_bklyemails_ajax_send_test_email', 'ik_bklyemails_ajax_send_test_email');
function ik_bklyemails_ajax_send_test_email(){
    
    //If any error
    $result = 'Error.';

    //I make sure the fields were sent
    if(isset($_POST['bklyemails_subject']) && isset($_POST['bklyemails_message']) && isset($_POST['bklyemails_testemail'])){
        $subject = sanitize_text_field($_POST['bklyemails_subject']);
        $email_test = sanitize_email($_POST['bklyemails_testemail']);
        
        // HTML tags enabled for HTML
        $html_filter = array(
                            'a' => array(
                            'href' => array(),
                            'target' => array(),
                            ),
                            'br' => array(),
                            'p' => array(
                                'style' => array(
                                    'text-align' => array(),
                                    'font-size' => array(),
                                    'font-weight' => array(),
                                    'font-style' => array(),
                                    'background' => array(),
                                    ),
                                ),
                            'div' => array(
                                'style' => array(
                                    'text-align' => array(),
                                    'font-size' => array(),
                                    'font-weight' => array(),
                                    'font-style' => array(),
                                    'background' => array(),
                                    ),
                                ),
                            'strong' => array(),
                            'b' => array(),
                            'img' => array(
                                'src' => array(),
                                'alt' => array(),
                                'width' => array(),
                                'height' => array(),
                                ),
                    );
                    
        $message = wp_kses($_POST['bklyemails_message'], $html_filter );
        $message = str_replace("\\", "", $message);
            

        //Send email
        $to = $email_test;
        $subject = $subject;
        $body = $message;
        $headers = array('Content-Type: text/html; charset=UTF-8');
     
        wp_mail( $to, $subject, $body, $headers );  
          
        echo json_encode( $result );

    } else {
        echo json_encode( $result );
    }
    wp_die();         
}

//Function to send emails to recent customers
add_action( 'wp_ajax_ik_bklyemails_ajax_sendemail_customers', 'ik_bklyemails_ajax_sendemail_customers');
function ik_bklyemails_ajax_sendemail_customers(){
    
    //If any error
    $result = 'Error.';

    //I make sure the fields were sent
    if(isset($_POST['bklyemails_subject']) && isset($_POST['bklyemails_message'])){
        $subject = sanitize_text_field($_POST['bklyemails_subject']);
        
        // HTML tags enabled for HTML
        $html_filter = array(
                            'a' => array(
                            'href' => array(),
                            'target' => array(),
                            ),
                            'br' => array(),
                            'p' => array(
                                'style' => array(
                                    'text-align' => array(),
                                    'font-size' => array(),
                                    'font-weight' => array(),
                                    'font-style' => array(),
                                    'background' => array(),
                                    ),
                                ),
                            'div' => array(
                                'style' => array(
                                    'text-align' => array(),
                                    'font-size' => array(),
                                    'font-weight' => array(),
                                    'font-style' => array(),
                                    'background' => array(),
                                    ),
                                ),
                            'strong' => array(),
                            'b' => array(),
                            'img' => array(
                                'src' => array(),
                                'alt' => array(),
                                'width' => array(),
                                'height' => array(),
                                ),
                    );
                    
        $message = wp_kses($_POST['bklyemails_message'], $html_filter );
        $message = str_replace("\\", "", $message);
            
        // I check if there are customers to send email
        
        //args to list customers
    	$args = array(
    	    'quantity'=> 700, //That's a limit to avoid spam
    	    'page'=> 1,
    	    );
        
         $customers_data = ik_bklyemails_retrieve_customers_data($args);

        
        if (isset($customers_data['details'])){

            //I send emails
            $countSentMessages = 0;

            foreach ($customers_data['details'] as $customer_data){
                
                if ($customer_data['email'] != ''){

                    //Send email
                    $to = $customer_data['email'];
                    $subject = $subject;
                    $body = $message;
                    $headers = array('Content-Type: text/html; charset=UTF-8');
                 
                    wp_mail( $to, $subject, $body, $headers );  
                    
                    $countSentMessages = $countSentMessages + 1;
                
                }
            
            }
            
        } else {
            echo json_encode( $result );
        }
    
        //Message sent sequence ran
        if (isset($countSentMessages)){
            if ($countSentMessages == 0){
                $result = 'Message not sent.';
            } else if ($countSentMessages == 1){
                $result = 'Message sent to 1 customer.';
            } else {
                $result = 'Message sent to '.$countSentMessages.' customers.';
            }
        } else {
            $result = 'Message not sent';
        }
        
        echo json_encode( $result );
        
        
    } else {
        echo json_encode( $result );
    }
    wp_die();         
}

//Function to get a csv table list to download recent customers to a CSV file
add_action( 'wp_ajax_ik_bklyemails_ajax_get_csv_emails_list', 'ik_bklyemails_ajax_get_csv_emails_list');
function ik_bklyemails_ajax_get_csv_emails_list(){
    
    $emailsTable = '';
    
    if (isset($_POST['downloadOrder'])){

        //args to list customers
    	$args = array(
    	    'quantity'=> 1000, //That's a limit to avoid time outs
    	    'page'=> 1,
    	    );
        
         $customers_data = ik_bklyemails_retrieve_customers_data($args);       
        
        if (isset($customers_data['details'])){

            //I send emails
            $countEmails = 0;
            $emailsList = '<table><tr><th>Emails</th></tr>';
            foreach ($customers_data['details'] as $customer_data){
                
                if ($customer_data['email'] != ''){

                    $emailsList .= '<tr><td>'.$customer_data['email'].'</td></tr>';
                    
                    $countEmails = $countEmails + 1;
                
                }
            
            }
            $emailsList .= '</table>';
            
            if ($countEmails > 0){
                
                $emailsTable = $emailsList;
            }
        }
        
    }
    echo json_encode( $emailsTable );
    wp_die();   
}
?>