<?php
session_start();
include 'koneksi.php';
include 'simpan.php';
include 'toast.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PPDB SMK TI Bali Global</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a9e7d94f0c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;  
            scrollbar-width: none;    
        }
    </style>
</head>

<body class="font-poppins bg-gradient-to-r from-[#1976d2] via-[#1565c0] to-[#0d47a1] min-h-screen">
    <nav class="w-full bg-[#001E3C] px-3 py-3 flex items-center shadow-[0_4px_15px_rgba(0,0,0,0.05)] fixed top-0 z-[100]">
        <div class="navbar-header flex items-center mr-auto gap-10px">
            <img src="gambar/smkti logo.png" alt="Logo SMK TI Bali Global" class="h-10 w-auto">
            <h1 class="text-[1.1rem] text-yellow-300 font-light">SMK TI Bali Global Denpasar</h1>
        </div>
        <div>
        <a href="kupon.php" class="btn-login no-underline bg-[#EDB528] hover:bg-[var(--dark-blue)] text-white px-5 py-2 mr-4 rounded-[20px] cursor-pointer transition duration-300">Kupon</a>
</div>
        <a href="form.php" class="btn-Kupon no-underline bg-[#1215c3] hover:bg-[var(--dark-blue)] text-white px-6 py-2 rounded-[20px] cursor-pointer transition duration-300">Login</a>

    </nav>

    <main class="page-content w-full min-h-screen flex justify-center items-center pt-[120px] pr-[20px] pl-[20px] pb-[60px]">
        <div class="card-container w-full max-w-[1000px] aspect-[15/8] flex rounded-[25px] overflow-hidden bg-white shadow-[0_25px_60px_rgba(0,0,0,0.15)] animate-[slideUp_0.8s_ease-out]">
            <div class="card-left flex-[0.8] overflow-hidden">
                <img src="gambar/jumbotron.jpeg" alt="SPMB" class="w-full h-full object-cover object-center block ">
            </div>
           

           <div class="flex-1 ml-2 p-4 overflow-y-auto no-scrollbar bg-white rounded-r-2xl">

    <div class="mt-2.5 mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Registrasi Siswa</h2>
        <small class="text-gray-500">Isi data diri dengan benar</small>
    </div>

    <form method="POST" class="space-y-5">

        <div class="mt-4">
            <label class="block mb-1 text-sm text-gray-600">Nama Lengkap</label>
            <input required type="text" name="nama_lengkap" minlength="5" maxlength="50"
                placeholder="Nama Lengkap"
                class="w-full px-4 py-3 border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block mb-1 text-sm text-gray-600">Tanggal Lahir</label>
                <input required type="date" name="tt_lahir"
                    placeholder="Tanggal Lahir"
                    class="w-full px-4 py-3 border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex-1">
                <label class="block mb-1 text-sm text-gray-600">Jenis Kelamin</label>
                <div class="flex gap-5 items-center">

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input title="Laki-Laki" required type="radio" name="jenis_kel" value="Laki-Laki">
                        <i title="Laki-Laki" class="fa-solid fa-mars text-blue-600 text-3xl"></i>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input title="Perempuan" required type="radio" name="jenis_kel" value="Perempuan">
                        <i title="Perempuan" class="fa-solid fa-venus text-pink-500 text-3xl"></i>
                    </label>

                </div>
            </div>
        </div>

        <div>
            <label class="block mb-1 text-sm text-gray-600">Email</label>
            <input required type="email" name="email" maxlength="50"
                placeholder="Email"
                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>


        <div>
            <label class="block mb-1 text-sm text-gray-600">Alamat Domisili</label>
            <input required type="text" name="alamat" maxlength="30"
                placeholder="Alamat Domisili"
                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm text-gray-600">Asal</label>
            <input required type="text" name="asal" maxlength="30"
                placeholder="Asal"
                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm text-gray-600">No. HP / WhatsApp</label>
            <input required type="text" name="no_hp_wa" maxlength="15"
                placeholder="No. HP / WhatsApp"
                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm text-gray-600">Pilihan Jurusan</label>
            <select required name="jurusan"
                class="w-full px-4 py-3 border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="RPL">RPL - Rekayasa Perangkat Lunak</option>
                <option value="DKV">DKV - Desain Komunikasi Visual</option>
                <option value="TKJ">TKJ - Teknik Komputer Jaringan</option>
                <option value="BD">BD - Bisnis Digital</option>
                <option value="AN">AN - Animasi</option>
            </select>
        </div>

        <button type="submit" name="simpan"
            class="w-full py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition">
            DAFTAR SEKARANG
        </button>

    </form>
</div>

    </main>

</body>
</html>