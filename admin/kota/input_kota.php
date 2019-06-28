<?php
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();} 
require_once "../../Connections/kelompok_web.php";
if(isset($_POST['input'])){
    $nama = mysqli_real_escape_string($link, $_POST['nama']);
    $alamat = mysqli_real_escape_string($link, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($link, $_POST['telepon']);
    $user = mysqli_real_escape_string($link, $_POST['username']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $ciri = mysqli_real_escape_string($link, $_POST['ciri']);
    $fax = mysqli_real_escape_string($link, $_POST['fax']);
    $tgl = mysqli_real_escape_string($link, $_POST['tgl']);
    $wl = mysqli_real_escape_string($link, $_POST['wali']);
    $wk = mysqli_real_escape_string($link, $_POST['wakil']);
    $gambar = $_FILES['logo']['name'];
    $temp = $_FILES['logo']['tmp_name'];
    $imgExt = explode('.',$gambar);
    $format = array("jpg","jpeg","png");
    $newImg = uniqid('', true).'.'.strtolower(end($imgExt));
    $target ="logo/".$newImg;
    $sqlQuery = "INSERT INTO kota(nama, alamat, telepon, fax, email, logo, ciri_kota, wali, wakil, username, tgl) 
    VALUE('$nama', '$alamat', '$telepon', '$fax', '$email', '$newImg', '$ciri', '$wl', '$wk', '$user', '$tgl')";
    if(mysqli_query($link, $sqlQuery)){
        move_uploaded_file($temp, $target);
        header("Location: ../beranda.php? upload=success");
        exit();
    }
    else{
        echo $nama."<br/>";
        echo $alamat."<br/>";
        echo $telepon."<br/>";
        echo $user."<br/>";
        echo $email."<br/>";
        echo $ciri."<br/>";
        echo $fax."<br/>";
        echo $tgl."<br/>";
        echo $wl."<br/>";
        echo $wk."<br/>";
        echo $gambar."<br/>";
        die(mysqli_connect_error());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kota</title>
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
        <h5>Masukkan Informasi Kota</h5>
    </div>
    <form action="input_kota.php" method="post" enctype="multipart/form-data">
        <table align="center" valign="middle">
            <tr>
                <td>Fax</td>
                <td><input type="text" name="fax"></td>
            </tr>
            <tr>
                <td>Logo</td>
                <td><input type="file" name="logo"></td>
            </tr>
            <tr>
                <td>Ciri Kota</td>
                <td><textarea name="ciri" width="600px"></textarea></td>
            </tr>
            <tr>
                <td>Wali-Kota</td>
                <td><select name="wali">
                    <?php
                    $result = mysqli_query($link, "SELECT nama, masa_jabatan FROM wali_kota"); 
                    while($row =mysqli_fetch_array($result, MYSQLI_NUM)):;?>
                    <option><?php echo $row[0];?></option>
                    <?php endwhile;?>
                </select></td>
            </tr>
            <tr>
                <td>Wakil Wali-Kota</td>
                <td><select name="wakil">
                    <?php
                    $result = mysqli_query($link, "SELECT nama, masa_jabatan FROM wakil_kota"); 
                    while($row =mysqli_fetch_array($result, MYSQLI_NUM)):;?>
                    <option><?php echo $row[0];?></option>
                    <?php endwhile;?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="input">input</button></td>
            </tr>
        </table>
        <input type="hidden" name="nama" value="<?php echo $_SESSION['namalog'];?>">
        <input type="hidden" name="alamat" value="<?php echo $_SESSION['alamatlog'];?>">
        <input type="hidden" name="telepon" value="<?php echo $_SESSION['telplog'];?>">
        <input type="hidden" name="email" value="<?php echo $_SESSION['emlog'];?>">
        <input type="hidden" name="tgl" value="<?php echo date('Y-m-d');?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['usernamelog'];?>">
    </form>
</body>
</html>