<?php
require '../function/koneksi.php';
session_start();
if ($_SESSION['id'] == '') {
    header('location: ../home/index.php');
}

$id = $_GET['id'];
$id_materi = $_GET['materi'];
$id_kelas = $_GET['kelas'];
$bab = query(
    "SELECT * FROM detailmateri WHERE id=$id AND id_materi = $id_materi AND id_kelas=$id_kelas"
);
$idmateri = $bab[0]['id_materi'];
$idkelas = $bab[0]['id_kelas'];
$namaMateri = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM materi WHERE id=$idmateri AND id_kelas=$idkelas"
    )
);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat:wght@500&family=Source+Sans+Pro&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />

    <title>E Learning SDN 1 SIDOREJO</title>
  </head>
  <body>
    <div class="bglogin"></div>
    <div class="container">
      <div class="formTitle">
        <div class="row">
          <span class="col col-12 text-center">Materi Kelas <?= $bab[0][
              'id_kelas'
          ] ?> <?= $namaMateri['nama'] ?></span>
        </div>
      </div>
      <!-- <div class="formKelas">
        <div class="kelas">
          <img src="../assets/icon.png" alt="iconkelas" />
        </div>
      </div> -->
      <div class="formKelas">
        <div class="bacaanlMapel">
          <p>
            <?= $bab[0]['bacaan'] ?>
          </p>
        </div>
        <div class="latihanMapel">
          <span>Latihan</span>
          <p>
            <?= $bab[0]['latihan'] ?>
          </p>
        </div>
      </div>
      <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="navbar-nav">
          <div
            class="row"
            style="display: flex; justify-content: space-evenly;"
          >
            <div class="nav-item">
              <a href="javascript:history.go(-1)"><i class="fas fa-arrow-left fa-2x"></i></a>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
      data-auto-replace-svg="nest"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>
