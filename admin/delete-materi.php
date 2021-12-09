<?php
require '../function/koneksi.php';
session_start();
$id = $_GET['delete'];
$result = mysqli_query(
    $conn,
    "SELECT * FROM detailmateri WHERE id_materi='$id'"
);
$data = mysqli_fetch_assoc($result);

if (empty($data)) {
    mysqli_query($conn, "DELETE FROM materi WHERE id='$id'");
    if (mysqli_affected_rows($conn)) {
        echo "<script>
      alert('Delete Berhasil!')
      setTimeout(() => {
            window.location='guru.php';
        }, 500);
      </script>";
    }
} else {
    mysqli_query($conn, "DELETE FROM detailmateri WHERE id_materi='$id'");
    mysqli_query($conn, "DELETE FROM materi WHERE id='$id'");
    if (mysqli_affected_rows($conn)) {
        echo "<script>
      alert('Delete Berhasil!')
      setTimeout(() => {
            window.location='guru.php';
        }, 500);
      </script>";
    }
}

?>
