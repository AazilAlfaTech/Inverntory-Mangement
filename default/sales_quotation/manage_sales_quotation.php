<?php

include_once "sales_quatation.php";
$sales_quot1=new sales_quotation();
$result_sales=$sales_quot1->get_all_sales_quotation();

if(isset($_GET['d_id']))
{
    $res_delete=$sales_quot1->delete_sales_quotation($_GET['d_id']);
    
    //code for delete validations
    if($res_delete==true){
        header("location:../sales_quotation/manage_sales_quotation.php?delete_success=1");
       
    }
    else
    {
       
        $msg_2="Sales order already in use therefore cannot delete";
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
                                    <h4>Manage Sales Quotation</h4>

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

                <div class="d-flex flex-row-reverse">
<a href="add_new_sales_quotation.php">
                    <button class="btn btn-mat btn-primary ">Add sales Quotation</i></button>
</a>
                </div>


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
                                    <h5>Sales Quotation</h5>
                                    <span></span>
                                    <div class="card-header-right" >
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
                                                    <th>Reference No</th>-
                                                    <th>Date </th>
                                                    <th>Customer</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        foreach ($result_sales as $item)
                                                        {
                                                            echo
                                                            "<tr>
                                                           
                                                                <td>$item->salesquot_ref</td>
                                                                <td>$item->salesquot_date</td>
                                                                <td>".$item->salesquot_customer->customer_name."</td>

                                                                <td>
                                                                    <div class='btn-group btn-group-sm' style='float: none;'>
                                                                    <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='icofont icofont-eye-alt'></i></span></button>
                                                                        <button type='button' onclick='edit_sq($item->salesquot_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                                        <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group_name'></span></button>
                                               
                                                                    </div>
                                                                </td>
                                                            </tr> ";
                                                        }
                                                    ?>
                                        

                                            </tbody>

                                                <tr>
                               
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
<?php
    include_once "../../files/foot.php";
?>

<script>

    $(".alert").fadeIn(300).delay(3500).fadeOut(400);

    function edit_sq(edit_sq) 
    {
        window.location.href = "edit_sales_quotation.php?edit_sq=" + edit_sq;
    }

    function view_sq(view_sq)
    {
        window.location.href = "view_sales_quotation.php?view_sq=" + view_sq;
    }

    function delete_sq(deleteid) 
    {
        if (confirm("Do you want to delete id" + " " + deleteid)) 
        {
            window.location.href = "manage_sales_quotation.php?d_id=" + deleteid;
        }

    }
</script>