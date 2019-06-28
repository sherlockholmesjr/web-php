<?php
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();} 
require_once "../../Connections/kelompok_web.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>daftar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .header-daftar, .footer-daftar{text-align:center;}
        table{width: 600px;border-collapse: collapse;}
        table tr th{height: 45px;text-align: center;background-color: #ccc;}
        table tr td{height: 27px;font-family: arial;font-size: 16px;text-align: center;}
        a{text-decoration: none;color: blue;}
    </style>
    <script src="main.js"></script>
</head>
<body>
    <div class="header-daftar">
        <h3>Daftar Wakil Wali-Kota</h3>
    </div>
    <table align="center" valign="middle" border="1px">
        <tr>
            <th>ID</th>
            <th>Masa Jabatan</th>
            <th>Nama Wakil Wali-Kota</th>
            <th>Tanggal-Upload</th>
            <th colspan="2"></th>
        </tr>
        <?php $sql = "SELECT * FROM wakil_kota";$result = mysqli_query($link, $sql);$num = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)):;?>
        <tr>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[3];?></td>
            <td><a href="edit.php?id=<?php echo $row[0];?>">edit</a></td>
            <td><a href="delete.php?id=<?php echo $row[0];?>">delete</a></td>
        </tr>
        <?php endwhile;?>
    </table><?php for($i=0; $i<3; $i++){echo "<br/>";}?>
    <div class="footer-daftar">
        <form action="daftar.php" method="post">
            <button type="submit" name="kembali">kembali</button>
        </form><?php if(isset($_POST['kembali'])){header("Location: ../beranda.php");exit();}?>
    </div>
</body>
</html>
