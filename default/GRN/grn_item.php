<?php
        include_once "../../files/config.php";
        include_once "../product/product.php";
        class grn_item
        {
            public $grn_item_id;
            public $grn_item_grnid;
            public $grn_item_productid;
            public $grn_item_qty;
            public $grn_item_price;
            public $grn_item_discount;
            public $grn_item_finalprice;
            public $grn_item_status;
            public $db;


            function __construct()
            {
                $this->db=new mysqli(host,un,pw,db1);
                return true;
            }

            function insert_grnitem($id)
            {
                
                $grn_list=0;
            
               foreach($_POST['grn_itemid'] as $item)
                {
                    
                    $SQL="INSERT INTO grn_item (grn_item_grnid,grn_item_productid,grn_item_qty,grn_item_price,grn_item_discount,grn_item_finalprice)
                    VALUES ($id,'".$_POST['grn_itemid'][$grn_list]."','".$_POST['grn_item_qty'][$grn_list]."','".$_POST['grn_itemprice'][$grn_list]."',
                    '".$_POST['grn_item_discount'][$grn_list]."','".$_POST['grn_item_finalprice'][$grn_list]."')";
                    $this->db->query($SQL);
                    echo $SQL;

                    $grn_list++;
                }
                return true;
            }

            function get_grnitem_byid($id)
            {
                $SQL="SELECT * FROM grn_item WHERE grn_item_grnid=$id AND grn_item_status='ACTIVE'";
                $result=$this->db->query($SQL);
                $grn_iten_array=array();
                $prod=new product();
                while($row=$result->fetch_array())
                {
                $grn=new grn_item();
                $grn->grn_item_id=$row["grn_item_id"];
                $grn->grn_item_grnid=$row["grn_item_grnid"];
                $grn->grn_item_prodid=$prod->get_product_by_id($row["grn_item_productid"]);
                $grn->grn_item_qty=$row["grn_item_qty"];
                $grn->grn_item_price=$row["grn_item_price"];
                $grn->grn_item_dis=$row["grn_item_discount"];
                $grn->grn_item_finalprice=$row["grn_item_price"];
                $grn->grn_item_status=$row["grn_item_status"];

                $grn_item_array[]=$grn;
                }
                return $grn_item_array;
            }

        }

?>