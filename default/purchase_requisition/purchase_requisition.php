<?php
include_once "../../files/config.php";
    class purchaserequest{ 
        
        
        
      public  $purchaserequest_id;
      public  $purchaserequest_ref;
      public  $purchaserequest_date;
      public  $purchaserequest_supplier;
      public  $purchaserequest_status;

      
      
private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW purchaserequest------------------------------------------------------------------------------------------------------------------


function insert_purchaserequest(){

    $sql="INSERT INTO purchase_request (purchaserequest_code,purchaserequest_name,purchaserequest_add,purchaserequest_number,purchaserequest_email)
    VALUES('$this->purchaserequest_code','$this->purchaserequest_name','$this->purchaserequest_add','$this->purchaserequest_number','$this->purchaserequest_email')
    ";
       //echo $sql;
       $this->db->query($sql);
    $id=$this->db->insert_id;
    return $id;

}

// ----EDIT purchaserequest------------------------------------------------------------------------------------------------------------------


function get_all_purchaserequest(){

    $sql="SELECT * FROM purchase_request WHERE purchaserequest_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);

    $purchaserequest_array=array(); //array created

    while($row=$result->fetch_array()){

        $purchaserequest_item = new purchaserequest();

        //$purchaserequest_item->purchaserequest_id=$row["purchaserequest_id"];
        $purchaserequest_item->purchaserequest_code=$row["purchaserequest_code"];
        $purchaserequest_item->purchaserequest_name=$row["purchaserequest_name"];
        $purchaserequest_item->purchaserequest_add=$row["purchaserequest_add"];
        $purchaserequest_item->purchaserequest_number=$row["purchaserequest_number"];
        $purchaserequest_item->purchaserequest_email=$row["purchaserequest_email"];
        $purchaserequest_item->purchaserequest_status=$row["purchaserequest_status"];
        $purchaserequest_item->purchaserequest_date=$row["purchaserequest_date"];

        $purchaserequest_array[]=$purchaserequest_item;
    }

    return $purchaserequest_array;
}

// ----GET ALL purchaserequest------------------------------------------------------------------------------------------------------------------



function get_purchaserequest_by_id($purchaserequestid){

    $sql="SELECT * FROM purchase_request WHERE purchaserequest_id = $purchaserequestid";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $purchaserequest_item = new purchaserequest();

    $purchaserequest_item->purchaserequest_id=$row["purchaserequest_id"];
    $purchaserequest_item->purchaserequest_ref=$row["purchaserequest_ref"];
    $purchaserequest_item->purchaserequest_date=$row["purchaserequest_date"];
    $purchaserequest_item->purchaserequest_add=$row["purchaserequest_add"];
    $purchaserequest_item->purchaserequest_number=$row["purchaserequest_number"];
    $purchaserequest_item->purchaserequest_email=$row["purchaserequest_email"];
    $purchaserequest_item->purchaserequest_status=$row["purchaserequest_status"];

       
    return $purchaserequest_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_purchaserequest($purchaserequestid){
 

    $sql="UPDATE purchase_request  SET 
     purchaserequest_name='$this->purchaserequest_name',purchaserequest_add='$this->purchaserequest_add',purchaserequest_number='$this->purchaserequest_number',purchaserequest_email='$this->purchaserequest_email'
    WHERE purchaserequest_id=$purchaserequestid ";
    //echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_purchaserequest($purchaserequest_id){

    $sql="UPDATE purchase_request SET purchaserequest_status='INACTIVE' WHERE purchaserequest_id=$purchaserequest_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


        


        




















    }








?>