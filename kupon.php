<?php
session_start();
include 'koneksi.php';

$KODE_BENAR = "DISKON100";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kupon = $_POST['kupon'];

    if ($kupon == $KODE_BENAR) {
        $_SESSION['kupon'] = true;
        $_SESSION['nama'] = $nama;
        header("Location: kuponshow.php");
        exit;
    } else {
        echo "<script>alert('Kode Kupon Salah!'); window.location='kupon.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kupon</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen w-full bg-[linear-gradient(to_bottom,rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('gambar/kuponjumbotron.jpg')] bg-cover bg-center bg-no-repeat bg-fixed">
<div class="relative flex flex-col min-h-screen">

    <nav class="w-full bg-[#001E3C] px-3 py-3 flex items-center shadow-[0_4px_15px_rgba(0,0,0,0.05)] fixed top-0 z-[100]">
        <div class="navbar-header flex items-center mr-auto gap-10px">
            <img src="gambar/smkti logo.png" alt="Logo SMK TI Bali Global" class="h-10 w-auto">
            <h1 class="text-[1.1rem] text-yellow-300 font-light">SMK TI Bali Global Denpasar</h1>
        </div>
        <a href="form.php" class="btn-Kupon no-underline bg-[#1215c3] hover:bg-[var(--dark-blue)] text-white px-6 py-2 rounded-[20px] cursor-pointer transition duration-300">Login</a>

    </nav>

<div class="text-center text-white mt-[80px] px-4">
    <h1 class="text-3xl md:text-5xl font-bold drop-shadow-lg">
        REEDEM KODE ANDA DISINI
    </h1>
</div>

<div class="flex items-center justify-center flex-1 p-4">

<form method="post"
      class="flex flex-col gap-6 bg-white/90 px-10 py-8 rounded-2xl shadow-xl w-full max-w-md">

    <h2 class="text-2xl font-bold text-center text-gray-800">
        Kupon
    </h2>

    <input type="text" 
           name="nama" 
           placeholder="Nama Siswa"
           required
           class="w-full bg-gray-200 px-4 py-2 rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

    <div class="relative">
        <input type="text" 
               name="kupon" 
               placeholder="Kode Kupon"
               required
               class="w-full bg-gray-200 px-4 py-2 pr-28 rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

            <button type="submit"
                    name="submit"
                    class="absolute right-1 top-1/2 -translate-y-1/2 bg-[#3CC448] hover:bg-[#38AF43] text-white px-4 py-1 rounded-full text-sm transition">
                Redeem
            </button>
    </div>

    <div class="flex justify-center">
        <button type="reset"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-full transition">
            Batal
        </button>
    </div>

</form>

</div>

</div>

</body>
</html>