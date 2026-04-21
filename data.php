<?php
include 'koneksi.php';
include 'proses.php';
include 'simpan.php';
include 'toast.php';

$search = $_GET['search'] ?? '';

if(!empty($search)) {
    $result = mysqli_query($conn,"SELECT * FROM form_p WHERE nama_lengkap LIKE '%$search%' OR no_pendaftaran LIKE '%$search%'");
} else {
    $result = mysqli_query($conn,"SELECT * FROM form_p");
}
 
/* data chart */
$query = mysqli_query($conn,"
    SELECT asal, COUNT(*) as total 
    FROM form_p 
    GROUP BY asal
");

$labelsAsal = [];
$dataAsal = [];
$totalAsal = 0;
$rowsAsal = [];

while($row = mysqli_fetch_assoc($query)){
    $totalAsal += $row['total'];
    $rowsAsal[] = $row;
}

foreach($rowsAsal as $r){
    $labelsAsal[] = $r['asal'];
    $persen = $totalAsal > 0 ? ($r['total'] / $totalAsal) * 100 : 0;
    $dataAsal[] = round($persen, 1);
}

$query = mysqli_query($conn,"
    SELECT jurusan, COUNT(*) as total 
    FROM form_p 
    GROUP BY jurusan
");

$labelsJurusan = [];
$dataJurusan = [];
$totalJurusan = 0;
$rowsJurusan = [];

while($row = mysqli_fetch_assoc($query)){
    $totalJurusan += $row['total'];
    $rowsJurusan[] = $row;
}

foreach($rowsJurusan as $r){
    $labelsJurusan[] = $r['jurusan'];
    $persen = $totalJurusan > 0 ? ($r['total'] / $totalJurusan) * 100 : 0;
    $dataJurusan[] = round($persen, 1);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Data Siswa</title>
 
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
<body class="bg-[linear-gradient(to_bottom,rgba(25,118,210,0.6),rgba(21,101,192,0.6),rgba(13,71,161,0.6)),url('gambar/background_ti.jpg')] bg-cover bg-center bg-no-repeat font-poppins">
<div class="mt-5 p-2">

    <div class="max-w-7xl mx-auto grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-3"> 
            <div class="bg-white rounded-3xl shadow-lg p-6 h-full">
                <div class="flex flex-col items-center text-center">

                    <img src="https://ui-avatars.com/api/?name=Admin&background=1976d2&color=fff"
                         class="w-24 h-24 rounded-full mt-6 mb-4">

                    <h2 class="text-2xl font-bold text-slate-800">Admin Panel</h2>
                    <p class="text-slate-500 text-sm">Dashboard PPDB</p>

                    <div class="w-full mt-6 space-y-3">
                        <a href="index.php"
                           class="my-[20px]  block w-full no-underline bg-blue-600 hover:bg-[#0d47a1] font-poppins font-bold text-white px-5 py-2 rounded-[7px] transition duration-300">
                           Tambah Pendaftar
                        </a>

                        <a href="index.php"
                           class="my-[20px] block w-full no-underline bg-red-600 hover:bg-red-700 font-poppins font-bold text-white py-3 px-5 rounded-[7px] transition duration-300">
                           Logout
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-9 space-y-6"> 
            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-3xl p-6 shadow-lg">
                    <h3 class="text-sm opacity-90">Total Pendaftar</h3>
                    <h1 class="text-4xl font-bold mt-2"><?= $totalData['total']; ?></h1>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-lg">
                    <h3 class="text-slate-500 text-sm">Laki-Laki</h3>
                    <h1 class="text-3xl font-bold text-blue-600 mt-2"><?= $dataLaki['total']; ?></h1>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-lg">
                    <h3 class="text-slate-500 text-sm">Perempuan</h3>
                    <h1 class="text-3xl font-bold text-pink-500 mt-2"><?= $dataPerempuan['total']; ?></h1>
                </div>

            </div>


            <!-- chart -->
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">

    <div class="bg-white rounded-3xl p-6 shadow-lg flex flex-col items-center">
        <h2 class="text-lg font-bold mb-4 text-center">
            Demografi Pendaftar
        </h2>

        <div class="w-[220px] h-[220px]">
            <canvas id="asalChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-lg flex flex-col items-center">
        <h2 class="text-lg font-bold mb-4 text-center">
            Data Jurusan
        </h2>

        <div class="w-[220px] h-[220px]">
            <canvas id="jurusanChart"></canvas>
        </div>
    </div>

</div>
               
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('jurusanChart'), {
    type: 'pie',
    data: {
        labels: <?= json_encode($labelsJurusan); ?>,
        datasets: [{
            label: 'Persentase Jurusan',
            data: <?= json_encode($dataJurusan); ?>,
            backgroundColor: [
                '#3B82F6',
                '#10B981',
                '#F59E0B',
                '#EF4444',
                '#8B5CF6',
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw + '%';
                    }
                }
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('asalChart'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($labelsAsal); ?>,
        datasets: [{
            data: <?= json_encode($dataAsal); ?>,
            backgroundColor: [
                '#3B82F6',
                '#10B981',
                '#F59E0B',
                '#EF4444',
                '#8B5CF6',
                '#14B8A6',
                '#26c0fd',
            ]
        }]
    },
   options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw + '%';
                    }
                }
            }
        }
    }
});
</script>
                </div>

            </div>

        </div>
