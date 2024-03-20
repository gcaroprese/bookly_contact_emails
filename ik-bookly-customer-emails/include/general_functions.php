<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* 
General Functions
Creation Date: 15/12/2021
Last Update: 19/12/2021
Author: Gabriel Caroprese
*/

//Function to get value of months since customer activity to retrieve customer info from that date
function ik_bklyemails_months_collect_value(){
    global $wpdb;
    $months_collect = get_option('ik_bklyemail_months_collect');

    if ($months_collect != NULL && $months_collect != false && $months_collect > 0){
        $months = $months_collect;
    } else {
        $months = BKLYEMAILS_CUSTOMER_PERIOD;
    }
    return $months;
}

function ik_bklyemails_retrieve_customers_data($args){
    
    if (isset($args['quantity'])){
        $qty = absint($args['quantity']);
        if ($qty < 1){
            $qty = 50;
        }
    } else {
        $qty = 50;
    }

    if (isset($args['page'])){
        $page = absint($args['page']);
        if ($page < 1){
            $page = 1;
        }
    } else {
        $page = 1;
    }

    $offset = $page - 1;
    $base = $offset*$qty;
    $limit = $qty*$page;

    //The amount of time since customer activity to get customers emails
    $timemonths = ik_bklyemails_months_collect_value();
    
    //I make sure the months value is not less than 1 month
	if ($timemonths < 1){
	    $timemonths = 1;
	}
    
	$where = " WHERE created_at > DATE_SUB(now(), INTERVAL ".$timemonths." MONTH) ";
	
	
    
    //I check the total number of appointment from the last $timemonths months
	global $wpdb;
	$query_appointments = "SELECT customer_id FROM ".$wpdb->prefix."bookly_customer_appointments".$where." ORDER BY 'id'";
	$appointments = $wpdb->get_results($query_appointments);
	
	if (isset($appointments[0]->customer_id)){
	    //I create an array of customer IDs from the last x months with its main data

	    $details_count = 0;
	    $emails_found = 0;
	    foreach ($appointments as $appointment){

	        //I make sure I don't process repeated customer IDs
	        if (!isset($customer_ids[$appointment->customer_id])){
    	        $customer_ids[$appointment->customer_id] = true;
    	        
            	global $wpdb;
            	$query_customers = "SELECT * FROM ".$wpdb->prefix."bookly_customers WHERE id=".$appointment->customer_id;
            	$customers = $wpdb->get_results($query_customers);

    	        if (isset($customers[0]->id)){
    	            if ($details_count >= $base && $details_count <= $limit){
        	            $customers_details[] = array(
                            'id'=> $customers[0]->id,
                            'first_name'=> $customers[0]->first_name,
                            'full_name'=> $customers[0]->full_name,
                            'phone'=> $customers[0]->phone,
                            'email'=> $customers[0]->email
        	            );
        	            
    	           }
	 
	               if ($customers[0]->email != ''){
    	                $emails_found = $emails_found + 1;
    	           }

    	           $details_count = $details_count + 1;
    	           
    	        }
	        }
	    }
	    
	    if (isset($customers_details)){
    	    //I order customers by full name
    	    $column_fullname = array_column($customers_details, 'full_name');
            array_multisort($column_fullname, SORT_ASC, $customers_details);   
            
            $data['total'] = $details_count;
            $data['emails'] = $emails_found;
            $data['details'] = $customers_details;
            
            return $data;
	    }
	}
	
	return false;
}


function ik_bklyemails_customers_list($qty = 50, $page = 1){
    $qty = absint($qty);
    $page = absint($page);
	
    //args to list customers
	$args = array(
	    'quantity'=> $qty,
	    'page'=> $page,
	    );
	

    $table_head = '
		<table>
				<thead>
					<tr>
						<th>Full Name</th>
						<th>Phone</th>
						<th>Email</th>
					</tr>
				</thead>
			<tbody>';
			
	$table_foot = '</tbody>
			    <tfoot>
					<tr>
						<th>Full Name</th>
						<th>Phone</th>
						<th>Email</th>
					</tr>
				</tfoot>
				<tbody>
			</table>';
			
	//if nothing is found to list
	
	
	if ($page == 1){
	    $customer_list = $table_head.'<tr id="ik_armember_editor_dyn_data" class="ik_armember_editor_data"><td colspan="5"><p>Nothing Found</p></td></tr>'.$table_foot;
	} else {
	    $customer_list = '<script> window.location.replace("'.get_site_url().'/wp-admin/admin.php?page=ik_bklyemails_customer_emails_template");</script>';
	}
    
    

    $customers_data = ik_bklyemails_retrieve_customers_data($args);

    
    if (isset($customers_data['details'])){

		$emails_total = $customers_data['emails'];

		$customer_list = '<div style="display: none" id="ik_bklyemails_download_emails_list"></div><p class="emails_count">Emails Found: '.$emails_total.'<br /><button class="button" id="ik_bklyemails_download_emails">Download Emails <img class="loading_button" style="display:none;" src="'.BKLYEMAILS_PLUGIN_PUBLIC.'/images/loading.gif" /></button></p>'.$table_head;
		
	    foreach ($customers_data['details'] as $customer_data){
	            
				$customer_list.= '
				<tr user_id="'.$customer_data['id'].'">
					<td class="fullname">'.$customer_data['full_name'].'</td>
					<td>'.$customer_data['phone'].'</td>
					<td>'.$customer_data['email'].'</td>
				</tr>';			
	    }
	    
		$customer_list.= $table_foot;
			
		if ($page > 0){
		    $listing_total = $customers_data['total'];
			$total_pages = intval($listing_total / $qty);

            if ($listing_total > $qty && $page <= $total_pages){
                $customer_list.= '<div class="ik_pagination_bklyemails">';
                
                //If there are a lot of pages
                if ($total_pages > 11){
                    $almostlastpage1 = $total_pages - 1;
                    $almostlastpage2 = $total_pages - 2;
                    $halfpages1 = intval($total_pages/2);
                    $halfpages2 = intval($total_pages/2)-1;
                    
                    $listing_limit = array('1', '2', '3', $page, $halfpages2, $halfpages1, $almostlastpage2, $almostlastpage1, $total_pages);
                    
                    $pages_limited = true;
                } else{
                    $listing_limit[0] = false;
                    $pages_limited = false;
                }
                $arrowprevious = $page - 1;
                $arrownext = $page + 1;
                
                $page_url = get_site_url().'/wp-admin/admin.php?page=ik_bklyemails_customer_emails_template';
                
                
                if ($arrowprevious > 1){
                    $customer_list.= '<a href="'.$page_url.'&listing='.$arrowprevious.'"><</a>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    $showpage = true;
                    
                    if ($pages_limited == true && !in_array($i, $listing_limit)){
                        $nextpage = $page+1;
                        $beforepage = $page - 1;
                        if ($page != $i && $nextpage != $i && $beforepage != $i){
                            $showpage = false;
                        }
                    }
                    
                    if ($showpage == true){
                        if ($page == $i){
                            $selectedPageN = 'class="actual_page"';
                        } else {
                            $selectedPageN = "";
                        }
                        
                        $customer_list.= '<a '.$selectedPageN.' href="'.$page_url.'&listing='.$i.'">'.$i.'</a>';
                        
                    }
                    
                }
                if ($arrownext < $total_pages){
                    $customer_list.= '<a href="'.$page_url.'&listing='.$arrownext.'">></a>';
                }
                $customer_list.= '</div>';
        	}
		}

    	    
    }
    
    return $customer_list;
}

?>