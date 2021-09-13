<?php
include_once "../../files/config.php";

class sales_dispatch_item{ 

    public $sd_item_id;
    public $sd_item_saledispatch_id;
    public $sd_item_productid;
    public $sd_item_price;
    public $sd_item_qty;
    public $sd_item_discount;
    public $sd_item_final_price;
    public $sd_item_status;
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_dispatch_item------------------------------------------------------------------------------------------------------------------


function insert_sales_dispatch_item(){

    $sql="INSERT INTO sales_dispatch_item (sd_item_saledispatch_id,sd_item_productid,sd_item_price,sd_item_qty,sd_item_discount,sd_item_final_price)
    VALUES('$this->sd_item_saledispatch_id','$this->sd_item_productid','$this->sd_item_price','$this->sd_item_qty','$this->sd_item_discount','$this->sd_item_final_price')
    ";
       echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_dispatch_item($sd_item_id){
 

    $sql="UPDATE sales_dispatch_item  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE sd_item_id ='$sd_item_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_dispatch_item($sd_item_id){

    $sql="UPDATE sales_dispatch_item SET sd_item_status='INACTIVE' WHERE sd_item_id = $sd_item_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_dispatch_item(){

    $sql="SELECT * FROM sales_dispatch_item WHERE sd_item_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_dispatch_item_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_dispatch_item_item = new sales_dispatch_item();

        $sales_dispatch_item_item->sd_item_id=$row["sd_item_id"];
        $sales_dispatch_item_item->sd_item_saledispatch_id=$row["sd_item_saledispatch_id"];
        $sales_dispatch_item_item->sd_item_productid=$row["sd_item_productid"];
        $sales_dispatch_item_item->sd_item_price=$row["sd_item_price"];
        $sales_dispatch_item_item->sd_item_qty=$row["sd_item_qty"];
        $sales_dispatch_item_item->sd_item_discount=$row["sd_item_discount"];
        $sales_dispatch_item_item->sd_item_final_price=$row["sd_item_final_price"];
        $sales_dispatch_item_item->sd_item_status=$row["sd_item_status"];

        
        
        $sales_dispatch_item_array[]=$sales_dispatch_item_item;
    }

    return $sales_dispatch_item_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_dispatch_item_by_id($sd_item_id){

    $sql="SELECT * FROM sales_dispatch_item WHERE sd_item_id = $sd_item_id";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_dispatch_item_item = new sales_dispatch_item();

    $sales_dispatch_item_item->sd_item_id=$row["sd_item_id"];
    $sales_dispatch_item_item->sd_item_saledispatch_id=$row["sd_item_saledispatch_id"];
    $sales_dispatch_item_item->sd_item_productid=$row["sd_item_productid"];
    $sales_dispatch_item_item->sd_item_price=$row["sd_item_price"];
    $sales_dispatch_item_item->sd_item_qty=$row["sd_item_qty"];
    $sales_dispatch_item_item->sd_item_discount=$row["sd_item_discount"];
    $sales_dispatch_item_item->sd_item_final_price=$row["sd_item_final_price"];
    $sales_dispatch_item_item->sd_item_status=$row["sd_item_status"];
       
    return $sales_dispatch_item_item;
}









// =====================================================================================================================================
}






?>