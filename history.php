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
                                        <!-- <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        <div class="text-dark modal-body">
                                                            <input type="hidden" name="id_data" id="id_data">
                                                            <input type="hidden" name="id_user" id="id_user">
                                                            <div class="form-group pb-4">
                                                                <label for="semen">Semen :</label>
                                                                <input type=number" class="form-control" name="semen" id="semen" placeholder="Jumlah Semen">
                                                            </div>
                                                            <div class="form-group pb-4">
                                                                <label for="bata">Batu Bata :</label>
                                                                <input type=number" class="form-control" name="bata" id="bata" placeholder="Jumlah Batu Bata">
                                                            </div>
                                                            <div class="form-group pb-4">
                                                                <label for="kayu">Kayu :</label>
                                                                <input type=number" class="form-control" name="kayu" id="kayu" placeholder="Jumlah Kayu">
                                                            </div>
                                                            <div class="form-group pb-4">
                                                                <label for="palu">Palu :</label>
                                                                <input type=number" class="form-control" name="palu" id="palu" placeholder="Jumlah Palu">
                                                            </div>
                                                            <div class="form-group pb-4">
                                                                <label for="sekop">Sekop :</label>
                                                                <input type=number" class="form-control" name="sekop" id="sekop" placeholder="Jumlah Sekop">
                                                            </div>
                                                            <div class="form-group pb-4">
                                                                <label for="obeng">Obeng :</label>
                                                                <input type=number" class="form-control" name="obeng" id="obeng" placeholder="Jumlah Obeng">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> -->
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
    <script>
        $(document).on("click", "#tombolUbah", function() {
            let id_data = $(this).data('id');
            let id_user = $(this).data('user');
            let semen = $(this).data('semen');
            let bata = $(this).data('bata');
            let kayu = $(this).data('kayu');
            let palu = $(this).data('palu');
            let obeng = $(this).data('obeng');
            let sekop = $(this).data('sekop');

            $(".modal-body #id_data").val(id_data);
            $(".modal-body #id_user").val(id_user);
            $(".modal-body #semen").val(semen);
            $(".modal-body #bata").val(bata);
            $(".modal-body #kayu").val(kayu);
            $(".modal-body #palu").val(palu);
            $(".modal-body #obeng").val(obeng);
            $(".modal-body #sekop").val(sekop);

        });
    </script>

</body>

</html>