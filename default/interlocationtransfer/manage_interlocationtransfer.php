<?php
    include_once "interlocationtransfer.php";
    $inter_loc_tr1 = new inter_loc_transfer();

  $res_int_tr1=  $inter_loc_tr1->get_all_inter_loc_transfer();


//   Delete interloc transfer
    if(isset($_GET['d_id']))
    {
        $res_int_tr2=$inter_loc_tr1->delete_inter_loc_transfer($_GET['d_id']);
    
        //code for delete validations
        if($res_int_tr2==true)
        {
            header("location:../interlocationtransfer/manage_interlocationtransfer.php?delete_success=1");
        }
        else
        {
            $msg_2=" Delete unsuccessful";        
        } 
    }

    // Edit interloc transfer
    if(isset($_GET['edit_interloc']))
    {
        $res_int_tr3=$inter_loc_tr1->get_inter_loc_transfer_by_id($_GET['edit_interloc']);

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
                <?php
                if($user4->check("INTA", 83)){
                    echo'<div class="d-flex flex-row-reverse">
                    <a href="add_interlocation_tr.php">
                        <button class="btn btn-mat btn-primary ">Add New Interlocation Transfer</i></button>
                    </a>
                    </div>';
                }
                ?>

                


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- ALERT MESSAGE START -->
                            <?php
                                if(isset($_GET['success'])) {
                                    echo"<div class='alert alert-success background-success'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>New Purchase Requisition added successfully</strong> 
                                </div>";
                                }
                                ?>
                                 <?php
                                if(isset($_GET['success_edit'])) {
                                    echo"<div class='alert alert-info background-info'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>Purchase requisition details updated successfully</strong> 
                                </div>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['delete_success'])) {
                                    echo"<div class='alert alert-danger background-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>Deleted successful</strong> 
                                </div>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['delete_PO'])) {
                                    echo"<div class='alert alert-danger background-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>$msg_2</strong> 
                                </div>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['notsuccess'])) {
                                    echo"<div class='alert alert-danger background-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>The code or the name already exists.Please try again</strong> 
                                </div>";
                                }
                            ?>
                            <!-- ALERT MESSAGE END -->
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
                                                    <th>Location From</th>
                                                    <th>Location To</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                        foreach ($res_int_tr1 as $item)
                                                        {
                                                            echo
                                                            "<tr>
                                                           
                                                                <td>$item->inter_loc_transfer_code</td>
                                                                <td>$item->inter_loc_transfer_date</td>
                                                                <td>$item->locationfrom</td>
                                                                <td>$item->locationto</td>
                                                                
                                                                <td>
                                                                    <div class='btn-group btn-group-sm' style='float: none;'>
     
                                                                        <button type='button' onclick='edit_int($item->inter_loc_transfer_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><i class='fa fa-edit'></i></button>
                                                                        <button type='button'  onclick='delete_int($item->inter_loc_transfer_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
                                               
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
<script type="text/javascript" src="../javascript/customer.js"></script>

<script>
    $(".alert").fadeIn(300).delay(3500).fadeOut(400);

     function edit_int(edit_intloc)
    {
        window.location.href="edit_interlocation_tr.php?edit_intloc="+edit_intloc;
    }

    function view_int(view_intloc)
    {
        // window.location.href="view_grn.php?view="+intloc;
        window.location.href="print_grn.php?view_intloc="+view_intloc;
    }

    function delete_int(deleteid)
    {
        if (confirm("Do you want to delete id" + " " + deleteid)) {
        window.location.href = "manage_interlocationtransfer.php?d_id=" + deleteid;
    }

}
</script>