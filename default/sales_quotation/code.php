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


?>