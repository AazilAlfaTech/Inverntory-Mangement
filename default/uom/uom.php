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
    $CODE=$_POST["unitcode"];
    $NAME=$_POST["unitname"];
    $sql1="SELECT * FROM  product_uom WHERE uom_status = 'ACTIVE' AND uom_code='$CODE' OR uom_code='$NAME'";
    $res_code=$this->db->query($sql1);
   
    if($res_code->num_rows==0){

    $sql = "INSERT INTO product_uom (uom_code, uom_name) VALUES ('$this->uom_code', '$this->uom_name')";
    $this->db->query($sql);
     echo $sql;
     return true;
   }else {
    return false;
 }
   

}

// Import uom--------------------------------------------------------------------------------------------------

function import_uom()
{
    // Reads the file with name 'doc' and gives to the variable $file
    $file=$_FILES['doc']['tmp_name'];

    // Gets the extension of the file selected
    $a=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
    print_r($a);
    if($a='xlsx')
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
                $uom_code=$sheet->getCellByColumnAndRow(0,$i)->getValue();
                $uom_name=$sheet->getCellByColumnAndRow(1,$i)->getValue();

                // echo"$name";
                if($uom_code!='')
                {
                    // mysqli_query($con,"INSERT INTO test_import (name,email,age) VALUES ( '$name','$email','$age')");
                    $sql="INSERT INTO product_uom (uom_code, uom_name) VALUES ('$uom_code','$uom_name')";
                    $this->db->query($sql);
                }
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
//........................get all function........................

function get_all_uom(){
    $sql = "SELECT * FROM product_uom WHERE uom_status = 'ACTIVE' ";
    //echo $sql;
    $result = $this->db->query($sql);   

    $uom_array = array();

    
    while($row = $result->fetch_array()){
        $uom_item = new uom();  //object
        $uom_item->uom_id=$row["uom_id"];
        $uom_item->uom_code=$row["uom_code"];
        $uom_item->uom_name=$row["uom_name"];

    $uom_array[] = $uom_item;

    }

    return $uom_array;  


}


//...........................gat by ID..........

function get_uom_by_id($uom_id){
    $sql = "SELECT * FROM product_uom WHERE uom_id =$uom_id";

   // echo $sql;
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
   
    $NAME=$_POST["unitname"];
    $sql1="SELECT * FROM  product_uom WHERE uom_status = 'ACTIVE' AND uom_name='$NAME'";
    echo $sql1;
    $res_code=$this->db->query($sql1);
   
    if($res_code->num_rows==0){

        $sql = "UPDATE product_uom SET  uom_name = '$this->uom_name' WHERE uom_id = '$uom_id'";
        echo $sql;
        $this->db->query($sql);
        return true;
   }else {
    return false;
 }
   
    
    
}
//............................Delete.............
function delete_uom($uom_id){

    $sql = "UPDATE product_uom set uom_status = 'INACTIVE' WHERE uom_id='$uom_id'";
}




function get_uom_by_code($uom_code){
    $sql = "SELECT * FROM product_uom WHERE uom_code ='$uom_code'";

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
    $sql = "SELECT * FROM product_uom WHERE uom_name ='$uom_name'";

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
