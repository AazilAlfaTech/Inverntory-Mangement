<?php
    include_once("../../files/config.php");
    include_once ("../group/group.php");

    class producttype
    {
        //attributes of the paroduct type
        public $ptype_id;
        public $ptype_code;
        public $ptype_name;
        public $ptype_group_id;
        public $ptype_status;
        public $ptype_date;
        public $db;

        function __construct()
        {
            $this->db=new mysqli (host,un,pw,db1);
        }

        //insert a new producttype 
        function add_type()
        {
            $CODE=$_POST["typecode"];
            $NAME=$_POST["typename"];

            $sql1="SELECT * FROM  product_type WHERE ptype_status = 'ACTIVE' AND ptype_code='$CODE' OR ptype_name='$NAME'";
            $res_code=$this->db->query($sql1);
    
        if($res_code->num_rows==0){
            $SQL="INSERT INTO product_type(ptype_name,ptype_code,ptype_group_id) VALUES ('$this->ptype_name','$this->ptype_code','$this->ptype_group_id')";
            $this->db->query($SQL);
            // echo $SQL;
            return true;}else {
                return false;
             }
        }

        // import type
        function import_type()
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
                        $ptype_code=$sheet->getCellByColumnAndRow(0,$i)->getValue();
                        $ptype_name=$sheet->getCellByColumnAndRow(1,$i)->getValue();
                        $ptype_group_name=$sheet->getCellByColumnAndRow(2,$i)->getValue();

                        $group=new group();
                        $ptype_groupid=$group->return_groupid($ptype_group_name);
                        
                        // print_r($ptype_groupid);
                        // exit;

                        if($ptype_code!='')
                        {
                            $sql1="SELECT * FROM  product_type WHERE ptype_status = 'ACTIVE' AND ptype_code='ptype_code' OR ptype_name='$ptype_name'";
                             $res_code=$this->db->query($sql1);

                            

                             if($res_code->num_rows==0)
                            {
                                // mysqli_query($con,"INSERT INTO test_import (name,email,age) VALUES ( '$name','$email','$age')");
                                $sql="INSERT INTO product_type (ptype_name,ptype_code,ptype_group_id) VALUES ('$ptype_name','$ptype_code','$ptype_groupid')";
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
                                header("location:../producttype/manageproducttype.php?success=1");

                        }
                        if(isset($msg1))
                        {
                        // echo "Unsuccessful";
                            header("location:../producttype/manageproducttype.php?notsuccess=1");

                        }
                }      
            }
            
            else 
            {
                echo "Invalid file format";
            }
        }


        //edit a new producttype 
        function edit_type($typeid)
        {
            
            
            $NAME=$_POST["typename"];

            $sql1="SELECT * FROM  product_type WHERE ptype_status = 'ACTIVE' AND  ptype_name='$NAME'";
            $res_code=$this->db->query($sql1);
            echo $sql1;
    
        if($res_code->num_rows==0){
            $SQL="UPDATE product_type SET ptype_name='$this->ptype_name',ptype_group_id='$this->ptype_group_id' WHERE ptype_id=$typeid";
            $this->db->query($SQL);
            // echo $SQL;
            return true;
        }else {
                return false;
             }
           

        }
        
        //delete a new producttype 
        function delete_type($type_prodid)
        {
            $SQLCHECK="SELECT * FROM product WHERE product_type=$type_prodid AND product_status='ACTIVE'";
            $result=$this->db->query($SQLCHECK);
            // echo $SQLCHECK;

            if($result->num_rows==0)
            {
                $SQL="UPDATE product_type SET ptype_status='INACTIVE' WHERE ptype_id=$type_prodid";
                $this->db->query($SQL);
                // echo $SQL;
                return true;
            }
            else
            echo "No rows";
            return false;
        }

        //getall producttype 
        function getall_type()
        {
            $SQL="SELECT * FROM product_type WHERE ptype_status='ACTIVE'";
            $result=$this->db->query($SQL);
            $type_array=array();
            $type_group1=new group();

            while($row=$result->fetch_array())
            
            {
                $ptype= new producttype();
                $ptype->ptype_id=$row["ptype_id"];
                $ptype->ptype_name=$row["ptype_name"];
                $ptype->ptype_code=$row["ptype_code"];
                $ptype->ptype_group_id=$type_group1->get_group_by_id($row["ptype_group_id"]);
                $ptype->ptype_status=$row["ptype_status"];
                $type_array[]=$ptype;
            }
            return $type_array;
        }


        function get_type_by_id($typeid){
            $SQL="SELECT * FROM product_type WHERE ptype_id=$typeid AND ptype_status='ACTIVE'";
            // echo $SQL;
            $result=$this->db->query($SQL);

        

            $type_group1=new group();

        
            // $group_array=array();
        
            $row=$result->fetch_array();
                $ptype_item=new producttype();
                $ptype_item->ptype_id=$row["ptype_id"];
                $ptype_item->ptype_code=$row["ptype_code"];
                $ptype_item->ptype_name=$row["ptype_name"];
                $ptype_item->ptype_status=$row["ptype_status"];
                $ptype_item->ptype_group_id=$type_group1->get_group_by_id($row["ptype_group_id"]);
            return $ptype_item;
        }



        function getbyid($id)
        {
            $SQL="SELECT * FROM product_type WHERE ptype_id=$id AND ptype_status='ACTIVE'";
            $r=$this->db->query($SQL);
            $row=$r->fetch_array(); 

            $this->ptype_id=$row["ptype_id"];
            $this->ptype_code=$row["ptype_code"];
            $this->ptype_name=$row["ptype_name"];
            $this->ptype_group_id=$row["ptype_group_id"];
            $this->ptype_status=$row["ptype_status"];
            return $this;
        }


        function get_type_by_code($typecode)
        {
            $SQL="SELECT * FROM product_type WHERE ptype_code='$typecode' AND ptype_status='ACTIVE'";
            //echo $SQL;
            $result=$this->db->query($SQL);

            $row=$result->fetch_array();
            $ptype=new producttype();
            $ptype->ptype_id=$row["ptype_id"];
            $ptype->ptype_name=$row["ptype_name"];
            $ptype->ptype_code=$row["ptype_code"];
            $ptype->ptype_group_id=$row["ptype_group_id"];
            $ptype->ptype_status=$row["ptype_status"];

            return $ptype;
        }

        function get_type_by_name($typename)
        {
            $SQL="SELECT * FROM product_type WHERE ptype_name='$typename' AND ptype_status='ACTIVE'";
           // echo $SQL;
            $result=$this->db->query($SQL);

            $row=$result->fetch_array();
            $ptype=new producttype();
            $ptype->ptype_id=$row["ptype_id"];
            $ptype->ptype_name=$row["ptype_name"];
            $ptype->ptype_code=$row["ptype_code"];
            $ptype->ptype_group_id=$row["ptype_group_id"];
            $ptype->ptype_status=$row["ptype_status"];

            return $ptype;
        }

        function get_type_by_group($group)
        {
            $SQL="SELECT * FROM product_type WHERE ptype_group_id='$group' AND ptype_status='ACTIVE'";
            $result=$this->db->query($SQL);
            $type_array=array();
            $type_group1=new group();

            while($row=$result->fetch_array())
            
            {
                $ptype= new producttype();
                $ptype->ptype_id=$row["ptype_id"];
                $ptype->ptype_name=$row["ptype_name"];
                $ptype->ptype_code=$row["ptype_code"];
                $ptype->ptype_group_id=$type_group1->get_group_by_id($row["ptype_group_id"]);
                $ptype->ptype_group_id=$row["ptype_group_id"];
                $ptype->ptype_status=$row["ptype_status"];
                $ptype->ptype_date=$row["ptype_date"];
                $type_array[]=$ptype;
            }
            return $type_array;
        }

        function return_typeid($typename){
            $sql="SELECT ptype_id FROM product_type WHERE ptype_name='$typename'";
            $result=$this->db->query($sql);
            // echo '<pre>';
            // print_r($result);
           
            if ($result->num_rows > 0) 
            {
                // output data of each row
                $row=$result->fetch_array();
                $ptype_id=$row["ptype_id"];
                return $ptype_id;
            }
        }


    
    }
?>