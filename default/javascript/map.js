// .............District..............

// Filtering the city according to the slected province
$(".selectprovince").change(function()
  {
    var province_id=$(".selectprovince").val();
    console.log(province_id);
    $.get("../ajax/ajaxmap.php?type=checkdistrictprovince",{district_prov:province_id},function(data)
    {
      console.log(data);
      var d=JSON.parse(data);
      $("#srep_district").html("");
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
                '<td id="city_id">'+i_data[i].city_id+'<input type="text" name="srep_city_id[]" value="'+i_data[i].city_id+'"></td>'+
                '<td id="city_name">'+i_data[i].city_name+'</td>'+
                '<td><button type="button" class="btn btn-primary"><i class="fa fa-check-square"></i></button>&nbsp;&nbsp; <button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i></button></tr>';
                // '<td><button type="button" class="btn btn-success btnadd" onclick="add(this)" ><i class="fas fa-plus-square"></i> </button>&nbsp;&nbsp;<button type="button" class="btn btn-success btndel" onclick="delete_allocation(this)"><i class="far fa-times-circle"></i> </button></td>'+
                // '</tr>';
                $("#city_table").append(txt);
                $(".btndel").hide();

            })
        });
    });