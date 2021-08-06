<?php 

include_once "../../files/config.php";

class district {

public $district_id;
public $district_code;
public $district_name;
public $district_status;
public $district_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

// function insert_district(){


//     $sql = "INSERT INTO district (district_code,district_name,district_district,district_district) VALUES 
//     ('$this->district_code','$this->district_name','$this->district_district', '$this->district_district')";
//     $this->db->query($sql);
//      echo $sql;
//      return true;

// }
// //........................get all function........................

function get_all_district(){
    $sql = "SELECT * FROM district  ";
    echo $sql;
    $result = $this->db->query($sql);   

    $district_array = array();

    
    while($row = $result->fetch_array()){

        $district_item = new district(); 

        $district_item->district_id=$row["district_id"];
        $district_item->district_code=$row["district_code"];
        $district_item->district_name=$row["district_name"];

    $district_array[] = $district_item;

    }

    return $district_array;  


}


//...........................gat by ID..........

function get_district_by_id($district_id){
    $sql = "SELECT * FROM district WHERE district_id =$district_id";

    echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $district_item=new district(); //object

        $district_item->district_id=$row["district_id"];
        $district_item->district_code=$row["district_code"];
        $district_item->district_name=$row["district_name"];
        

       
    return $district_item;

}

//.............................Edit...........

// function edit_district($district_id){
//     $sql = "UPDATE district SET district_code = '$this->district_code', district_name = '$this->district_name',
//   district_district = '$this->district_district', district_district = '$this->district_district'
    
//      WHERE district_id = '$district_id'";

//     $this->db->query($sql);
//     return true;
    
// }
//............................Delete.............
function delete_district($district_id){

    $sql = "UPDATE district set district_status = 'INACTIVE' WHERE district_id='$district_id'";

    echo $sql;
    $this->db->query($sql);
    return true;
}
//.....................




}


?>
