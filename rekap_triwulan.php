<?php
include '../../koneksi.php';
include 'navbar.php';
include '../admin/lap_triwulan/aset/pencarian.php';
include '../admin/lap_bulanan/aset/header.php';
include '../admin/lap_bulanan/fungsi/query.php';

// Ambil tahun dari POST atau default tahun sekarang
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : date('Y');
?>

<div class="printable">
    <div class="container">

        <div class="text-center">
            <h1>LAPORAN PENERIMAAN TRIWULAN 1 (JANUARI - MARET) TAHUN <?= $tahun; ?></h1>
        </div>

        <?php
        include '../admin/lap_triwulan/laporan-triwulan1.php';
        ?>

    </div>
</div>

<?php mysqli_close($koneksi); ?>