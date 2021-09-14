<?php

include_once "../../files/head.php";
include_once "../sales_invoice/sales_invoice.php";

    $sales_invoice1 = new sales_invoice();

    $result_sales_invoice = $sales_invoice1->get_all_sales_invoice();

?>

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
                                    <h4>Manage Sales Invoice</h4>

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

                <div class="d-flex flex-row-reverse">
<a href="add_new_salesinvoice.php">
                    <button class="btn btn-mat btn-primary ">Add New Sales Invoice</i></button>
</a>
                </div>


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Sales Invoice</h5>
                                    <span></span>
                                    <div class="card-header-right" >
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block"  style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reference No</th>
                                                    <th>Date </th>
                                                    <th>Customer</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                 foreach($result_sales_invoice as $item){

                                                                    echo"
                                                                    <tr>
                                                                        <td>#</td>
                                                                        <td>$item->salesinvoice_ref  </td>
                                                                        <td>$item->salesinvoice_date </td>
                                                                        <td>$item->salesinvoice_customer </td>
                                                                     
                                                                                                                                                                 
                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' id='edit_pr' onclick='view_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='icofont icofont-eye-alt'></i></span></button>
                                                                        <button type='button' onclick='edit_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                                                                        <button type='button'  onclick='delete_si($item->salesinvoice_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
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


<?php

include_once "../../files/foot.php";

?>
<!-- ---------------------------------------------------------------------------------------------------------- -->

<script>
function edit_si(edit_si) 
    {
        window.location.href = "edit_sales_invoice.php?edit_si=" + edit_si;
    }

    function view_si(view_si)
    {
        window.location.href = "view_sales_invoice.php?view_si=" + view_si;
    }

    function delete_si(deleteid) 
    {
        if (confirm("Do you want to delete id" + " " + deleteid)) 
        {
            window.location.href = "manage_sales_invoice.php?d_id=" + deleteid;
        }

    }
    </script>