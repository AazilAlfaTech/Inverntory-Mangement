$("#sinv_customer").change(function() {
    var customer_id = $("#sinv_customer").val();
    console.log(customer_id);
    // $.get("../ajax/ajaxsales.php?type=get_sales_order_of_customer", { customerselect: customer_id }, function(data) {
    //     console.log(data);

    //     $("#tbody").html("");
    //     var txt = '';
    //     console.log(data);
    //     var i_data = JSON.parse(data);
    //     $.each(i_data, function(i, x) {

    //         txt = ' <tr>' +
    //             '<td id="Trans">Purchase</td>' +
    //             '<td id="P_invoice">' + i_data[i].Purchase_id + '<input type="text" name="Pay_type_id[]" value="' + i_data[i].Purchase_id + '"></td>' +
    //             '<td id="P_date">' + i_data[i].Purchase_date + '</td>' +
    //             '<td id="P_duedate">' + i_data[i].Purchase_end_date + '</td>' +
    //             '<td id="P_amount">' + i_data[i].Purchase_gtot + '</td>' +
    //             '<td id="P_dueamount">' + i_data[i].Purchase_due + '</td>' +
    //             '<td><input type="text" name="Pay_ind_amnt[]" class="total" id="tot"></td>' +
    //             '<td><button type="button" class="btn btn-success btnadd" onclick="add(this)" ><i class="fas fa-plus-square"></i> </button>&nbsp;&nbsp;<button type="button" class="btn btn-success btndel" onclick="delete_allocation(this)"><i class="far fa-times-circle"></i> </button></td>' +
    //             '</tr>';
    //         $("#tbody").append(txt);
    //         $(".btndel").hide();

    //     })





    // });
});