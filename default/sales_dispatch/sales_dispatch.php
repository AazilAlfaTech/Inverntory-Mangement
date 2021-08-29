<?php
include_once "../../files/config.php";

class sales_dispatch{ 

    public $salesdispatch_id;
    public $salesdispatch_si_id;
    public $salesdispatch_customer;
    public $salesdispatch_ref;
    public $salesdispatch_paymethod;
    public $salesdispatch_date;
    public $salesdispatch_status;
    
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_dispatch------------------------------------------------------------------------------------------------------------------


function insert_sales_dispatch(){

    $sql="INSERT INTO sales_dispatch (salesdispatch_si_id,salesdispatch_customer,salesdispatch_ref,salesdispatch_paymethod,salesdispatch_date)
    VALUES('$this->salesdispatch_si_id','$this->salesdispatch_customer','$this->salesdispatch_ref','$this->salesdispatch_paymethod','$this->salesdispatch_date')
    ";
       echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_dispatch($salesdispatch_id){
 

    $sql="UPDATE sales_dispatch  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE salesdispatch_id ='$salesdispatch_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_dispatch($salesdispatch_id){

    $sql="UPDATE sales_dispatch SET salesdispatch_status='INACTIVE' WHERE salesdispatch_id = $salesdispatch_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_dispatch(){

    $sql="SELECT * FROM sales_dispatch WHERE salesdispatch_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_dispatch_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_dispatch_item = new sales_dispatch();

        $sales_dispatch_item->salesdispatch_id=$row["salesdispatch_id"];
        $sales_dispatch_item->salesdispatch_si_id=$row["salesdispatch_si_id"];
        $sales_dispatch_item->salesdispatch_customer=$row["salesdispatch_customer"];
        $sales_dispatch_item->salesdispatch_ref=$row["salesdispatch_ref"];
        $sales_dispatch_item->salesdispatch_paymethod=$row["salesdispatch_paymethod"];
        $sales_dispatch_item->salesdispatch_date=$row["salesdispatch_date"];
        $sales_dispatch_item->si_item_soprice=$row["si_item_soprice"];
        $sales_dispatch_item->salesdispatch_status=$row["salesdispatch_status"];

        
        
        $sales_dispatch_array[]=$sales_dispatch_item;
    }

    return $sales_dispatch_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_dispatch_by_id($salesdispatch_id){

    $sql="SELECT * FROM sales_dispatch WHERE salesdispatch_id = $salesdispatch_id";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_dispatch_item = new sales_dispatch();

    $sales_dispatch_item->salesdispatch_id=$row["salesdispatch_id"];
    $sales_dispatch_item->salesdispatch_si_id=$row["salesdispatch_si_id"];
    $sales_dispatch_item->salesdispatch_customer=$row["salesdispatch_customer"];
    $sales_dispatch_item->salesdispatch_ref=$row["salesdispatch_ref"];
    $sales_dispatch_item->salesdispatch_paymethod=$row["salesdispatch_paymethod"];
    $sales_dispatch_item->salesdispatch_date=$row["salesdispatch_date"];
    $sales_dispatch_item->si_item_soprice=$row["si_item_soprice"];
    $sales_dispatch_item->salesdispatch_status=$row["salesdispatch_status"];
       
    return $sales_dispatch_item;
}









// =====================================================================================================================================
}






?>