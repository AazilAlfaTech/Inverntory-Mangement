


    //function to view details when user clicks edit button

    

    function editgroup(id){
        window.location.href="manageproductgroup.php?view="+id;

        // console.log(id);
        // console.log(groupcode1);
        // console.log(groupname1);
        // $("#gr_id").val(id);
        // $("#gr_code").val(groupcode1);
        // $("#gr_name").val(groupname1);
    }

    function deletegroup(){
      alert("hi")
    //   if(confirm("Do you want to delete id"+""+deleteid))
    //  { window.location.href="manageproductgroup.php?view="+deleteid;}

     
  }


//function to edit group detais
// $("#submitgroup").on("submit",function(e){
//     e.preventDefault();
//     var group_form=$("#submitgroup");
//     //console.log(group_form);
//     //name=$("#gr_name").val();
//     $.post("../group/editgroup_handle.php",group_form.serialize(),function(res) {
//         alert(res)

// });


    
//   });

  