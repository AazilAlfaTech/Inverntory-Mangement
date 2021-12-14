<?php
include_once "../../files/config.php";
include_once "../../default/producttype/producttype.php";


class group{
    
public $group_id;
public $group_code;
public $group_name;
public $group_status;
public $group_date;



 


function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
    return true;
}

//----------------------------------------------------------------------------------------------------------------------
// function insert_group(){

//         $sql="INSERT INTO product_group(group_code,group_name) VALUES ($this->group_code,'$this->group_name');";
//         echo $sql;
//         $this->db->query($sql);
//         return true;
   
// }

function insert_group2(){
    $CODE=$_POST["groupcode"];
    $NAME=$_POST["groupname"];
    $sql1="SELECT * FROM product_group WHERE group_status='ACTIVE' AND group_code='$CODE' OR group_name='$NAME'";
    $res_code=$this->db->query($sql1);
   
    if($res_code->num_rows==0){
        $sql="INSERT INTO product_group(group_code,group_name) VALUES ('$this->group_code','$this->group_name');";
        echo $sql;
        $this->db->query($sql);
        return true;

    }else {
       return false;
    }

}
// -----------------------------------------------------------------------------------------------------------------------------------
function get_all_group(){
    $sql="SELECT * FROM product_group WHERE group_status='ACTIVE' ";
    //echo $sql;
    $result=$this->db->query($sql);
    $group_array=array();

    while($row=$result->fetch_array()){
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        $group_item->group_code=$row["group_code"];
        $group_item->group_name=$row["group_name"];
        $group_item->group_status=$row["group_status"];
        $group_item->group_date=$row["group_date"];

        $group_array[]=$group_item;
    }

    return $group_array;
}

// ----------------------------------------------------------------------------------------------------------------------
function get_group_by_id($groupid){
    $sql="SELECT * FROM product_group WHERE group_id=$groupid";

   // echo $sql;

 
    $result=$this->db->query($sql);

   
    $row=$result->fetch_array();
    
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        $group_item->group_code=$row["group_code"];
        $group_item->group_name=$row["group_name"];
        $group_item->group_status=$row["group_status"];
        $group_item->group_date=$row["group_date"];

       
    return $group_item;
}

function edit_group($groupid){

    $NAME=$_POST["groupname"];
    $slq1="SELECT * FROM product_group WHERE group_status='ACTIVE' AND group_name='$NAME'";

    $res_code=$this->db->query($slq1);
    echo $slq1;
    if($res_code->num_rows==0){
        $sql="UPDATE product_group SET group_name='$this->group_name' WHERE group_id=$groupid";
        echo $sql;
        $this->db->query($sql);
        return true;

    }else {
       return false;
    }

}

//cannot delete a group if the group ID is available in the type table

function delete_group($type_groupid){

    $sql="SELECT * FROM product_type WHERE ptype_group_id=$type_groupid";
    $result=$this->db->query($sql);
    
    if($result->num_rows==0){
        $sql1="UPDATE product_group SET group_status='INACTIVE' WHERE group_id=$type_groupid ";
        $this->db->query($sql1);
        
        return true;
    }else
    return false;

}

function get_group_by_code($groupcode){
    $sql="SELECT * FROM product_group WHERE group_code='$groupcode'";
   // echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        $group_item->group_code=$row["group_code"];
        $group_item->group_name=$row["group_name"];
        $group_item->group_status=$row["group_status"];
        $group_item->group_date=$row["group_date"];

       
    return $group_item;
}

function get_group_by_name($groupname){
    $sql="SELECT * FROM product_group WHERE group_name='$groupname'";
    //echo $sql;
    $result=$this->db->query($sql);

    // $group_array=array();

    $row=$result->fetch_array();
        $group_item=new group();
        $group_item->group_id=$row["group_id"];
        // $group_item->group_code=$row["group_code"];
        // $group_item->group_name=$row["group_name"];
        // $group_item->group_status=$row["group_status"];
        // $group_item->group_date=$row["group_date"];

       
    return $group_item;
}

function return_groupid($groupname){
    $sql="SELECT group_id FROM product_group WHERE group_name='$groupname'";
    $result=$this->db->query($sql);
    echo '<pre>';
    print_r($result);
   
    if ($result->num_rows > 0) 
    {
        // output data of each row
        $row=$result->fetch_array();
        $group_id=$row["group_id"]; 
        return $group_id;
        // print_r($group_id);
    }
    else
    {
        
        echo "invalid group!";
        // return false;
    }
}


    function import_group()
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
                    $group_code=$sheet->getCellByColumnAndRow(0,$i)->getValue();
                    $group_name=$sheet->getCellByColumnAndRow(1,$i)->getValue();

                    // echo"$name";
                    if($group_code!='')
                    {
                        $sql1="SELECT * FROM product_group WHERE group_status='ACTIVE' AND group_code='$group_code' OR group_name='$group_name'";
                        $res_code=$this->db->query($sql1);

                        if($res_code->num_rows==0)
                        {
                            // mysqli_query($con,"INSERT INTO test_import (name,email,age) VALUES ( '$name','$email','$age')");
                            $sql="INSERT INTO product_group (group_code,group_name) VALUES ('$group_code','$group_name')";
                            $this->db->query($sql);
                            $msg=1;
                            // return true;
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
                              header("location:../group/manageproductgroup.php?success=1");

                    }
                if(isset($msg1))
                    {
                        // echo "Unsuccessful";
                                header("location:../group/manageproductgroup.php?notsuccess=1");

                    }
            }          
        }
        else 
        {
            echo "Invalid file format";
        }
    }


}


?>
