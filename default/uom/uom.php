<?php 

include_once "../../files/config.php";

class uom {

public $uom_id;
public $uom_code;
public $uom_name;
public $uom_status;
public $uom_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

function insert_uom(){


    $sql = "INSERT INTO product_uom (uom_code, uom_name) VALUES ('$this->uom_code', '$this->uom_name')";

    $this->db->query($sql);


        echo $sql;

        return true;

}
//........................get all function........................

function get_all_uom(){
    $sql = "SELECT * FROM product_uom WHERE uom_status = 'ACTIVE' ";
    echo $sql;
    $result = $this->db->query($sql);   

    $uom_array = array();

    
    while($row = $result->fetch_array()){
        $uom_item = new uom();  //object
        //$uom_item->$uom_id=$row[''];
        $uom_item->uom_code=$row["uom_code"];
        $uom_item->uom_name=$row["uom_name"];

    $uom_array[] = $uom_item;

    }

    return $uom_array;  


}


//...........................gat by ID..........

function get_uom_by_id($uom_id){
    $sql = "SELECT * FROM product_uom WHERE uom_id =$uom_id";

    echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $uom_item=new uom(); //object
        $uom_item->uom_id=$row["uom_id"];
        $uom_item->uom_code=$row["uom_code"];
        $uom_item->uom_name=$row["uom_name"];
        

       
    return $uom_item;

}

//.............................Edit...........

function edit_uom($uom_id){
    $sql = "UPDATE product_uom SET uom_code = '$this->uom_code', uom_name = '$this->uom_name' WHERE uom_id = '$uom_id'";

    $this->db->query($sql);
    return true;
    
}
//............................Delete.............
function delete_uom($uom_id){

    $sql = "UPDATE product_uom set uom_status = 'INACTIVE' WHERE uom_id='$uom_id'";
}
//.....................

function get_uom_by_code($uom_code){
    $sql = "SELECT * FROM product_uom WHERE uom_id ='$uom_code'";

   // echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
        $uom_item=new uom(); //object
        $uom_item->uom_id=$row["uom_id"];
        $uom_item->uom_code=$row["uom_code"];
        $uom_item->uom_name=$row["uom_name"];
        return $uom_item;

}

function get_uom_by_name($uom_name){
    $sql = "SELECT * FROM product_uom WHERE uom_id ='$uom_name'";

   // echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
        $uom_item=new uom(); //object
        $uom_item->uom_id=$row["uom_id"];
        $uom_item->uom_code=$row["uom_code"];
        $uom_item->uom_name=$row["uom_name"];
        return $uom_item;

}



}


?>
