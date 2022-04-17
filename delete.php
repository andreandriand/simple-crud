<?php

require 'functions.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
            <script>
                alert('Hapus data berhasil dilakukan');
                document.location.href = 'index.php';
            </script>";
} else {
    echo  "
            <script>
                alert('Hapus data gagal dilakukan');
                document.location.href = 'index.php';
            </script>";
}
