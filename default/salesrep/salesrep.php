<?php

include_once "../../files/config.php";

class salesrep{
 
public $salesrep_code;
public $salesrep_name;
// public $salesrep_province;
public $salesrep_status;
public $salesrep_date;

private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW salesrep------------------------------------------------------------------------------------------------------------------


function insert_salesrep()
{
    $sql="INSERT INTO salesrep (salesrep_code,salesrep_name)
    VALUES('$this->salesrep_code','$this->salesrep_name')";
    //echo $sql;
    $this->db->query($sql);
    $srep_id=$this->db->insert_id;
    return $srep_id;

}

// ----EDIT salesrep------------------------------------------------------------------------------------------------------------------


function get_all_salesrep(){

    $sql="SELECT * FROM salesrep WHERE salesrep_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);

    $salesrep_array=array();

    while($row=$result->fetch_array()){

        $salesrep_item = new salesrep();

        $salesrep_item->salesrep_id=$row["salesrep_id"];
        $salesrep_item->salesrep_code=$row["salesrep_code"];
        $salesrep_item->salesrep_name=$row["salesrep_name"];
        // $salesrep_item->salesrep_province=$row["salesrep_province"];
        $salesrep_item->salesrep_status=$row["salesrep_status"];
        $salesrep_item->salesrep_date=$row["salesrep_date"];

        $salesrep_array[]=$salesrep_item;
    }

    return $salesrep_array;
}

// ----GET ALL salesrep------------------------------------------------------------------------------------------------------------------



function get_salesrep_by_id($salesrepid){

    $sql="SELECT * FROM salesrep WHERE salesrep_id = $salesrepid";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $salesrep_item = new salesrep();

    $salesrep_item->salesrep_id=$row["salesrep_id"];
    $salesrep_item->salesrep_code=$row["salesrep_code"];
    $salesrep_item->salesrep_name=$row["salesrep_name"];
    // $salesrep_item->salesrep_province=$row["salesrep_province"];              
    $salesrep_item->salesrep_status=$row["salesrep_status"];

       
    return $salesrep_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_salesrep($salesrepid){

    $sql="UPDATE salesrep  SET 
    salesrep_code='$this->salesrep_code', salesrep_name='$this->salesrep_name'
    WHERE salesrep_id=$salesrepid ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}

//-------------------------------------------------------------------------------------------------------------------

function delete_salesrep($salesrep_id)
{

    $sql="UPDATE salesrep SET salesrep_status='INACTIVE' WHERE salesrep_id=$salesrep_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}

//----------------------------------------------------------------------------------------------------------------------------

    function get_salesrep_by_code($salesrepcode)
    {

        $sql="SELECT * FROM salesrep WHERE salesrep_code = '$salesrepcode'";
        //echo $sql;
        $result=$this->db->query($sql);
        $row=$result->fetch_array();

        $salesrep_item = new salesrep();

        $salesrep_item->salesrep_id=$row["salesrep_id"];
        $salesrep_item->salesrep_code=$row["salesrep_code"];
        $salesrep_item->salesrep_name=$row["salesrep_name"];
        // $salesrep_item->salesrep_province=$row["salesrep_province"];
        $salesrep_item->salesrep_status=$row["salesrep_status"];

        
        return $salesrep_item;
    }

    function return_salesrep_id($salesrep_name)
    {
        $sql="SELECT salesrep_id FROM salesrep WHERE salesrep_name='$salesrep_name'";
        $result=$this->db->query($sql);
        echo '<pre>';
        print_r($result);
       
        if ($result->num_rows > 0) 
        {
            // output data of each row
            $row=$result->fetch_array();
            $sales_rep_id=$row["csalesrep_id"]; 
            return $sales_rep_id;
            print_r($sales_rep_id);
        }
        else
        {
            
            echo "invalid sales rep!";
            // return false;
        }
    }


}
