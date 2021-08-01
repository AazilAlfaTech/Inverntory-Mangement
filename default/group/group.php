<?php
include_once "../../files/config.php";


class group{
    
public $group_id;
public $group_code;
public $group_name;
public $group_status;
public $group_date;




function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
}

//----------------------------------------------------------------------------------------------------------------------
function insert_group(){

    $sql="INSERT INTO product_group(group_code,group_name) VALUES ('$this->group_code','$this->group_name');";
    echo $sql;
    $this->db->query($sql);
    return true;
}


// -----------------------------------------------------------------------------------------------------------------------------------
function get_all_group(){
    $sql="SELECT * FROM product_group WHERE group_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);
    $group_array=array();

    while($row=$result->fetch_array()){
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        $group_item->group_code=$row["group_code"];
        $group_item->group_name=$row["group_name"];
        $group_item->group_status=$row["group_status"];
        $group_item->group_date=$row["group_date"];

        $group_array[]=$group_item;
    }

    return $group_array;
}

// ----------------------------------------------------------------------------------------------------------------------
function get_group_by_id($groupid){
    $sql="SELECT * FROM product_group WHERE group_id=$groupid";
   // echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        $group_item->group_code=$row["group_code"];
        $group_item->group_name=$row["group_name"];
        $group_item->group_status=$row["group_status"];
        $group_item->group_date=$row["group_date"];

       
    return $group_item;
}

function edit_group($groupid){
    $sql="UPDATE product_group SET group_code='$this->group_code',group_name='$this->group_name' WHERE group_id=$groupid";
    echo $sql;
    $this->db->query($sql);
    return true;
    
}

//cannot delete a group if the group ID is available in the type table

function delete_group($type_groupid){

    $sql="SELECT * FROM product_type WHERE type_group_id=$type_groupid";
    $result=$this->db->query($sql);

    if($result->num_rows==0){
        $sql="UPDATE product_group SET group_status='INACTIVE' WHERE group_id=$type_groupid ";
        $this->db->query($sql);
        return true;
    }else
    return false;

}

function get_group_by_code($groupcode){
    $sql="SELECT * FROM product_group WHERE group_code='$groupcode'";
   // echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        $group_item->group_code=$row["group_code"];
        $group_item->group_name=$row["group_name"];
        $group_item->group_status=$row["group_status"];
        $group_item->group_date=$row["group_date"];

       
    return $group_item;
}

function get_group_by_name($groupname){
    $sql="SELECT * FROM product_group WHERE group_name='$groupname'";
    //echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        // $group_item->group_code=$row["group_code"];
        // $group_item->group_name=$row["group_name"];
        // $group_item->group_status=$row["group_status"];
        // $group_item->group_date=$row["group_date"];

       
    return $group_item;
}



// function {

// }


}


?>