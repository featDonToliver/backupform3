<?php
session_start();

$showSuccessModal = false;
$namaUser = "";

// Cek jika user sudah login kupon via session
if (isset($_SESSION['kupon']) && $_SESSION['kupon'] === true && isset($_SESSION['nama'])) {
    $namaUser = htmlspecialchars($_SESSION['nama']);
    $showSuccessModal = true;
} else {
    // Jika akses langsung tanpa submit, arahkan ke kupon.php
    header("Location: kupon.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kupon Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-800">
    <div class="relative h-screen bg-cover bg-center" style="background-image: url(gambar/kuponjumbotron.jpg);">
        
        <?php if ($showSuccessModal): ?>
        <div class="absolute inset-0 bg-black/60 flex items-center justify-center p-4 backdrop-blur-sm">
            <div class="bg-white w-full max-w-[600px] rounded-2xl shadow-2xl overflow-hidden animate-pop-in">
                
                <div class="bg-green-500 text-center py-8">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-green-500 text-3xl font-bold">✔</span>
                    </div>
                    <p class="mt-2 text-white font-bold text-lg uppercase tracking-widest">Diterima!</p>
                </div>

                <div class="p-8 text-sm text-gray-700 leading-relaxed text-center">
                    <p class="text-blue-600 font-bold mb-3 text-lg">Selamat, <?= $namaUser; ?>!</p>

                    <p>
                        Kami mengucapkan selamat kepada <b><?= $namaUser; ?></b> karena telah berhasil
                        meredem kode promo. Anda berhak mendapatkan potongan harga sebesar <b>Rp1.000.000</b>.
                    </p>

                    <div class="mt-8">
                        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-md inline-block">
                           KEMBALI
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <style>
        @keyframes pop-in {
            0% { transform: scale(0.95); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-pop-in { animation: pop-in 0.3s ease-out forwards; }
    </style>
</body>
</html>