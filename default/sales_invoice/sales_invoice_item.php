<?php
include_once "../../files/config.php";

class sales_invoice_item{ 

    public $si_itemid;
    public $si_item_soid;
    public $si_item_productid;
    public $si_item_price;
    public $si_item_qty;
    public $si_item_discount;
    public $si_item_soprice;
    public $si_item_status;
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_invoice_item------------------------------------------------------------------------------------------------------------------


function insert_sales_invoice_item(){

    $sql="INSERT INTO sales_invoice_item (si_item_soid,si_item_productid,si_item_price,si_item_qty,si_item_discount,si_item_soprice)
    VALUES('$this->si_item_soid','$this->si_item_productid','$this->si_item_price','$this->si_item_qty','$this->si_item_discount','$this->si_item_soprice')
    ";
       echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_invoice_item($si_itemid){
 

    $sql="UPDATE sales_invoice_item  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE si_itemid ='$si_itemid' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_invoice_item($si_itemid){

    $sql="UPDATE sales_invoice_item SET si_item_status='INACTIVE' WHERE si_itemid = $si_itemid ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_invoice_item(){

    $sql="SELECT * FROM sales_invoice_item WHERE si_item_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_invoice_item_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_invoice_item_item = new sales_invoice_item();

        $sales_invoice_item_item->si_itemid=$row["si_itemid"];
        $sales_invoice_item_item->si_item_soid=$row["si_item_soid"];
        $sales_invoice_item_item->si_item_productid=$row["si_item_productid"];
        $sales_invoice_item_item->si_item_price=$row["si_item_price"];
        $sales_invoice_item_item->si_item_qty=$row["si_item_qty"];
        $sales_invoice_item_item->si_item_discount=$row["si_item_discount"];
        $sales_invoice_item_item->si_item_soprice=$row["si_item_soprice"];
        $sales_invoice_item_item->si_item_status=$row["si_item_status"];

        
        
        $sales_invoice_item_array[]=$sales_invoice_item_item;
    }

    return $sales_invoice_item_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_invoice_item_by_id($si_itemid){

    $sql="SELECT * FROM sales_invoice_item WHERE si_itemid = $si_itemid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_invoice_item_item = new sales_invoice_item();

    $sales_invoice_item_item->si_itemid=$row["si_itemid"];
    $sales_invoice_item_item->si_item_soid=$row["si_item_soid"];
    $sales_invoice_item_item->si_item_productid=$row["si_item_productid"];
    $sales_invoice_item_item->si_item_price=$row["si_item_price"];
    $sales_invoice_item_item->si_item_qty=$row["si_item_qty"];
    $sales_invoice_item_item->si_item_discount=$row["si_item_discount"];
    $sales_invoice_item_item->si_item_soprice=$row["si_item_soprice"];
    $sales_invoice_item_item->si_item_status=$row["si_item_status"];
       
    return $sales_invoice_item_item;
}









// =====================================================================================================================================
}






?>