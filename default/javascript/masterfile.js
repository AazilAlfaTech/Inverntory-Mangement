



    //function to view details when user clicks edit button

    

    $(".edit_group").click(function(){
      var id1=$(this).attr("id");
     // console.log(id1);
     window.location.href="../group/manageproductgroup.php?view="+id1;
    });

    $(".delete_group").click(function(){
      var id1=$(this).attr("id");
     // console.log(id1);
     if(confirm("Do you want to delete id"+""+id1))
     { window.location.href="../group/manageproductgroup.php?delete="+id1;}
    });




    
    // function deletegroup(){

    //   var id=$("#gr_id_td").html();
    //  // alert(id)
    //   if(confirm("Do you want to delete id"+""+id))
    //  { window.location.href="../group/manageproductgroup.php?delete="+id;}

    //  }

    

    //  function check_groupname(){
    //   let code=$("#gr_name").val();
    //   console.log(code);
    //   var codelegnth=code.length
    //  $("#codecheck_msg").show();
    //  if(codelegnth>1){
    //    $.get("../ajax/ajaxmaster.php?type=checkgroupname&productgroup_name="+code+"",function(data){
    //      var tmp=JSON.parse(data);
         
    //        if(tmp.group_id>0){
    //        $("#codecheck_msg").show();}
    //    });
    //  }

    //  }


