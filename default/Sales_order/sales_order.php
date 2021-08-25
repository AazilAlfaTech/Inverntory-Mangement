<?php
include_once "../../files/config.php";

class sales_order{ 

    public $salesorder_id;
    public $salesorder_quotid;
    public $salesorder_customer;
    public $salesorder_ref;
    public $salesorder_date;
    public $salesorder_status;
    
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_order------------------------------------------------------------------------------------------------------------------


function insert_sales_order(){

    $sql="INSERT INTO sales_order (salesorder_quotid,salesorder_customer,salesorder_ref,salesorder_date)
    VALUES('$this->salesorder_quotid','$this->salesorder_customer','$this->salesorder_ref','$this->salesorder_date')
    ";
       echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_purchaserequest($salesorder_id){
 

    $sql="UPDATE sales_order  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE salesorder_id ='$salesorder_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_purchaserequest($salesorder_id){

    $sql="UPDATE sales_order SET salesorder_status='INACTIVE' WHERE salesorder_id=$salesorder_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------




}










?>