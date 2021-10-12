<?php
include_once "../../files/config.php";

class sales_dispatch{ 

    public $salesdispatch_id;
    
    public $salesdispatch_customer;
    public $salesdispatch_ref;
    public $salesdispatch_paymethod;
    public $salesdispatch_date;
    public $salesdispatch_status;
    public $salesdispatch_loc;
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_dispatch------------------------------------------------------------------------------------------------------------------


function insert_sales_dispatch(){

    $sql="INSERT INTO sales_dispatch (salesdispatch_loc,salesdispatch_ref,salesdispatch_date,salesdispatch_customer)
    VALUES('$this->salesdispatch_loc','$this->salesdispatch_ref','$this->salesdispatch_date','$this->salesdispatch_customer')";
      // echo $sql;
       $this->db->query($sql);
    $sd_id=$this->db->insert_id;
    return $sd_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_dispatch($salesdispatch_id){
 

    $sql="UPDATE sales_dispatch  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE salesdispatch_id ='$salesdispatch_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}
//-------------------------------------------------------------------------------------------------------------------
function sd_code($sd_date){

    // SELECT * FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE())
        $sql="SELECT COUNT(*) AS count FROM `sales_dispatch` WHERE MONTH(salesdispatch_date)= EXTRACT(MONTH FROM '$sd_date') ";

        $sql1="SELECT  EXTRACT(MONTH FROM '$sd_date') AS sd_month ";
        $sql2="SELECT  EXTRACT(YEAR FROM '$sd_date') AS sd_year ";

        $result = $this->db->query($sql);
        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);

        $count= 0;


        while($row=$result->fetch_array()){

            $count = $row["count"];
        }

        
        $month = "";

        while($row=$result1->fetch_array()){

            $month = $row["sd_month"];
        }

        $month =sprintf("%02d", $month);

        $year = "";

        while($row=$result2->fetch_array()){

            $year = $row["sd_year"];
        }
        $count = $count + 1 ;
        $count = sprintf("%04d", $count);
//  $year = date("Y");


        $code = "SD".  substr($year, 2, 2 ) . $month . $count;  


        return $code;


    }


//-------------------------------------------------------------------------------------------------------------------

function delete_sales_dispatch($salesdispatch_id){

    $sql="UPDATE sales_dispatch SET salesdispatch_status='INACTIVE' WHERE salesdispatch_id = $salesdispatch_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_dispatch(){

    $sql="SELECT sales_dispatch.salesdispatch_id,sales_dispatch.salesdispatch_customer, sales_dispatch.salesdispatch_ref, sales_dispatch.salesdispatch_date,customer.customer_name FROM `sales_dispatch` JOIN customer ON sales_dispatch.salesdispatch_customer=customer.customer_id WHERE sales_dispatch.salesdispatch_status='ACTIVE'";
  
    $result=$this->db->query($sql);

    $sales_dispatch_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_dispatch_item = new sales_dispatch();

        $sales_dispatch_item->salesdispatch_id=$row["salesdispatch_id"];
        $sales_dispatch_item->salesdispatch_customer=$row["salesdispatch_customer"];
        $sales_dispatch_item->salesdispatch_customer_name=$row["customer_name"];
        $sales_dispatch_item->salesdispatch_ref=$row["salesdispatch_ref"];
        $sales_dispatch_item->salesdispatch_date=$row["salesdispatch_date"];
       
        

        
        
        $sales_dispatch_array[]=$sales_dispatch_item;
    }

    return $sales_dispatch_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_dispatch_by_id($salesdispatch_id){

    $sql="SELECT sales_dispatch.salesdispatch_id,sales_dispatch.salesdispatch_customer, sales_dispatch.salesdispatch_ref, sales_dispatch.salesdispatch_date,customer.customer_name FROM `sales_dispatch` JOIN customer ON sales_dispatch.salesdispatch_customer=customer.customer_id WHERE sales_dispatch.salesdispatch_status='ACTIVE' AND salesdispatch_id = $salesdispatch_id";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_dispatch_item = new sales_dispatch();

    $sales_dispatch_item->salesdispatch_id=$row["salesdispatch_id"];
    $sales_dispatch_item->salesdispatch_customer=$row["salesdispatch_customer"];
    $sales_dispatch_item->salesdispatch_ref=$row["salesdispatch_ref"];
    $sales_dispatch_item->salesdispatch_date=$row["salesdispatch_date"];
    return $sales_dispatch_item;
}

//============================================================================================================================================

function sales_dispatch_report(){
    //with customer
    //$sql="SELECT sales_dispatch.salesdispatch_date,sales_dispatch.salesdispatch_ref,sales_invoice.salesinvoice_ref,product.product_code,product.product_name, customer.customer_name,sales_dispatch_item.sd_item_qty FROM customer JOIN sales_dispatch ON customer.customer_id=sales_dispatch.salesdispatch_customer JOIN sales_dispatch_item ON sales_dispatch.salesdispatch_id=sales_dispatch_item.sd_item_saledispatch_id JOIN sales_invoice ON sales_dispatch_item.sd_item_invoiceid=sales_invoice.salesinvoice_id JOIN product ON sales_dispatch_item.sd_item_productid=product.product_id WHERE sales_dispatch_item.sd_item_status='ACTIVE'";
    //without customer
    $sql="SELECT sales_dispatch.salesdispatch_date,sales_dispatch.salesdispatch_ref,sales_invoice.salesinvoice_ref,product.product_code,product.product_name, sales_dispatch_item.sd_item_qty FROM sales_dispatch JOIN sales_dispatch_item ON sales_dispatch.salesdispatch_id=sales_dispatch_item.sd_item_saledispatch_id JOIN sales_invoice ON sales_dispatch_item.sd_item_invoiceid=sales_invoice.salesinvoice_id JOIN product ON sales_dispatch_item.sd_item_productid=product.product_id WHERE sales_dispatch_item.sd_item_status='ACTIVE'";
    $result=$this->db->query($sql);
    $array_dispatch=array();

    while($row=$result->fetch_array()){

        $salesdispatch_item=new sales_dispatch();
        $salesdispatch_item->salesdispatch_date=$row['salesdispatch_date'];
        $salesdispatch_item->salesdispatch_ref=$row['salesdispatch_ref'];
        $salesdispatch_item->salesinvoice_ref=$row['salesinvoice_ref'];
        $salesdispatch_item->product_code=$row['product_code'];
        $salesdispatch_item->product_name=$row['product_name'];
        $salesdispatch_item->sd_item_qty=$row['sd_item_qty'];
        // $salesdispatch_item->=$row[''];
        // $salesdispatch_item->=$row[''];
        // $salesdispatch_item->=$row[''];

        $array_dispatch[]=$salesdispatch_item;
    }

    return $array_dispatch;
}
function sales_dispatch_report_filter(){
    
    $filter_product=$_POST['filter_product'];
    $filter_startdt=$_POST['filter_startdt'];
    $filter_enddt=$_POST['filter_enddt'];
    
    $sql="SELECT sales_dispatch.salesdispatch_date,sales_dispatch.salesdispatch_ref,sales_invoice.salesinvoice_ref,product.product_code,product.product_name, sales_dispatch_item.sd_item_qty FROM sales_dispatch JOIN sales_dispatch_item ON sales_dispatch.salesdispatch_id=sales_dispatch_item.sd_item_saledispatch_id JOIN sales_invoice ON sales_dispatch_item.sd_item_invoiceid=sales_invoice.salesinvoice_id JOIN product ON sales_dispatch_item.sd_item_productid=product.product_id WHERE sales_dispatch_item.sd_item_status='ACTIVE'";
    
    if($filter_product!=-1){
        $sql.=" and product_name='$filter_product'";
    }
    if($filter_startdt!='' && $filter_enddt!=''){
        $sql.="and salesdispatch_date BETWEEN  '".$_POST['filter_startdt']."' AND '".$_POST['filter_enddt']."' "; 
      
    }
    
    $result=$this->db->query($sql);
    $array_dispatch=array();

    while($row=$result->fetch_array()){

        $salesdispatch_item=new sales_dispatch();
        $salesdispatch_item->salesdispatch_date=$row['salesdispatch_date'];
        $salesdispatch_item->salesdispatch_ref=$row['salesdispatch_ref'];
        $salesdispatch_item->salesinvoice_ref=$row['salesinvoice_ref'];
        $salesdispatch_item->product_code=$row['product_code'];
        $salesdispatch_item->product_name=$row['product_name'];
        $salesdispatch_item->sd_item_qty=$row['sd_item_qty'];
       
        $array_dispatch[]=$salesdispatch_item;
    }

    return $array_dispatch;
}







// =====================================================================================================================================
}






?>