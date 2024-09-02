<?php
// Include database connection file
include('koneksi.php');

// Fetch the ID from the URL parameter
$id = $_GET['id'];

// Query to get appointment details
$query = "
    SELECT p.*, d.nama_poli, j.hari, j.jam_mulai, j.jam_selesai, k.nama AS nama_dokter
    FROM pasien p
    JOIN datapoli d ON p.id_poli = d.id
    JOIN jadwaldokter j ON p.id_jadwal = j.id
    JOIN dokter k ON j.id_dokter = k.id
    WHERE p.id = '$id'
";

$result = mysqli_query($mysqli, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .item-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-1">
        <div class="card mx-auto" style="max-width: 600px;">
            <h5 class="card-header bg-primary text-white">Detail Antrian</h5>
            <div class="card-body item-center">
                <h6 class="card-subtitle mb-2 text-muted fw-bold">Nama Poli</h6>
                <p class="card-text"><?php echo $data['nama_poli']; ?></p>

                <h6 class="card-subtitle mb-2 text-muted fw-bold">Alamat</h6>
                <p class="card-text"><?php echo $data['alamat']; ?></p>

                <h6 class="card-subtitle mb-2 text-muted fw-bold">No HP</h6>
                <p class="card-text"><?php echo $data['no_hp']; ?></p>

                <h6 class="card-subtitle mb-2 text-muted fw-bold">No KTP</h6>
                <p class="card-text"><?php echo $data['no_ktp']; ?></p>
                
                <hr>
                
                <h6 class="card-subtitle mb-2 text-muted fw-bold">Nama Dokter</h6>
                <p class="card-text"><?php echo $data['nama_dokter']; ?></p>
                
                <h6 class="card-subtitle mb-2 text-muted fw-bold">Hari</h6>
                <p class="card-text"><?php echo $data['hari']; ?></p>
                
                <h6 class="card-subtitle mb-2 text-muted fw-bold">Mulai</h6>
                <p class="card-text"><?php echo $data['jam_mulai']; ?></p>
                
                <h6 class="card-subtitle mb-2 text-muted fw-bold">Selesai</h6>
                <p class="card-text"><?php echo $data['jam_selesai']; ?></p>
                
                <h6 class="card-subtitle mb-2 text-muted fw-bold">Keluhan</h6>
                <p class="card-text"><?php echo $data['keluhan']; ?></p>

                <h6 class="card-subtitle mb-2 text-muted fw-bold">Nomor Antrian</h6>
                <button class="btn btn-success"><?php echo $data['id']; ?></button>
                <hr>
                <a href="index.php?page=pasien" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
