<?php
$T=$_GET["type"];
$T();

function check_suppliergroupcode(){
        include_once ("../supplier_group/supplier_group.php");
        $supplier_group3=new supplier_group();
        $supplier_groupitem=$supplier_group3->get_supplier_group_by_code($_GET['supplier_group_code']);
        echo json_encode($supplier_groupitem);

}

function check_suppliergroupname(){
    include_once ("../supplier_group/supplier_group.php");
    $supplier_group3=new supplier_group();
    $supplier_groupitem=$supplier_group3->get_supplier_group_by_name($_GET['supplier_group_name']);
    echo json_encode($supplier_groupitem);
}

function check_suppliercode(){
    include_once ("../supplier/supplier.php");
    $supplier3=new supplier();
    $suppier_item=$supplier3->get_supplier_by_code($_GET['supplier_code']);
    echo json_encode($suppier_item);
}

function check_supplieremail(){
    include_once ("../supplier/supplier.php");
    $supplier3=new supplier();
    $suppier_item=$supplier3->get_supplier_by_mail($_GET['supplier_mail']);
    echo json_encode($suppier_item);

}

function check_suppliercontact(){
    include_once ("../supplier/supplier.php");
    $supplier3=new supplier();
    $suppier_item=$supplier3->get_supplier_by_contact($_GET['supplier_contact']);
    echo json_encode($suppier_item);
}

?>