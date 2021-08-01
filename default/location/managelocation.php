<?php
include_once "location.php";

    $location1 = new location();


    if(isset($_POST["locname"])){

        $location1->location_code = $_POST["loccode"];
        $location1->location_name = $_POST["locname"];
        $location1->location_add = $_POST["locadd"];
        $location1->location_number = $_POST["locnum"];
        $location1->location_email = $_POST["locmail"];


        if(isset($_POST["edit_location"])){
            $location1->edit_location ($_POST["edit_location"]);
        }
else{
        $location1->insert_location();
    }
    }

    
    $result_location = $location1->get_all_location();

    if(isset($_GET['edit_location'])){
        $location1=$location1->get_location_by_id($_GET['edit_location']);
    }



    if(isset($_GET['d_id'])){
        $location1->delete_location ($_GET['d_id']);
    }

    // print_r($result_location);




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
                                    <h4>Manage Location</h4>

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
                                    <h5>Add New Product Location</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="managelocation.php" method="POST" id="">

                                        <?php
                                   
                                   if(isset($_GET["edit_location"])){
                                    echo"  <input type='text'  class='form-control' value='".$_GET['edit_location'] ."' name='edit_location' required readonly>";
                                   }
                                    

                                   ?>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Location Code</label>
                                                <input type="text" value="<?=$location1->location_code?>"
                                                    class="form-control" placeholder="" name="loccode" pattern="^[A-Z0-9]*$" id="loc_code" onkeyup="check_locationcode()" onblur="check_locationcode()" required>
                                                    <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Location Name</label>
                                                <input type="text" value="<?=$location1->location_name ?>"
                                                    class="form-control" placeholder="" name="locname" id="loc_name" required>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Contact No</label>
                                                <input type="text" value="<?=$location1->location_number ?>"
                                                    class="form-control" placeholder="" name="locnum" id="loc_num" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">E-mail </label>
                                                <input type="email" value="<?=$location1->location_email ?>"
                                                    class="form-control" placeholder="" name="locmail" id="loc_mail" onkeyup="check_locationmail()" onblur="check_locationmail()" required>
                                                    <div class="col-form-label" id="mailcheck_msg" style="display:none;">Sorry, that e-mail is taken. Try
                                                            another?
                                                </div>


                                            </div>

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Address </label>
                                                <textarea value="<?=$location1->location_add ?> " rows="5" cols="5"
                                                    class="form-control" placeholder="" name="locadd" id="loc_add"
                                                    spellcheck="false"></textarea>
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
                                    <h5>Location List</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block"  style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Location id</th>
                                                    <th>Location Code</th>
                                                    <th>Lcation Name</th>
                                                    <th>Address</th>
                                                    <th>Contact No</th>
                                                    <th>E-mail</th>

                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
  foreach($result_location as $item){
                                                                    echo"
                                                                    <tr>
                                                                        <td>$item->location_id</td>
                                                                        <td>$item->location_code</td>
                                                                        <td>$item->location_name  </td>
                                                                        <td>$item->location_add  </td>
                                                                        <td>$item->location_number </td> 
                                                                        <td>$item->location_email </td>

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                        <a href='managelocation.php?edit_location=$item->location_id'>  <button type='button'  class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                                               <button type='button'  onclick='delete_location($item->location_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
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

                            <script type="text/javascript" src="../javascript/masterfile.js"></script>
                            <script>
                            function delete_location(deleteid) {

                                if (confirm("Do you want to delete id" + "" + deleteid)) {
                                    window.location.href = "managelocation.php?d_id=" + deleteid;
                                }


                            }
                            </script>