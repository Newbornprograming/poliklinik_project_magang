<div class="container">
    <div class="row">
        <!-- Form Pendaftaran Poli -->
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header bg-primary text-white">Daftar Pasien</h5>
                <div class="card-body">

                    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
                        <?php
                        // Initialize variables
                        $nama = $id_poli = $id_jadwal = $alamat = $no_ktp = $no_hp = $keluhan = '';

                        // Check if updating an existing record
                        if (isset($_GET['id'])) {
                            $ambil = mysqli_query($mysqli, "SELECT * FROM pasien WHERE id='" . $_GET['id'] . "'");
                            while ($row = mysqli_fetch_array($ambil)) {
                                $nama = $row['nama'];
                                $id_poli = $row['id_poli'];
                                $id_jadwal = $row['id_jadwal'];
                                $alamat = $row['alamat'];
                                $no_ktp = $row['no_ktp'];
                                $no_hp = $row['no_hp'];
                                $keluhan = $row['keluhan'];
                            }
                        ?>
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <?php
                        }
                        ?>

                        <!-- Input fields for form -->
                        <div class="col-12 mb-1">
                            <label for="inputNama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="<?php echo $nama ?>">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="inputIdPoli">Poli</label>
                            <select class="form-control" name="id_poli">
                                <?php
                                $poli = mysqli_query($mysqli, "SELECT * FROM datapoli");
                                while ($data = mysqli_fetch_array($poli)) {
                                    $selected = ($data['id'] == $id_poli) ? 'selected="selected"' : '';
                                    echo "<option value='{$data['id']}' {$selected}>{$data['nama_poli']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 mb-1">
                            <label for="inputIdJadwal">Jadwal</label>
                            <select class="form-control" name="id_jadwal">
                                <?php
                                // Fetch schedules with corresponding doctor's name
                                $jadwaldokter = mysqli_query($mysqli, "SELECT j.id, j.hari, j.jam_mulai, j.jam_selesai, d.nama AS nama_dokter
                                                                        FROM jadwaldokter j
                                                                        JOIN dokter d ON j.id_dokter = d.id");
                                while ($data = mysqli_fetch_array($jadwaldokter)) {
                                    $selected = ($data['id'] == $id_jadwal) ? 'selected="selected"' : '';
                                    echo "
                                    <option value='{$data['id']}' {$selected}>
                                        Dokter {$data['nama_dokter']} | {$data['hari']} , {$data['jam_mulai']} - {$data['jam_selesai']}
                                    </option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 mb-1">
                            <label for="inputAlamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat ?>">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="inputNoKTP">No KTP</label>
                            <input type="text" class="form-control" name="no_ktp" id="inputNoKTP" placeholder="No KTP" value="<?php echo $no_ktp ?>">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="inputNoHP">No HP</label>
                            <input type="text" class="form-control" name="no_hp" id="inputNoHP" placeholder="No HP" value="<?php echo $no_hp ?>">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="inputKeluhan">Keluhan</label>
                            <input type="text" class="form-control" name="keluhan" id="inputKeluhan" placeholder="Keluhan" value="<?php echo $keluhan ?>">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Form Pendaftaran Poli -->

        <!-- Tabel Riwayat Poli -->
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header bg-primary text-white">Riwayat Daftar Pasien</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Poli</th>
                                <th scope="col">Jadwal</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($mysqli, "SELECT p.*, d.nama_poli, j.hari, j.jam_mulai, j.jam_selesai, k.nama AS nama_dokter 
                                                    FROM pasien p
                                                    JOIN datapoli d ON p.id_poli = d.id
                                                    JOIN jadwaldokter j ON p.id_jadwal = j.id
                                                    JOIN dokter k ON j.id_dokter = k.id
                                                    ORDER BY p.id ASC");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['nama_poli'] ?></td>
                                    <td><?php echo "Dokter {$data['nama_dokter']} | {$data['hari']}, {$data['jam_mulai']} - {$data['jam_selesai']}" ?></td>
                                    <td><?php echo $data['keluhan'] ?></td>
                                    <td>
                                        <a class="btn btn-info rounded-pill px-3" href="cetakAntrian.php?id=<?php echo $data['id'] ?>">Cetak Antrian</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Tabel Riwayat Poli -->
    </div>
</div>

<?php   
// Script to handle form submission and data manipulation
if (isset($_POST['simpan'])) {
    $jadwalExists = mysqli_query($mysqli, "SELECT id FROM jadwaldokter WHERE id='" . $_POST['id_jadwal'] . "'");
    
    if (mysqli_num_rows($jadwalExists) == 0) {
        echo "<script>alert('Error: Selected jadwal does not exist.');</script>";
    } else {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE pasien SET 
                                            nama = '" . $_POST['nama'] . "',
                                            id_poli = '" . $_POST['id_poli'] . "',
                                            id_jadwal = '" . $_POST['id_jadwal'] . "',
                                            alamat = '" . $_POST['alamat'] . "',
                                            no_ktp = '" . $_POST['no_ktp'] . "',
                                            no_hp = '" . $_POST['no_hp'] . "',
                                            keluhan = '" . $_POST['keluhan'] . "'
                                            WHERE id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO pasien (nama, id_poli, id_jadwal, alamat, no_ktp, no_hp, keluhan) 
                                            VALUES (
                                                '" . $_POST['nama'] . "',
                                                '" . $_POST['id_poli'] . "',
                                                '" . $_POST['id_jadwal'] . "',
                                                '" . $_POST['alamat'] . "',
                                                '" . $_POST['no_ktp'] . "',
                                                '" . $_POST['no_hp'] . "',
                                                '" . $_POST['keluhan'] . "')");
        }

        echo "<script>document.location='index.php?page=pasien';</script>";
    }
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
    } 
    echo "<script>document.location='index.php?page=pasien';</script>";
}
?>