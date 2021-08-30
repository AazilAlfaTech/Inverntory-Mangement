<?php
include_once "../../files/config.php";

class sales_invoice{ 

    public $salesinvoice_id;
    public $salesinvoice_so_id;
    public $salesinvoice_customer;
    public $salesinvoice_ref;
    public $salesinvoice_paymethod;
    public $salesinvoice_date;
    public $salesinvoice_status;
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_invoice------------------------------------------------------------------------------------------------------------------


function insert_sales_invoice(){

    $sql="INSERT INTO sales_invoice (salesinvoice_so_id,salesinvoice_customer,salesinvoice_ref,salesinvoice_paymethod,sq_item_discount)
    VALUES('$this->salesinvoice_so_id','$this->salesinvoice_customer','$this->salesinvoice_ref','$this->salesinvoice_paymethod','$this->sq_item_discount')
    ";
       echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_invoice($salesinvoice_id){
 

    $sql="UPDATE sales_invoice  SET 
     salesinvoice_customer='$this->salesinvoice_customer'
     
     WHERE salesinvoice_id ='$salesinvoice_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_invoice($salesinvoice_id){

    $sql="UPDATE sales_invoice SET sq_item_status='INACTIVE' WHERE salesinvoice_id = $salesinvoice_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_invoice(){

    $sql="SELECT * FROM sales_invoice WHERE sq_item_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_invoice_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_invoice_item = new sales_invoice();

        $sales_invoice_item->salesinvoice_id=$row["salesinvoice_id"];
        $sales_invoice_item->salesinvoice_so_id=$row["salesinvoice_so_id"];
        $sales_invoice_item->salesinvoice_customer=$row["salesinvoice_customer"];
        $sales_invoice_item->salesinvoice_ref=$row["salesinvoice_ref"];
        $sales_invoice_item->salesinvoice_paymethod=$row["salesinvoice_paymethod"];
        $sales_invoice_item->sq_item_discount=$row["sq_item_discount"];
        $sales_invoice_item->sq_item_finalprice=$row["sq_item_finalprice"];
        $sales_invoice_item->sq_item_status=$row["sq_item_status"];

        
        
        $sales_invoice_array[]=$sales_invoice_item;
    }

    return $sales_invoice_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_invoice_by_id($salesinvoice_id){

    $sql="SELECT * FROM sales_invoice WHERE salesinvoice_id = $salesinvoice_id";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_invoice_item = new sales_invoice();

    $sales_invoice_item->salesinvoice_id=$row["salesinvoice_id"];
    $sales_invoice_item->salesinvoice_so_id=$row["salesinvoice_so_id"];
    $sales_invoice_item->salesinvoice_customer=$row["salesinvoice_customer"];
    $sales_invoice_item->salesinvoice_ref=$row["salesinvoice_ref"];
    $sales_invoice_item->salesinvoice_paymethod=$row["salesinvoice_paymethod"];
    $sales_invoice_item->sq_item_discount=$row["sq_item_discount"];
    $sales_invoice_item->sq_item_finalprice=$row["sq_item_finalprice"];
    $sales_invoice_item->sq_item_status=$row["sq_item_status"];
       
    return $sales_invoice_item;
}









// =====================================================================================================================================
}






?>