</div>


<div class="w-[90%] mx-auto my-[40px] bg-white p-[30px] rounded-[15px] shadow-[0_10px_30px_rgba(0,0,0,0.05)] overflow-x-auto"> 
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-poppins font-bold text-[28px] text-[#0d47a1]">
            Data Pendaftar Masuk
        </h2>

        <form method="GET">
            <div class="flex gap-2">
            <input class="w-full px-4 py-3 border border-gray-300 rounded-3xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" type="text" name="search" placeholder="Cari pendaftar...">
            <button type="submit" class="bg-[#1215c3] hover:bg-[#0d47a1] text-white px-4 py-2 rounded-[20px] transition duration-300">
                Cari
            </button>
            </div>
        </form>
    </div>

    <table class="w-full min-w-[1200px] border-collapse">
        <thead>
            <tr>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins">No</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Nama / No.Daftar</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Tanggal Lahir</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Jenis Kelamin</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Email</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Asal</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Alamat</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Jurusan</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">No. HP</th>
                <th class="text-left p-[15px] bg-[#e3f2fd] text-[#0d47a1] font-poppins font-bold">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $no=1;
            while($row=mysqli_fetch_assoc($result)){
            ?>
            <tr class="hover:bg-[#fafafa] transition duration-200">
                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $no++; ?></td>

                <td class="p-[15px] border-b border-[#eee] text-[#444]">
                    <b><?= $row['nama_lengkap']; ?></b><br>
                    <small style="color:#888"><?= $row['no_pendaftaran']; ?></small>
                </td>

                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $row['tt_lahir']; ?></td>
                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $row['jenis_kel']; ?></td>
                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $row['email']; ?></td>
                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $row['asal']; ?></td>

                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $row['alamat']; ?></td>

                <td class="p-[15px] border-b border-[#eee] text-[#444]">
                    <span class="badge bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                        <?= $row['jurusan']; ?>
                    </span>
                </td>

                <td class="p-[15px] border-b border-[#eee] text-[#444]"><?= $row['no_hp_wa']; ?></td>

                <td class="p-[15px] border-b border-[#eee] text-[#444] space-x-2">
                    <a href="#"
                        onclick="openEditModal(
                        '<?= $row['no_pendaftaran']; ?>',
                        '<?= $row['nama_lengkap']; ?>',
                        '<?= $row['tt_lahir']; ?>',
                        '<?= $row['jenis_kel']; ?>',
                        '<?= $row['jurusan']; ?>',
                        '<?= $row['email']; ?>',
                        '<?= $row['asal']; ?>',
                        '<?= $row['alamat']; ?>',
                        '<?= $row['no_hp_wa']; ?>')"
                        class="action-link text-edit text-blue-600 hover:text-blue-800 font-medium">
                        Edit
                    </a>

                    <a href="#"
                        onclick="openModal(<?= $row['id']; ?>)"
                        class="action-link text-del text-red-500 hover:text-red-700 font-medium">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="modalEdit" style="display : none" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="no-scrollbar overflow-y-auto max-w-2xl w-full bg-white rounded-3xl shadow-lg p-6 max-h-[65vh] overflow-y-auto">
        <div class="form-header">
            <h3 style="font-size: 20px;"><b>Edit Data Siswa</b></h3>
            <small style="font-size: 15px;">UBAH DATA DENGAN TELITI</small>
        </div>
        
        <form method="POST">
            <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">No Pendaftaran(TIDAK BISA DIUBAH)</label>

                <input type="hidden"
                name="no_lama" 
                id="edit_no_lama"
                value="<?= $editData['no_pendaftaran'] ?? ''; ?>">

                <input readonly class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                type="text" 
                name="no_pendaftaran"
                id="edit_no"
                value="<?= $editData['no_pendaftaran'] ?? ''; ?>">
            </div>

            <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Nama Lengkap</label>

                <input type="text" 
                name="nama_lengkap" 
                id="edit_nama"
                class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                value="<?= $editData['nama_lengkap'] ?? ''; ?>" 
                style="font-size: 15px;">
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                <div style="flex:1">
                    <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Tanggal Lahir</label>

                    <input type="date" 
                    name="tt_lahir"
                    id="edit_lahir"
                    class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                    value="<?= $editData['tt_lahir'] ?? ''; ?>" 
                    style="font-size: 15px;">
                </div>

                <div style="flex:1">
                    <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Jenis Kelamin</label>

                    <select name="jenis_kel"
                    id="edit_kel"
                    class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                    style="font-size: 15px;">

                        <option value="Laki-Laki" <?= ($editData['jenis_kel'] ?? '')=="Laki-Laki"?"selected":""; ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= ($editData['jenis_kel'] ?? '')=="Perempuan"?"selected":""; ?>>Perempuan</option>

                    </select>
                </div>
            </div>

            <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Jurusan</label>
                <select name="jurusan"
                id="edit_jurusan"
                class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                style="font-size: 12px;">

                    <option value="RPL" <?= ($editData['jurusan'] ?? '')=="RPL"?"selected":""; ?>>RPL</option>
                    <option value="DKV" <?= ($editData['jurusan'] ?? '')=="DKV"?"selected":""; ?>>DKV</option>
                    <option value="TKJ" <?= ($editData['jurusan'] ?? '')=="TKJ"?"selected":""; ?>>TKJ</option>
                    <option value="BD" <?= ($editData['jurusan'] ?? '')=="BD"?"selected":""; ?>>BD</option>
                    <option value="AN" <?= ($editData['jurusan'] ?? '')=="AN"?"selected":""; ?>>AN</option>

                </select>
            </div>

             <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Email</label>
                <input type="email"
                name="email"
                id="edit_email"
                class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                value="<?= $editData['email'] ?? ''; ?>">
            </div>

                    <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Asal</label>
                <input type="text"
                name="asal"
                id="edit_asal"
                class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                value="<?= $editData['asal'] ?? ''; ?>">
            </div>


            <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">Alamat</label>
                <input type="text"
                name="alamat"
                id="edit_alamat"
                class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                value="<?= $editData['alamat'] ?? ''; ?>">
            </div>

    
            <div class="mb-[15px]">
                <label class="block text-[0.85rem] text-[var(--text-grey)] mb-[5px] text-[13px]">No HP / WA</label>
                <input type="text"
                name="no_hp_wa"
                id="edit_hp"
                class="w-full p-3 bg-[#f9f9f9] border border-[#eee] rounded-[25px] text-[0.9rem] transition duration-300"
                value="<?= $editData['no_hp_wa'] ?? ''; ?>">
            </div>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" name="update" class="no-underline bg-[#1215c3] hover:bg-[#0d47a1] font-poppins font-bold text-white px-5 py-2 rounded-[20px] transition duration-300">
                Simpan
                </button>

                <button class="bg-[#FF0000] hover:bg-[#d32f2f] transition duration-300 rounded-[20px]">
                    <a href="data.php" class="no-underline  font-poppins font-bold text-white px-5 py-2 rounded-[12px] transition duration-300">
                        Batal
                    </a>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalHapus" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
        <h3>Konfirmasi Hapus</h3>
        <p><b>YAKIN</b> ingin menghapus data ini?</p>

        <div class="mt-[20px] flex justify-center items-center gap-[10px]">
            <button class=" bg-[#FF0000] font-poppins font-bold hover:bg-[#d32f2f] text-white px-5 py-2 rounded-[12px] transition duration-300"><a class="no-underline" id="confirmDelete" href="#">Hapus</a></button>
            <button onclick="closeModal()" class="bg-[#1215c3] hover:bg-[#0d47a1] font-poppins font-bold text-white px-5 py-2 rounded-[12px] transition duration-300">Batal</button>
        </div>
    </div>
</div>
<script>
function openEditModal(no,nama,lahir,kel,jur,email,asal,alamat,hp){
 console.log("Jenis Kelamin:", kel);

document.getElementById("modalEdit").style.display="flex";

document.body.classList.add("overflow-hidden");
document.documentElement.classList.add("overflow-hidden");


document.getElementById("edit_no_lama").value=no;
document.getElementById("edit_no").value=no;
document.getElementById("edit_nama").value=nama;
document.getElementById("edit_lahir").value=lahir;
document.getElementById("edit_kel").value=kel;
document.getElementById("edit_email").value=email;
document.getElementById("edit_jurusan").value=jur;
document.getElementById("edit_asal").value=asal;
document.getElementById("edit_alamat").value=alamat;
document.getElementById("edit_hp").value=hp;

}

function closeEditModal(){
document.getElementById("modalEdit").style.display="none";
}

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