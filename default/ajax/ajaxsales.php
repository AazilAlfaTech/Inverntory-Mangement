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



function get_sales_order_item()
{
    include_once "../Sales_order/sales_order_item.php ";
    $sales_order_item1=new sales_orderitem();
    $sales_order_item1_list=$sales_order_item1->get_sales_orderitem_by_id ($_GET['sales_item']);
    echo json_encode($sales_order_item1_list);
}



?>