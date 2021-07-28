<?php
        include_once("../../files/config.php");

        class product
        {
            public $product_id;
            public $product_code;
            public $product_name;
            public $product_type;
            public $product_uom;
            public $product_desc;
            public $product_inventory_value;
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
                echo $SQL;
                return true;
            }

            function edit_product()
            {

            }

            function delete_product()
            {
                
            }

            function getall_product()
            {
                
            }

            function get_product_by_id()
            {
                
            }
            
        }
?>