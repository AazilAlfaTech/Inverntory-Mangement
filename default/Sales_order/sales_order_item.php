<?php
include_once "../../files/config.php";

class sales_orderitem{ 

    public $so_itemid;
    public $so_salesorderid;
    public $so_itemproductid;
    public $so_itemprice;
    public $so_itemqty;
    public $so_itemdiscount;
    public $so_finalprice;
    public $so_itemstatus;
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_orderitem------------------------------------------------------------------------------------------------------------------


function insert_sales_orderitem($orderid){

   $list=0;
    
   foreach($_POST['Quantity'] as $item){
    $sql="INSERT INTO sales_orderitem (so_itemqty,so_itemproductid,so_itemdiscount,so_itemprice,so_salesorderid) VALUES 
    ('".$_POST['Quantity'][$list]."','".$_POST['Product'][$list]."','".$_POST['Discount'][$list]."','".$_POST['Price'][$list]."',$orderid)";
   
    echo $sql;
        $this->db->query($sql);
       $list++;
}
return true;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_orderitem($so_itemid){
 

    $sql="UPDATE sales_orderitem  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE so_itemid ='$so_itemid' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_orderitem($so_itemid){

    $sql="UPDATE sales_orderitem SET so_itemstatus='INACTIVE' WHERE so_itemid = $so_itemid ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_orderitem(){

    $sql="SELECT * FROM sales_orderitem WHERE so_itemstatus='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_orderitem_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_orderitem_item = new sales_orderitem();

        $sales_orderitem_item->so_itemid=$row["so_itemid"];
        $sales_orderitem_item->so_salesorderid=$row["so_salesorderid"];
        $sales_orderitem_item->so_itemproductid=$row["so_itemproductid"];
        $sales_orderitem_item->so_itemprice=$row["so_itemprice"];
        $sales_orderitem_item->so_itemqty=$row["so_itemqty"];
        $sales_orderitem_item->so_itemdiscount=$row["so_itemdiscount"];
        $sales_orderitem_item->so_finalprice=$row["so_finalprice"];
        $sales_orderitem_item->so_itemstatus=$row["so_itemstatus"];

        
        
        $sales_orderitem_array[]=$sales_orderitem_item;
    }

    return $sales_orderitem_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_orderitem_by_id($so_itemid){

    $sql="SELECT * FROM sales_orderitem WHERE so_itemid = $so_itemid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_orderitem_item = new sales_orderitem();

    $sales_orderitem_item->so_itemid=$row["so_itemid"];
    $sales_orderitem_item->so_salesorderid=$row["so_salesorderid"];
    $sales_orderitem_item->so_itemproductid=$row["so_itemproductid"];
    $sales_orderitem_item->so_itemprice=$row["so_itemprice"];
    $sales_orderitem_item->so_itemqty=$row["so_itemqty"];
    $sales_orderitem_item->so_itemdiscount=$row["so_itemdiscount"];
    $sales_orderitem_item->so_finalprice=$row["so_finalprice"];
    $sales_orderitem_item->so_itemstatus=$row["so_itemstatus"];
       
    return $sales_orderitem_item;
}









// =====================================================================================================================================
}






?>