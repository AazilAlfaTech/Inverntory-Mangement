<?php

$T=$_GET["type"];
$T();


function checkgroupcode()
    {
        include_once ("../group/group.php"); //include the category class file
        $group3=new group(); //make an object for the class
        $group_item=$group3->get_group_by_code($_GET['productgroup_code']); // name given to the id of category in the js function,According to that Id it generated the data
        echo json_encode( $group_item); //convert the data into a string
    }


function checkgroupname(){
    include_once ("../group/group.php");
    $group3=new group();
    $group_item1=$group3->get_group_by_name($_GET['productgroup_name']);
    echo json_encode($group_item1);
}
function checkgroupid(){
    include_once ("../group/group.php");
    $group3=new group();
    $group_item1=$group3->get_group_by_id($_GET['productgroup_id']);
    echo json_encode($group_item1);
}

function checklocationcode(){
    include_once ("../location/location.php");
    $location3=new location();
    $location_item=$location3->get_location_by_code($_GET['masterlocation_code']);
    echo json_encode($location_item);
}

function checklocationmail(){
    include_once ("../location/location.php");
    $location3=new location();
    $location_item=$location3->get_location_by_mail($_GET['masterlocation_mail']);
    echo json_encode($location_item);
}

function checktypecode(){
    include_once ("../producttype/producttype.php");
    $type=new producttype();
    $type_item=$type->get_type_by_code($_GET['producttype_code']);
    echo json_encode($type_item);
}


function checktypename(){
    include_once ("../producttype/producttype.php");
    $type=new producttype();
    $type_item=$type->get_type_by_name($_GET['producttype_name']);
    echo json_encode($type_item);
     
}
function checktypeid(){
    include_once ("../producttype/producttype.php");
    $type=new producttype();
    $type_item=$type->get_type_by_id($_GET['producttype_id']);
    echo json_encode($type_item);
     
}

function checktypegroup(){
    include_once ("../producttype/producttype.php");
    $type=new producttype();
    $type_item=$type->get_type_by_group($_GET['producttype_group']);
    echo json_encode($type_item);
     
}

function checkuomcode(){
    include_once ("../uom/uom.php");
    $uom4=new uom();
    $uom_item=$uom4->get_uom_by_code($_GET['productuom_code']);
    echo json_encode($uom_item);
}

function checkuomname(){
    include_once ("../uom/uom.php");
    $uom4=new uom();
    $uom_item=$uom4->get_uom_by_name($_GET['productuom_name']);
    echo json_encode($uom_item);
}

?>