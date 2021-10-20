<?php

include_once "../../files/config.php";
include_once "../customer_group/customer_group.php";
include_once "../city/city.php";

class customer{
 


  public  $customer_id; 
  public  $customer_code;
  public  $customer_name;
  public  $customer_add;
  public  $customer_contactno;
  public  $customer_email;
  public  $customer_city;
  public  $customer_group;
  public  $customer_salesrep;
  public  $customer_creditdays;
  public  $customer_creditlimit;
  public  $customer_status;
  public  $customer_date;
    




private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW CUSTOMER ------------------------------------------------------------------------------------------------------------------


function insert_customer(){

    $CODE=$_POST["custcode"];
    $MAIL=$_POST["cust_email"];
    $CONTACT=$_POST["custno"];
    $sql1="SELECT * FROM customer WHERE customer_status='ACTIVE' AND customer_code='$CODE' OR customer_email='$MAIL' OR customer_contactno='$CONTACT'";
    $result_sql1=$this->db->query($sql1);

    if($result_sql1->num_rows==0){
        $sql="INSERT INTO customer (customer_code,customer_name,customer_add,customer_contactno,customer_email,
 customer_city,customer_group,customer_salesrep,customer_creditdays,customer_creditlimit)
 VALUES('$this->customer_code','$this->customer_name','$this->customer_add','$this->customer_contactno','$this->customer_email',
 '$this->customer_city','$this->customer_group','$this->customer_salesrep','$this->customer_creditdays','$this->customer_creditlimit')  ";

    echo $sql;
    $this->db->query($sql);
    return true;


    }else{
        return false;
    }

 
}

    function import_customer()
    {
        // Reads the file with name 'doc' and gives to the variable $file
        $file=$_FILES['doc']['tmp_name'];

        // Gets the extension of the file selected
        $a=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
        print_r($a);
        if($a=='xlsx')
        {
            // include the class excel libraray
            require ("../import/import_excel/PHPExcel.php");
            require ("../import/import_excel/PHPExcel/IOFactory.php");
            
            // create an object     
            $obj=PHPExcel_IOFactory::load($file);
            // this function gets the data one by one and iterates
            foreach($obj->getWorksheetIterator() as $sheet)
            {   
                // echo '<pre>';
                // print_r($sheet); 

                // Get the highest row
                $higest_row=$sheet->getHighestRow();
                for($i=2;$i<=$higest_row;$i++)
                {
                    // Get the column name and the value
                    $customer_code=$sheet->getCellByColumnAndRow(0,$i)->getValue();
                    $customer_name=$sheet->getCellByColumnAndRow(1,$i)->getValue();
                    $customer_add=$sheet->getCellByColumnAndRow(2,$i)->getValue();
                    $customer_contactno=$sheet->getCellByColumnAndRow(3,$i)->getValue();
                    $customer_email=$sheet->getCellByColumnAndRow(4,$i)->getValue();
                    $customer_city=$sheet->getCellByColumnAndRow(5,$i)->getValue();
                    $customer_group_name=$sheet->getCellByColumnAndRow(6,$i)->getValue();
                    $customer_salesrep=$sheet->getCellByColumnAndRow(7,$i)->getValue();
                    $customer_creditdays=$sheet->getCellByColumnAndRow(8,$i)->getValue();
                    $customer_creditlimit=$sheet->getCellByColumnAndRow(9,$i)->getValue();

                    $customer_group=new customergroup();
                    $customer_group_id=$customer_group->return_cus_groupid($customer_group_name);
                    

                    // echo"$name";
                    if($customer_code!='')
                    {
                        $sql1="SELECT * FROM customer WHERE customer_status='ACTIVE' AND customer_code='$CODE' OR customer_email='$MAIL' OR customer_contactno='$CONTACT'";
                        $result_sql1=$this->db->query($sql1);

                        if($result_sql1->num_rows==0)
                        {
                            // mysqli_query($con,"INSERT INTO test_import (name,email,age) VALUES ( '$name','$email','$age')");
                            $sql="INSERT INTO customer (customer_code,customer_name,customer_add,customer_contactno,customer_email,
                            customer_city,customer_group,customer_salesrep,customer_creditdays,customer_creditlimit) 
                            VALUES ('$customer_code','$customer_name','$customer_add','$customer_contactno','$customer_email',
                            '$customer_city','$customer_group_id','$customer_salesrep','$customer_creditdays','$customer_creditlimit')";
                            $this->db->query($sql);
                            $msg=1;
                        }
                        else
                        {
                            $msg1=2;
                        }
                    }
                }
                if(isset($msg))
                {
                    // echo "Successful";
                    header("location:../customer/manage_customer.php?success=1");

                }
                if(isset($msg1))
                {
                    // echo "Unsuccessful";
                    header("location:../customer/manage_customer.php?notsuccess=1");

                }
            }      
            return true;     
        }
        else 
        {
            return false;
            // echo "Invalid file format";
        }
    }


// ----EDIT CUSTOMER GROUP------------------------------------------------------------------------------------------------------------------


