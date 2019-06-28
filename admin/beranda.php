<?php 
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: login.php");exit();}
if(isset($_POST['logout'])){header("Location: logout.php");exit();}
if(isset($_POST['kategori'])){header("Location: kategori_berita/input_kategori.php");exit();}
if(isset($_POST['berita'])){header("Location: berita/input_berita.php");exit();}
if(isset($_POST['kota'])){header("Location: kota/input_kota.php");exit();}
if(isset($_POST['wakil'])){header("Location: wakil_kota/input_wakil.php");exit();}
if(isset($_POST['wali'])){header("Location: wali_kota/input_wali.php");exit();}
if(isset($_POST['logout'])){header("Location: logout.php");exit();}
if(isset($_POST['daftar-kategori'])){header("Location: kategori_berita/daftar.php");exit();}
if(isset($_POST['daftar-berita'])){header("Location: berita/daftar.php");exit();}
if(isset($_POST['daftar-kota'])){header("Location: kota/daftar.php");exit();}
if(isset($_POST['daftar-wakil'])){header("Location: wakil_kota/daftar.php");exit();}
if(isset($_POST['daftar-wali'])){header("Location: wali_kota/daftar.php");exit();}
if(isset($_POST['daftar-admin'])){header("Location: admin/daftar.php");exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Beranda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .input-button button{width: 180px;background-color: #aaa;}
        .input-button table tr th{height: 30px;text-align:center;background-color: #bbb;}
        .input-button button:hover{background-color: #fff;}
    </style>
    <script src="main.js"></script>
</head>
<body>
    <div class="page-header">
        <h3>Hai, <?php echo htmlspecialchars($_SESSION["namalog"]); ?>. Selamat datang di Website kami.</h3>
    </div><?php for($i=0; $i<3; $i++){echo "<br/>";}?>
    <form action="beranda.php" method="post">
        <div class="input-button">
        <table>
            <tr>
                <th>INPUT</th>
                <th>DAFTAR</th>
            </tr>
            <tr>
                <td><button type="submit" name="kategori">Input Kategori</button></td>
                <td><button type="submit" name="daftar-kategori">Daftar Kategori</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="berita">Input Berita</button></td>
                <td><button type="submit" name="daftar-berita">Daftar Berita</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="kota">Input Kota</button></td>
                <td><button type="submit" name="daftar-kota">Daftar Kota</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="wali">Input Wali Kota</button></td>
                <td><button type="submit" name="daftar-wali">Daftar Wali Kota</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="wakil">Input Wakil-Wali Kota</button></td>
                <td><button type="submit" name="daftar-wakil">Daftar Wakil-Wali Kota</button></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="daftar-admin">Daftar Admin</button></td>
            </tr>
        </table>    
        </div><?php for($i=0; $i<5; $i++){echo "<br/>";}?>
        <div class="logout-button">
            <button type="submit" name="logout">logout</button>
        </div>
    </form>
</body>
</html>