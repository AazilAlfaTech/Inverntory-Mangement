<?php
include_once ("../../files/config.php");
class user_role{

    public $role_permission_id;
    public $rp_role_id;
     public $rp_perm_id;
     public $db;

    
    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
    }


    function add_userrolepermission($roleid){
        $list=0;
        foreach($_POST['permid'] as $item){
            $sql="INSERT INTO user_role_permission (rp_role_id,rp_perm_id) VALUES ($roleid,'".$_POST['permid'][$list]."')";
            $this->db->query($sql);
            echo $sql;
            $list++;
        }

    }

    function get_userroleperm_byid($id){
        $sql="SELECT * FROM user_role_permission WHERE rp_role_id=$id ";
        $result= $this->db->query($sql);
        //echo $sql; 
        $roleperm_array=array();
        while($row=$result->fetch_array()){
            $roleperm=new user_role();

            $roleperm->role_permission_id=$row['role_permission_id'];
            // $roleperm->rp_role_id=$row['rp_role_id'];
            $roleperm->rp_perm_id=$row['rp_perm_id'];
            //$roleperm->rp_perm_status=$row['rp_perm_status'];
            // $roleperm->=$row[''];

            $roleperm_array[]=$roleperm;
        }
        return $roleperm_array;
    }

    function edit_user_role(){
        $list=0;
        foreach($_POST['permid'] as $item){
            $sql="UPDATE user_role_permission SET rp_perm_status='INACTIVE' WHERE  role_permission_id='".$_POST['permid'][$list]."'  ";
            $this->db->query($sql);
            echo $sql; 
            $list++;
        }
        return true;

    }

}





?>