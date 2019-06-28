<?php
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();} 
require_once "../../Connections/kelompok_web.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $kategori = mysqli_real_escape_string($link, $_POST['kategori']);
    $sql = "UPDATE kategori_berita SET kategori = ? WHERE id = ?";
    if(!empty($kategori)){
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, 'ss', $kategori, $id);
            if(mysqli_stmt_execute($stmt)){header("Location: daftar.php?edit sukses");mysqli_stmt_close($stmt);mysqli_close($link);exit();}
        }else{echo"error : can't open the database, try it later";mysqli_stmt_close($stmt);mysqli_close($link);exit();}
    }else{echo"error : input is empty";mysqli_stmt_close($stmt);mysqli_close($link);exit();}
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
        <form action="edit.php" method="post">
            <?php
            $id = mysqli_real_escape_string($link, $_GET['id']);
            $stmt = mysqli_prepare($link, "SELECT id, kategori FROM kategori_berita WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id, $kategori);
            mysqli_stmt_fetch($stmt);
            ?>
            <input type="text" name="kategori" placeholder="ketik disini" value="<?php echo $kategori;?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <button type="submit" name="input">input</button>
        </form>
    </div>
</body>
</html>