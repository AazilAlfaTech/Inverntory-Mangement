<?php
        include_once("../../files/config.php");
        include_once "../producttype/producttype.php";
        include_once "../uom/uom.php";
        include_once "../group/group.php";

        class product
        {
            public $product_id;
            public $product_code;
            public $product_name;
            public $product_group;
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
                $SQL="INSERT INTO product (product_name,product_group,product_code,product_type,product_uom,product_desc,product_inventory_val,product_batch )
                VALUES ('$this->product_name','$this->product_group','$this->product_code','$this->product_type','$this->product_uom','$this->product_desc','$this->product_inventory_val',
                '$this->product_batch')";
                $this->db->query($SQL);
                $product_id=$this->db->insert_id; //gets the id of the last insertion
                move_uploaded_file($_FILES["productimage"]["tmp_name"],"../product/productimage/$product_id.jpg");
                // echo $SQL;
                return true;
            }

            // --------------------------------------------------------------------------------------


            function get_count($typ_id,$grp_id){

                $sql=" SELECT COUNT(*) AS count FROM product WHERE product_type = $typ_id AND product_group = $grp_id ";

                $sql1=" SELECT group_name  FROM product_group  WHERE group_id = $grp_id ";
                $sql2=" SELECT ptype_name  FROM product_type  WHERE ptype_id = $typ_id ";

                $result = $this->db->query($sql);
                $result1 = $this->db->query($sql1);
                $result2 = $this->db->query($sql2);
                

                $count= 0;
                $grp_name = "";

                $type_name = "";
                while($row=$result1->fetch_array()){

                    $grp_name = $row["group_name"];
                }
       
                while($row=$result2->fetch_array()){

                    $type_name  = $row["ptype_name"];
                }
       


                while($row=$result->fetch_array()){

                    $count = $row["count"];
                }
                
                $count = $count + 1 ;

                $count = sprintf("%04d", $count); // PRDEFINED (TO ALLOCATE DIGITS)
                
                $code = substr($grp_name, 0, 1 ) . substr($type_name, 0, 1 ) . $count  ;
                return  $code;
            }

        


            function edit_product($productid)
            {
                $SQL="UPDATE product SET product_name='$this->product_name',product_type='$this->product_type',product_uom='$this->product_uom',
                product_desc='$this->product_desc',product_inventory_val='$this->product_inventory_val',product_batch='$this->product_batch' 
                WHERE product_id=$productid";
                $this->db->query($SQL);
                move_uploaded_file($_FILES["productimage"]["tmp_name"],"../product/productimage/$productid.jpg");
         
                return true;
            }

            function delete_product($productid)
            {
                // $SQLCHECK="SELECT * FROM product WHERE product_type=$type_prodid AND product_status='ACTIVE'";
                // $result=$this->db->query($SQLCHECK);
                // echo $SQLCHECK;

                // if($result->num_rows==0)
                // {
                    $SQL="UPDATE product SET product_status='INACTIVE' WHERE product_id=$productid";
                    $this->db->query($SQL);
                    // echo $SQL;
                    return true;
                // }
                // else
                // echo "No rows";
                // return false;
            }

            // --------------------------------------------------------------------------------------------------------------------------------------
            function getall_product(){
           
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

    
            function getall_product2()
            {
                $SQL="SELECT product.product_id,product.product_code,product.product_name,product.product_type,product.product_uom,product.product_inventory_val,
                product.product_batch,product.product_desc,product_type.ptype_name,product_group.group_name,product_group.group_id,product_group.group_code  FROM product INNER JOIN product_type ON product.product_type =product_type.ptype_id INNER JOIN product_group
                ON product_type.ptype_group_id =product_group.group_id  WHERE product_status='ACTIVE' ";
                $result=$this->db->query($SQL);
                $product_array=array();
                // echo $SQL;
                $uom1=new uom();
               
                while($row=$result->fetch_array())
                {
                    $product=new product();
                    $product->product_id=$row["product_id"];
                    $product->product_code=$row["product_code"];
                    $product->product_name=$row["product_name"];
                    $product->product_type=$row["product_type"];//id product type
                    $product->product_typename=$row["ptype_name"];//product type name
                    $product->product_typegroupID=$row["group_id"];//group id
                    $product->product_typegroupname=$row["group_name"];//group name
                    //$product->product_type=$ptype1->get_type_by_id ($row["product_type"]);
                    $product->product_uom=$uom1->get_uom_by_id($row["product_uom"]);
                    $product->product_desc=$row["product_desc"];
                    $product->product_inventory_val=$row["product_inventory_val"];
                    $product->product_batch=$row["product_batch"];
                    // $product->product_status=$row["product_status"];
    
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
                $uom1=new uom();
                $product=new product();
                $product->product_id=$row["product_id"];
                $product->product_code=$row["product_code"];
                $product->product_name=$row["product_name"];
                $product->product_group=$row["product_group"];
                $product->product_type=$ptype1->get_type_by_id ($row["product_type"]);
                $product->product_uom=$uom1->get_uom_by_id($row["product_uom"]);
                $product->product_desc=$row["product_desc"];
                $product->product_inventory_val=$row["product_inventory_val"];
                $product->product_batch=$row["product_batch"];
                $product->product_status=$row["product_status"];

                return $product;

            }
            function get_product_by_id2($productid)
            {
               
                $SQL="SELECT product.product_id,product.product_code,product.product_name,product.product_type,product.product_uom,product.product_inventory_val,
                product.product_batch,product.product_desc,product_type.ptype_name,product_group.group_name,product_group.group_id,product_group.group_code  FROM product INNER JOIN product_type ON product.product_type =product_type.ptype_id INNER JOIN product_group
                ON product_type.ptype_group_id =product_group.group_id  WHERE product_id=$productid";
                $result=$this->db->query($SQL);
                // echo $SQL;

                $row=$result->fetch_array();
                
                $uom1=new uom();
                $product=new product();
                $ptype1=new producttype();
                $product->product_id=$row["product_id"];
                $product->product_code=$row["product_code"];
                $product->product_name=$row["product_name"];
                $product->product_type=$row["product_type"];//id product type
                $product->product_typename=$row["ptype_name"];//product type name
                $product->product_typegroupID=$row["group_id"];//group id
                $product->product_typegroupname=$row["group_name"];//group name
               
                //$product->product_type=$ptype1->get_type_by_id ($row["product_type"]);
                $product->product_uom=$uom1->get_uom_by_id($row["product_uom"]);
                $product->product_desc=$row["product_desc"];
                $product->product_inventory_val=$row["product_inventory_val"];
                $product->product_batch=$row["product_batch"];
                // $product->product_status=$row["product_status"];

                return $product;

            }

            
            
        }
?>