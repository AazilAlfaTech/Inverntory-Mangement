<?php
include_once "../../files/config.php";
class purchaseorder{
    public $purchaseorder_id;
    public $purchaseorder_ref;
    public $purchaserorder_requestid;
    public $purchaseorder_status;
    public $purchaseorder_currentstatus;
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
            $sql="SELECT COUNT(*) AS count FROM `purchase_order` WHERE MONTH(purchaseorder_date)= EXTRACT(MONTH FROM '$po_date') ";
    
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

        // -------------------------------------------------------------------------------------------------------
    function get_all_purchaseorder(){
        //$sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' ";
        $sql="SELECT purchase_order.purchaseorder_id ,purchase_order.purchaseorder_ref ,purchase_order.purchaserorder_requestid, purchase_order.purchaseorder_status, purchase_order.purchaseorder_currentstatus  ,purchase_order.purchaseorder_date,
        supplier.supplier_name FROM purchase_order INNER JOIN `purchase_request` ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
        INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE (purchaseorder_status='ACTIVE' AND purchaseorder_currentstatus='NEW') OR (purchaseorder_status='ACTIVE' AND purchaseorder_currentstatus='PENDING') OR (purchaseorder_status='ACTIVE' AND purchaseorder_currentstatus='COMPLETE')";
        $result=$this->db->query($sql);
       // echo $sql;
        $array_purchaseorder=array();
        while($row=$result->fetch_array()){
            $puchasorder1=new purchaseorder();

            $puchasorder1->purchaseorder_id=$row['purchaseorder_id'];
            $puchasorder1->purchaseorder_ref=$row['purchaseorder_ref'];
            $puchasorder1->purchaserorder_requestid=$row['purchaserorder_requestid'];
            $puchasorder1->purchaseorder_status=$row['purchaseorder_status'];
            $puchasorder1->purchaseorder_currentstatus=$row['purchaseorder_currentstatus'];
            $puchasorder1->purchaseorder_date=$row['purchaseorder_date'];
            $puchasorder1->supplier_name1=$row['supplier_name'];

            $array_purchaseorder[]=$puchasorder1;
        }
        return $array_purchaseorder;
    }

    // Get all new and pending purchase orders
    function get_all_new_purchaseorder(){
        //$sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' ";
        $sql="SELECT purchase_order.purchaseorder_id ,purchase_order.purchaseorder_ref ,purchase_order.purchaserorder_requestid, purchase_order.purchaseorder_status, purchase_order.purchaseorder_currentstatus  ,purchase_order.purchaseorder_date,
        supplier.supplier_name FROM purchase_order INNER JOIN `purchase_request` ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
        INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id WHERE (purchaseorder_status='ACTIVE' AND purchaseorder_currentstatus='NEW') OR (purchaseorder_status='ACTIVE' AND purchaseorder_currentstatus='PENDING')";
        $result=$this->db->query($sql);
       // echo $sql;
        $array_purchaseorder=array();
        while($row=$result->fetch_array()){
            $puchasorder1=new purchaseorder();

            $puchasorder1->purchaseorder_id=$row['purchaseorder_id'];
            $puchasorder1->purchaseorder_ref=$row['purchaseorder_ref'];
            $puchasorder1->purchaserorder_requestid=$row['purchaserorder_requestid'];
            $puchasorder1->purchaseorder_status=$row['purchaseorder_status'];
            $puchasorder1->purchaseorder_currentstatus=$row['purchaseorder_currentstatus'];
            $puchasorder1->purchaseorder_date=$row['purchaseorder_date'];
            $puchasorder1->supplier_name1=$row['supplier_name'];

            $array_purchaseorder[]=$puchasorder1;
        }
        return $array_purchaseorder;
    }


// -----------------------------------------------------------------------------------------------------------

