<?php 
    if(isset($_POST['simpan'])){
        extract($_POST);
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $ins = $dbo->insert("tblpetugas","null,'$nama_petugas','$alamat','$no_hp','$username','$pass','$role'");
        if($ins){
            ?>
                <script>
                    alert('Simpan Berhasil');
                    location.href='?hal=petugas';
                </script>
            <?php
        }
    }
?>
<div class="judul">
    <a href="?hal=add_petugas"><i class="fa fa-list"></i>Lihat Data</a>
    <div class="keterangan">Data Menu</div>
</div>
<div class="data-input">
    <form action="?hal=add_petugas" method="post">
        <table>

            <tr>
                <td>Nama Petugas</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama_petugas" placeholder="Nama Petugas" required>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>
                    <input type="text" name="alamat" required>
                </td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td>
                    <input type="text" name="no_hp" required>
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                    <input type="text" name="username" required>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <input type="Password" name="pass" placeholder="Password">
                </td>
            </tr>
            <tr>
                <td>Role</td>
                <td>:</td>
                <td>
                    <select name="role" id="">
                        <option value="">==Pilih Role==</option>
                        <option value="kasir">Kasir</option>
                        <option value="dapur">Dapur</option>
                        <option value="manager">Manager</option>
                        <option value="owner">Owner</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn-add" type="submit" name="simpan" value="simpan"><i class="fa fa-save"></i>Simpan</button>
                </td>
                
            </tr>
        </table>
    </form>
</div>