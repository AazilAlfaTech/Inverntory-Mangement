<?php
    $T=$_GET["type"];
    $T();

    function checkpobyid()
    {
        include_once "../GRN/GRN.php";
        $po_grn1=new grn();
        $po_grn_item=$po_grn1->get_all_grn_by_poid($_GET['po_grn']);
        echo json_encode($po_grn_item);
    }

    function checkpobyid_sup()
    {
        include_once "../GRN/GRN.php";
        $po_grn2=new grn();
        $po_grn_item2=$po_grn2->get_purchsup_by_prid($_GET['po_grn_sup']);
        echo json_encode($po_grn_item2);
    }
?>