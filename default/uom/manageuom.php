<?php
    include_once "uom.php";
    $uom1 = new uom();

    //code to insert and update data............................................................... 

     if(isset($_POST["unitcode"])){

        $uom1->uom_code = $_POST["unitcode"];
        $uom1->uom_name = $_POST["unitname"];
     
    if(isset($_POST["edit_uom"])){
        $res_edit=$uom1->edit_uom ($_POST["edit_uom"]);
        }
    else{
        $res_insert=$uom1->insert_uom();}
        //code for alert validations
        if($res_insert==true){
            header("location:../uom/manageuom.php?success=1");
        }elseif($res_edit==true){
        header("location:../uom/manageuom.php?success_edit=1");
        }else{
        echo"False";
        }
    }
//code to get uom details  into datatable........................................................................
    
    $result_uom = $uom1->get_all_uom();
//code to view uom................................................................
    if(isset($_GET['edit_uom'])){
        $uom1=$uom1->get_uom_by_id($_GET['edit_uom']);
    }

    //code to delete location..................................................................................
    $msg_2="";//alert message for delete
    if(isset($_GET['d_id'])){
        $res_del=$uom1->delete_uom ($_GET['d_id']);
        //code for delete validations
        if($res_del==true){
            
            $msg_2="Deleted Successfully";
        }else{
        
            $msg_2="Unit of measure already exists therefore cannot delete";
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
                                    <h4>Manage Product UOM</h4>

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
                                    <h5>Add New Product UOM</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form method="POST" avtion="manageuom.php">



                                        <div class="form-group row">

                                            <?php
                                   
                                   if(isset($_GET["edit_uom"])){
                                    echo"  <input type='hidden'  class='form-control' value='".$_GET['edit_uom'] ."' name='edit_uom' required readonly>";
                                   }
                                    

                                   ?>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">UOM Code</label>
                                                <input type="text" class="form-control" placeholder="" name="unitcode" id="unit_code" onkeyup="check_uomcode()" onblur="check_uomcode()" value="<?=$uom1->uom_code ?>"<?php if($uom1->uom_code){echo "readonly=\"readonly\"";} ?>> 
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">UOM Name</label>
                                                <input type="text" class="form-control" placeholder="" name="unitname" value="<?=$uom1->uom_name ?>" id="unit_name" onblur=" check_uomname()" onkeyup=" check_uomname() ">
                                                <div class="col-form-label" id="namecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>

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
                             <!-- //ALERT MESSAGES START................... -->
            <?php
            if(isset($_GET['success'])) {
                echo"<div class='alert alert-success background-success'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='icofont icofont-close-line-circled text-white'></i>
                </button>
                <strong>New Unit of measure added successfully</strong> 
            </div>";
            }
            ?>
            <?php
            if(isset($_GET['success_edit'])) {
                echo"<div class='alert alert-info background-info'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='icofont icofont-close-line-circled text-white'></i>
                </button>
                <strong>Unit of measure details updated successfully</strong> 
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
                                    <h5>UOM List</h5>
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
                                                    <th>#</th>
                                                    <th>UOM Code</th>
                                                    <th>UOM Name</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <?php     
                                                         foreach($result_uom as $item){ 
                                                        echo"
                                                                <tbody>
                                                                    <tr>
                                                                        <td>$item->uom_id</td>
                                                                        <td>$item->uom_code </td>
                                                                        <td>$item->uom_name </td>
                                                                        <td> <div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' onclick='edit_uom($item->uom_id)'    class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                                        <button type='button'  onclick='delete_uom($item->uom_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group'></span></button>
                                                                        
                                                                    </div></td>
                                                                    </tr>
                                           
                                                               
";}
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
                            <!-- ----------------------------------------------------------------------------------------------------------- -->

                            <script>
                            function delete_uom(d_id) {

                                if (confirm("Do you want to delete id" + " " + d_id)) {
                                    window.location.href = "manageuom.php?d_id=" + d_id;
                                }


                            }

                            function edit_uom(edit_uom) {

                   
                                    window.location.href = "manageuom.php?edit_uom=" + edit_uom;
                         


                            }
                            </script>