<?php
  include_once "../user/user.php";
  $user1 = new user();
  $resultuser=$user1->get_al_user();

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
                                    <h4>Manage User</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../user/manage_user.php">ManageUser</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

               <?php
                if($user4->check("UNA", 75)){
                    echo'
                        <div class="d-flex flex-row-reverse">
                        <a href="../user/register.php">
                            <button class="btn btn-mat btn-primary ">Add New User</i></button>
                        </a>
                        </div>
                    ';
                }


               ?>

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
                                    <h5>User Roles</h5>
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
                                                   <th>Username</th>
                                                   <th>Email</th>
                                                   <th>Role</th>
                                                   <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach($resultuser as $item){
                                                echo" <tr>
                                                <td>$item->user_name</td>
                                                <td>$item->user_email</td>
                                                <td>$item->rolename</td>
                                                <td style='white-space: nowrap, width: 1%;'>
                                                            <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                <div class='btn-group btn-group-sm' style='float: none;'>";
                                                                if($user4->check("UNV", 77)){
                                                                    echo"<a href='viewuser.php?view=$item->user_id' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></a>";
                                                                }
                                                                if($user4->check("UNE", 76)){
                                                                    echo" <a href='register.php?edit=$item->user_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit'></span></a>";
                                                                }
                                                                if($user4->check("UND", 78)){
                                                                    echo" <button type='button'  onclick='deleteorder($item->user_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o'></span></button>";
                                                                }
                                                                    
                                                                echo"   </div>
                                                            </td>
                                            </tr> ";
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
<script>
 
</script>