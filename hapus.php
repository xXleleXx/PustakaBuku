<?php 
  require "function.php";
  $id = $_GET["id"];
  $table = $_GET["table"];

  if(hapus($id, $table) > 0) {
    echo "<script>
            window.alert('Data Berhasil Di Hapus!');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "<script>
            window.alert('Data Gagal Di Hapus!');
            document.location.href = 'index.php';
          </script>";
  }