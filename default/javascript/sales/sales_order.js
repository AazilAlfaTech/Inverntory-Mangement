
function edit_purchorder(SQ_id)
{
    window.location.href="add_new_sales_order.php?view="+SQ_id;
}

// $(".productform").on("keyup", ".quantitytext, .pricetext, .discounttext", function() {
//         console.log("hhiii");
//         var row = $(this).closest(" ");
       
//         var quants = row.find(".quantity").val();
//         var prc = row.find(".pricetext").val();
//        // var tot = quants * prc;
//        var disc= row.find(".discounttext").val();
//                     var subtot= parseFloat(quants * prc * disc/100);
//                     var tot = parseFloat(quants * prc - subtot);
//                     console.log(tot);
//         row.find(".totaltext").attr("value",tot);
//     });

//add rows into sales order item table

$(".add").click(function(){
console.log("addrows");
addrows();
clearrows();
cal_totquantity();
cal_totprice();
cal_totdiscount();
final_total();
});

$(".reset").click(function(){
clearrows();
});

function addrows(){

//getvalues
productid=$("#soitem_productid option:selected").val();
productname=$("#soitem_productid option:selected").text();
productprice=$("#soitem_price").val();
productquantity=$("#soitem_qty").val();
productdiscount=$("#soitem_discount").val();
producttotal=$("#sofinal_price").val();
productsubtotal=parseFloat(productprice*productquantity);
console.log(productid);


$(".itembody").append("<tr>\
    <td class='table-edit-view'>"+productname+"\
        <input class='form-control input-sm productid ' name='Product[]'   type='hidden' name='' value='"+productid+"'>\
    </td>\
    <td class='table-edit-view'>\
        <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='"+productquantity+"'><div style='color: red; display: none' class='msg1'>Digits only</div>\
    </td>\
    <td class='table-edit-view'>\
        <select name='Price[]' id='productprice' class='input-borderless price'>\
            <option value='"+productprice+"'>"+productprice+"</option>\
        </select>\
        <input class='form-control input-sm subtotal'   type='hidden'  value='"+productsubtotal+"'>\
        </td>\
    <td class='table-edit-view'>\
        <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='"+productdiscount+"'> <div style='color: red; display: none' class='msg3'>Digits only</div>\
    </td>\
    <td class='table-edit-view'><span class='tabledit-span'></span>\
            <select name='Status[]' id='productstatus' class='input-borderless status'>\
            <option value='"+item_data[o].so_itemstatus+"' selected='selected'>"+item_data[o].so_itemstatus+"</option>\
            </select>\
        </td>\
    <td class='table-edit-view'>\
        <input class='input-borderless input-sm row_data total'   type='text' readonly value='"+producttotal+"'>\
    </td>\
    <td>\
        <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
        <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
        <span class='btn_cancel'><button class='btn btn-mini btn-danger ' type='button'>Reset</button></span>\
        <span class='btn_delete'><button  class='btn btn-mini btn-danger btn_deleterow' type='button'>Delete</button></span>\
    </td>\
</tr>\
");

$(".btn_cancel").hide();
$(".btn_save").hide();
}
function clearrows(){
//$("#soitem_productid option:selected").text("");
$("#soitem_price").val("");
$("#soitem_qty").val("");
$("#soitem_discount").val("");
$("#sofinal_price").val("");
}

//get price level for selected item

// $("#soitem_productid").change(function(){
//     var product_id=$("#soitem_productid").val();
//     console.log(product_id);
//     $.get("../ajax/ajaxsales.php?type=get_pricelevels",{productid:product_id},function(data)
//     {
//       console.log(data);
//       var d=JSON.parse(data); 
//       $("#soitem_price").html("");
//       $.each(d,function(i,x)
//       {
//         console.log(i);
//         console.log(x);
//         $("#soitem_price").append("<option value='"+d[i].pricelevel_price+"'> "+d[i].pricelevel_price+" </option>");
//       });
//     });

// });


