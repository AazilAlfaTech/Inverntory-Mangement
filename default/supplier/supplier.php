<?php
include_once "../../files/config.php";


class supplier {

   public $supplier_id;
   public $supplier_code;
   public $supplier_name;
   public $supplier_group;
   public $supplier_add;
   public $supplier_contactno;
   public $supplier_email;
   public $supplier_status;
   public $supplier_date;
    

// -----------------------------------------------------------------------------------------------------------------------

function __construct(){
    $this->db=new mysqli(host,un,pw,db1);

}

//-----INSERT-SUPPLIER------------------------------------------------------------------------------------------------------------------

function insert_suppier(){

    $sql="INSERT INTO supplier (supplier_code,supplier_name,supplier_group,supplier_add,supplier_contactno,supplier_email) 
    VALUES ('$this->supcode ','$this->supname ','$this->supgroup','$this->supadd');";
    echo $sql;
    $this->db->query($sql);
    return true;
}

//---------------------------------------------------------------------------------------------------------------------

function get_all_supplier(){
    $sql="SELECT * FROM supplier WHERE supplier_status='ACTIVE' ";
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

// --------------------------------------------------------------------------------------------------------------------------







}









?>