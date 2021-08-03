
//.......PRODUCT GROUP JS.............................

function check_groupcode()
    {
      let code=$("#gr_code").val();
      console.log(code);
      var codelegnth=code.length;
     //$("#codecheck_msg").show();
     if(codelegnth>1)
     {
       $.get("../ajax/ajaxmaster.php?type=checkgroupcode&productgroup_code="+code, "" ,function(data){
          var tmp=JSON.parse(data);
           if(tmp.group_id>0){
               
                $("#codecheck_msg").fadeIn().delay(1000).fadeOut()
              // $(".error").css("display","none");
            }
             });
      }
    }

    $(".edit_group").click(function(){
      var id1=$(this).attr("id");
     // console.log(id1);
     window.location.href="../group/manageproductgroup.php?view="+id1;
    
    });

    $(".delete_group").click(function(){
      var id1=$(this).attr("id");
     console.log(id1);
     if(confirm("Do you want to delete id"+""+id1))
     { window.location.href="../group/manageproductgroup.php?delete="+id1;
     }
    }); 


  function check_groupname(){
      let code=$("#gr_name").val();
      console.log(code);
      var codelegnth=code.length
     $("#namecheck_msg").hide();
     if(codelegnth>1){
       $.get("../ajax/ajaxmaster.php?type=checkgroupname&productgroup_name="+code+"",function(data){
         console.log(data);
        var tmp=JSON.parse(data);
         
           if(tmp.group_id>0){
           $("#namecheck_msg").fadeIn().delay(1000).fadeOut()}
       });
     }

     }

  //..................PRODUCT LOCATION................................................

  function check_locationcode(){
    let code=$("#loc_code").val();
    console.log(code);
    var codelegnth=code.length
   $("#codecheck_msg").hide();
   if(codelegnth>1){
     $.get("../ajax/ajaxmaster.php?type=checklocationcode&masterlocation_code="+code+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.location_id>0){
         
         $("#codecheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }
  }

  function check_locationmail(){

    let mail=$("#loc_mail").val();
    console.log(mail);
    var maillegnth=mail.length;
   $("#mailcheck_msg").hide();
   if(maillegnth>1){
     $.get("../ajax/ajaxmaster.php?type=checklocationmail&masterlocation_mail="+mail+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.location_id>0){
        
         $("#mailcheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }
  }

  //...................PRODUCT TYPE.......................................



function check_typecode(){
  let code=$("#typ_code").val();
  console.log(code);
  var codelegnth=code.length
 $("#codecheck_msg").hide();
 if(codelegnth>1){
   $.get("../ajax/ajaxmaster.php?type=checktypecode&producttype_code="+code+"",function(data){
     console.log(data);
    var tmp=JSON.parse(data);
     
       if(tmp.ptype_id>0){

       $("#codecheck_msg").fadeIn().delay(1000).fadeOut();
      }
   });
 }
}

function check_typename(){
  let name=$("#typ_name").val();
  console.log(name);
  var namelegnth=name.length
 $("#namecheck_msg").hide();
 if(namelegnth>1){
   $.get("../ajax/ajaxmaster.php?type=checktypename&producttype_name="+name+"",function(data){
     console.log(data);
    var tmp=JSON.parse(data);
     
       if(tmp.ptype_id>0){
     
       $("#namecheck_msg").fadeIn().delay(1000).fadeOut();}
   });
 }
}

//..............................PRODUCT UOM...................................

  function check_uomcode(){
    let code=$("#unitcode").val();
  console.log(code);
  var codelegnth=code.length
 $("#codecheck_msg").hide();
 if(codelegnth>1){
   $.get("../ajax/ajaxmaster.php?type=checkuomcode&productuom_code="+code+"",function(data){
     console.log(data);
    var tmp=JSON.parse(data);
     
       if(tmp.uom_id>0){

       $("#codecheck_msg").fadeIn().delay(1000).fadeOut();
      }
   });
 }
  }

  function check_uomname(){
    let name=$("#unit_code").val();
    console.log(name);
    var namelegnth=name.length
   $("#namecheck_msg").hide();
   if(namelegnth>1){
     $.get("../ajax/ajaxmaster.php?type=checkuomname&productuom_name="+name+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.ptype_id>0){
       
         $("#namecheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

  }

// ...........................PRODUCT ITEM JS......................................................................

// Filtering the product type according to the group
  $(".productgroup").change(function()
  {
    var group_id=$(".productgroup").val();
    console.log(group_id);
    $.get("../ajax/ajaxmaster.php?type=checktypegroup",{producttype_group:group_id},function(data)
    {
      console.log(data);
      var d=JSON.parse(data);
      $("#type_id").html("");
      $.each(d,function(i,x)
      {
        console.log(i);
        console.log(x);
        $("#type_id").append("<option value='"+d[i].ptype_id+"'> "+d[i].ptype_name+" </option>");
      });
    });
  });

  // Auto generation of product code
  function autocode()
  {
    var group_id=$("#gr_id").val();
    // console.log(group_id);
    // alert(group_id);
    $.get("../ajax/ajaxmaster.php?type=checkgroupid",{productgroup_id:group_id},function(data)
    {
      console.log(data);
      var group_data = JSON.parse(data);
      gname=group_data.group_name;
      console.log(gname);
      var g1=(gname.charAt(0));
      // var res=$("#prod_code").val(g1);

    });

    var ptype_id=$("#type_id").val();
    // console.log(group_id);
    // alert(group_id);
    $.get("../ajax/ajaxmaster.php?type=checktypeid",{producttype_id:ptype_id},function(data)
    {
      console.log(data);
      var type_data = JSON.parse(data);
      tname=type_data.ptype_name;
      console.log(tname);
      var t1=(tname.charAt(0));
      // var re=$("#prod_code").val(t1);
    });

     
  }
