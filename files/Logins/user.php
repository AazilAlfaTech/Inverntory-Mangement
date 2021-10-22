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
    
    echo $sql;
}






?>