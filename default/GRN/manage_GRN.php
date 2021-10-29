<?php
    include_once "GRN.php";

    $grn1=new GRN ();
    $result_grn1=$grn1->get_all_grn();
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
                                    <h4>Manage GRN</h4>

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
                <a href="add_new_GRN.php">
                    <button class="btn btn-mat btn-primary ">Add New GRN</i></button>
                </a>
                </div>


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <?php
                            if(isset($_GET['success'])) {
                                echo"<div class='alert alert-success background-success'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>New GRN added successfully</strong> 
                            </div>";
                            }
                        ?>
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Good Received Note</h5>
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
                                                    <th>Supplier</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                        foreach ($result_grn1 as $item)
                                                        {
                                                            echo
                                                            "<tr>
                                                           
                                                                <td>$item->grn_ref_no</td>
                                                                <td>$item->grn_date</td>
                                                                <td>$item->grn_supplier</td>

                                                                <td>
                                                                    <div class='btn-group btn-group-sm' style='float: none;'>
                                                                    <button type='button' id='edit_pr' onclick='view_grn($item->grn_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><i class='fa fa-eye'></i></button>
                                                                        
                                               
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
     function GRN_details(grn)
    {
        window.location.href="edit_grn.php?view="+grn;
    }

    function view_grn(grn)
    {
        // window.location.href="view_grn.php?view="+grn;
        window.location.href="print_grn.php?view="+grn;
    }

    $( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );

</script>