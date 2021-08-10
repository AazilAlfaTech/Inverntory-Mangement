<?php
$T=$_GET["type"];
$T();

function checkdistrictprovince()
{
    include_once "../district/district.php";
    $district_province1=new district();
    $district_province_list=$district_province1->get_district_by_province($_GET['district_prov']);
    echo json_encode($district_province_list);
}

function checkcitydistrict()
{
    include_once "../city/city.php";
    $city_district1=new city();
    $city_district_list=$city_district1->get_city_by_district($_GET['city_district']);
    echo json_encode($city_district_list);
}
?>