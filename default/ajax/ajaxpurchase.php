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
    $result_stock=$grn_item2->item_remaining_stock_productid($_GET['prodid'],$_GET['loc_id']);
    echo json_encode($result_stock);
}

function get_prod_byloc()
{
    include_once "../GRN/grn.php";
    $grn_item3= new grn_item();
    $result_prod=$grn_item3->grnitem_by_loc($_GET['loc_id']);
    echo json_encode($result_prod);

}
function get_productbatchby_prodid()
{
    include_once "../GRN/grn_item.php";
    $grn_item4= new grn_item();
    $result_prodbatch=$grn_item4->get_prodbatch_byprod($_GET['prodid']);
    echo json_encode($result_prodbatch);
}

function get_productqty_prodbatch()
{
    include_once "../GRN/grn_item.php";
    $grn_item5= new grn_item();
    $result_prodqty=$grn_item5->get_grnqty_byprodbatch($_GET['prod_batch']);
    echo json_encode($result_prodqty);
}
?>