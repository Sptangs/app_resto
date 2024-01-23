<?php
    session_start();
    include "config/classDb.php";

    if(isset($_POST['login'])){
        extract($_POST);
        $sel = $dbo->select("tblpelanggan where username='$username'");
        foreach($sel as $row){
            $pass = $row['password'];
        }
        if(password_verify($password, $pass)){
            $_SESSION['iduser'] = $row['idpelanggan'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['namapelanggan'] = $row['nama_pelanggan'];
            ?>
                <script>
                    location.href='index.php';
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    alert('login gagal, periksa username dan password');
                    location.href='index.php';
                </script>
            <?php
        }
    }
?>