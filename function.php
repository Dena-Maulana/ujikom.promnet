<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "SIMBS");

// fungsi untuk menampilkan data dari database
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

// fungsi untuk menambahkan data ke database
function tambah_data($data)
{
    global $conn;

    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $halaman = htmlspecialchars($data['halaman']);

    // upload gambar
    $gambar = upload_gambar();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO buku 
                (judul, deskripsi, halaman, gambar, tanggal_input)
              VALUES 
                ('$judul', '$deskripsi', '$halaman', '$gambar', CURRENT_TIMESTAMP)";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi untuk menghapus data dari database
function hapus_data($id)
{
    global $conn;
    $query = "DELETE FROM buku WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// fungsi untuk mengubah data dari database
function ubah_data($data)
{
    global $conn;

    $id = $data['id'];
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $halaman = htmlspecialchars($data['halaman']);
    $gambarOld = htmlspecialchars($data['gambarOld']);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarOld;
    } else {
        $gambar = upload_gambar();
    }

    $query = "UPDATE buku SET
                judul = '$judul',
                deskripsi = '$deskripsi',
                halaman = '$halaman',
                gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi untuk register
function register($data)
{
    global $conn;

    $username = strtolower(trim($data['username']));
    $email = trim($data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);

    if (strlen($password) < 8) {
        return "Password Harus Mengandung Minimal 8 Karakter";
    }

    // cek username
    $query_username = mysqli_query(
        $conn,
        "SELECT username FROM user WHERE username = '$username'"
    );
    if (mysqli_fetch_assoc($query_username)) {
        return "Username sudah terdaftar!";
    }

    // cek email
    $query_email = mysqli_query(
        $conn,
        "SELECT email FROM user WHERE email = '$email'"
    );
    if (mysqli_fetch_assoc($query_email)) {
        return "Email sudah terdaftar!";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, email, password)
              VALUES ('$username', '$email', '$password')";

    if (!mysqli_query($conn, $query)) {
        return "DB ERROR: " . mysqli_error($conn);
    }

    return true;
}

// fungsi untuk login
function login($data)
{
    global $conn;


    $username = $data['username'];
    $password = $data['password'];


    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);


        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            return true;

            return true;
        } else {

            return "Password salah!";
        }


    } else {
        return "Username tidak terdaftar!";
    }
}

// fungsi untuk upload gambar
function upload_gambar()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    // maks --> 5MB
    if ($ukuranFile > 5000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

//fungsi kategori
function tambah_kategori($data)
{
    global $conn;

    $kategori = htmlspecialchars($data['kategori']);

    $query = "INSERT INTO kategori 
    (kategori)
    VALUES 
    ('$kategori')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_kategori($id)
{
    global $conn;
    $query = "DELETE FROM kategori WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubah_kategori($data)
{
    global $conn;

    $id = $data['id'];
    $kategori = htmlspecialchars($data['kategori']);

    $query = "UPDATE kategori SET
                kategori = '$kategori'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>