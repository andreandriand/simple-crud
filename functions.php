<?php
//Menghubungkan ke database
$conn = mysqli_connect("localhost", "root", "", "utspaw");

//Mengambil data dari database
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

function edit($data)
{

    global $conn;

    $semen = intval($data["semen"]);
    $bata = intval($data["bata"]);
    $kayu = intval($data["kayu"]);
    $palu = intval($data["palu"]);
    $sekop = intval($data["sekop"]);
    $obeng = intval($data["obeng"]);

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

    $harga_semen = $_POST["semen"] * $harga_satuan_semen;
    $harga_bata = $_POST["bata"] * $harga_satuan_bata;
    $harga_kayu = $_POST["kayu"] * $harga_satuan_kayu;
    $harga_palu = $_POST["palu"] * $harga_satuan_palu;
    $harga_sekop = $_POST["sekop"] * $harga_satuan_sekop;
    $harga_obeng = $_POST["obeng"] * $harga_satuan_obeng;

    $harga_total = $harga_semen + $harga_bata + $harga_kayu + $harga_palu + $harga_sekop + $harga_obeng;

    $id_data = $data["id"];

    //query update data
    $query = "UPDATE history SET
                    semen = $semen,
                    bata = $bata,
                    kayu = $kayu,
                    palu = $palu,
                    sekop = $sekop,
                    obeng = $obeng,
                    harga_total = $harga_total
                    WHERE id_data = '$id_data'
                    ";

    return (mysqli_query($conn, $query));
}

function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM history WHERE id_data = $id");

    return (mysqli_affected_rows($conn));
}
