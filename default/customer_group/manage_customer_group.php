<?php


include_once "customer_group.php";

    $customergroup1 = new customergroup();


    if(isset($_POST["cust_grcode"])){

        $customergroup1->customergroup_code = $_POST["cust_grcode"];
        $customergroup1->customergroup_name = $_POST["cust_grname"];
       


        if(isset($_POST["edit_cus_grp"])){
            
            $customergroup1->edit_customer_group ($_POST["edit_cus_grp"]);
        }
else{
        $customergroup1->insert_customer_group();
        header("location:../customer_group/manage_customer_group.php ");
    }
    }

    
    $result_customer_group = $customergroup1->get_all_customer_group();

    if(isset($_GET['edit_cus_grp'])){
        $customergroup1=$customergroup1->get_customer_group_by_id($_GET['edit_cus_grp']);
        header("location:../customer_group/manage_customer_group.php ");
    }



    if(isset($_GET['d_id'])){
        $customergroup1->delete_customer_group ($_GET['d_id']);
        header("location:../customer_group/manage_customer_group.php ");
    }

    // print_r($result_customer_group);














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
                                    <h4>Manage Customer Group</h4>

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
                                    <h5>Add New Customer Group</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form method="POST" action="manage_customer_group.php">




                                        <div class="form-group row">

                                        <?php
                                   
                                   if(isset($_GET["edit_cus_grp"])){
                                    echo"  <input type='text'  class='form-control' value='".$_GET['edit_cus_grp'] ."' name='edit_cus_grp' required readonly>";
                                   }
                                    

                                   ?>

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Customer Group Code</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="<?=$customergroup1->customergroup_code ?>" name="cust_grcode"
                                                    id="cust_gr_code">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Customer Group Name</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="<?=$customergroup1->customergroup_name ?>" name="cust_grname"
                                                    id="cust_gr_name">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">ADD</button>
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
                                    <h5>Customer Group List</h5>
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
                                                    <th>Customer Group Code</th>
                                                    <th> Customer Group Name</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
  foreach($result_customer_group as $item){
                                                                    echo"
                                                                    <tr>
                                                                
                                                                        <td>$item->customergroup_code</td>
                                                                        <td>$item->customergroup_name  </td>
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' onclick='edit_cus_grp($item->customergroup_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                                               <button type='button'  onclick='delete_cus_grp($item->customergroup_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
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





















                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>

                            <!-- ------------------------------------------------------------------------------------------------------ -->


                            <script type="text/javascript" src="../javascript/masterfile.js"></script>
                            <script>
                            function edit_cus_grp(edit_cus_grp) {


                                window.location.href = "manage_customer_group.php?edit_cus_grp=" + edit_cus_grp;


                            }


                            function delete_cus_grp(deleteid) {

                                if (confirm("Do you want to delete id" + " " + deleteid)) {
                                    window.location.href = "manage_customer_group.php?d_id=" + deleteid;
                                }

                            }
                            </script>