<?php
include 'login.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[linear-gradient(to_bottom,rgba(25,118,210,0.6),rgba(21,101,192,0.6),rgba(13,71,161,0.6)),url('gambar/background_ti.jpg')] bg-cover bg-center bg-no-repeat min-h-screen relative font-poppins">
    <div class="absolute inset-0 bg-black/30"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4">

        <form method="post"
              class="bg-white/90 backdrop-blur-sm flex flex-col md:flex-row items-center gap-8 p-6 md:p-10 rounded-2xl shadow-2xl max-w-3xl w-full">

            <div class="flex-shrink-0 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Login Admin</h2>

                <div class="w-32 h-32 md:w-40 md:h-40 mx-auto">
                    <img src="gambar/person-icon.png" alt="User Icon" class="w-full h-auto">
                </div>
            </div>

            <div class="flex flex-col w-full gap-4">

                <input type="email" 
                       name="email" 
                       placeholder="Email"
                       required
                       class="w-full bg-gray-200 px-4 py-2 rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                <input type="password" 
                       name="password" 
                       placeholder="Password"
                       required
                       class="w-full bg-gray-200 px-4 py-2 rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                <div class="flex gap-3 mt-2">
                    <button type="reset" 
                            class="flex-1 bg-[#FF4B41] hover:bg-red-600 text-white font-semibold py-2 rounded-full shadow transition">
                        Batal
                    </button>

                    <button type="submit" 
                            name="login" 
                            class="flex-1 bg-[#1E88E5] hover:bg-blue-700 text-white font-semibold py-2 rounded-full shadow transition">
                        Login
                    </button>
                </div>

            </div>

        </form>

    </div>

</body>
</html>