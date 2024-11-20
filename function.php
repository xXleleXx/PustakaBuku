<?php 
$host = "localhost";
$username = "root";
$password = "";
$db = "kls_industri";

$conn = mysqli_connect($host, $username, $password, $db);

function getData($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];

  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }

  return $rows;
}

function cari($keyword)
{
  $data = getData("SELECT *, kategori_buku.name AS category_name FROM buku
                   INNER JOIN kategori_buku ON buku.kategori_buku_id = kategori_buku.kategori_buku_id
                   WHERE buku.judul LIKE '%$keyword%' OR
                         buku.penulis LIKE '%$keyword%' OR
                         buku.tahun_terbit LIKE '%$keyword%' OR
                         kategori_buku.name LIKE '%$keyword%'");
  return $data;
}


function tambah($data, $table)
{
  global $conn;

  if ($table == "buku") {
    $judul = htmlspecialchars($data["judul"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $sinopsis = htmlspecialchars($data["sinopsis"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $kategori_buku_id = htmlspecialchars($data["kategori_buku_id"]);
    $image = upload();

    if(empty($judul) || empty($penulis) || empty($sinopsis) || empty($tahun_terbit) || empty($kategori_buku_id)) {
      echo "<script>
      alert('Semua Field Harus Di Isi!');
      </script>";
      
      return false;            
    }
    
    if (!$image) {
      return false;
    }

    $sql = "INSERT INTO buku (judul, penulis, sinopsis, tahun_terbit, kategori_buku_id, image) VALUES (
            '$judul',
            '$penulis',
            '$sinopsis',
            '$tahun_terbit',
            '$kategori_buku_id',
            '$image'
            )";
  } elseif ($table == "kategori_buku") {
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    if (empty($nama) || empty($deskripsi)) {
      echo "<script>
              alert('Semua Field Harus Di Isi!');
            </script>";

      return false;            
    }

    $sql = "INSERT INTO kategori_buku (name, deskripsi) VALUES (
            '$nama',
            '$deskripsi'
            )";
  } else {
    return -1; // Tabel tidak valid
  }

  mysqli_query($conn, $sql);
  return mysqli_affected_rows($conn);
}


function hapus($id, $table) {
  global $conn;

  if($table == "buku") {
    $id_table = "id_buku";
    
    $file = getData("SELECT image FROM buku WHERE id_buku = $id")[0];
    unlink("upload/" . $file["image"]);

  } else if($table == "kategori_buku") {
    $id_table = "kategori_buku_id";
  } else{
    return -1;
  }

  $sql = "DELETE FROM $table WHERE $id_table = $id";
  mysqli_query($conn, $sql);


  return mysqli_affected_rows($conn);
}

function edit($id, $data, $table) {
  global $conn;
  
  if($table == "buku") {
    $previousData = getData("SELECT * FROM buku WHERE id_buku = $id")[0];

    $judul = empty($data["judul"]) ? $previousData["judul"] : htmlspecialchars($data["judul"]);
    $penulis = empty($data["penulis"]) ? $previousData["penulis"] : htmlspecialchars($data["penulis"]);
    $sinopsis = empty($data["sinopsis"]) ? $previousData["sinopsis"] : htmlspecialchars($data["sinopsis"]);
    $tahun_terbit = empty($data["tahun_terbit"]) ? $previousData["tahun_terbit"] : htmlspecialchars($data["tahun_terbit"]);
    $kategori_buku_id = empty($data["kategori_buku_id"]) ? $previousData["kategori_buku_id"] : htmlspecialchars($data["kategori_buku_id"]);
    $image = upload();

    if ($image) {
      unlink("upload/" . $previousData['image']);
    } else {
      $image = htmlspecialchars($data["gambar_lama"]);
    }

    $sql = "UPDATE buku SET 
          judul = '$judul',
          penulis = '$penulis',
          sinopsis = '$sinopsis',
          tahun_terbit = '$tahun_terbit',
          kategori_buku_id = '$kategori_buku_id',
          image = '$image'
          WHERE id_buku = $id";
    mysqli_query($conn, $sql);
  } else if($table == "kategori_buku") {
    $previousData = getData("SELECT * FROM kategori_buku WHERE kategori_buku_id = $id")[0];

    $nama = empty($data["nama"]) ? $previousData["nama"] : htmlspecialchars($data["nama"]);
    $deskripsi = empty($data["deskripsi"]) ? $previousData["deskripsi"] : htmlspecialchars($data["deskripsi"]);

    $sql = "UPDATE kategori_buku SET 
          name = '$nama',
          deskripsi = '$deskripsi'
          WHERE kategori_buku_id = $id";
    mysqli_query($conn, $sql);
  } else {
    return -1;
  }

  return mysqli_affected_rows($conn);
}

function upload() {
  $namaFile = $_FILES["gambar"]["name"];
  $tipeFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
  $error = $_FILES["gambar"]["error"];
  $ukuranFile = $_FILES["gambar"]["size"];
  $tmpName = $_FILES["gambar"]["tmp_name"];

  //cek apakah sudah mengupload gambar
  if ($error === 4) {
    echo "<script>alert('Gambar harus ada!')</script>";
    return false;
  }

  //cek ukuran gambar (max 5mb)
  if ($ukuranFile > 500000) {
    echo "<script>alert('ukuran gambar terlalu besar')</script>";
    return false;
  }

  //cek apakah fiie gambar
  $tipeValid = ["jpg", "png", "jpeg"];
  if (!in_array($tipeFile, $tipeValid)) {
    echo "<script>alert('File bukan berupa gambar')</script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru = $namaFileBaru . "." . $tipeFile;

  move_uploaded_file($tmpName, "upload/" . $namaFileBaru);
  return $namaFileBaru;
}