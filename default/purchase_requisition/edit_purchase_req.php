<?php

    include_once "purchase_requisition.php";
    include_once "../supplier/supplier.php";
    include_once "../product/product.php";
    include_once "purchase_request_item.php";

    $supplier1 = new supplier();

    $sup=$supplier1->get_all_supplier();
    // print_r($sup);

     $product1 = new product();     
     $prod=$product1->getall_product2();

    //  print_r($prod);

     $product_item1 = new purchase_request_item();

 
// --------------------------------------------------------------------------------------------------------------------

$purchase1 = new purchaserequest(); 

if(isset($_GET['edit_pr'])){
    $purchase1= $purchase1->get_purchaserequest_by_id($_GET['edit_pr']);
    $purchase_req_item = $product_item1->get_all_product_by_pr_id($_GET['edit_pr']);
  
  
  //   print_r($purchase_req_item);
  }

  

    if(isset($_POST['save'])){

        $purchase1->purchaserequest_supplier=$_POST["purchaserequestsupplier"];
       

        $product_item1->insert_purchaserequest_item($_POST['req_id'] );

        $purchase1-> edit_purchaserequest($_POST['req_id']);
        // header("location:edit_purchase_req.php");
  

        $product_item1->edit_PR_item(); //edit item
    
    }else{
        
                        

        
    }




// ------------------------------------------------------------------------------------------------------------



 


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
                                    <h4>Edit Purchase Requisition</h4>

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
                                    <h5>Edit Purchase Requisition</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="edit_purchase_req.php" method="POST">




                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Supplier</label>
                                                <select class="js-example-basic-single col-sm-12" name="purchaserequestsupplier" id="purchreq_supplier">

                                                    <option value=" ">Select supplier</option>
                                                    <?php
                                                        foreach($sup as $item)
                                                      
                                                        if($item->supplier_id ==$purchase1->purchaserequest_supplier )   

			                                        echo "<option value='$item->supplier_id' selected='selected'>$item->supplier_name</option>";
                                                    else
                                                    echo"<option value='$item->supplier_id'>$item->supplier_name</option>";
                                                    ?>


                                                </select>

                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Reference Code</label>
                                                <input class="form-control" type="text" name="purchaserequest_ref" id="" value="<?=$purchase1->purchaserequest_ref ?>" readonly>

                                                <input class="form-control" type="text" name="req_id" id="" value="<?=$purchase1->purchaserequest_id ?>" readonly hidden>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="purchaserequestdate" id="" value="<?=$purchase1->purchaserequest_date ?>">
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12" name="pr_itemproductid" id="preq_itemproductid" > 

                                                    <option value="-1 ">Select product</option>
                                                    <?php
                                                 foreach($prod as $item)
      
                                                 if($item->product_id ==$product1->product_id)   
                                                        echo "<option value='$item->product_id' selected='selected'>$item->product_name</option>";
                                                  else
                                                    echo"<option value='$item->product_id'> $item->product_name</option>";
                                                    ?>


                                                </select>

                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Price</label>
                                                <input type="text" class="form-control" placeholder="" 
                                                name="pr_itemprice" id="preq_itemprice" onkeyup="cal_prd_total()" >
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control" placeholder=""
                                                name="pr_itemqty" id="preq_itemqty" onkeyup="cal_prd_total()" >
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control" placeholder=""
                                                name="pr_itemdiscount" Id="preq_itemdiscount" onkeyup="cal_prd_total()" >
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control" placeholder=""
                                                name="pr_itemfinalprice" id="preq_itemfinalprice" disabled>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                        <button class="btn btn-inverse">CLEAR</button>

                                        <br>
                                        <br>


                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">

                                                <?php if(isset($_GET['edit_pr'])):?>
                                                            <?php foreach($purchase_req_item as $item):  ?>
                                                        <tr>   
                                                        

                                                        <td></td>
                                                        <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                                                    <input class='form-control input-sm  '   type='hidden' name='Product[]' value='<?= $item->pr_item_productid ?>'>
                                                                    <input class='form-control input-sm  '   type='hidden' name='pr_item_id[]' value='<?= $item->pr_item_id ?>'>
                                                          
                                                                    </td>
                                  
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_price ?></span>
                                                                    <input class='input-borderless input-sm row_dataprice'   type='text' name='Price[]' value='<?= $item->pr_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                                                    </td>
                                                                    <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_qty ?></span>
                                                                <input class='input-borderless input-sm row_data quantity'   type='text'  name='Quantity[]' value='<?=$item->pr_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                            </td>

                                                                    <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_discount ?></span>
                                                                    <input class='input-borderless input-sm row_data discount'   type='text' name='Discount[]' value='<?= $item->pr_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>

                                                                    <td class='table-edit-view'><span class='tabledit-span'><?=$item->pr_item_finalprice ?></span>
                                                                    <input class='input-borderless input-sm row_data'   type='text' disabled="true" value='<?=$item->pr_item_finalprice ?>'>
                                                                    
                                                                    </td>


                                                                
                                                                
                                                                <td>
                                                                <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                                </td>
        
       
                                                                 
                                                        </tr>

                                                            <?php endforeach ;  ?>
                                                        <?php endif ;   ?>
                                             
                
                                                                                            </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>




                </div>



                <?php

