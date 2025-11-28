<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'function.php';

$id = $_GET['id'];
$buku = query("SELECT * FROM buku WHERE id = $id")[0];

if (isset($_POST['tombol_submit'])) {
    if (ubah_data($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil diubah di database!');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah di database!');
            document.location.href = 'index.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Buku - SIMBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }
    </style>
</head>

<body>

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-book-half me-2"></i>SIMBS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Data Buku</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0 text-center fw-bold"><i class="bi bi-pencil-square me-2"></i>Ubah Data Buku</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                            <input type="hidden" name="gambarOld" value="<?= $buku['gambar'] ?>">

                            <div class="mb-3">
                                <label for="judul" class="form-label fw-bold text-secondary"><i
                                        class="bi bi-type-h1 me-1"></i>Judul Buku</label>
                                <input type="text" class="form-control form-control-lg" name="judul" id="judul"
                                    value="<?= $buku['judul'] ?>" required placeholder="Masukkan judul buku">
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold text-secondary"><i
                                        class="bi bi-card-text me-1"></i>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required
                                    placeholder="Masukkan deskripsi singkat"><?= $buku['deskripsi'] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="halaman" class="form-label fw-bold text-secondary"><i
                                        class="bi bi-file-earmark-text me-1"></i>Jumlah Halaman</label>
                                <input type="number" class="form-control" name="halaman" id="halaman"
                                    value="<?= $buku['halaman'] ?>" required placeholder="Contoh: 150">
                            </div>

                            <div class="mb-4">
                                <label for="gambar" class="form-label fw-bold text-secondary"><i
                                        class="bi bi-image me-1"></i>Gambar Sampul</label>
                                <div class="d-flex align-items-center p-3 border rounded bg-light">
                                    <img src="img/<?= $buku['gambar'] ?>" width="80" height="100"
                                        class="img-thumbnail rounded me-3 shadow-sm" alt="Current Image"
                                        style="object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <input type="file" class="form-control" name="gambar" id="gambar">
                                        <div class="form-text mt-1 text-muted small">Biarkan kosong jika tidak ingin
                                            mengubah gambar.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php" class="btn btn-outline-secondary px-4"><i
                                        class="bi bi-arrow-left me-1"></i>Batal</a>
                                <button type="submit" name="tombol_submit" class="btn btn-primary px-4 fw-bold"><i
                                        class="bi bi-save me-1"></i>Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>