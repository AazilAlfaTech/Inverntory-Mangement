<?php
include_once "../sales_order/sales_order_item.php";
$sales_orderitem3=new sales_orderitem();
if(isset($_POST['id'])){
    $res_1=$sales_orderitem3->delete_sales_orderitem($_POST['id']);

}




?>