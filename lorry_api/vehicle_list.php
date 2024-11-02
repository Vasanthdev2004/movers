<?php 
require dirname( dirname(__FILE__) ).'/inc/config.php';
require dirname( dirname(__FILE__) ).'/inc/keyvaliation.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $uid = strip_tags(mysqli_real_escape_string($service,$data['uid']));
    
    
$check = $service->query("select * from tbl_vehicle where status=1");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}
$returnArr = array("VehicleData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Vehicle List Get Successfully!!");
}
echo json_encode($returnArr);