include_once "../../files/foot.php";

?>

<script type="text/javascript" src="../javascript/editabletable.js"></script>
<script>



function cal_prd_total(){

   


    var pprice = $("#preq_itemprice").val();
    var pqty =$("#preq_itemqty").val();
    var pdis = $("#preq_itemdiscount").val(); 
   
    
   var tot = parseFloat(pprice)*parseFloat(pqty)*parseFloat(pdis)/100

    ftot =  parseFloat(pprice)*parseFloat(pqty) - parseFloat(tot)



    $("#preq_itemfinalprice").val(ftot);

 

    // console.log(pprice);
    // console.log(pqty);
    // console.log(pdis);

    // console.log(tot);

    // console.log(ftot);





}

// -------------------------------------------------------------------------------------------------------------------------

$("#add_prbtn").click(function(){

    add_products();
    clear_products();
   
});

// ---------------------------------------------------------------------------------------------------------------------
function add_products()
    {

       
   
        var pr_prod=$("#preq_itemproductid option:selected").val();
        var pr_prod_name=$("#preq_itemproductid option:selected").text(); //dropdown
        var p_price=$("#preq_itemprice").val();
        var p_qty=$("#preq_itemqty").val();
        var p_dis=$("#preq_itemdiscount").val();
        var p_tot= $("#preq_itemfinalprice").val();
        
        // var tcost=(parseFloat(cost)* parseFloat(wght)* parseFloat(qty)).toFixed(3); //total
       
        // var tprice=parseFloat(sprice)*parseFloat(wght)* parseFloat(qty);
        // tprice.toFixed(3);
        
        $("#tbody").append("<tr><td >"+1+"</td><td><input  class='form-control input-sm  ' type='hidden' name='pr_item_productid[]' value='"+pr_prod+"'> <span class='tabledit-span'>"+ pr_prod_name +" </span></td><td><input class='input-borderless input-sm row_data price'  type='text' readonly name='pr_item_price[]' value='"+p_price+"'>  </td><td><input class='input-borderless input-sm row_data quantity' type='text' readonly name='pr_item_qty[]' value='"+p_qty+"'> </td><td><input class='input-borderless input-sm row_data discount' type='text' readonly name='pr_item_discount[]' value='"+p_dis+"'></td> <td><input  class='input-borderless input-sm row_data total ' type='text' readonly name='pr_item_finalprice[]' value='"+p_tot+"'></td>      <td><span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span> <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span><span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span></td> </tr>");
         
 
         $(".btn_save").hide();
        $(".btn_cancel").hide();

    }

    // ----------------------------------------------------------------------------------------------------------------


    function clear_products()
    {

       
   
        $("#preq_itemproductid option:selected").text(""); //dropdown
       $("#preq_itemprice").val("");
      $("#preq_itemqty").val("");
        $("#preq_itemdiscount").val("");
        $("#preq_itemfinalprice").val("");
        
      


    }


    
    function edit_pr(edit_pr) {


window.location.href = "add_new_purchase_requisition.php?edit_pr=" + edit_pr;



}



