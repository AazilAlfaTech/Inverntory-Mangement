<?php 

include_once "../../files/config.php";
include_once "../province/province.php";
 include_once "../district/district.php";

class city {

public $city_id;
public $city_code;
public $city_name;
public $city_province;
public $city_district;
public $city_status;
public $city_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

function insert_city(){


    $sql = "INSERT INTO city (city_code,city_name,city_province,city_district) VALUES 
    ('$this->city_code','$this->city_name','$this->city_province', '$this->city_district')";
    $this->db->query($sql);
     echo $sql;
     return true;

}
//........................get all function........................

function get_all_city(){
    $sql = "SELECT * FROM city WHERE city_status = 'ACTIVE' ";
    echo $sql;
    $result = $this->db->query($sql);   

    $city_array = array();

    
    while($row = $result->fetch_array()){

        $city_item = new city(); 
        $province1 = new province();
        $district1 = new district();

        $city_item->city_id=$row["city_id"];
        $city_item->city_code=$row["city_code"];
        $city_item->city_name=$row["city_name"];
        $city_item->city_province=$row["city_province"];
        $city_item->city_province=$province1->get_province_by_id($row["city_province"]);
        $city_item->city_district=$row["city_district"];
        $city_item->city_district=$district1->get_district_by_id($row["city_district"]);

    $city_array[] = $city_item;

    }

    return $city_array;  


}


//...........................gat by ID..........

function get_city_by_id($city_id){
    $sql = "SELECT * FROM city WHERE city_id =$city_id";

    echo $sql;
    $result=$this->db->query($sql);


    $row=$result->fetch_array();
        $city_item=new city(); //object
        $province1 = new province();
        $district1 = new district();

        $city_item->city_id=$row["city_id"];
        $city_item->city_code=$row["city_code"];
        $city_item->city_name=$row["city_name"];
        $city_item->city_province=$row["city_province"];
        $city_item->city_province=$province1->get_province_by_id($row["city_province"]);
        $city_item->city_district=$row["city_district"];
        $city_item->city_district=$district1->get_district_by_id($row["city_district"]);
        

       
    return $city_item;

}

//.............................Edit...........

function edit_city($city_id){
    $sql = "UPDATE city SET city_code = '$this->city_code', city_name = '$this->city_name',
  city_province = '$this->city_province', city_district = '$this->city_district'
    
     WHERE city_id = '$city_id'";

    $this->db->query($sql);
    return true;
    
}
//............................Delete.............
function delete_city($city_id){

    $sql = "UPDATE city set city_status = 'INACTIVE' WHERE city_id='$city_id'";

    echo $sql;
    $this->db->query($sql);
    return true;
}
//.....................

function get_city_by_code($city_code){
    $sql = "SELECT * FROM city WHERE city_id ='$city_code'";

   // echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
        $city_item=new city(); //object
        $city_item->city_id=$row["city_id"];
        $city_item->city_code=$row["city_code"];
        $city_item->city_name=$row["city_name"];
        return $city_item;

}

function get_city_by_name($city_name){
    $sql = "SELECT * FROM city WHERE city_id ='$city_name'";

   // echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
        $city_item=new city(); //object
        $city_item->city_id=$row["city_id"];
        $city_item->city_code=$row["city_code"];
        $city_item->city_name=$row["city_name"];
        return $city_item;

}

function get_city_by_district($city_district)
{
    $sql = "SELECT * FROM city WHERE city_district = '$city_district' ";
    // echo $sql;
    $result = $this->db->query($sql);   

    $city_array = array();

    
    while($row = $result->fetch_array()){

        $city_item = new city(); 
        // $province1 = new province();
        // $district1 = new district();

        $city_item->city_id=$row["city_id"];
        $city_item->city_code=$row["city_code"];
        $city_item->city_name=$row["city_name"];

    $city_array[] = $city_item;

    }

    return $city_array;  
}

}


?>