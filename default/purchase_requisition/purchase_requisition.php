<?php
include_once "../../files/config.php";
    class purchaserequest{ 
        
        
        
      public  $purchaserequest_id;
      public  $purchaserequest_ref;
      public  $purchaserequest_date;
      public  $purchaserequest_supplier;
      public  $purchaserequest_status;

      
      
private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW purchaserequest------------------------------------------------------------------------------------------------------------------


function insert_purchaserequest(){

    $sql="INSERT INTO purchase_request (purchaserequest_supplier,purchaserequest_date,purchaserequest_ref)
    VALUES('$this->purchaserequest_supplier','$this->purchaserequest_date','$this->purchaserequest_ref')
    ";
       //echo $sql;
       $this->db->query($sql);
    $pr_id=$this->db->insert_id;
    return $pr_id;

}


// --------------------------------------------------------------------------------------------------------------------------------------------------

    // function pr_code(){

    // SELECT * FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE())
    //     $sql=" SELECT COUNT(*) AS count FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE()) ";

       

    //     $result = $this->db->query($sql);

    //     $count= 0;


    //     while($row=$result->fetch_array()){

    //         $count = $row["count"];
    //     }
        
    //     $count = $count + 1 ;
    //     $count = sprintf("%04d", $count);


    //     $year = date("Y");


    //     $code = "PR". substr($year, 2, 2 )  . date("m"). $count;  


    //     return $code;


    // }



    // --------------------------------------------------------------------------------------------------------------------------


    function pr_code1($pr_date){

        // SELECT * FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE())
            $sql="SELECT COUNT(*) AS count FROM `purchase_request` WHERE MONTH(purchaserequest_date)= EXTRACT(MONTH FROM '$pr_date') ";
    
            $sql1="SELECT  EXTRACT(MONTH FROM '$pr_date') AS pr_month ";
            $sql2="SELECT  EXTRACT(YEAR FROM '$pr_date') AS pr_year ";
    
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
    
    
            $code = "PR".  substr($year, 2, 2 ) . $month . $count;  
    
    
            return $code;
    
    
        }








// ----------------------------------------------------------------------------------------------------------------------


function get_all_purchaserequest(){

    //$sql="SELECT * FROM purchase_request WHERE purchaserequest_status='ACTIVE' ";
    $sql="SELECT purchase_request.purchaserequest_id , purchase_request.purchaserequest_ref, purchase_request.purchaserequest_supplier,purchase_request.purchaserequest_date ,supplier.supplier_name FROM `purchase_request` INNER JOIN `supplier` ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE purchaserequest_status='ACTIVE' ";
    $result=$this->db->query($sql);

    $purchaserequest_array=array(); //array created

    while($row=$result->fetch_array()){

        $purchaserequest_item = new purchaserequest();

        $purchaserequest_item->purchaserequest_id=$row["purchaserequest_id"];
        $purchaserequest_item->purchaserequest_supplier=$row["purchaserequest_supplier"];
        $purchaserequest_item->supplier_name=$row["supplier_name"]; //name of the supplier
        $purchaserequest_item->purchaserequest_date=$row["purchaserequest_date"];
        $purchaserequest_item->purchaserequest_ref=$row["purchaserequest_ref"];
        
        $purchaserequest_array[]=$purchaserequest_item;
    }

    return $purchaserequest_array;
}

// ----GET ALL purchaserequest------------------------------------------------------------------------------------------------------------------



function get_purchaserequest_by_id($purchaserequestid){

    //$sql="SELECT * FROM purchase_request WHERE purchaserequest_id = $purchaserequestid";
    $sql="SELECT purchase_request.purchaserequest_id , purchase_request.purchaserequest_ref, purchase_request.purchaserequest_supplier,purchase_request.purchaserequest_date ,supplier.supplier_name FROM `purchase_request` INNER JOIN `supplier` ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE purchaserequest_id = $purchaserequestid";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $purchaserequest_item = new purchaserequest();

    $purchaserequest_item->purchaserequest_id=$row['purchaserequest_id'];
    $purchaserequest_item->purchaserequest_supplier=$row["purchaserequest_supplier"];
    $purchaserequest_item->supplier_name=$row["supplier_name"];
    $purchaserequest_item->purchaserequest_date=$row["purchaserequest_date"];
    $purchaserequest_item->purchaserequest_ref =$row["purchaserequest_ref"];

       
    return $purchaserequest_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_purchaserequest($purchaserequestid){
 

    $sql="UPDATE purchase_request  SET 
     purchaserequest_supplier='$this->purchaserequest_supplier',purchaserequest_date='$this->purchaserequest_date'
     
     WHERE purchaserequest_id ='$purchaserequestid' ";
    //echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_purchaserequest($purchaserequest_id){

    $sql="UPDATE purchase_request SET purchaserequest_status='INACTIVE' WHERE purchaserequest_id=$purchaserequest_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------



        


        




















    }








?>