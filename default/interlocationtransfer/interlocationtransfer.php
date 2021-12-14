<?php 

include_once "../../files/config.php";
include_once "../location/location.php";
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
    $sql = "select inter_loc_transfer.inter_loc_transfer_id ,inter_loc_transfer.inter_loc_transfer_code,inter_loc_transfer.inter_loc_transfer_from, inter_loc_transfer.inter_loc_transfer_to,inter_loc_transfer.inter_loc_transfer_date,inter_loc_transfer.inter_loc_transfer_status, t1.location_name as locationfrom, t2.location_name as locationto from inter_loc_transfer inner join location t1 on t1.location_id = inter_loc_transfer.inter_loc_transfer_from inner join location t2 on t2.location_id = inter_loc_transfer.inter_loc_transfer_to WHERE  inter_loc_transfer_status = 'ACTIVE'  ";

    //echo $sql;

    
    $result = $this->db->query($sql);   

    $inter_loc_transfer_array = array();
   
    
    while($row = $result->fetch_array()){

        $inter_loc_transfer_item = new inter_loc_transfer(); 

        $inter_loc_transfer_item->inter_loc_transfer_id=$row["inter_loc_transfer_id"];
        $inter_loc_transfer_item->inter_loc_transfer_code=$row["inter_loc_transfer_code"];
        $inter_loc_transfer_item->inter_loc_transfer_date=$row["inter_loc_transfer_date"];
        $inter_loc_transfer_item->inter_loc_transfer_from=$row["inter_loc_transfer_from"];
        $inter_loc_transfer_item->inter_loc_transfer_to=$row["inter_loc_transfer_to"];
        $inter_loc_transfer_item->locationfrom=$row["locationfrom"];
        $inter_loc_transfer_item->locationto=$row["locationto"];


    $inter_loc_transfer_array[] = $inter_loc_transfer_item;

    }

    return $inter_loc_transfer_array;  


}

// ------------------------------------------------------------------------------------------------
function int_loc_code1($int_date){

    // SELECT * FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE())
        $sql="SELECT COUNT(*) AS count FROM `inter_loc_transfer` WHERE MONTH(inter_loc_transfer_date)= EXTRACT(MONTH FROM '$int_date') ";

        $sql1="SELECT  EXTRACT(MONTH FROM '$int_date') AS pr_month ";
        $sql2="SELECT  EXTRACT(YEAR FROM '$int_date') AS pr_year ";

        $result = $this->db->query($sql);
        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);

        $count= 0;


        while($row=$result->fetch_array()){

            $count = $row["count"];
        }

        
        $month = "";

        while($row=$result1->fetch_array()){

            $month = $row["pr_month"];
        }

        $month =sprintf("%02d", $month);

        $year = "";

        while($row=$result2->fetch_array()){

            $year = $row["pr_year"];
        }

  
        

        $count = $count + 1 ;
        $count = sprintf("%04d", $count);


        //  $year = date("Y");


        $code = "ILT".  substr($year, 2, 2 ) . $month . $count;  


        return $code;


    }




//...........................get by ID..........

function get_inter_loc_transfer_by_id($inter_loc_transfer_id){
    // $sql = "SELECT * FROM inter_loc_transfer WHERE inter_loc_transfer_id =$inter_loc_transfer_id 
    // AND inter_loc_transfer_status = 'ACTIVE'";
    $sql="select inter_loc_transfer.inter_loc_transfer_id ,inter_loc_transfer.inter_loc_transfer_code,inter_loc_transfer.inter_loc_transfer_from, inter_loc_transfer.inter_loc_transfer_to,inter_loc_transfer.inter_loc_transfer_date,inter_loc_transfer.inter_loc_transfer_status, t1.location_name as locationfrom, t2.location_name as locationto from inter_loc_transfer inner join location t1 on t1.location_id = inter_loc_transfer.inter_loc_transfer_from inner join location t2 on t2.location_id = inter_loc_transfer.inter_loc_transfer_to WHERE  inter_loc_transfer_status = 'ACTIVE' AND inter_loc_transfer_id =$inter_loc_transfer_id ";

    //echo $sql;

    
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
        $inter_loc_transfer_item=new inter_loc_transfer(); //object
        
        $inter_loc_transfer_item->inter_loc_transfer_id=$row["inter_loc_transfer_id"];
        $inter_loc_transfer_item->inter_loc_transfer_code=$row["inter_loc_transfer_code"];
        $inter_loc_transfer_item->inter_loc_transfer_date=$row["inter_loc_transfer_date"];
        $inter_loc_transfer_item->inter_loc_transfer_from=$row["inter_loc_transfer_from"];
        $inter_loc_transfer_item->inter_loc_transfer_to=$row["inter_loc_transfer_to"];
        $inter_loc_transfer_item->locationfrom=$row["locationfrom"];
        $inter_loc_transfer_item->locationto=$row["locationto"];


       
    return $inter_loc_transfer_item;

}

//.............................Edit...........

    function edit_inter_loc_transfer($inter_loc_transfer_id)
    {
        $sql = "UPDATE inter_loc_transfer SET inter_loc_transfer_from = '$this->inter_loc_transfer_from', inter_loc_transfer_to = '$this->inter_loc_transfer_to'
        WHERE inter_loc_transfer_id = '$inter_loc_transfer_id'";
        $this->db->query($sql);
        echo $sql;
        return true;
        
    }
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
