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
                                    <h4>Manage Supplier </h4>

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
                                    <h5>Add New Supplier </h5>

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
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Supplier  Code</label>
                                                <input type="text" class="form-control" placeholder="" name="supcode" id="code">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Supplier Group </label>
                                                <select name="supgroup" class="form-control" id="sup_group">
                                                    <option value="-1">Select Group</option>
                                                    <option value="1">Type 1</option>
                                                    <option value="2">Type 2</option>
                                                    <option value="3">Type 3</option>
                                                    
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label class=" col-form-label"> Name</label>
                                                <input type="text" class="form-control" placeholder="" name="supname" id="sup_name">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label"> E-mail</label>
                                                <input type="email" class="form-control" placeholder="" name="supemail" id="sup_email">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Telliphone No </label>
                                                <input type="text" class="form-control" placeholder="" name="supno" id="sup_no">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary">ADD</button>
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
                                                        <h5>Supplier List</h5>
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
                                                                        <th>Group </th>
                                                                        <th> Name</th>
                                                                        <th>E-mail </th>
                                                                        <th> Tell-No</th>
                                                                        <th>Action</th>
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>At123</td>
                                                                        <td>Alfa grp</td>
                                                                        <td>At123</td>
                                                                        <td>Alfa grp</td>



                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                      <button type='button'  class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> 
                                               <button type='button'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
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