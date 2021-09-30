<?php




include_once "../../files/head.php";
include_once "../supplier/supplier.php";
$sup = new supplier();
$res_sup = $sup->get_all_supplier();

include_once "../group/group.php";
$grp = new group();
$res_grp = $grp->get_all_group();

include_once "../producttype/producttype.php ";
$typ = new producttype();
$res_typ = $typ->getall_type();

include_once "../location/location.php";
$loc = new location();
$res_loc = $loc->get_all_location();

include_once "../product/product.php";
$prd = new product();
$res_prd = $prd->getall_product2()










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
                                    <h4>Purchase Order Report</h4>

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


                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">


                            <div class="card">
                                <div class="card-header">
                                    <h5>Purchase Order Report</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <div class="card-block">

                                        <form action=" " method="POST" id="submitgroup">



                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">From</label>

                                                    <input type="date" class="form-control" name="groupcode" pattern="" id="gr_code" placeholder="" >
                                                    <div class="col-form-label" id="">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">To</label>
                                                    <input type="date" name="groupname" class="form-control" id="gr_name" >
                                                    <div class="col-form-label" id="namecheck_msg" style="display:none;">
                                                    </div>

                                                </div>

                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">Suplier</label>
                                                 

                                                    <select class="js-example-basic-single col-sm-12" name="" id="" required>
                                                    <option value="-1">Select Supplier</option>
                                                    <?php
                                                        foreach($res_sup as $item)
                                                      
                                                        echo"<option value='$item->supplier_id '>$item->supplier_name</option>";
                                                   ?>
                                                </select>

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">Group</label>

                                                   
                                                    <select class="js-example-basic-single col-sm-12 " name="" id="">

                                                    <option value="-1">Select Group</option>
                                                    <?php
                                                        foreach($res_grp as $item)
                                                      
                                                        echo"<option value='$item->group_id '>$item->group_name</option>";
                                                   ?>

                                                    </select>
                                                </div>

                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">Type</label>
                                          
                                                    <select class="js-example-basic-single col-sm-12 " name="" id="">
                                                    <option value="-1">Select Type</option>
                                                    <?php
                                                        foreach($res_typ as $item)
                                                      
                                                        echo"<option value='$item->ptype_id '>$item->ptype_name</option>";
                                                   ?>



                                                    </select>
                                               
                                                   

                                                </div>

                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">Location</label>
                                                
                                                    <select class="js-example-basic-single col-sm-12 " name="" id="">
                                                    <option value="-1">Select Location</option>
                                                    <?php
                                                        foreach($res_loc as $item)
                                                      
                                                        echo"<option value='$item->location_id '>$item->location_name</option>";
                                                   ?>


                                                    </select>
                                                
                                               

                                                </div>

                                                
                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">Product </label>
                                                  
                                                
                                                    <select class="js-example-basic-single col-sm-12" name="" id="" required>
                                                    <option value="-1">Select Product</option>
                                                    <?php
                                                        foreach($res_prd as $item)
                                                      
                                                        echo"<option value='$item->product_id'>$item->product_name</option>";
                                                   ?>
                                                </select>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <button type="reset" class="btn btn-inverse">CLEAR</button>
                                        </form>
                                    </div>
                                    <hr>
                                </div>

                        
                                <div class="card-block">

                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>DATE</th>
                                                        <th>Ref No</th>
                                                        <th>Product Code</th>
                                                        <th>Group</th>
                                                        <th>Type</th>
                                                        <th>Product Name</th>

                                                        <th>Supplier</th>
                                                        <th>Location</th>
                                                        <th>Quantity</th>
                                                        <th>Cost Price</th>
                                                        <th>Disc %</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                        <td>$320,800</td>
                                                    </tr>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

                            include_once "../../files/foot.php";

                            ?>

                            <!-- ------------------------------------------------------------------------------------------------- -->