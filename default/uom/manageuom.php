<?php

    include_once "uom.php";
    $uom1 = new uom();

    // download the sample excel file
    if(!empty($_GET['file_download']))
    {
        // Get the name of the file
        $filename=basename($_GET['file_download']);
        // Get the path of the file and concat with the name
        $filepath='../import/excel/'.$filename;

        // check whether the file name id not empty and the file exists in the given path
        if(!empty($filename) && file_exists($filepath))
        {
            // Define the header
            header("Cache-Control:public");
            header("Content-Description:File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type:File application/zip");
            header("Content-Transfer-Emcoding: binary");

            readfile($filepath);
            exit;
        }
        else
        {
            echo "This file doesn't exist";

        }
    }


        // code to import uom.................................................
        if(isset($_POST["submit"]))
    {
        $uom1->import_uom();
    }

    //code to insert and update data............................................................... 
    if(isset($_POST["unitcode"]))
    {
        $uom1->uom_code = $_POST["unitcode"];
        $uom1->uom_name = $_POST["unitname"];
        //....................................................
        if(isset($_POST["edit_uom"]))
        {
            $res_edit=$uom1->edit_uom($_POST["edit_uom"]);
                //code for insert validation
                if($res_edit==true){
                   
                    header("location:../uom/manageuom.php?success_edit=1");
                }elseif($res_edit==false){
                    header("location:../uom/manageuom.php?notsuccess=1");
                }
        }else
        {
            // if($user4->check("MUA", 39)){
                $res_insert=$uom1->insert_uom();
                //code for insert validation
                if($res_insert==true){
                    
                    header("location:../uom/manageuom.php?success=1");
                }elseif($res_insert==false){
                    header("location:../uom/manageuom.php?notsuccess=1");
               }

            // }else{
            //     echo"No permission";
            // }
           
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
            
            header("location:../uom/manageuom.php?delete_success=1");
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
                                    <h5>Import UOM</h5>
                                    <a href="manageuom.php?file_download=../Import/excel/uom_test.xlsx">Download sample file<a>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form action="manageuom.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                
                                                <input type="file" name="doc" class="form-control">

                                            </div>
                                            <div class="col-sm-2">
                                            <button type="submit" name="submit" class="btn btn-primary">submit</button>
                                            </div>
                                        </div>
                            
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                    <?php
                                   
                                   if(isset($_GET["edit_uom"])){
                                    echo"Edit Product";
                                   }
                                   else
                                   echo "Add New Product UOM";
                                    

                                   ?></h5>

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


            <?php
                                   
                  if(isset($_GET["edit_uom"])){
                  echo"  <input type='text'  class='form-control' value='".$_GET['edit_uom'] ."' name='edit_uom' required readonly>";
                 }
                         

            ?>



                                        <div class="form-group row">

                                            <?php
                                   
                                   if(isset($_GET["edit_uom"])){
                                    echo"  <input type='hidden'  class='form-control' value='".$_GET['edit_uom'] ."' name='edit_uom' required readonly>";
                                   }
                                    

                                   ?>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">UOM Code</label>

                                                <input type="text" class="form-control" pattern="^[A-Z0-9]*$" placeholder="" name="unitcode" id="unit_code" onkeyup="check_uomcode()" onblur="check_uomcode()" value="<?=$uom1->uom_code ?>"<?php if($uom1->uom_code){echo "readonly=\"readonly\"";} ?> required> 
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">UOM Name</label>
                                                <input type="text" class="form-control" placeholder="" name="unitname" value="<?=$uom1->uom_name ?>" id="unit_name" onblur="check_uomname()" onkeyup="check_uomname()" required>
                                                <div class="col-form-label" id="namecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>


                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">ADD</button>
                                        <button type="reset" class="btn btn-inverse">CLEAR</button>
                                    </form>

                    </div>
            </div>
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
                                            <tbody>
                                            <?php     
                                                        foreach($result_uom as $item){ 
                                                        echo"
                                                                
                                                                    <tr>
                                                                        <td>$item->uom_id</td>
                                                                        <td>$item->uom_code </td>
                                                                        <td>$item->uom_name </td>
                                                                        <td> <div class='btn-group btn-group-sm' style='float: none;'>";
                                                                        if($user4->check("MUE", 40)){
                                                                            echo"<button type='button'  onclick='edit_uom($item->uom_id)'class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit'></span></button>";
                                                                        }
                                                                        if($user4->check("MUD", 42)){
                                                                            echo"  <button type='button'  onclick='delete_uom($item->uom_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group'></span></button>";
                                                                        }
                                                                        
                                                                        
                                                                        
                                                                      
                                                                        
                                                                  echo"  </div></td>

                                                                    </tr>
                                                                    ";
  }
                                           ?>
                                            </tbody>
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
                           
                            <script type="text/javascript" src="../javascript/masterfile.js"></script>
                           
                            <script>
                            function delete_uom(d_id) {

                                if (confirm("Do you want to delete id" + " " + d_id)) {
                                    window.location.href = "manageuom.php?d_id=" + d_id;
                                }


                            }

                            function edit_uom(edit_uom_id) {

                   
                                    window.location.href = "manageuom.php?edit_uom=" + edit_uom_id;
                         


                            }
                            
                            $( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
                            </script>
                     
                        