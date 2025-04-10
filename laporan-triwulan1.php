<?php
include '../../koneksi.php'; // pastikan koneksi tersedia
include '../lap_bulanan/fungsi/query.php';  // pastikan fungsi getLaporanZakatMaalPerorangan tersedia

$tahun = isset($_POST['tahun']) ? mysqli_real_escape_string($koneksi, $_POST['tahun']) : date('Y');
$bulan_awal = 1; // Januari
$bulan_akhir = 3; // Maret
$bulan_array = range($bulan_awal, $bulan_akhir);

$resultData = [];

foreach ($bulan_array as $b) {
    $res = getLaporanZakatMaalPerorangan($koneksi, $b, $tahun);
    while ($row = mysqli_fetch_assoc($res)) {
        $resultData[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container printable">
        <strong class="mb-3"><strong>LAPORAN ZAKAT MAAL PERORANGAN VIA UPZ (JANUARI - MARET <?= $tahun ?>)</strong></strong>

        <div class="table-responsive">
            <table class="table table-bordered" style="border: 1px solid black;">
                <thead>
                    <tr style="border: 1px solid black;">
                        <th style="border: 1px solid black;">No.</th>
                        <th style="border: 1px solid black;">Tanggal</th>
                        <th style="border: 1px solid black;">Nama Muzaki</th>
                        <th style="border: 1px solid black;">Status Muzaki</th>
                        <th style="border: 1px solid black;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; $total = 0;
                    if (!empty($resultData)):
                        usort($resultData, function ($a, $b) {
                            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
                        });
                        foreach ($resultData as $data):
                            $total += $data['total_jumlah'];
                    ?>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;"><?= $no++ ?></td>
                        <td style="border: 1px solid black;"><?= date('d/m/Y', strtotime($data['tanggal'])) ?></td>
                        <td style="border: 1px solid black;"><?= $data['nama_muzaki'] ?></td>
                        <td style="border: 1px solid black;"><?= $data['status_muzaki'] ?></td>
                        <td style="border: 1px solid black;"><?= number_format($data['total_jumlah'], 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr style="border: 1px solid black; font-weight: bold;">
                        <td style="border: 1px solid black;" colspan="4">Total</td>
                        <td style="border: 1px solid black;"><?= number_format($total, 2, ',', '.') ?></td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; border: 1px solid black;">
                            Tidak ada data zakat maal perorangan via UPZ untuk triwulan ini.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="../timeout.js"></script>
</body>
</html>
