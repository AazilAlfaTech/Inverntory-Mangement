<?php
include_once "../../files/config.php";
include_once "../sales_invoice/sales_invoice.php";
include_once "../sales_invoice/sales_invoice_item.php";
include_once "../product/fifocaulation.php";

class sales_dispatch_item{ 

    public $sd_item_id;
    public $sd_item_saledispatch_id;
    public $sd_item_invoiceid;
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


function insert_sales_dispatch_item1($sd_id){

    $salesinvoiceitem5=new sales_invoice_item();
    $salesinvoice5=new sales_invoice();
    $fifoitem =new fifocalculation();


    $list=0;
   
    //include orderid
    foreach($_POST['Quantity'] as $item){
        $sql="INSERT INTO sales_dispatch_item (sd_item_qty,sd_item_invoiceid,sd_item_productid,sd_item_price,sd_item_discount,sd_item_saledispatch_id)VALUES 
        ('".$_POST['Quantity'][$list]."','".$_POST['Orderid'][$list]."','".$_POST['Product'][$list]."','".$_POST['Price'][$list]."','".$_POST['Discount'][$list]."',$sd_id)";
         $this->db->query($sql);
        // echo $sql;

         
        if($_POST['Product'][$list]>0)
        {
            //get the inventory valuation type of product( FIFO/AVCO)
            $sql_product="SELECT product_inventory_val FROM product WHERE product_id='".$_POST['Product'][$list]."'";
            $res_inventory=$this->db->query($sql_product);
            $row_item=$res_inventory->fetch_array();
            $inventory=$row_item['product_inventory_val'];
         

            if($inventory=='FIFO'){
                echo'FIFO';
            $fifoitem-> insert_fifo($_POST['Quantity'][$list],$_POST['Product'][$list],$sd_id);
               
            }else if($inventory=='AVCO'){
                    echo 'AVCO';
                $res=$fifoitem->insert_avco($_POST['Quantity'][$list],$_POST['Product'][$list],$sd_id);
            
            }
        }

      
       $salesinvoiceitem5->update_salesinvoice_item_currentstatus($_POST['InvoiceItemid'][$list],$_POST['CurrentStatus'][$list]);
       $salesinvoice5->sales_invoice_status($_POST['Orderid'][$list]);
       $list++;
    }
   
    return true;

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