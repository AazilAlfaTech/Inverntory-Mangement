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
    $sales_order_item1_list=$sales_order_item1->get_all_sales_orderitem ($_GET['sales_item']);
    echo json_encode($sales_order_item1_list);
}

function get_pricelevels(){
    include_once "../product/pricelevel.php";
    $pricelevelitem=new pricelevel();
    $pricelevelitemlist=$pricelevelitem->getall_pricelevel_id_product($_GET['productid']);
    echo json_encode($pricelevelitemlist);
}

function get_sales_invoice_of_customer(){
    include_once "../sales_invoice/sales_invoice.php";
    $salesinvoice3=new sales_invoice();
    $salesinvoice3_item=$salesinvoice3->get_all_sales_invoice_bycustomer($_GET['invoicecustomer']);
    echo json_encode($salesinvoice3_item);

}

function get_sales_invoice_item(){
    include_once "../sales_invoice/sales_invoice_item.php";
    $salesinvoiceitem3=new sales_invoice_item();
    $salesinvoiceitem3_item=$salesinvoiceitem3->get_all_sales_invoice_invoiceid($_GET['invoiceid']);
    echo json_encode($salesinvoiceitem3_item);
}

?>