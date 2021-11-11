<?php
include_once ("../../files/config.php");
class role{
    public $roleid ;
    public $rolename;
    public $role_status;
   
    public $db;



    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
    }


    function insert_role(){
        $sql="INSERT INTO user_role (rolename) VALUES ('$this->rolename')";
        $this->db->query($sql);
        echo $sql;
        $id=$this->db->insert_id;
        return $id;

    }

    function getall_roles(){
        $sql="SELECT * FROM user_role ";        
        $result=$this->db->query($sql);
        $role_array=array();

        while($row=$result->fetch_array()){
            $userrole=new role();


            $userrole->roleid=$row['roleid'];
            $userrole->rolename=$row['rolename'];
            $userrole->role_status=$row['role_status'];

            $role_array[]=$userrole;
        }
        return $role_array;
    }

    function get_role_byid($role_id){
        $sql="SELECT * FROM user_role WHERE roleid=$role_id "; 
              
        $result=$this->db->query($sql);
       
        $row=$result->fetch_array();
     
            $userrole=new role();


            $userrole->roleid=$row['roleid'];
            $userrole->rolename=$row['rolename'];
            $userrole->role_status=$row['role_status'];

           
        return  $userrole;
    }


    // function delete_role(){
        
    // }
}
?>