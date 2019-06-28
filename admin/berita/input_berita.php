<?php 
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();}
require_once "../../Connections/kelompok_web.php";
if(isset($_POST['input'])){
    $kategori = mysqli_real_escape_string($link, $_POST['kategori']);
    $judul = mysqli_real_escape_string($link, $_POST['judul']);
    $isi = mysqli_real_escape_string($link, $_POST['isi']);
    $user = mysqli_real_escape_string($link, $_POST['username']);
    $tgl = mysqli_real_escape_string($link, $_POST['tgl']);
    $gambar = $_FILES['gambar']['name'];
    $temp = $_FILES['gambar']['tmp_name'];
    $imgExt = explode('.',$gambar);
    $format = array("jpg","jpeg","png");
    $newImg = uniqid('', true).'.'.strtolower(end($imgExt));
    $target ="gambar/".$newImg;
    $sqlQuery = "INSERT INTO berita(kategori, judul, isi, gambar, username, tgl) 
    VALUE('$kategori', '$judul', '$isi', '$newImg', '$user', '$tgl')";
    if(move_uploaded_file($temp, $target) && $link->query($sqlQuery)){
        $link->close();
        header("Location: daftar.php? upload=success");
        exit();
    }
    else{
        die(mysqli_connect_error());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Berita</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .header-input h5{text-align:center;font-size:24px;}
        table tr td, td select, td button{font-family:arial; background-color: #ccc; padding:3px 32px;}
        button:hover{background-color:#fff;}
    </style>
    <script src="main.js"></script>
</head>
<body>
    <div class="header-input">
        <h5>Masukkan Berita</h5>
    </div>
    <form action="input_berita.php" method="post" enctype="multipart/form-data">
        <table align="center" valign="middle">
            <tr>
                <td>Kategori Berita</td>
                <td><select name="kategori">
                    <?php
                    $result = mysqli_query($link, "SELECT kategori FROM kategori_berita"); 
                    while($row =mysqli_fetch_array($result, MYSQLI_NUM)):;?>
                    <option><?php echo $row[0];?></option>
                    <?php endwhile;?>
                </select></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul"></td>
            </tr>
            <tr>
                <td>Isi</td>
                <td><textarea name="isi"></textarea></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td><input type="file" name="gambar"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="input">input</button></td>
            </tr>
        </table>
        <input type="hidden" name="tgl" value="<?php echo date('y-m-d');?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['usernamelog'];?>">
    </form>
</body>
</html>