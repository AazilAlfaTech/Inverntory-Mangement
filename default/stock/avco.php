<?php
include_once "../../files/config.php";
class avco{
    public $avco_id;
    public $avco_productid;
    public $avco_costprice;
    public $avco_status;
    public $db;


    
    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
    }

    function insert_avco($product){
        $sql_avco="INSERT INTO avco_product (avco_productid) VALUES ($product) ";
        $this->db->query($sql_avco);
        echo  $sql_avco;
        return true;
    }


    function updatecostprice($productid){
        $sql_sumofcostprice="SELECT SUM(grn_item_price) AS totcostprice FROM grn_item WHERE grn_item_productid=$productid";
        echo $sql_sumofcostprice;
        $result_sum_costprice=$this->db->query($sql_sumofcostprice);

        $sql_countofcostprice="SELECT COUNT(grn_item_price) AS countcostprice FROM grn_item WHERE grn_item_productid=$productid";
        echo  $sql_countofcostprice;
        $result_count_costprice=$this->db->query($sql_countofcostprice);

        $row1=$result_sum_costprice->fetch_array();
        $row2=$result_count_costprice->fetch_array();

        $sum_costprice=$row1['totcostprice'];
        $count_costprice=$row2['countcostprice'];

        $average_costprice=round(($sum_costprice/$count_costprice),2);
     //   return $average_costprice;

       $sql_updateprice="UPDATE avco_product SET avco_costprice=$average_costprice WHERE avco_productid=$productid ";
       $this->db->query($sql_updateprice);
       echo $sql_updateprice;
       return true;



    }

    function get_costpricebyid($item){
        $sql="SELECT avco_costprice FROM avco_product WHERE avco_productid=$item ";
        $result_price=$this->db->query($sql);
        $row=$result_price->fetch_array();
       // $avco_product=new avco();
       $price=$row['avco_costprice'];
     // echo $price;
     return $price;
    }


    function insert_stock(){
        $sql="INSERT INTO stock(stock_id,stock_transactiontype, stock_transactiotypeid, stock_productid, stock_qty,stock_costpric) VALUES ()";
    }
}
 
?>