<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jadwalDokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <form class="form col" method="POST" action="" name="myForm">
        <!-- PHP code to connect the form with the database -->
        <?php
        $hari = '';
        $jam_mulai = '';
        $jam_selesai = '';
        $aktif = '';
        $id_dokter = '';

        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM jadwalDokter WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $hari = $row['hari'];
                $jam_mulai = $row['jam_mulai'];
                $jam_selesai = $row['jam_selesai'];
                $aktif = $row['aktif'];
                $id_dokter = $row['id_dokter'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
        ?>
        <!-- Data Dokter -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="dokter" class="sr-only">Dokter</label>
            <select class="form-control" name="id_dokter">
                <option value="-">- Pilih Dokter -</option>
                <?php
                $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
                while ($data = mysqli_fetch_array($dokter)) {
                    $selected = ($data['id'] == $id_dokter) ? 'selected="selected"' : '';
                ?>
                    <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- Hari -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="hari" class="sr-only">Hari</label>
            <select class="form-control" name="hari" id="hari">
                <option value="-">- Pilih Hari -</option>
                <option value="Senin" <?php echo ($hari == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                <option value="Selasa" <?php echo ($hari == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                <option value="Rabu" <?php echo ($hari == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                <option value="Kamis" <?php echo ($hari == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                <option value="Jumat" <?php echo ($hari == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                <option value="Sabtu" <?php echo ($hari == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                <option value="Minggu" <?php echo ($hari == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
            </select>
        </div>
        <!-- Jam Mulai -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="jam_mulai" class="sr-only">Jam Mulai</label>
            <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" value="<?php echo $jam_mulai ?>">
        </div>
        <!-- Jam Selesai -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="jam_selesai" class="sr-only">Jam Selesai</label>
            <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?php echo $jam_selesai ?>">
        </div>
        <!-- Aktif -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="aktif" class="sr-only">Aktif</label>
            <select class="form-control" name="aktif" id="aktif">
                <option value="-">- Pilih Keaktifan -</option>
                <option value="Y" <?php echo ($aktif == 'Y') ? 'selected' : ''; ?>>Ya</option>
                <option value="T" <?php echo ($aktif == 'T') ? 'selected' : ''; ?>>Tidak</option>
            </select>
        </div>
        <!-- Tombol Simpan -->
        <div class="row d-flex mt-3">
            <button type="submit" class="btn btn-primary rounded-pill" style="width: 3cm;" name="simpan">Simpan</button>
        </div>
    </form>
    <!-- Tabel -->
    <table class="table table-hover my-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dokter</th>
                <th scope="col">Hari</th>
                <th scope="col">Jam Mulai</th>
                <th scope="col">Jam Selesai</th>
                <th scope="col">Aktif</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($mysqli, "SELECT pr.*, d.nama as 'nama_dokter' FROM jadwalDokter pr LEFT JOIN dokter d ON pr.id_dokter = d.id ORDER BY pr.hari ASC");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama_dokter'] ?></td>
                    <td><?php echo $data['hari'] ?></td>
                    <td><?php echo $data['jam_mulai'] ?></td>
                    <td><?php echo $data['jam_selesai'] ?></td>
                    <td><?php echo $data['aktif'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=jadwalDokter&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=jadwalDokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <!-- Logic for Save, Update, and Delete -->
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE jadwalDokter SET 
                                            id_dokter = '" . $_POST['id_dokter'] . "',
                                            hari = '" . $_POST['hari'] . "',
                                            jam_mulai = '" . $_POST['jam_mulai'] . "',
                                            jam_selesai = '" . $_POST['jam_selesai'] . "',
                                            aktif = '" . $_POST['aktif'] . "'
                                            WHERE id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO jadwalDokter(id_dokter, hari, jam_mulai, jam_selesai, aktif) 
                                            VALUES (
                                                '" . $_POST['id_dokter'] . "',
                                                '" . $_POST['hari'] . "',
                                                '" . $_POST['jam_mulai'] . "',
                                                '" . $_POST['jam_selesai'] . "',
                                                '" . $_POST['aktif'] . "'
                                            )");
        }

        if (!$tambah && !$ubah) {
            echo "Error: " . mysqli_error($mysqli); // Output the error for debugging
        } else {
            echo "<script>document.location='index.php?page=jadwalDokter';</script>";
        }
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM jadwalDokter WHERE id = '" . $_GET['id'] . "'");
        }
        echo "<script>document.location='index.php?page=jadwalDokter';</script>";
    }
    ?>
</body>
</html>
