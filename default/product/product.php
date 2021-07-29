<?php
        include_once("../../files/config.php");
        include_once "../producttype/producttype.php";
        // include_once "../group/group.php";

        class product
        {
            public $product_id;
            public $product_code;
            public $product_name;
            public $product_type;
            public $product_uom;
            public $product_desc;
            public $product_inventory_val;
            public $product_batch;
            public $product_status;
            public $db;

            function __construct()
            {
                $this->db=new mysqli (host,un,pw,db1);
            }

            function insert_product()
            {
                $SQL="INSERT INTO product (product_name,product_type,product_uom,product_desc,product_inventory_val,product_batch )
                VALUES ('$this->product_name','$this->product_type','$this->product_uom','$this->product_desc','$this->product_inventory_val',
                '$this->product_batch')";
                $this->db->query($SQL);
                // echo $SQL;
                return true;
            }

            function edit_product($productid)
            {
                $SQL="UPDATE product SET product_name='$this->product_name',product_type='$this->product_type',product_uom='$this->product_uom',
                product_desc='$this->product_desc',product_inventory_val='$this->product_inventory_val',product_batch='$this->product_batch' 
                WHERE product_id=$productid";
                $this->db->query($SQL);
                // echo $SQL;
                return true;
            }

            function delete_product()
            {
                
            }

            function getall_product()
            {
                $SQL="SELECT * FROM product WHERE product_status='ACTIVE'";
                $result=$this->db->query($SQL);
                $product_array=array();
                $ptype1=new producttype();

                while($row=$result->fetch_array())
                {
                    $product=new product();
                    $product->product_id=$row["product_id"];
                    $product->product_code=$row["product_code"];
                    $product->product_name=$row["product_name"];
                    $product->product_type=$ptype1->get_type_by_id ($row["product_type"]);
                    $product->product_uom=$row["product_uom"];
                    $product->product_desc=$row["product_desc"];
                    $product->product_inventory_val=$row["product_inventory_val"];
                    $product->product_batch=$row["product_batch"];
                    $product->product_status=$row["product_status"];
                    $product_array[]=$product;
                }
                return  $product_array;
            }

            function get_product_by_id($productid)
            {
                $SQL="SELECT * FROM product WHERE product_id=$productid";
                $result=$this->db->query($SQL);
                // echo $SQL;

                $row=$result->fetch_array();
                $ptype1=new producttype();
                $product=new product();
                $product->product_id=$row["product_id"];
                $product->product_code=$row["product_code"];
                $product->product_name=$row["product_name"];
                $product->product_type=$ptype1->get_type_by_id ($row["product_type"]);
                $product->product_uom=$row["product_uom"];
                $product->product_desc=$row["product_desc"];
                $product->product_inventory_val=$row["product_inventory_val"];
                $product->product_batch=$row["product_batch"];
                $product->product_status=$row["product_status"];

                return $product;

            }
            
        }
?>