<?php
require "function.php";

$categories = getData("SELECT * FROM kategori_buku");
$table = $_GET["table"];

if (isset($_POST["submit"])) {
  if (tambah($_POST, $table) > 0) {
    echo "<script>
              alert('Data Berhasil Ditambahkan');
              document.location.href = 'index.php';
            </script>";
  } else {
    echo "<script>
              alert('Data Gagal Ditambahkan');
              document.location.href = 'index.php';
            </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">

  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
    }

    .container {
      width: 80%;
    }
  </style>
</head>

<body style="background-color: whitesmoke;" >
  <div class="container ">
    <div class="row">
      <div style="background-color: snow;"
        class="col shadow rounded m-4 p-4">
        <form action="" method="post" enctype="multipart/form-data" class=" d-flex flex-column justify-content-center">
          <h4 class="text-center">Tambah <?= $table === 'buku' ? 'Buku' : 'Kategori' ?></h4>

          <!-- form buku -->
          <?php if ($table === "buku"): ?>
            <div class="row mb-2">
              <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul">
              </div>
            </div>

            <div class="row mb-2">
              <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="penulis">
              </div>
            </div>

            <div class="row mb-2">
              <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
              <div class="col-sm-10">
                <textarea name="sinopsis" class="form-control" style="height: 100px;"></textarea>
              </div>
            </div>

            <div class="row mb-2">
              <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
              <div class="col-sm-10">
                <select name="kategori_buku_id" class="form-select">
                  <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['kategori_buku_id'] ?>"><?= $category['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="tahun_terbit">
              </div>
            </div>

            <div class="row mb-2">
              <label for="gambar" class="col-sm-2 col-form-label">Gambar Buku</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="gambar">
              </div>
            </div>
          <?php endif; ?>

          <!-- Form Kategori Buku -->
          <?php if ($table === "kategori_buku"): ?>
            <div class="row mb-2">
              <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama">
              </div>
            </div>

            <div class="row mb-2">
              <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="deskripsi">
              </div>
            </div>
          <?php endif; ?>

          <div class="row mb-2 mt-2">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>

          <div class="row">
            <a href="index.php" class="btn btn-danger">Batal</a>
          </div>

        </form>
      </div>
    </div>

  </div>

  <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>