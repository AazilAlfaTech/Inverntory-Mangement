
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
                $("#codecheck_msg").show();
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
     { window.location.href="../group/manageproductgroup.php?delete="+id1;}
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
           $("#namecheck_msg").show();}
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
         $("#codecheck_msg").show();}
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
         $("#mailcheck_msg").show();}
     });
   }
  }

  //...................PRODUCT TYPE.......................................

 


