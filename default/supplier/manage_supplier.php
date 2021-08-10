<?php

include_once "supplier.php";
include_once "../supplier_group/supplier_group.php";
//code to display supplier group in a drop down................................
    $supplier_grp = new supplier_group();
    $result_sup_grp = $supplier_grp->get_all_supplier_group();

    $supplier1 = new supplier();

//insert a new supplier.........................................................
if (isset($_POST["supcode"]))
{
    $supplier1->supplier_code =$_POST["supcode"];
    $supplier1->supplier_name =$_POST["supname"];
    $supplier1->supplier_group=$_POST["supgroup"];
    // $supplier1->supplier_add=$_POST["supadd"];
    $supplier1->supplier_contactno= $_POST["supno"];
    $supplier1->supplier_email= $_POST["supemail"];
    //....................................................
    if(isset($_POST["edit_sup"]))
    {
            $res_edit=$supplier1->edit_supplier ($_POST["edit_sup"]);
            //code for insert validation
            if($res_edit==true){
               
                header("location:../supplier/manage_supplier.php?success_edit=1");
            }elseif($res_edit==false){
                header("location:../supplier/manage_supplier.php?notsuccess=1");
            }
    }else
    {
            $res_insert=$supplier1->insert_suppier();  
            //code for insert validation
            if($res_insert==true){
                
                header("location:../supplier/manage_supplier.php?success=1");
            }elseif($res_insert==false){
                header("location:../supplier/manage_supplier.php?notsuccess=1");
            }
    }


}


 // get supplier details in to a datatable..............................................
    $result_supplier = $supplier1->get_all_supplier();

// view supplier details for editing....................................................
    if(isset($_GET['edit_sup'])){
        $supplier1=$supplier1->get_supplier_by_id($_GET['edit_sup']);

    }

//delete a supplier...................................................................
$msg_2="";//alert message for delete
    if(isset($_GET['d_id'])){
        $res_del=$supplier1->delete_supplier ($_GET['d_id']);
        //code for delete validations
        if($res_del==true){
                
            header("location:../supplier/manage_supplier.php?delete_success=1");
        }else{
        
            $msg_2="Supllier already exists therefore cannot delete";
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
                                    <h4>Manage Supplier </h4>

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
                                    <h5>Add New Supplier </h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                          
                                        </ul>
                                    </div>
                                </div>
 
                                <div class="card-block">

                                    <form action="manage_supplier.php" method="POST"> 

                                    <?php
                                   
                                   if(isset($_GET["edit_sup"])){
                                    echo"  <input type='text'  class='form-control' value='".$_GET['edit_sup'] ."' name='edit_sup' required readonly>";
                                   }
                                    

                                   ?>


                                        <div class="form-group row">




                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Supplier  Code</label>
                                                <input type="text" class="form-control" placeholder="" name="supcode" id="sup_code" pattern="^[A-Z0-9]*$" onkeyup="check_supplier_code()" onblur="check_supplier_code()"
                                                value="<?=$supplier1->supplier_code ?>" <?php if($supplier1->supplier_code){echo "readonly=\"readonly\"";} ?> required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Supplier Group </label>
                                                <select name="supgroup" class="form-control" id="sup_group" required >
                                                <option value=" ">Select Supplier Group</option>
                                                   <?php
                                                        foreach($result_sup_grp as $item)
                                                      
                                                        if($item->suppliergroup_id==$supplier1->supplier_group->suppliergroup_id)  
                                                         
			                                        echo "<option value='$item->suppliergroup_id' selected='selected'>$item->suppliergroup_name</option>";
                                                    else
                                                    echo"<option value='$item->suppliergroup_id'>$item->suppliergroup_name</option>";
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label class=" col-form-label"> Name</label>
                                                <input type="text" class="form-control" placeholder="" name="supname" id="sup_name"
                                                value="<?=$supplier1->supplier_name ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label"> E-mail</label>
                                                <input type="email" class="form-control" placeholder="" name="supemail" id="sup_email" onkeyup="check_supplier_mail()" onblur="check_supplier_mail()"
                                                 value="<?=$supplier1->supplier_email ?>" required >
                                                 <div class="col-form-label" id="mailcheck_msg" style="display:none;">Sorry, that e-mail is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Contact No </label>
                                                <input type="text" class="form-control" pattern="[0-9]{10}" placeholder="" name="supno" id="sup_no" onkeyup="check_supplier_contact()"  onblur="check_supplier_contact()"
                                                value="<?=$supplier1->supplier_contactno ?>" required>
                                                <div class="col-form-label" id="contactcheck_msg" style="display:none;">Sorry, that contact number is taken. Try
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
                                <strong>New location added successfully</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['success_edit'])) {
                                echo"<div class='alert alert-info background-info'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>Location details updated successfully</strong> 
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
                                <strong>The code or the e-mail already exists.Please try again</strong> 
                            </div>";
                            }
                            ?>
                        <!-- //ALERT MESSAGES END................... -->
                                                <!-- Autofill table start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Supplier List</h5>
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
                                                                        <th>Code </th>
                                                                        <th>Group </th>
                                                                        <th> Name</th>
                                                                        <th>E-mail </th>
                                                                        <th> Contact No</th>
                                                                        <th>Action</th>
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                
<?php
           foreach($result_supplier as $item){
            echo"
            <tr>
                <td>$item->supplier_id </td>
                <td>$item->supplier_code </td>
                <td>$item->supplier_group </td>
                <td>$item->supplier_name  </td>
                <td>$item->supplier_email </td>
                <td>$item->supplier_contactno </td>
           
             

                <td><div class='btn-group btn-group-sm' style='float: none;'>
                <button type='button' onclick='edit_sup($item->supplier_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                <button type='button'  onclick='delete_sup($item->supplier_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
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



<!-- --------------------------------------------------------------------------------------------------------------------- -->
<script type="text/javascript" src="../javascript/supplier.js"></script>

<script>
   $( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );

function edit_sup(edit_sup) {


    window.location.href = "manage_supplier.php?edit_sup=" + edit_sup;


}


function delete_sup(deleteid) {

    if (confirm("Do you want to delete id" + " " + deleteid)) {
        window.location.href = "manage_supplier.php?d_id=" + deleteid;
    }

}
</script>