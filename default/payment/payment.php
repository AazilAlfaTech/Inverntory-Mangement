<?php
include_once "../../files/config.php";

class payment{
    public $pay_id ;
    public $pay_transactionid;
    public $pay_dt;
    public $pay_method;
    public $pay_amount;
    public $cheque_id;
    public $cheque_payid;
    public $cheque_num;
    public $creditcard_id ;
    public $creditcard_payid;
    public $creditcard_cardnum;	
    public $db;

    function __construct(){
          
        $this->db=new mysqli(host,un,pw,db1);
    }


    function insert_payment($transactionid,$cheque,$card){
        //$pay=new payment();
        $sql="INSERT INTO payment(pay_transactionid,pay_method,pay_amount) 
        VALUES($transactionid,'$this->pay_method','$this->pay_amount')";
        echo $sql;
        $this->db->query($sql);
        $pay_id=$this->db->insert_id;
       // return $pay_id;
        if($this->pay_method=='credit'){
          
            //$pay->pay_card($pay_id,$card);
            $sql2="INSERT INTO creditcard(creditcard_payid,creditcard_cardnum) VALUES ($pay_id,$card) ";
            echo $sql2;
        }else if($this->pay_method=='cheque')
       
    {//$pay->pay_check($pay_id,$cheque);
        $sql2="INSERT INTO pay_cheque(cheque_payid,cheque_num) VALUES ($pay_id,$cheque) ";
        echo $sql2;
    }

    

    }  
    
    
    function pay_check($payid,$chequeno){
        $sql="INSERT INTO pay_cheque(cheque_payid,cheque_num) VALUES ($payid,$chequeno) ";
        $this->db->query($sql);
        echo $sql;
        return true;
    }


    function pay_card($payid2,$cardno){
        $sql="INSERT INTO creditcard(creditcard_payid,creditcard_cardnum) VALUES ($payid2,$cardno) ";
        $this->db->query($sql);
        echo $sql;
        return true;
        
    }




}

?>