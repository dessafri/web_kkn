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

function deletePaketTravel($id)
{
    global $conn;

    $id = explode(',', $id);

    foreach ($id as $data_id) {
        mysqli_query($conn, "DELETE  FROM paket_travel WHERE id='$data_id'");
    }

    return mysqli_affected_rows($conn);
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

function updateGuru($data)
{
    global $conn;
    $id = $data['id'];
    $nama = $data['nama'];
    $email = $data['email'];
    $kelas = $data['kelas'];

    $query = "UPDATE guru SET id_kelas = $kelas WHERE id = $id";
    // $id = $data['id'];
    // $title = htmlspecialchars($data['title']);
    // $location = htmlspecialchars($data['location']);
    // $about = htmlspecialchars($data['about']);
    // $keberangkatan = 'Requested';
    // $duration = htmlspecialchars($data['duration']);
    // $orang = htmlspecialchars($data['orang']);
    // $destination = htmlspecialchars($data['destination']);
    // $fasilitas = htmlspecialchars($data['fasilitas']);
    // $harga = htmlspecialchars($data['harga']);

    // $query = " UPDATE paket_travel SET
    //                     title = '$title',
    //                     location = '$location',
    //                     about = '$about',
    //                     keberangkatan = 'Requested',
    //                     duration = '$duration',
    //                     orang = '$orang',
    //                     duration = '$duration',
    //                     destination = '$destination',
    //                     fasilitas = '$fasilitas',
    //                     harga = '$harga'
    //                     WHERE id='$id'
    // ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function register($data)
{
    global $conn;

    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $re_password = $data['re-password'];
    $image = 'USER.JPG';
    $usernameDb = mysqli_fetch_assoc(
        mysqli_query($conn, 'SELECT username FROM users')
    );
    $emailDb = mysqli_fetch_assoc(
        mysqli_query($conn, 'SELECT email FROM users')
    );

    // var_dump($emailDb);

    if ($email == $emailDb['email']) {
        echo "<script>
        alert('email sudah tersedia')
        </script>";

        return false;
    } elseif ($username == $usernameDb['username']) {
        echo "<script>
        alert('Username sudah tersedia')
        </script>";

        return false;
    } elseif ($password != $re_password) {
        echo "<script>
        alert('Konfirmasi Password tidak cocok !!')
        </script>";

        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users VALUES('','','$username','$email','','$image','USER','$password')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
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

function updateGambarTravel($data, $gambar)
{
    global $conn;

    $id_travel = $data['id'];
    $namaFile = $gambar['image']['name'];
    $tmpName = $gambar['image']['tmp_name'];

    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    $namafileBaru = uniqid();
    $namafileBaru .= '.';
    $namafileBaru .= $ekstensiFile;

    // var_dump($id_travel);
    $result = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT image  FROM gallery WHERE id='$id_travel'")
    );
    $result = $result['image'];

    mysqli_query(
        $conn,
        "UPDATE gallery SET 
                                        image='$namafileBaru'
                                        WHERE id='$id_travel'
                                        "
    );
    move_uploaded_file($tmpName, '../img/paket/' . $namafileBaru);
    unlink('../img/paket/' . $result);

    return mysqli_affected_rows($conn);
}
function uploadGambarTravel($data, $gambar)
{
    global $conn;

    $id_travel = $data['id'];
    $namaFile = $gambar['image']['name'];
    $tmpName = $gambar['image']['tmp_name'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    $namafileBaru = uniqid();
    $namafileBaru .= '.';
    $namafileBaru .= $ekstensiFile;

    // var_dump($id_travel);

    mysqli_query(
        $conn,
        "INSERT INTO gallery VALUES('','$id_travel','$namafileBaru')"
    );
    move_uploaded_file($tmpName, '../img/paket/' . $namafileBaru);

    return mysqli_affected_rows($conn);
}
function deleteGalleryTravel($id)
{
    global $conn;

    $data = $id;

    foreach ($data as $id_data) {
        $result = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT image  FROM gallery WHERE id='$id_data'"
            )
        );
        $result = $result['image'];
        unlink('../img/paket/' . $result);
        mysqli_query($conn, "DELETE  FROM gallery WHERE id='$id_data'");
    }

    // return mysqli_affected_rows($conn);
}

function updateTransaksi($data)
{
    global $conn;
    $id = $data['id'];
    $status = $data['status'];
    $id = explode(',', $id);
    foreach ($id as $data_id) {
        $query = "UPDATE transaksi SET 
                        status = '$status'
                        WHERE id='$data_id'";
        mysqli_query($conn, $query);
    }
    return mysqli_affected_rows($conn);
}
function updateAkun($data)
{
    global $conn;

    $id = $data['id'];
    $nama = $data['nama'];
    $username = $data['username'];
    $email = $data['email'];
    $no_telp = $data['no_telp'];

    mysqli_query(
        $conn,
        "UPDATE users SET 
                                        nama='$nama',
                                        username='$username',
                                        email='$email',
                                        no_telp='$no_telp'
                                        WHERE id='$id'"
    );
}

function deleteTransaksi($id)
{
    global $conn;

    $data = $id;

    foreach ($data as $id_data) {
        mysqli_query($conn, "DELETE  FROM transaksi WHERE id='$id_data'");
        mysqli_query(
            $conn,
            "DELETE  FROM transaksi_detail WHERE transaksi_id='$id_data'"
        );
    }

    // return mysqli_affected_rows($conn);
}
function updatePassword($data)
{
    global $conn;

    $username = $data['username'];
    $password = $data['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query(
        $conn,
        "UPDATE users SET 
                                        password='$password'
                                        WHERE username='$username'"
    );
}

function storeKeranjang($data)
{
    global $conn;
    $idtravel = $data['idtravel'];
    $userid = $data['userid'];
    $harga = $data['harga'];
    $status = 'IN_CART';
    $id_transaksi = $num_str = sprintf('TRSK' . mt_rand(1, 999999));

    mysqli_query(
        $conn,
        "INSERT INTO transaksi VALUES('$id_transaksi','$userid','$harga','$status')"
    );
    mysqli_query(
        $conn,
        "INSERT INTO transaksi_detail VALUES ('','$id_transaksi','$idtravel')"
    );
}
function sukses($data)
{
    global $conn;
    $id = $data['id'];
    $status = 'PENDING';

    $query = "UPDATE transaksi SET 
                        status = '$status'
                        WHERE id='$id'";
    mysqli_query($conn, $query);
}
