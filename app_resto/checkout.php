<?php
    session_start();
    include "config/classDb.php";
    if(!empty($_SESSION['cart'])){
        //simpan ke table order
        $insertOrder = $dbo->insert("tblorder(idorder,idpelanggan,tglorder)",
        "null,'1',now()");
        $idorder = $dbo->lastInsert();
    if($insertOrder){
        //simpan ke order detail
        foreach($_SESSION['cart'] as $id=>$val){
            $menu = $dbo->select('tblmenu where idmenu='.$id);
            foreach($menu as $row){

            }
            $harga = $row['harga'];
            $insertDetail = $dbo->insert("tblorderdetail", "null,'$idorder',$id,$val,$harga,''");
            unset($_SESSION['cart'][$id]);
        }
    }
    }
?>
<script>
    location.href='index.php';
</script>