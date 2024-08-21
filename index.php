<?php
    include_once('koneksi.php'); // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik</title>
    <!-- Bootstrap CSS for responsive design and prebuilt components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS for additional styling -->
    <style>
        body, html {
            height: 100%;
        }
        .container-fluid {
            height: 100%;
        }
        .row {
            height: 100%;
        }
        .nav-pills-custom {
            height: 100%;
            background-color: #f8f9fa; /* Light gray color */
            padding-top: 20px;
            padding-bottom: 20px;
            border-radius: 0; /* Remove border-radius for full-height navigation */
        }
    </style>
</head>
<body>
    <!-- Navbar for site navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Sistem Informasi Poliklinik</a> <!-- Navbar brand -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> <!-- Toggler icon for mobile view -->
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a> <!-- Home link -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content section -->
    <main role="main" class="container-fluid">
        <div class="row">
            <?php
            // Check if a specific page is requested via the 'page' query parameter
            if (isset($_GET['page'])) {
                $page = $_GET['page']; // Get the page value from the URL

                // Check if the requested page is 'pasien'
                if ($page == 'pasien') {
                    // For the 'pasien' page, no left navigation is required
                    echo '
                    <div class="col-md-12">
                        <h2>' . ucwords($page) . '</h2>'; // Display the page title
                        include($page . ".php"); // Include the specific page's content
                    echo '</div>';
                } elseif ($page == 'dokter' || $page == 'profilDokter' || $page == 'jadwalDokter') {
                    // For 'dokter', 'profilDokter', and 'jadwalDokter' pages, include left navigation
                    echo '
                    <div class="col-md-3">
                        <ul class="nav flex-column nav-pills nav-pills-custom" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'dokter') ? 'active' : '') . '" href="index.php?page=dokter">Dashboard Dokter</a> <!-- Doctor Dashboard Link -->
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'profilDokter') ? 'active' : '') . '" href="index.php?page=profilDokter">Profil Dokter</a> <!-- Doctor Profile Link -->
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'jadwalDokter') ? 'active' : '') . '" href="index.php?page=jadwalDokter">Jadwal Dokter</a> <!-- Doctor Schedule Link -->
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <h2>' . ucwords($page) . '</h2>'; // Display the page title
                        include($page . ".php"); // Include the specific page's content
                    echo '</div>';
                } elseif ($page == 'admin' || $page == 'dataDokter' || $page == 'dataPoli' || $page == 'dataObat') {
                    // For 'admin', 'dataDokter', 'dataPoli', and 'dataObat' pages, include left navigation
                    echo '
                    <div class="col-md-3">
                        <ul class="nav flex-column nav-pills nav-pills-custom" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'admin') ? 'active' : '') . '" href="index.php?page=admin">Dashboard Admin</a> <!-- Admin Dashboard Link -->
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'dataDokter') ? 'active' : '') . '" href="index.php?page=dataDokter">Data Dokter</a> <!-- Doctor Data Link -->
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'dataPoli') ? 'active' : '') . '" href="index.php?page=dataPoli">Data Poli</a> <!-- Poli Data Link -->
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ' . (($page == 'dataObat') ? 'active' : '') . '" href="index.php?page=dataObat">Data Obat</a> <!-- Medicine Data Link -->
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <h2>' . ucwords($page) . '</h2>'; // Display the page title
                        include($page . ".php"); // Include the specific page's content
                    echo '</div>';
                }
            } else {
                // If no specific page is requested, display the Home page
                echo '
                <h1 class="text-center">Selamat Datang di Sistem Informasi Poliklinik</h1> <!-- Welcome message -->
                <!-- Card Section -->
                <div class="row mt-4 p-5">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">Halaman Pasien</div> <!-- Patient Page Card -->
                            <div class="card-body">
                                <p class="card-text">Akses informasi perawatan kesehatan.</p> <!-- Description -->
                                <a href="index.php?page=pasien" class="btn btn-primary">Pasien</a> <!-- Patient Page Button -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">Halaman Dokter</div> <!-- Doctor Page Card -->
                            <div class="card-body">
                                <p class="card-text">Kelola data pasien dan layanan kesehatan.</p> <!-- Description -->
                                <a href="index.php?page=dokter" class="btn btn-success">Dokter</a> <!-- Doctor Page Button -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">Halaman Admin</div> <!-- Admin Page Card -->
                            <div class="card-body">
                                <p class="card-text">Manajemen sistem dan pengguna poliklinik.</p> <!-- Description -->
                                <a href="index.php?page=admin" class="btn btn-warning">Admin</a> <!-- Admin Page Button -->
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </main>

    <!-- Bootstrap JS for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
