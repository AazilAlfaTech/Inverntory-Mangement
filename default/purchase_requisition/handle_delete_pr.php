<?php
include_once "../purchase_requisition/purchase_request_item.php";
$PR_item5 = new purchase_request_item();
if(isset($_POST['id'])){
    $res_1=$PR_item5-> delete_PRitem($_POST['id']);

}