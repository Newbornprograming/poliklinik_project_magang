    <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
            $nama_obat = '';
            $kemasan = '';
            $harga = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, 
                "SELECT * FROM dataObat 
                WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama_obat = $row['nama_obat'];
                    $kemasan = $row['kemasan'];
                    $harga = $row['harga'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo
                $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="row mt-3">
                <label for="nama_obat" class="form-label fw-bold">
                    Nama Obat
                </label>
                <input type="text" class="form-control" name="nama_obat" id="nama_obat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
            </div>
            <div class="row mt-3">
                <label for="kemasan" class="form-label fw-bold">
                    Kemasan
                </label>
                <input type="text" class="form-control" name="kemasan" id="kemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
            </div>
            <div class="row mt-3">
                <label for="harga" class="form-label fw-bold">
                    Harga
                </label>
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga ?>">
            </div>
            <div class="row d-flex mt-3">
                <button type="submit" class="btn btn-primary rounded-pill" style="width: 3cm;" name="simpan">Simpan</button>
            </div>
        </form>
        <!-- tabel -->
        <!-- Table-->
        <table class="table table-hover my-3">
            <!--thead atau baris judul-->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama_obat</th>
                    <th scope="col">kemasan</th>
                    <th scope="col">harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <!--tbody berisi isi tabel sesuai dengan judul atau head-->
            <tbody>
                <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
                berdasarkan status dan tanggal awal-->
                <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM dataObat");
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['nama_obat'] ?></td>
                            <td><?php echo $data['kemasan'] ?></td>
                            <td><?php echo $data['harga'] ?></td>
                            <td>
                                <a class="btn btn-success rounded-pill px-3" href="index.php?page=dataObat&id=<?php echo $data['id'] ?>">Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" href="index.php?page=dataObat&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- logi simpan ubah deleted -->
        <?php
                if (isset($_POST['simpan'])) {
                    if (isset($_POST['id'])) {
                        $ubah = mysqli_query($mysqli, "UPDATE dataObat SET 
                                                        nama_obat = '" . $_POST['nama_obat'] . "',
                                                        kemasan = '" . $_POST['kemasan'] . "',
                                                        harga = '" . $_POST['harga'] . "'
                                                        WHERE
                                                        id = '" . $_POST['id'] . "'");
                    } else {
                        $tambah = mysqli_query($mysqli, "INSERT INTO dataObat(nama_obat,kemasan,harga) 
                                                        VALUES ( 
                                                            '" . $_POST['nama_obat'] . "',
                                                            '" . $_POST['kemasan'] . "',
                                                            '" . $_POST['harga'] . "'
                                                            )");
                    }

                    echo "<script> 
                            document.location='index.php?page=dataObat';
                            </script>";
                }

                if (isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'hapus') {
                        $hapus = mysqli_query($mysqli, "DELETE FROM dataObat WHERE id = '" . $_GET['id'] . "'");
                    } 
                    echo "<script> 
                            document.location='index.php?page=dataObat';
                            </script>";
                }
        ?>
