<?php

include_once "group.php";
$group1=new group();//create a new object 

//code to insert and update data............................................................... 

if(isset($_POST["groupcode"]))
{
    $group1->group_code=$_POST["groupcode"];
    $group1->group_name=$_POST["groupname"];
    //.....................................................
    if(isset($_POST['groupid']))
    {
        $res_edit=$group1->edit_group($_POST['groupid']);
            //code for edit valaidation
            if($res_edit==true){
                "EDITING DONE";
                header("location:../group/manageproductgroup.php?success_edit=1");
            }elseif($res_edit==false){
                echo "FALSE";
                header("location:../group/manageproductgroup.php?notsuccess=1");
            }
    }else
    {
        $res_insert=$group1->insert_group2();
            //code for insert alert validations
                if($res_insert==true){
                    echo "insert done";
                    header("location:../group/manageproductgroup.php?success=1");
                }elseif($res_insert==false){
                    echo"false";
                    header("location:../group/manageproductgroup.php?notsuccess=1");
                }

    }

}

//code to view group................................................................
if(isset($_GET['view'])){
    $group1=$group1->get_group_by_id($_GET['view']);
}
//code to delete group..................................................................................

$msg_2="";//alert message for delete

if(isset($_GET['delete_g'])){
    $res_del=$group1->delete_group($_GET['delete_g']);
    //code for delete validations
    if($res_del==true){
        header("location:../group/manageproductgroup.php?delete_success=1");
       
    }else{
       
        $msg_2="Group already exists therefore cannot delete";
    }
}
//code to get group details  into datatable........................................................................
$result_group=$group1->get_all_group();


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
                                    <h4>Manage Product Group</h4>

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
                                    <h5>Add New Product Group</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manageproductgroup.php" method="POST" id="submitgroup">



                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Group Code</label>

                                                <input type="text" name="groupcode" pattern="^[A-Z0-9]*$" class="form-control" id="gr_code" onkeyup="check_groupcode()" onblur="check_groupcode()"value="<?=$group1->group_code?>"<?php if($group1->group_code){echo "readonly=\"readonly\"";} ?> placeholder="" required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <?php
                                   
                                   if(isset($_GET["view"])){
                                    echo"  <input type='hidden'  class='form-control' value='".$_GET['view'] ."' name='groupid' required>";
                                   }

                                    

                                   ?>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Group Name</label>
                                                <input type="text" name="groupname" class="form-control" id="gr_name" value="<?=$group1->group_name ?>" onblur="check_groupname()"  placeholder="" required>
                                                <div class="col-form-label" id="namecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                                
                                            </div>
                                            
                                        </div>

                                        <button type="submit"  class="btn btn-primary">ADD</button>
                                        <button type="reset" class="btn btn-inverse">CLEAR</button>
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
                <strong>New group added successfully</strong> 
            </div>";
            }
            ?>
            <?php
            if(isset($_GET['success_edit'])) {
                echo"<div class='alert alert-info background-info'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='icofont icofont-close-line-circled text-white'></i>
                </button>
                <strong>Group details updated successfully</strong> 
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
            if(isset($_GET['delete_g'])) {
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
              <!-- //ALERT MESSAGES END................... -->
            <!-- Autofill table start -->
            <div class="card">
                <div class="card-header">
                    <h5>Product List</h5>
                    <span></span>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-plus minimize-card"></i></li>
                        
                        </ul>
                    </div>
                </div>
                <div class="card-block"  style="display: none;">
                    <div class="dt-responsive table-responsive">

                        <table id="autofill" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Group Code</th>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($result_group as $item)
                                    {echo"
                                        <tr>
                                            <td id='gr_id_td'>$item->group_id</td>
                                            <td>$item->group_code</td>
                                            <td>$item->group_name</td>

                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                            <button type='button' id='$item->group_id'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                               <button type='button'  onclick='del_group($item->group_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group_name'></span></button>
                                               
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
<script type="text/javascript" src="../javascript/masterfile.js"></script>


<script>
  

    function del_group(del_id){
        console.log("hi");
        console.log(del_id);
        if(confirm("Do you want to delete id"+""+del_id))
      { window.location.href="../group/manageproductgroup.php?delete_g="+del_id;
     }

    }

    
$( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );

    
</script>
