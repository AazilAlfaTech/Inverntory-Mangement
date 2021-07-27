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
                                    <h4>Add New Purchase Order</h4>

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
                                    <h5>Add New Purchase Order</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form>




                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Select unutilized PR No</label>
                                                <select class="js-example-basic-single col-sm-12">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Supplier</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>

                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                        <div class="table-responsive">

                                                    <table class="table table-striped table-bordered" id="example-2">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>First</th>
                                                                <th>Last</th>
                                                                <th>Nickname</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td class="tabledit-view-mode"><span class="tabledit-span">Mark</span>
                                                                    <input class="tabledit-input form-control input-sm" type="text" name="First" value="Mark">
                                                                </td>
                                                                <td class="tabledit-view-mode"><span class="tabledit-span">Otto</span>
                                                                    <input class="tabledit-input form-control input-sm" type="text" name="Last" value="Otto">
                                                                </td>
                                                                <td class="tabledit-view-mode"><span class="tabledit-span">@mdo</span>
                                                                    <select class="tabledit-input form-control input-sm" name="Nickname" disabled="" style="display:none;">
                                                <option value="1">@mdo</option>
                                                <option value="2">@fat</option>
                                                <option value="3">@twitter</option>
                                            </select>
                                                                </td>
                                                            </tr>
                                                  
                                                       
                                                        </tbody>
                                                    </table>
                                                </div>





                                        <div class="d-flex flex-row-reverse">
                                            <button type="button" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>





           


                </div>






                <?php

include_once "../../files/foot.php";

?>