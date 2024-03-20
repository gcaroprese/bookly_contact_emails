<?php
if ( ! defined('ABSPATH')) exit('restricted access');

/* 
Content for Customer Emails Template
Creation Date: 15/12/2021
Last Update: 19/12/2021
Author: Gabriel Caroprese
*/

?>
<style>
.error, .updated, #setting-error-tgmpa{display: none! important;}

#ik_bklyemail_customers_list table{ 
    margin: 25px 0; 
}
#ik_bklyemail_customers_list{
    margin-top: 35px;
}
#ik_bklyemail_customers_list th, #ik_bklyemail_customers_list td {
    border: 1px solid #ccc;
    text-align: left;
    padding: 5px;
}
.ik-closetab{
    float: right;
    padding-left: 10px;
    position: relative;
    top: 1px;
}

#show-emailpanel .ik_show_results_search ul{
    background: #ccc;
    padding: 0;
    width: 100%;
    margin: 0 auto;
}
#show-emailpanel .ik_show_results_search ul li {
    margin-bottom: 0;
    padding: 5px 3px;
    cursor: pointer;
}
#show-emailpanel .ik_show_results_search ul li:hover{
    background: #ddd;
}

a.ik-closetab {
    position: absolute;
    top: 2px;
    font-size: 27px;
    right: 15px;
    color: #000;
    text-decoration: none;
    box-shadow: none;
}
.ik-closetab span{
    font-size: 35px;
}
.ik-showdshow div {
    min-width: 320px;
    text-transform: capitalize;
    display: flex;
}
.ik-show-email .ik-popup-username {
    display: none! important;
}
.ik-popup {
    position: fixed;
    min-width: 290px;
    background: #fff;
    left: 30%;
    padding: 2% 3%;
    z-index: 99999;
    top: 80px;
    min-height: 300px;
    border: 2px solid #000;
    border-radius: 7px;
}
.ik-popup h4{
    font-size: 20px;
    text-align: center;
    line-height: 1.2;
}
.ik-popup form{
    margin: 0 auto;
    display: block;
    text-align: center
}
.ik-popup input[type=submit], .sendquote, .btnchstatus, .btn-sendnotes {
    background: #000;
    padding: 6px;
    border-radius: 5px;
    display: block;
    margin: 0 auto;
    color: #fff;
    border: 0;
    min-width: 260px;
    cursor: pointer;
}
.ik-popup{
    max-height: 500px;
    overflow-y: auto;
    overflow-x: hidden;
}
.ik-popup.ik-additionalinfo h4 {
    text-align: left;
}
#show-emailpanel .ik_bklyemails_loading{
    text-align: center;
}
#show-emailpanel .ik_bklyemails_loading img{
    text-align: center;
    width: 70px;
    margin: 0 auto;
    display: block;
}
#show-emailpanel{
    width: 400px! important;
    height: 400px! important;
}
#show-emailpanel-selected {
    width: 400px! important;
    max-height: 320px! important;
    min-height: 200px;
}
#show-emailpanel .filter_email{
    margin-bottom: 35px;
}
#show-emailpanel input:not(.ik_bklyemails_checkbox), #show-emailpanel textarea, #show-emailpanel-selected input:not(.ik_bklyemails_checkbox), #show-emailpanel-selected textarea {
    width: 100%;
}
#show-emailpanel textarea, #show-emailpanel-selected textarea {
    height: 120px;
}
#show-emailpanel .message-sent, #show-emailpanel-selected .message-sent{
    text-align: center;
    font-size: 20px;
    margin-top: 40px;
    line-height: 1.2;
}
#show-emailpanel .filter_email select{
    width: 200px;
}
#show-emailpanel .select_list_customers{
    width: 16px! important;
}
#monthsperiod-form input, #monthsperiod-form button{
    min-height: 20px;
}
#monthsperiod-form button{
    position: relative;
    top: 1px;
    line-height: 1;
}
.ik_bklyemail_panel_buttons{
    display: inline-flex;
}
#monthsperiod-form {
    position: relative;
    top: -1px;
}
#monthsperiod-form input, #monthsperiod-form button {
    min-height: 20px;
    height: 29px;
    padding: 5px 12px;
}
#monthsperiod-form input::-webkit-outer-spin-button,
#monthsperiod-form input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

