<?php
$T=$_GET["type"];
$T();

function get_sales_order_of_customer()
{
    include_once "../Sales_order/sales_order.php";
    $Sales_order1=new sales_order();
    $Sales_order1_list=$Sales_order1->get_sales_order_by_customer ($_GET['customerselect']);
    echo json_encode($Sales_order1_list);
}


?>