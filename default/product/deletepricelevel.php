<?php
include_once "../product/pricelevel.php";
$pricelevel2=new pricelevel();


if(isset($_POST['id'])){
    $res_1=$pricelevel2->delete_pricelevel($_POST['id']);

}




?>