<?php





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

                                    <form action="" method="POST" id="">



                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> Code</label>
                                                <input type="text" value="" class="form-control" placeholder=""
                                                    name="loccode" required>

                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">City Name</label>
                                                <input type="text" value="" class="form-control" placeholder="" name=""
                                                    id="" required>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> District </label>
                                                <select class="js-example-basic-single col-sm-12">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> Province </label>
                                                <select class="js-example-basic-single col-sm-12">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

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
                                            <li><i class="feather icon-minus minimize-card"></i></li>

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
                                                    <th>District</th>
                                                    <th>Province</th>


                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>


                                                    <td>
                                                        <div class='btn-group btn-group-sm' style='float: none;'>
                                                            <a
                                                                href='managelocation.php?edit_location=$item->location_id '>
                                                                <button type='button'
                                                                    class='tabledit-edit-button btn btn-primary waves-effect waves-light'
                                                                    style='float: none;margin: 5px;'><span
                                                                        class='icofont icofont-ui-edit'></span></button>
                                                            </a>
                                                            <button type='button'
                                                                onclick='delete_location($item->location_id)'
                                                                class='tabledit-delete-button btn btn-danger waves-effect waves-light'
                                                                style='float: none;margin: 5px;'><span
                                                                    class='icofont icofont-ui-delete'></span></button>
                                                    </td>




                                                </tr>



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