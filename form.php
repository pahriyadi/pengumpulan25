<?php
$filter_nama = isset($_POST['nama_muzaki']) ? $_POST['nama_muzaki'] : '';
$filter_status = isset($_POST['status_muzaki']) ? $_POST['status_muzaki'] : '';
$tahun = isset($_POST['tahun']) ? mysqli_real_escape_string($koneksi, $_POST['tahun']) : date('Y');
$bulan_array = [1, 2, 3]; // Januari - Maret

$dataMuzaki = [];

foreach ($bulan_array as $b) {
    $result = $fungsiLaporan($koneksi, $b, $tahun); // Fungsi dinamis dari file utama

    while ($row = mysqli_fetch_assoc($result)) {
        if (
            ($filter_nama === '' || stripos($row['nama_muzaki'], $filter_nama) !== false) &&
            ($filter_status === '' || stripos($row['status_muzaki'], $filter_status) !== false)
        ) {
            $nama = $row['nama_muzaki'];
            $status = $row['status_muzaki'];
            $jumlah = $row['total_jumlah'];

            if (!isset($dataMuzaki[$nama])) {
                $dataMuzaki[$nama] = [
                    'status' => $status,
                    'januari' => 0,
                    'februari' => 0,
                    'maret' => 0
                ];
            }

            if ($b == 1) $dataMuzaki[$nama]['januari'] += $jumlah;
            if ($b == 2) $dataMuzaki[$nama]['februari'] += $jumlah;
            if ($b == 3) $dataMuzaki[$nama]['maret'] += $jumlah;
        }
    }
}
?>

<!-- Tampilan tabel tetap sama seperti sebelumnya -->


<!DOCTYPE html>
<html lang="id">
<body>
    <div class="container printable">
    <strong><?= $judulLaporan ?></strong>

        <div class="table-responsive">
            <table class="table table-bordered" style="border: 1px solid black;">
                <thead>
                    <tr style="border: 1px solid black; text-align: center;">
                        <th style="border: 1px solid black;">No.</th>
                        <th style="border: 1px solid black;">Nama Muzaki</th>
                        <th style="border: 1px solid black;">Status Muzaki</th>
                        <th style="border: 1px solid black;">Januari</th>
                        <th style="border: 1px solid black;">Februari</th>
                        <th style="border: 1px solid black;">Maret</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if (!empty($dataMuzaki)):
                        ksort($dataMuzaki); // urutkan berdasarkan nama
                        foreach ($dataMuzaki as $nama => $info):
                    ?>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;"><?= $no++ ?></td>
                        <td style="border: 1px solid black;"><?= htmlspecialchars($nama) ?></td>
                        <td style="border: 1px solid black;"><?= htmlspecialchars($info['status']) ?></td>
                        <td style="border: 1px solid black;"><?= number_format($info['januari'], 2, ',', '.') ?></td>
                        <td style="border: 1px solid black;"><?= number_format($info['februari'], 2, ',', '.') ?></td>
                        <td style="border: 1px solid black;"><?= number_format($info['maret'], 2, ',', '.') ?></td>
                    </tr>
                    <?php 
                        endforeach;
                    else: 
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; border: 1px solid black;">
                            Tidak ada data untuk triwulan ini.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>