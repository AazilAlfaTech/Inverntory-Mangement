<script>
$("#sinv_customer").change(function() {
    var customer_id = $("#sinv_customer").val();
    console.log(customer_id);
     $.get("../ajax/ajaxsales.php?type=get_sales_order_of_customer", { customerselect: customer_id }, function(data) {
         console.log(data);

         $("#tbody").html("");
         var txt = '';
     
         var i_data = JSON.parse(data);
        $.each(i_data, function(i, x) {

            txt = ' <tr>' +
              
                '<td >' + i_data[i].salesorder_id +'</td>' +
                 '<td >' + i_data[i].salesorder_ref + '</td>' +
                 '<td >' + i_data[i].salesorder_date + '</td>' +
      
                 '<td><button type="button" class="btn btn-success btnadd" onclick="add_to_list(' + i_data[i].salesorder_id +')" ><i class="fas fa-plus-square"></i> </button>&nbsp;&nbsp;<button type="button" class="btn btn-success btndel" onclick="delete_allocation(this)"><i class="far fa-times-circle"></i> </button></td>' +
                '</tr>';
            $("#tbody").append(txt);
            // $(".btndel").hide();

         });





     });
});








function add_to_list(i){

console.log(i);


$.get("../ajax/ajaxsales.php?type=get_sales_order_item", { sales_item: i }, function(data) {
         console.log(data);

        //  $("#tbodybuilder").html("");

        //  var txt1 = '';
     
         var item_data = JSON.parse(data);

         console.log(item_data);
        $.each(item_data, function(o, p) {

            console.log(o);
            console.log(p);

            txt1 = ' <tr>' +
              
                '<td>' + 1 +'</td>' +
                '<td>' + item_data[o].so_itemprice +'</td>' +
                '<td>' + item_data[o].so_itemproductid+'</td>' +
                '<td>' + item_data[o].so_itemqty +'</td>' +
                '<td>' + item_data[o].so_itemprice +'</td>' +
                '<td>' + item_data[o].so_itemdiscount+'</td>' +
                '<td>' + item_data[o].so_itemprice +'</td>' +
            
          
             
      
                 '<td><button type="button" class="btn btn-success btnadd" ><i class="fas fa-plus-square"></i> </button>&nbsp;&nbsp;<button type="button" class="btn btn-success btndel" onclick="delete_allocation(this)"><i class="far fa-times-circle"></i> </button></td>' +
                '</tr>';
            $("#tbodybuilder").append(txt1);
            // $(".btndel").hide();

         });





     });

}

function statuschange(id,checkbox1){
    console.log(id);
    //statuss=$(".stat").val();
    //console.log(statuss)
    $(".itembody .table-edit .salesorder").each(function() {
        console.log($(this).text());
        if($(this).text()==id){
           // $(this).parent().parent().remove();
         //  console.log($(".itembody .itemstatus .productstatus").val());
        //    $(".itembody .itemstatus .productstatus").val("PENDING");
        //   $(".itembody .itemstatus .productstatus").html("PENDING");
         var option = $('<option></option>').attr("value", "PENDING").text("PENDING");
         // console.log ($(this).parent().parent().children().children('.productstatus').val());
$(this).parent().parent().children().children('.productstatus').empty().append(option);
          //$("#table_headers td:eq(2)").html("new");
        }
    });
}


$(".invoicetable").append(
                "<tr>\
                <td >\
            <input class='form-control '   type='hidden' name='Product[]' value='"+ $(this).text()+"'>\
        </td>\
        <td ><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='COMPLETED'><div style='color: red; display: none' class='msg1'>Digits only</div>\
        </td>\
                </tr>/"
                
            );

</script>