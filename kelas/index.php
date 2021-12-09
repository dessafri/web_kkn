<?php
require '../function/koneksi.php';
session_start();
if ($_SESSION['id'] == '') {
    header('location: ../home/index.php');
}

$id = $_GET['id'];
$materi = query("SELECT * FROM materi WHERE id_kelas = $id");
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
          <span class="col col-12 text-center">Materi Kelas <?= $id ?></span>
        </div>
      </div>
      <!-- <div class="formKelas">
        <div class="kelas">
          <img src="../assets/icon.png" alt="iconkelas" />
        </div>
      </div> -->
      <div class="formKelas">
        <?php foreach ($materi as $materi): ?>
        <div
          class="materi"
          style="
            background-image: url('../assets/bg_mapel<?= rand(1, 4) ?>.jpg');
            background-size: cover;
          "
        >
          <a href="mapel.php?id=<?= $materi['id'] ?>&kelas=<?= $materi[
    'id_kelas'
] ?>"><h1><?= $materi['nama'] ?></h1></a>
        </div>
        <?php endforeach; ?>
      </div>
      <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="navbar-nav">
          <div
            class="row"
            style="display: flex; justify-content: space-evenly;"
          >
            <div class="nav-item">
              <a href="../homepage/index.php"><i class="fas fa-home fa-2x"></i></a>
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
