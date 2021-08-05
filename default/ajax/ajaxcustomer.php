<?php
$T=$_GET["type"];
$T();

function checkcustomergroupcode(){
    include_once "../customer_group/customer_group.php";
    $customer_group1=new customergroup();
    $customergroup_item=$customer_group1->get_customer_group_by_code($_GET['cus_groupcode']);
    echo json_encode($customergroup_item);

}

function checkcustomergroupname(){
    include_once "../customer_group/customer_group.php";
    $customer_group1=new customergroup();
    $customergroup_item=$customer_group1->get_customer_group_by_name($_GET['cus_groupcode']);
    echo json_encode($customergroup_item);

}

// function checkcustomercode(){

// }

?>