function get_all_customer(){

    $sql="SELECT * FROM customer WHERE customer_status='ACTIVE' ";
   // echo $sql;
    $result=$this->db->query($sql);

    $customer_array=array();
    
    $customer_group1 = new customergroup();
    while($row=$result->fetch_array()){

         $customer_item = new customer();

         $customer_item->customer_id=$row["customer_id"];
         $customer_item->customer_code=$row["customer_code"];
         $customer_item->customer_name=$row["customer_name"];
         $customer_item->customer_add=$row["customer_add"];
         $customer_item->customer_contactno=$row["customer_contactno"];
         $customer_item->customer_email=$row["customer_email"];
         $customer_item->customer_city=$row["customer_city"];
         $customer_item-> customer_group=$row["customer_group"];
         $customer_item->customer_group_name=$customer_group1->get_customer_group_by_id($row["customer_group"]);
         $customer_item-> customer_salesrep=$row["customer_salesrep"];
         $customer_item->customer_creditdays=$row["customer_creditdays"];
         $customer_item->customer_creditlimit=$row["customer_creditlimit"];
         $customer_item-> customer_status=$row["customer_status"];
         $customer_item-> customer_date=$row["customer_date"];
        
        $customer_array[]=$customer_item;
    }

    return $customer_array;
}

// ----GET ALL CUSTOMER ------------------------------------------------------------------------------------------------------------------



function get_customer_by_id($cus_grp_id){

    $sql="SELECT * FROM customer WHERE customer_id = $cus_grp_id";
    //echo $sql;
    $result=$this->db->query($sql);



    $row=$result->fetch_array();

    $customer_item = new customer();

    $customer_group1 = new customergroup();

    $customer_item->customer_id=$row["customer_id"];
    $customer_item->customer_code=$row["customer_code"];
    $customer_item->customer_name=$row["customer_name"];
    $customer_item->customer_add=$row["customer_add"];
    $customer_item->customer_contactno=$row["customer_contactno"];
    $customer_item->customer_email=$row["customer_email"];
    $customer_item->customer_city=$row["customer_city"];
    $customer_item->customer_group=$row["customer_group"];

    $customer_item->customer_group_name=$customer_group1->get_customer_group_by_id($row["customer_group"]);

    $customer_item->customer_salesrep=$row["customer_salesrep"];
    $customer_item->customer_creditdays=$row["customer_creditdays"];
    $customer_item->customer_creditlimit=$row["customer_creditlimit"];


    $customer_item->customer_status=$row["customer_status"];

       
    return $customer_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_customer($cus_grp_id){

    $sql="UPDATE customer  SET 
    customer_code='$this->customer_code', customer_name='$this->customer_name',customer_add='$this->customer_add',customer_contactno='$this->customer_contactno',customer_email='$this->customer_email', customer_city='$this->customer_city' , customer_group= '$this->customer_group', customer_salesrep= '$this->customer_salesrep',customer_creditdays='$this->customer_creditdays',customer_creditlimit='$this->customer_creditlimit'
    WHERE customer_id=$cus_grp_id ";

    echo $sql;
    $this->db->query($sql);
    return true;


}

//-------------------------------------------------------------------------------------------------------------------

function delete_customer($customer_id){

    $sql="UPDATE customer SET customer_status='INACTIVE' WHERE customer_id=$customer_id ";

    
    echo $sql;
    $this->db->query($sql);
    return true;


}

//----------------------------------------------------------------------------------------------------------------------------

function get_customer_by_code($customer_code){

    $sql="SELECT * FROM customer WHERE customer_status='ACTIVE'AND customer_code = '$customer_code'";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $customer_item = new customer();

    $customer_item->customer_id=$row["customer_id"];
    $customer_item->customer_code=$row["customer_code"];
    $customer_item->customer_name=$row["customer_name"];
    $customer_item->customer_status=$row["customer_status"];

       
    return $customer_item;
}

//.......................................................................................
function get_customer_by_mail($customer_mail){

    $sql="SELECT * FROM customer WHERE customer_status='ACTIVE' AND customer_email = '$customer_mail'";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $customer_item = new customer();

    $customer_item->customer_id=$row["customer_id"];
    $customer_item->customer_code=$row["customer_code"];
    $customer_item->customer_name=$row["customer_name"];
    $customer_item->customer_contactno=$row["customer_contactno"];
    $customer_item->customer_email=$row["customer_email"];
    $customer_item->customer_status=$row["customer_status"];

       
    return $customer_item;
}
//.................................................................................................

function get_customer_by_contact($customer_contact){

    $sql="SELECT * FROM customer WHERE customer_status='ACTIVE' AND customer_contactno = '$customer_contact'";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $customer_item = new customer();

    $customer_item->customer_id=$row["customer_id"];
    $customer_item->customer_code=$row["customer_code"];
    $customer_item->customer_name=$row["customer_name"];
    $customer_item->customer_contactno=$row["customer_contactno"];
    $customer_item->customer_email=$row["customer_email"];
    $customer_item->customer_status=$row["customer_status"];

       
    return $customer_item;
}



}
