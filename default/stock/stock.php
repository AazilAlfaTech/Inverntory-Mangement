<?php

include_once "../../files/config.php";
class stock{
    public $stock_id;
    public $stock_transactiontype;
    public $stock_transactiotypeid;
    public $stock_productid;
    public $stock_qty;
    public $stock_costprice;
    public $db;


    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
    }

    function stock_report(){
        $sql="((SELECT stock.stock_id, stock.stock_transactiontype,stock.stock_transactiotypeid,stock.stock_productid,stock.stock_qty,stock.stock_costprice,
        sales_dispatch.salesdispatch_ref AS
        REFNO,sales_dispatch.salesdispatch_date AS date,product_group.group_name, product_type.ptype_name,product.product_name,product.product_code FROM stock JOIN sales_dispatch ON stock.stock_transactiotypeid=sales_dispatch.salesdispatch_id JOIN product ON stock_productid=product.product_id JOIN product_group ON product.product_group=product_group.group_id JOIN product_type ON product.product_type=product_type.ptype_id where stock.stock_transactiontype='SALES')
        UNION
        (SELECT stock.stock_id,stock.stock_transactiontype,stock.stock_transactiotypeid,stock.stock_productid,stock.stock_qty,stock.stock_costprice, grn.grn_ref_no AS
        REFNO,grn.grn_date AS date,product_group.group_name, product_type.ptype_name,product.product_name,product.product_code FROM stock JOIN grn ON stock.stock_transactiotypeid=grn.grn_id JOIN product ON stock_productid=product.product_id JOIN product_group ON product.product_group=product_group.group_id JOIN product_type ON product.product_type=product_type.ptype_id where stock.stock_transactiontype='GRN'))
        ORDER BY
        stock_id DESC";
        $result=$this->db->query($sql);  
        $array_stock=array();

        while($row=$result->fetch_array()){
            $stock_item=new stock();

            $stock_item->stock_transactiontype=$row["stock_transactiontype"];
            $stock_item->date=$row["date"];
            $stock_item->REFNO=$row["REFNO"];
            $stock_item->group_name=$row["group_name"];
            $stock_item->ptype_name=$row["ptype_name"];
            $stock_item->product_code=$row["product_code"];
            $stock_item->stock_qty=$row["stock_qty"];
            $stock_item->stock_costprice=$row["stock_costprice"];
            $stock_item->product_name=$row["product_name"];

            $array_stock[]=$stock_item;


        }
        return $array_stock;
    
    }


    function stock_report_filter(){
        $filter_product=$_POST['filter_product'];
        $filter_startdt=$_POST['filter_startdt'];
        $filter_group=$_POST['filter_group'];
        $filter_type=$_POST['filter_type'];
        $filter_enddt=$_POST['filter_enddt'];

     $sql=  "((SELECT stock.stock_id, stock.stock_transactiontype,stock.stock_transactiotypeid,stock.stock_productid,stock.stock_qty,stock.stock_costprice,
sales_dispatch.salesdispatch_ref AS
REFNO,sales_dispatch.salesdispatch_date AS date,product_group.group_name, product_type.ptype_name,product.product_name,product.product_code FROM stock JOIN sales_dispatch ON stock.stock_transactiotypeid=sales_dispatch.salesdispatch_id JOIN product ON stock_productid=product.product_id JOIN product_group ON product.product_group=product_group.group_id JOIN product_type ON product.product_type=product_type.ptype_id where stock.stock_transactiontype='SALES'";

if($filter_product!=-1){
    $sql.=" and product_name='$filter_product'";
}
if($filter_group!=-1){
    $sql.=" and group_name='$filter_group'";
}
if($filter_type!=-1){
    $sql.=" and ptype_name='$filter_type'";
}
if($filter_startdt!='' && $filter_enddt!=''){
    $sql.="and date BETWEEN  '".$_POST['filter_startdt']."' AND '".$_POST['filter_enddt']."' "; 
  
}
$sql.=")
UNION
(SELECT stock.stock_id,stock.stock_transactiontype,stock.stock_transactiotypeid,stock.stock_productid,stock.stock_qty,stock.stock_costprice, grn.grn_ref_no AS
REFNO,grn.grn_date AS date,product_group.group_name, product_type.ptype_name,product.product_name,product.product_code FROM stock JOIN grn ON stock.stock_transactiotypeid=grn.grn_id JOIN product ON stock_productid=product.product_id JOIN product_group ON product.product_group=product_group.group_id JOIN product_type ON product.product_type=product_type.ptype_id where stock.stock_transactiontype='GRN'";
if($filter_product!=-1){
    $sql.=" and product_name='$filter_product'";
}
if($filter_group!=-1){
    $sql.=" and group_name='$filter_group'";
}
if($filter_type!=-1){
    $sql.=" and ptype_name='$filter_type'";
}
if($filter_startdt!='' && $filter_enddt!=''){
    $sql.="and date BETWEEN  '".$_POST['filter_startdt']."' AND '".$_POST['filter_enddt']."' "; 
  
}

$sql.=" )  )ORDER BY
stock_id DESC";
$result=$this->db->query($sql);  
$array_stock=array();

while($row=$result->fetch_array()){
    $stock_item=new stock();

    $stock_item->stock_transactiontype=$row["stock_transactiontype"];
    $stock_item->date=$row["date"];
    $stock_item->REFNO=$row["REFNO"];
    $stock_item->group_name=$row["group_name"];
    $stock_item->ptype_name=$row["ptype_name"];
    $stock_item->product_code=$row["product_code"];
    $stock_item->stock_qty=$row["stock_qty"];
    $stock_item->stock_costprice=$row["stock_costprice"];
    $stock_item->product_name=$row["product_name"];

    $array_stock[]=$stock_item;


}
return $array_stock;

    }


 }




?>