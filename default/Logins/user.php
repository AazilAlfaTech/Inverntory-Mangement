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

    $sql = "INSERT INTO user (user_id,user_name, user_email, user_password, user_roleid) VALUES 
    ('$this->user_id','$this->user_name','$this->user_email','$this->user_password','$this->user_roleid')";
    
    $this->db->query($sql);
    echo $sql;
    
    return true;
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

        //query to fetch all the permissions of the role
        $sql=" SELECT * FROM user_role_permission WHERE user_role_permission.rp_role_id='".$_SESSION['user']['user_roleid']."'";
        $result_sql= $this->db->query($sql);

            while($row_perm=$result_sql->fetch_array())
            {
                if(isset($_SESSION["user"]["permission"][$row_perm['rp_perm_module']])){
                    $_SESSION["user"]["permission"][$row_perm['rp_perm_module']]=[];
                }
                $_SESSION["user"]["permission"][$row_perm['rp_perm_module']][]=$row_perm['rp_perm_id'];
            }

        
        return true;
            
    }
    //if the email and password is not verified
    else{
        return false;     
  

    
    }


}

// function __construct()
// {
//     parent::__construct();
// }

function check ($module, $id) {
   // print_r($_SESSION["user"]["permission"]);
   if ( is_array($_SESSION["user"]["permission"][$module]) ){
 
    return in_array($id,  $_SESSION["user"]["permission"][$module]);}
    else{
        return false;
    }
   
  }


}



?>