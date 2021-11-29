<?php 

include_once "../../files/config.php";

Class user{

    public $user_id;
    public $user_name;
    public $user_email;
    public $user_password;
    public $user_status;
    public $user_roleid;


    private $db;
//...............................


function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

function insert_user(){

    $sql = "INSERT INTO user (user_name, user_email, user_password, user_roleid) VALUES 
    ('$this->user_name','$this->user_email','$this->user_password','$this->user_roleid')";
    
    $this->db->query($sql);
    echo $sql;
    
    return true;
}

function get_al_user(){
    $sql="SELECT * FROM user JOIN user_role ON user_roleid=roleid WHERE user_status='ACTIVE' ";
    $result= $this->db->query($sql);
    $arr_user=array();

    while($row=$result->fetch_array()){
        $user1=new user();

        $user1->user_id=$row['user_id'];
        $user1->user_name=$row['user_name'];
        $user1->user_email=$row['user_email'];
        $user1->user_password=$row['user_password'];
        $user1->user_status=$row['user_status'];
        $user1->user_roleid=$row['user_roleid'];
        $user1->rolename=$row['rolename'];
        $arr_user[]=$user1;

    }
    return $arr_user;
}

function get_userby_id($userid){
    $sql="SELECT * FROM user JOIN user_role ON user_roleid=roleid WHERE user_id=$userid ";
    $result= $this->db->query($sql);
   
    $row=$result->fetch_array();
        $user1=new user();

        $user1->user_id=$row['user_id'];
        $user1->user_name=$row['user_name'];
        $user1->user_email=$row['user_email'];
        $user1->user_password=$row['user_password'];
        $user1->user_status=$row['user_status'];
        $user1->user_roleid=$row['user_roleid'];
        $user1->rolename=$row['rolename'];
        
    
    return $user1;
}

function edituser($user){
    $sql="UPDATE user SET  user_name='$this->user_name',user_email='$this->user_email',user_password='$this->user_password',user_roleid='$this->user_roleid'  WHERE user_id=$user";
    $this->db->query($sql);
   //echo  $sql;
    return true;

}


function delete_user(){ 

}


function ad_login($un,$pw)
{

    //$query="SELECT * FROM user WHERE user_email='$un' AND  user_password='$pw'";
    $query="SELECT * FROM `user` LEFT JOIN user_role ON user.user_roleid=user_role.roleid WHERE user_email='$un' AND user.user_password='$pw'";
    //echo $query;
    $result = $this->db->query($query);
    
    //if the email and password is verified
    if($row=$result->fetch_array())
    {
        session_start();
        $_SESSION["user"]=$row;
        $_SESSION["user"]["permission"]=[];
        $_SESSION["user"]["mainmodule"]=[];

        //query to fetch all the permissions of the role
        $sql=" SELECT * FROM `user_role_permission`  JOIN user_permission ON user_role_permission.rp_perm_id=user_permission.perm_id WHERE  user_role_permission.rp_role_id='".$_SESSION['user']['user_roleid']."'";
        $result_sql= $this->db->query($sql);

            while($row_perm=$result_sql->fetch_array())
            {
                if(isset($_SESSION["user"]["permission"][$row_perm['perm_module']])){
                    $_SESSION["user"]["permission"][$row_perm['perm_module']]=[];
                }else if(isset($_SESSION["user"]["permission"][$row_perm['perm_module_main']])){
                    $_SESSION["user"]["permission"][$row_perm['perm_module_main']]=[];
                }
                $_SESSION["user"]["permission"][$row_perm['perm_module']][]=$row_perm['rp_perm_id'];
                $_SESSION["user"]["permission"][$row_perm['perm_module_main']][]=$row_perm['perm_module_group'];
                
            }

        // //query to fetch permision module  main group
        // $sql="SELECT * FROM `user_role_permission` JOIN user_permission ON user_role_permission.rp_perm_id=user_permission.perm_id WHERE user_role_permission.rp_role_id='".$_SESSION['user']['user_roleid']."' GROUP BY perm_module_main";
        // while($row_perm=$result_sql->fetch_array())
        // {
        //     if(isset($_SESSION["user"]["permission"][$row_perm['perm_module']])){
        //         $_SESSION["user"]["permission"][$row_perm['perm_module']]=[];
        //     }
        //     $_SESSION["user"]["permission"][$row_perm['perm_module']][]=$row_perm['rp_perm_id'];
           
        // }

        
        return true;
            
    }
    //if the email and password is not verified
    else{
        return false;      
  

    
    }


}



function check ($module, $id) {
   // print_r($_SESSION["user"]["permission"]);
   if ( is_array($_SESSION["user"]["permission"][$module]) ){
 
    return in_array($id,  $_SESSION["user"]["permission"][$module]);}
    else{
        return false;
    }
   
  }

  function checksubgroup ($mainmodule, $group) {
    // print_r($_SESSION["user"]["permission"]);
    if ( is_array($_SESSION["user"]["permission"][$mainmodule]) ){
  //echo $_SESSION["user"]["permission"][$mainmodule];
     return in_array($group,  $_SESSION["user"]["permission"][$mainmodule]);}
     else{
         return false;
     }
    
   }





}



?>