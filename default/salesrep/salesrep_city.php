<?php
    include_once "../../files/config.php";

        class salesrep_city
        {
            public $salesrep_city_id;
            public $salesrep_city_salesrep;
            public $salesrep_city_city;
            public $salesrep_city_status;
            public $db;

            function __construct()
            {
                $this->db=new mysqli(host,un,pw,db1);
            }

            function insert_salesrepcity()
            {
                
            }

        }
?>