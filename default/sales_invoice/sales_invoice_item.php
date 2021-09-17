<?php
include_once "../../files/config.php";
include_once "../sales_order/sales_order_item.php";
include_once "../sales_order/sales_order.php";

class sales_invoice_item{ 

    public $si_itemid;
    public $si_item_invoiceid;
    public $si_item_orderid;
    public $si_item_price;
    public $si_item_qty;
    public $si_item_discount;
    public $si_item_productid;
    public $si_item_status;
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}





function insert_sales_invoice_item1($so_id){

    $orderitem5=new sales_orderitem();
    $order5=new sales_order();

    $list=0;
   
    //include orderid
    foreach($_POST['Quantity'] as $item){
        $sql="INSERT INTO sales_invoice_item (si_item_qty,si_item_orderid,si_item_productid,si_item_price,si_item_discount,si_item_invoiceid)VALUES 
        ('".$_POST['Quantity'][$list]."','".$_POST['Orderid'][$list]."','".$_POST['Product'][$list]."','".$_POST['Price'][$list]."','".$_POST['Discount'][$list]."',$so_id)";
       echo $sql;
       $this->db->query($sql);
       $orderitem5->update_sales_orderitem($_POST['OrderItemid'][$list]);
       $order5->sales_order_status($_POST['Orderid'][$list]);
       $list++;
    }
    
    return true;

}



// ---------------------------------------------------------------------------------------------------------------------



// function edit_sales_invoice_item($si_itemid){
 

//     $sql="UPDATE sales_invoice_item  SET 
//      salesorder_customer='$this->salesorder_customer'
     
//      WHERE si_itemid ='$si_itemid' ";
//    // echo $sql;
//     $this->db->query($sql);
//     return true;

   


// }


function edit_sales_invoice_item(){
 
    $list2=0;

    foreach($_POST['Quantity_edit'] as $item){
        $sql="UPDATE sales_invoice_item SET si_item_qty='".$_POST['Quantity_edit'][$list2]."',si_item_price ='".$_POST['Price_edit'][$list2]."',si_item_discount='".$_POST['Discount_edit'][$list2]."' WHERE si_itemid='".$_POST['Orderid'][$list2]."' ";
        // echo $sql;
        $this->db->query($sql);
       $list2++;
    }

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

//get all item by sales invoice item id
function get_all_sales_invoice_item($si_itemid ){

    $sql="SELECT sales_invoice_item.si_itemid ,sales_invoice_item.si_item_invoiceid,sales_invoice_item.si_item_orderid,
    sales_invoice_item.si_item_productid,sales_invoice_item.si_item_price,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_discount,
    product.product_name
    FROM sales_invoice_item JOIN product ON sales_invoice_item.si_item_productid=product.product_id WHERE sales_invoice_item.si_item_status='ACTIVE' AND sales_invoice_item.si_itemid = $si_itemid ";
  
    $result=$this->db->query($sql);

    $sales_invoice_item_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_invoice_item_item = new sales_invoice_item();

        $sales_invoice_item_item->si_itemid=$row["si_itemid"];
        $sales_invoice_item_item->si_item_invoiceid=$row["si_item_invoiceid"];
        $sales_invoice_item_item->si_item_orderid=$row["si_item_orderid"];
        $sales_invoice_item_item->si_item_productid=$row["si_item_productid"];
        $sales_invoice_item_item->si_item_productname=$row["product_name"];
        $sales_invoice_item_item->si_item_price=$row["si_item_price"];
        $sales_invoice_item_item->si_item_qty=$row["si_item_qty"];
        $sales_invoice_item_item->si_item_discount=$row["si_item_discount"];
        $sales_invoice_item_item->si_item_subtotal=round(($row["si_item_price"]*$row["si_item_qty"]),2);
        $sales_invoice_item_item->si_item_subtotal=round(($row["si_item_price"]*$row["si_item_qty"])-($row["si_item_price"]*$row["si_item_qty"]*$row["si_item_discount"]/100),2);
      
        
        
        $sales_invoice_item_array[]=$sales_invoice_item_item;
    }

    return $sales_invoice_item_array;
}





// ----------------------------------------------------------------------------------------------------------------------------



//get all item by invoice id
function get_all_sales_invoice_invoiceid($si_invoiceid ){

    $sql="SELECT sales_invoice_item.si_itemid ,sales_invoice_item.si_item_invoiceid,sales_invoice_item.si_item_orderid,
    sales_invoice_item.si_item_productid,sales_invoice_item.si_item_price,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_discount,
    product.product_name
    FROM sales_invoice_item JOIN product ON sales_invoice_item.si_item_productid=product.product_id WHERE sales_invoice_item.si_item_status='ACTIVE' AND sales_invoice_item.si_item_invoiceid = $si_invoiceid";
   // echo $sql;
    $result=$this->db->query($sql);

    $sales_invoice_item_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_invoice_item_item = new sales_invoice_item();

        $sales_invoice_item_item->si_itemid=$row["si_itemid"];
        $sales_invoice_item_item->si_item_invoiceid=$row["si_item_invoiceid"];
        $sales_invoice_item_item->si_item_orderid=$row["si_item_orderid"];
        $sales_invoice_item_item->si_item_productid=$row["si_item_productid"];
        $sales_invoice_item_item->si_item_productname=$row["product_name"];
        $sales_invoice_item_item->si_item_price=$row["si_item_price"];
        $sales_invoice_item_item->si_item_qty=$row["si_item_qty"];
        $sales_invoice_item_item->si_item_discount=$row["si_item_discount"];
        $sales_invoice_item_item->si_item_subtotal=round(($row["si_item_price"]*$row["si_item_qty"]),2);
        $sales_invoice_item_item->si_item_finaltotal=round(($row['si_item_price']*$row['si_item_qty'])-($row['si_item_qty']*$row['si_item_price']*$row['si_item_discount']/100),2);
       

        
        
        $sales_invoice_item_array[]=$sales_invoice_item_item;
    }

    return $sales_invoice_item_array;
}









// =====================================================================================================================================
}






?>