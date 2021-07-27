<?php
include_once("../group/group.php");

$group2=new group();

if(isset($_POST["groupid"])){
    $group2->group_id=$_POST["groupid"];
    $group2->group_code=$_POST["groupcode"];
    $group2->group_name=$_POST["groupname"];
    $group2->edit_group($_POST["groupid"]);
}

?>