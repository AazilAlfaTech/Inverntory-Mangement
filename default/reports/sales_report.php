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
$res_prd = $prd->getall_product2();

include_once "../customer/customer.php";
$cus = new customer();
$res_cus = $cus->get_all_customer();

include_once "../sales_invoice/sales_invoice.php";
$sales_invoice4=new sales_invoice();
$res_invoice=$sales_invoice4->sales_report();
//print_r($res_invoice);
//exit;

if(isset($_POST['filter'])){
    $res_invoice=$sales_invoice4-> sales_report_filter($_POST);
}






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
                                    <h4>Sales Report</h4>

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
                                    <h5>Sales Report</h5>
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

                                        <form action="sales_report.php" method="POST" >



                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">From</label>

                                                    <input type="date" class="form-control" name="filter_startdt" pattern="" id="gr_code" placeholder="" >
                                                  
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">To</label>
                                                    <input type="date" name="filter_enddt" class="form-control" id="gr_name" >
                                                    

                                                </div>

                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">Customer</label>
                                                 

                                                    <select class="js-example-basic-single col-sm-12" name="filter_cus" id="" >
                                                    <option value="-1">Select Customer</option>
                                                    <?php
                                                        foreach($res_cus as $item)
                                                      
                                                        echo"<option value='$item->customer_name '>$item->customer_name</option>";
                                                   ?>
                                                </select>

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">Group</label>

                                                   
                                                    <select class="js-example-basic-single col-sm-12 " name="filter_group" id="">

                                                    <option value="-1">Select Group</option>
                                                    <?php
                                                        foreach($res_grp as $item)
                                                      
                                                        echo"<option value='$item->group_name '>$item->group_name</option>";
                                                   ?>

                                                    </select>
                                                </div>

                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">Type</label>
                                          
                                                    <select class="js-example-basic-single col-sm-12 " name="filter_type" id="">
                                                    <option value="-1">Select Type</option>
                                                    <?php
                                                        foreach($res_typ as $item)
                                                      
                                                        echo"<option value='$item->ptype_name '>$item->ptype_name</option>";
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
                                                  
                                                
                                                    <select class="js-example-basic-single col-sm-12" name="filter_product" id="" required>
                                                    <option value="-1">Select Product</option>
                                                    <?php
                                                        foreach($res_prd as $item)
                                                      
                                                        echo"<option value='$item->product_name'>$item->product_name</option>";
                                                   ?>
                                                </select>
                                                </div>

                                            </div>

                                            <button type="submit" name='filter' class="btn btn-primary">Search</button>
                                            <button type="reset" class="btn btn-inverse">CLEAR</button>
                                        </form>
                                    </div>
                                    <hr>
                                </div>

                        
                                <div class="card-block">

                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="table34" class="table table-striped table-bordered nowrap ">
                                                <thead>
                                                    <tr>
                                                        <th>DATE</th>
                                                        <th>Ref No</th>
                                                        <th>Product Code</th>
                                                        
                                                        <th>Product Name</th>


                                                        <th>Customer</th>

                                                        <th>Location</th>
                                                       
                                                        <th>Quantity</th>
                                                        <th>Dicount%</th>
                                                        <th>Discount</th>
                                                        <th>Sales Price</th>
                                                        <th>Total</th>
                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($res_invoice as $item){
                                                            echo"
                                                            <tr>
                                                            <td>$item->salesinvoice_date</td>
                                                            <td>$item->salesinvoice_ref</td>
                                                            <td>$item->product_code</td>
                                                            
                                                            <td>$item->product_name</td>
                                                            <td>$item->customer_name</td>
                                                            <td></td>
                                                            <td>$item->si_item_qty</td>
                                                           
                                                            <td>$item->si_item_discount_amount</td>
                                                            <td>$item->si_item_price</td>
                                                            <td>$item->si_item_total</td>
                                                            
                                                            </tr>
                                                            ";
                                                        }

                                                    ?>
                                                    

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="6">Totals:</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        
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

                            <script>

$(document).ready(function () {
						$('#table34').DataTable({
							"searching": true,
                            "lengthChange": true,
                     
                            "iDisplayLength": 10,
                                                    //"pageLength": 40,
							"scrollX": true,
							"paging": true,
							"info": true,
                            dom: 'Bfrtip',
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
							drawCallback: () => {
								const table = $('#table34').DataTable();
								const tableData = table.rows({
										search: 'applied'
									}).data().toArray();
								const totals = tableData.reduce((total, rowData) => {
										total[0] += parseFloat(rowData[6]);
										total[1] += parseFloat(rowData[7]);
                                        total[2] += parseFloat(rowData[8]);
                                       total[3] += parseFloat(rowData[9]);
                                       
                                       
										return total;
									}, [0, 0,0,0]);
								$(table.column(6).footer()).text(totals[0]);
								$(table.column(7).footer()).text(totals[1]);
                                $(table.column(8).footer()).text(totals[2]);
                                $(table.column(9).footer()).text(totals[3]);
                               //  $(table.column(11).footer()).text(totals[4]);
							}
						})
					});				
                            </script>


?>