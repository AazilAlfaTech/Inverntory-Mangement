<?php
    include_once "../../files/config.php";

    class GRN
    {
        public $grn_id;
        public $grn_puch_order_id;	
        public $grn_ref_no;
        public $grn_received_loc;	
        public $grn_status;	
        public $grn_date;
        public $db;

        function __construct()
        {
            $this->db=new mysqli(host,un,pw,db1);
            return true;
        }

        function insert_grn()
        {
            $SQL="INSERT INTO grn (grn_puch_order_id,grn_ref_no,grn_received_loc,grn_date) VALUES
            ('$this->grn_puch_order_id',$this->grn_ref_no','$this->grn_received_loc','$this->grn_date')";
            $this->db->query($SQL);
            echo $SQL;
            return true;
        }

        function edit_grn()
        {

        }

        function delete_grn()
        {

        }

        function get_all_grn()
        {
            $SQL="SELECT * FROM grn WHERE grn_status='ACTIVE'";
            echo $SQL;
            $result=$this->db->quesry($SQL);
            $grn_array=array();

            While($row=$result->fetch_array())
            {
                $grn=new grn();
                $grn->grn_id=$row["grn_id"];
                $grn->grn_puch_order_id=$row["grn_puch_order_id"];
                $grn->grn_ref_no=$row["grn_ref_no"];
                $grn->grn_status=$row["grn_status"];
                $grn->grn_date=$row["grn_date"];

                $grn_array[]=$grn;
            }
            return $grn_array;
        }

        function get_grn_byid()
        {
            
        }
    }
?>