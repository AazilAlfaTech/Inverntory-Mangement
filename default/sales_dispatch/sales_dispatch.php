<?php
include_once "../../files/config.php";

class sales_dispatch{ 

    public $salesdispatch_id;
    public $salesdispatch_si_id;
    public $salesdispatch_customer;
    public $salesdispatch_ref;
    public $salesdispatch_paymethod;
    public $salesdispatch_date;
    public $salesdispatch_status;
    
    
    
 
  



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_dispatch------------------------------------------------------------------------------------------------------------------


function insert_sales_dispatch(){

    $sql="INSERT INTO sales_dispatch (salesdispatch_ref,salesdispatch_date,salesdispatch_customer)
    VALUES('$this->salesdispatch_ref','$this->salesdispatch_date','$this->salesdispatch_customer')";
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









// =====================================================================================================================================
}






?>