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
            $SQL="INSERT INTO grn (grn_puch_order_id,grn_ref_no,grn_received_loc,grn_date) VALUES ('$this->grn_puch_order_id',$this->grn_ref_no','$this->grn_received_loc','$this->grn_date')";
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

        }

        function get_grn_byid()
        {
            
        }
    }
?>