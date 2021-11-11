<?php


include_once "../user/user.php";
include_once "../permission/role.php";
$user1 = new user();
$role1 = new role();

$res_role=$role1->getall_roles(); 


if(isset($_GET['edit'])){
    $user1=$user1->get_userby_id($_GET['edit']);
}



if(isset($_POST["save"]))
    {
        if($_POST["user_password"]!=$_POST["user_password_confirm"])
        {
            echo"incorrectpass";
        }else
        {
            $user1->user_name=$_POST["user_name"];
            $user1->user_email=$_POST["user_email"];
            $user1->user_password=$_POST["user_password"]; 
            $user1->user_roleid=$_POST["user_roleid"]; 

            if(isset($_POST["userid"]))
            {
                $user1->edituser($_POST["userid"]);
            }else
            {
                $user1->insert_user();
            }
        }
       


     
      
    }

    include_once "../../files/head.php";

?>







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
                                    <h4>Add user</h4>

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

                <!-- <div class="d-flex flex-row-reverse">
                <a href="add_new_GRN.php">
                    <button class="btn btn-mat btn-primary ">Add New GRN</i></button>
                </a>
                </div> -->


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
                                    <h5>Add user</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" >

                             
                                    <form method="POST" action="register.php">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                    <label> Name</label>
                                                    <input type="text" class="form-control" placeholder="" name="user_name" value="<?=$user1->user_name ?>">
                                                    
                                            </div>
                                            <div class="col-sm-6">
                                                    <label>Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="user_email" value="<?=$user1->user_email ?>">
                                            </div>

                                        </div>
                                        <?php
                                            if(isset($_GET['edit'])){
                                                echo"<input type='text' class='form-control'  name='userid' value='".$_GET['edit'] ."'>";
                                            }
                                        ?>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                    <label> Password</label>
                                                    <input type="password" class="form-control" placeholder=" Password" name="user_password" value="<?=$user1->user_password ?>" >
                                            </div>
                                            <div class="col-sm-6">
                                            <label>Confirm Password</label>
                                                    <input type="password" class="form-control" placeholder=" Password" name="user_password_confirm" value="<?=$user1->user_password ?>" >
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                    <label for="" class="col-form-label">Roles </label>
                                                    <select name="user_roleid" id="" class="form-control">
                                                        <option value=""> </option>
                                                        <?php
                                                        foreach($res_role as $item)

                                                        if($item->roleid ==$user1->user_roleid)   
                                                            echo "<option value='$item->roleid' selected='selected'>$item->rolename</option>";
                                                        else
                                                        echo"<option value='$item->roleid'> $item->rolename</option>";
                                                        ?>
                                                        
                                                    </select>
                                            </div>
                                        </div>

                                        
                                        <button type="submit" name="save" class="btn btn-primary">Register</button>
                                        
                                    
                                    </form>

                                </div>
                                
                            </div>








                            <?php

                            include_once "../../files/foot.php";

                            ?>
                            <style>
