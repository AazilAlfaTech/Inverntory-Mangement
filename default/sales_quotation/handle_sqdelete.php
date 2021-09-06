<?php
include_once "../sales_quotation/sales_quatation_item.php";
$sq_item5 = new sales_quotationitem();
if(isset($_POST['id'])){
    $res_1=$sq_item5-> delete_sqitem($_POST['id']);

}

?>