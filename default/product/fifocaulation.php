<?php
   include_once("../../files/config.php");
   include_once("../sales_invoice/sales_invoice_item.php");
   include_once ("../stock/avco.php");
class fifocalculation{
    public $fifo_id;
    public $fifo_productid;
    public $fifo_purchaseitemid;
    public $fifo_salesitemid;
    public $fifo_soldqty;
   
    public $fifo_soldcost;
    public $db;

    function __construct()
    {
        $this->db=new mysqli (host,un,pw,db1);
    }


    function insert_fifo($salesinvoiceitemqty,$productid,$salesinvoiceitemid){
        // $sql_salesitem="SELECT si_itemid,si_item_productid,si_item_qty FROM sales_invoice_item WHERE si_item_productid=$productid ";
        // echo  $sql_salesitem;
        // $res_salesitem=$this->db->query($sql_salesitem);
        // $row_salesitem=$res_salesitem->fetch_array();
        // // $array1=array();

        // //get details of sales item
        // if($res_salesitem->num_rows==0)
        // {
        //     foreach($row_salesitem as $k=>$v)
        //     {
          
        //         $salesinvoiceitemid=$row_salesitem[$k]['si_itemid'];
        //         $salesinvoiceproductid=$row_salesitem[$k]['si_item_productid'];
        //         $salesinvoiceitemqty=$row_salesitem[$k]['si_item_qty'];
        //     }
        // }


        //start fifo
     
        if($salesinvoiceitemqty>0)
                {
                    $sqlGRNitem="SELECT * FROM grn_item WHERE grn_item_productid=$productid AND grn_item_qty > 0 ORDER BY grn_item_id ASC";
                    $res_GRNitem=$this->db->query($sqlGRNitem);
                    

                    if($res_GRNitem)
                    {
                        while($item2=$res_GRNitem->fetch_array())
                        {
                          
                           $grnitemid=$item2['grn_item_id'];
                           //echo $grnitemid;
                            $grnqty= $item2['grn_item_qty'];
                            $grnremainingqty=$item2['grn_item_remain_qty'];
                            $grnitemunitprice=$item2['grn_item_price'];

                            $fifosalesqty=min($salesinvoiceitemqty,$grnremainingqty);
                            $fiforemainingqty= $grnremainingqty -  $fifosalesqty;
                            $fifocost = $grnitemunitprice;

                            $sql_fifo="INSERT INTO fifocalculation (fifo_productid,fifo_purchaseitemid,fifo_salesitemid,fifo_soldqty,fifo_soldcost) VALUES ($productid,$grnitemid,$salesinvoiceitemid,$fifosalesqty,$fifocost)";
                            $this->db->query($sql_fifo);

                            $sql_stock="INSERT INTO stock(stock_transactiontype, stock_transactiotypeid,stock_productid,stock_qty,stock_costprice) VALUES ('SALES',$salesinvoiceitemid,$productid,-$fifosalesqty,$fifocost)";
                            $this->db->query( $sql_stock);
                            // echo $sql_fifo;
                            $sql_grn_item="UPDATE grn_item SET grn_item_remain_qty= $fiforemainingqty WHERE grn_item_id=$grnitemid ";
                            $this->db->query( $sql_grn_item);
                          //  echo  $sql_grn_item;

                            $salesinvoiceitemqty-=$fifosalesqty;  
                            if($salesinvoiceitemqty <= 0)
                            break;

                        }
                    }else{
                        echo "Fallsseeee";
                    }
                }
            }


            function insert_avco($salesinvoiceitemqty,$productid,$salesinvoiceitemid){
                    
        
               // get avco ost price
               $avco_product3=new avco();
               $fifocost=$avco_product3->get_costpricebyid($productid);
              // echo $fifocost;

                if($salesinvoiceitemqty>0)
                        {
                            $sqlGRNitem="SELECT * FROM grn_item WHERE grn_item_productid=$productid AND grn_item_qty > 0 ORDER BY grn_item_id ASC";
                            $res_GRNitem=$this->db->query( $sqlGRNitem);
                            
                            if($res_GRNitem)
                            {
                                while($item2=$res_GRNitem->fetch_array())
                                {
                                  
                                   $grnitemid=$item2['grn_item_id'];
                                   //echo $grnitemid;
                                    $grnqty= $item2['grn_item_qty'];
                                    $grnremainingqty=$item2['grn_item_remain_qty'];
                                    $grnitemunitprice=$item2['grn_item_price'];
        
                                    $fifosalesqty=min($salesinvoiceitemqty,$grnremainingqty);
                                    $fiforemainingqty= $grnremainingqty -  $fifosalesqty;
                                    //$fifocost = $grnitemunitprice*$fifosalesqty;
                                   
                                    $sql_fifo="INSERT INTO fifocalculation (fifo_productid,fifo_purchaseitemid,fifo_salesitemid,fifo_soldqty,fifo_soldcost) VALUES ($productid,$grnitemid,$salesinvoiceitemid,$fifosalesqty,$fiforemainingqty,$fifocost)";
                                    $this->db->query($sql_fifo);
                                 //   echo $sql_fifo;      
                                    $sql_grn_item="UPDATE grn_item SET grn_item_remain_qty= $fiforemainingqty WHERE grn_item_id=$grnitemid ";
                                    $this->db->query( $sql_grn_item);
                                 //   echo  $sql_grn_item;
        
                                    $salesinvoiceitemqty-=$fifosalesqty;  
                                    if($salesinvoiceitemqty <= 0)
                                    break;
                                    
        
                                }
                               $sql_sumqty="SELECT SUM(fifo_soldqty) AS totqty FROM `fifocalculation` WHERE fifo_salesitemid=$salesinvoiceitemid AND fifo_productid=$productid "; 
                               $result_QTY=$this->db->query($sql_sumqty);
                            $row=$result_QTY->fetch_array();  
                            $QTY=$row["totqty"];
                                $sql_stock="INSERT INTO stock(stock_transactiontype, stock_transactiotypeid,stock_productid,stock_qty,stock_costprice) VALUES ('SALES',$salesinvoiceitemid,$productid,-$QTY,$fifocost)";
                                $this->db->query( $sql_stock);
                                echo $sql_stock;
                                // $sql_fifo="INSERT INTO fifocalculation (fifo_productid,fifo_salesitemid,fifo_soldqty,fifo_soldcost) VALUES ($productid,$grnitemid,$salesinvoiceitemid,$fifosalesqty,$fiforemainingqty,$fifocost)";
                                // $this->db->query($sql_fifo);
                                // echo $sql_fifo;
                               
                                
                            }
                        }
                    }
        

}


?>