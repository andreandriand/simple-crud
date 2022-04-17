<?php

$conn = mysqli_connect('localhost', 'root', '', 'utspaw');

$id = $_GET['id'];

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

$data = query("SELECT * FROM history WHERE id_user = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-pink">
        <div class="container">
            <a class="navbar-brand" href="index.php">BuildIT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->

    <!-- history -->

    <section id="history" class="text-center bg-purple">
        <div class="container">
            <div class="row">
                <div class="col pt-5">
                    <h1 class="text-white">Riwayat</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2" class="pb-4">No</th>
                                <th colspan="3">Bahan</th>
                                <th colspan="3">Alat</th>
                                <th rowspan="2" class="pb-4">Total Harga</th>
                                <th rowspan="2" class="pb-4">Action</th>
                            </tr>
                            <tr>
                                <th>Semen</th>
                                <th>Batu Bata</th>
                                <th>Kayu</th>
                                <th>Palu</th>
                                <th>Sekop</th>
                                <th>Obeng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $dat) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $dat['semen']; ?></td>
                                    <td><?= $dat['bata']; ?></td>
                                    <td><?= $dat['kayu']; ?></td>
                                    <td><?= $dat['palu']; ?></td>
                                    <td><?= $dat['sekop']; ?></td>
                                    <td><?= $dat['obeng']; ?></td>
                                    <td>Rp <?= $dat['harga_total']; ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $dat["id_data"]; ?>" class="btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="delete.php?id=<?= $dat["id_data"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- End history -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>