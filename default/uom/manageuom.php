<?php
include_once "uom.php";



     $uom1 = new uom();

     if(isset($_POST["unitcode"])){

        $uom1->uom_code = $_POST["unitcode"];
        $uom1->uom_name = $_POST["unitname"];
     


        if(isset($_POST["edit_uom"])){
            $uom1->edit_uom ($_POST["edit_uom"]);
        }
else{
        $uom1->insert_uom();
    }
    }

    
    $result_uom = $uom1->get_all_uom();

    if(isset($_GET['edit_uom'])){
        $uom1=$uom1->get_uom_by_id($_GET['edit_uom']);
    }



    if(isset($_GET['d_id'])){
        $uom1->delete_uom ($_GET['d_id']);
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


            <?php
                                   
                  if(isset($_GET["edit_uom"])){
                  echo"  <input type='text'  class='form-control' value='".$_GET['edit_uom'] ."' name='edit_uom' required readonly>";
                 }
                         

            ?>



                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">UOM Code</label>
                                                <input type="text" value="<?= $uom1->uom_code ?>" class="form-control" placeholder="" name="unitcode"
                                                    id="unit_code">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">UOM Name</label>
                                                <input type="text" value =  "<?= $uom1->uom_name ?>" class="form-control" placeholder="" name="unitname"
                                                    id="unit_name">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">ADD</button>
                                        <button class="btn btn-inverse">CLEAR</button>
                                    </form>

                    </div>
            </div>
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
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
                                                                        <td>$item->uom_code </td>
                                                                        <td>$item->uom_name </td>
                                                                        <td> <div class='btn-group btn-group-sm' style='float: none;'>
      <a href='manageuom.php?edit_uom=$item->uom_id'><button type='button'   class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                 <button type='button'  onclick='delete_uom($item->uom_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group'></span></button>
                                             

                                           </div></td>
                                          
                                               
                                                                       
                                                                       
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
                            <!-- ----------------------------------------------------------------------------------------------------------- -->

                            <script>
                            function delete_uom(d_id) {

                                if (confirm("Do you want to delete id" + " " + d_id)) {
                                    window.location.href = "manageuom.php?d_id=" + d_id;
                                }


                            }
                            </script>