<?php
include_once "../../files/config.php";

class payment{
    public $pay_id ;
    public $pay_transactionid;
    public $pay_dt;
    public $pay_method;
    public $pay_amount;
    public $db;

    function __construct(){
          
        $this->db=new mysqli(host,un,pw,db1);
    }


    function insert_payment(){
        $sql="INSERT INTO payment(pay_transactionid,pay_method,pay_amount) 
        VALUES('$this->pay_transactionid','$this->pay_method','$this->pay_amount')";
        $this->db->query($sql);
        return true;
    }  
    
    
    function pay_check(){

    }


    function pay_card(){
        
    }




}

?>