<?php
session_start();
include 'koneksi.php';

$total = mysqli_query($conn,"SELECT COUNT(*) as total FROM form_p");
$totalData = mysqli_fetch_assoc($total);

$laki = mysqli_query($conn,"SELECT COUNT(*) as total FROM form_p WHERE jenis_kel='Laki-Laki'");
$dataLaki = mysqli_fetch_assoc($laki);

$perempuan = mysqli_query($conn,"SELECT COUNT(*) as total FROM form_p WHERE jenis_kel='Perempuan'");
$dataPerempuan = mysqli_fetch_assoc($perempuan);

// --- logic delete & edit ---
if(isset($_GET['konfirmasi'])){
    $id = $_GET['konfirmasi'];
    mysqli_query($conn,"DELETE FROM form_p WHERE id='$id'");
    header("Location: data.php");
    exit;
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    mysqli_query($conn,"DELETE FROM form_p WHERE id='$id'");

    header("Location: data.php");
}

// logic fetch edit
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $resultEdit = mysqli_query($conn,"SELECT * FROM form_p WHERE no_pendaftaran='$id'");
    $editData = mysqli_fetch_assoc($resultEdit);
}

// logic update
if(isset($_POST['update'])){

    $no_lama = $_POST['no_lama'];
    $no_baru = $_POST['no_pendaftaran'];
    $nama = $_POST['nama_lengkap'];
    $ttl = $_POST['tt_lahir'];
    $jk = $_POST['jenis_kel'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $asal = $_POST['asal'];
    $hp = $_POST['no_hp_wa'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($conn,"UPDATE form_p SET
        nama_lengkap='$nama', tt_lahir='$ttl', jenis_kel='$jk', email='$email',
        alamat='$alamat', asal='$asal', no_hp_wa='$hp', jurusan='$jurusan',
        no_pendaftaran='$no_baru'
        WHERE no_pendaftaran='$no_lama'");
    
    header("Location: data.php?success=Data berhasil diubah!");
    exit;
}

    if(isset($_POST['submit'])){
    $no = $_POST['no_pendaftaran'];
    $nama = $_POST['nama_lengkap'];
    $ttl = $_POST['tt_lahir'];
    $jk = $_POST['jenis_kel'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $asal = $_POST['asal'];
    $hp = $_POST['no_hp_wa'];
    $jurusan = $_POST['jurusan'];
    
    if( 
        empty($no) ||
        empty($nama) ||
        empty($ttl) ||
        empty($jk) ||
        empty($email) ||
        empty($alamat) ||
        empty($asal) ||
        empty($hp) ||
        empty($jurusan)
   ){
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }
}
?>


