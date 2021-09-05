<?php
include_once "../../files/config.php";

class sales_quotation2{ 

    public $salesquot_id;
    public $salesquot_customer;
    public $salesquot_ref;
    public $salesquot_date;
    public $salesquot_status;



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_quotation------------------------------------------------------------------------------------------------------------------


function insert_sales_quotation (){

    $sql="INSERT INTO sales_quotation (salesquot_customer,salesquot_ref,salesquot_date)
    VALUES('$this->salesquot_customer','$this->salesquot_ref','$this->salesquot_date')
    ";
       echo $sql;
       $this->db->query($sql);
    $sq_id=$this->db->insert_id;
    return $sq_id;

}

//-------------------------------------------------------------------------------------------------------------------
function edit_sales_quotation($salesquotation_id){
 

    $sql="UPDATE sales_quotation  SET 
     salesquotation_customer='$this->salesquot_customer'
     
     WHERE salesquotation_id ='$salesquotation_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_quotation($salesquotation_id){

    $sql="UPDATE sales_quotation SET salesquotation_status='INACTIVE' WHERE salesquot_id=$salesquotation_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_quotation(){

    //$sql="SELECT * FROM sales_quotation WHERE salesquot_status='ACTIVE' ";
    $sql="SELECT sales_quotation.salesquot_id,sales_quotation.salesquot_customer,sales_quotation.salesquot_ref,sales_quotation.salesquot_date,customer.customer_name FROM sales_quotation JOIN customer ON sales_quotation.salesquot_id=customer.customer_id WHERE sales_quotation.salesquot_status='ACTIVE'";
  
    $result=$this->db->query($sql);

    $sales_quotation_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_quotation_item = new sales_quotation();

        $sales_quotation_item->salesquot_id=$row["salesquot_id"];
        $sales_quotation_item->salesquot_customer=$row["salesquot_customer"];
        $sales_quotation_item->salesquot_customer_name=$row["customer_name"];
        $sales_quotation_item->salesquot_ref=$row["salesquot_ref"];
        $sales_quotation_item->salesquot_date=$row["salesquot_date"];
        

        
        
        $sales_quotation_array[]=$sales_quotation_item;
    }

    return $sales_quotation_array;
}

function get_all_sales_quotationitem($itemid){

    //$sql="SELECT * FROM sales_quotationitem WHERE sq_item_status='ACTIVE' ";
    $sql="SELECT sales_quotationitem.sq_item_id,sales_quotationitem.sq_item_quotid,sales_quotationitem.sq_item_productid,
    sales_quotationitem.sq_item_price,sales_quotationitem.sq_item_qty,sales_quotationitem.sq_item_qty,sales_quotationitem.sq_item_discount,
    product.product_name FROM sales_quotationitem JOIN product ON sales_quotationitem.sq_item_productid=product.product_id WHERE sales_quotationitem.sq_item_quotid=$itemid AND sales_quotationitem.sq_item_status='ACTIVE'";
  
    $result=$this->db->query($sql);

    $sales_quotationitem_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_quotationitem = new sales_quotationitem();


        $sales_quotationitem->sq_item_quotid=$row["sq_item_quotid"];
        $sales_quotationitem->sq_item_productid=$row["sq_item_productid"];
        $sales_quotationitem->sq_item_productname=$row["product_name"];
        $sales_quotationitem->sq_item_price=$row["sq_item_price"];
        $sales_quotationitem->sq_item_qty=$row["sq_item_qty"];
        $sales_quotationitem->sq_item_discount=$row["sq_item_discount"];
        $sales_quotationitem->sq_item_subtotal=round(($row["sq_item_qty"]*$row["sq_item_price"]),2);
        $sales_quotationitem->sq_item_finaltotal=round(($row['sq_item_qty']*$row['sq_item_price'])-($row['sq_item_qty']*$row['sq_item_price']*$row['sq_item_discount']/100),2);
       

        
        
        $sales_quotationitem_array[]=$sales_quotationitem;
    }

    return $sales_quotationitem_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_salesquotation_by_id($salesquotationid){

    //$sql="SELECT * FROM sales_quotation WHERE purchaserequest_id = $sales_quotationid";
    $sql="SELECT sales_quotation.salesquot_id,sales_quotation.salesquot_customer,sales_quotation.salesquot_ref,sales_quotation.salesquot_date,customer.customer_name FROM sales_quotation JOIN customer ON sales_quotation.salesquot_id=customer.customer_id WHERE sales_quotation.salesquot_status='ACTIVE' AND salesquot_id=$salesquotationid ";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_quotation_item = new sales_quotation();

    $sales_quotation_item->salesquot_id=$row["salesquot_id"];

    $sales_quotation_item->salesquot_customer=$row["salesquot_customer"];
    $sales_quotation_item->salesquot_customer_name=$row["customer_name"];
    $sales_quotation_item->salesquot_ref=$row["salesquot_ref"];
    $sales_quotation_item->salesquot_date=$row["salesquot_date"];
   

       
    return $sales_quotation_item;
}







// ========================================================================================================================================
}