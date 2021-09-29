<?php

include_once "../product/fifocaulation.php";
$obj1=new fifocalculation;
$res=$obj1-> insert_fifo();
//print_r($res);
echo $res;

?>