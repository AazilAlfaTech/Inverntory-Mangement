<?php
include_once "../../files/config.php";

class purchase_request_item{

    public $pr_item_id;
    public $pr_item_requestid;
    public $pr_item_productid;
    public $pr_item_qty;
    public $pr_item_price;
    public $pr_item_discount;
    public $pr_item_finalprice;
    public $pr_item_status;
    public $pr_item_currentstatus;
    public $db;

    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
   
    }

//--------------------------------------------------------------------------------------------------------------------


    function insert_purchaserequest_item($pr){
            
    $product_list=0;
    
    foreach($_POST["pr_item_productid"]as $item)
    
    {

    $sql="INSERT INTO purchase_request_item (pr_item_requestid,pr_item_productid,pr_item_qty,pr_item_price,pr_item_discount)
    VALUES($pr,'".$_POST['pr_item_productid'][$product_list]."','".$_POST['pr_item_qty'][$product_list]."','".$_POST['pr_item_price'][$product_list]."'
    ,'".$_POST['pr_item_discount'][$product_list]."')
    ";
       echo $sql;
       $this->db->query($sql);
       $product_list++;
    }
    return true;

}

// ====================================================================================================================

function get_all_product_by_pr_id($purch_req_id){
    $sql="SELECT purchase_request_item.pr_item_id ,purchase_request_item.pr_item_requestid ,purchase_request_item.pr_item_productid , purchase_request_item.pr_item_qty , purchase_request_item.pr_item_price ,purchase_request_item.pr_item_discount ,product.product_name FROM purchase_request_item INNER JOIN product ON purchase_request_item.pr_item_productid=product.product_id WHERE pr_item_requestid=$purch_req_id AND pr_item_status='ACTIVE'";

    $result=$this->db->query($sql);

    $product_array=array();
// echo $sql;

    while($row=$result->fetch_array()){
    $PR_item1=new purchase_request_item();

    $PR_item1->pr_item_id=$row['pr_item_id'];
    $PR_item1->pr_item_requestid=$row['pr_item_requestid'];
    $PR_item1->pr_item_productid=$row['pr_item_productid'];
    $PR_item1->product_name=$row['product_name'];
    $PR_item1->pr_item_qty=$row['pr_item_qty'];
    $PR_item1->pr_item_price=$row['pr_item_price'];
    $PR_item1->pr_item_discount=$row['pr_item_discount'];
    $PR_item1->pr_item_subtotal=round(($row['pr_item_qty']*$row['pr_item_price']),2);

     $PR_item1->pr_item_finalprice=round(($row['pr_item_qty']*$row['pr_item_price'])-($row['pr_item_qty']*$row['pr_item_price']*$row['pr_item_discount']/100),2);


    $product_array[]=$PR_item1;
   

                }
                return $product_array;
    

}




// =======================================================================================================================



function get_all_item_by_requestid($purch_req_id){
    $sql="SELECT purchase_request_item.pr_item_id ,purchase_request_item.pr_item_requestid ,purchase_request_item.pr_item_productid , purchase_request_item.pr_item_qty , purchase_request_item.pr_item_price ,purchase_request_item.pr_item_discount ,product.product_name FROM purchase_request_item INNER JOIN product ON purchase_request_item.pr_item_productid=product.product_id WHERE pr_item_requestid=$purch_req_id AND pr_item_status='ACTIVE'";
    $result=$this->db->query($sql);
    $item_array=array();
    //echo $sql;
    while($row=$result->fetch_array()){

    $PR_item1=new purchase_request_item();

    $PR_item1->pr_item_id=$row['pr_item_id'];
    $PR_item1->pr_item_requestid=$row['pr_item_requestid'];
    $PR_item1->pr_item_productid=$row['pr_item_productid'];
    $PR_item1->product_name=$row['product_name'];
    $PR_item1->pr_item_qty=$row['pr_item_qty'];
    $PR_item1->pr_item_price=$row['pr_item_price'];
    $PR_item1->pr_item_discount=$row['pr_item_discount'];
    $PR_item1->pr_item_subtotal=round(($row['pr_item_qty']*$row['pr_item_price']),2);
    $PR_item1->item_discount=round($row['pr_item_price']-($row['pr_item_price']*$row['pr_item_discount']/100),2);
    $PR_item1->pr_item_finalprice=round(($row['pr_item_qty']*$row['pr_item_price'])-($row['pr_item_qty']*$row['pr_item_price']*$row['pr_item_discount']/100),2);

    $item_array[]= $PR_item1;
    }
    return $item_array;
    

}






//  ----------------------------------------------------------------------------------------------------------






function edit_PR_item(){

    $list=0;

    foreach($_POST['pr_item_qty'] as $item){
        $sql="UPDATE purchase_request_item SET pr_item_qty='".$_POST['pr_item_qty'][$list]."',pr_item_price ='".$_POST['pr_item_price'][$list]."',pr_item_discount='".$_POST['pr_item_discount'][$list]."'
        
        WHERE pr_item_id='".$_POST['pr_item_id'][$list]."' ";

        // echo $sql;

        $this->db->query($sql);
       $list++;
    }

    return true;

}

    function inactive_purchasereq_item($purch_req_id)
    {
        
        $sql="UPDATE purchase_request_item SET pr_item_currentstatus='COMPLETED' WHERE pr_item_requestid=$purch_req_id";
        $this->db->query($sql);
        echo $sql; 
       
    }

    function delete_PRitem($PR_id)
    {
        $sql="UPDATE  purchase_request_item SET pr_item_status='INACTIVE' WHERE pr_item_id=$PR_id ";
        $this->db->query($sql);
        //echo $sql; 
        echo true;
    }
}




?>