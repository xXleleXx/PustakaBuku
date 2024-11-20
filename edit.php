<?php
require "function.php";

$id = $_GET["id"];
$table = $_GET["table"];

if ($table === "buku") {
  $prevValue = getData("SELECT * FROM buku WHERE id_buku = $id")[0];
} else {
  $prevValue = getData("SELECT * FROM kategori_buku WHERE kategori_buku_id = $id")[0];
}

if (isset($_POST["submit"])) {
  if (edit($id, $_POST, $table) > 0) {
    echo "<script>
            alert('Data Berhasil di Ubah!');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "<script>
            alert('Data Gagal di Ubah!');
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
  <title>Edit Data</title>
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

    img {
      height: 7rem;
      width: 6rem;
    }
  </style>
</head>

<body style="background-color: whitesmoke;">
  <div class="container">
    <div class="row">
      <div style="background-color: snow;" class="col shadow rounded m-4 p-4">
        <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-center">
          <h4 class="text-center">Edit <?= $table === 'buku' ? 'Buku' : 'Kategori' ?></h4>

          <!-- Form Buku -->
          <?php if ($table === "buku"): ?>
            <div class="row mb-2">
              <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" value="<?= $prevValue["judul"] ?>">
              </div>
            </div>

            <div class="row mb-2">
              <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="penulis" value="<?= $prevValue["penulis"] ?>">
              </div>
            </div>

            <div class="row mb-2">
              <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
              <div class="col-sm-10">
                <textarea name="sinopsis" class="form-control" style="height: 100px;"><?= $prevValue["sinopsis"] ?></textarea>
              </div>
            </div>

            <div class="row mb-2">
              <label for="kategori_buku_id" class="col-sm-2 col-form-label">Kategori</label>
              <div class="col-sm-10">
                <select name="kategori_buku_id" class="form-control">
                  <?php
                  $categories = getData("SELECT * FROM kategori_buku");
                  foreach ($categories as $category):
                  ?>
                    <option value="<?= $category['kategori_buku_id'] ?>" <?= $category['kategori_buku_id'] == $prevValue["kategori_buku_id"] ? 'selected' : '' ?>>
                      <?= $category['name'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="tahun_terbit" value="<?= $prevValue["tahun_terbit"] ?>">
              </div>
            </div>

            <div class="row mb-2">
              <label for="gambar" class="col-sm-2 col-form-label">Gambar Buku</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="gambar">
                <img src="upload/<?= $prevValue["image"] ?>" class="mt-2 img-fluid object-fit-cover" alt="">
                <input type="hidden" name="gambar_lama" value="<?= $prevValue["image"] ?>">
              </div>
            </div>

          <?php endif; ?>

          <!-- Form Kategori Buku -->
          <?php if ($table === "kategori_buku"): ?>
            <div class="row mb-2">
              <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" value="<?= $prevValue["name"] ?>">
              </div>
            </div>

            <div class="row mb-2">
              <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="deskripsi" value="<?= $prevValue["deskripsi"] ?>">
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