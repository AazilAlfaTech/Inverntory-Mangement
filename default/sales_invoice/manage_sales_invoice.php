<?php


include_once "../sales_invoice/sales_invoice.php";

    $sales_invoice1 = new sales_invoice();

    $result_sales_invoice = $sales_invoice1->get_all_sales_invoice();

    include_once "../payment/payment.php";
    $pay=new payment();
    
    if (isset($_POST["paymethod"])) {
        $pay->pay_method=$_POST["paymethod"];
        $pay->pay_dt=$_POST["sinvdate"];
        $pay->pay_amount=$_POST["payamount"];
        $pay->creditcard_cardnum=$_POST['creditcardno'];
        $pay->cheque_num=$_POST['chequeno'];
        // $paymentid=$pay->insert_payment($_POST['invoicenumber']);//insert payment details to payment table
        // $sales_invoice1->update_paidamount($_POST["payamount"], $_POST['invoicenumber']);//update paid amount in sales invoice table

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
                                    <h4>Manage Sales Invoice</h4>

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
                    <a href="add_new_salesinvoice.php">
                    <button class="btn btn-mat btn-primary ">Add New Sales Invoice</i></button>
                    </a>
                </div>


                <br>
                <br>

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
                                    <strong>New sales invoice added successfully</strong> 
                                </div>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['success_edit'])) {
                                    echo"<div class='alert alert-info background-info'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>sales invoice  updated successfully</strong> 
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
                                    <h5>Sales Invoice</h5>
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
                                                    
                                                    <th>Reference No</th>
                                                    <th>Date </th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Paid</th>
                                                    <th>Balance</th>
                                                    <th>PaymentStatus</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                 foreach($result_sales_invoice as $item){

                                                            if($item->salesinvoice_currentstatus=='PENDING'){
                                                                echo"
                                                                <tr>
                                                                    
                                                                    <td>$item->salesinvoice_ref  </td>
                                                                    <td>$item->salesinvoice_date </td>
                                                                    <td>$item->salesinvoice_customer_name </td>
                                                                    <td><label class='badge st$item->salesinvoice_currentstatus'>$item->salesinvoice_currentstatus</label></td>
                                                                    <td class='text-right'>$item->salesinvoice_total</td>
                                                                    <td class='text-right'>$item->salesinvoice_amountpaid</td>
                                                                    <td class='text-right'>". number_format((float)$item->salesinvoice_balance, 2, '.', '')."</td>
                                                                    <td ><label class='badge st$item->salesinvoice_paystatus'>$item->salesinvoice_paystatus</label></td>

                                                                                                                                                             
                                                                    <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                    <button type='button' id='edit_pr' onclick='view_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                                                                    <button type='button' onclick='edit_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit''></span></button> </a>
                                                                    ";
                                                                    if($item->salesinvoice_paystatus!='PAID')
                                                                    echo"
                                                                    <button type='button' class='btn btn-mini btn-default waves-effect' onclick='getinvoiceid($item->salesinvoice_id,\"$item->salesinvoice_ref \",\"$item->salesinvoice_paymethod\")' data-toggle='modal' data-target='#default-Modal'>Payment</button>
                                                                    </td> 
                                           
                                           
                                                                   
                                                                   
                                                                </tr>
                                                                ";

                                                            }else if($item->salesinvoice_currentstatus=='COMPLETE'){
                                                                echo"
                                                                <tr>
                                                                    
                                                                    <td>$item->salesinvoice_ref  </td>
                                                                    <td>$item->salesinvoice_date </td>
                                                                    <td>$item->salesinvoice_customer_name </td>
                                                                    <td><label class='badge st$item->salesinvoice_currentstatus'>$item->salesinvoice_currentstatus</label></td>
                                                                    <td class='text-right'>$item->salesinvoice_total</td>
                                                                    <td class='text-right'>$item->salesinvoice_amountpaid</td>
                                                                    <td class='text-right'>". number_format((float)$item->salesinvoice_balance, 2, '.', '')."</td>
                                                                    <td ><label class='badge st$item->salesinvoice_paystatus'>$item->salesinvoice_paystatus</label></td>

                                                                                                                                                             
                                                                    <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                    <button type='button' id='edit_pr' onclick='view_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                                                                   
                                                                    <button type='button'  onclick='delete_si($item->salesinvoice_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o'></span></button>
                                                                    
                                                                    ";
                                                                    if($item->salesinvoice_paystatus!='PAID')
                                                                    echo"
                                                                    <button type='button' class='btn btn-mini btn-default waves-effect' onclick='getinvoiceid($item->salesinvoice_id,\"$item->salesinvoice_ref \",\"$item->salesinvoice_paymethod\")' data-toggle='modal' data-target='#default-Modal'>Payment</button>
                                                                    </td> 
                                           
                                           
                                                                   
                                                                   
                                                                </tr>
                                                                ";

                                                            }else

                                                                    echo"
                                                                    <tr>
                                                                        
                                                                        <td>$item->salesinvoice_ref  </td>
                                                                        <td>$item->salesinvoice_date </td>
                                                                        <td>$item->salesinvoice_customer_name </td>
                                                                        <td><label class='badge st$item->salesinvoice_currentstatus'>$item->salesinvoice_currentstatus</label></td>
                                                                        <td class='text-right'>$item->salesinvoice_total</td>
                                                                        <td class='text-right'>$item->salesinvoice_amountpaid</td>
                                                                        <td class='text-right'>". number_format((float)$item->salesinvoice_balance, 2, '.', '')."</td>
                                                                        <td ><label class='badge st$item->salesinvoice_paystatus'>$item->salesinvoice_paystatus</label></td>

                                                                                                                                                                 
                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' id='edit_pr' onclick='view_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                                                                        <button type='button' onclick='edit_si($item->salesinvoice_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit''></span></button> </a>
                                                                        <button type='button'  onclick='delete_si($item->salesinvoice_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o'></span></button>
                                                                     
                                                                        ";
                                                                        if($item->salesinvoice_paystatus!='PAID')
                                                                        echo"
                                                                        <button type='button' class='btn btn-mini btn-default waves-effect' onclick='getinvoiceid($item->salesinvoice_id,\"$item->salesinvoice_ref \",\"$item->salesinvoice_paymethod\")' data-toggle='modal' data-target='#default-Modal'>Payment</button>
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

                        <!-- modal -->
                        <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add payment</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../sales_invoice/manage_sales_invoice.php"  method="POST">


                                                        <div class="row">
                                                            <div class="col-sm-6">

                                                                <label class=" col-form-label">Date</label>
                                                                <input type="date" class="form-control form-control-sm" name="sinvdate" placeholder=""  id="txtDate" value="<?php echo date('Y-m-d'); ?>" required>

                                                            </div>
                                                           <div class="col-sm-6">
                                                                <label class=" col-form-label">Reference No</label>
                                                                <input type="text" class="form-control form-control-sm" placeholder=""  id="invoice_ref" value="" readonly>

                                                            </div>


                                                        </div>
                                                        <input type="hidden" class="form-control form-control-sm" placeholder="" name="invoicenumber"  id="invoice_no" value="" >

                                                        <hr>
                                                        <div class="card-block">
                                                            <div class="form-group row ">
                                                                <div class="col-sm-4">
                                                                    <label class=" col-form-label">Payment Type</label>
                                                                    <input type="text" class="form-control form-control-sm" id="invoice_paymethod" readonly>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class=" col-form-label">Amount</label>
                                                                    <input type="text" class="form-control form-control-sm" name="payamount" id="pay_amount" onkeyup="getBalance()" required>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class=" col-form-label">Payment Method</label>
                                                                    <select class="form-control form-control-sm paymethod" name="paymethod" required>
                                                                    <option value="">Select Method</option>
                                                                    <option value="cash">Cash </option>
                                                                    <option value="credit">Credit </option>
                                                                    <option value="cheque">Cheque</option>
                                                                </select>
                                                                </div>

                                                            </div>
                                                            

                                                        </div>
                                                        <div class="card-block creditcard border border-primary">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label class=" col-form-label">Card Number</label>
                                                                    <input type="text" class="form-control form-control-sm" name="creditcardno">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class=" col-form-label">Card Holders Name</label>
                                                                    <input type="text" class="form-control form-control-sm">
                                                                </div>

                                                            </div>
                                                            <div class="form-group  row">
                                                                <div class="col-sm-3">
                                                                    <label class=" col-form-label">Card Type</label>
                                                                    <select name="" id="" class="form-control form-control-sm"></select>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class=" col-form-label">Month</label>
                                                                    <input type="text" class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class=" col-form-label">Year</label>
                                                                    <input type="text" class="form-control form-control-sm">

                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class=" col-form-label">Code</label>
                                                                    <input type="text" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                        

                                                        </div>
                                                        <div class="card-block cheque border border-primary">
                                                            <label class=" col-form-label">Cheque No.</label>
                                                            <input type="text" class="form-control form-control-sm" name="chequeno">
                                                        </div>

                                                        <hr>
                                                        <div class="d-flex flex-row-reverse">
                                                            <div style="float:right;" >
                                                                <strong>Balance:</strong>&nbsp;
                                                                <span>Rs.</span>&nbsp;
                                                                <span id="bal_amount">0.00</span>
                                                            </div>
                                                    


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Add payment</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>


<?php

include_once "../../files/foot.php";

?>
<!-- ---------------------------------------------------------------------------------------------------------- -->
<script type="text/javascript" src="../javascript/sales.js "></script>
<script type="text/javascript" src="../javascript/sales/payment.js "></script>
<script>
function edit_si(edit_si) 
    {
        window.location.href = "edit_sales_invoice.php?edit_si=" + edit_si;
    }

    function view_si(view_si)
    {
        window.location.href = "view_sales_invoice.php?view_si=" + view_si;
    }

    function delete_si(deleteid) 
    {
        if (confirm("Do you want to delete id" + " " + deleteid)) 
        {
            window.location.href = "manage_sales_invoice.php?d_id=" + deleteid;
        }

    }


    function getinvoiceid(invoiceid,invoiceref,paymethod){
        $("#invoice_ref").val(invoiceref);
        $("#invoice_no").val(invoiceid);
        $('#invoice_paymethod').val(paymethod);


    }
    </script>