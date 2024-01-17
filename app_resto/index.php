<?php
    session_start();
    include "config/classDB.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Resto Enak</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Resto Enak</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php
                    $kategori = $dbo->select('tblkategori');
                    foreach($kategori as $row){
                        ?>
                    <li><a href="?kategori=<?=$row['idkategori']?>"><?=$row['kategori']?></a></li>
                        <?php
                    }
                ?>

                <li><a href='?hal=cart'>
                    <?php
                    $jumlahpesanan = 0;
                        if(!empty($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $id=>$val){
                                $jumlahpesanan +=$val;
                            }
                        }
                    ?>
                    Pesanan(<?=$jumlahpesanan?>)
                </a></li>
            </ul>
        </nav>
    </header>
    <?php
        $hal = isset($_GET['hal'])?$_GET['hal']:"";
        if($hal != ""){        
    ?>
    <section class="menu">
        <table border="1" cellspacing=0 width="100%">
            <tr>
                <th>No</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Hapus</th>
            </tr>
            <?php
                $no = 1;
                 if(!empty($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $id=>$val){
                        $datamenu = $dbo->select("tblmenu where idmenu=$id");
                        foreach($datamenu as $row){

                        }
                      ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$row['nama_menu']?></td>
                            <td>
                                <a href="cart.php?aksi=edit&id=<?=$id?>&val=-1">[-]</a>
                                <?=$val?>
                                <a href="cart.php?aksi=edit&id=<?=$id?>&val=1">[+]</a>
                            </td>
                            <td>
                                <a href="cart.php?id=<?=$id?>&aksi=hapus">Hapus</a>
                            </td>
                        </tr> 
                      <?php
                    }
                }
            ?>
        </table>
    </section>

<?php
        }
?>
    <section class="menu">
        <h2>Menu Resto Enak</h2>
        <?php
            $kategori = isset($_GET['kategori'])?$_GET['kategori']:"";

            if($kategori==""){
                $menu = $dbo->select('tblmenu');
            }else{
                $menu = $dbo->select("tblmenu where idkategori=".$kategori);
            }
            foreach($menu as $data){
                ?>
                    <div class="menu-item">
                    <img src="img/<?=$data['foto']?>" alt="menu 1">
                    <h3><?=$data['nama_menu']?></h3>
                    <p>
                        <?=$data['deskripsi']?>
                    </p>
                    <div class="harga">Harga  : Rp. <?=number_format($data['harga'],0,0,'.')?></div>
                    <a href="cart.php?id=<?=$data['idmenu']?>" class="order-button">Pesan</a>
                    </div>
                <?php
            }
        ?>
        
    </section>

    <section class="contact">
        <h2>Hubungi Kami</h2>
        <p>Jika ada pertanyaan, saran atau kritik hubungi kami di:</p>
        <p>WA 0812344</p>
        <p>Email  :  admin@gmail.com</p>
    </section>

    <footer>
        <p>&copy; 2023 Restoran Enak .Hak Cipta di Lindungi</p>
    </footer>
</body>
</html>