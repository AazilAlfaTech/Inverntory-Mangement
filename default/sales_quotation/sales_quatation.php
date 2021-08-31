<?php
include_once "../../files/config.php";

class sales_quotation{ 

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

    $sql="SELECT * FROM sales_quotation WHERE salesquot_status='ACTIVE' ";
  
    $result=$this->db->query($sql);

    $sales_quotation_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_quotation_item = new sales_quotation();

        $sales_quotation_item->salesquot_id=$row["salesquot_id"];

        $sales_quotation_item->salesquot_customer=$row["salesquot_customer"];
        $sales_quotation_item->salesquot_ref=$row["salesquot_ref"];
        $sales_quotation_item->salesquot_date=$row["salesquot_date"];
        $sales_quotation_item->salesquot_status=$row["salesquot_status"];

        
        
        $sales_quotation_array[]=$sales_quotation_item;
    }

    return $sales_quotation_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_purchaserequest_by_id($sales_quotationid){

    $sql="SELECT * FROM sales_quotation WHERE purchaserequest_id = $sales_quotationid";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_quotation_item = new sales_quotation();

    $sales_quotation_item->salesquot_id=$row["salesquot_id"];

    $sales_quotation_item->salesquot_customer=$row["salesquot_customer"];
    $sales_quotation_item->salesquot_ref=$row["salesquot_ref"];
    $sales_quotation_item->salesquot_date=$row["salesquot_date"];
    $sales_quotation_item->salesquot_status=$row["salesquot_status"];

       
    return $sales_quotation_item;
}







// ========================================================================================================================================
}










?>