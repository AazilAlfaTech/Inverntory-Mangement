<?php
$T=$_GET["type"];
$T();


function getpurchaserequestbyid(){
    include_once "../purchase_requisition/purchase_requisition.php";
    $purchaserequest3=new purchaserequest();
    $result_PR=$purchaserequest3->get_purchaserequest_by_id($_GET['puchase_req_id']);
    echo json_encode($result_PR);
}

function getpurchaserequestitem(){
    include_once "../purchase_requisition/purchase_requestitem.php";
    $purchasereq_item=new purchase_request_item();
    $result_PRitem=$purchasereq_item->get_all_item_by_requestid($_GET['requestid']);
    echo json_encode($result_PRitem);
}


?>