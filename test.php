<?php
session_start();
include 'koneksi.php';
include 'proses.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Data Siswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .header-admin { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .badge { padding: 5px 10px; border-radius: 50px; font-size: 0.8rem; background: var(--bg-light); color: var(--dark-blue); }
        .action-link { text-decoration: none; font-weight: 600; margin: 0 5px; }
        .text-edit { color: var(--primary); }
        .text-del { color: #d32f2f; }
    </style>
</head>
<body class="login-body">
<div class="dashboard">
    <div class="card">
        <h3>Total Pendaftar</h3>
        <h1><?= $totalData['total']; ?></h1>
    </div>

    <div class="card">
        <h3>Laki-laki</h3>
        <h1><?= $dataLaki['total']; ?></h1>
    </div>

    <div class="card">
        <h3>Perempuan</h3>
        <h1><?= $dataPerempuan['total']; ?></h1>
    </div>

</div>


<div class="table-wrapper">
    <div class="header-admin">
        <h2 style="color: var(--dark-blue);">Data Pendaftar Masuk</h2>
        <a href="index.php" class="btn-login-2" style="text-decoration:none;">+ Tambah / Logout</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama / No.Daftar</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Asal</th>
                <th>Alamat</th>
                <th>Jurusan</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM form_p");
            $no=1;
            while($row=mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <b><?= $row['nama_lengkap']; ?></b><br>
                    <small style="color:#888"><?= $row['no_pendaftaran']; ?></small>
                </td>
                <td><?= $row['tt_lahir']; ?></td>
                <td><?= $row['jenis_kel']; ?></td>
                <td><?= $row['asal']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><span class="badge"><?= $row['jurusan']; ?></span></td>
                <td><?= $row['no_hp_wa']; ?></td>
                <td>
                    <a href="data.php?edit=<?= $row['no_pendaftaran']; ?>" class="action-link text-edit">Edit</a>
                    <a href="#" onclick="openModal(<?= $row['id']; ?>)" class="action-link text-del">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php if($editData): ?>
<div class="modal-overlay">
    <div class="modal-box">
        <div class="form-header">
            <h3 style="font-size: 20px;">Edit Data Siswa</h3>
            <small style="font-size: 15px;">UBAH DATA DENGAN TELITI</small>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label style="font-size: 13px;">No Pendaftaran</label>
                <input type="hidden" name="no_lama" 
                    value="<?= $editData['no_pendaftaran'] ?? '' ?>">
                <input class="form-control" type="text" name="no_pendaftaran" 
                    value="<?= $editData['no_pendaftaran'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label style="font-size: 13px;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" 
                       value="<?= $editData['nama_lengkap'] ?? '' ?>" style="font-size: 15px;">
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                <div style="flex:1">
                    <label style="font-size: 13px;">Tanggal Lahir</label>
                    <input type="date" name="tt_lahir" class="form-control" value="<?= $editData['tt_lahir'] ?? '' ?>" style="font-size: 15px;">
                </div>
                <div style="flex:1">
                    <label style="font-size: 13px;">Jenis Kelamin</label>
                    <select name="jenis_kel" class="form-control" style="font-size: 15px;">
                        <option value="Laki-laki" <?= ($editData['jenis_kel'] ?? '')=="Laki-laki"?"selected":""; ?>>Laki-laki</option>
                        <option value="Perempuan" <?= ($editData['jenis_kel'] ?? '')=="Perempuan"?"selected":""; ?>>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label style="font-size: 11px;">Jurusan</label>
                <select name="jurusan" class="form-control" style="font-size: 12px;">
                    <option value="RPL" <?= ($editData['jurusan'] ?? '')=="RPL"?"selected":""; ?>>RPL</option>
                    <option value="DKV" <?= ($editData['jurusan'] ?? '')=="DKV"?"selected":""; ?>>DKV</option>
                    <option value="TKJ" <?= ($editData['jurusan'] ?? '')=="TKJ"?"selected":""; ?>>TKJ</option>
                    <option value="BD" <?= ($editData['jurusan'] ?? '')=="BD"?"selected":""; ?>>BD</option>
                    <option value="AN" <?= ($editData['jurusan'] ?? '')=="AN"?"selected":""; ?>>AN</option>
                </select>
            </div>
            
            <input type="hidden" name="alamat" value="<?= $editData['alamat'] ?? '' ?>">
            <input type="hidden" name="asal" id="edit_asal" value="<?= $editData['asal'] ?? '' ?>">
            <input type="hidden" name="no_hp_wa" value="<?= $editData['no_hp_wa'] ?? '' ?>">

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" name="update" class="btn-submit" style="font-size: 12px; padding: 10px;">Simpan Perubahan</button>
                <a href="data.php" class="btn-submit" style="background: #ccc; text-align: center; text-decoration: none; color: #333; font-size: 12px; padding: 10px;">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<div id="modalHapus" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h3>Konfirmasi Hapus</h3>
        <p>Yakin ingin menghapus data ini?</p>

        <div style="margin-top:20px; display:flex; gap:10px;">
            <button style="text-decoration: none; background:red" class="btn-submit"><a style="color: white; text-decoration : none;" id="confirmDelete" href="#">Hapus</a></button>
            <button onclick="closeModal()" class="btn-submit">Batal</button>
        </div>
    </div>
</div>
<script>


function openModal(id){

    document.getElementById("modalHapus").style.display = "flex";

    document.getElementById("confirmDelete").href =
        "proses.php?hapus=" + id;
}

function closeModal(){
    document.getElementById("modalHapus").style.display = "none";
}
</script>
</body>
</html>