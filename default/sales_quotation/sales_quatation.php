<?php
include_once "../../files/config.php";

class sales_quotation{ 

    public $salesquot_id;
    public $salesquot_customer;
    public $salesquot_ref;
    public $salesquot_date;
    public $salesquot_status;



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW purchaserequest------------------------------------------------------------------------------------------------------------------


function insert_sales_quotation (){

    $sql="INSERT INTO sales_quotation (salesquot_customer,salesquot_ref,salesquot_date)
    VALUES('$this->salesquot_customer','$this->salesquot_ref','$this->salesquot_date')
    ";
       echo $sql;
       $this->db->query($sql);
    $sq_id=$this->db->insert_id;
    return $sq_id;

}


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