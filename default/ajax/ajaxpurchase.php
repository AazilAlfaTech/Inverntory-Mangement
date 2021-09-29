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

function get_sum_remainingqty(){
    include_once "../GRN/grn_item.php";
    $grn_item2= new grn_item();
    $result_stock=$grn_item2->item_remaining_stock_productid($_GET['prodid']);
    echo json_encode($result_stock);
}


?>