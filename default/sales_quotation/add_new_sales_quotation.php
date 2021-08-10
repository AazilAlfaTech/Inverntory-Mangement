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
                                    <h4>Add New Sales Quotation</h4>

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
                                    <h5>Add New Sales Quotation</h5>

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
                                                <select class="js-example-basic-single col-sm-12" name="salesquotcustomer" id="sq_customer">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="salesquotdate" id="sq_date">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12" name="sqitem_productid" id="sq_itemproductid">

                                                    <option value="AL">Alabama</option>
                                                    <option value="WY">Wyoming</option>
                                                    <option value="WY">Peter</option>
                                                    <option value="WY">Hanry Die</option>
                                                    <option value="WY">John Doe</option>

                                                </select>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Price</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_price" id="sq_itemprice">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_qty" id="sq_itemqty">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_discount" id="sq_itemdiscount">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_finalprice" id="sq_itemfinalprice" disabled>
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