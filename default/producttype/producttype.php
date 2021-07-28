<?php
    include_once("../../files/config.php");
    class producttype
    {
        //attributes of the paroduct type
        public $ptype_id;
        public $ptype_code;
        public $ptype_name;
        public $ptype_group_id;
        public $ptype_status;
        public $ptype_date;
        public $db;

        function __construct()
        {
            $this->db=new mysqli (host,un,pw,db1);
        }

        //insert a new producttype 
        function add_type()
        {
            $SQL="INSERT INTO product_type(ptype_name,ptype_code,ptype_group_id) VALUES ('$this->ptype_name','$this->ptype_code','$this->ptype_group_id')";
            $this->db->query($SQL);
            echo $SQL;
            return true;
        }

        //edit a new producttype 
        function edit_type($typeid)
        {
            $SQL="UPDATE product_type SET ptype_name='$this->ptype_name',ptype_code='$this->ptype_code',ptype_group_id='$this->ptype_group_id' WHERE ptype_id=$typeid";
            $this->db->query($SQL);
            echo $SQL;
            return true;

        }
        
        //delete a new producttype 
        function delete_type($type_prodid)
        {
            $SQLCHECK="SELECT * FROM product WHERE product_type=$type_prodid AND product_status='ACTIVE'";
            $result=$this->db->query($SQLCHECK);
            echo $SQLCHECK;

            if($result->num_rows==0)
            {
                $SQL="UPDATE product_type SET ptype_status='INACTIVE' WHERE ptype_id=$type_prodid";
                $this->db->query($SQL);
                echo $SQL;
                return true;
            }
            else
            echo "No rows";
            return false;
        }

        //getall producttype 
        function getall_type()
        {
            $SQL="SELECT * FROM product_type WHERE ptype_status='ACTIVE'";
            $result=$this->db->query($SQL);
            $type_array=array();

            while($row=$result->fetch_array())
            {
                $ptype= new producttype();
                $ptype->ptype_id=$row["ptype_id"];
                $ptype->ptype_name=$row["ptype_name"];
                $ptype->ptype_code=$row["ptype_code"];
                $ptype->ptype_group_id=$row["ptype_group_id"];
                $ptype->ptype_status=$row["ptype_status"];
                $type_array[]=$ptype;
            }
            return $type_array;
        }

        function get_type_by_id($id)
        {
            $SQL="SELECT * FROM product_type WHERE ptype_id=$id";
            echo $SQL;
            $result=$this->db->query($SQL);

            $row=$result->fetch_array();
            $ptype=new producttype();
            $ptype->ptype_id=$row["ptype_id"];
            $ptype->ptype_name=$row["ptype_name"];
            $ptype->ptype_code=$row["ptype_code"];
            $ptype->ptype_group_id=$row["ptype_group_id"];
            $ptype->ptype_status=$row["ptype_status"];

            return $ptype;
        }

        function getbyid($id)
        {
            $SQL="SELECT * FROM product_type WHERE ptype_id=$id";
            $result=$this->db->query($SQL);
            $row=$result->fetch_array();

            $this->ptype_id=$row["ptype_id"];
            $this->ptype_code=$row["ptype_code"];
            $this->ptype_name=$row["ptype_name"];
            $this->ptype_group_id=$row["ptype_group_id"];
            $this->ptype_status=$row["ptype_status"];
            return $this;
        }
    }
?>