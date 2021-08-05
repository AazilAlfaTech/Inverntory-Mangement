<?php
include_once "salesrep.php";

    $salesrep1 = new salesrep();

//code to insert and update data............................................................... 

    if(isset($_POST["locname"])){

        $salesrep1->salesrep_code = $_POST["loccode"];
        $salesrep1->salesrep_name = $_POST["locname"];


     if(isset($_POST["edit_salesrep"])){
        $res_edit=$salesrep1->edit_salesrep ($_POST["edit_salesrep"]);
        }
    else{
        $res_insert=$salesrep1->insert_salesrep();}
        //code for alert validations
            // if($res_insert==true){
               
            //     header("salesrep:../salesrep/manage_salesrep.php?success=1");
            // }elseif($res_edit==true){
            //     header("salesrep:../salesrep/manage_salesrep.php?success_edit=1");
            // }else{
            //     echo"False";
            // }

    }
//code to get salesrep details  into datatable........................................................................
    
    $result_salesrep = $salesrep1->get_all_salesrep();
//code to view salesrep................................................................
    if(isset($_GET['edit_salesrep'])){
        $salesrep1=$salesrep1->get_salesrep_by_id($_GET['edit_salesrep']);
    }
//code to delete group..................................................................................

$msg_2="";//alert message for delete


    if(isset($_GET['d_id'])){
        $res_del=$salesrep1->delete_salesrep ($_GET['d_id']);
        
        //code for delete validations
            if($res_del==true){
                
                $msg_2="Deleted Successfully";
            }else{
            
                $msg_2="salesrep already exists therefore cannot delete";
            }
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
                                    <h4>Manage salesrep</h4>

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
                                    <h5>Add New  salesrep</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon- minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manage_salesrep.php" method="POST" id="">

                                        <?php
                                   
                                   if(isset($_GET["edit_salesrep"])){
                                    echo"  <input type='hidden'  class='form-control' value='".$_GET['edit_salesrep'] ."' name='edit_salesrep' required readonly>";
                                   }
                                    

                                   ?>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">salesrep Code</label>
                                                <input type="text" value="<?=$salesrep1->salesrep_code?>" <?php if($salesrep1->salesrep_code){echo "readonly=\"readonly\"";} ?>
                                                    class="form-control" placeholder="" name="loccode" pattern="^[A-Z0-9]*$" id="loc_code" onkeyup="check_salesrepcode()" onblur="check_salesrepcode()" required>
                                                    <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">salesrep Name</label>
                                                <input type="text" value="<?= $salesrep1->salesrep_name ?>"
                                                    class="form-control" placeholder="" name="locname" id="loc_name" required>
                                            </div>

                                       
                                        </div>

                                        <div class="form-group row">

                                        <div class="col-sm-4">
                                                <label class=" col-form-label">city</label>
                                                <input type="text" value="<?=$salesrep1->salesrep_code?>" <?php if($salesrep1->salesrep_code){echo "readonly=\"readonly\"";} ?>
                                                    class="form-control" placeholder="" name="loccode" pattern="^[A-Z0-9]*$" id="loc_code" onkeyup="check_salesrepcode()" onblur="check_salesrepcode()" required>
                                                    <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <label class=" col-form-label">salesrep Name</label>
                                                <input type="text" value="<?= $salesrep1->salesrep_name ?>"
                                                    class="form-control" placeholder="" name="locname" id="loc_name" required>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">salesrep Name</label>
                                                <input type="text" value="<?= $salesrep1->salesrep_name ?>"
                                                    class="form-control" placeholder="" name="locname" id="loc_name" required>
                                            </div> -->

                   

                                        
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
                            <!-- //ALERT MESSAGES START................... -->
                            <?php
                            if(isset($_GET['success'])) {
                                echo"<div class='alert alert-success background-success'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>New salesrep added successfully</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['success_edit'])) {
                                echo"<div class='alert alert-info background-info'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>salesrep details updated successfully</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['d_id'])) {
                                echo"<div class='alert alert-danger background-danger'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>$msg_2</strong> 
                            </div>";
                            }
                            ?>
                        <!-- //ALERT MESSAGES END................... -->
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>salesrep List</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block"   style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>salesrep id</th>
                                                    <th>salesrep Code</th>
                                                    <th>Lcation Name</th>
  

                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($result_salesrep as $item){
                                                        echo"
                                                        <tr>
                                                            <td>$item->salesrep_id</td>
                                                            <td>$item->salesrep_code</td>
                                                            <td>$item->salesrep_name  </td>
                                                         

                                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                            <button type='button' onclick='edit_salesrep($item->salesrep_id)'    class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                            <button type='button'  onclick='delete_salesrep($item->salesrep_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group'></span></button>
                                                            
                                                        </div>
                                                        </tr>
                                                        ";
                                                        }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>

                            <!-- ------------------------------------------------------------------------------------------------- -->

                          
                            <script>
                            function delete_salesrep(d_id) {

                                if (confirm("Do you want to delete id" + " " + d_id)) {
                                    window.location.href = "manage_salesrep.php?d_id=" + d_id;
                                }


                            }

                            function edit_salesrep(edit_salesrep) {

                   
                                    window.location.href = "manage_salesrep.php?edit_salesrep=" + edit_salesrep;
                         


                            }
                            </script>