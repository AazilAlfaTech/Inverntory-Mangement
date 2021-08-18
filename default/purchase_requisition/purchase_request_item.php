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
    public $db;

    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
   
    }

//--------------------------------------------------------------------------------------------------------------------


    function insert_purchaserequest_item($pr_id){
            
    $product_list=0;
    
    foreach($_POST["pr_item_productid"]as $item)
    
    {

    $sql="INSERT INTO purchase_request_item (pr_item_requestid,pr_item_productid,pr_item_qty,pr_item_price,pr_item_discount,pr_item_finalprice)
    VALUES($pr_id,'".$_POST['pr_item_productid'][$product_list]."','".$_POST['pr_item_qty'][$product_list]."','".$_POST['pr_item_price'][$product_list]."'
    ,'".$_POST['pr_item_discount'][$product_list]."','".$_POST['pr_item_finalprice'][$product_list]."')
    ";
       echo $sql;
       $this->db->query($sql);
       $product_list++;
    }
    return true;

}








// --------------------------------------------------------------------------------------------------------------------
    function get_all_item_by_requestid($purch_req_id){
        $sql="SELECT * FROM purchase_request_item WHERE pr_item_requestid=$purch_req_id";
        $result=$this->db->query($sql);
        $row=$result->fetch_array();

        $PR_item1=new purchase_request_item();

        $PR_item1->pr_item_id=$row['pr_item_id'];
        $PR_item1->pr_item_requestid=$row['pr_item_requestid'];
        $PR_item1->pr_item_productid=$row['pr_item_productid'];
        $PR_item1->pr_item_qty=$row['pr_item_qty'];
        $PR_item1->pr_item_price=$row['pr_item_price'];
        $PR_item1->pr_item_discount=$row['pr_item_discount'];
        $PR_item1->pr_item_finalprice=$row['pr_item_finalprice'];

        return $PR_item1;
        
        

    }
 //--------------------------------------------------------------------------------------------------------------------------- 

 function get_all_product_by_pr_id($purch_req_id){
    $sql="SELECT * FROM purchase_request_item WHERE pr_item_requestid=$purch_req_id";

    $result=$this->db->query($sql);

    $product_array=array();


    while($row=$result->fetch_array()){
    $PR_item1=new purchase_request_item();

    $PR_item1->pr_item_id=$row['pr_item_id'];
    $PR_item1->pr_item_requestid=$row['pr_item_requestid'];
    $PR_item1->pr_item_productid=$row['pr_item_productid'];
    $PR_item1->pr_item_qty=$row['pr_item_qty'];
    $PR_item1->pr_item_price=$row['pr_item_price'];
    $PR_item1->pr_item_discount=$row['pr_item_discount'];
    $PR_item1->pr_item_finalprice=$row['pr_item_finalprice'];


    $product_array[]=$PR_item1;
    return $product_array;

                }
    

}






//  ----------------------------------------------------------------------------------------------------------
}




?>