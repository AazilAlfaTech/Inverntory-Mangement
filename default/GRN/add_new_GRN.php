<?php

    include_once "GRN.php";
    include_once "grn_item.php";
    include_once "../purchase_order/purchaseorder.php";
    include_once "../location/location.php";

    $po1=new purchaseorder();
    $result_po=$po1->get_all_purchaseorder();
    // $result_po2=$po1-> get_purch_byid($_GET["view"]);
    
    $grn1=new grn();
    // $result_grn1=$grn1-> get_purchsup_by_prid($_GET["view"]);
    // $result_grn2=$grn1-> get_all_grn_by_poid($_GET["view"]);
    $grn_item1=new grn_item();

    if(isset($_GET["view"]))
    {
        $result_po2=$po1-> get_purchaseorder_by_id($_GET["view"]);
        $result_grn1=$grn1-> get_purchsup_by_prid($_GET["view"]);
        $result_grn2=$grn1-> get_all_grn_by_poid($_GET["view"]);
    }

    $location1=new location();
    $result_location1=$location1->get_all_location();

    // insert grn details
    if(isset($_POST["grnpurchorderid"]))
    {
        $grn1->grn_puch_order_id=$_POST["grnpurchorderid"];
        $grn1->grn_received_loc=$_POST["grnrecievedloc"];
        $grn1->grn_date=$_POST["grndate"];
        $grn1->grn_ref_no=$grn1->grn_code($_POST["grndate"]);

        $result_grn1=$grn1->insert_grn();
        $grn_item1->insert_grnitem($result_grn1);
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
                                    <h4>Add New GRN</h4>

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
                                    <h5>Add New GRN</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Reference No</th>
                                                    <th>Date </th>
                                                    <th>Supplier</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                        foreach ($result_po as $item)
                                                        {
                                                            echo
                                                            "<tr>
                                                           
                                                                <td>$item->purchaseorder_ref</td>
                                                                <td>$item->purchaseorder_date</td>
                                                                <td>$item->purchaseorder_status</td>

                                                                <td> 
                                                                    <button type='button' class='btn btn-primary btnadd' onclick='po_details($item->purchaseorder_id)'><i class='fa fa-check-square'></i></button>&nbsp;&nbsp; <button type='button' class='btn btn-danger btndel' onclick=''><i class='fa fa-times-circle'></i></button>

                                                                </td>
                                                            </tr> ";
                                                        }
                                                    ?>
                                                

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block">

                                    <form method="POST" action="add_new_GRN.php">
                                       
                                        <div class='form-group row'>
                                            <?php
                                                if(isset($_GET['view']))
                                                {
                                                    echo"
                                                    <input type='hidden' class='form-control' value='".$_GET['view']."' name='grnpurchorderid' required>
                          

                                                    <div class='col-sm-6'>
                                                        <label class='col-form-label' >PO ref no</label>
                                                        <input class='form-control' id='po' type='text' name='purch_order' disabled='true' value='$result_po2->purchaseorder_ref'>
                                                    </div>

                                                    <div class='col-sm-6'>
                                                        <label class='col-form-label' >Supplier</label>
                                                        <input class='form-control' id='po_supp' type='text' disabled='true' value='$result_grn1->purchaserequest_suppname'>
                                                    </div>
                                       
                                                ";
                                                }
                                            ?>
                                        </div>         
                                        <div class='form-group row'>

                                            <div class='col-sm-6'>
                                                <label class='col-form-label'> GRN Date</label>
                                                <input class='form-control' type='date' name='grndate' value="<?php echo date('Y-m-d');?>">
                                            </div>
                                            <div class='col-sm-6'>
                                                <label class='col-form-label' name='grnrecievedloc'>Received gto location</label>
                                                <select class='js-example-basic-single col-sm-12' name='grnrecievedloc'>
                                                   <?php 
                                                    foreach($result_location1 as $item)
                                                    
                                                        echo"<option value='$item->location_id'>$item->location_name</option>";
                                                    
                                                    ?>
                                                </select>

                                            </div>

                                        </div>
                                    

                                
                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                        <div class="table-responsive">
                                        <table  id="example-1">
                                                    <table class="table table-striped table-bordered" id="mytable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product Name</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Discount</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="po_table">
                                                            <?php if(isset($_GET['view'])):?>
                                                                <?php   foreach($result_grn2 as $item):?>
    
                                                                    <tr>
                                                                        <td scope='row'>1</td>
                                                                        <td class='table-edit-view'><span class=''><?=$item->purchaseorder_itemname?></span>
                                                                            <input class='form-control input-sm' type='hidden' name='grn_itemid[]' value='<?=$item->purchaseorder_itemid?>'>
                                                                        </td>
                                                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_itemprice?></span>
                                                                            <input class='form-control input-sm row_data price' type='hidden' name='grn_itemprice[]' value='<?=$item->purchaseorder_itemprice?>'>
                                                                        </td>
                                                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_qty?></span>
                                                                            <input class='form-control input-sm row_data quantity' type='hidden' name='grn_item_qty[]' value='<?=$item->purchaseorder_qty?>'>
                                                                        </td>
                                                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_itemdiscount?></span>
                                                                        <input class='form-control input-sm row_data discount' type='hidden' name='grn_item_discount[]' value='<?=$item->purchaseorder_itemdiscount?>'>
                                                                         </td>
                                                                         <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_itemfinalprice?></span>
                                                                            <input class='form-control input-sm row_data finalprice' type='hidden' disabled="true" name='grn_item_finalprice[]' value='<?=$item->purchaseorder_itemfinalprice?>'>
                                                                        </td>

                                                                        <td>
                                                                            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                            <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                                        </td>

        
                                                                    </tr>
                                                    
                                                                <?php endforeach ;?>
                                                            <?php endif ;?>        
                                                        </tbody>
                                                        
                                                    </table>
                                                </div>





                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                </div>

                            </div>
                        </div>
                    </div>





           


                </div>






                <?php

include_once "../../files/foot.php";

?>


<script>
     function po_details(po)
    {
        window.location.href="add_new_GRN.php?view="+po;
    }
</script>
<script>

var tbl_row = $(this).closest('tr');
        //hide buttons
        $(".btn_save").hide();
        $(".btn_cancel").hide();
   
        $(document).on('click', '.btn_edit', function(event) 
            {
                console.log("hi");
                event.preventDefault();
                var tbl_row = $(this).closest('tr');

                

                tbl_row.find('.btn_save').show();
                tbl_row.find('.btn_cancel').show();

                //hide edit button
                tbl_row.find('.btn_edit').hide(); 
                // tbl_row.find('tabledit-span').hide();
                
                tbl_row.find(".tabledit-span").text("");
                

                //make the whole row editable
                tbl_row.find('.row_data')
                .attr('type', 'text')
               
                // checknum();
            });


            // when save button is clicked
            
$(document).on('click', '.btn_save', function(event) 
            {
                console.log("hello");
                event.preventDefault();
                var tbl_row = $(this).closest('tr');

                tbl_row.find('.btn_save').hide();
                tbl_row.find('.btn_cancel').hide();

                //hide edit button
                tbl_row.find('.btn_edit').show(); 
                tbl_row.find('.row_data')
                
                .attr('type', 'hidden')



              
                 tbl_row.find('.row_data').each(function(index,val) 
                {  
                    
                    $(this).attr('value', $(this).val());
                  arr=[$(this).val()];
                  console.log(arr);
                  tbl_row.find(".tabledit-span").text(arr);

                });  

                //   tbl_row.find('.row_data').each(function (i, v) {
                //        // var valArr = ['Now!', 'This', 'is', 'placed', 'better'];
                //        tbl_row.find(".tabledit-span").text(arr[i]);
                //         });
                    // tbl_row.find('span.tabledit-span').replaceWith(function(){
                    //     var val1= tbl_row.find('.row_data').value;
                    //     console.log(val1);
                    // });
                    
                //    tbl_row.find(".tabledit-span").each(function(i,v){
                //        var arr2=[ tbl_row.find('.row_data').val()];
                //        console.log(arr2);
                //     // tbl_row.find('.tabledit-span').text(tbl_row.find('.row_data').val());
                //     // var w =tbl_row.find('.tabledit-span').text();
                //     // console.log(w);
                // });
                
                  
                    

               
            });

            // function cellvalue(){
            //         var table = document.getElementById('mytable'), 
            //                     rows = table.getElementsByTagName('tr'),
            //                     i, j, cells, customerId;

            //                 for (i = 0, j = rows.length; i < j; ++i) {
            //                     cells = rows[i].getElementsByTagName('input');
            //                     if (!cells.length) {
            //                         continue;
            //                     }
            //                     customerId = cells[0].value;
            //                     console.log(customerId);
            //                     var tbl_row = $(this).closest('tr');

            //                     tbl_row.find('.tabledit-span').text(customerId);
            //                 }
            //     }

                
                $(document).on('click', '.btn_cancel', function(event) 
                {
                    console.log("shahee");
                    event.preventDefault();

                    var tbl_row = $(this).closest('tr');

                    //var row_id = tbl_row.attr('row_id');

                    //hide save and cacel buttons
                    tbl_row.find('.btn_save').hide();
                    tbl_row.find('.btn_cancel').hide();

                    //show edit button
                    tbl_row.find('.btn_edit').show();

                    
                    tbl_row.find('.row_data').each(function(index, val) 
                    {   
                        $(this).html( $(this).attr('original_entry') ); 
                    });  
                });
                //--->button > cancel > end

                // Calculating the total when qty,price or discount chaanges.
                $(document).on('click', '.btn_edit', function(event)
                {
                    console.log("totalvalidation");
                    event.preventDefault();

                    var tbl_row=$(this).closest('tr');
                    tbl_row.find('.btn_save').on("click", function(e)
                    {
                        console.log("sumi");
                        var pprice = tbl_row.find(".price").val();
                        var pqty = tbl_row.find(".quantity").val();
                        var pdis = tbl_row.find(".discount").val();
                        console.log(pprice);
                        console.log(pqty);
                        console.log(pdis);
                        // var pqty =$(".quantity").val();
                        // var pdis = $(".discount").val(); 
                        var dis_amount = parseFloat(pprice)*parseFloat(pqty)*parseFloat(pdis)/100
                        console.log(dis_amount);
                        ftot =  parseFloat(pprice)*parseFloat(pqty) - parseFloat(dis_amount)
                        console.log(ftot);
                        tbl_row.find(".finalprice").val(ftot);

                        // tbl_row.find('.tabledit-span').each(function(index,val)
                        // {
                        //     console.log("Su");
                        //      tbl_row.find(".tabledit-span").text("");
                        //     // console.log();
                        // });

                    });
                });
</script>