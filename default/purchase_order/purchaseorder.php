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
        $sql="INSERT INTO purchase_order (purchaserorder_requestid,purchaseorder_date,purchaseorder_ref) VALUES ('$this->purchaserorder_requestid','$this->purchaseorder_date','$this->purchaseorder_ref')";
       
        $this->db->query($sql);
        $id=$this->db->insert_id;
        return $id;
    }

    function po_code($po_date){

        // SELECT * FROM `purchase_request` WHERE MONTH(purchaserequest_added_date)= MONTH(CURDATE())
            $sql="SELECT COUNT(*) AS count FROM `purchase_request` WHERE MONTH(purchaserequest_date)= EXTRACT(MONTH FROM '$po_date') ";
    
            $sql1="SELECT  EXTRACT(MONTH FROM '$po_date') AS pr_month ";
            $sql2="SELECT  EXTRACT(YEAR FROM '$po_date') AS pr_year ";
    
            $result = $this->db->query($sql);
            $result1 = $this->db->query($sql1);
            $result2 = $this->db->query($sql2);
    
            $count= 0;
    
    
            while($row=$result->fetch_array()){
    
                $count = $row["count"];
            }
    
            
            $month = "";

            while($row=$result1->fetch_array()){

                $month = $row["pr_month"];
            }

            $month =sprintf("%02d", $month);

            $year = "";

            while($row=$result2->fetch_array()){

                $year = $row["pr_year"];
            }
            $count = $count + 1 ;
            $count = sprintf("%04d", $count);
    //  $year = date("Y");
    
    
            $code = "PO".  substr($year, 2, 2 ) . $month . $count;  
    
    
            return $code;
    
    
        }

    function get_all_purchaseorder(){
        //$sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' ";
        $sql="SELECT purchase_order.purchaseorder_id ,purchase_order.purchaseorder_ref ,purchase_order.purchaserorder_requestid, purchase_order.purchaseorder_status ,purchase_order.purchaseorder_date,
        supplier.supplier_name FROM purchase_order INNER JOIN `purchase_request` ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
         INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE purchaseorder_status='ACTIVE' OR  purchaseorder_status='PENDING' ";
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
    function delete_purchase_order($orderid){
        $sql="SELECT * FROM grn WHERE grn_puch_order_id=$orderid";
        $result=$this->db->query($sql);
        
        if($result->num_rows==0){
            $sql1="UPDATE purchase_order SET purchaseorder_status='INACTIVE' WHERE purchaseorder_id=$orderid ";
            $this->db->query($sql1);
            
            return true;
        }else
        return false;
    

    }

    function purchase_order_status($orderidstatus)
    {
        $sql1="SELECT * FROM purchase_order_item WHERE po_item_orderid=$orderidstatus AND po_item_status='ACTIVE'";
        $result=$this->db->query($sql1);
        echo $sql1;
    
    if($result->num_rows==0){
        $sql2="UPDATE purchase_order SET purchaseorder_status='COMPLETED' WHERE purchaseorder_id=$orderidstatus";
        $this->db->query($sql2);
        echo $sql2;
        return true;
    }else{
        $sql2="UPDATE  purchase_order SET purchaseorder_status='SEMIUTILIZED' WHERE purchaseorder_id=$orderidstatus";
        $this->db->query($sql2);
        echo $sql2;
        return true;
    }
    }

    function po_status($statusid)
    {
        $sql1="SELECT * FROM grn WHERE grn_puch_orderid=$statusid AND grn_current_status='COMPLETE'";
        $result=$this->db->query($sql1);
        echo $sql1;

        if($result->num_rows>0)
        {
        $sql2="UPDATE purchase_order SET purchaseorder_status='COMPLETED' WHERE purchaseorder_id=$statusid";
        $this->db->query($sql2);
        echo $sql2;
        return true;
        }
        else
        {
            $sql3="UPDATE  purchase_order SET purchaseorder_status='PENDING' WHERE purchaseorder_id=$statusid";
            $this->db->query($sql3);
            echo $sql3;
            return true;
        }
    }
}




?>