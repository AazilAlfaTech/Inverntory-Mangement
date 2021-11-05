<?php





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

include_once "../sales_dispatch/sales_dispatch.php";
$salesdispatch5=new sales_dispatch();
$res_dispatch=$salesdispatch5->sales_dispatch_report();

if(isset($_POST['filter'])){
    $res_dispatch=$salesdispatch5->sales_dispatch_report_filter($_POST);
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
                                    <h4>GRN Report</h4>

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
                                    <h5>Sales Dispatch Report</h5>
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

                                        <form action="dispatch_report.php " method="POST" id="submitgroup">



                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">From</label>

                                                    <input type="date" class="form-control" name="filter_startdt" pattern="" id="gr_code" placeholder="" >
                                                    
                                                   
                                                </div>

                                                <div class="col-sm-3">
                                                    <label class=" col-form-label">To</label>
                                                    <input type="date" name="filter_enddt" class="form-control" id="gr_name" >
                                                   
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
                                                <div class="col-sm-3">
                                                <label class=" col-form-label">Location</label>
                                                
                                                <select class="js-example-basic-single col-sm-12 " name="filter_location" id="">
                                                <option value="-1">Select Location</option>
                                                <?php
                                                    foreach($res_loc as $item)
                                                  
                                                    echo"<option value='$item->location_name '>$item->location_name</option>";
                                               ?>


                                                </select>
                                                </div>

                                                
                                                </div>

                                            </div>


                                            <button type="submit" name="filter" class="btn btn-primary">Search</button>
                                            <button type="reset" class="btn btn-inverse">CLEAR</button>
                                        </form>
                                    </div>
                                    <hr>
                                </div>

                        
                                <div class="card-block">

                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="table34" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>DATE</th>
                                                        <th>Ref No</th>                      
                                                        <th>Sales Inv No.</th>
                                                        <th>Product Code</th>   
                                                        <th>Product Name</th>
                                                        <th>Location</th>
                                            
                                                        <th>Quantity</th>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($res_dispatch as $item){
                                                            echo"
                                                            <tr>
                                                        <td>$item->salesdispatch_date</td>
                                                        <td>$item->salesdispatch_ref</td>
                                                        <td>$item->salesinvoice_ref</td>
                                                        <td>$item->product_code</td>
                                                        <td>$item->product_name</td>
                                                        <td>$item->location_name</td>
                                                        <td>$item->sd_item_qty</td>
                                                       
                                                       
                                                    </tr>
                                                            ";
                                                        }
                                                    ?>
                                                    

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                     <th colspan="6">Totals</th>
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
									
                                        
                                       
										return total;
									}, [0, 0,0]);
								$(table.column(6).footer()).text(totals[0]);
								
                               
							}
						})
					});				
                            </script>