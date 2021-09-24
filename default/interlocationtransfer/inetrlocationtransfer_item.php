<?php 

include_once "../../files/config.php";

class interloctranfer_item {

public $interloctranfer_item_id;
public $interloctranfer_item_product;
public $interloctranfer_item_price;
public $interloctranfer_item_qty;
public $interloctranfer_item_batch;
public $interloctranfer_item_status;
public $interloctranfer_item_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

function insert_interloctranfer_item(){


    $sql = "INSERT INTO interloctranfer_item (interloctranfer_item_product,interloctranfer_item_price,interloctranfer_item_qty,interloctranfer_item_batch) VALUES 
    ('$this->interloctranfer_item_product','$this->interloctranfer_item_price','$this->interloctranfer_item_qty', '$this->interloctranfer_item_batch')";
    $this->db->query($sql);
     echo $sql;
     return true;

}
// //........................get all function........................

function get_all_interloctranfer_item(){
    $sql = "SELECT * FROM interloctranfer_item WHERE  interloctranfer_item_status = 'ACTIVE'  ";

    //echo $sql;

    
    $result = $this->db->query($sql);   

    $interloctranfer_item_array = array();

    
    while($row = $result->fetch_array()){

        $interloctranfer_item_item = new interloctranfer_item(); 

        $interloctranfer_item_item->interloctranfer_item_id=$row["interloctranfer_item_id"];
        $interloctranfer_item_item->interloctranfer_item_price=$row["interloctranfer_item_price"];
        $interloctranfer_item_item->interloctranfer_item_date=$row["interloctranfer_item_date"];
    

    $interloctranfer_item_array[] = $interloctranfer_item_item;

    }

    return $interloctranfer_item_array;  


}


//...........................get by ID..........

function get_interloctranfer_item_by_id($interloctranfer_item_id){
    $sql = "SELECT * FROM interloctranfer_item WHERE interloctranfer_item_id =$interloctranfer_item_id 
    AND interloctranfer_item_status = 'ACTIVE'";

    //echo $sql;

    
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $interloctranfer_item_item=new interloctranfer_item(); //object

        $interloctranfer_item_item->interloctranfer_item_id=$row["interloctranfer_item_id"];
        $interloctranfer_item_item->interloctranfer_item_price=$row["interloctranfer_item_price"];
        $interloctranfer_item_item->interloctranfer_item_date=$row["interloctranfer_item_date"];
        

       
    return $interloctranfer_item_item;

}

//.............................Edit...........

// function edit_interloctranfer_item($interloctranfer_item_id){
//     $sql = "UPDATE interloctranfer_item SET interloctranfer_item_price = '$this->interloctranfer_item_price', interloctranfer_item_name = '$this->interloctranfer_item_name',
//   interloctranfer_item_qty = '$this->interloctranfer_item_qty', interloctranfer_item_qty = '$this->interloctranfer_item_qty'
    
//      WHERE interloctranfer_item_id = '$interloctranfer_item_id'";

//     $this->db->query($sql);
//     return true;
    
// }

//............................Delete.............
function delete_interloctranfer_item($interloctranfer_item_id){

    $sql = "UPDATE interloctranfer_item set interloctranfer_item_status = 'INACTIVE' WHERE interloctranfer_item_id='$interloctranfer_item_id'";

    //echo $sql;

 
    $this->db->query($sql);
    return true;
}
//.....................




}


?>
