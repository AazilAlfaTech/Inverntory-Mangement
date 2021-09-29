<?php
    include_once "inetrlocationtransfer.php";
    $inter_loc_tr1 = new inter_loc_transfer();

  $res_int_tr =  $inter_loc_tr1->get_all_inter_loc_transfer();


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
                                    <h4>Manage Interlocation Transfer</h4>

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
                <a href="add_interlocation_tr.php">
                    <button class="btn btn-mat btn-primary ">Add New Interlocation Transfer</i></button>
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
                                    <h5>Interlocation Transfer</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Reference No</th>
                                                    <th>Date </th>
                                                  
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                        foreach ($res_int_tr as $item)
                                                        {
                                                            echo
                                                            "<tr>
                                                           
                                                                <td>$item->inter_loc_transfer_code</td>
                                                                <td>$item->inter_loc_transfer_date</td>
                                                         

                                                                <td>
                                                                    <div class='btn-group btn-group-sm' style='float: none;'>
     
                                                                        <button type='button' onclick='edit_int($item->inter_loc_transfer_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><i class='fa fa-edit'></i></button>
                                                                        <button type='button'  onclick='del_group($item->inter_loc_transfer_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
                                               
                                                                    </div>
                                                                </td>
                                                            </tr> ";
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
<script>
     function edit_int(grn)
    {
        window.location.href="edit_interlocation_tr.php?view="+grn;
    }

    function view_grn(grn)
    {
        window.location.href="view_grn.php?view="+grn;
        window.location.href="print_grn.php?view="+grn;
    }
</script>