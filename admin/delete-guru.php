<?php
require '../function/koneksi.php';
session_start();
$id = $_GET['delete'];
mysqli_query($conn, "DELETE FROM guru WHERE id='$id'");
if (mysqli_affected_rows($conn)) {
    echo "<script>
      alert('Delete Berhasil!')
      setTimeout(() => {
            window.location='daftar-guru.php';
        }, 500);
      </script>";
}
?>