    function get_purchaseorder_by_id($ORDERID){
       // $sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' AND purchaseorder_id=$ORDERID";
        $sql="SELECT purchase_order.purchaseorder_id ,purchase_order.purchaseorder_ref ,purchase_order.purchaserorder_requestid, purchase_order.purchaseorder_status, purchase_order.purchaseorder_currentstatus  ,purchase_order.purchaseorder_date,
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
            $puchasorder1->purchaseorder_currentstatus=$row['purchaseorder_currentstatus'];
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
// -----REPORT---------------------------------------------------------------------------------------------


function get_all_purchaseorder_for_report(){
    // $sql="SELECT * FROM purchase_order WHERE purchaseorder_status='ACTIVE' ";
    $sql="SELECT purchase_order.purchaseorder_ref ,purchase_order.purchaseorder_date, supplier.supplier_name,product.product_code,product.product_name,purchase_order_item.po_item_qty 
    ,purchase_order_item.po_item_price,purchase_order_item.po_item_discount, product_group.group_name,product_type.ptype_name
     FROM purchase_order INNER JOIN purchase_request ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
     INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id 
     JOIN purchase_order_item ON purchase_order.purchaseorder_id = purchase_order_item.po_item_orderid 
     JOIN product ON purchase_order_item.po_item_productid = product.product_id
     JOIN product_group ON  product.product_group = product_group.group_id
     JOIN product_type ON  product.product_type = product_type.ptype_id
     
     


     WHERE purchaseorder_status='ACTIVE' ";

    $result=$this->db->query($sql);
   // echo $sql;
    $array_purchaseorder=array();
    while($row=$result->fetch_array()){
        $puchasorder1=new purchaseorder();

      
        $puchasorder1->purchaseorder_ref=$row['purchaseorder_ref'];
  
        $puchasorder1->purchaseorder_date=$row['purchaseorder_date'];
        $puchasorder1->supplier_name1=$row['supplier_name'];
        $puchasorder1->product_code=$row['product_code'];
        $puchasorder1->product_name=$row['product_name'];
        $puchasorder1->po_item_qty=$row['po_item_qty'];
        $puchasorder1->po_item_price=$row['po_item_price'];
        $puchasorder1->po_item_discount=$row['po_item_discount'];
        $puchasorder1->group_name=$row['group_name'];
        $puchasorder1->ptype_name=$row['ptype_name'];

        $array_purchaseorder[]=$puchasorder1;
    }
    return $array_purchaseorder;


}


// --------------------------------------------


function filter_purchaseorder(){

    $filter_sup=$_POST['filter_sup'];
    $filter_product=$_POST['filter_product'];
    $filter_startdt=$_POST['filter_startdt'];
    $filter_enddt=$_POST['filter_enddt'];
    $filter_grp=$_POST['filter_grp'];
    $filter_type=$_POST['filter_type'];


    $sql="SELECT purchase_order.purchaseorder_ref ,purchase_order.purchaseorder_date, supplier.supplier_name,product.product_code,product.product_name,purchase_order_item.po_item_qty 
    ,purchase_order_item.po_item_price,purchase_order_item.po_item_discount, product_group.group_name,product_type.ptype_name
     FROM purchase_order INNER JOIN purchase_request ON purchase_order.purchaserorder_requestid=purchase_request.purchaserequest_id    
     INNER JOIN supplier ON purchase_request.purchaserequest_supplier=supplier.supplier_id 
     JOIN purchase_order_item ON purchase_order.purchaseorder_id = purchase_order_item.po_item_orderid 
     JOIN product ON purchase_order_item.po_item_productid = product.product_id
     JOIN product_group ON  product.product_group = product_group.group_id
     JOIN product_type ON  product.product_type = product_type.ptype_id
     


     WHERE purchaseorder_status='ACTIVE' ";


    if($filter_sup!=-1){
        $sql.=" and supplier_name='$filter_sup'";
    }
    if($filter_product!=-1){
        $sql.=" and product_name='$filter_product'";
    }

    if($filter_grp!=-1){
        $sql.=" and group_name='$filter_grp'";
    }
    if($filter_type!=-1){
        $sql.=" and ptype_name='$filter_type'";
    }

    if($filter_startdt!='' && $filter_enddt!=''){
        $sql.="and salesinvoice_date BETWEEN  '".$_POST['filter_startdt']."' AND '".$_POST['filter_enddt']."' "; 
      
    }

    $result=$this->db->query($sql);
   // echo $sql;
    $array_purchaseorder=array();
    $puchasorder1=new purchaseorder();
    while($row=$result->fetch_array()){
 

      
        $puchasorder1->purchaseorder_ref=$row['purchaseorder_ref'];
  
        $puchasorder1->purchaseorder_date=$row['purchaseorder_date'];
        $puchasorder1->supplier_name1=$row['supplier_name'];
        $puchasorder1->product_code=$row['product_code'];
        $puchasorder1->product_name=$row['product_name'];
        $puchasorder1->po_item_qty=$row['po_item_qty'];
        $puchasorder1->po_item_price=$row['po_item_price'];
        $puchasorder1->po_item_discount=$row['po_item_discount'];
        $puchasorder1->group_name=$row['group_name'];
        $puchasorder1->ptype_name=$row['ptype_name'];
        // $puchasorder1->po_finalprice=round(($row['sq_item_qty']*$row['sq_item_price'])-($row['sq_item_qty']*$row['sq_item_price']*$row['sq_item_discount']/100),2);

        $t = clone     $puchasorder1;
        $array_purchaseorder[]=$t;

    }
    return $array_purchaseorder;
}

    function purchase_order_status($orderidstatus)
    {
        $sql1="SELECT * FROM purchase_order_item WHERE po_item_orderid=$orderidstatus AND po_item_currentstatus='PENDING'";
        $result=$this->db->query($sql1);
        echo $sql1;
    
    if($result->num_rows==0){
        $sql2="UPDATE purchase_order SET purchaseorder_currentstatus='COMPLETE' WHERE purchaseorder_id=$orderidstatus";
        $this->db->query($sql2);
        echo $sql2;
        return true;
    }else{
        $sql2="UPDATE  purchase_order SET purchaseorder_currentstatus='PENDING' WHERE purchaseorder_id=$orderidstatus";
        $this->db->query($sql2);
        echo $sql2;
        return true;
    }
    }

    // function po_status($statusid)
    // {
    //     $sql1="SELECT * FROM grn WHERE grn_puch_orderid=$statusid AND grn_current_status='COMPLETE'";
    //     $result=$this->db->query($sql1);
    //     echo $sql1;

    //     if($result->num_rows>0)
    //     {
    //     $sql2="UPDATE purchase_order SET purchaseorder_status='INACTIVE',purchaseorder_currentstatus='COMPLETED' WHERE purchaseorder_id=$statusid";
    //     $this->db->query($sql2);
    //     echo $sql2;
    //     return true;
    //     }
    //     else
    //     {
    //         $sql3="UPDATE  purchase_order SET purchaseorder_status='ACTIVE',purchaseorder_currentstatus='PENDING' WHERE purchaseorder_id=$statusid";
    //         $this->db->query($sql3);
    //         echo $sql3;
    //         return true;
    //     }
    // }
}


?>