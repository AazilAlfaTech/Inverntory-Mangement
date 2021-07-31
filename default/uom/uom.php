<?php 

include_once "../../files/config.php";

class uom {

public $uom_id;
public $uom_code;
public $uom_name;
public $uom_status;
public $uom_date;

private $db;

 //.............................................
 
function __construct(){

    $this->db=new mysqli(host,un,pw,db1);
    
}

//................................................

function insert_uom(){


    $sql = "INSERT INTO product_uom (uom_code, uom_name) VALUES ('$this->uom_code', '$this->uom_name')";

    $this->db->query($sql);


        echo $sql;

        return true;

}


}


?>
