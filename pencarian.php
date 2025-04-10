<div class="container">
<div class="non-printable">
    <div class="card">
        <div class="card-header">
            <strong>Filter Laporan Triwulan</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-row align-items-end mb-3">
                    <div class="col">
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="<?= isset($_POST['tahun']) ? $_POST['tahun'] : date('Y') ?>">
                    </div>
                    <div class="col">
                        <label for="nama_muzaki">Nama Muzaki</label>
                        <input type="text" name="nama_muzaki" class="form-control" value="<?= isset($_POST['nama_muzaki']) ? $_POST['nama_muzaki'] : '' ?>">
                    </div>
                    <div class="col">
                        <label for="status_muzaki">Status Muzaki</label>
                        <input type="text" name="status_muzaki" class="form-control" value="<?= isset($_POST['status_muzaki']) ? $_POST['status_muzaki'] : '' ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
</div>