// ========================================================================================================================


    //hide buttons
    // $(".btn_save").hide();
    //     $(".btn_cancel").hide();

    //     //click on the edit button, row becomes editable
    //     $(document).on('click', '.btn_edit', function(event) 
    //         {
               
          
    //             event.preventDefault();
    //             //get the closest row OR the particular row you chosen to edit
    //             var tbl_row = $(this).closest('tr'); 

    //             //show the save and cancel button

    //             tbl_row.find('.btn_save').show();
    //             tbl_row.find('.btn_cancel').show();

    //             //hide edit button
    //             tbl_row.find('.btn_edit').hide(); 
                
    //             //remove the text of the span
    //             //tbl_row.find(".tabledit-span").text("");
                

    //             //type hidden changes to type text to make it editable
    //             tbl_row.find('.row_data') //input cls
    //             .attr('type', 'text')
                
              

    //             //--->add the original entry data to attribute original_entry
    //             //--->applicable only to input tag
    //             tbl_row.find('.row_data').each(function(index, val) 
    //             {  
    //                 //this will help in case user decided to click on cancel button
    //                 $(this).attr('original_entry', $(this).val());
    //             }); 		
              
    //         });

    //         // --------------------------------------------------------------

       
    //     // once you edit the required fields ,save the changes  
    //     $(document).on('click', '.btn_save', function(event)  //save button
    //         {
               
    //             event.preventDefault();
    //             var tbl_row = $(this).closest('tr');

    //             tbl_row.find('.btn_save').hide();
    //             tbl_row.find('.btn_cancel').hide();

    //             //hide edit button
    //             tbl_row.find('.btn_edit').show(); 
    //             tbl_row.find('.row_data')
    //             //type text changes to type hidden
    //             .attr('type', 'hidden')
                
                

                
    //             tbl_row.find('.row_data').each(function(index,val) 
    //             {  
    //                  //changes made het assigned to the value attribute
    //                 //  $(this).attr('value', $(this).val());   
                    
    //                 $(this).attr('value', $(this).val());

                    
    //             }); 




    //             tbl_row.each(function() {
    //                 // Get input element.
    //                 var input = $(this).find('.row_data');
    //                 var data=input.val(); //its retrieving only the value of the first element that is y its replacing all the cells with same data
    //                 console.log(data);
    //                 // Set span text with input/select new value.
                  
    //                     $(this).find('.tabledit-span').text(input.val());
                   
    //             }); 



    // var arr = {}; 
	// tbl_row.find('.row_data').each(function(index, val) 
	// {   
	// 	var col_name = tbl_row.find('.tabledit-span').html();  
	// 	var col_val  =  $(this).val();
	// 	arr[col_val] = col_name;
    //     console.log(arr);
	// });

                
    //         });

            
           
    //     $(document).on('click', '.btn_cancel', function(event) 
    //     {
        

    //         var tbl_row = $(this).closest('tr');

            

    //         //hide save and cacel buttons
    //         tbl_row.find('.btn_save').hide();
    //         tbl_row.find('.btn_cancel').hide();

    //         //show edit button
    //         tbl_row.find('.btn_edit').show();
    //         tbl_row.find('.row_data')
                        
    //         .attr('type', 'hidden')
           


            
    //         tbl_row.find('.row_data').each(function(index, val) 
    //         {   
    //             $(this).val( $(this).attr('original_entry') ); 
    //         });  
    //     });
    //     //--->button > cancel > end

   





    //     $(document).on('click', '.btn_edit', function(event){
       
    //     var row=$(this).closest('tr');
    //     //validate only numbers for quantity
    //     row.find(".quantity").on("keypress",function(e)
    //     {
        
    //         var charCode = (e.which) ? e.which : event.keyCode    
            
    //         if(String.fromCharCode(charCode).match(/[^0-9]/g))
    //         {  
    //             row.find(".msg1").css("display", "inline"); 
    //             return false;  
    //         }else
    //         {row.find(".msg1").css("display", "none");}
    //         });
    //     //validate only numbers for price
    //     row.find(".price").on("keypress",function(e)
    //     {
               
    //         var charCode = (e.which) ? e.which : event.keyCode    
            
    //         if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
    //             row.find(".msg2").css("display", "inline"); 
    //             return false;  
    //         }else
    //         {row.find(".msg2").css("display", "none");}
        
    //     });
    //     //validate only numbers for discount
    //     row.find(".discount").on("keypress",function(e)
    //     {
        
    //         var charCode = (e.which) ? e.which : event.keyCode    
            
    //         if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
    //             row.find(".msg3").css("display", "inline"); 
    //             return false;  
    //         }else
    //         {row.find(".msg3").css("display", "none");}
    //      });



    //     });




</script>
