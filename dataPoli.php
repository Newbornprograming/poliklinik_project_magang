<form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $nama_poli = '';
    $keterangan = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, 
        "SELECT * FROM dataPoli 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama_poli = $row['nama_poli'];
            $keterangan = $row['keterangan'];
        }
    ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php
    }
    ?>
    <div class="row mt-3">
        <label for="nama_poli" class="form-label fw-bold">
            Nama Poli
        </label>
        <input type="text" class="form-control" name="nama_poli" id="nama_poli" placeholder="Nama Poli" value="<?php echo $nama_poli ?>">
    </div>
    <div class="row mt-3">
        <label for="keterangan" class="form-label fw-bold">
            Keterangan
        </label>
        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan ?>">
    </div>
    <div class="row d-flex mt-3">
        <button type="submit" class="btn btn-primary rounded-pill" style="width: 3cm;" name="simpan">Simpan</button>
    </div>
</form>

<!-- tabel -->
<!-- Table-->
<table class="table table-hover my-3">
    <!-- thead atau baris judul -->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Poli</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!-- tbody berisi isi tabel sesuai dengan judul atau head -->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut berdasarkan status dan tanggal awal -->
        <?php
            $result = mysqli_query($mysqli, "SELECT * FROM dataPoli order by id asc");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama_poli'] ?></td>
                    <td><?php echo $data['keterangan'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=dataPoli&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=dataPoli&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
        ?>
    </tbody>
</table>

<!-- logika simpan, ubah, hapus -->
<?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE dataPoli SET 
                                            nama_poli = '" . $_POST['nama_poli'] . "',
                                            keterangan = '" . $_POST['keterangan'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO dataPoli(nama_poli,keterangan) 
                                            VALUES ( 
                                                '" . $_POST['nama_poli'] . "',
                                                '" . $_POST['keterangan'] . "'
                                                )");
        }

        echo "<script> 
                document.location='index.php?page=dataPoli';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM dataPoli WHERE id = '" . $_GET['id'] . "'");
        } 
        echo "<script> 
                document.location='index.php?page=dataPoli';
                </script>";
    }
?>
