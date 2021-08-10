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

            function insert_salesrepcity($id)
            {
               
                $city_list=0;
                foreach($_POST["salesrep_city_city"]as $item)
                {
                   
                        $SQL="INSERT INTO salesrep_city(salesrep_city_city,salesrep_city_salesrep) VALUES 
                        ('".$_POST['salesrep_city_city'][$city_list]."',$id)";
                        $this->db->query($SQL);
                        // echo $SQL;
                    
                    $city_list++;
                }
                return true;
            }

        }
?>