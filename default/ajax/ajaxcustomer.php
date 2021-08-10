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

function checkcustomercode(){
    include_once "../customer/customer.php";
    $customer3=new customer();
    $customer_item=$customer3->get_customer_by_code($_GET['cus_code']);
    echo json_encode($customer_item);

}

function checkcustomermail(){
    include_once "../customer/customer.php";
    $customer3=new customer();
    $customer_item=$customer3->get_customer_by_mail($_GET['cus_mail']);
    echo json_encode($customer_item);


}

function checkcustomercontact(){
    include_once "../customer/customer.php";
    $customer3=new customer();
    $customer_item=$customer3->get_customer_by_contact($_GET['cus_contact']);
    echo json_encode($customer_item);


}

?>