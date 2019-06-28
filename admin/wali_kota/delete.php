<?php
require_once "../../Connections/kelompok_web.php";
$id = mysqli_real_escape_string($link, $_GET['id']);
$sql = "DELETE FROM wali_kota WHERE id = ?";
if($st = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($st, 's', $id);
    if(mysqli_stmt_execute($st)){
        header("Location: daftar.php? hapus sukses");
        exit();
    }
}
