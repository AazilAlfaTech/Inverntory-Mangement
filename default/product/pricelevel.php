<?php

include_once "../../files/config.php";

class pricelevel{
    public $pricelevel_id;
    public $pricelevel_productid;
    public $pricelevel_level_no;
    public $pricelevel_price;
    public $pricelevel_status;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    
    }

    function insert_pricelevel($productid){
        
        $list1=0;
        foreach($_POST['level_no'] as $item){
    $sql="INSERT INTO pricelevel (pricelevel_level_no,pricelevel_price,pricelevel_status,pricelevel_productid) VALUES 
    ('".$_POST['level_no'][$list1]."','".$_POST['level_price'][$list1]."','".$_POST['level_status'][$list1]."',$productid)";
   
    echo $sql;
        $this->db->query($sql);
       $list1++;
}
return true;
    }

    function getall_pricelevel_id($id){
        $sql="SELECT * FROM pricelevel WHERE pricelevel_productid=$id ";
        $result=$this->db->query($sql);
        $array_pricelevel=array();
        while($row=$result->fetch_array()){
            $pricelevelitem=new pricelevel();

            $pricelevelitem->pricelevel_id=$row['pricelevel_id'];
            $pricelevelitem->pricelevel_productid=$row['pricelevel_productid'];
            $pricelevelitem->pricelevel_level_no=$row['pricelevel_level_no'];
            $pricelevelitem->pricelevel_price=$row['pricelevel_price'];
            $pricelevelitem->pricelevel_status=$row['pricelevel_status'];

            $array_pricelevel[]=$pricelevelitem;
        }
        return $array_pricelevel;
    }

    function update_pricelevel(){

        $list=0;
        foreach($_POST['level_price_edit'] as $item){
            $sql="UPDATE pricelevel SET pricelevel_level_no='".$_POST['level_price_edit'][$list]."' ,pricelevel_status ='".$_POST['level_status_edit'][$list]."' WHERE pricelevel_id='".$_POST['level_id_edit'][$list]."' ";
   
    echo $sql;
        $this->db->query($sql);
       $list++;
}
return true;



        
    }

     function delete_pricelevel($pricelevelid){
         $sql="DELETE FROM pricelevel WHERE pricelevel_id=$pricelevelid ";
         $this->db->query($sql);
        return true;

     }

}


?>