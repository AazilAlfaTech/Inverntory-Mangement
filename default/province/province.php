<?php 

include_once "../../files/config.php";

class province {

public $province_id;
public $province_code;
public $province_name;
public $province_status;
public $province_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

// function insert_province(){


//     $sql = "INSERT INTO province (province_code,province_name,province_province,province_district) VALUES 
//     ('$this->province_code','$this->province_name','$this->province_province', '$this->province_district')";
//     $this->db->query($sql);
//      echo $sql;
//      return true;

// }
// //........................get all function........................

function get_all_province(){
    $sql = "SELECT * FROM province  ";
    //echo $sql;
    $result = $this->db->query($sql);   

    $province_array = array();

    
    while($row = $result->fetch_array()){

        $province_item = new province(); 

        $province_item->province_id=$row["province_id"];
        $province_item->province_code=$row["province_code"];
        $province_item->province_name=$row["province_name"];

    $province_array[] = $province_item;

    }

    return $province_array;  


}


//...........................gat by ID..........

function get_province_by_id($province_id){
    $sql = "SELECT * FROM province WHERE province_id =$province_id";

    //echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $province_item=new province(); //object

        $province_item->province_id=$row["province_id"];
        $province_item->province_code=$row["province_code"];
        $province_item->province_name=$row["province_name"];
        

       
    return $province_item;

}

//.............................Edit...........

// function edit_province($province_id){
//     $sql = "UPDATE province SET province_code = '$this->province_code', province_name = '$this->province_name',
//   province_province = '$this->province_province', province_district = '$this->province_district'
    
//      WHERE province_id = '$province_id'";

//     $this->db->query($sql);
//     return true;
    
// }
//............................Delete.............
function delete_province($province_id){

    $sql = "UPDATE province set province_status = 'INACTIVE' WHERE province_id='$province_id'";

    //echo $sql;
    $this->db->query($sql);
    return true;
}
//.....................




}


?>
