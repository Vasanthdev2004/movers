<?php 
require dirname( dirname(__FILE__) ).'/inc/config.php';
require dirname( dirname(__FILE__) ).'/inc/FunctionQuery.php';
require dirname( dirname(__FILE__) ).'/inc/keyvaliation.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['owner_id'] == '' or $data['amt'] == '' or $data['r_type'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$owner_id = $data['owner_id'];
	$amt = $data['amt'];
	$r_type = $data['r_type'];
	$acc_number = $data['acc_number'];
	$bank_name = $data['bank_name'];
	$acc_name = $data['acc_name'];
	$ifsc_code = $data['ifsc_code'];
	$upi_id = $data['upi_id'];
	$paypal_id = $data['paypal_id'];
	
	$total_earn            = $service->query("select sum((total_amt) - ((total_amt) * commission/100)) as total_amt from tbl_load where lorry_owner_id=" . $owner_id . " and load_status ='Completed'")->fetch_assoc();
    $total_earns           = empty($total_earn['total_amt']) ? "0" : number_format((float) ($total_earn['total_amt']), 2, '.', '');
	
	$total_payout          = $service->query("select sum(amt) as total_payout from payout_setting where owner_id=" . $owner_id . "")->fetch_assoc();
    $receive_payout        = empty($total_payout['total_payout']) ? "0" : number_format((float) ($total_payout['total_payout']), 2, '.', '');
	$final_earn            = number_format((float) ($total_earns) - $receive_payout, 2, '.', '');
	
                
				
				
				 
				 
				 
				 if(floatval($amt) > floatval($set['pstore']))
				 {
					$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You can't Withdraw Above Your Withdraw Limit!"); 
				 }
				 else if(floatval($amt) > floatval($final_earn))
				 {
					 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You can't Withdraw Above Your Earning!"); 
				 }
				 else 
				 {
					 $timestamp = date("Y-m-d H:i:s");
					 $table="payout_setting";
  $field_values=array("owner_id","amt","status","r_date","r_type","acc_number","bank_name","acc_name","ifsc_code","upi_id","paypal_id");
  $data_values=array("$owner_id","$amt","pending","$timestamp","$r_type","$acc_number","$bank_name","$acc_name","$ifsc_code","$upi_id","$paypal_id");
  
      $h = new FunctionQuery($service);
	  $check = $h->serviceinsertdata_Api($field_values,$data_values,$table);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout Request Submit Successfully!!");
				 }
}
echo json_encode($returnArr);
?>