#monthsperiod-form input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
#monthsperiod-form button span{
    line-height: 1.2;
    font-size: 15px;
}
#monthsperiod-form input[type=number] {
    max-width: 45px;
    position: relative;
    top: 1px;
    text-align: center;
    margin-left: 20px;
}
@media (max-width: 767px){
    .ik-popup {
        left: 0;
        max-width: 300px;
    }
    .ik-popup legend strong{
        line-height: 3;
    }
}
.ik_pagination_bklyemails{
    margin: 25px;
    max-width: 70%;
    display: block;
}
.ik_pagination_bklyemails a {
    margin: 8px;
    display: inline-block;
    text-decoration: none;
    color: #000;
    font-size: 17px;
}
a.actual_page {
    color: #0073aa! important;
    font-weight: bold;
}
.fullname{
    text-transform: capitalize;
}
.ik_bklyemails_nothing_found{
    text-align: center;
    padding-top: 50px;
    font-size: 26px;
}
#ik_bklyemail_customers_list .emails_count{
    margin-top: 25px;
    margin-left: 3px;
}
#show-emailpanel .body-test{
    margin-top: 40px;
}
#ik_bklyemails_send_test_email{
    position: relative;
    top: -1px;
}
#ik_bklyemails_test_email{
    max-width: 64%;
    height: 30px;
    min-height: 30px;
}
#ik_bklyemails_send_test_email img, #ik_bklyemails_download_emails img{
    width: 20px;
    position: relative;
    top: 5px;
}
#result_test_email span{
    background: #f1f1f1;
    padding: 7px;
    border-radius: 7px;
    margin-left: 1px;
}
#ik_email_option_radio label{
    display: block;
}
#ik_email_option_radio input[type=radio]{
    width: 15px;
    height: 15px;
    position: relative;
    top: 1px;
    left: 3px;
}
#ik_email_option_radio input[type=radio]:before{
    margin: 2.3px 2.8px;
}
</style>
<?php
    //Quantity of customers to list
    $customersListed = 50;

    // I get the value from the pagination number from URL if that exists
    if (isset($_GET["listing"])){
        // I check if value is integer to avoid errors
        if (strval($_GET["listing"]) == strval(intval($_GET["listing"])) && $_GET["listing"] > 0){
            $paged = intval($_GET["listing"]);
        } else {
            $paged = 1;
        }
    } else {
         $paged = 1;
    }

    
// I show button to search users    

// if search form was submited
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if (isset($_POST['months_collect'])){
        $months_to_collect = absint($_POST['months_collect']);
        update_option('ik_bklyemail_months_collect', $months_to_collect);
    }
        
}

?>
<div class="ik-popup" id="show-emailpanel" style="display:none">
            <a class="ik-closetab" href="#" onclick="ik_closewindow()"><span class="dashicons dashicons-dismiss"></span></a>
    <h4>Send Message To Recent Customers</h4>
    <div class="body-email">
        <p><input type="text" id="ik_bklyemails_subject_email" placeholder="Subject"></p>
        <p></p><textarea id="ik_bklyemails_message_email" placeholder="Message (it accepts basic HTML)"></textarea></p>
        <button class="button-primary" id="ik_bklyemails_send_email">Send</button>
    </div>
    <div class="body-test">
        <p><input type="email" id="ik_bklyemails_test_email" name="email"><button class="button-primary" id="ik_bklyemails_send_test_email">Send Test Email <img class="loading_button" style="display:none;" src="<?php echo BKLYEMAILS_PLUGIN_PUBLIC.'/images/loading.gif'; ?>" /></button></p>
        <p id="result_test_email"></p>
    </div>
</div>
<div id="ik_bklyemail_customers_list">
<div class="ik_bklyemail_panel_buttons wrap">
    <a class="button-primary ik_search_btn" href="#" id="ik_email_customers">Send Emails</a><form method="post" action="" id="monthsperiod-form"><input type="number" name="months_collect" value="<?php echo ik_bklyemails_months_collect_value(); ?>"><button type="submit" class="button"><span class="dashicons dashicons-image-rotate"></span></button> months period. </form>
</div>
<?php   


//I list customers from recent months
echo ik_bklyemails_customers_list($customersListed, $paged);

?>
</div>
<script>

//opens the popup to send emails to customers
jQuery('body').on('click', '#ik_email_customers', function(){
    ik_closewindow();
    jQuery("#show-emailpanel .message-sent").remove();
    jQuery('#show-emailpanel .ik_bklyemails_loading').remove();
    jQuery("#show-emailpanel .body-email").attr("style","display:block;");
    jQuery("#show-emailpanel .body-test").attr("style","display:block;");
    jQuery("#show-emailpanel").attr("style","display:block;");
    
    return false;
});

// function to close popups and only show one at a time
function ik_closewindow(){
    jQuery(".ik-popup").attr("style","display:none;");
}

