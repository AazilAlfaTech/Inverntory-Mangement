
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
    
     $("#gr_code").attr("readonly",true);
    
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


