<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Triwulan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" href="\pengumpulan\admin\imgs\lobaz.png" type="image/x-icon">


  <style>
    body {
      width: 100%;


    }


    table {
      border-collapse: collapse;
      width: 100%;
      font-size: 14px;

    }

    th,
    td {
      text-align: center;
      padding: 10px;
      text-transform: uppercase;
    }

    th {
      background-color: #fff;
      color: black;
      text-transform: uppercase;
    }

    td {
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    .action {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .action a {
      color: #fff;
      margin-right: 5px;
      padding: 5px 10px;
      border-radius: 5px;
      text-decoration: none;
    }

    .action a.edit {
      background-color: #5cb85c;
    }

    .action a.delete {
      background-color: #d9534f;
    }

    H1 {
      text-align: center;
      font-size: 20px;
      padding-bottom: 0px;
      text-transform: uppercase;
    }

    p {
      text-align: center;
      font-size: 13px;
      padding-bottom: 0px;
    }

    .ttd {
      margin-top: 20px;
      text-align: right;
      font-size: 15px;
    }

    .ttd p {
      margin-bottom: 0.5px;
      font-weight: bold;
    }

    .tebal {
      font-weight: bold;
    }

    .ttd {
      margin-top: 20px;
      font-size: 15px;
      align-items: center;
    }

    .ttd p {
      margin-bottom: 0.5px;
      font-weight: bold;
      align-items: center;
    }


    .hidden-button {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    @media print {

      /* CSS untuk bagian yang akan diprint */
      body {
        font-size: 14px;
        width: 100%;
      }

      .printable {
        display: block;
      }

      .non-printable {
        display: none;
      }

      .card-header {
        display: none;
      }

      .card-footer {
        display: none;
      }

      /* Aturan untuk mode lanskap */
      @page {
        size: portrait;
      }
    }
  </style>
</head>

<div class="non-printable">
  <?php include 'navbar.php'; ?>
</div>

<body>
  <div class="container">

    <div class="non-printable">
      <div class="card"> <!-- ini adalah walan header cari -->
        <div class="card-header">Cari Data</div>
        <div class="card-body">
          <form method="GET" action="">
            <div class="form-group"
              style="width: 100%; margin: 0 auto; display: flex; gap:5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">

              <select name="nama_muzaki" class="form-control">
                <option value="">-- Pilih Nama Muzaki --</option>
                <?php
          // Koneksi ke database (ganti dengan informasi koneksi sesuai dengan database Anda)
          include 'koneksi.php';

          // Query untuk mengambil data nama muzaki dari tabel (ganti dengan query sesuai dengan struktur tabel Anda)
          $query = "SELECT nama_muzaki FROM zakat_infaq GROUP BY nomor_induk_muzaki";
          $result = mysqli_query($koneksi, $query);

          // Loop untuk memasukkan data nama muzaki ke dalam elemen option
          while ($row = mysqli_fetch_assoc($result)) {
            $nama_muzaki = $row['nama_muzaki'];
            echo '<option value="' . $nama_muzaki . '">' . $nama_muzaki . '</option>';
          }

          // Tutup koneksi ke database
          mysqli_close($koneksi);
          ?>
              </select>

              <select name="status_muzaki" class="form-control">
                <option value="">-- Pilih status muzaki --</option>
                <option value="Perorangan">Perorangan</option>
                <option value="Dinas Instansi">Dinas Instansi</option>
                <option value="BANK">BANK</option>
                <option value="BUMN">BUMN</option>
                <option value="BUMD">BUMD</option>
                <option value="Sekolah">Sekolah</option>
                <option value="A/N">A/N</option>
              </select>

              <select name="pembayaran" class="form-control">
                <option value="">-- Pilih Pembayaran --</option>
                <option value="zakat">zakat</option>
                <option value="infaq dan shadaqoh">infaq dan shadaqoh</option>
              </select>

              <select name="metode_bayar" id="metode_bayar" class="form-control">
                <option value="">-- Pilih metode bayar --</option>
                <option value="transfer bank">Tranfer Bank</option>
                <option value="tunai">Tunai</option>
              </select>

              <input type="number" name="tahun" id="tahun" class="form-control" min="2000"
                value="<?php echo date('Y'); ?>">

              <button type="submit" class="btn btn-primary">Filter</button>

            </div>
          </form>
        </div>
        <div class="card-footer"></div>
      </div><br>
      <!-- btas foother cari ---------------->
    </div>



    <div class="card">
      <div class="card-header">Laporan Triwulan 4 (Empat)</div>
      <div class="card-body">
        <h1>BAZNAS KABUPATEN SUMBAWA</h1>
        <?php
          $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
          $nama_muzaki = isset($_GET['nama_muzaki']) ? $_GET['nama_muzaki'] : '';
          $status_muzaki = isset($_GET['status_muzaki']) ? $_GET['status_muzaki'] : '';
          $pembayaran = isset($_GET['pembayaran']) ? $_GET['pembayaran'] : '';
          $metode_bayar = isset($_GET['metode_bayar']) ? $_GET['metode_bayar'] : '';

          if (empty($pembayaran)) {
            echo '<h1>LAPORAN TRIWULAN IV ZAKAT, INFAQ DAN SHADAQOH TAHUN ' . $tahun . '</h1>';
        } else {
            echo '<h1>LAPORAN TRIWULAN IV ' . $pembayaran . ' TAHUN ' . $tahun . '</h1>';
        }
        
    ?>


        <p>Hasil filter berdasarkan :
          <?php echo $pembayaran; ?> --
          <?php echo $status_muzaki; ?> --
          <?php echo $metode_bayar; ?> --
          <?php echo $nama_muzaki; ?>
        </p>

        <div class="table-responsive">
          <table border=1>
            <tr>
              <th>No</th>
              <th>Nama Muzaki</th>
              <th>Oktober</th>
              <th>November</th>
              <th>Desember</th>
              <th>Jumlah</th>
            </tr>

            <?php
      include 'koneksi.php';


      // Deklarasi variabel untuk menyimpan nilai tahun
      $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
      $nama_muzaki = isset($_GET['nama_muzaki']) ? $_GET['nama_muzaki'] : '';
      $status_muzaki = isset($_GET['status_muzaki']) ? $_GET['status_muzaki'] : '';
      $pembayaran = isset($_GET['pembayaran']) ? $_GET['pembayaran'] : '';
      $metode_bayar = isset($_GET['metode_bayar']) ? $_GET['metode_bayar'] : '';

      $query_muzaki = "SELECT DISTINCT nomor_induk_muzaki FROM zakat_infaq WHERE YEAR(tanggal) = $tahun AND (pembayaran = 'zakat' OR pembayaran = 'infaq dan shadaqoh')";

      // Tambahkan kondisi pencarian berdasarkan status_muzaki jika dipilih
      if (!empty($status_muzaki)) {
        $query_muzaki .= " AND status_muzaki = '$status_muzaki'";
      }

      if (!empty($pembayaran)) {
        $query_muzaki .= " AND pembayaran = '$pembayaran'";
      }

      if (!empty($nama_muzaki)) {
        $query_muzaki .= " AND nama_muzaki = '$nama_muzaki'";
      }

      if (!empty($metode_bayar)) {
        $query_muzaki .= " AND metode_bayar = '$metode_bayar'";
      }


    // Tambahkan kondisi untuk memeriksa pembayaran pada bulan Januari, Februari, dan Maret
    // jika muzaki tidak melakukan pembayaran selama 3 bulan maka tidak di tampilkan datanya
    $query_muzaki .= " AND (MONTH(tanggal) = 10 OR MONTH(tanggal) = 11 OR MONTH(tanggal) = 12) ";
    
    $query_muzaki .= " ORDER BY nomor_induk_muzaki";

      $result_muzaki = mysqli_query($koneksi, $query_muzaki);

      // Inisialisasi total bulanan dan total jumlah
      $total_bulanan = array();
      for ($i = 1; $i <= 12; $i++) {
        $total_bulanan[$i] = 0;
      }
      $total_jumlah = 0;
      $total_semua = 0;

      // Loop untuk menampilkan data muzaki
      $no = 1;
      while ($muzaki = mysqli_fetch_array($result_muzaki)) {
        // Query untuk mengambil nama muzaki
        $query_nama = "SELECT nama_muzaki FROM zakat_infaq WHERE nomor_induk_muzaki = '" . $muzaki['nomor_induk_muzaki'] . "' AND (pembayaran = 'zakat' OR pembayaran = 'infaq dan shadaqoh')";

        // Tambahkan kondisi pencarian berdasarkan status_muzaki jika dipilih
        if (!empty($status_muzaki)) {
          $query_nama .= " AND status_muzaki = '$status_muzaki'";
        }

        if (!empty($pembayaran)) {
          $query_nama .= " AND pembayaran = '$pembayaran'";
        }

        if (!empty($metode_bayar)) {
          $query_nama .= " AND metode_bayar = '$metode_bayar'";
        }


        $query_nama .= " LIMIT 1";
        $result_nama = mysqli_query($koneksi, $query_nama);
        $nama_muzaki = mysqli_fetch_array($result_nama)['nama_muzaki'];

        echo "<tr>";
        echo "<td style='text-align: center;'>" . $no++ . "</td>";
        echo "<td>" . $nama_muzaki . "</td>";

        // Loop untuk menampilkan data pembayaran per bulan
        $total_jumlah = 0; // inisialisasi total_jumlah untuk setiap baris
        for ($bulan = 10; $bulan <= 12; $bulan++) {
          $query = "SELECT SUM(jumlah) as total FROM zakat_infaq WHERE nomor_induk_muzaki = '" . $muzaki['nomor_induk_muzaki'] . "' AND MONTH(tanggal) = $bulan AND (pembayaran = 'zakat' OR pembayaran = 'infaq dan shadaqoh') ";

          // Tambahkan kondisi pencarian berdasarkan status_muzaki jika dipilih
          if (!empty($status_muzaki)) {
            $query .= " AND status_muzaki = '$status_muzaki'";
          }

          if (!empty($pembayaran)) {
            $query .= " AND pembayaran = '$pembayaran'";
          }

          if (!empty($nama_muzaki)) {
            $query .= " AND nama_muzaki = '$nama_muzaki'";
          }

          if (!empty($metode_bayar)) {
            $query .= " AND metode_bayar = '$metode_bayar'";
          }

          $result = mysqli_query($koneksi, $query);
          $data = mysqli_fetch_array($result);
          $jumlah = $data['total'];

          $total_bulanan[$bulan] += $jumlah;
          $total_jumlah += $jumlah;

          echo "<td>" . number_format($jumlah, 2, ',', '.') . "</td>";
        }

        echo "<td style='font-weight: bold;'>" . number_format($total_jumlah, 2, ',', '.') . "</td>";
        $total_semua += $total_jumlah; // Menambahkan total_jumlah ke variabel $total_semua
      
        echo "</tr>";
      }

      // Menampilkan total bulanan pada baris terakhir
      echo "<tr>";
      echo "<td colspan='2' style='text-align: center; font-weight: bold;'><b>Total</b></td>";
      for ($bulan = 10; $bulan <= 12; $bulan++) {
        echo "<td style='font-weight: bold;'>" . number_format($total_bulanan[$bulan], 2, ',', '.') . "</td>";
      }

      echo "<td style='font-weight: bold;'>" . number_format($total_semua, 2, ',', '.') . "</td>"; // Menampilkan total dari semua jumlah
      echo "</tr>";
      ?>


          </table><br>


          <p style="margin-left: 700px; font-weight: bold;">Sumbawa Besar,
            <?php echo date('d F Y'); ?>
          </p>
          <div style="display: flex; margin-left:10px;">
            <div style="margin-left: 100px;">
              <p style="text-align: center;">Mengetahui,</p>
              <p style="text-align: center;">Ketua BAZNAS Kab. Sumbawa</p><br><br><br><br>
              <p style="text-align: center; font-weight: bold;">H. M. Ali Tunru, S.Sos</p>
            </div>

            <div style="margin-left:100px;">
              <p style="text-align: center;">Wakil Ketua I,</p>
              <p style="text-align: center;">BAZNAS Kab. Sumbawa</p><br><br><br><br>
              <p style="text-align: center; font-weight: bold;">Madroni, SHI</p>
            </div>

            <div style="margin-left:100px;">
              <p style="text-align: center;">Bidang Pengumpulan,</p>
              <p style="text-align: center;">BAZNAS Kab. Sumbawa</p><br><br><br><br>
              <p style="text-align: center; font-weight: bold;">Pahriyadi, S.Ap</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer"></div>
    </div>

  </div>


  <!-- JavaScript Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="timeout.js"></script>


</body>

</html>