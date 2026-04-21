<?php
// Jangan lupa session_start() harus ada di file utama sebelum include ini

// Ambil pesan sukses
$pesan = $_GET['success'] ?? $_SESSION['success'] ?? null;
if (isset($_SESSION['success'])) unset($_SESSION['success']);

// Ambil pesan error
$pesan_error = $_GET['error'] ?? $_SESSION['error'] ?? null;
if (isset($_SESSION['error'])) unset($_SESSION['error']);
?>

<?php if($pesan_error): ?>
<div id="notif-error"
     class="fixed top-5 right-5 bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl z-[9999] flex items-center gap-3 transform translate-x-full transition duration-500">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span class="font-semibold"><?= htmlspecialchars($pesan_error); ?></span>
</div>
<script>
    const elError = document.getElementById('notif-error');
    setTimeout(() => { elError.classList.remove('translate-x-full'); elError.classList.add('translate-x-0'); }, 100);
    setTimeout(() => {
        elError.style.opacity = '0';
        elError.style.transform = 'translateX(100%)';
        setTimeout(() => { 
            elError.remove();
            clearUrlParam('error');
        }, 500);
    }, 3000);
</script>
<?php endif; ?>

<?php if($pesan): ?>
<div id="notif-success"
     class="fixed top-5 right-5 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg z-[9999] flex items-center gap-3 transform translate-x-full transition duration-500">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span class="font-semibold"><?= htmlspecialchars($pesan); ?></span>
</div>
<script>
    const elSuccess = document.getElementById('notif-success');
    setTimeout(() => { elSuccess.classList.remove('translate-x-full'); elSuccess.classList.add('translate-x-0'); }, 100);
    setTimeout(() => {
        elSuccess.style.opacity = '0';
        elSuccess.style.transform = 'translateX(100%)';
        setTimeout(() => { 
            elSuccess.remove();
            clearUrlParam('success');
        }, 500);
    }, 3000);
</script>
<?php endif; ?>

<script>
// Fungsi tunggal untuk membersihkan URL
function clearUrlParam(param) {
    const url = new URL(window.location);
    if(url.searchParams.has(param)) {
        url.searchParams.delete(param);
        window.history.replaceState({}, '', url);
    }
}
</script>