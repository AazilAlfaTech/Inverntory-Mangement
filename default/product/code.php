<?php

if (isset($_POST["productname"]))
{
    $product1->product_name=$_POST["productname"];
    $product1->product_type=$_POST["prodtypeid"];
    $product1->product_uom=$_POST["unitid"];
    $product1->product_desc=$_POST["productdesc"];
    $product1->product_inventory_val=$_POST["productval"];
    $product1->product_batch=$_POST["productbatch"];

    //....................................................
    if(isset($_POST["product_id"]))
    {
        $res_edit= $product1->edit_product($_POST['product_id']); 
            //code for insert validation
            if($res_edit==true){
               
                header("location:../product/manageproduct.php?success_edit=1");
            }elseif($res_edit==false){
                header("location:../product/manageproduct.php?notsuccess=1");
            }
    }else
    {
            $res_insert=$product1->insert_product();   
            //code for insert validation
            if($res_insert==true){
                
                header("location:../product/manageproduct.php?success=1");
            }elseif($res_insert==false){
                header("location:../product/manageproduct.php?notsuccess=1");
            }
    }


}

?>