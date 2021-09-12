<?php
include_once "../../files/config.php";

class sales_orderitem{ 

    public $so_itemid;
    public $so_salesorderid;
    public $so_itemproductid;
    public $so_itemprice;
    public $so_itemqty;
    public $so_itemdiscount;

    // public $so_itemstatus;
    
 
  



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



function edit_sales_orderitem(){
 
    $list2=0;

    foreach($_POST['Quantity_edit'] as $item){
        $sql="UPDATE sales_orderitem SET so_itemqty='".$_POST['Quantity_edit'][$list2]."',so_itemprice ='".$_POST['Price_edit'][$list2]."',so_itemdiscount='".$_POST['Discount_edit'][$list2]."' WHERE so_itemid='".$_POST['Orderid'][$list2]."' ";
        // echo $sql;
        $this->db->query($sql);
       $list2++;
    }

    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_orderitem($so_itemid){

    $sql="UPDATE sales_orderitem SET so_itemstatus='INACTIVE' WHERE so_itemid = $so_itemid ";
    //echo $sql;
    $this->db->query($sql);
    echo true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_orderitem($so_itemid){
    $sql="SELECT sales_orderitem.so_itemid,sales_orderitem.so_salesorderid,sales_orderitem.so_itemproductid,sales_orderitem.so_itemprice,
    sales_orderitem.so_itemqty, sales_orderitem.so_itemdiscount, product.product_name FROM sales_orderitem JOIN product ON sales_orderitem.so_itemproductid=product.product_id WHERE sales_orderitem.so_salesorderid=$so_itemid";

    //echo $sql;
  
    $result=$this->db->query($sql);

    $sales_orderitem_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_orderitem_item = new sales_orderitem();

        $sales_orderitem_item->so_itemid=$row["so_itemid"];
        $sales_orderitem_item->so_salesorderid=$row["so_salesorderid"];
        $sales_orderitem_item->so_itemproductid=$row["so_itemproductid"];
        $sales_orderitem_item->so_itemproduct_name=$row["product_name"];
        $sales_orderitem_item->so_itemprice=$row["so_itemprice"];
        $sales_orderitem_item->so_itemqty=$row["so_itemqty"];
        $sales_orderitem_item->so_itemdiscount=$row["so_itemdiscount"];
        $sales_orderitem_item->so_subtotal=round(($row["so_itemqty"]*$row["so_itemprice"]),2);
        $sales_orderitem_item->so_finaltotal=round(($row['so_itemqty']*$row['so_itemprice'])-($row['so_itemqty']*$row['so_itemprice']*$row['so_itemdiscount']/100),2);
        
        
        $sales_orderitem_array[]=$sales_orderitem_item;
    }

    return $sales_orderitem_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_orderitem_by_id($id){

    //$sql="SELECT * FROM sales_orderitem WHERE so_itemid = $so_itemid";
    $sql="SELECT sales_orderitem.so_itemid,sales_orderitem.so_salesorderid,sales_orderitem.so_itemproductid,sales_orderitem.so_itemprice,
    sales_orderitem.so_itemqty, sales_orderitem.so_itemdiscount, product.product_name FROM sales_orderitem JOIN product ON sales_orderitem.so_itemproductid=product.product_id WHERE sales_orderitem.so_salesorderid=$id";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_orderitem_item = new sales_orderitem();

    $sales_orderitem_item->so_itemid=$row["so_itemid"];
    $sales_orderitem_item->so_salesorderid=$row["so_salesorderid"];
    $sales_orderitem_item->so_itemproductid=$row["so_itemproductid"];
    $sales_orderitem_item->so_itemproduct_name=$row["product_name"];
    $sales_orderitem_item->so_itemprice=$row["so_itemprice"];
    $sales_orderitem_item->so_itemqty=$row["so_itemqty"];
    $sales_orderitem_item->so_itemdiscount=$row["so_itemdiscount"];
    $sales_orderitem_item->so_subtotal=round(($row["so_itemqty"]*$row["so_itemprice"]),2);
    $sales_orderitem_item->so_finaltotal=round(($row['so_itemqty']*$row['so_itemprice'])-($row['so_itemqty']*$row['so_itemprice']*$row['so_itemdiscount']/100),2);
    
       
    return $sales_orderitem_item;
}









// =====================================================================================================================================
}






?>