<?php
include_once "../../files/config.php";

class purchaseorderitem{
   

    public $po_item_id;
    public $po_item_orderid;
    public $po_item_productid;
    public $po_item_qty;
    public $po_item_price;
    public $po_item_discount;
    public $po_item_finalprice;
    public $po_item_status;
    public $db;


    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    
    }

function insert_POitem1($orderid){

   $list=0;


    
   foreach($_POST['Quantity'] as $item){
    $sql="INSERT INTO purchase_order_item (po_item_qty,po_item_productid,po_item_discount,po_item_price,po_item_orderid) VALUES 
    ('".$_POST['Quantity'][$list]."','".$_POST['Product'][$list]."','".$_POST['Discount'][$list]."','".$_POST['Price'][$list]."',$orderid)";
   
    echo $sql;
        $this->db->query($sql);
       $list++;
}
return true;
}

function insert_POitem(){

    $list=0;
 
 
     foreach($_POST['Quantity'] as $item){
         $sql="INSERT INTO purchase_order_item (po_item_qty,po_item_productid,po_item_discount,po_item_price) VALUES 
         ('".$_POST['Quantity'][$list]."','".$_POST['Product'][$list]."','".$_POST['Discount'][$list]."','".$_POST['Price'][$list]."')";
        
         echo $sql;
             $this->db->query($sql);
            $list++;
     }
     return true;
 }

 function edit_POitem(){

    $list=0;

    foreach($_POST['Quantity'] as $item){
        $sql="UPDATE purchase_order_item SET po_item_qty='".$_POST['Quantity'][$list]."',po_item_price ='".$_POST['Price'][$list]."',po_item_discount='".$_POST['Discount'][$list]."' WHERE po_item_id='".$_POST['Orderid'][$list]."' ";
        echo $sql;
        $this->db->query($sql);
       $list++;
    }

    return true;

}

function get_all_POitem($purch_order_id){
   // $sql="SELECT * FROM purchase_order_item WHERE po_item_orderid='$purch_order_id' ";
    $sql="SELECT purchase_order_item.po_item_id ,purchase_order_item.po_item_orderid ,purchase_order_item.po_item_productid , purchase_order_item.po_item_qty , purchase_order_item.po_item_price ,purchase_order_item.po_item_discount ,product.product_name FROM purchase_order_item INNER JOIN product ON purchase_order_item.po_item_productid=product.product_id WHERE po_item_orderid=$purch_order_id";
    $result=$this->db->query($sql);
    //echo $sql;
    $array_purchaseorderitem=array();
    while($row=$result->fetch_array()){
        $PO_item=new purchaseorderitem();

        $PO_item->po_item_id=$row['po_item_id'];
        $PO_item->po_item_orderid=$row['po_item_orderid'];
        $PO_item->po_item_productid=$row['po_item_productid'];
        $PO_item->product_name=$row["product_name"];
        $PO_item->po_item_qty=$row['po_item_qty'];
        $PO_item->po_item_price=$row['po_item_price'];
        $PO_item->po_item_discount=$row['po_item_discount'];
       $PO_item->po_item_finalprice=round(($row['po_item_qty']*$row['po_item_price'])-($row['po_item_qty']*$row['po_item_price']*$row['po_item_discount']/100),2);
       
       $array_purchaseorderitem[]=$PO_item;

    }
    return $array_purchaseorderitem;

}



}
?>