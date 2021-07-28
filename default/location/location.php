<?php

include_once "../../files/config.php";

class location{
 
public $location_code;
public $location_name;
public $location_add;
public $location_number;
public $location_email;
public $location_status;
public $location_date;

private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW LOCATION------------------------------------------------------------------------------------------------------------------


function insert_location(){

 $sql="INSERT INTO location (location_code,location_name,location_add,location_number,location_email)
 VALUES('$this->location_code','$this->location_name','$this->location_add','$this->location_number','$this->location_email')
 ";

    echo $sql;
    $this->db->query($sql);
    return true;

}

// ----EDIT LOCATION------------------------------------------------------------------------------------------------------------------


function get_all_location(){

    $sql="SELECT * FROM location WHERE location_status='ACTIVE' ";
    echo $sql;
    $result=$this->db->query($sql);

    $location_array=array();

    while($row=$result->fetch_array()){

        $location_item = new location();

        $location_item->location_id=$row["location_id"];
        $location_item->location_code=$row["location_code"];
        $location_item->location_name=$row["location_name"];
        $location_item->location_add=$row["location_add"];
        $location_item->location_number=$row["location_number"];
        $location_item->location_email=$row["location_email"];
        $location_item->location_status=$row["location_status"];
        $location_item->location_date=$row["location_date"];

        $location_array[]=$location_item;
    }

    return $location_array;
}

// ----GET ALL LOCATION------------------------------------------------------------------------------------------------------------------



function get_location_by_id($locationid){

    $sql="SELECT * FROM location WHERE location_id = $locationid";
    echo $sql;
    $result=$this->db->query($sql);



    $row=$result->fetch_array();

    $location_item = new location();

    $location_item->location_id=$row["location_id"];
    $location_item->location_code=$row["location_code"];
    $location_item->location_name=$row["location_name"];
    $location_item->location_add=$row["location_add"];
    $location_item->location_number=$row["location_number"];
    $location_item->location_email=$row["location_email"];
    $location_item->location_status=$row["location_status"];

       
    return $location_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_location($locationid){

    $sql="UPDATE location  SET 
    location_code='$this->location_code', location_name='$this->location_name',location_add='$this->location_add',location_number='$this->location_number',location_email='$this->location_email'
    WHERE location_id=$locationid ";

    echo $sql;
    $this->db->query($sql);
    return true;


}

//-------------------------------------------------------------------------------------------------------------------

function delete_location($location_id){

    $sql="UPDATE location SET location_status='INACTIVE' WHERE location_id=$location_id ";

    
    echo $sql;
    $this->db->query($sql);
    return true;


}


}
