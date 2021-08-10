<?php
include_once "../../files/config.php";


class supplier_group{

   public $supplierpgroup_id;
   public $suppliergroup_code; 
   public $suppliergroup_name;
   public $suppliergroup_status;
   public $suppliergroup_date;


// -----------------------------------------------------------------------------------------------------------------------

function __construct(){
    $this->db=new mysqli(host,un,pw,db1);

}

//-----------------------------------------------------------------------------------------------------------------------



function insert_suppier_group(){
    $CODE=$_POST["sup_grcode"];
    $NAME=$_POST["sup_grname"];
    $sql1="SELECT * FROM supplier_group WHERE suppliergroup_status='ACTIVE' AND suppliergroup_code='$CODE' OR suppliergroup_name='$NAME'";
    $res_code=$this->db->query($sql1);
   
    if($res_code->num_rows==0){

    $sql="INSERT INTO supplier_group (suppliergroup_code,suppliergroup_name) 
    VALUES ('$this->suppliergroup_code ','$this->suppliergroup_name')";
    echo $sql;
    $this->db->query($sql);
    return true;
}else {
    return false;
 }

}

//---------------------------------------------------------------------------------------------------------------------

function get_all_supplier_group(){
    $sql="SELECT * FROM supplier_group WHERE suppliergroup_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);
    $supplier_group_array=array();

    while($row=$result->fetch_array()){

        $supplier_group_item=new supplier_group();


        $supplier_group_item->suppliergroup_id=$row["suppliergroup_id"];
        $supplier_group_item->suppliergroup_code=$row["suppliergroup_code"];
        $supplier_group_item->suppliergroup_name=$row["suppliergroup_name"];
        $supplier_group_item->suppliergroup_status=$row["suppliergroup_status"];
        $supplier_group_item->suppliergroup_date=$row["suppliergroup_date"];

        $supplier_group_array[]=$supplier_group_item;
    }

    return $supplier_group_array;
}

// --------------------------------------------------------------------------------------------------------------------------


// ----------------------------------------------------------------------------------------------------------------------
function get_supplier_group_by_id($supplier_groupid){
    $sql="SELECT * FROM supplier_group WHERE suppliergroup_id=$supplier_groupid";
    echo $sql;
    $result=$this->db->query($sql);

   

    $row=$result->fetch_array();

        $supplier_group_item = new supplier_group();

        $supplier_group_item->suppliergroup_id=$row["suppliergroup_id"];
        $supplier_group_item->suppliergroup_code=$row["suppliergroup_code"];
        $supplier_group_item->suppliergroup_name=$row["suppliergroup_name"];
        $supplier_group_item->suppliergroup_status=$row["suppliergroup_status"];
        $supplier_group_item->suppliergroup_date=$row["suppliergroup_date"];

       
    return $supplier_group_item;
}

// ----------------------------------------------------------------------------------------------------------------------------
function edit_supplier_group($supplier_groupid){
    $CODE=$_POST["sup_grcode"];
    $NAME=$_POST["sup_grname"];
    $sql1="SELECT * FROM supplier_group WHERE suppliergroup_status='ACTIVE' AND  suppliergroup_name='$NAME'";
    $res_code=$this->db->query($sql1);
   
    if($res_code->num_rows==0){

    $sql="UPDATE supplier_group SET suppliergroup_code='$this->suppliergroup_code',suppliergroup_name='$this->suppliergroup_name'
     WHERE suppliergroup_id=$supplier_groupid";

    echo $sql;

    $this->db->query($sql);

    return true;
}else {
    return false;
 }
    
}

//----------------------------------------------------------------------------------------------------------------------------
function delete_supplier_group($supplier_groupid){
    $sql_check="SELECT * FROM supplier WHERE supplier_group=$supplier_groupid";
    $result=$this->db->query($sql_check);

    if($result->num_rows==0){
   
        $sql="UPDATE supplier_group SET suppliergroup_status='INACTIVE'
         WHERE suppliergroup_id=$supplier_groupid ";
        $this->db->query($sql);
        return true;
    }else{
        return false;
    }


}

//----------------------------------------------------------------------------------------------------------------------------
function get_supplier_group_by_code($supplier_groupcode){
    $sql="SELECT * FROM supplier_group WHERE suppliergroup_code='$supplier_groupcode'";
   // echo $sql;
    $result=$this->db->query($sql);

    // $supplier_group_array=array();

    $row=$result->fetch_array();
        $supplier_group_item=new supplier_group();
        
        $supplier_group_item->suppliergroup_id=$row["suppliergroup_id"];
        $supplier_group_item->suppliergroup_code=$row["suppliergroup_code"];
        $supplier_group_item->suppliergroup_name=$row["suppliergroup_name"];
        $supplier_group_item->suppliergroup_status=$row["suppliergroup_status"];
        $supplier_group_item->suppliergroup_date=$row["suppliergroup_date"];

       
    return $supplier_group_item;
}

//----------------------------------------------------------------------------------------------------------------------------
function get_supplier_group_by_name($supplier_groupname){
    $sql="SELECT * FROM supplier_group WHERE suppliergroup_name='$supplier_groupname'";
    //echo $sql;
    $result=$this->db->query($sql);



    $row=$result->fetch_array();
        $supplier_group_item=new supplier_group();
        $supplier_group_item->suppliergroup_id=$row["suppliergroup_id"];
        $supplier_group_item->suppliergroup_code=$row["suppliergroup_code"];
        $supplier_group_item->suppliergroup_name=$row["suppliergroup_name"];

       
    return $supplier_group_item;
}










}









?>