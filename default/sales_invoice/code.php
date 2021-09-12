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
</script>