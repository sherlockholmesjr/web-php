<?php
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();} 
require_once "../../Connections/kelompok_web.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $kategori = mysqli_real_escape_string($link, $_POST['kategori']);
    $sql = "INSERT INTO kategori_berita(kategori) VALUE(?)";
    if(!empty($kategori)){
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, 's', $kategori);
            if(mysqli_stmt_execute($stmt)){header("Location: ../beranda.php? input Kategori Berita sukses");mysqli_stmt_close($stmt);mysqli_close($link);exit();}
        }else{echo"error : can't open the database, try it later";exit();}
    }else{echo"error : input is empty";exit();}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="main.js"></script>
</head>
<body>
    <div>
        <h5>Masukkan Kategori Berita</h5>
    </div>
    <div>
        <form action="input_kategori.php" method="post">
            <input type="text" name="kategori" placeholder="ketik disini">
            <button type="submit" name="input">input</button>
        </form>
    </div>
</body>
</html>