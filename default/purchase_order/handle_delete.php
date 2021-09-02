<?php
include_once "../purchase_order/purchaseorderitem.php";
$PO_item5 = new purchaseorderitem();
if(isset($_POST['id'])){
    $res_1=$PO_item5-> delete_POitem($_POST['id']);

}

?>