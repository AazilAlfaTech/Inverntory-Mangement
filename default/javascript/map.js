// .............District..............

// Filtering the district according to the slected province
$(".selectprovince").change(function()
  {
    var province_id=$(".selectprovince").val();
    console.log(province_id);
    $.get("../ajax/ajaxmap.php?type=checkdistrictprovince",{district_prov:province_id},function(data)
    {
      console.log(data);
      var d=JSON.parse(data);
      $("#selected_city").html("");
      $("#srep_district").html("");
      $("#city_table").html("");
      $("#srep_district").append("<option value=''>Select City</option>");
      $.each(d,function(i,x)
      {
        console.log(i);
        console.log(x);
        $("#srep_district").append("<option value='"+d[i].district_id+"'> "+d[i].district_name+" </option>");
      });
    });
  });

  // Filterong the cities accoring to the district
  $("#srep_district").change(function()
    {
        var district_id=$("#srep_district").val();
        console.log(district_id);
         $.get("../ajax/ajaxmap.php?type=checkcitydistrict",{city_district:district_id},function(data)
        {
            $("#city_table").html("");
            var txt='';
            console.log(data);
            var i_data = JSON.parse(data);
            $.each(i_data,function(i,x)
            {

                txt=' <tr>'+
                '<td id="city_id">'+i_data[i].city_id+'</td>'+
                '<td id="city_name">'+i_data[i].city_name+'</td>'+
                '<td><button type="button" class="btn btn-mini btn-primary btnadd" onclick="add_city('+i_data[i].city_id+',this)"><i class="fa fa-check-square"></i></button>&nbsp;&nbsp; <button type="button" class="btn btn-mini btn-danger btndel" onclick="remove_city('+i_data[i].city_id+',this)"><i class="fa fa-times-circle"></i></button></tr>';
                $("#city_table").append(txt);
                $(".btndel").hide();



            })
        });
    });

    // Adding the selected city to the table
    function add_city(salesrep_city_city,n1)
    {
      
        // console.log(salesrep_city_city);
        $("#selected_city").append("<tr class='xyz"+salesrep_city_city+"'><td><input type='hidden' name='salesrep_city_city[]' value='"+salesrep_city_city+"'>"+salesrep_city_city+"</td></tr>");
        $(n1).parent().find(".btnadd").hide();
        $(n1).parent().find(".btndel").show();
        
    }

    // Remove the selected city from the table
    function remove_city(salesrep_city_city,n1)
    {
        $(".xyz"+salesrep_city_city).remove();
        $(n1).parent().find(".btnadd").show();
        $(n1).parent().find(".btndel").hide();
    }