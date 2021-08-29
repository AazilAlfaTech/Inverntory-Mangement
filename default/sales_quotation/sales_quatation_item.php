<?php
include_once "../../files/config.php";

class sales_quotationitem{ 

    public $sq_item_id;
    public $sq_item_quotid;
    public $sq_item_productid;
    public $sq_item_price;
    public $sq_item_qty;
    public $sq_item_discount;
    public $sq_item_finalprice;
    public $sq_item_status;
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_quotationitem------------------------------------------------------------------------------------------------------------------


function insert_sales_quotationitem(){

    $sql="INSERT INTO sales_quotationitem (sq_item_quotid,sq_item_productid,sq_item_price,sq_item_qty,sq_item_discount,sq_item_finalprice)
    VALUES('$this->sq_item_quotid','$this->sq_item_productid','$this->sq_item_price','$this->sq_item_qty','$this->sq_item_discount','$this->sq_item_finalprice')
    ";
       echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_quotationitem($so_itemid){
 

    $sql="UPDATE sales_quotationitem  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE so_itemid ='$so_itemid' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_quotationitem($so_itemid){

    $sql="UPDATE sales_quotationitem SET sq_item_status='INACTIVE' WHERE so_itemid = $so_itemid ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_quotationitem(){

    $sql="SELECT * FROM sales_quotationitem WHERE sq_item_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_quotationitem_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_quotationitem = new sales_quotationitem();

        $sales_quotationitem->so_itemid=$row["so_itemid"];
        $sales_quotationitem->sq_item_quotid=$row["sq_item_quotid"];
        $sales_quotationitem->sq_item_productid=$row["sq_item_productid"];
        $sales_quotationitem->sq_item_price=$row["sq_item_price"];
        $sales_quotationitem->sq_item_qty=$row["sq_item_qty"];
        $sales_quotationitem->sq_item_discount=$row["sq_item_discount"];
        $sales_quotationitem->sq_item_finalprice=$row["sq_item_finalprice"];
        $sales_quotationitem->sq_item_status=$row["sq_item_status"];

        
        
        $sales_quotationitem_array[]=$sales_quotationitem;
    }

    return $sales_quotationitem_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_quotationitem_by_id($so_itemid){

    $sql="SELECT * FROM sales_quotationitem WHERE so_itemid = $so_itemid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_quotationitem = new sales_quotationitem();

    $sales_quotationitem->so_itemid=$row["so_itemid"];
    $sales_quotationitem->sq_item_quotid=$row["sq_item_quotid"];
    $sales_quotationitem->sq_item_productid=$row["sq_item_productid"];
    $sales_quotationitem->sq_item_price=$row["sq_item_price"];
    $sales_quotationitem->sq_item_qty=$row["sq_item_qty"];
    $sales_quotationitem->sq_item_discount=$row["sq_item_discount"];
    $sales_quotationitem->sq_item_finalprice=$row["sq_item_finalprice"];
    $sales_quotationitem->sq_item_status=$row["sq_item_status"];
       
    return $sales_quotationitem;
}









// =====================================================================================================================================
}






?>