<?php

$T=$_GET["type"];
$T();

function checkgroupcode(){
    include_once ("../group/group.php");
    
    $group3=new group();
    $group_item=$group3->get_group_by_code($_GET['productgroup_code']);
    echo json_encode($group_item);
}


function checkgroupname(){
    include_once ("../group/group.php");
    
    $group3=new group();
    $group_item=$group3->get_group_by_code($_GET['productgroup_name']);
    echo json_encode($group_item);
}

?>