
<?php
$pesan = null;
if(isset($_GET['success'])) {
    $pesan = $_GET['success'];
} elseif(isset($_SESSION['success'])) {
    $pesan = $_SESSION['success'];
    unset($_SESSION['success']);
}

if($pesan){ ?>
<div id="notif"
class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-[9999] opacity-100 transition duration-500">
    <?= htmlspecialchars($pesan); ?>
</div>

<script>
    const notif = document.getElementById('notif');
    if(notif){
        setTimeout(() => {
            notif.style.opacity = '0';
            notif.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notif.remove();
                const url = new URL(window.location);
                url.searchParams.delete('success');
                window.history.replaceState({}, '', url);
            }, 500);
        }, 3000);
    }
</script>
<?php } ?>