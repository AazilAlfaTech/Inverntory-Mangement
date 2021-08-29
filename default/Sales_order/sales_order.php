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



function edit_sales_order($salesorder_id){
 

    $sql="UPDATE sales_order  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE salesorder_id ='$salesorder_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_order($salesorder_id){

    $sql="UPDATE sales_order SET salesorder_status='INACTIVE' WHERE salesorder_id=$salesorder_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_order(){

    $sql="SELECT * FROM sales_order WHERE salesorder_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_order_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_order_item = new sales_order();

        $sales_order_item->salesorder_id=$row["salesorder_id"];
        $sales_order_item->salesorder_quotid=$row["salesorder_quotid"];
        $sales_order_item->salesorder_customer=$row["salesorder_customer"];
        $sales_order_item->salesorder_ref=$row["salesorder_ref"];
        $sales_order_item->salesorder_date=$row["salesorder_date"];
        $sales_order_item->salesorder_status=$row["salesorder_status"];

        
        
        $sales_order_array[]=$sales_order_item;
    }

    return $sales_order_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_purchaserequest_by_id($sales_orderid){

    $sql="SELECT * FROM sales_order WHERE purchaserequest_id = $sales_orderid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_order_item = new sales_order();

    $sales_order_item->salesorder_id=$row["salesorder_id"];
        $sales_order_item->salesorder_quotid=$row["salesorder_quotid"];
        $sales_order_item->salesorder_customer=$row["salesorder_customer"];
        $sales_order_item->salesorder_ref=$row["salesorder_ref"];
        $sales_order_item->salesorder_date=$row["salesorder_date"];
        $sales_order_item->salesorder_status=$row["salesorder_status"];

       
    return $sales_order_item;
}









// =====================================================================================================================================
}






?>