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
                                    <h4>Add New Salaes Order</h4>

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
                                    <h5>Add New Salaes Order</h5>

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
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="js-example-basic-single col-sm-12" name="socustomer" id="so_customer">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="sodate" id="so_date">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12" name="soitemproductid" id="soitem_productid">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

                                                </select>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Price</label>
                                                <input type="text" class="form-control" placeholder="" name="soitemprice" id="soitem_price">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control" placeholder="" name="soitemqty" id="soitem_qty">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control" placeholder="" name="soitemdiscount" id="soitem_discount">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control" placeholder="" name="sofinalprice" id="sofinal_price" disabled>
                                            </div>

                                        </div>

                                        <button class="btn btn-primary">ADD</button>
                                        <button class="btn btn-inverse">CLEAR</button>

                                        <br>
                                        <br>


                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                        <td>@mdo</td>
                                                        <td> <button class="btn btn-mat btn-danger "><i
                                                                    class="fa fa-trash"></i> </button>
                                                            <button class="btn btn-mat btn-info "><i
                                                                    class="fa fa-edit"></i> </button>
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