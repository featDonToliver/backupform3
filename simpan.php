<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_lengkap'];
    $ttl = $_POST['tt_lahir'];
    $jk = $_POST['jenis_kel'] ?? '';
    $alamat = $_POST['alamat'];
    $asal = $_POST['asal'];
    $email = $_POST['email'];
    $hp = $_POST['no_hp_wa'];
    $jurusan = $_POST['jurusan'];

    // simpan data awal
    $queryInsert = mysqli_query($conn,"INSERT INTO form_p 
    (nama_lengkap,tt_lahir,jenis_kel,alamat,asal,email,no_hp_wa,jurusan)
    VALUES
    ('$nama','$ttl','$jk','$alamat','$asal','$email','$hp','$jurusan')");

    if(!$queryInsert){
        die("ERROR INSERT: " . mysqli_error($conn));
    }

    // ambil id
    $id = mysqli_insert_id($conn);
    $tahun = date("Y");

    $queryLast = mysqli_query($conn,"
        SELECT no_pendaftaran 
        FROM form_p 
        WHERE no_pendaftaran LIKE '$tahun-PPDB-%'
        ORDER BY id DESC 
        LIMIT 1
    ");

    $dataLast = mysqli_fetch_assoc($queryLast);

    if($dataLast && !empty($dataLast['no_pendaftaran'])){
        $lastNumber = (int) substr($dataLast['no_pendaftaran'], -3);
        $newNumber = $lastNumber + 1;
    }else{
        $newNumber = 1;
    }

    $no_pendaftaran = $tahun . "-PPDB-" . str_pad($newNumber, 3, "0", STR_PAD_LEFT);

    // update data tadi dengan nomor pendaftaran yang sudah jadi
    $queryUpdate = mysqli_query($conn,"
        UPDATE form_p 
        SET no_pendaftaran='$no_pendaftaran' 
        WHERE id='$id'
    ");

    if(!$queryUpdate){
        die("ERROR UPDATE: " . mysqli_error($conn));
    }

    header("Location: index.php?success=Pendaftaran berhasil dengan nomor: $no_pendaftaran");
    exit;
}
?>