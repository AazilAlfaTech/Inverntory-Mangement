<?php

include_once "../../files/config.php";

class location{
 
public $location_code;
public $location_name;
public $location_add;
public $location_number;
public $location_email;
public $location_status;
public $location_date;
public $location_id;

private $db;

// --------------------------------------------------------------------------------------------------------------------'

function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW LOCATION------------------------------------------------------------------------------------------------------------------


function insert_location(){
    $CODE=$_POST["loccode"];
    $MAIL=$_POST["locmail"];
    $sql1= "SELECT * FROM location WHERE location_status='ACTIVE' AND location_code='$CODE' OR location_email='$MAIL' ";
    echo($sql1);
    $res_code=$this->db->query($sql1);

 
if($res_code->num_rows==0){
    $sql="INSERT INTO location (location_code,location_name,location_add,location_number,location_email)
    VALUES('$this->location_code','$this->location_name','$this->location_add','$this->location_number','$this->location_email')
    ";
       //echo $sql;
       $this->db->query($sql);
       return true;

    }else {
       return false;
    }
}

// Import location--------------------------------------------------------------------------------------------------------
function import_location()
    {
        // Reads the file with name 'doc' and gives to the variable $file
        $file=$_FILES['doc']['tmp_name'];

        // Gets the extension of the file selected
        $a=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
        // print_r($a);
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
                    $location_code=$sheet->getCellByColumnAndRow(0,$i)->getValue();
                    $location_name=$sheet->getCellByColumnAndRow(1,$i)->getValue();
                    $location_add=$sheet->getCellByColumnAndRow(2,$i)->getValue();
                    $location_number=$sheet->getCellByColumnAndRow(3,$i)->getValue();
                    $location_email=$sheet->getCellByColumnAndRow(4,$i)->getValue();
                    // echo"$name";
                    if($location_code!='')
                    {
                        $sql1= "SELECT * FROM location WHERE location_status='ACTIVE' AND location_code='$location_code' OR location_email='$location_email' ";
                        $res_code=$this->db->query($sql1);

                        if($res_code->num_rows==0)
                        {
                            // mysqli_query($con,"INSERT INTO test_import (name,email,age) VALUES ( '$name','$email','$age')");
                            $sql="INSERT INTO location (location_code,location_name,location_add,location_number,location_email)
                            VALUES ('$location_code','$location_name','$location_add','$location_number',
                            '$location_email')";
                            $this->db->query($sql);
                            $msg=1;
                        }
                        else    
                        {
                            $msg1=2;
                            // return false;
                        }
                    }
                }
                if(isset($msg))
                {
                    // echo "Successful";
                          header("location:../location/managelocation.php?success=1");

                }
                if(isset($msg1))
                {
                    // echo "Unsuccessful";
                            header("location:../location/managelocation.php?notsuccess=1");

                }
            }      
               
        }
        else 
        {
            echo "Invalid file format";
        }
    }

// ----EDIT LOCATION------------------------------------------------------------------------------------------------------------------


function get_all_location(){

    $sql="SELECT * FROM location WHERE location_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);

    $location_array=array(); //array created

    while($row=$result->fetch_array()){

        $location_item = new location();

        $location_item->location_id=$row["location_id"];
        $location_item->location_code=$row["location_code"];
        $location_item->location_name=$row["location_name"];
        $location_item->location_add=$row["location_add"];
        $location_item->location_number=$row["location_number"];
        $location_item->location_email=$row["location_email"];
        $location_item->location_status=$row["location_status"];
        $location_item->location_date=$row["location_date"];

        $location_array[]=$location_item;
    }

    return $location_array;
}

// ----GET ALL LOCATION------------------------------------------------------------------------------------------------------------------



function get_location_by_id($locationid){

    $sql="SELECT * FROM location WHERE location_id = $locationid";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $location_item = new location();

    $location_item->location_id=$row["location_id"];
    $location_item->location_code=$row["location_code"];
    $location_item->location_name=$row["location_name"];
    $location_item->location_add=$row["location_add"];
    $location_item->location_number=$row["location_number"];
    $location_item->location_email=$row["location_email"];
    $location_item->location_status=$row["location_status"];

       
    return $location_item;
}


// ---------------------------------------------------------------------------------------------------------------------



function edit_location($locationid){
 
    $MAIL=$_POST["locmail"];
    $sql1= "SELECT * FROM location WHERE location_status='ACTIVE' AND location_email='$MAIL' ";
        echo($sql1);
    $res_code=$this->db->query($sql1);

 
if($res_code->num_rows==0){
    $sql="UPDATE location  SET 
     location_name='$this->location_name',location_add='$this->location_add',location_number='$this->location_number',location_email='$this->location_email'
    WHERE location_id=$locationid ";
    //echo $sql;
    $this->db->query($sql);
    return true;
    }else {
       return false;
    }
   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_location($location_id){

    $sql="UPDATE location SET location_status='INACTIVE' WHERE location_id=$location_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}
function get_location_by_code($locationcode){

    $sql="SELECT * FROM location WHERE location_code ='$locationcode'";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $location_item = new location();

    $location_item->location_id=$row["location_id"];
    $location_item->location_code=$row["location_code"];
    $location_item->location_name=$row["location_name"];
    $location_item->location_add=$row["location_add"];
    $location_item->location_number=$row["location_number"];
    $location_item->location_email=$row["location_email"];
    $location_item->location_status=$row["location_status"];

       
    return $location_item;
}
function get_location_by_mail($locationmail){

    $sql="SELECT * FROM location WHERE location_email ='$locationmail)'";
    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $location_item = new location();

    $location_item->location_id=$row["location_id"];
    $location_item->location_code=$row["location_code"];
    $location_item->location_name=$row["location_name"];
    $location_item->location_add=$row["location_add"];
    $location_item->location_number=$row["location_number"];
    $location_item->location_email=$row["location_email"];
    $location_item->location_status=$row["location_status"];

       
    return $location_item;
}



}
