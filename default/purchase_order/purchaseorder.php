<?php
include_once "../../files/config.php";
class purchaseorder{
    public $purchaseorder_id;
    public $purchaseorder_ref;
    public $purchaserorder_requestid;
    public $purchaseorder_status;
    public $purchaseorder_date;
    public $supplier_name1;
    private $db;
   
    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    
    }

    function insert_purchaseorder(){
        $sql="INSERT INTO purchase_order (purchaserorder_requestid,purchaseorder_date) VALUES ('$this->purchaserorder_requestid','$this->purchaseorder_date')";
       
        $this->db->query($sql);
        $id=$this->db->insert_id;
        return $id;
    }

    function get_all_purchaseorder(){
        //$sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' ";
        $sql="SELECT purchase_order.purchaseorder_id ,purchase_order.purchaseorder_ref ,purchase_order.purchaserorder_requestid, purchase_order.purchaseorder_status ,purchase_order.purchaseorder_date,
        supplier.supplier_name FROM purchase_order INNER JOIN `purchase_request` ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
         INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE purchaseorder_status='ACTIVE' ";
        $result=$this->db->query($sql);
       // echo $sql;
        $array_purchaseorder=array();
        while($row=$result->fetch_array()){
            $puchasorder1=new purchaseorder();

            $puchasorder1->purchaseorder_id=$row['purchaseorder_id'];
            $puchasorder1->purchaseorder_ref=$row['purchaseorder_ref'];
            $puchasorder1->purchaserorder_requestid=$row['purchaserorder_requestid'];
            $puchasorder1->purchaseorder_status=$row['purchaseorder_status'];
            $puchasorder1->purchaseorder_date=$row['purchaseorder_date'];
            $puchasorder1->supplier_name1=$row['supplier_name'];

            $array_purchaseorder[]=$puchasorder1;
        }
        return $array_purchaseorder;
    }

    function get_purchaseorder_by_id($ORDERID){
       // $sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' AND purchaseorder_id=$ORDERID";
        $sql="SELECT purchase_order.purchaseorder_id ,purchase_order.purchaseorder_ref ,purchase_order.purchaserorder_requestid, purchase_order.purchaseorder_status ,purchase_order.purchaseorder_date,
        supplier.supplier_name FROM `purchase_order` INNER JOIN `purchase_request` ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
         INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE purchaseorder_status='ACTIVE' AND purchaseorder_id=$ORDERID";
        $result=$this->db->query($sql);
        //echo"$sql";
        
        $row=$result->fetch_array();
            $puchasorder1=new purchaseorder();

            $puchasorder1->purchaseorder_id=$row['purchaseorder_id'];
            $puchasorder1->purchaseorder_ref=$row['purchaseorder_ref'];
            $puchasorder1->purchaserorder_requestid=$row['purchaserorder_requestid'];
            $puchasorder1->purchaseorder_status=$row['purchaseorder_status'];
            $puchasorder1->purchaseorder_date=$row['purchaseorder_date'];
            $puchasorder1->supplier_name1=$row['supplier_name'];
           
        
        return $puchasorder1;

    }


}




?>