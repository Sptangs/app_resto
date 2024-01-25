<?php
    session_start();
    include "../config/classDb.php";

    if(isset($_POST['login'])){
        extract($_POST);
        $sel = $dbo->select("tblpetugas where username='$username'");
        foreach($sel as $row){
            $pass = $row['password'];
        }
        if(password_verify($password1, $pass)){
            $_SESSION['iduser'] = $row['idpetugas'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['namapetugas'] = $row['nama_petugas'];
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