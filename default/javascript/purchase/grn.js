function po_details(po)
{
    window.location.href="add_new_GRN.php?view="+po;
}

    $(".c_status").change(function()
    {
        var St=$(".c_status").val();
        // console.log(St);
        if(St=='PENDING')
        { 
            console.log("HI");
            var option = $('<option></option>').attr("value", "PENDING").text("PENDING");
            $('.productstatus').empty().append(option);
        }
        else
        {
            var option = $('<option></option>').attr("value", "COMPLETE").text("COMPLETE");
            $('.productstatus').empty().append(option);
        }
    });