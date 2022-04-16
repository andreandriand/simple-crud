<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "utspaw");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $datas = [];
  while ($data = mysqli_fetch_assoc($result)) {
    $datas[] = $data;
  }
  return $datas;
}

// Register user
if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $regist = mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$email', '$password')");
  if ($regist) {
    echo "<script>alert('Registrasi Berhasil')</script>";
    echo "<script>location='index.php'</script>";
  } else {
    echo "<script>alert('Registrasi Gagal')</script>";
    echo "<script>location='register.php'</script>";
  }
}

//Login User
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $login = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
  $data_user = mysqli_fetch_assoc($login);
  $cek = mysqli_num_rows($login);
  if ($cek > 0) {
    $_SESSION['username'] = $data_user['id_user'];
    $_SESSION['status'] = "login";
  } else {
    echo "<script>alert('Username atau Password Salah')</script>";
    echo "<script>location='index.php'</script>";
  }
}

// Input Data

if (isset($_POST['submit'])) {
  if (!isset($_SESSION['username'])) {
    echo "<script>alert('Anda Harus Login Terlebih Dahulu')</script>";
    echo "<script>location='index.php'</script>";
  } else {
    $id = $_SESSION['username'];
    $satuan_palu = query("SELECT harga_satuan FROM alat WHERE id_alat = 'PAL'")[0];
    $satuan_obeng = query("SELECT harga_satuan FROM alat WHERE id_alat = 'OBG'")[0];
    $satuan_sekop = query("SELECT harga_satuan FROM alat WHERE id_alat = 'SKP'")[0];
    $satuan_semen = query("SELECT harga_satuan FROM bahan WHERE id_bahan = 'SMN'")[0];
    $satuan_bata = query("SELECT harga_satuan FROM bahan WHERE id_bahan = 'BBT'")[0];
    $satuan_kayu = query("SELECT harga_satuan FROM bahan WHERE id_bahan = 'KYU'")[0];
    $harga_satuan_palu = intval($satuan_palu['harga_satuan']);
    $harga_satuan_obeng = intval($satuan_obeng['harga_satuan']);
    $harga_satuan_sekop = intval($satuan_sekop['harga_satuan']);
    $harga_satuan_semen = intval($satuan_semen['harga_satuan']);
    $harga_satuan_bata = intval($satuan_bata['harga_satuan']);
    $harga_satuan_kayu = intval($satuan_kayu['harga_satuan']);

    $semen = $_POST['semen'];
    $harga_semen = $semen * $harga_satuan_semen;

    $bata = $_POST['bata'];
    $harga_bata = $bata * $harga_satuan_bata;

    $kayu = $_POST['kayu'];
    $harga_kayu = $kayu *  $harga_satuan_kayu;

    $palu = $_POST['palu'];
    $harga_palu = $palu * $harga_satuan_palu;

    $obeng = $_POST['obeng'];
    $harga_obeng = $obeng * $harga_satuan_obeng;

    $sekop = $_POST['sekop'];
    $harga_sekop = $sekop * $harga_satuan_sekop;

    $harga_total = $harga_semen + $harga_bata + $harga_kayu + $harga_palu + $harga_obeng + $harga_sekop;
    $insert = mysqli_query($conn, "INSERT INTO history VALUES ('', $id, '$semen', '$bata', '$kayu', '$palu', '$obeng', '$sekop', '$harga_total')");
    if ($insert) {
      echo "<script>alert('Data Berhasil Diinput')</script>";
      echo "<script>location='index.php'</script>";
    } else {
      echo "<script>alert('Data Gagal Diinput')</script>";
      echo "<script>location='index.php'</script>";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg navbar-light bg-pink">
    <div class="container">
      <a class="navbar-brand" href="index.html">BuildIT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <?php

          if (isset($_SESSION['username'])) {
            echo '<a class="nav-item nav-link" href="index.php">History</a>';
            echo '<a class="nav-item nav-link" href="logout.php">Logout</a>';
          } else {
            echo '<button type="button" class="nav-link btn" data-bs-toggle="modal" data-bs-target="#login">
                    Login
                  </button>';
            echo '<button type="button" class="nav-link btn" data-bs-toggle="modal" data-bs-target="#register">
                  Register
                </button>';
          }

          ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- End Navbar -->

  <!-- Jumbotron -->

  <section id="jumbotron" class="jumbotron text-center pt-5 bg-purple">
    <div class="container">
      <img src="1.png" alt="Gambar" width="200" class="rounded-circle" />
      <p class="lead fw-bolder fs-2">Hi, Welcome to Our Page</p>
      <p>Discover Something New Down Below</p>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path id="about" fill="#560bad" fill-opacity="1" d="M0,64L60,96C120,128,240,192,360,192C480,192,600,128,720,117.3C840,107,960,149,1080,144C1200,139,1320,85,1380,58.7L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
    </svg>
  </section>

  <!-- End Jumbotron -->

  <!-- CRUD -->

  <section id="crud" class="text-center text-light bg-purple2">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Let's Build Your Future Palace</h2>
        </div>
      </div>
      <form method="POST" action="">
        <div class="row mt-5">
          <div class="col">
            <p class="mt-5">Choose Your Material</p>
            <table cellpadding="10">
              <tr>
                <td>
                  <label for="semen">Semen </label>
                </td>
                <td> : </td>
                <td>
                  <input id="semen" type="number" name="semen" />
                </td>
              </tr>
              <tr>
                <td>
                  <label for="bata">Batu Bata </label>
                </td>
                <td> : </td>
                <td>
                  <input id="bata" type="number" name="bata" />
                </td>
              </tr>
              <tr>
                <td>
                  <label for="kayu">Kayu </label>
                </td>
                <td> : </td>
                <td>
                  <input id="kayu" type="number" name="kayu" />
                </td>
              </tr>
            </table>
          </div>
          <div class="col">
            <p class="mt-5">Choose Your Tools</p>
            <table class="ms-3" cellpadding="10">
              <tr>
                <td>
                  <label for="palu">Palu </label>
                </td>
                <td> : </td>
                <td>
                  <input id="palu" type="number" name="palu" />
                </td>
              </tr>
              <tr>
                <td>
                  <label for="sekop">Sekop </label>
                </td>
                <td> : </td>
                <td>
                  <input id="sekop" type="number" name="sekop" />
                </td>
              </tr>
              <tr>
                <td>
                  <label for="obeng">Obeng </label>
                </td>
                <td> : </td>
                <td>
                  <input id="obeng" type="number" name="obeng" />
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row mt-5 pb-5">
          <div class="col">
            <button type="submit" name="submit" class="btn btn-success">Done</button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <!-- End CRUD -->

  <!-- Login -->

  <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Username : </label>
              <input type=text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password : </label>
              <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- End Login -->

  <!-- Register -->

  <div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Username : </label>
              <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="email">Email : </label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Your Email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password : </label>
              <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- End Register -->

  <!-- Footer -->

  <footer id="footer" class="bg-footer text-light text-center p-2">Created by Andre &copy; 2022</footer>

  <!-- End Footer -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>