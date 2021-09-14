<?php
include_once "../../files/config.php";
include_once "../customer/customer.php";
class sales_quotation
{ 

    public $salesquot_id;
    public $salesquot_customer;
    public $salesquot_ref;
    public $salesquot_date;
    public $salesquot_status;



    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct()
{
          
    $this->db=new mysqli(host,un,pw,db1);
    return true;
}

// ----INSERT NEW sales_quotation------------------------------------------------------------------------------------------------------------------


function insert_sales_quotation (){

    $sql="INSERT INTO sales_quotation (salesquot_customer,salesquot_ref,salesquot_date)
    VALUES('$this->salesquot_customer','$this->salesquot_ref','$this->salesquot_date')
    ";
    //  echo $sql;
    $this->db->query($sql);
    $sq_id=$this->db->insert_id;
    return $sq_id;

}

// Sales quotation code
// Genearte the grn code.............................................................................................. 
    function salesquot_code($squot_date)
    {
        $sql="SELECT COUNT(*) AS count FROM `sales_quotation` WHERE MONTH(salesquot_date)= EXTRACT(MONTH FROM '$squot_date') ";

            $sql1="SELECT  EXTRACT(MONTH FROM '$squot_date') AS squot_month ";
            $sql2="SELECT  EXTRACT(YEAR FROM '$squot_date') AS squot_year ";

            $result = $this->db->query($sql);
            $result1 = $this->db->query($sql1);
            $result2 = $this->db->query($sql2);

            $count= 0;


            while($row=$result->fetch_array()){

                $count = $row["count"];
            }

            
            $month = "";

            while($row=$result1->fetch_array()){

                $month = $row["squot_month"];
            }

            $month =sprintf("%02d", $month);

            $year = "";

            while($row=$result2->fetch_array()){

                $year = $row["squot_year"];
            }

    
            

            $count = $count + 1 ;
            $count = sprintf("%04d", $count);


            //  $year = date("Y");


            $code = "SQ".  substr($year, 2, 2 ) . $month . $count;  


            return $code;


        }

//-------------------------------------------------------------------------------------------------------------------
function edit_sales_quotation($salesquotation_id){
 

    $sql="UPDATE sales_quotation  SET 
     salesquot_customer='$this->salesquot_customer'
     
     WHERE salesquot_id ='$salesquotation_id' ";
    // echo $sql;
    $this->db->query($sql);
    return true;
}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_quotation($salesquotation_id)
{

    $sql1="";
    $result=$this->db->query($sql1);
    if($result->num_rows==0)
    {
        $sql="UPDATE sales_quotation SET salesquot_status='INACTIVE' WHERE salesquot_id=$salesquotation_id ";
        //echo $sql;
        $this->db->query($sql);
        return true;
    }
    else
    return false;

}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_quotation(){

    $sql="SELECT * FROM sales_quotation WHERE salesquot_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_quotation_array=array(); //array created
    $s_cust=new customer();
    while($row=$result->fetch_array()){

        $sales_quotation_item = new sales_quotation();

        $sales_quotation_item->salesquot_id=$row["salesquot_id"];
        // $sales_quotation_item->salesquot_customer=$row["salesquot_customer"];
        $sales_quotation_item->salesquot_customer=$s_cust->get_customer_by_id($row["salesquot_customer"]);
        $sales_quotation_item->salesquot_ref=$row["salesquot_ref"];
        $sales_quotation_item->salesquot_date=$row["salesquot_date"];
        $sales_quotation_item->salesquot_status=$row["salesquot_status"];

        
        
        $sales_quotation_array[]=$sales_quotation_item;
    }

    return $sales_quotation_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_salesquotation_by_id($sales_quotationid){

    $sql="SELECT * FROM sales_quotation WHERE salesquot_id = $sales_quotationid";

    // echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
    $s_cust=new customer();
    $sales_quotation_item = new sales_quotation();

    $sales_quotation_item->salesquot_id=$row["salesquot_id"];
    // $sales_quotation_item->salesquot_customer=$row["salesquot_customer"];
    $sales_quotation_item->salesquot_customer=$s_cust->get_customer_by_id($row["salesquot_customer"]);
    $sales_quotation_item->salesquot_ref=$row["salesquot_ref"];
    $sales_quotation_item->salesquot_date=$row["salesquot_date"];
    $sales_quotation_item->salesquot_status=$row["salesquot_status"];

       
    return $sales_quotation_item;
}









// ========================================================================================================================================
}










?>