<?php
include_once "../../files/config.php";


class supplier {

   public $supplier_id;
   public $supplier_code;
   public $supplier_name;
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

    $sql="INSERT INTO supplier (supplier_code,supplier_name,supplier_add,supplier_contactno,supplier_email) 
    VALUES ('$this->supcode ','$this->supname ','$this->supadd','$this->suppliercontactno','$this->suppliercontactno');";
    echo $sql;
    $this->db->query($sql);
    return true;
}

//---------------------------------------------------------------------------------------------------------------------

function get_all_supplier(){
    $sql="SELECT * FROM supplier WHERE supplier_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);
    $supplier_array=array();

    while($row=$result->fetch_array()){
        $supplier_item=new supplier();
        $supplier_item->supplier_id=$row["supplier_id"];
        $supplier_item->supplier_code=$row["supplier_code"];
        $supplier_item->supplier_name=$row["supplier_name"];
        $supplier_item->supplier_status=$row["supplier_status"];
        $supplier_item->supplier_date=$row["supplier_date"];

        $supplier_array[]=$supplier_item;
    }

    return $supplier_array;
}

// --------------------------------------------------------------------------------------------------------------------------


// ----------------------------------------------------------------------------------------------------------------------
function get_supplier_by_id($supplierid){
    $sql="SELECT * FROM supplier WHERE supplier_id=$supplierid";
    echo $sql;
    $result=$this->db->query($sql);

    // $supplier_array=array();

    $row=$result->fetch_array();
        $supplier_item=new supplier();
        $supplier_item->supplier_id=$row["supplier_id"];
        $supplier_item->supplier_code=$row["supplier_code"];
        $supplier_item->supplier_name=$row["supplier_name"];
        $supplier_item->supplier_status=$row["supplier_status"];
        $supplier_item->supplier_date=$row["supplier_date"];

       
    return $supplier_item;
}

// ----------------------------------------------------------------------------------------------------------------------------
function edit_supplier($supplierid){
    $sql="UPDATE supplier SET supplier_code='$this->supplier_code',supplier_name='$this->supplier_name' WHERE supplier_id=$supplierid";
    echo $sql;
    $this->db->query($sql);
    return true;
    
}

//----------------------------------------------------------------------------------------------------------------------------
function delete_supplier($supplierid){

   
        $sql="UPDATE supplier SET supplier_status='INACTIVE' WHERE supplier_id=$supplierid ";
        $this->db->query($sql);
        return true;


}

//----------------------------------------------------------------------------------------------------------------------------
function get_supplier_by_code($suppliercode){
    $sql="SELECT * FROM supplier WHERE supplier_code='$suppliercode'";
   // echo $sql;
    $result=$this->db->query($sql);

    // $supplier_array=array();

    $row=$result->fetch_array();
        $supplier_item=new supplier();
        
        $supplier_item->supplier_id=$row["supplier_id"];
        $supplier_item->supplier_code=$row["supplier_code"];
        $supplier_item->supplier_name=$row["supplier_name"];
        $supplier_item->supplier_status=$row["supplier_status"];
        $supplier_item->supplier_date=$row["supplier_date"];

       
    return $supplier_item;
}

//----------------------------------------------------------------------------------------------------------------------------
function get_supplier_by_name($suppliername){
    $sql="SELECT * FROM supplier WHERE supplier_name='$suppliername'";
    //echo $sql;
    $result=$this->db->query($sql);



    $row=$result->fetch_array();
        $supplier_item=new supplier();
        $supplier_item->supplier_id=$row["supplier_id"];

       
    return $supplier_item;
}





}















?>