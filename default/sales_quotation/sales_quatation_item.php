<?php
include_once "../../files/config.php";

class sales_quotationitem{ 

    public $sq_item_id;
    public $sq_item_quotid;
    public $sq_item_productid;
    public $sq_item_price;
    public $sq_item_qty;
    public $sq_item_discount;
    // public $sq_item_finalprice;
    public $sq_item_status;
    
 
  



    public $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_quotationitem------------------------------------------------------------------------------------------------------------------


function insert_sales_quotationitem($id)
{
    $product_list=0;
    foreach($_POST['sq_item_productid'] as $item)
    {
        $sql="INSERT INTO sales_quotationitem (sq_item_quotid,sq_item_productid,sq_item_price,sq_item_qty,sq_item_discount)
        VALUES($id,'".$_POST['sq_item_productid'][$product_list]."','".$_POST['sq_item_price1'][$product_list]."','".$_POST['sq_item_qty'][$product_list]."','".$_POST['sq_item_discount'][$product_list]."')";
        //echo $sql;
        $this->db->query($sql);
        $product_list++;
    }
    return true;

}




// ---------------------------------------------------------------------------------------------------------------------



function edit_sq_item()
{
    $product_list=0;
    foreach($_POST['sq_item_qty_edit'] as $item)
    {
        $sql="UPDATE sales_quotationitem SET sq_item_price='".$_POST['sq_item_price_edit'][$product_list]."',sq_item_qty='".$_POST['sq_item_qty_edit'][$product_list]."',sq_item_discount='".$_POST['sq_item_discount_edit'][$product_list]."'
        WHERE sq_item_id='".$_POST['sq_item_id_edit'][$product_list]."' ";
        //echo $sql;
        $this->db->query($sql);
        $product_list++;
    }
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

        $sales_quotationitem->sq_item_id=$row["sq_item_id"];
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


function get_sales_quotationitem_by_id($sq_itemid){

    $sql="SELECT * FROM sales_quotationitem WHERE sq_item_id = $sq_itemid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_quotationitem = new sales_quotationitem();

    $sales_quotationitem->sq_item_id=$row["sq_item_id"];
    $sales_quotationitem->sq_item_quotid=$row["sq_item_quotid"];
    $sales_quotationitem->sq_item_productid=$row["sq_item_productid"];
    $sales_quotationitem->sq_item_price=$row["sq_item_price"];
    $sales_quotationitem->sq_item_qty=$row["sq_item_qty"];
    $sales_quotationitem->sq_item_discount=$row["sq_item_discount"];
    $sales_quotationitem->sq_item_finalprice=$row["sq_item_finalprice"];
    $sales_quotationitem->sq_item_status=$row["sq_item_status"];
       
    return $sales_quotationitem;
}

// join sales quot and product table
function get_all_item_bysquotid($id)
{

    // $sql="SELECT * FROM sales_quotationitem WHERE sq_item_status='ACTIVE' ";
    $SQL="SELECT sales_quotationitem.sq_item_id,sales_quotationitem.sq_item_quotid,sales_quotationitem.sq_item_productid,sales_quotationitem.sq_item_price,sales_quotationitem.sq_item_qty,sales_quotationitem.sq_item_discount, product.product_name
    FROM sales_quotationitem INNER JOIN product ON sales_quotationitem.sq_item_productid=product.product_id WHERE sq_item_quotid=$id AND sq_item_status='ACTIVE' ";
    $result=$this->db->query($SQL);
    // echo $SQL;
    $sales_quotationitem_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_quotationitem = new sales_quotationitem();

        $sales_quotationitem->sq_item_id=$row["sq_item_id"];
        $sales_quotationitem->sq_item_quotid=$row["sq_item_quotid"];
        $sales_quotationitem->sq_item_productid=$row["sq_item_productid"];
        $sales_quotationitem->product_name=$row["product_name"];
        $sales_quotationitem->sq_item_price=$row["sq_item_price"];
        $sales_quotationitem->sq_item_qty=$row["sq_item_qty"];
        $sales_quotationitem->sq_item_discount=$row["sq_item_discount"];
        // $sales_quotationitem->sq_item_finalprice=$row["sq_item_finalprice"];
        $sales_quotationitem->sq_item_finalprice=round(($row['sq_item_qty']*$row['sq_item_price'])-($row['sq_item_qty']*$row['sq_item_price']*$row['sq_item_discount']/100),2);
        $sales_quotationitem->sq_item_subtotal=round($row["sq_item_qty"]*$row["sq_item_price"]);

        // $sales_quotationitem->sq_item_status=$row["sq_item_status"];

        
        
        $sales_quotationitem_array[]=$sales_quotationitem;
    }

    return $sales_quotationitem_array;
}

    function delete_sqitem($sq_id)
    {
        $sql="UPDATE sales_quotationitem SET sq_item_status='INACTIVE' WHERE sq_item_id=$sq_id ";
        $this->db->query($sql);
      
        echo true;
    }

    function update_sqitem($sq_quote_id)
    {
        
        $sql="UPDATE sales_quotationitem SET sq_item_status='INACTIVE' WHERE sq_item_quotid=$sq_quote_id ";
        $this->db->query($sql);
       // echo $sql; 
       
    }



   






// =====================================================================================================================================
}






?>