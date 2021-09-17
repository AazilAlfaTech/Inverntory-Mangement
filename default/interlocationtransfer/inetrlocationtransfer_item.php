<?php 

include_once "../../files/config.php";

class inter_loc_transfer_item {

public $inter_loc_transfer_item_id;
public $inter_loc_transfer_item_code;
public $inter_loc_transfer_item_from;
public $inter_loc_transfer_item_to;
public $inter_loc_transfer_item_status;
public $inter_loc_transfer_item_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

function insert_inter_loc_transfer_item(){


    $sql = "INSERT INTO inter_loc_transfer_item (inter_loc_transfer_item_code,inter_loc_transfer_item_from,inter_loc_transfer_item_to,inter_loc_transfer_item_date) VALUES 
    ('$this->inter_loc_transfer_item_code','$this->inter_loc_transfer_item_from', '$this->inter_loc_transfer_item_to','$this->inter_loc_transfer_item_date')";
    $this->db->query($sql);
     echo $sql;
     return true;

}
// //........................get all function........................

function get_all_inter_loc_transfer_item(){
    $sql = "SELECT * FROM inter_loc_transfer_item WHERE  inter_loc_transfer_item_status = 'ACTIVE'  ";

    //echo $sql;

    
    $result = $this->db->query($sql);   

    $inter_loc_transfer_item_array = array();

    
    while($row = $result->fetch_array()){

        $inter_loc_transfer_item_item = new inter_loc_transfer_item(); 

        $inter_loc_transfer_item_item->inter_loc_transfer_item_id=$row["inter_loc_transfer_item_id"];
        $inter_loc_transfer_item_item->inter_loc_transfer_item_code=$row["inter_loc_transfer_item_code"];
        $inter_loc_transfer_item_item->inter_loc_transfer_item_date=$row["inter_loc_transfer_item_date"];
    

    $inter_loc_transfer_item_array[] = $inter_loc_transfer_item_item;

    }

    return $inter_loc_transfer_item_array;  


}


//...........................get by ID..........

function get_inter_loc_transfer_item_by_id($inter_loc_transfer_item_id){
    $sql = "SELECT * FROM inter_loc_transfer_item WHERE inter_loc_transfer_item_id =$inter_loc_transfer_item_id 
    AND inter_loc_transfer_item_status = 'ACTIVE'";

    //echo $sql;

    
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $inter_loc_transfer_item_item=new inter_loc_transfer_item(); //object

        $inter_loc_transfer_item_item->inter_loc_transfer_item_id=$row["inter_loc_transfer_item_id"];
        $inter_loc_transfer_item_item->inter_loc_transfer_item_code=$row["inter_loc_transfer_item_code"];
        $inter_loc_transfer_item_item->inter_loc_transfer_item_date=$row["inter_loc_transfer_item_date"];
        

       
    return $inter_loc_transfer_item_item;

}

//.............................Edit...........

// function edit_inter_loc_transfer_item($inter_loc_transfer_item_id){
//     $sql = "UPDATE inter_loc_transfer_item SET inter_loc_transfer_item_code = '$this->inter_loc_transfer_item_code', inter_loc_transfer_item_name = '$this->inter_loc_transfer_item_name',
//   inter_loc_transfer_item_from = '$this->inter_loc_transfer_item_from', inter_loc_transfer_item_from = '$this->inter_loc_transfer_item_from'
    
//      WHERE inter_loc_transfer_item_id = '$inter_loc_transfer_item_id'";

//     $this->db->query($sql);
//     return true;
    
// }
//............................Delete.............
function delete_inter_loc_transfer_item($inter_loc_transfer_item_id){

    $sql = "UPDATE inter_loc_transfer_item set inter_loc_transfer_item_status = 'INACTIVE' WHERE inter_loc_transfer_item_id='$inter_loc_transfer_item_id'";

    //echo $sql;

 
    $this->db->query($sql);
    return true;
}
//.....................




}


?>
