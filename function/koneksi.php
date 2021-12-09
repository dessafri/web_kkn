<?php

// koneksi

use function PHPSTORM_META\map;

$conn = mysqli_connect('localhost', 'root', '', 'sdnsidorejo');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function createGuru($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $email = $data['email'];
    $password = $data['password'];
    $emailDb = mysqli_fetch_assoc(
        mysqli_query($conn, 'SELECT email FROM guru')
    );
    $re_password = $data['repassword'];

    // var_dump($emailDb);

    if ($email == $emailDb['email']) {
        echo "<script>
        alert('email sudah tersedia')
        </script>";

        return false;
    } elseif ($password != $re_password) {
        echo "<script>
        alert('Konfirmasi Password tidak cocok !!')
        </script>";

        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO guru VALUES('','$nama','$email','$password','')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
function createSiswa($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $email = $data['email'];
    $password = $data['password'];
    $emailDb = mysqli_fetch_assoc(
        mysqli_query($conn, 'SELECT email FROM siswa')
    );
    // var_dump($emailDb);

    if ($email == $emailDb['email']) {
        echo "<script>
        alert('email sudah tersedia')
        </script>";

        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO siswa VALUES('','$nama','$email','$password')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
function tambahMateri($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama_materi']);
    $namalower = strtolower($nama);
    $idkelas = htmlspecialchars($data['id_kelas']);
    $materi = mysqli_query($conn, 'SELECT nama FROM materi');
    $rows = [];
    while ($row = mysqli_fetch_assoc($materi)) {
        $rows[] = $row;
    }
    $cekSama = '';
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            $strlow = strtolower($row['nama']);
            if ($strlow === $namalower) {
                $cekSama = 'sama';
            }
        }
    }
    if (strlen($cekSama) > 1) {
        echo "<script>
        alert('Materi Sudah Tersedia !!')
        </script>";

        return false;
        $cekSama = '';
    } else {
        $query = "INSERT INTO materi VALUES('','$nama','$idkelas')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
function tambahbab($data)
{
    global $conn;

    $bacaan = $data['bacaan'];
    $latihan = $data['latihan'];
    $idmateri = $data['id_materi'];
    $idkelas = $data['id_kelas'];
    $query = "INSERT INTO detailmateri VALUES('','$bacaan','$latihan','$idmateri','$idkelas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateGuru($data)
{
    global $conn;
    $id = $data['id'];
    $nama = $data['nama'];
    $email = $data['email'];
    $kelas = $data['kelas'];

    $query = "UPDATE guru SET id_kelas = $kelas WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function updatebab($data)
{
    global $conn;
    $id = $data['id_bab'];
    $bacaan = $data['bacaan'];
    $latihan = $data['latihan'];

    $query = "UPDATE detailmateri SET bacaan = '$bacaan',latihan = '$latihan' WHERE detailmateri.id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function login($data)
{
    global $conn;
    $email = $data['email'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $result = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT id FROM admin WHERE email = '$email'"
                )
            );
            $_SESSION['id'] = $result['id'];
            header('location: index.php');
            exit();
        }
    } else {
        $result = mysqli_query(
            $conn,
            "SELECT * FROM guru WHERE email = '$email'"
        );
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $result = mysqli_fetch_assoc(
                    mysqli_query(
                        $conn,
                        "SELECT id FROM guru WHERE email = '$email'"
                    )
                );
                $_SESSION['id'] = $result['id'];
                header('location: guru.php');
                exit();
            }
        }
        $error = true;

        if (isset($error)) {
            echo "
            <script>
            alert('Email / Password Tidak Cocok !!')
            
            </script>
            ";
        }
    }
}
function loginSiswa($data)
{
    global $conn;
    $email = $data['email'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE email = '$email'");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $result = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT id FROM siswa WHERE email = '$email'"
                )
            );
            $_SESSION['id'] = $result['id'];
            header('location: ../homepage/index.php');
            exit();
        }
    } else {
        $error = true;

        if (isset($error)) {
            echo "
            <script>
            alert('Email / Password Tidak Cocok !!')
            
            </script>
            ";
        }
    }
}
