<?php 

include_once "../../files/config.php";

class inter_loc_transfer {

public $inter_loc_transfer_id;
public $inter_loc_transfer_code;
public $inter_loc_transfer_from;
public $inter_loc_transfer_to;
public $inter_loc_transfer_status;
public $inter_loc_transfer_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//..............................insert funtion..................

function insert_inter_loc_transfer(){


    $sql = "INSERT INTO inter_loc_transfer (inter_loc_transfer_code,inter_loc_transfer_from,inter_loc_transfer_to,inter_loc_transfer_date) VALUES 
    ('$this->inter_loc_transfer_code','$this->inter_loc_transfer_from', '$this->inter_loc_transfer_to','$this->inter_loc_transfer_date')";
    $this->db->query($sql);
     echo $sql;
     return true;

}
// //........................get all function........................

function get_all_inter_loc_transfer(){
    $sql = "SELECT * FROM inter_loc_transfer WHERE  inter_loc_transfer_status = 'ACTIVE'  ";

    //echo $sql;

    
    $result = $this->db->query($sql);   

    $inter_loc_transfer_array = array();

    
    while($row = $result->fetch_array()){

        $inter_loc_transfer_item = new inter_loc_transfer(); 

        $inter_loc_transfer_item->inter_loc_transfer_id=$row["inter_loc_transfer_id"];
        $inter_loc_transfer_item->inter_loc_transfer_code=$row["inter_loc_transfer_code"];
        $inter_loc_transfer_item->inter_loc_transfer_date=$row["inter_loc_transfer_date"];
    

    $inter_loc_transfer_array[] = $inter_loc_transfer_item;

    }

    return $inter_loc_transfer_array;  


}


//...........................get by ID..........

function get_inter_loc_transfer_by_id($inter_loc_transfer_id){
    $sql = "SELECT * FROM inter_loc_transfer WHERE inter_loc_transfer_id =$inter_loc_transfer_id 
    AND inter_loc_transfer_status = 'ACTIVE'";

    //echo $sql;

    
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $inter_loc_transfer_item=new inter_loc_transfer(); //object

        $inter_loc_transfer_item->inter_loc_transfer_id=$row["inter_loc_transfer_id"];
        $inter_loc_transfer_item->inter_loc_transfer_code=$row["inter_loc_transfer_code"];
        $inter_loc_transfer_item->inter_loc_transfer_date=$row["inter_loc_transfer_date"];
        

       
    return $inter_loc_transfer_item;

}

//.............................Edit...........

// function edit_inter_loc_transfer($inter_loc_transfer_id){
//     $sql = "UPDATE inter_loc_transfer SET inter_loc_transfer_code = '$this->inter_loc_transfer_code', inter_loc_transfer_name = '$this->inter_loc_transfer_name',
//   inter_loc_transfer_from = '$this->inter_loc_transfer_from', inter_loc_transfer_from = '$this->inter_loc_transfer_from'
    
//      WHERE inter_loc_transfer_id = '$inter_loc_transfer_id'";

//     $this->db->query($sql);
//     return true;
    
// }
//............................Delete.............
function delete_inter_loc_transfer($inter_loc_transfer_id){

    $sql = "UPDATE inter_loc_transfer set inter_loc_transfer_status = 'INACTIVE' WHERE inter_loc_transfer_id='$inter_loc_transfer_id'";

    //echo $sql;

 
    $this->db->query($sql);
    return true;
}
//.....................




}


?>
