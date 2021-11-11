<?php
foreach ($result_sales as $item)
{
    if($item->salesquot_currentstatus=='NEW'){
        echo
    "<tr>
   
        <td>$item->salesquot_ref</td>
        <td>$item->salesquot_date</td>
        <td>$item->salesquot_customer_name</td>

        
        <td><label class='badge badge-success' style='background-color: #04AA6D;'>$item->salesquot_currentstatus</label></td>

        <td>
            <div class='btn-group btn-group-sm' style='float: none;'>
            <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                <button type='button' onclick='edit_sq($item->salesquot_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='fa fa-edit'></span></button>
                <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>

            </div>
        </td>
    </tr> ";
        
    }else if($item->salesquot_currentstatus=='COMPLETE'){
        echo
    "<tr>
   
        <td>$item->salesquot_ref</td>
        <td>$item->salesquot_date</td>
        <td>$item->salesquot_customer_name</td>

        
        <td><label class='badge badge-info' >$item->salesquot_currentstatus</label></td>

        <td>
            <div class='btn-group btn-group-sm' style='float: none;'>
            <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                
                <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>

            </div>
        </td>
    </tr> ";
    }
    
}



if (!check ("USR", 3)) {
    die("NO PERMISSION TO ACCESS!");
  }else{
      echo" <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
      ";
  }
  if (!check ("USR", 3)) {
    die("NO PERMISSION TO ACCESS!");
  }else{
      echo"   <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
      ";
  }
  if (!check ("USR", 3)) {
    die("NO PERMISSION TO  ACCESS!");
  }else{
      echo"  <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
      ";
  }


  //


  if ($user4->check("SQV", 3)) {
    echo" <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
    ";
  }else{
    echo"no";
  }
  if ($user4->check("SQD", 4)) {
    echo"   <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
    ";
  }
  else{
    echo"no";
  }
  if ($user4->check ("SQE", 2)) {
   echo"    <button type='button' onclick='edit_sq($item->salesquot_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='fa fa-edit'></span></button>
    ";
  }else{
    echo"no";
  }

  if (!isset($_SESSION["access"])) {

    try {

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "
                . " WHERE 1 GROUP BY `mod_modulegroupcode` "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        // modules group
  ............      $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module "
                . " WHERE 1 "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        // all modules
 ............       $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights "
                . " WHERE  rr_rolecode = :rc "
                . " ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);

        $stmt->execute();
        // modules based on user role
...........        $userRights = $stmt->fetchAll();

        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}



  
function set_rights($menus, $menuRights, $topmenu) {
  $data = array();

  // for ($i = 0, $c = count($menus); $i < $c; $i++) {

      $row = array();
      for ($j = 0, $c2 = count($menuRights); $j < $c2; $j++) {
     
          // if ($menuRights[$j]["rr_modulecode"] == $menus[$i]["mod_modulecode"]) {
       
              if (authorize($menuRights[$j]["rr_create"]) || authorize($menuRights[$j]["rr_edit"]) ||
          
                      authorize($menuRights[$j]["rr_delete"]) || authorize($menuRights[$j]["rr_view"])
              ) {

                  // $row["menu"] = $menus[$i]["mod_modulegroupcode"];
                  // $row["menu_name"] = $menus[$i]["mod_modulename"];
                  // $row["page_name"] = $menus[$i]["mod_modulepagename"];
                  $row["create"] = $menuRights[$j]["rr_create"];
                  $row["edit"] = $menuRights[$j]["rr_edit"];
                  $row["delete"] = $menuRights[$j]["rr_delete"];
                  $row["view"] = $menuRights[$j]["rr_view"];

                  $data[$menus[$i]["mod_modulegroupcode"]][$menuRights[$j]["rr_modulecode"]] = $row;
                  $data[$menus[$i]["mod_modulegroupcode"]]["top_menu_name"] = $menus[$i]["mod_modulegroupname"];
              }
          }
      // }
  // }

  return $data;
}

// this function is used by set_rights() function
function authorize($module) {
  return $module == "yes" ? TRUE : FALSE;
}



<?php
//    error_reporting(E_ALL & ~E_NOTICE);
            foreach ($result_sales as $item)
            {
                if($item->salesquot_currentstatus=='NEW'){
                    echo
                "<tr>
               
                    <td>$item->salesquot_ref</td>
                    <td>$item->salesquot_date</td>
                    <td>$item->salesquot_customer_name</td>

                    
                    <td><label class='badge badge-success' style='background-color: #04AA6D;'>$item->salesquot_currentstatus</label></td>

                    <td>
                        <div class='btn-group btn-group-sm' style='float: none;'>";
                        if ($user4->check("SQV", 3)) {
                            echo" <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                            ";
                          }else{
                            echo"no";
                          }
                          if ($user4->check("SQD", 4)) {
                            echo"   <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
                            ";
                          }
                          else{
                            echo"no";
                          }
                        
                       echo" </div>
                    </td>
                </tr> ";
                    
                }else if($item->salesquot_currentstatus=='COMPLETE'){
                    echo
                "<tr>
               
                    <td>$item->salesquot_ref</td>
                    <td>$item->salesquot_date</td>
                    <td>$item->salesquot_customer_name</td>

                    
                    <td><label class='badge badge-info' >$item->salesquot_currentstatus</label></td>

                    <td>
                        <div class='btn-group btn-group-sm' style='float: none;'>";
                        if ($user4->check("SQV", 3)) {
                            echo" <button type='button' id='edit_pr' onclick='view_sq($item->salesquot_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></button>
                            ";
                          }else{
                            echo"no";
                          }
                          if ($user4->check("SQD", 4)) {
                            echo"   <button type='button'  onclick='delete_sq($item->salesquot_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
                            ";
                          }
                          else{
                            echo"no";
                          }
                          if ($user4->check ("SQE", 2)) {
                           echo"    <button type='button' onclick='edit_sq($item->salesquot_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='fa fa-edit'></span></button>
                            ";
                          }else{
                            echo"no";
                          }
                        echo"
                        </div>
                    </td>
                </tr> ";
                }
                
            }

         
              
        ?>




        function ad_login($un,$pw)
{

    //$query="SELECT * FROM user WHERE user_email='$un' AND  user_password='$pw'";
    $query="SELECT * FROM `user` LEFT JOIN user_role ON user.user_roleid=user_role.roleid WHERE user_email='$un' AND user.user_password='$pw'";
    //echo $query;
    $result = $this->db->query($query);
    
    //if the email and password is verified
    if($row=$result->fetch_array())
    {
        session_start();
        $_SESSION["user"]=$row;
        $_SESSION["user"]["permission"]=[];

        //query to fetch all the permissions of the role
        $sql=" SELECT * FROM user_role_permission WHERE user_role_permission.rp_role_id='".$_SESSION['user']['user_roleid']."'";
        $result_sql= $this->db->query($sql);
        
        $data=array();
        $row2 = array();
        
            while($row_perm=$result_sql->fetch_array())
            {
                if(isset($_SESSION["user"]["permission"][$row_perm['rp_perm_module']])){

                    if ( authorize($_SESSION["user"]["permission"][$row_perm['rp_perm_add']]) || authorize($_SESSION["user"]["permission"][$row_perm['rp_perm_edit']]) ||
                    authorize($_SESSION["user"]["permission"][$row_perm['rp_perm_del']]) || authorize($_SESSION["user"]["permission"][$row_perm['rp_perm_view']]))
                    {
                        $row2["create"] =$_SESSION["user"]["permission"][$row_perm['rp_perm_add']];
                        $row2["edit"] = $_SESSION["user"]["permission"][$row_perm['rp_perm_edit']];
                        $row2["delete"] =$_SESSION["user"]["permission"][$row_perm['rp_perm_del']];
                        $row2["view"] = $_SESSION["user"]["permission"][$row_perm['rp_perm_view']];
                        $data[$_SESSION["user"]["permission"][$row_perm['rp_perm_module']]] = $row2;
                    }
                    // $_SESSION["user"]["permission"][$row_perm['rp_perm_module']]=[];
                }
               // $_SESSION["user"]["permission"][$row_perm['rp_perm_module']][]=$row_perm['rp_perm_id'];

               
        
            }

            return $data;
            
            
    }
    //if the email and password is not verified
    else{
        return false;     
  

    
    }


}


<div class="row">


<div class="col-sm-3">
    <div class="d-inline">
        <h4> User</h4>

    </div>
</div>

<div class="col-sm-3">
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" id="checkbox1">
        <label class="border-checkbox-label" for="checkbox1">Select All</label>
    </div>
</div>

<div class="col-sm-6">

    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" name="permid[]"  value="5" <?php if(in_array("5",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">View</label>
    </div>
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" name="permid[]"  value="6" <?php if(in_array("6",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">Add</label>
    </div>
    <div class="border-checkbox-group border-checkbox-group-primary"  >
        <input class="border-checkbox" type="checkbox" name="permid[]" value="7" <?php if(in_array("7",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">Edit</label>
    </div>
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" name="permid[]" value="8" <?php if(in_array("8",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">Delete</label>
    </div>

</div>

</div>



<hr>

<div class="row">


<div class="col-sm-3">
    <div class="d-inline">
        <h4> User Role</h4>

    </div>
</div>

<div class="col-sm-3">
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" id="checkbox1">
        <label class="border-checkbox-label" for="checkbox1">Select All</label>
    </div>
</div>

<div class="col-sm-6">
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" name="permid[]" value="9" <?php if(in_array("9",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">View</label>
    </div>
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" name="permid[]" value="10" <?php if(in_array("10",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">Add</label>
    </div>
    <div class="border-checkbox-group border-checkbox-group-primary" >
        <input class="border-checkbox" type="checkbox" name="permid[]" value="11" <?php if(in_array("11",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">Edit</label>
    </div>
    <div class="border-checkbox-group border-checkbox-group-primary">
        <input class="border-checkbox" type="checkbox" name="permid[]" value="12" <?php if(in_array("12",$res_user_perm)){echo "checked";}?>>
        <label class="border-checkbox-label" for="checkbox1">Delete</label>
    </div>

</div>

</div>


<hr>



                                                <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" name="permid[]"  value="5" <?php if($item->rp_perm_id=="5"){echo "checked";}?>>
                                                    <label class="border-checkbox-label" for="checkbox1">View</label>
                                                </div>
                                                <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" name="permid[]"  value="6" <?php if($item->rp_perm_id=="6"){echo "checked";}?>>
                                                    <label class="border-checkbox-label" for="checkbox1">Add</label>
                                                </div>
                                                <div class="border-checkbox-group border-checkbox-group-primary"  >
                                                    <input class="border-checkbox" type="checkbox" name="permid[]" value="7" <?php if($item->rp_perm_id=="7"){echo "checked";}?>>
                                                    <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                                </div>
                                                <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" name="permid[]" value="8" <?php if($item->rp_perm_id=="8"){echo "checked";}?>>
                                                    <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                                </div>





?>