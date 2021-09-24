<?php

include_once "city.php";



include_once "../district/district.php";
$district1 = new district();

$result_district = $district1->get_all_district();

include_once "../province/province.php";
$province1= new province();

$result_province = $province1->get_all_province();


$city1 = new city();

//code to insert and update data............................................................... 

    if(isset($_POST["cityname"])){

        $city1->city_code = $_POST["citycode"];
        $city1->city_name = $_POST["cityname"];
        $city1->city_province = $_POST["cityprovince"];
        $city1->city_district = $_POST["citydistrict"];

     if(isset($_POST["edit_city"])){
        $res_edit=$city1->edit_city ($_POST["edit_city"]);
        }
    else{
        $res_insert=$city1->insert_city();}
        //code for alert validations
            if($res_insert==true){
               
                header("location:../city/manage_city.php?success=1");

            }elseif($res_edit==true){
                header("location:../city/manage_city.php?success_edit=1");
            }else{
                echo"False";
            }

    }
//code to get city details  into datatable........................................................................
    
    $result_city = $city1->get_all_city();
//code to view city................................................................
    if(isset($_GET['edit_city'])){
        $city1=$city1->get_city_by_id($_GET['edit_city']);
    }
//code to delete city..................................................................................

$msg_2="";//alert message for delete


    if(isset($_GET['d_id'])){
        $res_del=$city1->delete_city ($_GET['d_id']);
        //code for delete validations
            if($res_del==true){
                
                $msg_2="Deleted Successfully";
            }else{
            
                $msg_2="city already exists therefore cannot delete";
            }
    }












include_once "../../files/head.php";





?>
<!-- --------------------------------------------------------------------------------------------------- -->

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Manage City</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add New City</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manage_city.php" method="POST" id="">

                                    <?php
                                   
                                   if(isset($_GET["edit_city"])){
                                    echo"  <input type='hidden'  class='form-control' value='".$_GET['edit_city'] ."' name='edit_city' required readonly>";
                                   }
                                    

                                   ?>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> Code</label>
                                                <input type="text" value="<?= $city1->city_code ?>" class="form-control" placeholder=""
                                                    name="citycode" id="city_code" required>

                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">City Name</label>
                                                <input type="text" value="<?= $city1->city_name ?>" class="form-control" placeholder="" name="cityname"
                                                    id="city_name" required>
                                            </div>

                               

                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> Province </label>
                                                <select class="js-example-basic-single col-sm-12 selectprovince" name="cityprovince" id="city_province">

                                                <?php
                                                        foreach($result_province as $item)
                                                  
                                                         if($item->province_id==$city1->city_province->province_id) 

			                                         echo "<option value='$item->province_id' selected='selected'>$item->province_name</option>";
                                                     else
                                                    echo"<option value='$item->province_id'>$item->province_name</option>"
                                                    ?>
                                                    
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> District </label>
                                                <select class="js-example-basic-single col-sm-12" name="citydistrict" id="srep_district">

                                                <?php
                                                        foreach($result_district as $item)
                                                     
                                                         if($item->district_id==$city1->city_district->district_id)   
			                                         echo "<option value='$item->district_id' selected='selected'>$item->district_name</option>";
                                                     else
                                                    echo"<option value='$item->district_id'>$item->district_name</option>"
                                                    ?>
                                                    
                                                </select>
                                            </div>


                                        </div>



                                        <button type="submit" class="btn btn-primary">ADD</button>
                                        <button class="btn btn-inverse">CLEAR</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->





                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>City List</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>City id</th>
                                                    <th>City Code</th>
                                                    <th>City Name</th>
                                                    <th>Province</th>
                                                    <th>District</th>
                                                  
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                    foreach($result_city as $item){
                                                        echo"
                                                        <tr>
                                                            <td>$item->city_id</td>
                                                            <td>$item->city_code</td>
                                                            <td>$item->city_name  </td>
                                                            <td>".$item->city_province->province_name."</td> 
                                                            <td>".$item->city_district->district_name."  </td>

                                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                            <button type='button' onclick='edit_city($item->city_id)'    class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                            <button type='button'  onclick='delete_city($item->city_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group'></span></button>
                                                            
                                                        </div>


                                                        </td>
                                                        </tr>
                                                        ";
                                                        }
                                                ?>



                                                </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>





















                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <script type="text/javascript" src="../javascript/map.js"></script>

                            <script>
                            function delete_city(d_id) {

                                if (confirm("Do you want to delete id" + " " + d_id)) {
                                    window.location.href = "manage_city.php?d_id=" + d_id;
                                }


                            }

                            function edit_city(edit_city) {

                   
                                    window.location.href = "manage_city.php?edit_city=" + edit_city;
                         


                            }
                            </script>