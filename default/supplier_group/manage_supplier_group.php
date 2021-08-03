<?php

include_once "supplier_group.php";

    $suppliergroup1 = new supplier_group();


    if(isset($_POST["sup_grcode"])){

        $suppliergroup1->suppliergroup_code = $_POST["sup_grcode"];
        $suppliergroup1->suppliergroup_name = $_POST["sup_grname"];
       


        if(isset($_POST["edit_sup_grp"])){
            
            $suppliergroup1->edit_supplier_group ($_POST["edit_sup_grp"]);
            header("location:../supplier_group/manage_supplier_group.php ");
        }
else{
        $suppliergroup1->insert_suppier_group();
         header("location:../supplier_group/manage_supplier_group.php ");
    }
    }

    
    $result_supplier_group = $suppliergroup1->get_all_supplier_group();

    if(isset($_GET['edit_sup_grp'])){
        $suppliergroup1=$suppliergroup1->get_supplier_group_by_id($_GET['edit_sup_grp']);

    }



    if(isset($_GET['d_id'])){
        $suppliergroup1->delete_supplier_group ($_GET['d_id']);
        header("location:../supplier_group/manage_supplier_group.php ");
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
                                    <h4>Manage Supplier Group</h4>

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
                                    <h5>Add New Supplier Group</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manage_supplier_group.php" method="POST" >


                                    <?php
                                   
                                   if(isset($_GET["edit_sup_grp"])){
                                    echo"  <input type='text'  class='form-control' value='".$_GET['edit_sup_grp'] ."' name='edit_sup_grp' required readonly>";
                                   }
                                    

                                   ?>


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Supplier Group  Code</label>
                                                <input type="text" class="form-control" placeholder="" name="sup_grcode" 
                                                value="<?=$suppliergroup1->suppliergroup_code ?>"id="sup_gr_code">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Supplier Group Name</label>
                                                <input type="text" class="form-control" placeholder="" name="sup_grname" 
                                                value="<?=$suppliergroup1->suppliergroup_name ?>" id="sup_gr_name">
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
                                                        <h5>Supplier Group List</h5>
                                                        <span></span>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                          
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="autofill" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Supplier Group Code</th>
                                                                        <th>Supplier Group Name</th>
                                                                        <th>Action</th>
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
  foreach($result_supplier_group as $item){
                                                                    echo"
                                                                    <tr>
                                                                
                                                                        <td>$item->suppliergroup_code</td>
                                                                        <td>$item->suppliergroup_name  </td>
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' onclick='edit_sup_grp($item->suppliergroup_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                                               <button type='button'  onclick='delete_sup_grp($item->suppliergroup_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
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
<!-- ------------------------------------------------------------------------------------------------------------------- -->

<script type="text/javascript" src="../javascript/masterfile.js"></script>
                            <script>
                            function edit_sup_grp(edit_sup_grp) {


                                window.location.href = "manage_supplier_group.php?edit_sup_grp=" + edit_sup_grp;


                            }


                            function delete_sup_grp(deleteid) {

                                if (confirm("Do you want to delete id" + " " + deleteid)) {
                                    window.location.href = "manage_supplier_group.php?d_id=" + deleteid;
                                }

                            }
                            </script>