//Function to send emails to customers
jQuery(document).on('click', '#ik_bklyemails_send_email', function(){
    var bklyemails_subject = jQuery('#ik_bklyemails_subject_email').val();
    var bklyemails_message = jQuery('#ik_bklyemails_message_email').val();

    var confirmation_text_emails = "Are you sure to send this email?";
    var message_process_email = "Your message is being sent...";
    
    
    if (isNaN(bklyemails_subject) === false || isNaN(bklyemails_message) === false){
        alert('Complete the required fields.');
    } else {
        
        //I confirm sending the email
        if (confirm(confirmation_text_emails)){
            //I hide the fields
            jQuery('#show-emailpanel .body-email').attr('style','display: none');
            jQuery('#show-emailpanel .body-test').attr('style','display: none');
            
            //Loading screen
            jQuery('#show-emailpanel').attr('style','display:block;max-height: 19px! important;min-height: 200px;');
            jQuery('<div class="ik_bklyemails_loading"><img src="<?php echo BKLYEMAILS_PLUGIN_PUBLIC.'/images/loading.gif'; ?>" alt="loading" />'+message_process_email+'</div>').insertAfter('#show-emailpanel .body-email');
            
            //I delete the fields data inserted
            jQuery('#ik_bklyemails_subject_email').val('');
            jQuery('#ik_bklyemails_message_email').val('')
            
            
            var data = {
                action: "ik_bklyemails_ajax_sendemail_customers",
                "post_type": "post",
                "bklyemails_subject": bklyemails_subject,
                "bklyemails_message": bklyemails_message,
            };  
        
            // The variable ajax_url should be the URL of the admin-ajax.php file
            jQuery.post( "<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
                    if (response){
                        jQuery('#show-emailpanel .ik_bklyemails_loading').remove();
                        jQuery('<div class="message-sent">'+response+'</div>').insertAfter('#show-emailpanel .body-email');
                    }
            }, "json");    
        }
    }
    
});

//Function to validate email for test
function ValidateEmail(input) {
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (input.match(validRegex)) {
        return true;

    } else {

        return false;
    }
}

//Function to send test email
jQuery(document).on('click', '#ik_bklyemails_send_test_email', function(){
    var bklyemails_testemail = jQuery('#ik_bklyemails_test_email').val();
    var bklyemails_subject = jQuery('#ik_bklyemails_subject_email').val();
    var bklyemails_message = jQuery('#ik_bklyemails_message_email').val();
    
    var validsend = true;
    
    if (isNaN(bklyemails_subject) === false || isNaN(bklyemails_message) === false || isNaN(bklyemails_testemail) === false){
        alert('Complete the required fields.');
        var validsend = false;
    } else if (ValidateEmail(bklyemails_testemail) == false){
        alert('Incorrect Email Address.');
        var validsend = false;
    }
    
    if (validsend == true){
            
        jQuery('#ik_bklyemails_send_test_email').prop('disabled', true);
        jQuery('#ik_bklyemails_send_test_email .loading_button').fadeIn(600);
            
        var data = {
            action: "ik_bklyemails_ajax_send_test_email",
            "post_type": "post",
            "bklyemails_subject": bklyemails_subject,
            "bklyemails_message": bklyemails_message,
            "bklyemails_testemail": bklyemails_testemail,
        };  
    
        // The variable ajax_url should be the URL of the admin-ajax.php file
        jQuery.post( "<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
                if (response){
                    jQuery('#ik_bklyemails_send_test_email .loading_button').fadeOut(600);
                    jQuery('#result_test_email').attr('style', 'display: block');
                    setTimeout(function(){
                    jQuery('#result_test_email').html('<span>Test Email Sent</span>');
                    jQuery('#ik_bklyemails_send_test_email').prop('disabled', false);
                        setTimeout(function(){ 
                            jQuery('#result_test_email').fadeOut(600);
                            jQuery('#result_test_email').empty();
                            
                        }, 2000);
                    }, 700);
                }
        }, "json");    
    }
    
});

//Function to create a download CSV file with emails of recent customers
jQuery(document).on('click', '#ik_bklyemails_download_emails', function(){
    
    var downloadOrder = true;
    
    jQuery('#ik_bklyemails_download_emails').prop('disabled', true);
    jQuery('#ik_bklyemails_download_emails .loading_button').fadeIn(600);
        
    var data = {
        action: "ik_bklyemails_ajax_get_csv_emails_list",
        "post_type": "post",
        "downloadOrder": downloadOrder,
    };  

    // The variable ajax_url should be the URL of the admin-ajax.php file
    jQuery.post( "<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
            if (response){
                jQuery('#ik_bklyemails_download_emails_list').append(response);
                jQuery('#ik_bklyemails_download_emails .loading_button').fadeOut(600);
                exportTableToCSV('recent_customers<?php echo strtotime(date('Y-m-d H:i:s')); ?>.csv');
                setTimeout(function(){
                    jQuery('#ik_bklyemails_download_emails').prop('disabled', false);
                    jQuery('#ik_bklyemails_download_emails_list').empty();
                }, 1500);
            }
    }, "json");
    
});

function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob(["\uFEFF"+csv], {type: 'text/csv; charset=utf-18'});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#ik_bklyemails_download_emails_list table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
</script>