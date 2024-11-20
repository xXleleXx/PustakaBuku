<?php
require "function.php";
$books = getData("SELECT *, kategori_buku.name AS category_name FROM buku
        INNER JOIN kategori_buku ON buku.kategori_buku_id = kategori_buku.kategori_buku_id");

$categories = getData("SELECT * FROM kategori_buku");

if (isset($_POST["search"])) {
  $books = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
  <script src="Bootstrap/js/bootstrap.bundle.min.js" defer></script>

  <style>
    nav {
      background-color: white;
    }

    main {
      background-color: white;
    }

    .card {
      width: 14rem;

    }

    .card img {
      height: 20rem;
    }

    .modal-body img {
      height: 20rem;
      width: 14rem;
    }

    input {
      max-width: 15rem;
    }
  </style>
</head>

<body class="bg-secondary-subtle">
  <header>
    <nav class="navbar m-4 p-4 shadow rounded">
      <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand fw-bold"><span class="text-danger">Pustaka</span> <span class="text-primary">Buku</span></a>
        <div>
          <a href="tambah.php?table=buku"><button class="btn btn-primary">+ Tambah Buku</button></a>
          <a href="tambah.php?table=kategori_buku"><button class="btn btn-primary">+ Tambah Kategori</button></a>
        </div>
      </div>
    </nav>
  </header>

  <main class="mt-2 m-4 p-3 rounded shadow d-flex flex-column">
    <nav>
      <div class="nav nav-pills" role="tablist">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-buku" type="button" role="tab" aria-controls="nav-buku" aria-selected="true">Buku</button>
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-kategori" type="button" role="tab" aria-controls="nav-kategori" aria-selected="false">Kategori</button>
      </div>
    </nav>

    <div class="tab-content">
      <div class="tab-pane fade show active" id="nav-buku" role="tabpanel" aria-labelledby="nav-buku-tab" tabindex="0">
        <div class="d-flex flex-column">
          <form class=" d-flex align-self-end" method="post" role="search">
            <input class="form-control me-2" name="keyword" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" name="search" type="submit">Search</button>
          </form>

          <div class="container mt-4">
            <div class="row g-0 w-100 ">
              <?php $i = 1; ?>
              <?php foreach ($books as $book): ?>
                <div class="col-md-3 col-sm-6 col-12 mb-5 d-flex justify-content-center">
                  <div class="card shadow ">
                    <img src="upload/<?= $book["image"] ?>" class="img-fluid object-fit-cover card-img-top" alt="">
                    <div class="card-body">
                      <div class="card-title fw-bold mb-0"><?= $book["judul"] ?></div>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item ">Penulis : <?= $book["penulis"] ?></li>
                      <li class="list-group-item">Kategori : <?= $book["category_name"] ?></li>

                      <!-- modal button  -->
                      <li class="list-group-item">
                        <button style="font-size: 15px;" type="button" class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#M<?= $i ?>">Details</button>

                        <!-- modal -->
                        <div class="modal fade" id="M<?= $i ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="rue">
                          <div class="modal-dialog modal-lg">
                            <di class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title fs-5 fw-bold" id="modalLabel"><?= $book["judul"] ?></h3>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                              </div>
                              <div class="modal-body d-flex flex-column ">
                                <img src="upload/<?= $book["image"] ?>" class="img-fluid object-fit-cover rounded align-self-center" alt="">

                                <p class="mt-2"><b>Id Buku:</b> <?= $book["id_buku"] ?></p>
                                <p><b>Penulis :</b> <?= $book["penulis"] ?></p>
                                <p><b>Kategori :</b> <?= $book["category_name"] ?></p>
                                <p><b>Tahun Terbit :</b> <?= $book["tahun_terbit"] ?></p>
                                <p><b>Sinopsis :</b> <?= $book["sinopsis"] ?></p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              </div>
                            </di>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <div class=" card-body d-flex align-items-center gap-1">
                      <a href="edit.php?id=<?= $book["id_buku"] ?>&table=buku" class="btn btn-primary">Edit</a>
                      <a href="hapus.php?id=<?= $book["id_buku"] ?>&table=buku" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
                <?php $i++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="nav-kategori" role="tabpanel" aria-labelledby="nav-kategori-tab" tabindex="0">
        <div class="container my-2 py-2">
          <div class="row d-flex justify-content-center">
            <table class="table table-striped ">
              <tr class="table-dark">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Id Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col"></th>
              </tr>
              <?php $i = 1; ?>
              <?php foreach ($categories as $category): ?>
                <tr>
                  <td scope="row"><?= $i ?></td>
                  <td><?= $category["name"] ?></td>
                  <td><?= $category["kategori_buku_id"] ?></td>
                  <td><?= $category["deskripsi"] ?></td>
                  <td class="d-flex gap-2 justify-content-end">
                    <a href="edit.php?id=<?= $category["kategori_buku_id"] ?>&table=kategori_buku" class="btn btn-primary ">Edit</a>
                    <a href="hapus.php?id=<?= $category["kategori_buku_id"] ?>&table=kategori_buku" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                <?php $i++ ?>
              <?php endforeach ?>
            </table>
          </div>
        </div>
      </div>
    </div>


  </main>
</body>

</html>