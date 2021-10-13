$(".error_fields").hide();
$(".itemalert").hide();

$("#add_prbtn").click(function()
{
    
    add_products();
    clear_products();
    cal_totquantity();
    cal_totprice();
    cal_totdiscount();
    final_total();
});

function invalidMessage(){
    console.log("invalidmessage");
    $(".itemalert").show();

}
$(".reset").click(function()
{
    clear_products();
});

// ................................function to append the products..............................
function add_products()
{
    if($("#sq_itemproductid").val()=='' || $("#sq_itemprice").val()==''|| $("#sq_itemqty").val()=='' ){
    // alert("Please fill all the fields");
     $(".error_fields").show().delay( 1000 ).fadeOut( 1000 );
 } else{


    var sq_prod=$("#sq_itemproductid option:selected").val();
    var sq_prod_name=$("#sq_itemproductid option:selected").text(); //dropdown
    var sq_price=$("#sq_itemprice").val();
    var sq_qty=$("#sq_itemqty").val();
    var sq_dis=$("#sq_itemdiscount").val();
    var sq_fprice=$("#sq_itemfinalprice").val();
    sq_subtotal=parseFloat(sq_price * sq_qty)
    console.log(sq_prod_name);
    
     $("#tbody").append("<tr>\
        <td class='table-edit-view' >"+sq_prod_name+"\
            <input  class='form-control input-sm productid'  type='hidden' name='sq_item_productid[]' value='"+sq_prod+"'>\
        </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data quantity' type='text' readonly name='sq_item_qty[]' value='"+sq_qty+"'> <div style='color: red; display: none' class='msg1'>'Digits only'</div>\
        </td>\
        <td class='table-edit-view'>\
        <select  id='productprice' class='input-borderless price' name='sq_item_price1[]'>\
        <option value='"+sq_price+"'>"+sq_price+"</option>\
        </select>\
            <input class='form-control input-sm subtotal'   type='hidden'  value='"+sq_subtotal+"'>\
        </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data discount' type='text' readonly name='sq_item_discount[]' value='"+sq_dis+"'><div style='color: red; display: none' class='msg3'>'Digits only'</div>\
        </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data total'   type='text' readonly value='"+sq_fprice+"'>\
        </td>\
        <td>\
            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
            <span class='btn_cancel'><button class='btn btn-mini btn-danger ' type='button'>Reset</button></span>\
            <span class='btn_delete'><button  class='btn btn-mini btn-danger btn_deleterow' type='button'>Delete</button></span>\
        </td>\
         </tr>");
     

     $(".btn_save").hide();
    $(".btn_cancel").hide();
    }
}

// function to clear the products

function clear_products()
{

    $("#sq_itemprice").val("");
    $("#sq_itemqty").val("");
    $("#sq_itemdiscount").val("");
    $("#sq_itemfinalprice").val("");
}


//     $(document).on('click', '.deletedata1', function(event) {
//     var tbl_row = $(this).closest('tr');
//     console.log ("deletedata");

//     var deleteitemid= tbl_row.find(".productid").val();
//     console.log (deleteitemid);

//     var confirm_msg=confirm("Are you sure you want delete the item?");
//         if(confirm_msg==true){
//             //ajax request
//             $.ajax({
//                 url:'../sales_quotation/handle_sqdelete.php',
//                 type:'POST',
//                 data:{id:deleteitemid},
//                 success:function(response){
//                     if(response==true){
//                         console.log('Item deleted successfully');
//                         tbl_row.css('background','tomato');
//                         tbl_row.fadeOut(800,function(){
//                             tbl_row.remove();
//                             cal_totquantity();
//                             cal_totprice();
//                             cal_totdiscount();
//                             final_total();
//                         });
//                     }else{
//                         console.log('Invalid ID.');
//                     }
//                 }
                 
//             });
//         }
   

// });