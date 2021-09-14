<?php
include_once "../../files/config.php";

class sales_order{ 

    public $salesorder_id;
    public $salesorder_quotid;
    public $salesorder_customer;
    public $salesorder_ref;
    public $salesorder_date;
    public $salesorder_status;
    
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----------------------------------------------------------------------------------------------------------------------


function insert_sales_order(){

    $sql="INSERT INTO sales_order (salesorder_quotid,salesorder_customer,salesorder_ref,salesorder_date)
    VALUES('$this->salesorder_quotid','$this->salesorder_customer','$this->salesorder_ref','$this->salesorder_date')
    ";
     echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}


// ---------------------------------------------------------------------------------------------------------------------
function so_code($so_date){

    // SELECT * FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE())
        $sql="SELECT COUNT(*) AS count FROM `purchase_request` WHERE MONTH(purchaserequest_date)= EXTRACT(MONTH FROM '$so_date') ";

        $sql1="SELECT  EXTRACT(MONTH FROM '$so_date') AS pr_month ";
        $sql2="SELECT  EXTRACT(YEAR FROM '$so_date') AS pr_year ";

        $result = $this->db->query($sql);
        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);

        $count= 0;


        while($row=$result->fetch_array()){

            $count = $row["count"];
        }

        
        $month = "";

        while($row=$result1->fetch_array()){

            $month = $row["pr_month"];
        }

        $month =sprintf("%02d", $month);

        $year = "";

        while($row=$result2->fetch_array()){

            $year = $row["pr_year"];
        }
        $count = $count + 1 ;
        $count = sprintf("%04d", $count);
//  $year = date("Y");


        $code = "SO".  substr($year, 2, 2 ) . $month . $count;  


        return $code;


    }


//--------------------------------------------------------------------------------------------------------------------------------


function edit_sales_order($salesorder_id){
 

    $sql="UPDATE sales_order  SET 
     salesorder_customer='$this->salesorder_customer'
     
     WHERE salesorder_id ='$salesorder_id' ";
    // echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_order($salesorder_id){

    $sql1="";
    $result=$this->db->query($sql1);

    if($result->num_rows==0){
    $sql="UPDATE sales_order SET salesorder_status='INACTIVE' WHERE salesorder_id=$salesorder_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;
}else
return false;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_order(){

   //$sql="SELECT * FROM sales_order WHERE salesorder_status='ACTIVE' ";
  $sql="SELECT sales_order.salesorder_id,sales_order.salesorder_quotid,sales_order.salesorder_customer,sales_order.salesorder_ref,sales_order.salesorder_date,customer.customer_name FROM sales_order JOIN customer ON sales_order.salesorder_customer=customer.customer_id WHERE sales_order.salesorder_status='ACTIVE'";
    $result=$this->db->query($sql);

    $sales_order_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_order_item = new sales_order();

        $sales_order_item->salesorder_id=$row["salesorder_id"];
        $sales_order_item->salesorder_quotid=$row["salesorder_quotid"];
        $sales_order_item->salesorder_customer=$row["salesorder_customer"];
        $sales_order_item->salesorder_customer_name=$row["customer_name"];
        $sales_order_item->salesorder_ref=$row["salesorder_ref"];
        $sales_order_item->salesorder_date=$row["salesorder_date"];
       // $sales_order_item->salesorder_status=$row["salesorder_status"];

        
        
        $sales_order_array[]=$sales_order_item;
    }

    return $sales_order_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_salesorder_by_id($orderid){


    $sql="SELECT sales_order.salesorder_id,sales_order.salesorder_quotid,sales_order.salesorder_customer,sales_order.salesorder_ref,sales_order.salesorder_date,customer.customer_name FROM sales_order JOIN customer ON sales_order.salesorder_customer=customer.customer_id WHERE sales_order.salesorder_status='ACTIVE' AND salesorder_id=$orderid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_order_item = new sales_order();

        $sales_order_item->salesorder_id=$row["salesorder_id"];
        $sales_order_item->salesorder_quotid=$row["salesorder_quotid"];
        $sales_order_item->salesorder_customer=$row["salesorder_customer"];
        $sales_order_item->salesorder_customer_name=$row["customer_name"];
        $sales_order_item->salesorder_ref=$row["salesorder_ref"];
        $sales_order_item->salesorder_date=$row["salesorder_date"];
       // $sales_order_item->salesorder_status=$row["salesorder_status"];

       
    return $sales_order_item;
}
// -----------------------------------------------------------------------------------------------------------------------


function get_sales_order_by_customer($x){

    $sql="SELECT sales_order.salesorder_id,sales_order.salesorder_quotid,sales_order.salesorder_customer,sales_order.salesorder_ref,sales_order.salesorder_date,customer.customer_name FROM sales_order JOIN customer ON sales_order.salesorder_customer=customer.customer_id WHERE sales_order.salesorder_status='ACTIVE' AND salesorder_customer = $x";

    //echo $sql;
    $result=$this->db->query($sql);
    $sales_order_array=array(); 

    while($row=$result->fetch_array()){

        $sales_order_item = new sales_order();

        $sales_order_item->salesorder_id=$row["salesorder_id"];
        $sales_order_item->salesorder_quotid=$row["salesorder_quotid"];
         $sales_order_item->salesorder_customer=$row["salesorder_customer"];
        $sales_order_item->salesorder_customer_name=$row["customer_name"];
        $sales_order_item->salesorder_ref=$row["salesorder_ref"];
        $sales_order_item->salesorder_date=$row["salesorder_date"];
        // $sales_order_item->salesorder_status=$row["salesorder_status"];

        
        
        $sales_order_array[]=$sales_order_item;
    }

    return $sales_order_array;
}








// =====================================================================================================================================
}






?>