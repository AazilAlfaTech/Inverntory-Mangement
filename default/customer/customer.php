<?php

include_once "../../files/config.php";
include_once "../customer_group/customer_group.php";

class customer{
 


  public  $customer_id;
  public  $customer_code;
  public  $customer_name;
  public  $customer_add;
  public  $customer_contactno;
  public  $customer_email;
  public  $customer_city;
  public  $customer_group;
  public  $customer_salesrep;
  public  $customer_creditdays;
  public  $customer_creditlimit;
  public  $customer_status;
  public  $customer_date;
    




private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW CUSTOMER ------------------------------------------------------------------------------------------------------------------


function insert_customer(){

 $sql="INSERT INTO customer (customer_code,customer_name,customer_add,customer_contactno,customer_email,
 customer_city,customer_group,customer_salesrep,customer_creditdays,customer_creditlimit)
 VALUES('$this->customer_code','$this->customer_name','$this->customer_add','$this->customer_contactno','$this->customer_email',
 '$this->customer_city','$this->customer_group','$this->customer_salesrep','$this->customer_creditdays','$this->customer_creditlimit')
 ";

    echo $sql;
    $this->db->query($sql);
    return true;

}

// ----EDIT CUSTOMER GROUP------------------------------------------------------------------------------------------------------------------


function get_all_customer(){

    $sql="SELECT * FROM customer WHERE customer_status='ACTIVE' ";
    echo $sql;
    $result=$this->db->query($sql);

    $customer_array=array();

    while($row=$result->fetch_array()){

         $customer_item = new customer();

         $customer_item-> customer_id=$row["customer_id"];
         $customer_item-> customer_code=$row["customer_code"];
         $customer_item->customer_name=$row["customer_name"];
         $customer_item->customer_add=$row["customer_add"];
         $customer_item->customer_contactno=$row["customer_contactno"];
         $customer_item->customer_email=$row["customer_email"];
         $customer_item->customer_city=$row["customer_city"];
         $customer_item-> customer_group=$row["customer_group"];
         $customer_item-> customer_salesrep=$row["customer_salesrep"];
         $customer_item->customer_creditdays=$row["customer_creditdays"];
         $customer_item->customer_creditlimit=$row["customer_creditlimit"];
         $customer_item-> customer_status=$row["customer_status"];
         $customer_item-> customer_date=$row["customer_date"];
        
        $customer_array[]=$customer_item;
    }

    return $customer_array;
}

// ----GET ALL CUSTOMER ------------------------------------------------------------------------------------------------------------------



function get_customer_by_id($cus_grp_id){

    $sql="SELECT * FROM customer WHERE customer_id = $cus_grp_id";
    echo $sql;
    $result=$this->db->query($sql);



    $row=$result->fetch_array();

    $customer_item = new customer();

    $customer_group1 = new customergroup();

    $customer_item->customer_id=$row["customer_id"];
    $customer_item->customer_code=$row["customer_code"];
    $customer_item->customer_name=$row["customer_name"];
    $customer_item->customer_add=$row["customer_add"];
    $customer_item->customer_contactno=$row["customer_contactno"];
    $customer_item->customer_email=$row["customer_email"];
    $customer_item->customer_city=$row["customer_city"];
    $customer_item->customer_group=$row["customer_group"];

    $customer_item->customer_group=$customer_group1->get_customer_group_by_id($row["customer_group"]);

    $customer_item->customer_salesrep=$row["customer_salesrep"];
    $customer_item->customer_creditdays=$row["customer_creditdays"];
    $customer_item->customer_creditlimit=$row["customer_creditlimit"];


    $customer_item->customer_status=$row["customer_status"];

       
    return $customer_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_customer($cus_grp_id){

    $sql="UPDATE customer  SET 
    customer_code='$this->customer_code', customer_name='$this->customer_name',location_add='$this->location_add',location_number='$this->location_number',location_email='$this->location_email'
    WHERE customer_id=$cus_grp_id ";

    echo $sql;
    $this->db->query($sql);
    return true;


}

//-------------------------------------------------------------------------------------------------------------------

function delete_customer($customer_id){

    $sql="UPDATE customer SET customer_status='INACTIVE' WHERE customer_id=$customer_id ";

    
    echo $sql;
    $this->db->query($sql);
    return true;


}

//----------------------------------------------------------------------------------------------------------------------------

function get_customer_by_code($cus_grp_id){

    $sql="SELECT * FROM customer WHERE customer_code = '$cus_grp_id'";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $customer_item = new customer();

    $customer_item->customer_id=$row["customer_id"];
    $customer_item->customer_code=$row["customer_code"];
    $customer_item->customer_name=$row["customer_name"];
    $customer_item->customer_status=$row["customer_status"];

       
    return $customer_item;
}

//.......................................................................................



}
