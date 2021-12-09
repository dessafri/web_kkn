<?php
require '../function/koneksi.php';
session_start();
if ($_SESSION['id'] == '') {
    header('location: ../home/index.php');
}
if (isset($_POST['logout'])) {
    $_SESSION['id'] = '';
    header('location: ../index.php');
}
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

    <title>E Learning SDN Sidorejo</title>
  </head>
  <body>
    <div class="bglogin"></div>
    <div class="container">
      <div class="formTitle">
        <div class="row">
          <span class="col col-12">SILAHKAN PILIH KELAS</span>
        </div>
      </div>
      <!-- <div class="formKelas">
        <div class="kelas">
          <img src="../assets/icon.png" alt="iconkelas" />
        </div>
      </div> -->
      <div class="formKelas">
        <div class="kelas">
          <a href="../kelas/index.php?id=1" class="text-center" style="margin-left: -5px;">KELAS 1</a>
        </div>
        <div class="kelas">
          <a href="../kelas/index.php?id=2" class="text-center" style="margin-left: -5px;">KELAS 2</a>
        </div>
        <div class="kelas">
          <a href="../kelas/index.php?id=3" class="text-center" style="margin-left: -5px;">KELAS 3</a>
        </div>
        <div class="kelas">
          <a href="../kelas/index.php?id=4" class="text-center" style="margin-left: -5px;">KELAS 4</a>
        </div>
        <div class="kelas">
          <a href="../kelas/index.php?id=5" class="text-center" style="margin-left: -5px;">KELAS 5</a>
        </div>
        <div class="kelas">
          <a href="../kelas/index.php?id=6" class="text-center" style="margin-left: -5px;">KELAS 6</a>
        </div>
      </div>
      <div class="logout" style="position: relative; margin-top: 100px; display: flex; justify-content:end;">
      <form action="" method="POST">
        <button class="btn btn-danger" name="logout">Logout</button>
        </form>
      </div>
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
